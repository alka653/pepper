<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RevisionEmail extends Mailable{
	use Queueable, SerializesModels;
	public $user;
	public function __construct($user){
		$this->user = $user;
	}
	public function build(){
		return $this->from(config('mail.from.address'), 'Pepper')
					->subject('Resultado de revisión de solicitud')
					->view('mails.revision')
					->text('mails.revision_plain');
	}
}