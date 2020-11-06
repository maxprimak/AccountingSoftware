<?php

namespace Modules\Companies\Rules;

use Illuminate\Contracts\Validation\Rule;

class SubscriptionRuleBranches extends SubscriptionRule
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
        $company = auth('api')->user()->user->company;
        if($this->plan_name == "free"){
            if(!$this->checkRule($this->branches_number, SubscriptionRule::$free_branches_number, $this->message_branches)) return false;
            return true;
        }
        else if($this->plan_name == "startup"){
            if(!$this->checkRule($this->branches_number, SubscriptionRule::$startup_branches_number, $this->message_branches)) return false;
            return true;
        }
        else if($this->plan_name == "pro"){
            $this->incrementProNumbersIfExtraBranches($company);
            if(!$this->checkRule($this->branches_number, $this->pro_branches_number, $this->message_branches)) return false;
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
