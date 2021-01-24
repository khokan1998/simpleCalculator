<?php 
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, "demo");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "DB Connected successfully" . "</br>";

$fnum = "";
$result = "";
$mysqli = "";




$fnum = isset($_POST['fnum']) ? $_POST['fnum'] : '';
$result = isset($_POST['fnum']) ?  eval('return '.$fnum.';') : 0;



$sql = "INSERT INTO calculator (fnum, result)
VALUES ('$fnum', '$result')";

if ($conn->query($sql) === TRUE) {
  echo "New Calculus created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$sql = "SELECT fnum, result FROM Calculator";
$results = $conn->query($sql);


$conn->close();

?>


<!DOCTYP html>
<html>
	<head>
		<title>Calculator</title>



	</head>
	<body>
		<form method="post">
		<table border="1" align="center">
			<tr>
				<th>Your Result</th>
				<th><input type="number" readonly="readonly" disabled="disabled" value="<?php  echo @$result;?>"/></th>
			</tr> 
			
			<tr>
				<th>Enter your  num</th>
				<th><input type="text" id="ptr" oninput="onlynum()" name="fnum" value="<?php  echo @$fnum;?>"/></th>
			</tr> 
			<tr>
				
				<th colspan="2">
                    <input type="submit" name="save" value="Show Result"/>
					
				</th>
			</tr>
		</table>
		</form>
		<table border="1" align="center">
		<tr>
			<th>History</th>
		</tr>
		<tr>
		<td>
			<?php if ($results->num_rows > 0) {
    
    while($row = $results->fetch_assoc()) {
        echo "<br> Input Number: ". $row["fnum"]. " Results: ". $row["result"] . "<br>";
    }
} else {
    echo "0 results";
}
 ?>
		</td>
		</tr>
		</table>
	</body>
</html>