<?php

namespace App\Mail\email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
  use Queueable, SerializesModels;

  public $mail;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($mail)
  {
    $this->mail = $mail;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {

    return $this->from('noreply@isdb-bisew.org')
      ->subject($this->mail->subject)
      ->markdown('admin.mail.contact-reply');

    //      ->with(
    //        [
    //          'testVarOne' => '1',
    //          'testVarTwo' => '2',
    //        ])
    //      ->attach(public_path('/img/welcomenew.jpg'), [
    //        'as' => 'IsDB-BISEW.jpg',
    //        'mime' => 'image/jpeg',
    //      ]);
  }
}
