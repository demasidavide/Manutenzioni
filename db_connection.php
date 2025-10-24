<?php
// variabili di accesso al db
$ip="127.0.0.1";
$user="root";
$psw="root";
$db_name="manutenzioni";

 try{
  $conn=new mysqli($ip,$user,$psw,$db_name);
  }catch(Exception $e){
    die("Connessione fallita". $e->getMessage());
  }
  ?>