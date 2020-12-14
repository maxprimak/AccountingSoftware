<?php

namespace Modules\Goods\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Modules\Goods\Entities\Good;
use Modules\Goods\Entities\GoodHasPrices;
use Modules\Goods\Entities\PartsTranslation;
use Modules\Warehouses\Entities\Warehouse;
use Modules\Warehouses\Entities\WarehouseHasGood;

class GoodsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $brand = $this->brand;
        $model = $this->model;
        $submodel = $this->submodel;
        $part = $this->part;
        $color = $this->color;
        $warehouseHasGood = $this->warehouseHasGood;

        $warehouseHasGood = $warehouseHasGood->first();
        $warehouse = $warehouseHasGood->warehouse;

        $goods_has_prices = $this->goodHasPrices;

        $goods_has_prices = $goods_has_prices->first();
        if( $warehouseHasGood->barcode ){
            $barcode = [
                "id" => $warehouseHasGood->barcode->id,
                "value" => $warehouseHasGood->barcode->value,
                "format" => $warehouseHasGood->barcode->format,
                "barcodeUrl" => $warehouseHasGood->barcode->barcodeUrl,
            ];
        } else {
            $barcode = [
                "id" => null,
                "value" => null,
                "format" => null,
                "barcodeUrl" => null,
            ];
        }

        return [
            'id' => $this->id,
            'brand_name' => $brand->name,
            'brand_id' => $brand->id,
            'model_name' => $model->name,
            'model_id' => $model->id,
            'submodel_name' => $submodel->name,
            'submodel_id' => $submodel->id,
            'part_name' => PartsTranslation::find($part->id)->name,
            'part_id' => $part->id,
            'color_name' => $color->name,
            'color_id' => $color->id,
            'color_hexcode' => $color->hex_code,
            "warehouse_has_good_id" => $warehouseHasGood->id,
            "vendor_code" => $warehouseHasGood->vendor_code,
            "amount" => $warehouseHasGood->amount,
            "barcode" => $barcode,
            'warehouse_name' => $warehouse->name,
            "price" => [
                "supplier_id" => $goods_has_prices->supplier_id,
                "retail_price" => $goods_has_prices->retail_price,
                "wholesale_price" => $goods_has_prices->wholesale_price
            ],
        ];
    }
}
