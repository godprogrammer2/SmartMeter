<?php 
	
	session_start();
	if($_SESSION['check_sign']=='SmartMeter')
	{
		header("location:index.php");
		exit();
	}
	$_SESSION['frmAction'] = md5('SmartMeter'.rand(1,9999999));
	$_SESSION['test']=1234;
	
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
		<title>User Login</title>

	</head>
    	
	<body class="G">
    <div class="container-fluid" >
        	<div class="row-fluid">
				
            	<div class="col-md-12" style="margin-top:5%;text-align:center;" >
                      <img src="media/images/SmarMeter.png" style="width:300px;"/>
                    <form  method="post" action="login_action.php" style="text-align:center;">
                       	 <p style="font-family: 'Kanit', sans-serif;color:#000; font-size:25px; "> 
                         <br />ชื่อผู้ใช้งาน</p>
            				<input type="text" class="btn" name="user_name" required="required" value="kiadtisak"  style="width:300px;padding:12px;"/>
                            <br />
                            <br />
                            <br />
                        <p style="font-family: 'Kanit', sans-serif;color:#000; font-size:25px; "> 
                         รหัสผ่าน</p>
           				  <input type="password" class="btn" name="passwd" required="required" value="buangam" style="width:300px;padding:12px;"/>
                          <br /><br />
							<button class="btn btn-default" type="submit" style="font-family: 'Kanit', sans-serif;color:#000; font-size:20px;width:200px;height:40px;">เข้าสู่ระบบ</button>
							<input type="hidden" name="frmAction" value="<?php echo $_SESSION['frmAction']; ?>"/>
                     </form>   
                     		
                     		<p style="font-family: 'Kanit', sans-serif;color:#000; font-size:20px;   padding-top:10px;"> 
                        หรือ</p>
                     			<form action="sign_up.php">
                                
                            	<button class="btn btn-default" type="submit" style="font-family: 'Kanit', sans-serif;color:#000; font-size:20px;width:200px;height:40px;">ลงทะเบียน</button>
                                </form>
                                                        </div>
           			
        	</div>
       	</div>
		<script src="js/bootstrap.js"></script>
    	<script src="js/jquery-3.2.1.js"></script>
	</body>
</html>
