<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Craftsmen;
use App\Models\Service;
use App\Models\JobRequest; 
use App\Models\Message;    
use Auth;

class LandingPageController extends Controller
{
    public function homePage()
    {
        $services = Service::withCount('craftsmen')->get();

        $craftsmen = Craftsmen::with('user')
            ->whereIn('status', ['verified', 'approved', 'active'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '!=', 0) 
            ->where('longitude', '!=', 0)
            ->get();

        return view('home.home_page', compact('craftsmen', 'services'));
    }

    public function viewServiceCraftsmen($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        
        $craftsmen = Craftsmen::with('user')
            ->where('skill_category', $service->name)
            ->whereIn('status', ['verified', 'approved', 'active'])
            ->get();

        return view('services.craftsmen_list', compact('service', 'craftsmen'));
    }

    public function viewCraftsmanProfile($id)
    {
        $craftsman = Craftsmen::findOrFail($id);
        $active_job = null;
        $messages = collect(); 

        if (Auth::check()) {
            // 1. Tunatafuta ombi la kazi lililo hai (Tumeongeza 'pending' hapa)
            $active_job = JobRequest::where('user_id', Auth::id())
                ->where('craftsman_id', $id)
                ->whereIn('status', ['pending', 'accepted', 'in_progress', 'completed'])
                ->latest()
                ->first();

            // 2. Kama kuna kazi ipo, tunavuta meseji zote zilizounganishwa na ID ya kazi hiyo
            if ($active_job) {
                $messages = Message::where('job_id', $active_job->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
        }

        // Hapa tunatuma data zote kwenda kwenye view ya 'services.craftsman_profile'
        return view('services.craftsman_profile', compact('craftsman', 'active_job', 'messages'));
    }
}