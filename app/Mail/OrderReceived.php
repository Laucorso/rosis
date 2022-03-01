<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderReceived extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->subject = '[ROSISTIREM] Nuevo pedido web '.$order->reference;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('webserver@rosistirem.com','Web Server Rosistirem.com')->markdown('emails.orders.received')->with('order',$this->order)
            ->attachData($this->order->getDocument('S'), $this->order->reference.'.pdf', ['mime'=>'application/pdf']);
    }
}
