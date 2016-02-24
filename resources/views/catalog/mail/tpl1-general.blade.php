<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        Письмо от компании Golden Motors
    </title>
    <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        .content {width: 100%; max-width: 600px;}
    </style>
</head>
<body yahoo bgcolor="#ffffff">
<table width="100%" bgcolor="#ffffff" border="0" cellpadding="3" cellspacing="3" style="max-width: 680px; min-width: 300px;">
    <tr>
        <td>
            <table width="90%" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
                        Письмо с сайта <a href="http://new.goldenmotors.by"> new.goldenmotors.by </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>

            @if(isset($mail_data))
                <table width="90%" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                    @if(isset($mail_data['type']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Тип</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                {{ $mail_data['type'] }}
                            </td>
                        </tr>
                    @endif

                    @if(isset($mail_data['url']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Страница</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                <a href="{{ $mail_data['url'] or ''}}">
                                    {{ $mail_data['url'] != '' ? $mail_data['url'] : 'ошибка при получении' }}
                                </a>
                            </td>
                        </tr>
                    @endif

                    @if(isset($mail_data['name']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Имя</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                {{ $mail_data['name'] != '' ? $mail_data['name'] : 'не указано' }}
                            </td>
                        </tr>
                    @endif

                    @if(isset($mail_data['email']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Email</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                {{ $mail_data['email'] != '' ? $mail_data['email'] : 'не указан' }}
                            </td>
                        </tr>
                    @endif

                    @if(isset($mail_data['phone']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Телефон</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                {{ $mail_data['phone'] != '' ? $mail_data['phone'] : 'не указан' }}
                            </td>
                        </tr>
                    @endif

                    @if(isset($mail_data['price']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Своя цена</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                {{ $mail_data['price'] != '' ? $mail_data['price'] : 'не указана' }}
                            </td>
                        </tr>
                    @endif

                    @if(isset($mail_data['friend']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Email друга</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                {{ $mail_data['friend'] != '' ? $mail_data['friend'] : 'не указан' }}
                            </td>
                        </tr>
                    @endif

                    @if(isset($mail_data['date']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Желаемая дата</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                {{ $mail_data['date'] != '' ? $mail_data['date'] : 'не указана' }}
                            </td>
                        </tr>
                    @endif

                    @if(isset($mail_data['time']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Желаемое время</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                {{ $mail_data['time'] != '' ? $mail_data['time'] : 'не указано' }}
                            </td>
                        </tr>
                    @endif

                    @if(isset($mail_data['message']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Сообщение</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                {{ $mail_data['message'] }}
                            </td>
                        </tr>
                    @endif

                    @if(isset($mail_data['comment']))
                        <tr>
                            <td width="30%" style="max-width: 100px; min-width: 70px">
                                <b>Комментарий</b>
                            </td>
                            <td width="70%" style="max-width: 200px; min-width: 70px">
                                {{ $mail_data['comment'] != '' ? $mail_data['comment'] : 'отсутствует' }}
                            </td>
                        </tr>
                    @endif
                </table>
            @endif

        </td>
    </tr>
</table>
</body>
</html>