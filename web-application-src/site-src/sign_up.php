<?php
	session_start();
	$_SESSION['frmAction']=md5('SmartMeter'.rand(1,999999));
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
        <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
        <!--[if It IE 9]>
        	<script scr="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script scr="http://oss.maxcdn.com/libs/html5shiv/1.4.2/respond.min.js"></script>
        <![endif] -->
		<title>User Signup</title>

	</head>
    	
	<body class="G">
    <div class="container-fluid" >
        	<div class="row-fluid">
				
            	<div class="col-md-12" style=" padding-top:10px; padding-bottom:23px;text-align:center;" >
            		<form method="post" action="sign_up_action.php">
                      <img src="media/images/SmarMeter.png" style="width:300px;"/>
                       	 <p style="font-family: 'Kanit', sans-serif;color:#000; font-size:25px;margin-top:10px;"> 
                        ระบุชื่อผู้ใช้งาน</p>
            				<input type="text" class="btn" name="user_name" required="required" style="width:300px;padding:12px;"/>
                            <br />
                            <br />
                            
                        <p style="font-family: 'Kanit', sans-serif;color:#000; font-size:25px;"> 
                         ระบุรหัสผ่าน</p>
           				  <input type="password" class="btn" name="passwd" required="required" style="width:300px;padding:12px;">
                          <br />
                            <br />
                           
                        <p style="font-family: 'Kanit', sans-serif;color:#000; font-size:25px;"> 
                         ระบุอีเมลแอดเดรส</p>
           				  <input type="text" class="btn" name="email" required="required" style="width:300px;padding:12px;">
                          <br />
                          <br />
                          <p style="font-family: 'Kanit', sans-serif;color:#000; font-size:25px;"> 
                         ระบุไอดีอุปกรณ์</p>
           				  <input type="text" class="btn" name="device_id" required="required" style="width:300px;padding:12px;">
                          <br />
                          <br />
                          <input type='hidden' name="frmAction" value="<?php echo $_SESSION['frmAction']; ?>" />
                            	<button class="btn btn-default" type="submit" style="font-family: 'Kanit', sans-serif;color:#000; font-size:25px;width:150px;height:40px;">ลงทะเบียน</button>
                                </form>   
                                <a  href="login.php" ><button class="btn btn-default" style="font-family: 'Kanit', sans-serif;color:#000; font-size:25px;width:150px;height:40px;margin-top:15px;">ย้อนกลับ</button></a>                                            			
            	</div>
        	</div>
       	</div>
		<script src="js/bootstrap.js"></script>
    	<script src="js/jquery-3.2.1.js"></script>
	</body>
</html>
