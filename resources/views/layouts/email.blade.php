<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=610px, initial-scale=1.0"/>
	<title>Followback</title>
	<style>
		* {   box-sizing: border-box;  }
		HTML,BODY { box-sizing: border-box; padding: 0; margin: 0; background-color: #EEE; }
		A,A:LINK,A:HOVER { text-decoration: none; color: #0074c4; }
		A:HOVER { color: #333; }
		P { font-size: 13px; font-weight: 100; font-family: helvetica, arial; line-height: 1.5em; color: #000; }
		.Button {   box-sizing: border-box; border-radius: 5px; display: block; margin: 20px 0; padding: 12px 20px 12px; background-color: #0074c4; color: #FFF !important; font-weight: 600; width: 100%; text-align: center; }
		.Button:HOVER { background-color: #1797f0; }
		.Wrapper { background-color: #FFF; border-radius: 7px; -moz-box-shadow: inset 0 0 10px #cccccc; -webkit-box-shadow: inset 0 0 10px #cccccc;  box-shadow: inset 0 0 10px #cccccc; }
		
	body{
                       -webkit-text-size-adjust:none;
               }
	  img{
                       border:0;
                       height:auto;
                       line-height:100%;
                       outline:none;
                       text-decoration:none;
               }
	</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="10" border="0">
<tr>
	<td>
<center>
<table class="Wrapper" width="100%" cellpadding="40" cellspacing="0" border="0" style="max-width: 590px; background-color: #FFF; border-radius: 7px; -moz-box-shadow: inset 0 0 10px #cccccc; -webkit-box-shadow: inset 0 0 10px #cccccc;  box-shadow: inset 0 0 10px #cccccc;">
<tr>
	<td>
		<center><a href="http://www.followback.com" target="_blank"><br><img src="http://www.followback.com/assets/images/email-logo.jpg" width="270" height="47" border="0"></a></center>
	<br>
<center>
			<table width="100%" style="max-width: 480px; margin: 0 auto !important;" cellpadding="0" cellspacing="0"  border="0">
			<tr>
				<td style="align: left;" align="left">
						<font size="4" style="font-weight: 100; font-family: helvetica, arial; line-height: 1.5em; color: #000;">
								
								<p>Hi,</p>
								
                @yield('content')


								<p>Thank you, <br>
								#TeamFollowback</p>

							</font>
				</td>
			</tr>
			</table>
		</center>
	
	</td>
</tr>
</table>
<p><font size="2" style="font-family: helvetica, arial; letter-spacing: 0.08em;"> Your Social Task Provider &nbsp; | &nbsp;<a href="http://www.followback.com" target="_blank">Followback.com</a>  &nbsp; </font></p>
<unsubscribe>&nbsp;</unsubscribe>
</center>
	</td>
</tr>
</table>
</body>
</html>
