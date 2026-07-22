<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobRequest;

class JobRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'craftsman_id' => 'required|exists:craftsmen,id',
            'job_description' => 'required|string',
            'location'        => 'required|string',
            'customer_phone'  => 'required',
        ]);

        JobRequest::create([
            'user_id'         => auth()->id(),
            'craftsman_id'    => $request->craftsman_id,
            'job_description' => $request->job_description,
            'location'        => $request->location,
            'status'          => 'pending',
            'customer_phone'  => $request->customer_phone,
        ]);

        return redirect()->back()
            ->with('success', 'Ombi lako la kazi limetumwa kikamilifu! Tafadhali subiri fundi akujibu.');
    }

    public function accept(Request $request, $id)
    {
        $request->validate([
            'agreed_price'   => 'required|numeric|min:0',
            'fundi_response' => 'required|string',
        ]);

        $job = JobRequest::findOrFail($id);
        
        $job->update([
            'status'         => 'accepted',
            'fundi_response' => $request->fundi_response,
            'agreed_price'   => $request->agreed_price,
        ]);

        return redirect()->back()
            ->with('success', 'You have sent your response and price quotation to the customer!');
    }

    public function reject($id)
    {
        $job = JobRequest::findOrFail($id);
        $job->update(['status' => 'rejected']);

        return back()->with('error', 'You have rejected the job request.');
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,in_progress,completed,cancelled'
        ]);

        $job = JobRequest::findOrFail($id);
        
        $job->update([
            'status' => $validated['status']
        ]);

        return back()->with('success', 'Job status changed to ' . ucfirst($validated['status']));
    }

    public function rateJob(Request $request, $id)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $job = JobRequest::findOrFail($id);
        
        $job->update([
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('home.page')
            ->with('success', 'Thank you for your feedback! It is now live on the craftsman profile.');
    }
}