<?php

namespace App\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;
use Laravel\Scout\Searchable;
use Modules\Goods\Entities\Brand;
use Modules\Goods\Entities\Models;
use Modules\Goods\Entities\PartsTranslation;
use Modules\Goods\Entities\Submodel;
use Modules\Warehouses\Entities\WarehouseHasGood;

class Goods extends Aggregator
{
    /**
     * The names of the models that should be aggregated.
     *
     * @var string[]
     */
    protected $models = [
        Submodel::class,
        PartsTranslation::class,
        Brand::class,
        Models::class,
        WarehouseHasGood::class
    ];

    /**
     * Map of model relations to load.
     *
     * @var string[]
     */
    protected $relations = [
        Submodel::class => ['goods'],
        PartsTranslation::class => ['goods'],
        Brand::class => ['goods'],
        Models::class => ['goods'],
        WarehouseHasGood::class => ['goods'],
    ];

//    public function shouldBeSearchable()
//    {
//        // Check if the class uses the Searchable trait before calling shouldBeSearchable
//        if (array_key_exists(Searchable::class, class_uses($this->model))) {
//            return $this->model->shouldBeSearchable();
//        }
//    }
}
