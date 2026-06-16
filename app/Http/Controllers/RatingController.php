<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobRequest;

class RatingController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $job = JobRequest::findOrFail($id);

        $job->update([
            'rating' => $request->rating,
            'review' => $request->comment,
        ]);

        return redirect()->route('home.page')
            ->with('success', 'Thank you for your feedback!');
    }
}