<?php
    $con = mysqli_connect('localhost', 'root', '', 'unity_blokade');
    
    if (mysqli_connect_errno()) 
    {
        echo "1: Connection failed";
        exit();
        # code...
    }
    
    $username = $_POST['name'];
    $password = $_POST['password'];
    
    
    
    //check if username exists
    $usernamecheckquery = "SELECT username, hash, salt, score, gambar FROM player WHERE username='".$username."';";
    
    $usernamecheck = mysqli_query($con, $usernamecheckquery) or die("7: Username check query failed"); // erorr code #2 - name check query failed
    
    if(mysqli_num_rows($usernamecheck) != 1)
    {
        echo "8: Either no user with username, or more than one"; //erorr code #5 - number of username matching !=1
        exit();
    }

    $existinginfo = mysqli_fetch_assoc($usernamecheck);
    $salt = $existinginfo["salt"];
    $hash = $existinginfo["hash"];

    $loginhash = crypt($password, $salt);
    if ($hash != $loginhash)
    {
        echo "9: Incoret Password"; //erorr code #6 - password does not hash to match table
        exit();
    }

    echo "0\t" . $existinginfo["score"];
?>