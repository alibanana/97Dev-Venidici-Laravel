<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <!--<link href='http://fonts.googleapis.com/css?family=Denk+One' rel='stylesheet' type='text/css'>-->
<style>
  @page { margin: 0in; }
  body {
    /*font-family: Denk One, sans-serif;*/
    background-image: url('assets/images/client/Sertifikat Venidici-Bisnis.png');
    background-position: top left;
    background-repeat: no-repeat;
    background-size: 100%;
    width:100%;
    height:100%;
  }
</style>

</head>

<body>

<p style="font-size:95px;margin-left:240px;margin-top:630px;color:#FFFFFF">{{$name}}</p>
<div style="margin-top:-70px;padding-right:800px">
<p style="font-size:45px;margin-left:240px;color:#FFFFFF">{{$first_sentence}} <span style="font-style:bold">{{$course_name}}</span> </p>
<p style="font-size:45px;margin-left:240px;color:#FFFFFF">{{$second_sentence}} {{$finish_date}}, {{$third_sentence}}</p>
</div>

</body>
</html>