<?php

$con = mysqli_connect('localhost', 'root', '', 'unity_blokade');

if (mysqli_connect_errno()) 
{
    echo "1: Connection failed";
    exit();
    # code...
}

$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];



//check if username exists
$usernamecheckquery = "SELECT username FROM player WHERE username='".$username."';";

$usernamecheck = mysqli_query($con, $usernamecheckquery) or die("2: Name check query failed"); // erorr code #2 - name check query failed

if(mysqli_num_rows($usernamecheck) > 0)
{
    echo "3: Name already exists"; //erorr code #3 - name exists cannot register
    exit();
}

//check if email exists
$emailcheckquery = "SELECT email FROM player WHERE email='".$email."';";

$emailcheck = mysqli_query($con, $emailcheckquery) or die("4: Email check query failed"); // erorr code #3 - email check query failed

if(mysqli_num_rows($emailcheck) > 0)
{
    echo "5: Email already exists"; //erorr code #3 - email exists cannot register
    exit();
}

//add user to tabel
$salt = "\$5\$rounds=5000\$" . "steamedhams" . $username. "\$";
$hash = crypt($password, $salt);

$insertuserquery = "INSERT INTO player (username, email, hash, salt) VALUES ('".$username."','".$email."','".$hash."','".$salt."');";
mysqli_query($con, $insertuserquery) or die("6: Insert player query failed"); //erorr code #4 - insert query failed

echo("0");
?>