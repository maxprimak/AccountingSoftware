<?php

namespace Modules\Companies\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Companies\Http\Requests\PaymentRequest;
use \Stripe\Stripe;
use \Stripe\Token;
use \Stripe\PaymentMethod;
use \Stripe\PaymentIntent;
use Carbon\Carbon;

class PaymentController extends Controller
{

    public function store(PaymentRequest $request){

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $company = auth('api')->user()->getCompany();
        $plan_identifier = $request->plan_id;

        if($plan_identifier == env('FREE_PLAN_STRIPE_ID')){
            $company->changeSubscription(env('FREE_PLAN_STRIPE_ID'), null);
            return response()->json(['message' => 'Successfully subscribed!']);
        }

        $payment_method = PaymentMethod::retrieve(
            $request->payment_method
        );

        $company->updateDefaultPaymentMethod($payment_method);

        if($plan_identifier == env('STARTUP_PLAN_STRIPE_ID')){
            $company->changeSubscription(env('STARTUP_PLAN_STRIPE_ID'), $payment_method);
        }
        else if($plan_identifier == env('PRO_PLAN_STRIPE_ID')){
            $company->changeSubscription(env('PRO_PLAN_STRIPE_ID'), $payment_method);
            if($request->has('extra_branches_amount') && $request->extra_branches_amount > 0){
                $amount = $request->extra_branches_amount;
                if($company->hasExtraBranches()){
                    $company->updateExtraBranchesAmount($amount);
                }
                else{
                    $company->addExtraBranchesSubscription($amount);
                }
            }
        }
        else if($plan_identifier == env('ENTERPRISE_PLAN_STRIPE_ID')){
            $company->changeSubscription(env('ENTERPRISE_PLAN_STRIPE_ID'), $payment_method);
        }
        else{
            response()->json(['message' => 'Plan identifier invalid'], 403);
        }

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
