<?php
require_once 'SkolzyashiClass.php';


$path='weather_statistics.csv';
$Objskolz=new MyFile($path);
$myfile='my_weather_statistics.csv';
$Objskolz->CreateMyDatas();
$Objskolz->SrednScolz('month');
$Objskolz->SaveDatas($myfile);
?>
<html>
<body>
<table border=1>
	<tr>
		<td>
			Дата
		</td>
		<td>
			Исходное значение
		</td>
		<td>
			Среднее скользящее за месяц
		</td>
	</tr>
<?php
foreach ($Objskolz->myfile as $key => $value) 
{
?>
	<tr style='background:<?php echo $color?>;'>
		<td>
			<?php echo $value['day'].' '.$value['time'] ?>
		</td>
		<td>
			<?php echo $value[1] ?>
		</td>
		<td>
			<?php echo $value['srednskolz']['month']?>
		</td>
	</tr>
<?php
}
?>
</table>
</body>
</html>	
<?php
?>