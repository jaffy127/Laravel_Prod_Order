<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    
    public function contactoIndex()
    {
    	return view('sistema.contacto.contacto');
    }

    public function sendMail_Contacto($data_json)
    {
    	Mail::raw($data_json->contacto_mensaje, function($message) use ($data_json){

    		$message->subject($data_json->contacto_mensaje);
    		$message->from($data_json->contacto_email);    		
			//$message->to(env('CONTACT_MAIL'), env('CONTACT_NAME'));
            $message->to('jafeth127@gmail.com','Jafet Ortiz');

		});

		return ["status"=>"correcto", "mensaje"=>"Datos Guardados Correctamente"];
    }

    public function ajaxContacto(Request $request)
    {
    	$data_post = array();
    	if(!empty($request->datos)){
    		$data_post = json_decode(json_encode($request->datos));
    	}

    	if(!empty($request) && !empty($request->accion)){

    		switch ($request->accion) {
    			case 'SendEmailContacto':
    				return $this->sendMail_Contacto($data_post);
    				break;

    			default:
    				# code...
    				break;
    		}

    	}
    }
}
