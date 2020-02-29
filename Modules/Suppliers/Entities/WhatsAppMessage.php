<?php

namespace Modules\Suppliers\Entities;

class WhatsAppMessage
{
  public $content;
  
  public function content($content)
  {
    $this->content = $content;

    return $this;
  }
}
