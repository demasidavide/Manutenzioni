<?php
session_start();
// includo db_connection per connessione al db
include "../../db_connection.php";
// acquisisco dati da index.html
$user=$_POST["username"];
$psw=$_POST["psw"];

// preparo la query per il controllo utente con stmt
$stmt=$conn->prepare("SELECT username,psw,id FROM utente WHERE username=(?) AND psw=(?);");
$stmt->bind_param("ss", $user,$psw);
$stmt->execute();
$result=$stmt->get_result();
$num_rows=$result->num_rows;

if($num_rows){
    $row=$result->fetch_assoc();
    $_SESSION["username"]=$row['username'];
    $_SESSION["id"]=$row['id'];
    header ("Location: /assets/main/main.php");
   exit;
}else{
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="style_check_user.css">
        </head>
    <body>
        
        <h1>Utente non trovato</h1>
        
        <br>
        <span>
            <a href="/index.html"><button>Indietro</button></a>
            </span>
    </body>
    <?php
}
?>
