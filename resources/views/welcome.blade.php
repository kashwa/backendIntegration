<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- FontAwesome -->
        <script href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 50px;
            }

            .links > a {
                color: #496f6c;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Full-Stack Backend Integration
                </div>

                <div class="links">
                    <div class="card m-b-md">
                        <i class="fas fa-3x fa-leaf">&nbsp;</i>
                        <i class="fas fa-3x fa-database">&nbsp;</i>
                    </div>

                    <div class="card m-b-md">
                        <i class="fab fa-3x fa-java">&nbsp;</i>
                        <i class="fab fa-3x fa-python">&nbsp;</i>
                        <i class="fab fa-3x fa-php">&nbsp;</i>
                        <i class="fab fa-3x fa-laravel">&nbsp;</i>
                    </div>

                    <div class="card">
                        <i class="fab fa-3x fa-vuejs">&nbsp;</i>
                        <i class="fab fa-3x fa-css3-alt">&nbsp;</i>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
