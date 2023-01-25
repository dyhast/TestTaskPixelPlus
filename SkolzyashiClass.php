<?php
class MyFile
{
	public $file;
	public $myfile;
	public $srednskolz;

  	public function __construct($path)
  	{

    	$this->file = file($path);
  	}



		public function CreateMyDatas()
		{
			$week=52;
			array_shift($this->file);
		  	foreach ($this->file as $key => $value) 
			{
			 	$row = str_getcsv($value,';');
			 	$date = explode(' ', $row[0]);

				$bigday = $date[0];
				$month = explode('.', $bigday);
				$month = $month[1];
				$time = $date[1];


				$timeweek = new DateTime($bigday);
				$dateweek = $timeweek->format('w');

				if ($dateweek==0 && $day!=$bigday)
				{
					$day=$bigday;
					$week--;
				}

				$row['week']=$week;
				$row['day']=$bigday;
				$row['time']=$time;
				$row['month']=$month;

				$this->myfile[]=$row;

			 	/*fputcsv($myfile, $row, ';');
			 	$this->myfile = file($path);*/
			}
		}

		public function SrednScolz($param)
		{
			foreach ($this->myfile as $key => $value) 
			{
			 	$row =$value;
				if (($checkday !== $row[$param]) or empty($checkday))
				{
					$checkday=$row[$param];
					$temperature=$row[1];
					$count=1;
					while(true)
					{	
						$temp=next($this->myfile);
						if ($temp[$param] !== $checkday)
						{
							break;
						}
						$count++;
						$temperature+=$temp[1];
					}
					$this->srednskolz=number_format(($temperature/$count), 2,',','');
					
				}
				$this->myfile[$key]['srednskolz'][$param]=$this->srednskolz;
			}
			unset ($temp, $temperature, $count);
			return $this->myfile;
		}


		public function SaveDatas($path)
		{	
			$myfile=fopen($path, "w");
			foreach ($this->myfile as $key => $value) 
			{
				fputcsv($myfile, $value, ';');
			}
			
		}
}
?>