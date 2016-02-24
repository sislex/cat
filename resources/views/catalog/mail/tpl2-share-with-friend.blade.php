<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        Компания Golden Motors
    </title>
    <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        .content {width: 100%; max-width: 600px;}
    </style>
</head>
<body yahoo bgcolor="#ffffff">
    <p>
        Здравсвуйте.
    </p>
    <p>
        Это автоматическое письмо, отправленное с сайта <a href="http://new.goldenmotors.by">new.goldenmotors.by</a> . <br>
        Пользователь <i>{{ trim($mail_data['name']) != '' ? $mail_data['name'] : 'имя не указано'}} ({{ trim($mail_data['email']) != '' ? $mail_data['email'] : 'email не указан' }})</i>
        предлагает Вам взглянуть на один из товаров в нашем каталоге.
    </p>
    <p>
        @if(trim($mail_data['url']))
            Ссылка: <a href="{{ $mail_data['url'] }}">{{ $mail_data['url'] }}</a> <br><br>
        @endif
        @if(trim($mail_data['message']) != '')
            Сообщение от <i>{{ $mail_data['name'] }}</i>: <br> - <i>{{ $mail_data['message'] }}</i>
        @endif
    </p>
    <p>
        Если это письмо попало к Вам по ошибке, то приносим свои извинения за причиненные неудобства.
    </p>
    <p>
        С уважением, <br>компания Golden Motors
    </p>
</body>
</html>