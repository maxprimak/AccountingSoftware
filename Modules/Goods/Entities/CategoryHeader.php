<?php

namespace Modules\Goods\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryHeader extends Model
{
    protected $fillable = ['name','description'];
}
