<?php

namespace Modules\Barcodes\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Barcode extends Model
{
    protected $guarded = [];

    use Searchable;
}
