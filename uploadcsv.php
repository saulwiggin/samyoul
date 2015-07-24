<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<php>

// A code to upload a csv file with payroll information to a database and display the 
// data to the user.

// define database
$servername = "localhost";
$username = "saulwiggin";
$password = "";
$dbname = "upload";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// sql to create table
$sql = "CREATE TABLE PayrollRecords (
Staff_Member_Name VARCHAR(60) NOT NULL, 
First_Name VARCHAR(60) NOT NULL,
Middle_Name VARCHAR(60),
Family_Name VARCHAR(60),
Payroll_Ref VARCHAR (60),
Total_Hours_Worked INT (6),
Total_Pay DECIMAL(6,6),
//THIS IS IN EPOCHS for unix timestamp
Work_Date int(6)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$file = fopen("upload.csv","r");


while(! feof($file))

  {
	
	$array = fgetcsv($file);
	
	$three_names = explode($array[1]);

	$sql = "INSERT INTO PayrollRecords (Staff_Member_Name, First_Name, Middle_Name, Family_Name, Payroll_Ref, Total_Hours_Worked, Total_Pay, Work_Date)
	VALUES ($array[1], $three_names[1], $three_names[2], $three_names[3], $array[2], $array[3], $array[4], UNIX_TIMESTAMP($array[5]))";
  
	echo $array[1] . "</br>";
	echo $three_names[1] . "</br>";
	echo $three_names[2] . "</br>";
	echo $three_names[3] . "</br>";
	echo $array[2] . "</br>";
	echo $array[3] . "</br>";
	echo $array[4] . "</br>";
	echo $array[5] . "</br>";
  
  }

//test connection if record was created
if ($conn->query($sql) === TRUE) {
    echo "New record created";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

fclose($file);

<?php>
</body>
</html>