// per mostratre la pagina di registrazione
function openmodal_add_machine(){
    document.getElementById("new_machine").style.display= 'block';
}
// per nascondere la pagina di registrazione
function closemodal_add_machine(){
    document.getElementById("new_machine").style.display="none";
}
// funzione per nascondere div risultato inserimento
function showresult(){
    document.getElementById("result").style.display="block";
    setTimeout(function() {
  document.getElementById('result').style.display = "none";
  window.location.href = window.location.href + '?ts=' + new Date().getTime();
     }, 3000);
}

// Invio dati con fetch
document.getElementById('new_mac').onsubmit = function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  fetch('add_machine.php', {
    method: 'POST',
    body: formData
  })
  .then(r => r.text())
  .then(data => {
    document.getElementById('result').innerText = data;
    showresult();
    document.getElementById("new_mac").reset();
    closemodal_add_machine();
  });
};

// ---------------PARTE PER DELETE MACCHINE----------------------
// per mostratre la pagina di cancellazione 

//USO QUESTA PER PASSARE ID PER CANCELLAZIONE E DATI PER VISUALIZZARE RIEPILOGO
function openmodal_delete_machine(id_mac,nome,tipo,area){

  document.getElementById("canc_macchina").style.display= 'block';

  document.getElementById("nomedm").textContent= "Nome Macchina:" + nome;
  document.getElementById("tipodm").textContent="Tipo:" + tipo;
  document.getElementById("areadm").textContent="Area:" + area;
  document.getElementById("iddm").textContent="ID Macchina:" + id_mac;

  document.getElementById("idinvio").value=id_mac;

}

// per nascondere la pagina di cancellazione
function closemodal_delete_machine(){
    document.getElementById("canc_macchina").style.display="none";
}

// INVIO DATI CON FETCH PER CANCELLAZIONE
//-----------NON VIENE USATA PER PASSARE I DATI MA GESTISCE LA PARTE PER IL DIV RISULTATO
document.getElementById('del_mac').onsubmit = function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  fetch('del_machine.php', {
    method: 'POST',
    body: formData
  })
  .then(r => r.text())
  .then(data => {
    document.getElementById('result').innerText = data;
    showresult();
    document.getElementById("del_mac").reset();
    closemodal_delete_machine();
  });
};

// -------FUNZIONE PER INSERIMENTO INTERVENTI------------
// NASCONDI APRI DIV INSERIMENTO INTERVENTO

function openmodal_add_support(){
  document.getElementById('add_intervento').style.display="block";
}
function closemodal_add_support(){
  document.getElementById('add_intervento').style.display="none";
}

//-----------FUNZIONE PER FAR APPARIRE IL DIV RISULTATO INSERIMENTO INTERVENTO--------------

document.getElementById('add_int').onsubmit = function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  fetch('add_support.php', {
    method: 'POST',
    body: formData
  })
  .then(r => r.text())
  .then(data => {
    document.getElementById('result').innerText = data;
    showresult();
    document.getElementById("add_int").reset();
    closemodal_closemodal_add_support();
  });
};

//---------------FUNZIONE PER FAR APPARIRE SERIE DI INTERVENTI PER OGNI MACCHINA SELEZIONATA------------------//


