<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewFollower extends Mailable
{
    use Queueable, SerializesModels;

    public $follower;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Hey ! Someone has just followed you !')
            ->markdown('mails.new-follower');
    }
}
