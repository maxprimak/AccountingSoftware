<?php

namespace Modules\Companies\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Stripe\Stripe;
use \Stripe\Token;
use \Stripe\PaymentMethod;
use \Stripe\PaymentIntent;
use Carbon\Carbon;

class PaymentController extends Controller
{

    public function store(Request $request){
        
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $payment_method = PaymentMethod::retrieve(
            $request->payment_method
        );

        $company = auth('api')->user()->getCompany();
        $company->addPaymentMethod($payment_method);

        $company->newSubscription('main', 'plan_GilybcUOngrYVe')
        ->trialUntil(Carbon::now()->addDays(14))
        ->create($payment_method);

        return response()->json(['message' => 'Successfully subscribed!']);

    }

    /*public function storeIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent = PaymentIntent::create([
            'amount' => 100,
            'currency' => 'eur',
        ]);
        $intent = $intent;

        return response()->json($intent);

    }

    public function attachMethod(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $payment_method = PaymentMethod::retrieve(
            $request->payment_method
          );

          $company = auth('api')->user()->getCompany();

          $payment_method->attach([
            'customer' => $company->stripe_id
          ]);

        return response()->json($request->payment_method);

    }*/

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('companies::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('companies::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
