<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LawyerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = $this->view('front.email.link_lawyer', ['data' => $this->data]);
        $view->subject('Legalización de Documento');
        if(!empty($this->data["data_attached"])){
            foreach($this->data["data_attached"] as $k => $v){
                $mail = $view->attach($v, [
                    //'as' => $v["as"],
                    'mime' => 'application/pdf',
                ]);
            }
        }
        return $view;
    }
}
