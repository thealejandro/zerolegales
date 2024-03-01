<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Documento</title>
    <style>
        @font-face {
        font-family: Roboto-Regular;
        src: url('../../../../front/assets/font/Roboto/Roboto-Regular.ttf');
      }
        body {
            margin:10.4mm;
            color: #323232;
            background-color: #ffffff;
            font-family: 'Roboto', sans-serif;
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        p,li {
            font-size: 15px;
            line-height:  0.8;
            color: #323232;
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body>
<div class="book">
        <div class="page">
            <div class="subpage">
                <div class="cert-content">
                {!! $template->text_body !!}      
                </div>
                   
            </div>
        </div>

    </div>
</body>

</html>