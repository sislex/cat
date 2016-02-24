<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >

</head>

<body style="padding: 0px; margin: 0px;">
<div id="mailsub" class="notification" align="center">

{{--<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"><tr><td align="center" bgcolor="#eff3f8">--}}


<!--[if gte mso 10]>
<table width="680" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<![endif]-->

<table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
	<tr><td>
	<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>
	</td></tr>

    <tr>
        <td align="center" bgcolor="#ffffff">
            <table width="90%" border="0" cellspacing="0" cellpadding="0" style="border-bottom: 1px solid #ccc">
                <tr>
                    <td align="left" style="width: 50%">
                        <a href="#" target="_blank" style="color: #596167;  font-size: 13px;">
                            <font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3" color="#596167">
                                {{--@if($type=='mail')--}}
                                    {{--<img src="{{ $message->embed($files['logo']) }}" class="img-responsive" alt=""/>--}}
                                {{--@else--}}
                                    {{--<img src="{{$files['logo_tpl'] }}" style="width: 100px" class="img-responsive" alt=""/>--}}
                                {{--@endif--}}
                            </font>
                        </a>
                    </td>
                    <td>
                        Письмо с сайта
                    </td>

                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" bgcolor="#ffffff">
            @if(isset($mail_data))
                @foreach($mail_data as $mail_item)
                    <p> {{ $mail_item }} </p>
                @endforeach
            @endif
        </td>
    </tr>
</table>
<!--[if gte mso 10]>
</td></tr>
</table>
<![endif]-->

</td></tr>
</table>

</div>
</body>
</html>
