<?php

$database = mysqli_connect("localhost","root","","library_system");

if(!$database ){
    die("Connection Failed". mysqli_connect_error());
}

?>