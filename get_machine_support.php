<?php
include 'db_connection.php';
$id_mac = intval($_GET['id_mac']);
$queryTitle= "SELECT nome FROM macchina WHERE id_mac=$id_mac;";
$resultTitle= mysqli_query($conn, $queryTitle);
$nome = '';
if ($resultTitle && $rowTitle = mysqli_fetch_assoc($resultTitle)) {
    $nome = $rowTitle['nome'];
}

$query = "SELECT * FROM intervento WHERE id_mac = $id_mac ORDER BY giorno DESC";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo '<table><thead><h1 style="color: black">' .$nome. '</h1></thead><tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr><td>ID intervento: ' . htmlspecialchars($row['id_int']) . '</td></tr>';
        echo '<tr><td>Data: ' . htmlspecialchars($row['giorno']) . '</td></tr>';
        echo '<tr><td>Ora: ' . htmlspecialchars($row['ora']) . '</td></tr>';
        echo '<tr><td>Tipo: ' . htmlspecialchars($row['tipo']) . '</td></tr>';
        echo '<tr><td>Descrizione: ' . htmlspecialchars($row['descrizione']) . '</td></tr>';
        echo '<tr><td style="border-top: 3px solid white;"></td></tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<div>Nessun intervento trovato per questa macchina.</div>';
}
?>