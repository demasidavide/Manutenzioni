<?php
session_start();
include 'db_connection.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Accesso effettuato</title>
    <link rel="stylesheet" href="style_main.css"/>
 </head>
  <body>


    <div class="container_header">
      <div id="hello">
    <?php
    echo"<span>Accesso effettuato:","&nbsp","&nbsp" . strtoupper($_SESSION["username"]) . "</span>";
    ?>
    </div>
    <div class="head">

      <!-- a fine pagina aggiungo div nascosti con i form inserimento -->
      <span class="riga_sopra" onclick="openmodal_add_machine()">Aggiungi macchina</span>
      <span class="riga_sopra" onclick="openmodal_add_support()">Aggiungi intervento</span>
      <span class="riga_sopra">Aggiungi programmata</span>
      <span class="riga_sopra">sono grasso</span>
      
      <!-- bottone per logout -->
      <span id="logout">Logout<a href="index.html"></a></span>
    </div>
    </div>

    <!-- container colonne centrali -->
    <div class="container">

      <!-- inizio COLONNA 1 -->
      <div class="colonna1">
        <div class="titolo-colonna">
          <h3>MACCHINE</h3>
        </div>

        <!-- inserisco query per generare tabella e tabella -->
         <?php
         $lettura=("SELECT * FROM macchina;");
         $result_tabella=mysqli_query($conn,$lettura);
         if($result_tabella){
         ?>
         <table>
          <tbody>    
            <?php $first = true;
              while($row = mysqli_fetch_assoc($result_tabella)) { 
        if (!$first) echo '<tr><td style="border-top: 3px solid white;"></td></tr>';
        $first = false;
    ?>
        <tr><td><?php echo htmlspecialchars($row['nome']); ?></td></tr>
        <td><?php echo htmlspecialchars($row['tipo']); ?>&nbsp&nbsp&nbsp&nbsp</td>
            <td><img id="bid" src="bid.jpg" title="Cancella macchina" onclick="openmodal_delete_machine('<?php echo $row['id_mac']; ?>','<?php echo htmlspecialchars($row['nome']); ?>','<?php echo htmlspecialchars($row['tipo']); ?>','<?php echo htmlspecialchars($row['area']); ?>')"></td>
            <td><img id="piu" src="+.jpg" title="Aggiungi un intervento" onclick="openmodal_add_support()"></td>
            <td><img id="fdx" src="frecciad.jpg" title="Visualizza interventi effettuati" onclick="openmodal_view_support(<?php echo $row['id_mac'];?>)" ></td></tr>
        <tr><td><?php echo htmlspecialchars($row['area']); ?></td></tr>
        <tr><td>ID:<?php echo htmlspecialchars($row['id_mac']); ?></td></tr>
    <?php } ?>
              </tbody>
    </table>
    <?php }?>
      </div>

      <!-- INIZIO COLONNA 2 -->
      <div class="colonna2">
        <div class="titolo-colonna">
          <h3>MANUTENZIONI INSERITE</h3>
        </div>
                <div id="interventi" style="display:show">
                  <?php
         $lettura_man=("SELECT * FROM intervento ORDER BY 'giorno' desc;");
         $result_tabella_man=mysqli_query($conn,$lettura_man);
         if($result_tabella_man){
         ?>
         <table>
          <tbody>    
            <?php $first_man = true;
              while($row_man = mysqli_fetch_assoc($result_tabella_man)) { 
                if (!$first_man) echo '<tr><td style="border-top: 3px solid white;"></td></tr>';
        $first_man = false;
    ?>
        <tr><td><?php echo htmlspecialchars($row_man['id_int']); ?></td></tr>
        <td><?php echo htmlspecialchars($row_man['id_mac']); ?>&nbsp&nbsp&nbsp&nbsp</td>
        <tr><td><?php echo htmlspecialchars($row_man['id']); ?></td></tr>
        <tr><td><?php echo htmlspecialchars($row_man['ora']); ?></td></tr>
        <tr><td><?php echo htmlspecialchars($row_man['giorno']); ?></td></tr>
        <tr><td><?php echo htmlspecialchars($row_man['descrizione']); ?></td></tr>
        <tr><td>ID:<?php echo htmlspecialchars($row_man['tipo']); ?></td></tr>
    <?php } ?>
              </tbody>
    </table>
    <?php }?>
                </div>
      </div>

      <!-- INIZIO COLONNA 3 -->
      <div class="colonna3" style="display:none">
        <div class="titolo-colonna">
          <h3>INTERVENTI PER MACCHINA SELEZIONATA<svg onclick='closemodal_view_support()' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
    </svg>
  </h3>
        </div>
              </div>

         <!-- INIZIO COLONNA 4 -->
     <div class="colonna4">
        <div class="titolo-colonna4">
          <h3>ASSISTENZE PROGRAMMATE</h3>
        </div>
        
      </div>
      <footer>
        <div>
          <span class="footer">contatti</span>
          <span class='footer'>Il mio curriculum</span>
          <span class="footer">Versioni</span>
        </div>
        
      </footer>
    </div>

   


<!-- -------------------DIV NASCOSTI------------------------ -->

    <!-- div nascosto per form inserimento nuova macchina -->
     <div id="new_machine" style="display: none">
        <form id="new_mac">
          <label for="title">Inserisci i dati della macchina</label><br />
          <label for="nome">Nome</label><br>
          <input type="text" name="nome" required maxlength="20" title="Max 20 caratteri" /><br />
          <label for="tipo">Tipo</label><br>
          <select name="tipo">
            <option value="macchinario">Macchinario</option>
            <option value="stabilimento">Stabilimento</option>
            <option value="impianti">Impianti</option>
          </select><br />
          <label for="area">Area di ubicazione</label><br>
          <select name="area">
            <option value="area1">Area 1</option>
            <option value="area2">Area 2</option>
            <option value="area3">Area 3</option>
          </select><br />
          <input type="submit" value="Aggiungi" /><br />
          <input type="button" value="Indietro" id="close" onclick="closemodal_add_machine()">
      </form>
     </div>

     <!-- DIV NASCOSTO PER CANCELLAZIONE MACCHINARIO -->
      <div id="canc_macchina" style="display:none;">
        <form id="del_mac" method="POST" action="del_machine.php">
          <label for="descrizione">Eliminare la macchina:<br></label>
          <span id="nomedm"></span><br>
          <span id="tipodm"></span><br>
          <span id="areadm"></span><br>
          <span id="iddm"></span><br>
          <input type="hidden" name="idmacch" id="idinvio">
          <input type="submit" value="Confermare?" id="invioid"><br>
          <button type="button" id="close_delete" onclick="closemodal_delete_machine()">Indietro</button>
        </form>
      </div>

      <!-- DIV NASCOSTO PER INSERIMENTO INTERVENTO DA RIGA HEADER  -->
       <div id="add_intervento" style="display:none">
        <form id="add_int" method="POST" action="">
          <label for="descrizione">Inserisci nuovo intervento</label><br><br>
          <span>Seleziona macchina
            
              <?php 
              $lettura2=("SELECT nome,id_mac FROM macchina;");
              $result_tabella2=mysqli_query($conn,$lettura2);
              if($result_tabella2){ ?>
              <select name="macchina">
                <option value=""></option>
                <?php              
              while($row2= mysqli_fetch_assoc($result_tabella2)) { 
              
                echo "<option value=" . $row2['id_mac'] . ">" . $row2['nome']. "ID:". $row2['id_mac'] . "</option>";
              }}?>

            </select>
          </span><br>
          <span>Motivo dell' intervento
             <select name="tipo">
              <option value=""></option>
              <option value="guasto">Guasto</option>
              <option value="preventivo">Intervento preventivo</option>
             </select><br>
             <span>Ora e Data di esecuzione:</span>
             <span><input type="date" name="data"></span>
             <span><input type="time" name="ora"></span><br>
             <span>Descrizione intervento</span><br>
             <span><textarea name="descrizione" rows="8" cols="70" placeholder="Descrivi l'intervento effettuato..." maxlength="500" required></textarea></span>
          </span><br>
          <input type="hidden" name="id"><?php $_SESSION["id"]; ?>
          <input type="hidden" name="id_macchina" value= "<?php echo $row2['id_mac']; ?>">
          <input type="submit" name="invio" value="Inserisci"> 
          <input type="button" value="Indietro" id="close_delete" onclick="closemodal_add_support()"></input>
        </form>
       </div>

     <!-- div per nascosto per visualizzare risultato -->
      <div id="result" style="display: none;"></div>
      <br /><br />
      <div>jgekbgndong</div>

      <!-- link al file .js -->
     <script src="functions_main.js"></script>
  </body>
</html>
