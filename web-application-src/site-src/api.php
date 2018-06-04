<?php
	include"connect.php";
	include"calculate.php";
	if(isset($_GET['id']))
	{ 
		$id=$_GET['id'];
		$time=$_GET['t'];
		$data=$_GET['d'];
		$amp=$_GET['nd'];
		if($amp<0.1)
		{
			$amp=0;
			$data=0;
		}
		$sql="SELECT limit_ampere FROM {$id} WHERE id= (SELECT * FROM (SELECT MAX(id) FROM {$id}) as id)";
		$result=mysql_query($sql);
		$result=mysql_fetch_assoc($result);
		echo "limit:".$result['limit_ampere']."\n";
		if($data<8)$data=0;
		//$data=3600000;
		$sql="SELECT time FROM {$id} WHERE id = 1";
		$result=mysql_query($sql);
		if($result)
		{
			$check_bill="SELECT * FROM data_area WHERE device_id='{$id}'";
			$result2=mysql_query($check_bill);
			if($result2)
			{
				$result2=mysql_fetch_assoc($result2);
				if($result2['cal_day']==32)
				{
					$date=32;
				}
				else
				{
					$date=$result2['cal_day'];
				}
				$type=$result2['month_status'];
			}
			else
			{
				echo mysql_error();
			}		
			$check=mysql_fetch_assoc($result);
			if($check['time']==-1)
			{   
				$data=$data/1000/3600;
				if($type==0)
					$type=-1;
				else if($type>0)
					$type=1;
				else if($type<0)
					$type=2;
				$money_put = calculateEnergy(floor($data),$type);
				$sql="UPDATE {$id} SET time = '-2',watt = '-2' WHERE id=1";
				if(mysql_query($sql))
				{
					$sql="INSERT INTO {$id}(time,watt,money,ampere) VALUE ('{$time}','{$data}','{$money_put}','{$amp}')";
					if(mysql_query($sql))
					{
						echo "insert data success";
					}
					else
					{
						echo mysql_error();
					}
				}
				else
				{
					echo mysql_error();
				}
			}
			else if($check['time']== -2)
			{
				$sql="SELECT * FROM {$id} WHERE id = (SELECT MAX(id) FROM {$id})";
				$result=mysql_query($sql);
				if($result)
				{
					$check=mysql_fetch_assoc($result);
					if($check['time']!=$time)
					{
						if($date==32)
						{
							$ck_month_db=$check['time'][3]*10+$check['time'][4];
							$ck_month_up=$time[3]*10+$time[4];
							$data=$data/1000/3600;
							if($ck_month_db!=$ck_month_up)
							{
								$update_month_status="SELECT * FROM data_area WHERE device_id='{$id}'";
								$update_month_status=mysql_query($update_month_status);
								if($update_month_status)
								{
									$update_month_status=mysql_fetch_assoc($update_month_status);
									$month_status=$update_month_status['month_status'];
								}
								else
								{
									echo mysql_error();
								}
								if($check['watt']<=150)
								{
									if($month_status+1<0)
									{
										$month_status++;
										$type=$month_status;
										$month_status_update="UPDATE data_area SET month_status='{$month_status}' WHERE device_id='{$id}'";
										if(mysql_query($month_status_update))
										{
											echo "update month status success";
										}
										else
										{
											echo mysql_error();
										}
										
									}
									else 
									{
										$month_status_update="UPDATE data_area SET month_status=3 WHERE device_id='{$id}'";
										$type=3;
										if(mysql_query($month_status_update))
										{
											echo "update month status success";
										}
										else
										{
											echo mysql_error();
										}
										
									}
									
								}
								else
								{
									if($month_status-1>0)
									{
										$month_status--;
										$type=$month_status;
										$month_status_update="UPDATE data_area SET month_status='{$month_status}' WHERE device_id='{$id}'";
										if(mysql_query($month_status_update))
										{
											echo "update month status success";
										}
										else
										{
											echo mysql_error();
										}
										
									}
									else 
									{
										$type=-3;
										$month_status_update="UPDATE data_area SET month_status=-3 WHERE device_id='{$id}'";
										if(mysql_query($month_status_update))
										{
											echo "update month status success";
										}
										else
										{
											echo mysql_error();
										}
									}
								}
								if($type==0)
									$type=-1;
								else if($type>0)
									$type=1;
								else if($type<0)
									$type=2;
								$money_put = calculateEnergy(floor($data),$type);
								$sql="INSERT INTO {$id} (time,watt,money,ampere) VALUES ('{$time}','{$data}','{$money_put}','{$amp}')";
								if(mysql_query($sql))
								{
									echo "Update New Month<br />";
								}
								else
								{
									echo mysql_error;
								}
								
							}
							else
							{
								$data = $data+$check['watt']; 
								if($type==0)
									$type=-1;
								else if($type>0)
									$type=1;
								else if($type<0)
									$type=2;
								$money_put = calculateEnergy(floor($data),$type);
								$sql="UPDATE {$id} SET `time`='{$time}',`watt`='{$data}',`money`='{$money_put}',`ampere`='{$amp}' WHERE id = (SELECT * FROM (SELECT MAX(id) FROM {$id}) as id)";
								if(mysql_query($sql))
								{
									echo "Update success";
								}
								else
								{
									echo mysql_error();
								}
							}
						}
						else
						{
							$ck_date_db=$check['time'][0]*10+$check['time'][1];
							$ck_date_up=$time[0]*10+$time[1];
							$data=$data/1000/3600;
							if($ck_date_db==$date&&$ck_date_up!=$ck_date_db)
							{
								$update_month_status="SELECT * FROM data_area WHERE device_id='{$id}'";
								$update_month_status=mysql_query($update_month_status);
								if($update_month_status)
								{
									$update_month_status=mysql_fetch_assoc($update_month_status);
									$month_status=$update_month_status['month_status'];
								}
								else
								{
									echo mysql_error();
								}
								if($check['watt']<=150)
								{
									if($month_status+1<0)
									{
										$month_status++;
										$type=$month_status;
										$month_status_update="UPDATE data_area SET month_status='{$month_status}' WHERE device_id='{$id}'";
										if(mysql_query($month_status_update))
										{
											echo "update month status success";
										}
										else
										{
											echo mysql_error();
										}
										
									}
									else 
									{
										$month_status_update="UPDATE data_area SET month_status=3 WHERE device_id='{$id}'";
										$type=3;
										if(mysql_query($month_status_update))
										{
											echo "update month status success";
										}
										else
										{
											echo mysql_error();
										}
										
									}
									
								}
								else
								{
									if($month_status-1>0)
									{
										$month_status--;
										$type=$month_status;
										$month_status_update="UPDATE data_area SET month_status='{$month_status}' WHERE device_id='{$id}'";
										if(mysql_query($month_status_update))
										{
											echo "update month status success";
										}
										else
										{
											echo mysql_error();
										}
										
									}
									else 
									{
										$type=-3;
										$month_status_update="UPDATE data_area SET month_status=-3 WHERE device_id='{$id}'";
										if(mysql_query($month_status_update))
										{
											echo "update month status success";
										}
										else
										{
											echo mysql_error();
										}
									}
								}
								if($type==0)
									$type=-1;
								else if($type>0)
									$type=1;
								else if($type<0)
									$type=2;
								$money_put = calculateEnergy(floor($data),$type);
								$sql="INSERT INTO {$id} (time,watt,money,ampere) VALUES ('{$time}','{$data}','{$money_put}','{$amp}')";
								if(mysql_query($sql))
								{
									echo "Update New Month<br />";
								}
								else
								{
									echo mysql_error;
								}
								
							}
							else
							{
								$data = $data+$check['watt']; 
								if($type==0)
									$type=-1;
								else if($type>0)
									$type=1;
								else if($type<0)
									$type=2;
								$money_put = calculateEnergy(floor($data),$type);
								$sql="UPDATE {$id} SET `time`='{$time}',`watt`='{$data}',`money`='{$money_put}',`ampere`='{$amp}' WHERE id = (SELECT * FROM (SELECT MAX(id) FROM {$id}) as id)";
								if(mysql_query($sql))
								{
									echo "Update success";
								}
								else
								{
									echo mysql_error();
								}
							}
						}
			            
						
					}

				}
				else
				{
					echo mysql_error();
				}
			}
			else 
			{
				echo mysql_error();
			}
			
		}
		else
		{
			echo mysql_error();
		}		
			
		
	}
	else if(isset($_GET['q']))
	{
			if($_GET['q']=="get_watt")
			{
				
				$sql="SELECT * FROM"." ".$_GET['device_id']." "; 
				$sql.="WHERE id = (SELECT MAX(id) FROM {$_GET['device_id']})";
				$result=mysql_query($sql);
				if($result)
				{
					$result=mysql_fetch_assoc($result);
					$kwh=$result['watt'];
					echo '<div align="right" style="padding-right:18%;">';
					echo '<label for="watt" style="font-size:1rem;margin-right:3%;">พลังงานไฟฟ้าที่ใช้ไป</label>';
					echo '<input  id="watt"class="" style="margin-top:5%;margin-bottom:2%;text-align:right;width:40%;font-size:1rem;" type="text" name="kwh" readonly="readonly" value="'.number_format($kwh,6).'"/>';
					echo '<label for="watt" style="font-size:1rem;margin-left:3%;">kWh</label>';
					echo '<br />';
					echo '<label for="money" style="font-size:1rem;margin-right:3%;">คิดเป็นเงิน</label>';
					echo '<input  id="money"class="" style="margin-bottom:2%;text-align:right;width:40%;font-size:1rem;margin-right:0.5%;" type="text" name="kwh" readonly="readonly" value="'.number_format($result['money'],2).'"/>';
					echo '<label for="money" style="font-size:1rem;margin-left:3%;">บาท</label>';
					echo '<br />';
					echo '<label for="ampere" style="font-size:1rem;margin-right:3%;">กระแสไฟฟ้าปัจจุบัน</label>';
					echo '<input  class="" style="text-align:right;width:40%;font-size:1rem;"type="text" name="ampere" id="ampere" readonly="readonly" value="'.$result['ampere'].'"/>';
					echo '<label for="ampere" style="font-size:1rem;margin-left:0%;">แอมแปร์</label>';
					echo '<br />';
					echo '<label for="limit_ampere" style="font-size:1rem;margin-right:3%;">จำกัดกระแสไฟฟ้า</label>';
					echo '<input  class="" style="text-align:right;width:40%;font-size:1rem;"type="text" name="limit_ampere" id="limit_ampere" readonly="readonly" value="'.$result['limit_ampere'].'"/>';
					echo '<label for="limit_ampere" style="font-size:1rem;margin-left:0%;">แอมแปร์</label>';
					echo '<br />';
					echo '<label for="time" style="font-size:1rem;margin-right:3%;">อัพเดตเมื่อ</label>';
					echo '<input  class="" style="text-align:right;width:40%;font-size:1rem;"type="text" name="time" id="time" readonly="readonly" value="'.$result['time'].'"/>';
					echo '<label for="time" style="font-size:1rem;margin-left:7%;">น.</label>';
					echo '</div>';
				}
				else
				{
					
					echo mysql_error();
				}
			}
			else if($_GET['q']=='get_static')
			{
				header("Content-type:application/json; charset=UTF-8");        
				header("Cache-Control: no-store, no-cache, must-revalidate");       
				header("Cache-Control: post-check=0, pre-check=0", false);  
				$sql="SELECT * FROM"." ".$_GET['device_id']." "; 
				$sql.="WHERE time LIKE '%{$_GET['year']}%'";
				$json_data[] = array('เดือน','ปริมาณพลังงานไฟฟ้า(kWh)','ค่าไฟฟ้า(บาท)');
				$thai_month=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");  
				$result=mysql_query($sql);
				if($result)
				{
					while($data=mysql_fetch_assoc($result))
					{
						$month=$data['time'][3]*10+$data['time'][4]-1;
						$date_put=$data['time'][0]*10+$data['time'][1];
						$json_data[]=array($date_put.$thai_month[$month],floatval($data['watt']),floatval($data['money']));
					}
					$json=json_encode($json_data);
					echo $json;
				}
				else
				{
					echo mysql_error();
				}
			}

	}
		
	
?>
