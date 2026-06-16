<?php

namespace App\Http\Controllers\Craftsmen;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\Craftsmen;

class CraftsmanJobHistoryController extends Controller
{
    public function index()
    {
        $craftsman = Craftsmen::where('user_id', auth()->id())->firstOrFail();

        $pastJobs = JobRequest::with('payment') 
            ->where('craftsman_id', $craftsman->id)
            ->whereIn('status', ['completed', 'fully_paid', 'rejected', 'cancelled'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $totalCompleted = $pastJobs->whereIn('status', ['completed', 'fully_paid'])->count();
        
        $totalEarnings = 0;
        foreach ($pastJobs as $job) {
            if (in_array($job->status, ['completed', 'fully_paid']) && $job->agreed_price) {
                $totalEarnings += $job->agreed_price;
            }
        }

        return view('craftsmen.job_history', compact('pastJobs', 'totalCompleted', 'totalEarnings'));
    }
}