<!doctype html>
<html lang="en-US">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
</head>
<body style="margin: 0px;">
<table style="background-color: #f2f3f8; margin:0 auto;">
    <tr>
        <td style="height:80px;">&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                <tr>
                    <td style="height:40px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="padding:0 35px;">
                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;">
                            {{trans('admin/admin_service/login.reset_email_reset_message_header')}}
                        </h1>
                        <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">{{trans('admin/admin_service/login.reset_email_reset_message_body')}}</p>
                        <a href="{{ route("admin.login.reset",$details['reset_token']) }}" target="_blank" style="background:#3b7ddd;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 50px;display:inline-block;border-radius:4px;">
                            {{trans('admin/admin_service/login.reset_email_password_button')}}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="height:40px;">&nbsp;</td>
                </tr>
            </table>
        </td>
    <tr>
        <td style="height:20px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="text-align:center;">
            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>{{env('APP_URL','')}}</strong></p>
        </td>
    </tr>
    <tr>
        <td style="height:80px;">&nbsp;</td>
    </tr>
</table>
</body>
</html>
