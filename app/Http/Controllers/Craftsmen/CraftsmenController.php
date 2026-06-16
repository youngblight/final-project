<?php

namespace App\Http\Controllers\Craftsmen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Craftsmen; 
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CraftsmenController extends Controller
{
    public function craftsDashboard() 
    {
        $craftsman = Craftsmen::where('user_id', Auth::id())->first();
        
        if (!$craftsman) {
            return redirect('/')->with('error', 'Craftsman profile not found.');
        }

        $jobs = \App\Models\JobRequest::where('craftsman_id', $craftsman->id)
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
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users',
            'password'         => 'required|string|confirmed|min:8',
            'full_name'        => 'required|string|max:255',
            'phone'            => 'required|unique:craftsmen,phone',
            'skill_category'   => 'required',
            'location_name'    => 'required',
            'verification_doc' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'profile_photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            return back()->with('error', "Could not find map coordinates for: " . $address)->withInput();
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

            return redirect()->route('craftsmen.dashboard')->with('success', 'Registration successful!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function editProfile()
    {
        $craftsman = \App\Models\Craftsmen::where('user_id', auth()->id())->firstOrFail();
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

        return back()->with('success', 'Your profile has been updated successfully!');
    }

    public function respondToJob(Request $request, $id)
    {
        $request->validate([
            'agreed_price' => 'required|numeric',
            'fundi_response' => 'required|string',
        ]);

        $job = \App\Models\JobRequest::findOrFail($id);
        
        $job->update([
            'agreed_price' => $request->agreed_price,
            'fundi_response' => $request->fundi_response,
            'status' => 'accepted' 
        ]);

        return back()->with('success', 'Message and pricing coordinates sent to the customer!');
    }
}