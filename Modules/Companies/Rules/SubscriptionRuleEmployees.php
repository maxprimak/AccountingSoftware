<?php

namespace Modules\Companies\Rules;

use Illuminate\Contracts\Validation\Rule;

class SubscriptionRuleEmployees extends SubscriptionRule
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
            if(!$this->checkRule($this->employees_number, SubscriptionRule::$free_employees_number, $this->message_employees)) return false;
            return true;
        }
        else if($this->plan_name == "startup"){
            if(!$this->checkRule($this->employees_number, SubscriptionRule::$startup_employees_number, $this->message_employees)) return false;
            return true;
        }
        else if($plan_name == "pro"){
            $this->incrementProNumbersIfExtraBranches($company);
            if(!$this->checkRule($this->employees_number, $this->pro_employees_number, $this->message_employees)) return false;
            return true;
        }
        else if($plan_name == "enterprise"){
            return true;
        }
        else{
            $this->message .= " Your plan was not detected";
            return false;
        }
    }
}
