<?php

namespace Modules\Companies\Rules;

use Illuminate\Contracts\Validation\Rule;

class SubscriptionRule implements Rule
{

    public $message = 'Your subscription plan does not allow you to perform this action.';
    public $message_orders = " You have reached the orders limit.";
    public $message_branches = " You have reached the branches limit.";
    public $message_employees = " You have reached the employees limit.";

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

    public $company;
    public $plan_name;
    public $orders_this_month_number;
    public $branches_number;
    public $employees_number;

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
        $this->company = auth('api')->user()->getCompany();
        $this->plan_name = $this->company->getStripePlanName();

        $this->orders_this_month_number = $this->company->getRepairOrdersThisMonthNumber();
        $this->branches_number = $this->company->getBranchesNumber();
        $this->employees_number = $this->company->getEmployeesNumber();
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
        return true;
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
