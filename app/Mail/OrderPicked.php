<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPicked extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $courier;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$courier)
    {
        $this->order = $order;
        $this->courier = $courier;
        $this->subject = '[ROSISTIREM] Pedido '.$order->reference;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('webserver@rosistirem.com','Web Server Rosistirem.com')->markdown('emails.orders.picked')->with('order',$this->order)->with('courier',$this->courier)
            ->attachData($this->order->getDocument('S'), $this->order->reference.'.pdf', ['mime'=>'application/pdf']);
    }
}
