<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
        <title>HerramientasLegales | Email Notification User</title>
        <meta name="color-scheme" content="light dark">
        <meta name="supported-color-schemes" content="light dark">
        <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
        <link rel="preload" href="//fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" as="font" crossorigin>
        <style>
            body {
                background-color: #f1f1f1;
            }

            @media (prefers-color-scheme: dark) {
                .main_header {
                    background: #ffffff !important;
                    background-color: #fff !important;
                }
            }

            /* latin */
            @font-face {
                font-family: 'Roboto', sans-serif;
                font-style: normal;
                font-weight: 400;
                src: local('Roboto-Regular.ttf') format('ttf');
            }

            /* latin */
            @font-face {
                font-family: 'Roboto', sans-serif;
                font-style: normal;
                font-weight: 500;
                src: local('Roboto-Medium.ttf') format('ttf');
            }

            @font-face {
                font-family: 'Roboto', sans-serif;
                font-style: normal;
                font-weight: 700;
                src: local('Roboto-Bold.ttf') format('ttf');
            }

            /* A simple css reset */
            body,
            table,
            thead,
            tbody,
            tr,
            td,
            img {
                padding: 0;
                margin: 0;
                border: none;
                border-spacing: 0px;
                border-collapse: separate;
                vertical-align: top;
            }

            /* Add some padding for small screens */
            .wrapper {
                padding-left: 10px;
                padding-right: 10px;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            p {
                margin: 0;
                padding: 0;
                padding-bottom: 20px;
                line-height: 1.6;
                font-family: 'Roboto', sans-serif;
            }

            p,
            a,
            li {
                font-family: 'Roboto', sans-serif;
            }

            @media only screen and (max-width: 620px) {
                .wrapper .section {
                    width: 100%;
                }

                .wrapper .column {
                    width: 100%;
                    display: block;
                }

                .illu-img {
                    width: auto !important;
                }
            }

            @media only screen and (max-width: 600px) {
                .ma-des {
                    padding: 2em 25px 73px !important;
                }

                .center-text h3 {
                    /* font-size: 19px !important; */
                }

                .hl_header {
                    padding: 21px 7px 3px 20px !important;
                }

                .table-oprat {
                    /* text-align: center; */
                }

                .user-info {
                    padding: 0 4px !important;
                }
            }

            @media only screen and (max-width:400px) {
                .mvarify {
                    margin-right: 0;
                    margin-bottom: 14px;
                    display: block;
                }

                .table-oprat tbody tr td {
                    display: block;
                    margin: 0 auto;
                    max-width: 240px;
                    width: 100%;
                }

                .table-oprat tbody tr td a {
                    display: block !important;
                    max-width: 149px !important;
                    margin: 0 auto 10px !important;
                    margin-right: inherit !important;
                }

                .hl_header {
                    padding: 14px 16px 0px 10px !important;
                }

                .col-md-51 {
                    display: block;
                }

                .col-md-71 {
                    display: block;
                    margin-left: 31px;
                }
            }

            /* custom css begins*/
            .text.ma-des p {
                padding-right: 0em;
                font-size: 14px;
            }

            .ma-des {
                padding: 2em 60px 73px;
            }

            .heading-section p {
                margin: 0px;
                color: #231F20;
                font-size: 14px;
                padding-bottom: 10px;
            }

            .heading-section p a {
                color: #231F20;
                text-decoration: underline;
            }

            .ma-verify {
                /* border-radius: 4px;
            background: #6A0911;
            color: #ffffff;
            width: 100%;
            float: left;
            text-align: center;
            margin: 0.5em 0;
            font-size: 18px;
            font-weight: 500;
            text-decoration: none;
            padding: 10px 0px; */
            }

            .text.ma-des h2 {
                color: #231F20;
                font-size: 25px;
                margin-bottom: 0;
                line-height: 32px;
                font-family: 'Roboto', sans-serif;
            }

            .bg_light.email-section {
                padding: 1em 0.5em;
                background: #F5F5F5;
            }

            ol li {
                font-size: 14px;
                line-height: 26px;
            }

            .blue-shape-header {}

            .illu-img {
                width: 294px;
                margin: 0 auto;
            }

            .center-text {
                margin-top: 25px;
            }

            .center-text h3 {
                font-family: Roboto;
                font-size: 30px;
                font-weight: bold;
                font-stretch: normal;
                font-style: normal;
                line-height: normal;
                letter-spacing: normal;
                text-align: center;
                color: #323232;
                padding-bottom: 19px;
            }

            .center-text p {
                padding-bottom: 15px;
                font-family: Roboto;
                font-size: 14px;
                font-weight: normal;
                font-stretch: normal;
                font-style: normal;
                line-height: normal;
                letter-spacing: normal;
                color: #323232;
            }

            .center-text p span {
                color: #294f74 !important;
                font-weight: 500;
            }

            .center-text p span a {
                color: #294f74 !important;
                font-weight: 500;
                text-decoration: none !important;
            }

            .center-text p span.fn-bold {
                font-weight: 700;
            }

            .bt-operation {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 15px;
                flex-wrap: wrap;
            }

            .bt-operation .ma-verify {
                text-decoration: none;
                max-width: 133px;
                height: 30px;
                background: #294f74;
                color: #fff;
                font-size: 12px;
                font-weight: bold;
                font-stretch: normal;
                font-style: normal;
                line-height: normal;
                display: flex;
                letter-spacing: 0.75px;
                align-items: center;
                text-align: center;
                padding: 0px 8px 0 8px;
                margin: 0 10px;
                width: 100%;
                border-radius: 13px;
                ;
                margin-top: 10px;
            }

            .bt-operation .ma-verify:last-child {}

            .bt-operation .ma-verify img {
                width: 20px;
                height: 20px;
            }

            .bt-operation .ma-verify span {
                text-align: center;
                width: 100%;
            }

            .bt-operation .ma-verify:hover {
                background-color: #323232;
            }

            .main_header {
                width: 100%;
                max-width: 530px;
                background: #fff;
                position: relative;
                border-collapse: separate;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
                box-shadow: 0 2px 10px 2px rgba(194, 194, 194, 0.21), 10px 20px 20px 1px rgba(200, 200, 200, 0.28);
            }

            .hl_header {
                padding: 29px 33px 8px;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                position: relative;
                background-color: #fff;
                background-size: contain;
                background-position: right;
                background-repeat: no-repeat;
            }

            .logo_wrap {
                width: 55%;
                height: 24px;
                position: relative;
            }

            .logo_wrap img {
                position: absolute;
                right: 0;
                left: 0;
                width: 100%;
            }

            .blue-shape-header img {
                height: auto;
                width: 100%
            }

            .mvarify {
                background: #294f74;
                color: #fff !important;
                text-decoration: none;
                border-radius: 10px;
                min-width: 149px;
                display: inline-block;
                height: 20px;
                vertical-align: middle;
                padding-top: 6px;
                padding-bottom: 5px;
                line-height: 0;
                margin-right: 20px;
                transition: 0.3s ease-in-out;
            }

            .circle-download {
                width: 17px;
                vertical-align: middle;
                margin-right: 23px;
                margin-left: 13px;
            }

            .mvarify-text {
                text-align: center;
                font-size: 12px;
                font-weight: bold;
                color: #fff;
            }

            .mvarify2 {
                background: #294f74;
                color: #fff !important;
                text-decoration: none;
                border-radius: 10px;
                min-width: 149px;
                display: inline-block;
                height: 20px;
                vertical-align: middle;
                padding-top: 6px;
                padding-bottom: 5px;
                line-height: 0;
                transition: 0.3s ease-in-out;
            }

            .circle-download-2 {
                width: 17px;
                vertical-align: middle;
                margin-right: 12px;
                margin-left: 13px;
            }

            .mvarify-text-2 {
                text-align: center;
                font-size: 12px;
                font-weight: bold;
            }

            .mvarify:hover,
            .mvarify2:hover {
                background-color: #323232;
            }

            .a5q {
                display: none !important;
            }

            .legal-info-wrap .row {
                display: flex;
                flex-wrap: wrap;
                margin-bottom: 2.625rem;
                margin-left: 0;
                margin-right: 0;
            }

            .legal-info-wrap .row .col-md-5 {
                flex: 0 0 41.6666666667%;
                position: relative;
                width: 100%;
                min-height: 1px;
                max-width: 41.6666666667%;
            }

            .legal-info-wrap .row .col-md-7 {
                flex: 0 0 58.3333333333%;
                position: relative;
                width: 100%;
                min-height: 1px;
                max-width: 58.3333333333%;
            }

            .legal-info-wrap .row .user-legal-info {
                list-style: none;
                margin-top: 0;
                padding: 0;
                margin-bottom: 0;
                font-size: 14px;
                font-weight: normal;
                font-stretch: normal;
                font-style: normal;
                line-height: normal;
                letter-spacing: normal;
                font-family: Roboto;
                color: #323232;
                word-wrap: break-word;
            }

            .legal-info-wrap .row .user-legal-info li:not(:first-child) {
                margin-top: 6px;
            }

            .legal-info-wrap .row .col-md-5 .user-head-wi-ico img {
                width: 20px;
                height: 20px;
                margin-right: 0.5rem;
                vertical-align: middle;
            }

            .legal-info-wrap .row .col-md-5 .user-head-wi-ico {
                font-size: 14px;
                font-weight: 500;
                font-stretch: normal;
                font-style: normal;
                line-height: normal;
                letter-spacing: normal;
                font-family: Roboto;
                color: #323232;
            }

            .user-info {
                margin-top: 19px;
                padding: 0 22px;
            }

            a {
                color: #294f74 !important;
            }

            /* custom css ends*/
        </style>
    </head>

    <body>
    <table width="100%" style="  background-color: #f1f1f1;">
        <tbody>
            <tr>
                <td height="35" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
            </tr>
            <tr>
                <td class="wrapper" align="center" style="padding-left: 10px;
                  padding-right: 10px;">
                    <table class="section header main_header" cellpadding="0" cellspacing="0" width="100%" style="width: 100%;
                     max-width: 530px;
                     background: #fff;
                     background-color: #fff;
                     position: relative;
                     border-collapse: separate;
                     border-top-left-radius: 10px;
                     border-top-right-radius: 10px;
                     border-bottom-left-radius: 10px;
                     border-bottom-right-radius: 10px;
                     box-shadow: 0 2px 10px 2px rgba(194, 194, 194, 0.21), 10px 20px 20px 1px rgba(200, 200, 200, 0.28);">
                        <tr>
                            <td valign="top" class="bg_white hl_header" background="https://herramien.webc.in/front/assets/img/shape_blue-01.png" style="padding: 29px 33px 8px;
                           border-top-left-radius: 10px;
                           border-top-right-radius: 10px;
                           position: relative;
                           background-color: #fff;
                           background-size: contain;
                           background-position: right;
                           background-repeat: no-repeat;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td class="logo" style="text-align: left;">
                                            <div style=" margin-bottom: 0;padding-bottom: 0;">
                                                <div class="logo_wrap" style="width: 55%;
                                          height: 24px;
                                          position: relative;">
                                                    <a href="#" style="cursor: default;">
                                                        <img style="width: 100%;" src="https://herramien.webc.in/front/assets/img/logo-horizontal.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- end tr -->
                        <tr>
                            <td valign="middle" class="hero bg_white">
                                <table style="width: 100%;">
                                    <tr>
                                        <td>
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td>
                                                        <div class="text ma-des" style="text-align: left;padding: 2em 60px 37px;">
                                                            <div class="illu-img" style="width: 294px;
                                                   margin: 0 auto;">
                                                                <a href="#" style="cursor:default!important;">
                                                                    <img src="{{ $message->embed(asset('storage/'.$data['document_image']))}}" style="width: 100%;height:100%;cursor:default!important;    max-width: 300px;
                                                      margin: 0 auto;
                                                      display: block;    height: 100%;
                                                      max-height: 300px;
                                                      " />
                                                                </a>
                                                            </div>
                                                            <div class="center-text" style="    margin-top: 25px;">
                                                                <h3 style="    font-family: Roboto;
                                                      font-size: 30px;
                                                      font-weight: bold;
                                                      font-stretch: normal;
                                                      font-style: normal;
                                                      line-height: normal;
                                                      letter-spacing: normal;
                                                      padding-bottom:0;
                                                      text-align: center;
                                                      color: #323232;
                                                      margin-bottom: 19px;
                                                      ">Legalización de Documento</h3>
                                                                <p style="    padding-right: 0em;
                                                      font-size: 14px;margin-bottom: 15px;
                                                      padding-bottom:0;
                                                      font-family: Roboto;
                                                      font-weight: normal;
                                                      margin-top:0;
                                                      font-stretch: normal;
                                                      font-style: normal;
                                                      line-height: normal;
                                                      letter-spacing: normal;
                                                      color: #323232;">
                                                                    ¡Hola <span class="fn-bold" style="    color: #294f74!important;
                                                         font-weight: 500;">{{$data['user_name']}}!</span>
                                                                </p>
                                                                <p style="margin-bottom: 15px;
                                                      padding-bottom:0;
                                                      margin-top:0;
                                                      font-family: Roboto;
                                                      font-size: 14px;
                                                      font-weight: normal;
                                                      font-stretch: normal;
                                                      font-style: normal;
                                                      line-height: normal;
                                                      letter-spacing: normal;
                                                      color: #323232;">
                                                                    El abogado <span style="    color: #294f74!important;
                                                         font-weight: 500;">{{$data['lawyer_name']}}</span> indicó que su documento <span style="    color: #294f74!important;
                                                         font-weight: 500;">{{$data['document_name']}}</span> enviado el día <span style="    color: #294f74!important;
                                                         font-weight: 500;">{{date('d/m/Y',strtotime($data['date']))}}</span>, está {{$data['legalisation_status']}}.
                                                                </p>
                                                                <p style="margin-bottom: 15px;
                                                      padding-bottom:0;
                                                      font-family: Roboto;
                                                      font-size: 14px;
                                                      margin-top:0;
                                                      font-weight: normal;
                                                      font-stretch: normal;
                                                      font-style: normal;
                                                      line-height: normal;
                                                      letter-spacing: normal;
                                                      color: #323232;">
                                                                    Por favor, contactar al abogado a los siguentes datos:
                                                                </p>
                                                                <div class="user-info" style="    margin-top: 34px;">
                                                                    <table class="legal-info-wrap" style="width: 100%;">
                                                                        <tbody>
                                                                            <tr class=" ">
                                                                                <td class="  col-md-51" style="vertical-align: top;width: 28%;">
                                                                                    <div class="user-head-wi-ico" style="    font-size: 14px;
                                                                     font-weight: 500;
                                                                     font-stretch: normal;
                                                                     font-style: normal;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;">
                                                                                        <img style="    width: 20px;
                                                                        height: 20px;
                                                                        margin-right: 0.5rem;
                                                                        vertical-align: middle;" src="http://comdudes.com/demo/hl-html/hl/assets/img/icon-user.png" /> Abogado
                                                                                    </div>
                                                                                </td>
                                                                                <td class=" col-md-71">
                                                                                    <ul class="user-legal-info" style="list-style: none;
                                                                     margin-top: 0;
                                                                     padding: 0;
                                                                     margin-bottom: 0;
                                                                     font-size: 14px;
                                                                     font-weight: normal;
                                                                     font-stretch: normal;
                                                                     font-style: normal;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;
                                                                     word-wrap: break-word;">
                                                                                        <li class="BodyBody-2" style="    list-style: none;
                                                                     margin-top: 0;
                                                                     padding: 0;
                                                                     padding-bottom:5px;
                                                                     margin-bottom: 0;
                                                                     font-size: 14px;
                                                                     font-weight: normal;
                                                                     font-stretch: normal;
                                                                     font-style: normal;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;
                                                                     word-wrap: break-word;">
                                                                                            {{$data['lawyer_name']}}
                                                                                        </li>
                                                                                        <li class="BodyBody-2" style="    list-style: none;
                                                                     margin-top: 0;
                                                                     padding: 0;
                                                                     margin-bottom: 0;
                                                                     font-size: 14px;
                                                                     padding-bottom:5px;
                                                                     font-weight: normal;
                                                                     font-stretch: normal;
                                                                     font-style: normal;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;
                                                                     word-wrap: break-word;">
                                                                                            {{$data['phone']}}
                                                                                        </li>
                                                                                        <li class="BodyBody-2" style="    list-style: none;
                                                                     margin-top: 0;
                                                                     padding: 0;
                                                                     margin-bottom: 0;
                                                                     font-size: 14px;
                                                                     font-weight: normal;
                                                                     padding-bottom:5px;
                                                                     font-stretch: normal;
                                                                     font-style: normal;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;
                                                                     word-wrap: break-word;">
                                                                                            <a href="#" style="color: #323232!important;text-decoration:none"> {{$data['email']}}</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </td>
                                                                            </tr>
                                                                            <tr style="height: 31px;">
                                                                                <!-- spacer -->
                                                                            </tr>
                                                                            <tr class=" row1" style="margin-top: 31px;">
                                                                                <td class="  col-md-51" style="vertical-align: top;width: 28%;">

                                                                                    <div class="user-head-wi-ico" style="font-size: 14px;
                                                                     font-weight: 500;
                                                                     font-stretch: normal;
                                                                     font-style: normal;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;">
                                                                                        <img src="https://herramien.webc.in/front/assets/img/loc-pin.png" style="width: 20px;
                                                                        height: 20px;
                                                                        margin-right: 0.5rem;
                                                                        vertical-align: middle;" /> Firmar en:
                                                                                    </div>
                                                                                </td>
                                                                                <td class=" col-md-71">
                                                                                    <ul class="user-legal-info" style="    list-style: none;
                                                                     margin-top: 0;
                                                                     padding: 0;
                                                                     margin-bottom: 0;
                                                                     font-size: 14px;
                                                                     padding-bottom:5px;
                                                                     font-weight: normal;
                                                                     font-stretch: normal;
                                                                     font-style: normal;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;
                                                                     word-wrap: break-word;">
                                                                                        <li style="    list-style: none;
                                                                     margin-top: 0;
                                                                     padding: 0;
                                                                     margin-bottom: 0;
                                                                     font-size: 14px;
                                                                     font-weight: normal;
                                                                     font-stretch: normal;
                                                                     padding-bottom:5px;
                                                                     font-style: normal;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;
                                                                     word-wrap: break-word;"> {{$data['lawyer_address']}}
                                                                                        </li>
                                                                                        <li style="    list-style: none;
                                                                     margin-top: 0;
                                                                     padding: 0;
                                                                     margin-bottom: 0;
                                                                     font-size: 14px;
                                                                     font-weight: normal;
                                                                     font-stretch: normal;
                                                                     font-style: normal;
                                                                     padding-bottom:5px;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;
                                                                     word-wrap: break-word;"><b>Zona</b> {{$data['zone']}}   
                                                                                        </li>
                                                                                        <li style="    list-style: none;
                                                                     margin-top: 0;
                                                                     padding: 0;
                                                                     margin-bottom: 0;
                                                                     font-size: 14px;
                                                                     font-weight: normal;
                                                                     font-stretch: normal;
                                                                     font-style: normal;
                                                                     padding-bottom:5px;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;
                                                                     word-wrap: break-word;">{{$data['township']}} </li>
                                                                                        <li style="    list-style: none;
                                                                     margin-top: 0;
                                                                     padding: 0;
                                                                     margin-bottom: 0;
                                                                     font-size: 14px;
                                                                     font-weight: normal;
                                                                     padding-bottom:5px;
                                                                     font-stretch: normal;
                                                                     font-style: normal;
                                                                     line-height: normal;
                                                                     letter-spacing: normal;
                                                                     font-family: Roboto;
                                                                     color: #323232;
                                                                     word-wrap: break-word;">{{$data['department']}}
                                                                                        </li>
                                                                                    </ul>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- end: tr -->
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- end tr -->
                    </table>
                </td>
            </tr>
            <!-- end:tr -->
            <!-- 1 Column Text + Button : END -->
            <tr>
                <td height="35" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
            </tr>
    </table>
</body>

</html>