<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>{{$template->document_name}}</title>
    <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
    <link rel="preload" href="//fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" as="font" crossorigin>

    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 30px;
            padding: 30px;
            color: #323232;
            background-color: #ffffff;
            font-family: 'Roboto', sans-serif;
            
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
}
    </style>
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <h3 style="text-align:center;">{{$template->document_name}}</h3>
                <div class="cert-content">
                {!! $template->text_body !!}      
                </div>
                   
            </div>
        </div>

    </div>
</body>

</html>