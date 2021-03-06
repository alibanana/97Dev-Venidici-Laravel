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
    background-image: url('assets/images/client/Sertifikat Venidici-Woki.png');
    background-position: top left;
    background-repeat: no-repeat;
    background-size: 100%;
    width:100%;
    height:100%;
  }
</style>

</head>

<body style="text-align: center;">

<p style="font-size:2.5rem;margin-top:17rem;color:#00819B">{{$name ?? 'Fernandha Dzaky'}}</p>
<div style="margin-top:-1.3rem;width:50%;padding-bottom:50vh;margin-left:14.5rem">
  <p style="font-size:1rem;color:#CE3369">{{$first_sentence ?? 'We hereby award this Certificate of Completion on our OnDemand Class, '}} <br> <span style="font-style:bold">{{$course_name ?? 'Path to Winning Business Competition'}}</span> </p>
  <p style="font-size:1rem;color:#CE3369">{{$second_sentence ?? 'By completing this course on  2021-07 09, you have practiced and taken an initiative to develop yourself in order to take part in cometitive environment'}} <span style="font-style:bold">{{$finish_date ?? ''}}</span>, {{$third_sentence ?? ''}}</p>
</div>

</body>
</html>