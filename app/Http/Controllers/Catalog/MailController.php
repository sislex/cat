<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\UIComponents;

class MailController extends Controller
{
    public function index()
    {

        $files = [
            'logo' =>  public_path().'/images/ui-components/logo/'.UIComponents::getLogo(),
            'logo_tpl' =>  '/images/ui-components/logo/'.UIComponents::getLogo(),
        ];

        $mailData['files'] = $files;

        $mailData['type'] = '';
//        return view('catalog.mail.index', $mailData);

        $mailData['type'] = 'mail';


        \Mail::send('catalog.mail.index', $mailData, function($message)
        {
            $message->from('sislex@ya.ru', 'ГрузовичкоФ');
            $message->to('lexa-mail@tut.by', 'Компания ГрузовичкоФ')->subject("Предложение по переезду");
        });

        return 'sent';
    }

}
