<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function processPayment(Request $request, $jobId)
    {
        $job = JobRequest::findOrFail($jobId);

        $request->validate([
            'payment_method' => 'nullable|string',
            'phone_number'   => 'required|digits:10',
            'pin'            => 'required|digits:4',
        ]);

        $total_amount  = $job->agreed_price;
        $amount_to_pay = $total_amount * 0.5; 
        $new_status    = "";
        $message       = "";
        $show_rating   = false; 

        if ($job->status == 'accepted') {
            $new_status  = 'in_progress'; 
            $message     = "The 50% deposit (Tsh " . number_format($amount_to_pay) . ") has been received. The craftsman is starting work now!";
            $show_rating = false; 
        } elseif ($job->status == 'completed') {
            $new_status  = 'fully_paid'; 
            $message     = "Final payment completed successfully. Thank you for using Fundi Digital!";
            $show_rating = true; 
        } else {
            return redirect()->route('home.page')
                ->with('error', 'The current status of this job does not allow payments at this time.');
        }

        $isSuccessful = true; 

        if ($isSuccessful) {
            try {
                DB::beginTransaction();

                Payment::create([
                    'job_request_id' => $job->id,
                    'user_id'        => auth()->id(),
                    'amount'         => $amount_to_pay,
                    'payment_method' => $request->payment_method ?? 'Tigo Pesa', 
                    'transaction_id' => 'FUNDI-' . strtoupper(Str::random(10)), 
                    'status'         => 'completed',
                ]);

                $job->status = $new_status;
                $job->save();

                DB::commit();

                return redirect()->route('home.page')->with([
                    'payment_success' => $message,
                    'job_id'          => $job->id,
                    'show_rating'     => $show_rating 
                ]);

            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()
                    ->with('error', 'A technical error occurred: ' . $e->getMessage());
            }
        }

        return redirect()->back()
            ->with('error', 'Transaction failed. Please try again.');
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
            ->with('success', 'Thank you! Your feedback has been published publicly.');
    }
}