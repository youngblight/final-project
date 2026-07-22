<?php

namespace App\Http\Controllers\Craftsmen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Craftsmen; 
use App\Models\User;
use App\Models\JobRequest;
use App\Models\Message;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password; // <-- 1. IMEONGEZWA HAPA!

class CraftsmenController extends Controller
{
    public function craftsDashboard() 
    {
        $craftsman = Craftsmen::where('user_id', Auth::id())->first();
        
        if (!$craftsman) {
            return redirect('/')->with('error', 'Wasifu wa fundi haukupatikana.');
        }

        $jobs = JobRequest::where('craftsman_id', $craftsman->id)
                ->latest()
                ->get();

        return view('craftsmen.dashboard', compact('craftsman', 'jobs'));
    }

    public function craftsRegister() 
    {
        return view('craftsmen.register');
    }

    public function store(Request $request)
    {
        // 2. PASSWORD POLICY & CUSTOM SWAHILI MESSAGES
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users',
            'password'         => [
                'required',
                'confirmed',
                Password::min(8)          // Angalau herufi 8
                    ->letters()           // Lazima iwe na herufi
                    ->mixedCase()         // Herufi kubwa na ndogo (ABC na abc)
                    ->numbers()           // Lazima iwe na namba
                    ->symbols()           // Lazima iwe na alama maalum (@, #, $, !)
                    ->uncompromised(),    // Inakagua kama password haijavuja mtandaoni
            ],
            'full_name'        => 'required|string|max:255',
            'phone'            => 'required|unique:craftsmen,phone',
            'skill_category'   => 'required',
            'location_name'    => 'required',
            'verification_doc' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'profile_photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            // Ujumbe kwa Kiswahili
            'name.required'             => 'Tafadhali weka jina la mtumiaji (Username).',
            'email.required'            => 'Tafadhali weka barua pepe (email).',
            'email.unique'              => 'Barua pepe hii tayari imeshasajiliwa.',
            'password.required'         => 'Tafadhali weka nenosiri (password).',
            'password.confirmed'        => 'Nenosiri ulilorudia halifanani na la kwanza.',
            'full_name.required'       => 'Tafadhali weka jina lako kamili.',
            'phone.required'            => 'Tafadhali weka namba yako ya simu.',
            'phone.unique'              => 'Namba hii ya simu tayari imeshasajiliwa.',
            'skill_category.required'   => 'Tafadhali chagua aina ya ujuzi wako.',
            'location_name.required'    => 'Tafadhali weka eneo unalopatkana.',
            'verification_doc.required' => 'Tafadhali pakia kitambulisho au cheti cha uhakiki.',
        ]);

        $address = $request->location_name; 
        $response = Http::withHeaders(['User-Agent' => 'DigitalConnectionApp'])
            ->get("https://nominatim.openstreetmap.org/search", [
                'q'      => $address,
                'format' => 'json',
                'limit'  => 1
            ]);

        $latitude = null;
        $longitude = null;

        if ($response->successful() && count($response->json()) > 0) {
            $latitude = $response->json()[0]['lat'];
            $longitude = $response->json()[0]['lon'];
        } else {
            return back()->with('error', "Imeshindikana kupata viwianishi (ramani) vya eneo: " . $address)->withInput();
        }

        $documentPath = $request->file('verification_doc')->store('documents', 'public');
        $photoPath = $request->hasFile('profile_photo') 
            ? $request->file('profile_photo')->store('profile_photos', 'public') 
            : null;

        try {
            DB::beginTransaction();

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'craftsmen', 
            ]);

            Craftsmen::create([
                'user_id'          => $user->id,
                'full_name'        => $request->full_name,
                'phone'            => $request->phone,
                'skill_category'   => $request->skill_category,
                'location_name'    => $address,
                'latitude'         => $latitude,
                'longitude'        => $longitude,
                'verification_doc' => $documentPath, 
                'profile_photo'    => $photoPath,
                'status'           => 'pending',
            ]);

            DB::commit();
            Auth::login($user);

            return redirect()->route('craftsmen.dashboard')->with('success', 'Usajili umefanikiwa kikamilifu!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Hitilafu imetokea: ' . $e->getMessage())->withInput();
        }
    }

    public function editProfile()
    {
        $craftsman = Craftsmen::where('user_id', auth()->id())->firstOrFail();
        return view('craftsmen.edit', compact('craftsman'));
    }

    public function updateProfile(Request $request) 
    {
        $craftsman = Craftsmen::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'full_name'      => 'required|string|max:255',
            'phone'          => 'required|unique:craftsmen,phone,' . $craftsman->id,
            'skill_category' => 'required',
            'location_name'  => 'required',
            'profile_photo'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->location_name !== $craftsman->location_name) {
            $response = Http::withHeaders(['User-Agent' => 'DigitalConnectionApp'])
                ->get("https://nominatim.openstreetmap.org/search", [
                    'q'      => $request->location_name,
                    'format' => 'json',
                    'limit'  => 1
                ]);

            if ($response->successful() && count($response->json()) > 0) {
                $craftsman->latitude = $response->json()[0]['lat'];
                $craftsman->longitude = $response->json()[0]['lon'];
            }
        }

        if ($request->hasFile('profile_photo')) {
            if ($craftsman->profile_photo) {
                Storage::disk('public')->delete($craftsman->profile_photo);
            }
            $craftsman->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $craftsman->update([
            'full_name'      => $request->full_name,
            'phone'          => $request->phone,
            'skill_category' => $request->skill_category,
            'location_name'  => $request->location_name,
            'latitude'       => $craftsman->latitude,
            'longitude'      => $craftsman->longitude,
            'profile_photo'  => $craftsman->profile_photo,
        ]);

        return back()->with('success', 'Wasifu wako umesasishwa kwa mafanikio!');
    }

    public function respondToJob(Request $request, $id)
    {
        $job = JobRequest::findOrFail($id);

        if ($request->has('agreed_price') && $request->filled('agreed_price')) {
            
            $request->validate([
                'agreed_price' => 'required|numeric|min:1',
                'fundi_response' => 'nullable|string',
            ]);

            $job->update([
                'agreed_price' => $request->agreed_price,
                'fundi_response' => $request->fundi_response ?? $job->fundi_response,
                'status' => 'offer_sent'
            ]);

            return back()->with('success', 'Ofa ya bei imetumwa kwa mteja kikamilifu!');
        } 
        else {
            $job->update([
                'fundi_response' => $request->fundi_response ?? 'Nimekubali ombi lako, tuwasiliane kwa maelezo zaidi.',
                'status' => 'accepted'
            ]);

            return back()->with('success', 'Umekubali ombi! Sasa mnaweza kuchat na mteja.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $job = JobRequest::findOrFail($id);
        $job->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Hali ya kazi imesasishwa kwa mafanikio!');
    }
}