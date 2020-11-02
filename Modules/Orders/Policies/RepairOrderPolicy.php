<?php

namespace Modules\Orders\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Orders\Entities\RepairOrder;

class RepairOrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(RepairOrder $repairOrder)
    {
        dd('I am here');
    }
}
