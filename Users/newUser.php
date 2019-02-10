<?php
	include '../connect.php';
	include '../session.php';

	if (isset($_POST['save'])) {

		$firstName=ucwords(mysqli_real_escape_string($con, $_POST['firstName']));
		$middleName =ucwords(mysqli_real_escape_string($con, $_POST['middleName']));
		$lastName=ucwords(mysqli_real_escape_string($con, $_POST['lastName'])); 
		$role = mysqli_real_escape_string($con,($_POST['role']));
		$civilStatus = ucwords(mysqli_real_escape_string($con,ucfirst($_POST['civilStatus'])));
		$birthDate= $_POST['birthDate'];
		$homeAddress= ucwords(mysqli_real_escape_string($con,$_POST['homeAddress']));
		$currentAddress= ucwords(mysqli_real_escape_string($con,$_POST['currentAddress']));
		$contactNum= mysqli_real_escape_string($con,$_POST['contactNum']); 
		$contactNum2 = mysqli_real_escape_string($con,$_POST['contactNum2']);
		$emailAdd = mysqli_real_escape_string($con,$_POST['emailAdd']);
		$dateCreated=date("Y-m-d");

		//username and password is auto generated when adding new user. 
		$username = $firstName[0].$middleName[0].$lastName;
		$password = md5($birthDate);
		

		$sql = "INSERT INTO user (firstName, middleName, lastName,civilStatus, birthDate, homeAddress, currentAddress,role, contactNum, contactNum2, emailAdd, username, password, picture,status,dateCreated) VALUES ('$firstName','$middleName','$lastName','$civilStatus','$birthDate','$homeAddress','$currentAddress','$role','$contactNum', '$contactNum2','$emailAdd','$username',
		   '$password','default.jpg','active', '$dateCreated')";

         $run= mysqli_query($con,$sql);

		if ($run) {
		   
		    header("Location:usersList.php?success=User successfully added");
		} 
		else {
		    header("Location:usersList.php?error=Sorry, could not add new user, Try again");
		}
	}
		
?>