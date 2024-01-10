<?php
$servername="localhost";
$username= "mysql";
$password= "mysql";
$dbname= "register";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn) {
    die("connection Fialed". mysqli_connect_error());
}else{
    
}    ?>