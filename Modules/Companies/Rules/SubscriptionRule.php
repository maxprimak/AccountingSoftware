<?php

namespace Modules\Companies\Rules;

use Illuminate\Contracts\Validation\Rule;

class SubscriptionRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $company = auth('api')->user()->getCompany();

        if($company->subscribedToPlan('main', env('ENTERPRISE_PLAN_STRIPE_ID'))){
            return $this->checkEnterprisePlan();
        }
        elseif($company->subscribedToPlan('main', env('PRO_PLAN_STRIPE_ID'))){
        
        }
        elseif($company->subscribedToPlan('main', env('STARTUP_PLAN_STRIPE_ID'))){
        
        }
        elseif($company->subscribedToPlan('main', env('FREE_PLAN_STRIPE_ID'))){
        
        }
        else{

        }

    }

    private function checkEnterprisePlan(){
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your subscription plan does not allow you to perform this action. You can not create more';//write more of what?
    }
}
