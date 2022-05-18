function checkForm(){
    var valorCotacao = document.getElementById("valor").value;
    if(valorCotacao > 1000 && valorCotacao < 100000){
        console.log('maior que 1000')
    }else{
        
        if(valorCotacao < 1000){
            alert('Valor menor que 1000');
        }

        if(valorCotacao > 100000){
            alert('Valor maior que 100000');
        }
        
        return false;
    };
    
}