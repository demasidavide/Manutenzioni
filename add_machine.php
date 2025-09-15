<?php
session_start();
require_once "db_connection.php";

$nome=$_POST["nome"];
$tipo=$_POST["tipo"];
$area=$_POST["area"];
$user=$_SESSION["username"];
$id_user="";

// preparo una query per trovare l'id in base allo user
$stmt=$conn->prepare("SELECT id FROM utente WHERE username=(?);");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->bind_result($id_user);
$stmt->fetch();
$stmt->close();
//echo"l utente ",$id_user,"vistooo";

 // preparo la query per inserimento dati con stmt
$stmt=$conn->prepare("INSERT INTO macchina (id,nome,tipo,area) VALUES (?, ?, ?, ?);");
$stmt->bind_param("ssss", $id_user, $nome,$tipo,$area);
$stmt->execute();
$result=$stmt->get_result();

 if ($stmt->affected_rows>0){
    echo"Elemento inserito con successo";
    
 }else{
    echo"Errore: Utente non inserito". $stmt->error;
 }
 $stmt->close();
?>
