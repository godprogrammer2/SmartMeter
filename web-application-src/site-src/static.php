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
		<title>Static</title>

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
		<script src="js/bootstrap.js"></script>
    	<script src="js/jquery-3.2.1.js"></script>
    	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
			google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback();
			function start(year_pass){
				if(year_pass==='')
				{
					document.getElementById('show_chart').innerHTML = '';
				}
				else
				{
					var options = { 
					title: 'ปี'+year_pass,
					hAxis: {title: '', titleTextStyle: {color: 'red'}},
					vAxis: {title: '', titleTextStyle: {color: 'blue'}},
					width: 900,
					height: 375,
					bar: {groupWidth: "70%"},
					legend: { position: 'right', maxLines: 3 },
					tooltip: { trigger: 'select' }
					};    
					$.getJSON( "api.php",{year:year_pass,q:'get_static',device_id:'<?php echo $_SESSION['device_id']; ?>' },function( data ) { 
					dataArray=data; 
					var data = google.visualization.arrayToDataTable(dataArray);
					var chart = new google.visualization.ColumnChart(document.getElementById('show_chart'));
					chart.draw(data, options);  
					
					});	
				}
			}
				 
		</script>     
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-md-12" align="center" style="margin-top:1%;margin-bottom:2%;">
					<select class="btn btn-default" style="padding-bottom:5px; font-family:'Kanit', sans-serif;" onchange="start(this.value);">
						<option value="">กรุณาเลือกปีที่จะแสดงผล</option>
						<?php
							include "connect.php";
							$sql="SELECT time FROM {$_SESSION['device_id']} WHERE id = 2";
							$result=mysql_query($sql);
							if($result)
							{
								$result=mysql_fetch_assoc($result);
								$min_year=$result['time'][6]*1000+$result['time'][7]*100+$result['time'][8]*10+$result['time'][9];
								$sql="SELECT time FROM {$_SESSION['device_id']} WHERE id = (SELECT MAX(id) FROM {$_SESSION['device_id']})";
								$result=mysql_query($sql);
								if($result)
								{
									$result=mysql_fetch_assoc($result);
									$max_year=$result['time'][6]*1000+$result['time'][7]*100+$result['time'][8]*10+$result['time'][9];
									while($min_year<=$max_year)
									{
										echo '<option value="'.$min_year.'">'.'ปี'.$min_year.'</optiont>';
										$min_year++;
									}
									
								}
								else
								{
									echo '<script>alert("'.mysql_error().'");</script>';
								}
							}
							else
							{
								echo '<script>alert("'.mysql_error().'");</script>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="row-fluid">
				<div class="col-md-12" align="center">
					<div id="show_chart" style="">
					</div>
				</div>
			</div>
		</div>
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



