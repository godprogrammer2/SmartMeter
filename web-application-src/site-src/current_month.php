<?php
	session_start();
	include("connect.php");
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
        <!--[if It IE 9]>
        	<script scr="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script scr="http://oss.maxcdn.com/libs/html5shiv/1.4.2/respond.min.js"></script>
        <![endif] -->
		<title>Current Month</title>

	</head>
	<body style="background-color:#0CF;">
		<?php
		if($_SESSION['month_status']==0)
		{
			echo'<script type="text/javascript">';
			echo "\r\n\t\t".'alert("กรุณาตั้งค่าการใช้งานก่อน");';
			echo "\r\n\t\t".'window.top.location.replace("index.php");';
			echo "\r\n\t".'</script>'."\r\n";
			exit();
		}
		?>
		<script>
		start();
		function start() {
			   
				setInterval(function() {update();},500);
			}
			function update(){
			if (window.XMLHttpRequest) 
			{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
			} 
			else 
			{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200)
            {
				document.getElementById("show").innerHTML = this.responseText;
			}
			};
			xmlhttp.open("GET","api.php?q=get_watt&device_id=<?php echo $_SESSION['device_id'];?>",true);
			xmlhttp.send();
			
		}
		</script>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-md-12" id="show" align="center">
				</div>
			</div>
			<div class="row-fluid">
				<div class="col-md-12" align="center">
					<form action="#" method="post">
							<input type="text" name="newlimit" id="newlimit" value="" style="margin:5px;" class="btn btn-defaul" placeholder="แก้ไขจำกัดปริมาณกระแสไฟฟ้า" required="required" />				
							<input type="password" name="confirm_password" id="confirm_password" class="form-control" style="width:30%;height:20%;margin:5px;" required="required"/>
							<label for="confirm_password" class="">ยืนยันรหัสผ่าน</label>
							<button class="btn btn-default" name="save" style="margin:10px;">บันทึกข้อมูล</button>
					</form>
				</div>
			</div>
		</div>
		<?php
			if(isset($_POST['save']))
			{
				$sql="SELECT user_password FROM data_area WHERE user_name = '{$_SESSION['user_name']}'";
				$result=mysql_query($sql);
				if($result)
				{
					$result=mysql_fetch_assoc($result);
					if($result['user_password']==$_POST['confirm_password'])
					{
								$sql="UPDATE {$_SESSION['device_id']} SET limit_ampere = {$_POST['newlimit']} WHERE id = (SELECT * FROM (SELECT MAX(id) FROM {$_SESSION['device_id']}) as id)";
								if(mysql_query($sql))
								{
									echo'<script type="text/javascript">';
									echo "\r\n\t\t".'alert("บันทึกข้อมูลเรียบร้อย");';
									echo "\r\n\t\t".'window.location.replace("current_month.php");';
									echo "\r\n\t".'</script>'."\r\n";
								}
								else
								{
									echo mysql_error();
								}
					}
					else
					{
						echo'<script type="text/javascript">';
						echo "\r\n\t\t".'alert("ยืนยันรหัสผ่านไม่ถูกต้อง กรุณาลองอีกครั้ง");';
						echo "\r\n\t\t".'window.location.replace("current_month.php");';
						echo "\r\n\t".'</script>'."\r\n";
					}
				}
				else
				{
					echo mysql_error();
				}
				unset($_POST['save']);
			}
			
		?>
	</body>
</html>
<?php
	}
	else
	{
?>	<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0"  />
    <body style="background-color:#0CF;">
		<?php
			echo'<script type="text/javascript">';
			echo "\r\n\t\t".'alert("คุณยังไม่ได้เข้าสู่ระบบ กรุณาเข้าสู่ระบบก่อน!");';
			echo "\r\n\t\t".'window.top.location.replace("login.php");';
			echo "\r\n\t".'</script>'."\r\n";
			exit();
		?>
    </body>
    </html>
<?php	
	}
?>

