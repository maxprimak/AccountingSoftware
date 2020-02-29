<?php

namespace Modules\Suppliers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mail;
use Modules\Suppliers\Emails\SupplierOrderEmail;
use Modules\Suppliers\Entities\Supplier;
use Modules\Suppliers\Entities\SupplierOrder;
use Modules\Suppliers\Notifications\SupplierNotified;

class SupplierOrderNotificationsController extends Controller
{

    public function email(Request $request)
    {   
        $order = SupplierOrder::find($request->orders_to_supplier_id);
        $supplier = Supplier::find($order->supplier_id);
        $to = $supplier->email;
        Mail::to($to)->send(new SupplierOrderEmail($request));

        return response()->json(["success" => true, "message" => "sent"]);
    }

    public function whatsapp(Request $request)
    {
        Supplier::find($request->supplier_id)->notify(new SupplierNotified());

        return response()->json(["success" => true, "message" => "notified"]);
    }
}
