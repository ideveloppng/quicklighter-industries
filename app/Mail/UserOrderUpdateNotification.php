<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserOrderUpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $order;

    /**
     * The notification type (e.g., CONFIRMATION, PAYMENT_APPROVED, LOGISTICS_UPDATE)
     *
     * @var string
     */
    public $type;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, $type = 'LOGISTICS_UPDATE')
    {
        $this->order = $order;
        $this->type = $type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Define subject based on technical context
        $subjectPrefix = 'QUICKLIGHTER LOGISTICS';
        
        switch ($this->type) {
            case 'CONFIRMATION':
                $subject = "{$subjectPrefix}: DEPLOYMENT LOGGED - #{$this->order->order_number}";
                break;
            case 'PAYMENT_APPROVED':
                $subject = "{$subjectPrefix}: FINANCIAL CLEARANCE GRANTED - #{$this->order->order_number}";
                break;
            case 'PAYMENT_REJECTED':
                $subject = "{$subjectPrefix}: FINANCIAL DISPUTE ALERT - #{$this->order->order_number}";
                break;
            default:
                $subject = "{$subjectPrefix}: STATUS UPDATE - #{$this->order->order_number}";
                break;
        }

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.user-order-update',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}