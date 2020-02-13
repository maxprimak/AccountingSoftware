<?php

namespace Modules\Companies\Rules;

use Illuminate\Contracts\Validation\Rule;

class SubscriptionRule implements Rule
{   

    private $message = 'Your subscription plan does not allow you to perform this action.'; 
    private $message_orders = " You have reached the orders limit.";
    private $message_branches = " You have reached the branches limit.";
    private $message_employees = " You have reached the employees limit.";

    public static $free_orders_number = 25;
    public static $free_branches_number = 1;
    public static $free_employees_number = 3;

    public static $startup_orders_number = 75;
    public static $startup_branches_number = 1;
    public static $startup_employees_number = 10;

    public static $branches_number_for_extra = 1;
    public static $employees_number_for_extra = 10;

    public $pro_branches_number = 1;
    public $pro_employees_number = 10;

    public function incrementProNumbersIfExtraBranches($company){
        if($company->hasExtraBranches()){
            $amount = $company->getExtraBranchesAmount();
            $this->pro_branches_number += SubscriptionRule::$branches_number_for_extra*$amount;
            $this->pro_employees_number += SubscriptionRule::$employees_number_for_extra*$amount;
        }
    }
    
    public function checkRule($comparable, $comparator, $message_to_add){
        if($comparable >= $comparator){
            $this->message .= $message_to_add;
            return false;
        }
        return true;
    }

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
        $plan_name = $company->getStripePlanName();

        $orders_this_month_number = $company->getRepairOrdersThisMonthNumber();
        $branches_number = $company->getBranchesNumber();
        $employees_number = $company->getEmployeesNumber();

        if($plan_name == "free"){
            if(!$this->checkRule($orders_this_month_number, SubscriptionRule::$free_orders_number, $this->message_orders)) return false;
            if(!$this->checkRule($branches_number, SubscriptionRule::$free_branches_number, $this->message_branches)) return false;
            if(!$this->checkRule($employees_number, SubscriptionRule::$free_employees_number, $this->message_employees)) return false;
            return true;
        }   
        else if($plan_name == "startup"){
            if(!$this->checkRule($orders_this_month_number, SubscriptionRule::$startup_orders_number, $this->message_orders)) return false;
            if(!$this->checkRule($branches_number, SubscriptionRule::$startup_branches_number, $this->message_branches)) return false;
            if(!$this->checkRule($employees_number, SubscriptionRule::$startup_employees_number, $this->message_employees)) return false;
            return true;
        }
        else if($plan_name == "pro"){
            $this->incrementProNumbersIfExtraBranches($company);
            if(!$this->checkRule($branches_number, $this->pro_branches_number, $this->message_branches)) return false;
            if(!$this->checkRule($employees_number, $this->pro_employees_number, $this->message_employees)) return false;
            return true;
        }
        else if($plan_name == "enterprise"){
            return true;
        }
        else{
            $message .= " Your plan was not detected";
            return false;
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
        return $this->message;
    }
}
