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
		<title>Sign Up Action</title>

	</head>
	<body style="background-color:#0CF;">
		 <?php
						session_start();
						if(isset($_SESSION['frmAction']) && isset($_POST['frmAction'])){
						require_once"connect.php";
						$user_name=mysql_real_escape_string(trim($_POST["user_name"]));
						$passwd=mysql_real_escape_string(trim($_POST['passwd']));
						$email=mysql_real_escape_string(trim($_POST['email']));
						$device_id=mysql_real_escape_string(trim($_POST['device_id']));
						$testUser="SELECT user_name,device_id FROM data_area WHERE user_name='{$user_name}' OR device_id='{$device_id}' ";
						$check=mysql_query($testUser);
						$count=mysql_num_rows($check);
						if($count > 0){
						    echo'<script type="text/javascript">';
							echo "\r\n\t\t".'alert("เกิดข้อผิดพลาด! ชื่อผู้ใช้หรือไอดีอุปกรณ์ถูกลงทะเบียนแล้ว");';
							echo "\r\n\t\t".'window.location.replace("sign_up.php");';
							echo "\r\n\t".'</script>'."\r\n";
							exit();
						}
						$test_device_id="SELECT * FROM all_device WHERE device = '{$device_id}'";
						$check=mysql_query($test_device_id);
						$count=mysql_num_rows($check);
						if($count<=0)
						{
							echo'<script type="text/javascript">';
							echo "\r\n\t\t".'alert("เกิดข้อผิดพลาด! ไม่พบไอดีอุปกรณ์นี้ในฐานข้อมูล กรุณาลองอีกครั้ง");';
							echo "\r\n\t\t".'window.location.replace("sign_up.php");';
							echo "\r\n\t".'</script>'."\r\n";
							exit();
						}
						$check=mysql_fetch_assoc($check);
						if($check['status']!=1)
						{
							echo'<script type="text/javascript">';
							echo "\r\n\t\t".'alert("เกิดข้อผิดพลาด! ไอดีอุปกรณ์นี้อยู่ในสถานะไม่พร้อมใช้งาน กรุณาลองอีกครั้ง");';
							echo "\r\n\t\t".'window.location.replace("sign_up.php");';
							echo "\r\n\t".'</script>'."\r\n";
							exit();
						}
						unset($_SESSION['frmAction']);
						$sql="INSERT INTO data_area (user_name,user_password,user_email,device_id) VALUES ('$user_name','$passwd','$email','$device_id')";
						if(mysql_query($sql)){
							$_SESSION['user_name']=$user_name;
							$_SESSION['user_email']=$email;
							$_SESSION['device_id']=$device_id;
							$_SESSION['check_sign']='SmartMeter';
							echo'<script type="text/javascript">';
							echo "\r\n\t\t".'alert("ลงทะเบียนเรียบร้อย");';
							echo "\r\n\t\t".'window.location.replace("index.php");';
							echo "\r\n\t".'</script>'."\r\n";
						}else{
							echo'<script type="text/javascript">';
							echo "\r\n\t\t".'alert("เกิดข้อผิดพลาด! ในการลงทะเบียน");';
							echo "\r\n\t\t".'window.location.replace("sign_up.php");';
							echo "\r\n\t".'</script>'."\r\n";
							exit();
						}
					}
					else
					{
							echo'<script type="text/javascript">';
							echo "\r\n\t\t".'alert("เกิดข้อผิดพลาด! ระหว่าง Session");';
							echo "\r\n\t\t".'window.location.replace("sign_up.php");';
							echo "\r\n\t".'</script>'."\r\n";
							exit();
					}
						?>
	</body>

</html>
