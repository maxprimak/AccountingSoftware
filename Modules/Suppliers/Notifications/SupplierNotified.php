<?php

namespace Modules\Suppliers\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Suppliers\Entities\WhatsAppChannel;
use Modules\Suppliers\Entities\WhatsAppMessage;

class SupplierNotified extends Notification
{
    use Queueable;
  
  public function __construct()
  {
    
  }
  
  public function via($notifiable)
  {
    return [WhatsAppChannel::class];
  }
  
  public function toWhatsApp($notifiable)
  {
    return (new WhatsAppMessage)
            ->content("hello");
  }
}
