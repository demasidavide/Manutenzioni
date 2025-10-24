<?php
require_once "../../db_connection.php";

$nome=$_POST["nome"];
$cognome=$_POST["cognome"];
$user=$_POST["username"];
$psw=$_POST["psw"];

// preparo la query per inserimento dati con stmt

$stmt=$conn->prepare("INSERT INTO utente (nome,cognome,username,psw) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nome, $cognome,$user,$psw);
$stmt->execute();

 if ($stmt->affected_rows>0){
    echo"Registrazione effettuata";
 }else{
    echo"Errore: Utente non inserito";
 }