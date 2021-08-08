<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venidici 401</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        html, body {
            margin:0px;
            height:100%;
        }
        @font-face {
            font-family: Rubik Bold;
            src: url(/fonts/Rubik/Rubik-Bold.ttf);
        }

        @font-face {
            font-family: Rubik Medium;
            src: url(/fonts/Rubik/Rubik-Medium.ttf);
        }

        @font-face {
            font-family: Rubik Regular;
            src: url(/fonts/Rubik/Rubik-Regular.ttf);
        }

        @font-face {
            font-family: Helvetica Bold;
            src: url(/fonts/Helvetica/Helvetica-Bold.ttf);
        }
        @font-face {
            font-family: Poppins Medium;
            src: url(/fonts/Poppins/Poppins-Medium.otf);
        }
        @font-face {
            font-family: Hypebeast;
            src: url(/fonts/Hypebeast/Hypebeast.ttf);
        }

        @media only screen and (max-width: 768px) { 
            #logo_mobile{
                width: 20vw !important;
            }
            #title_text{
                font-size:5vw !important
            }
            #description_text{
                font-size:4vw !important
            }
        }

    </style>
</head>
<body style="background-color:#2B6CAA">
    <div style="text-align:center;margin-top:10vw;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 500px;
    height: 300px;
    margin-left: -250px;
    margin-top: -150px;">
        <img src="/assets/images/client/Logo_white.png" class="img-fluid" id="logo_mobile" style="width:10vw" alt="">
        <p style="font-family:Rubik Bold;color:#FFFFFF;font-size:2vw;margin-top:2vw" id="title_text">401 - Oops.. You are not authorized</p>
        <p style="font-family:Rubik Regular;color:#FFFFFF;font-size:1.5vw;margin-top:2vw" id="description_text"> <span> <a href="/login" style="color:white">Clik here</a> </span>to go back to venidici</p>

    </div>
</body>
</html>