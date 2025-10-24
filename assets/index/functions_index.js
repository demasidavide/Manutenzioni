// mostra pagina di registrazione
let register=document.getElementById("form");
register.addEventListener('click', ()=>{
  document.getElementById("form_register").style.display= 'block';
});
//nascondi pagina di registrazione
let closeRegister=document.getElementById("close");
closeRegister.addEventListener('click', ()=>{
document.getElementById("form_register").style.display='none'
})

// funzione per nascondere div risultato inserimento
function showresult(){
    document.getElementById("result").style.display="block";
    setTimeout(function() {
  document.getElementById('result').style.display = "none";
}, 5000);
}

// Invio dati con fetch
document.getElementById('register_form').onsubmit = function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  fetch('register.php', {
    method: 'POST',
    body: formData
  })
  .then(r => r.text())
  .then(data => {
    document.getElementById('result').innerText = data;
    showresult();
    document.getElementById("register_form").reset();
    closemodal();
  });
};
