<?php
    $server_name = "localhost"; //SERVERNAME
    $user_name = "root";        //USERNAME
    $password = "";             //PASSWORD
    $db_name = "sports_db";        //DATABADSE NAME


    $conn = mysqli_connect($server_name, $user_name, $password, $db_name);
    if ($conn){
        // echo "Connects succesfully";
    }
    else{
        echo "Connection error".mysqli_connect_error();
    }


