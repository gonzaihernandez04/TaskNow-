(() => {
  const inputPassword = document.querySelectorAll(".container-password input");
  const ojoPassword = document.querySelector(".eye");

  btnVerPassword();

  function btnVerPassword() {
    
    ojoPassword.onclick = verPassword;
  }

  function verPassword() {
   for(let i=0; i<inputPassword.length;i++){
    if (inputPassword[i].type == "text") {
      inputPassword[i].type = "password";
    } else {
      inputPassword[i].type = "text";
    }
   }
  }
})();
