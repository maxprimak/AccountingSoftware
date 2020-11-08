<?php

namespace Modules\Companies\Rules;

use Illuminate\Contracts\Validation\Rule;

class SubscriptionRuleRepairOrders extends SubscriptionRule
{
    public $orders_left;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute = null, $value = null)
    {
        if($this->plan_name == "free"){
            $this->orders_left = SubscriptionRule::$free_orders_number - $this->orders_this_month_number;
            if(!$this->checkRule($this->orders_this_month_number, SubscriptionRule::$free_orders_number, $this->message_orders)) return false;
            return true;
        }
        else if($this->plan_name == "startup"){
            $this->orders_left = SubscriptionRule::$startup_orders_number - $this->orders_this_month_number;
            if(!$this->checkRule($this->orders_this_month_number, SubscriptionRule::$startup_orders_number, $this->message_orders)) return false;
            return true;
        }
        else if($this->plan_name == "pro"){
            $this->orders_left = 1000000;
            return true;
        }
        else if($this->plan_name == "enterprise"){
            $this->orders_left = 1000000;
            return true;
        }
        else{
            $this->message .= " Your plan was not detected";
            return false;
        }
    }
}
