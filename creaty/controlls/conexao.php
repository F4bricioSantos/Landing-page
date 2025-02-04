<?php
$server = "localhost";
$user = "root";
$pass = "";
$bd = "creaty";

if ($conn = mysqli_connect($server, $user, $pass, $bd)) {
    // echo"sucesso.";
 }else{
  echo "erro";
}