<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MailController extends Controller {

	public function index1()
	{
        return 123;

        $files = [
            'logo' =>  public_path().'/theme/assets/admin/layout/img/logo-big.png'
        ];

        $mailData['files'] = $files;

        $mailData['type'] = '';
        return view('email.index', $mailData);

        $mailData['type'] = 'mail';

        $company = Companies::find(\Auth::user()->company_id);
        $techMail = json_decode($company->techMail, 1);

        $transport = \Mail::getSwiftMailer()->getTransport();
        $transport->setUsername($techMail['username']);
        $transport->setPassword($techMail['password']);
        $transport->setHost($techMail['host']);
        $transport->setPort($techMail['port']);

        \Mail::send('emails.email_template4.index', $mailData, function($message) use( $mail, $id, $techMail )
        {
            $message->from($techMail['username'], 'ГрузовичкоФ');
            $message->to($mail, 'Компания ГрузовичкоФ')->subject("Предложение по переезду");
        });

        $application = Application::find($id);
        $application->mailStatus = 1;
        $application->save();

        return $mail;
	}
}
