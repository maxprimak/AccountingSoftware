<?php

namespace Modules\Suppliers\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mail;
use Modules\Suppliers\Emails\SupplierOrderEmail;

class SupplierOrderNotificationsController extends Controller
{

    public function email(Request $request)
    {
        Mail::to($request->to)->send(new SupplierOrderEmail($request));

        return response()->json(["success" => true, "message" => "sent"]);
    }

    public function whatsapp()
    {
        return view('suppliers::create');
    }
}
