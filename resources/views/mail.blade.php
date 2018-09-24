<!DOCTYPE html>
<html lang="en">
<head>
  <title>BLUE DATA Reset Password</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <meta name="description" content="">
  <meta name="author" content="">
  <style type="text/css">
  @media screen and (max-width:480px) {
    table tr td {padding-left: 20px !important; padding-right: 20px !important;}
    .reset-img {width: 100% !important;}
    * {box-sizing: border-box; -webkit-box-sizing: border-box; -ms-box-sizing: border-box;}
    table {width: 100%;}
  }
</style>
</head>

<body style="background: #f6f6f6">

  <div class="container" style="width: 100%;max-width: 100%;margin: 0 auto;display: block;text-align: center;overflow: hidden; font-family: Arial;">

   <div class="emil_table" style="width: 100%;display: block;text-align: left;font-family: Arial;">

    <center> 
      <table align="center" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td>
            <table cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td style="padding:20px 40px;background-color: #fff;">                  
                  <img src="{{asset('public/images/logo_blue.png')}}">
                </td>
              </tr>
            </table>
            <table cellspacing="0" cellpadding="0" width="100%" style="background-color:#f8f8f8;">
              <tr>
                <td style="font-size: 25px;font-weight: bold; font-family: Arial; padding: 30px 40px 20px;
                text-align: left;"><h1 style="margin: 0; font-size: 35px;"> Hello <span style="color: #129df8">{{ucfirst($name)}},</h1>
                </td>
              </tr>
              <tr>
                <td style="font-size: 16px; padding: 0 40px"> You are receiving this email because we received a password reset request for your account. </td>
              </tr>
              <tr>
                <td  style="padding: 20px 40px;" class="reset-img"> <a href="{{ URL::to('resetPassword/' . $passwordLink) }}"> <img width="290px" src="{{asset('public/images/reset_pwd.png')}}"></a></td>
              </tr>
              <tr>
                <td style="font-size: 16px; padding: 0px 40px 0 40px"> If you did not request a password reset, then you can just ignore this email, your password will not change. </td>
              </tr>
              <tr>
                <td style="font-size: 14px; padding: 40px 40px 30px 40px"> If you're having trouble clicking *Reset Password* button,copy and paste URL below into your browser. <br> <a href="#"></a>{{ URL::to('resetPassword/' . $passwordLink) }}</td>
              </tr>
              <tr>
                <td style="font-size: 16px; padding: 0 40px 30px">Sincerely, <br>BLUE DATA Team</td>
              </tr>
            </table>
            <table style="background-color:#129df8; width: 100%">
              <tr>
                <td  style="color: #fff; font-size: 12px; width: 100%; background-color:#129df8; padding:5px 40px;"> BLUE DATA</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </center>
  </div>
</div>

</body>
</html>