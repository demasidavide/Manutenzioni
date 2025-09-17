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
    closemodal_add_support();
  });
};

//---------------FUNZIONE PER FAR APPARIRE SERIE DI INTERVENTI PER OGNI MACCHINA SELEZIONATA------------------//

function openmodal_view_support(id_mac){
  const colonna3 = document.getElementsByClassName('colonna3')[0];
  colonna3.style.display = "block";
  fetch('get_machine_support.php?id_mac=' + id_mac)
    .then(response => response.text())
    .then(html => {
      // Mantieni il titolo-colonna e aggiungi gli interventi sotto
      colonna3.innerHTML = `
        <div class="titolo-colonna">
          <h3>INTERVENTI PER MACCHINA SELEZIONATA
            <svg onclick='closemodal_view_support()' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
              <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
          </h3>
        </div>
        ${html}
      `;
    });
}

function closemodal_view_support(){
  document.getElementsByClassName('colonna3')[0].style.display ="none";
}