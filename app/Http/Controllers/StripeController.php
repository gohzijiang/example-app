<?php

namespace App\Http\Controllers;

use Stripe;

use Illuminate\Http\Request;

class PaymentController extends Controller
{

     public function paymentPost(Request $request)
    {
	       
	Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->total_price *100,   // RM10  10=10 cen 10*100=1000 cen
                "currency" => "MYR",
                "source" => $request->stripeToken,
                "description" => "This payment is testing purpose of southern online",
        ]);
        return redirect()->route('welcome')->with('success', 'Payment successful');
    }
    
}
