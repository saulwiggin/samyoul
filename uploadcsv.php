<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="page-header">
	<h1> Upload CSV file </h1>
</div>
<?php

// A code to upload a csv file with payroll information to a database and display the 
// data to the user.

$file = fopen("upload.csv","r");

$i = 0;

while(! feof($file))

  { 
	
	$array = fgetcsv($file);
	
	if ($i != 0){
		
		$three_names = explode(" ", $array[0]);
		
		if (count($three_names) != 3) {
			//echo "No Middle Name";
			array_push($three_names, "");
		}

	/* 	print_r($array);
		print_r($three_names); */
	
		$sql = "INSERT INTO PayrollRecords (Staff_Member_Name, First_Name, Middle_Name, Family_Name, Payroll_Ref, Total_Hours_Worked, Total_Pay, Work_Date)
		VALUES ($array[0], $three_names[0], $three_names[1], $three_names[2], $array[1], $array[2], $array[3], UNIX_TIMESTAMP($array[4]))";
	  
		echo "<b>Staff Member Name:</b> " . $array[0] . "<br>";
		//echo $three_names[0] . "<br>";
		//echo $three_names[1] . "<br>";
		//echo $three_names[2] . "<br>";
		echo "Payroll Ref: " . $array[1] . "<br>";
		echo "Total Hours Worked: " . $array[2] . "<br>";
		echo "Total Pay: " . $array[3] . "<br>";
		//format date
		echo "Work Date: " . date('d m Y',strtotime($array[4])) . "<br><hr>";
	}
	
	$i = $i + 1;
  
  }

fclose($file);

?>
</body>
</html>