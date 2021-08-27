<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class cotizaEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Cotizacion notificacion";
    //protected $datos;
    public $pdf;
    
    public function __construct($pdf){
        //$this->datos = $data;
        $this->pdf = $pdf;
    }


    public function build(){
        return $this->view('emails.cotizaEmail')->attachData($this->pdf,'cotizacion.pdf');
    }
}
