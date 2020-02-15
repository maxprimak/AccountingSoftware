<?php

namespace Modules\Companies\Rules;

use Illuminate\Contracts\Validation\Rule;

class SubscriptionRuleRepairOrders extends SubscriptionRule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if($this->plan_name == "free"){
            if(!$this->checkRule($this->orders_this_month_number, SubscriptionRule::$free_orders_number, $this->message_orders)) return false;
            return true;
        }   
        else if($this->plan_name == "startup"){
            if(!$this->checkRule($this->orders_this_month_number, SubscriptionRule::$startup_orders_number, $this->message_orders)) return false;
            return true;
        }
        else if($this->plan_name == "pro"){
            return true;
        }
        else if($this->plan_name == "enterprise"){
            return true;
        }
        else{
            $this->message .= " Your plan was not detected";
            return false;
        }
    }
}
