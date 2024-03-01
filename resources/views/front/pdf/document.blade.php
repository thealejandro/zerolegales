<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Documento</title>
    <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
    <link rel="preload" href="//fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" as="font" crossorigin>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            color: #323232;
            background-color: #ffffff;
            font-family: 'Roboto', sans-serif;
            margin: 10pt;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }


        p {
            font-size: 14px;
            font-weight: normal;
            line-height: normal;
            letter-spacing: normal;
            color: #323232;
        }



        .subpage {
            padding: 1cm;
          
            

        }

        @page {
            margin: 0;
        }


        @media print {

            html{
                width: 793px;
                height: 1122px;
            }

            .page {
                margin: 0;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="book">
        <div class="page" style="
            padding: 48px 48px;
            margin: 0 auto;
            /* border: solid 1px #979797; */
            border-radius: 0;
            background: white;
            /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */">
            <div class="subpage" style="padding:37px;">
                <div class="cert-content">
                {!! $template->text_body !!}      
                </div>
                   
            </div>
        </div>

    </div>
</body>

</html>