<?php
$username = $_POST['username'];
$address= $_POST['Address'];
$city= $_POST['City'];
$gender= $_POST['gender'];
$email= $_POST['email'];
$phonecode= $_POST['PhoneCode'];
$phone= $_POST['phone'];
$action = htmlspecialchars($_GET['action']);
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($username) && !empty($address) && !empty($city)&& !empty($gender) && !empty($email) &&
 !empty($phonecode) && !empty($phone))
{
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "mycontacts";
	
	
	//create connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	
	if (mysqli_connect_error()) {
		die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
	}else {
		$sql="select email from mycontacts where email='$email' ";
		//echo "[".$sql."]";
		$result = $conn->query($sql);
		if($action == 'update') {
			$sql = "UPDATE mycontacts SET ". "name='$username', Address='$address', City='$city', gender='$gender', 
			phonecode=$phonecode, phone=$phone". " WHERE id=$id";
		} else {
			$sql="insert into mycontacts (name, address, city, gender, email, phonecode, phone) ";
			$sql.="values ('$username', '$address', '$city', '$gender', '$email', '$phonecode', '$phone')";
			
		}
		//echo $result."]";
		if ($result->num_rows > 0 && $action == 'insert') {
			echo "the email already exists";
		}else{
			$result=$conn->query($sql) or die(mysqli_error($conn));

			if($result){
				
				echo "Record Added successfully"; 
				echo "<br>";
				echo "<a href='list.php'> List View </a>";
			}else{
				echo "Err in sql[".$sql."]";
			}
		}
		
	}
	
	
	
}
else 
{
	echo "All field are required";
	die();
}	
?>