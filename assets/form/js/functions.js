function validaMensagem(mensagem) {
    var illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/;

    if (mensagem == '' || mensagem.match(illegalChars)) {
        return false;
    } else {
        return true;
    }
}

function validaNome(nome){
    var illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/;
    var auxiliar = nome.split(" ");

    if (nome == '' || nome.match(illegalChars) || auxiliar.length < 2) {
        return false;
    } else {
        return true;
    }
}

function validaEmail(email) {
    var emailFilter = /^.+@.+\..{2,}$/;
    var illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/;

    if (!emailFilter.test(email) || email.match(illegalChars)) {
        return false;
    } else {
        return true;
    }
}

function mostrarEsconderSpinner(prop){
    $('#spinner').attr('hidden', prop);
}

function aplicarOnSubmit(){
    $('#formEmail').submit(function(e){
        mostrarEsconderSpinner(false);

        e.preventDefault();
        
        var nome = $('#inputNome').val();
        var email = $('#inputEmail').val();
        var mensagem = $('#inputMensagem').val();
        var origem = window.location.href;
        
        if (validaNome(nome) && validaEmail(email) && validaMensagem(mensagem)){
            $.post('php/send-email.php', {
                data: [nome, email, mensagem, origem]
            }, function(retorno){
                switch(retorno){
                    case 'true':
                        alert('Eviado com sucesso!');
                        window.location.href = 'http://www.google.com';
                        break;
                    default:
                        mostrarEsconderSpinner(true);
                        alert('Ops, houve um erro!');
                        break;
                }
            })
        } else {
            mostrarEsconderSpinner(true);
            alert('Por favor, preencha corretamente o formulário.');
        }
    })
}

$(document).ready(function(){
    aplicarOnSubmit();
})