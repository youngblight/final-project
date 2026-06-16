<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Craftsmen;
use App\Models\Service; 
use Illuminate\Support\Str; 

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $totalCraftsmen = Craftsmen::count();

        $pendingVerifications = Craftsmen::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalCraftsmen', 'pendingVerifications'));
    }

    public function viewDetails()
    {
        $craftsmen = Craftsmen::all(); 
        
        return view('admin.craftsmen_details', compact('craftsmen'));
    }

    public function approveCraftsman($id)
    {
        $fundi = Craftsmen::findOrFail($id);
        $fundi->status = 'approved';
        $fundi->save();

        return back()->with('success', "Fundi {$fundi->full_name} is now live!");
    }

    public function storeService(Request $request) 
    {
        $request->validate([
            'name'  => 'required|unique:services',
            'image' => 'nullable|image|max:2048'
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

        return back()->with('success', 'Service created successfully!');
    }

    public function showCraftsman($id)
    {
        $craftsman = Craftsmen::with('jobRequests.payment')->findOrFail($id);
        
        return view('admin.craftsmen.show', compact('craftsman'));
    }
}