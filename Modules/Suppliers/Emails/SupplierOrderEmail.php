<?php

namespace Modules\Suppliers\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Suppliers\Entities\SupplierOrder;
use Request;

class SupplierOrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $request;
    private $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
        $this->order = SupplierOrder::find($request->orders_to_supplier_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   

        $file = $this->request->file('file');
        $originalname = $file->getClientOriginalName();

        $result = $this->markdown('vendor.mail.text.message')
                    ->from('no-reply@relist.at')
                    ->with([
                        'slot' => $this->getText()
                    ])
                    ->subject($this->getSubject())
                    ->attach(storage_path('app/' . $this->request->file('file')->storeAs('public', $originalname)));
        
        return $result;

    }

    private function getSubject(){
        return "Supplier Order#" . $this->order->id . " Info";
    }

    private function getText(){
        return $this->request->text;
    }

}
