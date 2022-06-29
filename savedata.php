<?php
    $con = mysqli_connect('localhost', 'root', '', 'unity_blokade');
    
    if (mysqli_connect_errno()) 
    {
        echo "1: Connection failed";
        exit();
        # code...
    }
    
    $username = $_POST['name'];
    $newscore = $_POST['score'];

    //check if username exists
    $usernamecheckquery = "SELECT username FROM player WHERE username='".$username."';";

    $usernamecheck = mysqli_query($con, $usernamecheckquery) or die("10: Username check query failed"); // erorr code #2 - name check query failed
    if(mysqli_num_rows($usernamecheck) != 1)
    {
        echo "11: Either no user with Username, or more than one"; //erorr code #5 - number of username matching !=1
        exit();
    }

    $updatequery = "UPDATE player SET score = ".$newscore." WHERE username = '".$username."';";
    mysqli_query($con, $updatequery) or die("12: Save query failed");

    echo "0";

?>