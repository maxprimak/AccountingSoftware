<?php

namespace Modules\Customers\Entities;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = ['person_id', 'stars_number','type_id','company_id'];
}
