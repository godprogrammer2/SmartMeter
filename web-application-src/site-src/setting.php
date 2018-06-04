<?php
	include"connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-size:3vw;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0"  />
         <meta http-equiv="refresh" content="2">
		<link href="css/bootstrap.css" rel="stylesheet"  />
        <link href="css/style.css" rel="stylesheet"  />
        <link href="css/bootstrap-theme.css" rel="stylesheet"  />
        <!--[if It IE 9]>
        	<script scr="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script scr="http://oss.maxcdn.com/libs/html5shiv/1.4.2/respond.min.js"></script>
        <![endif] -->
		<title>Current_data</title>

	</head>
	<body style="background-color:#0CF;">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="col-md-12" style="font-size:25px;">
					<?php
						$sql="SELECT * FROM smartFarmCurrentData";
						$result=mysql_query($sql);
						
						echo '<table>';
						echo '<tr>';
						echo '<td>';
						echo 'ตั้งสถานะจ่ายน้ำ';
						echo '</td>';
						echo '<td>';
						echo 'ตั้งโหมดจ่ายน้ำ';
						echo '</td>';
						echo '</tr>';
						if($result)
						{
							$i=1;
							while($read=mysql_fetch_assoc($result))
							{
								echo '<tr>';
								echo '<td>';
								echo '<form action="#" method="get">';
								if($read['status']==0)
								{
									echo '<button id="sw';
									echo $i;
									echo '" name="sw" onClick="window.location.replace(\'index.php\')" value="';
									echo $i;
									echo '">เปิดน้ำ';
									echo '</button>';
								}
								else
								{
									echo '<button name="sw" onClick="window.location.replace(\'index.php\')" value="';
									echo $i;
									echo '">ปิดน้ำ';
									echo '</button>';
								}
								echo '</form>';
								echo '</td>';
								echo '<td>';
								echo '<form action="#" method="get">';
								if($read['mode']==0)
								{
									echo '<button name="mo" onClick="window.location.replace(\'index.php\')" value="';
									echo $i;
									echo '">กำหนดเอง';
									echo '</button>';
								}
								else
								{
									echo '<button name="mo" onClick="window.location.replace(\'index.php\')" value="';
									echo $i;
									echo '">อัตโนมัติ';
									echo '</button>';
								}
								echo '</form>';
								echo '</td>';
								echo '</tr>';
								$i++;
							}
						}
						else
						{
							echo mysql_error();
						}
						echo '</table>';
						
					?>
				</div>
			</div>
		</div>
		<?php
//set status--------------------------------------------------------------------------------------------------
		if(isset($_GET['sw']))
		{
			$sw=$_GET['sw'];
			if($sw==1)
			{
				$sql="UPDATE smartFarmCurrentData SET mode = 1 WHERE id = 1";
				$result=mysql_query($sql);
				if($result)
				{
					echo "mode change success<br />";
				}
				else
				{
					echo mysql_error();
				}
				$sql="SELECT * FROM smartFarmCurrentData WHERE id = 1 ";
				$result=mysql_query($sql);
				if($result)
				{
					$check=mysql_fetch_assoc($result);
					if($check['status']==0)
					{
						$sql="UPDATE smartFarmCurrentData SET status = 1 WHERE id = 1";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessOpen';
						}
						else
						{
							echo mysql_error();
						}
					}
					else
					{
						$sql="UPDATE smartFarmCurrentData SET status = 0 WHERE id = 1";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessClose';
						}
						else
						{
							echo mysql_error();
						}
					}
				}
				else
				{
					echo mysql_error();
				}
			}
			else if($sw==2)
			{
				$sql="UPDATE smartFarmCurrentData SET mode = 1 WHERE id = 2";
				$result=mysql_query($sql);
				if($result)
				{
					echo "mode change success<br />";
				}
				else
				{
					echo mysql_error();
				}
				$sql="SELECT * FROM smartFarmCurrentData WHERE id = 2 ";
				$result=mysql_query($sql);
				if($result)
				{
					$check=mysql_fetch_assoc($result);
					if($check['status']==0)
					{
						$sql="UPDATE smartFarmCurrentData SET status = 1 WHERE id = 2";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessOpen';
						}
						else
						{
							echo mysql_error();
						}
					}
					else
					{
						$sql="UPDATE smartFarmCurrentData SET status = 0 WHERE id = 2";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessClose';
						}
						else
						{
							echo mysql_error();
						}
					}
				}
				else
				{
					echo mysql_error();
				}
			}
			else if($sw==3)
			{
					$sql="UPDATE smartFarmCurrentData SET mode = 1 WHERE id = 3";
				$result=mysql_query($sql);
				if($result)
				{
					echo "mode change success<br />";
				}
				else
				{
					echo mysql_error();
				}
				$sql="SELECT * FROM smartFarmCurrentData WHERE id = 3 ";
				$result=mysql_query($sql);
				if($result)
				{
					$check=mysql_fetch_assoc($result);
					if($check['status']==0)
					{
						$sql="UPDATE smartFarmCurrentData SET status = 1 WHERE id = 3";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessOpen';
						}
						else
						{
							echo mysql_error();
						}
					}
					else
					{
						$sql="UPDATE smartFarmCurrentData SET status = 0 WHERE id = 3";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessClose';
						}
						else
						{
							echo mysql_error();
						}
					}
				}
				else
				{
					echo mysql_error();
				}
			}
			else if($sw==4)
			{
					$sql="UPDATE smartFarmCurrentData SET mode = 1 WHERE id = 4";
				$result=mysql_query($sql);
				if($result)
				{
					echo "mode change success<br />";
				}
				else
				{
					echo mysql_error();
				}
				$sql="SELECT * FROM smartFarmCurrentData WHERE id = 4 ";
				$result=mysql_query($sql);
				if($result)
				{
					$check=mysql_fetch_assoc($result);
					if($check['status']==0)
					{
						$sql="UPDATE smartFarmCurrentData SET status = 1 WHERE id = 4";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessOpen';
						}
						else
						{
							echo mysql_error();
						}
					}
					else
					{
						$sql="UPDATE smartFarmCurrentData SET status = 0 WHERE id = 4";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessClose';
						}
						else
						{
							echo mysql_error();
						}
					}
				}
				else
				{
					echo mysql_error();
				}
			}
			header("location:setting.php");
		}
//set mode--------------------------------------------------------------------------------------------------
		if(isset($_GET['mo']))
		{
			$mo=$_GET['mo'];
			if($mo==1)
			{
				$sql="SELECT * FROM smartFarmCurrentData WHERE id = 1 ";
				$result=mysql_query($sql);
				if($result)
				{
					$check=mysql_fetch_assoc($result);
					if($check['mode']==0)
					{
						$sql="UPDATE smartFarmCurrentData SET mode = 1 WHERE id = 1";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessOpen';
						}
						else
						{
							echo mysql_error();
						}
					}
					else
					{
						$sql="UPDATE smartFarmCurrentData SET mode = 0 WHERE id = 1";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessClose';
						}
						else
						{
							echo mysql_error();
						}
					}
				}
				else
				{
					echo mysql_error();
				}
			}
			else if($mo==2)
			{
				$sql="SELECT * FROM smartFarmCurrentData WHERE id = 2 ";
				$result=mysql_query($sql);
				if($result)
				{
					$check=mysql_fetch_assoc($result);
					if($check['mode']==0)
					{
						$sql="UPDATE smartFarmCurrentData SET mode = 1 WHERE id = 2";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessOpen';
						}
						else
						{
							echo mysql_error();
						}
					}
					else
					{
						$sql="UPDATE smartFarmCurrentData SET mode = 0 WHERE id = 2";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessClose';
						}
						else
						{
							echo mysql_error();
						}
					}
				}
				else
				{
					echo mysql_error();
				}
			}
			else if($mo==3)
			{
				$sql="SELECT * FROM smartFarmCurrentData WHERE id = 3 ";
				$result=mysql_query($sql);
				if($result)
				{
					$check=mysql_fetch_assoc($result);
					if($check['mode']==0)
					{
						$sql="UPDATE smartFarmCurrentData SET mode = 1 WHERE id = 3";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessOpen';
						}
						else
						{
							echo mysql_error();
						}
					}
					else
					{
						$sql="UPDATE smartFarmCurrentData SET mode = 0 WHERE id = 3";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessClose';
						}
						else
						{
							echo mysql_error();
						}
					}
				}
				else
				{
					echo mysql_error();
				}
			}
			else if($mo==4)
			{
				$sql="SELECT * FROM smartFarmCurrentData WHERE id = 4 ";
				$result=mysql_query($sql);
				if($result)
				{
					$check=mysql_fetch_assoc($result);
					if($check['mode']==0)
					{
						$sql="UPDATE smartFarmCurrentData SET mode = 1 WHERE id = 4";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessOpen';
						}
						else
						{
							echo mysql_error();
						}
					}
					else
					{
						$sql="UPDATE smartFarmCurrentData SET mode = 0 WHERE id = 4";
						$result=mysql_query($sql);
						if($result)
						{
							echo 'SuccessClose';
						}
						else
						{
							echo mysql_error();
						}
					}
				}
				else
				{
					echo mysql_error();
				}
			}
			header("location:setting.php");
		}
		?>
	</body>
</html>

