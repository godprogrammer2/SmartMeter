<?php
	session_start();
	if($_SESSION['check_sign']=='SmartMeter'){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
		<title>Manage Account</title>

	</head>
	<body style="background-color:#0CF;">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-md-12" align="right" style="padding-right:40%;">
					<form method="post" action="#">
						<label for="new_user_name" style="font-family: 'Kanit', sans-serif;color:#000; font-size:18px; margin-top:10%;"> ชื่อผู้ใช้งาน:</label>
                        <input type="text" name="new_user_name" id="new_user_name" value="" style="margin-bottom:20px;" class="btn btn-defaul" placeholder="<?php echo $_SESSION['user_name']; ?>" />
						<br />
						<label for="new_user_email" style="font-family: 'Kanit', sans-serif;color:#000; font-size:19px;"> อีเมลแอดเดรส:</label>
						<input type="test" name="new_user_email" id="new_user_email" value="" style="margin-bottom:20px;margin-right:;" class="btn btn-defaul" placeholder="<?php echo $_SESSION['user_email'];?>"/>
						<br />
						<label for="new_user_password" style="font-family: 'Kanit', sans-serif;color:#000; font-size:19px;"> รหัสผ่านใหม่:</label>
						<input type="password" name="new_user_password" id="new_user_password" value="" style="margin-bottom:20px;margin-right:;" class="btn btn-defaul"/>
						<br />
						<label for="confirm_new_user_password" style="font-family: 'Kanit', sans-serif;color:#000; font-size:19px;"> กรอกรหัสผ่านใหม่อีกครั้ง:</label>
						<input type="password" name="confirm_new_user_password" id="confirm_new_user_password" value="" style="margin-bottom:20px;margin-right:;" class="btn btn-defaul"/>
						<br />
						<label for="old_user_password"  style="font-family: 'Kanit', sans-serif;color:#000; font-size:18px;" > ยืนยันรหัสผ่านเดิม:</label>
						<input type="password" name="old_user_password" id="old_user_password" value="" style="margin-bottom:20px;margin-right:;" required="required"  class="btn btn-defaul"/>
						<br />
						<input type="hidden" name="check" />
						<button type="submit" name="submit" class="btn btn-default" style="font-family: 'Kanit', sans-serif;color:#000; font-size:20px;width:150px;height:40px;margin-right:5%;">บันทึกข้อมูล</button>
					</form>
				</div>
			</div>
		</div>
		<?php 
			if(isset($_POST['check']))
			{
				include("connect.php");
				$sql="SELECT * FROM data_area WHERE user_name='{$_SESSION['user_name']}'";
				$result=mysql_query($sql);
				if($result)
				{
					$result=mysql_fetch_assoc($result);
					if($_POST['confirm_new_user_password']!=$_POST['new_user_password'])
					{
						echo'<script type="text/javascript">';
						echo "\r\n\t\t".'alert("รหัสผ่านใหม่ไม่ตรงกันกรุณาลองอีกครั้ง");';
						echo "\r\n\t\t".'window.location.replace("manage_account.php");';
						echo "\r\n\t".'</script>'."\r\n";
						exit();
					}
					if($result['user_password']==$_POST['old_user_password'])
					{
						
						if($_POST['new_user_name']!="")
							$new_user_name=$_POST['new_user_name'];
						else
							$new_user_name=$result['user_name'];
						if($_POST['new_user_email']!="")
							$new_user_email=$_POST['new_user_email'];
						else
							$new_user_email=$result['user_email'];
						if($_POST['new_user_password']!="")
							$new_user_password=$_POST['new_user_password'];
						else
							$new_user_password=$result['user_password'];
						$sql="UPDATE data_area SET user_name='{$new_user_name}',user_email='{$new_user_email}',user_password='{$new_user_password}' WHERE user_name='{$_SESSION['user_name']}'";
						if(mysql_query($sql))
						{
							$_SESSION['user_name']=$new_user_name;
							$_SESSION['user_email']=$new_user_email;
							$_SESSION['user_password']=$new_user_password;
							echo'<script type="text/javascript">';
							echo "\r\n\t\t".'alert("บันทึกข้อมูลเรียบร้อย");';
							echo "\r\n\t\t".'window.location.replace("manage_account.php");';
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
						echo "\r\n\t\t".'alert("ยืนยันรหัสผ่านเดิมไม่ถูกต้องกรุณาลองอีกครั้ง");';
						echo "\r\n\t\t".'window.location.replace("manage_account.php");';
						echo "\r\n\t".'</script>'."\r\n";
						
					}
				}
				else
				{
					echo mysql_error();
				}
				unset($_POST['check']);
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
			echo '<script type="text/javascript">';
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
