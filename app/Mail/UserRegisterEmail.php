<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterEmail extends Mailable{
	use Queueable, SerializesModels;
	public $user;
	public function __construct($user){
		$this->user = $user;
	}
	public function build(){
		return $this->from(config('mail.from.address'), 'Pepper')
					->subject('Registro en Pepper')
					->view('mails.user_register')
					->text('mails.user_register_plain');
	}
}