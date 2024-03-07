<?php
function connect(){
    $servername ="localhost";
    $username = "admin";
    $password = "123";

    $conn = new mysqli($servername,$username,$password,"assignment");
    if ($conn->connect_error){
        die("Connection Failed ".$conn->connect_error);
    }
    return $conn;

}

?>