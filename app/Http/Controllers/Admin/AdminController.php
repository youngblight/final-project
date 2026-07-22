<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Craftsmen;
use App\Models\Service; 
use App\Models\Comment;
use App\Models\jobRequest;
use App\Models\User;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $totalCraftsmen = Craftsmen::count();
        $totalUsers = User::count();
        $pendingVerifications = Craftsmen::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalCraftsmen', 'totalUsers', 'pendingVerifications'));
    }

    public function viewDetails()
    {
        // Kutumia paginate badala ya all() inasaidia sana mfumo kuwa mwepesi
        $craftsmen = Craftsmen::latest()->paginate(15); 
        
        return view('admin.craftsmen_details', compact('craftsmen'));
    }

    public function approveCraftsman($id)
    {
        $fundi = Craftsmen::findOrFail($id);
        $fundi->status = 'approved';
        $fundi->save();

        return back()->with('success', "Fundi {$fundi->full_name} amethibitishwa kikamilifu!");
    }

    public function storeService(Request $request) 
    {
        $request->validate([
            'name'        => 'required|unique:services,name',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'description' => 'nullable|string'
        ]);

        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('services', 'public') 
            : null;

        Service::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'icon'        => $request->icon,
            'image'       => $imagePath,
            'description' => $request->description
        ]);

        return back()->with('success', 'Huduma mpya imehifadhiwa kikamilifu!');
    }

    public function showCraftsman($id)
    {
        $craftsman = Craftsmen::with(['jobRequests.payment'])->findOrFail($id);
        
        return view('admin.craftsmen.show', compact('craftsman'));
    }

public function comments()
    {
        // Inavuta maombi/maoni yote ya wateja yenye taarifa za mtumiaji (user)
        // Hakikisha 'user' relation ipo kwenye JobRequest model
        $comments = JobRequest::with('user')->latest()->paginate(15);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Futa maoni / maombi ya kazi
     */
    public function destroyComment($id)
    {
        $jobRequest = JobRequest::findOrFail($id);
        $jobRequest->delete();

        return redirect()->back()->with('success', 'Maoni/Ombi limefutwa kikamilifu.');
    }
}