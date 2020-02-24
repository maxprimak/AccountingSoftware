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
                        'slot' => $this->request->text
                    ])
                    ->subject('attachments')
                    ->attach($this->request->file);
    }
}
