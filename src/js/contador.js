(()=>{
    const contador = document.querySelector('.contador');
    const limiteCaracteres =  250;

    contarCaracteres(document.querySelector("#descripcion"));


    function contarCaracteres(referencia){

        referencia.addEventListener('input',sumarCaracteres);

    }

    function sumarCaracteres(e){
        const totalCaracteres = e.target.value.length;
        colorearCaracteres(totalCaracteres,contador);
        contador.textContent = `${totalCaracteres}/${limiteCaracteres}`;
        if (totalCaracteres > limiteCaracteres) {
            e.target.value = e.target.value.slice(0, limiteCaracteres);
            contador.textContent = `${limiteCaracteres} / ${limiteCaracteres}`;
        }
    }


    function colorearCaracteres(totalCaracteres,contador){
        contador.classList.remove('correcto', 'advertencia', 'limite');

        if(totalCaracteres>100 && totalCaracteres<220){
            contador.classList.add('advertencia');
        }else if(totalCaracteres>=220){
            contador.classList.add('limite');
        }else{ 
            contador.classList.add('correcto');
  
  

        }
    }


})()