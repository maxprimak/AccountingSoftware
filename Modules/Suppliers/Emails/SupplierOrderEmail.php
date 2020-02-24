<?php

namespace Modules\Suppliers\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Request;

class SupplierOrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->markdown('vendor.mail.text.message')
                    ->from('no-reply@relist.at')
                    ->with([
                        'slot' => $this->getText()
                    ])
                    ->subject($this->getSubject())
                    ->attach($this->request->file);
    }

    private function getSubject(){
        return "Supplier Order#TEST1 Info";
    }

    private function getText(){
        return "Branch 'BranchName' from company 'CompanyName' has Ordered to you following goods: iPhone 7 Display (2 pieces), iPhone 8 Battery(3 pieces).
                Comment of an employee of BranchName: Please do it really quickly guys!!!";
    }

}
