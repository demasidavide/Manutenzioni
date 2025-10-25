<?php
session_start();
require_once "db_connection.php";

$id=$_POST["idmacch"];

// preparo una query per trovare l'id in base allo user
$stmt=$conn->prepare("DELETE FROM macchina WHERE id_mac=(?);");
$stmt->bind_param("s", $id);
$stmt->execute();

 if ($stmt->execute()){
    echo"Macchina cancellata!";
    
 }else{
    echo"Errore: Cancellazione non riuscita!". $stmt->error;
 }
 $stmt->close();
?>