<?php

namespace App\Mail;

use app\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCheck extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user.mail.user.check')
            ->subject('Email Check')
            ->with([
                'name' => $this->user->name,
                'email' => $this->user->email,
                'phone' => $this->user->phone,
                'sex' => $this->user->sex,
                'address' => $this->user->address,
                'href' => APP_URL . 'check/?token=' . $this->user->create_token . '&user=' . $this->user->email,
            ]);
    }
}
