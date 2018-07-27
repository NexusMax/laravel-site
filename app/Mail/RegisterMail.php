<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Illuminate\Contracts\Mail\Mailable as MailableContract;
use Illuminate\Container\Container;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;
    public $hash;

    public $to = [['address' => 'info@sportcasta.com', 'name' => 'Sport Casta']];
    public $from = [['address' => 'info@sportcasta.com', 'name' => 'Sport Casta']];
    public $replyTo = [['address' => 'info@sportcasta.com', 'name' => 'Sport Casta']];


    public function send(MailerContract $mailer)
    {
        Container::getInstance()->call([$this, 'build']);

        $mailer->send($this->buildView(), $this->buildViewData(), function ($message) {
            $this->from('info@sportcasta.com', 'Sport Casta')
                ->buildRecipients($message)
                ->buildSubject($message)
                ->buildAttachments($message)
                ->runCallbacks($message);
        });
    }
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $password, $hash)
    {
        $this->email = $email;
        $this->password = $password;
        $this->hash = $hash;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('vendor.mail.html.register')
            ->with([
                'name' => $this->email,
                'password' => $this->password,
                'actionUrl' => route('confirm', ['hash' => $this->hash],true),
            ])
            ->subject('Подтверждения регистрации');
    }
}
