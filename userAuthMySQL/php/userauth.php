<?php

require_once "../config.php";

$email = $_POST['email'];
$fullnames = $_POST['fullnames'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$country = $_POST['country'];

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db();
   //check if user with this email already exist in the database

    $result = queryMysql("SELECT * FROM Students WHERE email='$email'");
    $result = mysqli_query($conn, $sql);

	if ($result->num_rows) {
		echo '<div class="alert alert-danger" role="alert">That username already exists</div>';
      }
      else
      {
        mysqli_query("INSERT INTO users VALUES ($fullnames, $email, $password, $gender, $country)");
        echo '<div class="alert alert-success" role="alert">User Successfully registered</div>';
      }
}


//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();

    echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard
    $sql = "SELECT * FROM Students where email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
	
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
	
	if($count == 1){  
            header('Location: /dasbboard.php');  
        }
	else{  
            loginUser()
        }     
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
	$newpassword = $_POST['newpassword'];
    echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
    //open connection to the database and check if username exist in the database
    //if it does, replace the password with $password given
	$sql = "SELECT * FROM Students where email = '$email'";
    $result = mysqli_query($conn, $sql);
	
	$count = mysqli_num_rows($result);  
	
	if($count != 1){
		echo '<div class="alert alert-success" role="alert">User does not exist</div>';
	}
	
	else{
		mysqli_query("UPDATE users SET password='$newpassword' WHERE username='$email'");
        echo '<div class="alert alert-success" role="alert">Password has been changed.</div>';

        }     
}

function getusers(){ma
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();
     //delete user with the given id from the database
    if (isset($_GET['action'])) {
      if ($_GET['action'] == "delete") {

        $user_id = $_GET['id'];
		$sql = "'DELETE FROM STUDENTS WHERE email = '$email'";
		$result = mysqli_query($conn, $sql);;
 }


        