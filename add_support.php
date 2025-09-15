<?php
session_start();
require_once "db_connection.php";

$id_mac=$_POST["macchina"];
$tipo=$_POST["tipo"];
$data=$_POST["data"];
$ora=$_POST["ora"];
$desc=$_POST["descrizione"];
$id=$_SESSION["id"];

 // preparo la query per inserimento dati con stmt
$stmt=$conn->prepare("INSERT INTO intervento(id_mac,id,ora,giorno,descrizione,tipo)VALUES (?,?,?,?,?,?);");
$stmt->bind_param("ssssss", $id_mac,$id,$ora,$data,$desc,$tipo);
$stmt->execute();
$result=$stmt->get_result();

 if ($stmt->affected_rows>0){
    echo"Intervento inserito con successo";
 }else{
    echo"Errore: Intervento non inserito". $stmt->error;
 }
 $stmt->close();
?>