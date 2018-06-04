<?php
	session_start();
	include("connect.php");
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
		<title>Set Ft</title>

	</head>
	<body style="background-color:#0CF;">
		<div class="container-fluid">
			<div class="row-fluid" style="margin-top:1%;">
				<div class="col-md-12" align="center">
					<?php
						$sql="SELECT * FROM data_area WHERE user_name='{$_SESSION['user_name']}'";
						$result=mysql_query($sql);
						if($result)
						{
							$result=mysql_fetch_assoc($result);
							if($result['month_status']==0)
							{
								$status="ไม่พบข้อมูล";
							}
							else if($result['month_status']==3)
							{
								$status="ประวัติใช้ไฟไม่เกิน 150 หน่วย ติดต่อกัน 3 เดือนขึ้นไป";
							}
							else if($result['month_status']==2)
							{
								$status="ประวัติใช้ไฟเกิน 150 หน่วย ติดต่อกัน 1 เดือน";
							}
							else if($result['month_status']==1)
							{
								$status="ประวัติใช้ไฟเกิน 150 หน่วย ติดต่อกัน 2 เดือน";
							}
							else if($result['month_status']==-3)
							{
								$status="ประวัติใช้ไฟเกิน 150 หน่วย ติดต่อกัน 3 เดือนขึ้นไป";
							}
							else if($result['month_status']==-2)
							{
								$status="ประวัติใช้ไฟไม่เกิน 150 หน่วย ติดต่อกัน 1 เดือน";
							}
							else if($result['month_status']==-1)
							{
								$status="ประวัติใช้ไฟไม่เกิน 150 หน่วย ติดต่อกัน 2 เดือน";
							}
							if($result['month_status']==0)
							{
								$cal_date="ไม่พบข้อมูล";
							}
							else if($result['cal_day']==32)
							{
								$cal_date="คำนวณรอบบิลวันที่สุดท้ายของทุกเดือน";
							}
							else
							{
								$cal_date="คำนวณรอบบิลวันที่".$result['cal_day']."ของทุกเดือน";
							}
						}
						else
						{
							echo mysql_error();
						}
						
					?>
					<label for="lastest" style="width:auto;"class="">สถานะการใช้งานปัจจุบัน</label>
					<input type="text" style="width:320px;"class="form-control" name="cal_method" id="lastest" value="<?php if($result['month_status']>0)echo "ปัจจุบันคำนวณตามอัตราใช้ไฟฟ้าไม่เกิน 150 หน่วย"; else if($result['month_status']<0) echo "ปัจจุบันคำนวณตามอัตราใช้ไฟฟ้าเกิน 150 หน่วย"; else echo "ไม่พบข้อมูล";?>" style="width:50%;text-align:center;margin:10px;" readonly="readonly"/>
					<input type="text" style="width:320px;"class="form-control" name="lastest" id="lastest" value="<?php echo $status; ?>" style="width:50%;text-align:center;margin:10px;" readonly="readonly"/>
					<input type="text" style="width:320px;"class="form-control" name="cal_date" id="lastest" value="<?php echo $cal_date; ?>" style="width:50%;text-align:center;margin:10px;" readonly="readonly"/>
					<label for="new_satus" style="width:auto;"class="">กำหนดสถานะการใช้งานใหม่</label>
					<form class="form-horizontal" id="new_satus" action="#" method="post">
							<select name="current_cal_method" class="btn btn-default" required="required" style="margin:5px;">
								<option value="">กรุณาเลือกรูปแบบการคำนวณไฟฟ้าปัจจุบันของคุณ</option>
								<option value="1">คำนวณตามอัตราใช้ไฟฟ้าไม่เกิน 150 หน่วย</option>
								<option value="-1">คำนวณตามอัตราใช้ไฟฟ้าเกิน 150 หน่วย</option>
							</select>
							<br />
							<select name="status" class="btn btn-default" required="required" style="margin:5px;">
								<option value="">กรุณาเลือกประวัติปริมาณการใช้ไฟฟ้า</option>
								<option value="1">ใช้ไฟไม่เกิน 150 หน่วย</option>
								<option value="-1">ใช้ไฟเกิน 150 หน่วย</option>
							</select>
							<select name="value" class="btn btn-default" required="required" style="margin:5px;">
								<option value="">กรุณาเลือกระยะเวลา</option>
								<option value="1">ติดต่อกัน 1เดือน</option>
								<option value="2">ติดต่อกัน 2เดือน</option>
								<option value="3">ติดต่อกัน 3เดือนขึ้นไป</option>
							</select>
							<br />
							<select name="cal_day" class="btn btn-default" required="required" style="margin:5px;">
								<option value="">กรุณาเลือกวันที่ที่ใช้คำนวณรอบบิล</option>
								<option value="1">วันที่1ของทุกเดือน</option>
								<option value="2">วันที่2ของทุกเดือน</option>
								<option value="3">วันที่3ของทุกเดือน</option>
								<option value="4">วันที่4ของทุกเดือน</option>
								<option value="5">วันที่5ของทุกเดือน</option>
								<option value="6">วันที่6ของทุกเดือน</option>
								<option value="7">วันที่7ของทุกเดือน</option>
								<option value="8">วันที่8ของทุกเดือน</option>
								<option value="9">วันที่9ของทุกเดือน</option>
								<option value="10">วันที่10ของทุกเดือน</option>
								<option value="11">วันที่11ของทุกเดือน</option>
								<option value="12">วันที่12ของทุกเดือน</option>
								<option value="13">วันที่13ของทุกเดือน</option>
								<option value="14">วันที่14ของทุกเดือน</option>
								<option value="15">วันที่15ของทุกเดือน</option>
								<option value="16">วันที่16ของทุกเดือน</option>
								<option value="17">วันที่17ของทุกเดือน</option>
								<option value="18">วันที่18ของทุกเดือน</option>
								<option value="19">วันที่19ของทุกเดือน</option>
								<option value="20">วันที่20ของทุกเดือน</option>
								<option value="21">วันที่21ของทุกเดือน</option>
								<option value="22">วันที่22ของทุกเดือน</option>
								<option value="23">วันที่23ของทุกเดือน</option>
								<option value="24">วันที่24ของทุกเดือน</option>
								<option value="25">วันที่25ของทุกเดือน</option>
								<option value="26">วันที่26ของทุกเดือน</option>
								<option value="27">วันที่27ของทุกเดือน</option>
								<option value="28">วันที่28ของทุกเดือน</option>
								<option value="32">วันที่สุดท้ายของทุกเดือน</option>
							</select>
							<div class="form-group" style="margin-top:10px;">					
								<label for="confirm_password" class="">ยืนยันรหัสผ่าน</label>
								<input type="password" name="confirm_password" id="confirm_password" class="form-control" style="width:30%;height:20%;" required="required"/>
								<button class="btn btn-default" name="save" style="margin:10px;">บันทึกข้อมูล</button>
							</div>
							
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
							$data=$_POST['status']*$_POST['value'];
							if($_POST['current_cal_method']==1&&$data>0)
							{
								$data=3;
							}
							else if($_POST['current_cal_method']==1&&$data<0)
							{
								$data=3+$data;
							}
							else if($_POST['current_cal_method']==-1&&$data>0)
							{
								$data=-3+$data;
							}
							else if($_POST['current_cal_method']==-1&&$data<0)
							{
								$data=-3;
							}
							$_SESSION['month_status']=$data;
							$sql="UPDATE data_area SET month_status = '{$data}',cal_day='{$_POST['cal_day']}'  WHERE user_name = '{$_SESSION['user_name']}'";
							if(mysql_query($sql))
							{
								echo'<script type="text/javascript">';
								echo "\r\n\t\t".'alert("บันทึกข้อมูลเรียบร้อย");';
								echo "\r\n\t\t".'window.location.replace("set_rate.php");';
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
						echo "\r\n\t\t".'window.location.replace("set_rate.php");';
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
?>	
	<html>
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

