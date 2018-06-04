<?php
	session_start();
	if($_SESSION['check_sign']=='SmartMeter'){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-size:3vw;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0"  />
		<link href="css/bootstrap.css" rel="stylesheet"  />
		<link href="css/style.css" rel="stylesheet"  />
        <link href="css/bootstrap-theme.css" rel="stylesheet"  />
        <link href="https://fonts.googleapis.com/css?family=Kanit|Open+Sans" rel="stylesheet">
        <!--[if It IE 9]>
        	<script scr="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script scr="http://oss.maxcdn.com/libs/html5shiv/1.4.2/respond.min.js"></script>
        <![endif] -->
		<title>Smart Meter</title>
	</head>
	<body style="background:#000;">
    	<div class="container-fluid" style="padding:0px 0px 0px 0px;"> 
        	<div class="row-fluid" style="height:auto;">
            	<div class="col-md-12" style="background:#000;width:100%;height:100%;margin:0px 0px 0px 0px;padding:20px 0px 20px 0px;">
                	<h1 style="font-family: 'Kanit', sans-serif;text-align:center; color:#FF0;margin:0px 0px 0px 0px;">ระบบตรวจสอบปริมาณการใช้พลังงานไฟฟ้า</h1>
                </div>
            </div>
            <div class="row-fluid" >
                <div class="col-md-2" align="center" style="padding:0px 0px 0px 0px;background:#7F7F7F;height:520px;">
                   	  <p style="font-family: 'Open Sans', sans-serif;font-size:25px;color:#fff;"> User </p>
                        <input type="text" value="<?php echo $_SESSION['user_name']; ?>" style="background:#FFF;width:90%;padding:5px;font-family: 'Kanit', sans-serif; color:#F00; font-size:20px; readonly="readonly="readonly"/>
                      <form action="log_out_action.php">
                      	<button type="summit" class="btn btn-default" style="font-family: 'Kanit', sans-serif;color:#000; font-size:20px;
                        margin-bottom:0.1em; margin-top:5px;"> ออกจากระบบ</button>
                      </form>  
                      <form action="manage_account.php" target="data" >
                      	<button type="summit" class="btn btn-default" style="width:6.70em; height:40px;font-family: 'Kanit', sans-serif;color:#000; font-size:20px;  margin-top:0.4em;">ตั้งค่าบัญชี</button>
                      </form>
                       <p style="font-family: 'Open Sans', sans-serif;font-size:25px;color:#fff;"> Menu </p>
                        <div align="left">
                        <ul>
                        	<li style="font-family: 'Kanit', sans-serif;font-size:15px; ">
                            <a href="current_month.php" target="data" style="color:#FFFF00;font-size:20px;">รอบเดือนปัจจุบัน</a></li>
                            <li style="font-family: 'Kanit', sans-serif;font-size:15px; ">
                            <a href="static.php" target="data" style="color:#FFFF00;font-size:20px;" >สถิติการใช้งาน</a></li>
                            <li style="font-family: 'Kanit', sans-serif;font-size:15px; ">
							<a href="set_rate.php" target="data" style="color:#FFFF00;font-size:20px;" >ตั้งค่าการใช้งาน</a></li>
                        </ul>
                        </div>
                    </div>
                <div class="col-md-10" style="background:#fff;text-align:center;padding:0px 0px 0px 0px;height:520px;">
					<?php
					if($_SESSION['month_status']==0)
					{
						echo '<iframe name="data" id="data" src="set_rate.php" width="100%" height="100%" align="center" style="">';
					}
					else
					{
						echo '<iframe name="data" id="data" src="current_month.php" width="100%" height="100%" align="center" style="">';
					}
					?>
						<noframe> บราวเซอร์ของท่านไม่รองรับ iframe </noframe>
					</iframe>
                </div>
                
            </div>
            <div class="row-fluid">
            	<div class="col-md-12" style="background:#000;text-align:center;height:auto;padding-top:10px;">
                	<p style="font-family: 'Kanit', sans-serif;font-size:1.5em;color:#FF0;font-weight: bold;">คณะผู้จัดทำ นายเกียรติศักดิ์ บัวงาม นายภูวิศ เชื้อชม นางสาวนัยน์ยพัชร  วิเศษวงษา</p>
                </div>
                
                
            </div>
        </div>
    	<script src="js/bootstrap.js"></script>
    	<script src="js/jquery-3.2.1.js"></script>
	</body>
</html>
<?php
	}
	else
	{
?>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0"  />
    <body style="background-color:#0CF;">
		<?php
			echo'<script type="text/javascript">';
			echo "\r\n\t\t".'alert("คุณยังไม่ได้เข้าสู่ระบบ กรุณาเข้าสู่ระบบก่อน!");';
			echo "\r\n\t\t".'window.location.replace("login.php");';
			echo "\r\n\t".'</script>'."\r\n";
		?>
    </body>
<?php	
	}
?>

