<!doctype html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta charset="utf-8">
    <title>@lang('web.verify_email.page_title')</title>
    <!-- build:maincss -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- endbuild -->
    <!--[if (gte mso 9)|(IE)]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <style type="text/css">
        .o_of { float: left; }
        .o_ereset a, .o_esec .o_inline { vertical-align: middle; }
    </style>
    <![endif]-->
</head>
<body class="o_ebody">
<table class="o_esec" role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
    <tbody>
    <tr>
        <td class="o_ereset o_bg-dark o_pt-lg o_px" align="center">
            <!--[if mso]>
            <table role="presentation" width="608" border="0" cellspacing="0" cellpadding="0" align="center">
                <tbody>
                <tr>
                    <td align="left">
            <![endif]-->
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 608px;">
                <tbody>
                <tr>
                    <td class="o_ereset o_bg-center o_b-default o_br o_px-md o_py-lg" align="left" background="{{asset('assets/images/hero_dots.png')}}">
                        <!--[if mso]>
                        <table role="presentation" width="552" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                            <tr>
                                <td colspan="2" width="552" align="left" style="padding: 0 8px;">
                        <![endif]-->
                        <div class="o_px-xs">
                            <p class="o_text o_text-sans"><a class="o_text-dark o_link" href="#"><img src="{{asset('assets/images/logo.png')}}" width="52" height="44" alt="TL;DR" style="max-width: 52px;" /></a></p>
                            <div style="font-size: 16px; line-height: 16px; height: 16px;">&nbsp; </div>
                        </div>
                        <!--[if mso]>
                        </td>
                        </tr>
                        <tr>
                            <td width="424" align="left" style="padding: 0 8px;">
                        <![endif]-->
                        <div class="o_col o_col-oo o_col-xs-4 o_of">
                            <div class="o_px-xs">
                                <p class="o_text-lg o_text-sans o_text-muted o_mb-xs">@lang('web.verify_email.hello'),</p>
                                <h1 class="o_text-headline o_text-dark">@lang('web.verify_email.title1') <span class="o_text-accent">@lang('web.verify_email.title_highlight')</span> @lang('web.verify_email.title2')</h1>
                            </div>
                        </div>
                        <!--[if mso]>
                        </td>
                        <td width="128" align="left" style="padding: 0 8px;">
                        <![endif]-->
                        <div class="o_col o_col-o o_of">
                            <div class="o_px-xs">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                    <tr>
                                        <td style="font-size: 16px; line-height: 16px; height: 16px;">&nbsp; </td>
                                    </tr>
                                    <tr>
                                        <td class="o_bg-white o_text o_text-sans o_text-dark o_p-icon o_br-max">
                                            <img class="o_br-max" src="{{asset('assets/images/icon_mail.gif')}}" width="88" height="88" alt="Mail Envolope" style="max-width: 88px;" />
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--[if mso]>
                        </td>
                        </tr>
                        <tr>
                            <td colspan="2" width="552" align="left">
                        <![endif]-->
                        <div>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                <tr>
                                    <td class="o_bb-muted" style="font-size:24px; line-height: 24px; height: 24px;">&nbsp; </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--[if mso]>
                        </td>
                        </tr>
                        <tr>
                            <td colspan="2" width="552" align="left" style="padding: 0 8px;">
                        <![endif]-->
                        <div class="o_px-xs">
                            <p class="o_text-xs o_text-sans o_text-muted o_mt-md o_mb-md">@lang('web.verify_email.desc')</p>
                            <table class="o_btn" role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                <tr>
                                    <td class="o_pbtn o_text-md o_br-max o_bg-default" align="center">
                                        <a class="o_text-headline o_text-white" href="scannel://app/login/{{$user->email}}"><span>@lang('web.verify_email.button')</span></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--[if mso]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </td>
                </tr>
                </tbody>
            </table>
            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td class="o_ereset o_bg-dark" style="font-size: 24px; line-height: 24px; height: 24px;">&nbsp; </td>
    </tr>
    <tr>
        <td class="o_ereset o_bg-dark o_px-ng o_pt o_pb-lg" align="center">
            <!--[if mso]>
            <table role="presentation" width="536" border="0" cellspacing="0" cellpadding="0" align="center">
                <tbody>
                <tr>
                    <td align="left">
            <![endif]-->
            <div class="o_col-6s o_text-sans o_text-xs o_text-left"
                 style="font-family: Arial,&quot;Helvetica Neue&quot;,Helvetica,sans-serif;word-break: break-word;max-width: 536px;text-align: left;font-size: 14px;line-height: 21px;">
                <!--<p class="o_text-muted o_mb-lg" style="color: #687887;margin-top: 0px;margin-bottom: 32px;">If you didn't
                    enter this email address when signing up for TLDR monthly subscription, disregard this message. This
                    email was sent to <a class="o_text-muted" href="mailto:pierce.b@company.com"
                                         style="color: #687887;text-decoration: none;outline: none;display: inline-block;"><span
                            style="color: #687887;">pierce.b@company.com</span></a>. <a class="o_text-muted o_underline"
                                                                                        href="#"
                                                                                        style="color: #687887;text-decoration: underline;outline: none;display: inline-block;"><span
                            style="color: #687887;">Unsubscribe</span></a></p>-->
                <p class="o_text-headline o_text-xxs o_text-muted o_mb" style="font-family: Arial,&quot;Helvetica Neue&quot;,Helvetica,sans-serif;word-break: break-word;font-weight: bold;font-size: 12px;line-height: 19px;text-transform: uppercase;letter-spacing: 1px;color: #687887;margin-top: 0px;margin-bottom: 16px;">
                    <a class="o_text-dark o_link" href="{{config('scannel.scannel.privacy')}}" style="transition: all .15s ease-in;color: #212932;text-decoration: none;outline: none;display: inline-block;">
                        <span style="color: #212932;">@lang('web.footer.privacy')</span>
                    </a>
                    &nbsp; • &nbsp;
                    <a class="o_text-dark o_link" href="" style="transition: all .15s ease-in;color: #212932;text-decoration: none;outline: none;display: inline-block;">
                        <span style="color: #212932;">@lang('web.footer.imprint')</span>
                    </a>
                </p>
                <p class="o_text-muted" style="color: #687887;margin-top: 0px;margin-bottom: 0px;">
                    @if (now()->format('Y') == '2020')
                    &copy; 2020 Scannel GmbH
                    @else
                    &copy; 2020 - {{ now()->format('Y') }} Scannel GmbH
                    @endif
                    <br>
                    <a class="o_text-muted" href="#"
                       style="color: #687887;text-decoration: none;outline: none;display: inline-block;"><span
                            style="color: #687887;">Rotdornweg 50, 91126 Schwabach, Germany</span></a></p>
            </div>
            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
            <div class="o_hide-xs" style="font-size: 64px; line-height: 64px; height: 64px;">&nbsp; </div>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
