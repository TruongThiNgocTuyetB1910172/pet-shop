<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;



    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'client.email.order-mail',
            with: [
                'shippingAddress' => $this->order->shipping_address,
              'total' => $this->order->total,
              'trackingNumber' => $this->order->tracking_number,
              'notes' => $this->order->notes,
              'status' => $this->order->status,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
