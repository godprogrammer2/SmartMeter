<?php
	function calculateEnergy($watt,$select){
		if($watt<1)
			return 0;
		$kwh=$watt;
		$kwh_copy=$kwh;
		$ft=-0.2477;
		$service_chart_rate1=8.19;
		$service_chart_rate2=38.22;
		if($select==1)
		{
			if($kwh<=5)
			{
				$sum_money=0;
			}
			else if($kwh<=15)
			{
				$sum_money=$kwh*2.3488;
			}
			else if($kwh<=25)
			{
				$kwh-=15;
				$sum_money=$kwh*2.9882+35.232;
			}
			else if($kwh<=35)
			{
				$kwh-=25;
				$sum_money=$kwh*3.2405+65.114;
			}
			else if($kwh<=100)
			{
				$kwh-=35;
				$sum_money=$kwh*3.6237+97.519;
			}
			else if($kwh<=150)
			{
				$kwh-=100;
				$sum_money=$kwh*3.7171+333.0595;
			}
			else if($kwh<=400)
			{
				$kwh-=150;
				$sum_money=$kwh*4.2218+518.9145;
			}
			else
			{
				$kwh-=400;
				$sum_money=$kwh*4.4217+1574.3645;
			}
			$sum_money+=$service_chart_rate1;
		}
		else if($select==2)
		{
			if($kwh<=150)
			{
				$sum_money=$kwh*3.2484;
			}
			else if($kwh<=400)
			{
				$kwh-=150;
				$sum_money=$kwh*4.2218+487.26;
			}
			else
			{
				$kwh-=400;
				$sum_money=$kwh*4.4217+1542.71;
			}
			$sum_money+=$service_chart_rate2;
		}
		else
		{
			return -1;
		}
		$sum_money+=$kwh_copy*$ft;
		$sum_money+=$sum_money*0.07;
		return number_format(round($sum_money,2),2,'.','');
	}
	if(isset($_GET['val']))
	{
			echo calculateEnergy($_GET['val'],$_GET['spec']);
	}
	
?>
