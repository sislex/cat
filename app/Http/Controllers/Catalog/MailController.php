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
        $mailData['type'] = 'mail';

        $transport = \Swift_SmtpTransport::newInstance('smtp.yandex.ru', 465, 'ssl');
        $transport->setUsername('sislex@ya.ru');
        $transport->setPassword('Yerkjy44');

        $yandex = new \Swift_Mailer($transport);
        \Mail::setSwiftMailer($yandex);

        \Mail::send('catalog.mail.index', $mailData, function($message)
        {
            $message->from('sislex@ya.ru', 'MailController');
            $message->to('lexa-mail@tut.by', 'Lexa-The-Tester')->subject("[new.goldenmotors.by] тестирование почты");
        });

        return 'the mail is sent';
    }

}
