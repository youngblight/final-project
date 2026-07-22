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

        // Uhakiki wa data zinazoingia
        $request->validate([
            'payment_method' => 'nullable|string',
            'phone_number'   => 'required|digits:10',
            'pin'            => 'required|digits:4',
        ]);

        // Hakikisha bei imewekwa kabla ya kukokotoa
        if (!$job->agreed_price || $job->agreed_price <= 0) {
            return redirect()->back()
                ->with('error', 'Fundi bado hajaweka bei ya kazi hii au bei si sahihi.');
        }

        $total_amount  = $job->agreed_price;
        $amount_to_pay = $total_amount * 0.5; // Asilimia 50 ya malipo
        $new_status    = "";
        $message       = "";
        $show_rating   = false; 

        // Tumeruhusu 'accepted' PAMOJA na 'offer_sent' kwa ajili ya malipo ya awali
        if ($job->status == 'accepted' || $job->status == 'offer_sent') {
            $new_status  = 'in_progress'; 
            $message     = "Malipo ya awali ya 50% (Tsh " . number_format($amount_to_pay) . ") yamepokelewa. Fundi anaanza kazi sasa hivi!";
            $show_rating = false; 
        } elseif ($job->status == 'completed' || $job->status == 'in_progress') {
            $new_status  = 'fully_paid'; 
            $message     = "Malipo ya mwisho yamekamilika kikamilifu. Ahsante kwa kutumia Fundi Digital!";
            $show_rating = true; 
        } else {
            return redirect()->back()
                ->with('error', 'Hali ya sasa ya kazi hii hairuhusu kufanya malipo kwa sasa.');
        }

        $isSuccessful = true; // Kuiga (Simulate) kuwa malipo yamefanikiwa

        if ($isSuccessful) {
            try {
                DB::beginTransaction();

                // Kutengeneza kumbukumbu ya malipo
                Payment::create([
                    'job_request_id' => $job->id,
                    'user_id'        => auth()->id(),
                    'amount'         => $amount_to_pay,
                    'payment_method' => $request->payment_method ?? 'Tigo Pesa', 
                    'transaction_id' => 'FUNDI-' . strtoupper(Str::random(10)), 
                    'status'         => 'completed',
                ]);

                // Kunasibisha hali mpya ya kazi
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
                    ->with('error', 'Hitilafu ya kiufundi imetokea: ' . $e->getMessage());
            }
        }

        return redirect()->back()
            ->with('error', 'Muamala umefeli. Tafadhali jaribu tena.');
    }

    public function rateJob(Request $request, $id)
    {
        // Uhakiki wa maoni na nyota
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $job = JobRequest::findOrFail($id);

        // Kusasisha mfumo wa maoni
        $job->update([
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('home.page')
            ->with('success', 'Ahsante! Maoni yako yamechapishwa hadharani.');
    }
}