<?php

namespace App\Http\Controllers;

use App\Models\JobRequest;
use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:job_requests,id', // Hakikisha kazi ipo
            'receiver_id' => 'required|exists:users,id',  // Hakikisha mpokeaji yupo
            'message' => 'required|string|max:5000',      // Ujumbe usizidi maneno mengi sana
        ]);

        // Kuhifadhi ujumbe mpya kwenye database
        Message::create([
            'job_id' => $request->job_id,
            'sender_id' => auth()->id(), // Aliyelogin sasa hivi ndo mtumaji
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Ujumbe umetumwa!');
    }
public function show($id)
{
    $job = JobRequest::with(['craftsmen', 'user'])->findOrFail($id);

    $craftsmanUserId = $job->craftsmen->user_id ?? $job->craftsman_id ?? null;

    if (!$craftsmanUserId) {
        return back()->with('error', 'Hauwezi kuanzisha chat kwani kazi hii haina fundi aliyepangiwa.');
    }

    // Tambua nani anapokea ujumbe
    $receiverId = (auth()->id() == $job->user_id) 
        ? $craftsmanUserId 
        : $job->user_id;

    $messages = Message::where('job_id', $job->id)
        ->orderBy('created_at', 'asc')
        ->get();

    // ANGALIA KOA LA USER:
    // Kama mtumiaji aliyelogin ni Fundi au ana Role ya craftsman
    if (auth()->user()->role == 'craftsmen' || auth()->id() == $craftsmanUserId) {
        return view('craftsmen.chat.show', compact('job', 'messages', 'receiverId'));
    }

    // Kama ni Mteja (Customer)
    return view('chart.show', compact('job', 'messages', 'receiverId'));
}
}
