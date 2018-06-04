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
		<title>Log In Action</title>

	</head>
	<body style="background-color:#0CF;">
		 <?php
						session_start();
						if(isset($_SESSION['frmAction']) == isset($_POST['frmAction'])){
						require_once"connect.php";
						$user_name=mysql_real_escape_string(trim($_POST["user_name"]));
						$passwd=mysql_real_escape_string(trim($_POST['passwd']));
						$sql="SELECT * FROM data_area WHERE user_name = '{$user_name}' AND user_password LIKE '{$passwd}' ";
						$check=mysql_query($sql);
						$count=mysql_num_rows($check);
						unset($_SESSION['frmAction']);
						if($count == 1){
							$result = mysql_fetch_assoc($check);
							$_SESSION['user_name']=$result['user_name'];
							$_SESSION['user_email']=$result['user_email'];
							$_SESSION['device_id']=$result['device_id'];
							$_SESSION['month_status']=$result['month_status'];
							$_SESSION['check_sign']='SmartMeter';
							echo'<script type="text/javascript">';
							echo "\r\n\t\t".'alert("ลงชื่อเข้าใช้เรียบร้อย");';
							echo "\r\n\t\t".'window.location.replace("index.php");';
							echo "\r\n\t".'</script>'."\r\n";
						}else{
							echo'<script type="text/javascript">';
							echo "\r\n\t\t".'alert("เกิดข้อผิดพลาด! ชื่อผู้ใช้หรือรหัสผ่านผิด");';
							echo "\r\n\t\t".'window.location.replace("login.php");';
							echo "\r\n\t".'</script>'."\r\n";
							exit();
						}
					}
					else
					{
							echo'<script type="text/javascript">';
							echo "\r\n\t\t".'alert("เกิดข้อผิดพลาด! ระหว่าง Session");';
							echo "\r\n\t\t".'window.location.replace("login.php");';
							echo "\r\n\t".'</script>'."\r\n";
							exit();
					}
						?>
	</body>

</html>

