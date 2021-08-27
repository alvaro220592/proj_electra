$(document).ready( function() {
    $('#enviar-faturas-container').hide();
    $('#btn-enviar-faturas').click(function() {
        $('#enviar-faturas-container').toggle(400);
    });
    $('#btn-nao').click(function() {
        $('#enviar-faturas-container').hide(400);
    });
});


// VIACEP
const cep = document.querySelector("#cep")

const showData = (result)=>{
    for(const campo in result){
        if(document.querySelector("#"+campo)){
            document.querySelector("#"+campo).value = result[campo]
        }
    }   
}

// Se houver o campo '#cep'
if(document.querySelector('#cep')){
    cep.addEventListener("blur",(e)=>{
        let search = cep.value.replace("-","")
        const options = { 
            method: 'GET',
            mode: 'cors',
            cache: 'default'
        }

        fetch(`https://viacep.com.br/ws/${search}/json/`, options)
        .then(response =>{ response.json()
            .then( data => showData(data))
            .then(function () {
                $("#address_num").focus();
            })
        })
        .catch(e => console.log('Deu Erro: '+ e,message))
    })  
}
