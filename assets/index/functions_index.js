// mostra pagina di registrazione
document.getElementById("form").addEventListener('click',()=>{
  document.getElementById("form_register").style.display= 'block';
});
//nascondi pagina di registrazione
document.getElementById("close").addEventListener('click', ()=>{
document.getElementById("form_register").style.display='none';
});

// funzione per nascondere div risultato inserimento
function showresult(){
    document.getElementById("result").style.display="block";
    setTimeout(()=> {
  document.getElementById('result').style.display = "none";
}, 5000);
}

// Invio dati con fetch
document.getElementById('register_form').onsubmit = function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  fetch('assets/index/register.php', {
    method: 'POST',
    body: formData
  })
  .then(r => r.text())
  .then(data => {
    document.getElementById('result').innerText = data;
    //controllo testo risposta per settare classi diverse
    if(data.includes("Registrazione effettuata")){
      document.getElementById('result').className= "result-ok";
    }else{
      document.getElementById('result').className="result-no";
    }
    showresult();
    setTimeout(()=>{
      document.getElementById("register_form").style.display='none';
    },5000);
    document.getElementById("register_form").reset();
  });
};
