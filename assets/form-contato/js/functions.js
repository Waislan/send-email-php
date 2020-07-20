function validaMensagem(mensagem) {
    var illegalChars = /[\(\)\<\>\\\/\"\[\]]/;

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

function validaTelefone(telefone){
    var numeroTelefone = telefone.replace(/[^0-9]/g, '');

    if ($('#inputTelefone').prop('required')){
        if (numeroTelefone.length < 10) {
            return false;
        }
        return true;
    } else {
        if (numeroTelefone.length < 10 && numeroTelefone != '') {
            return false;
        }
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

function aplicarFocusIn(){
    $('#inputTelefone').mask("(00) 00000-0000").focusin(function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        element = $(target);
        element.unmask();
        element.mask("(00) 00000-0000");
    })
}

function validaData(data){

    if (data != ''){
        data = data.split('-');
        var ano = data[0];

        if ((2020 - ano) >= 18 && (2020 - ano) <= 100){
            return true;
        }
        
    }
    return false;
}

function aplicarFocusOut(){

    if ($('#inputNome').length){
        $('#inputNome').focusout(function (e) {
            if (!validaNome($(e.target).val())) {
                $(e.target).addClass('form-invalido');
            } else {
                $(e.target).removeClass('form-invalido');
            }
        })
    }

    if ($('#inputTelefone').length){
        $('#inputTelefone').mask("(00) 00000-0000").focusout(function (event) {
            if (!validaTelefone($(event.target).val())){
                $(event.target).addClass('form-invalido');
            } else {
                $(event.target).removeClass('form-invalido');
            }
        })
    }

    if ($('#inputEmail').length){
        $('#inputEmail').focusout(function (e) {
            if (!validaEmail($(e.target).val())) {
                $(e.target).addClass('form-invalido');
            } else {
                $(e.target).removeClass('form-invalido');
            }
        })
    }

    if ($('#inputDataDeNascimento').length){
        $('#inputDataDeNascimento').focusout(function (e) {
            if (!validaData($(e.target).val())) {
                $(e.target).addClass('form-invalido');
            } else {
                $(e.target).removeClass('form-invalido');
            }
        })
    }

    if ($('#inputMensagem').length){
        $('#inputMensagem').focusout(function (e) {
            if (!validaMensagem($(e.target).val())) {
                $(e.target).addClass('form-invalido');
            } else {
                $(e.target).removeClass('form-invalido');
            }
        })
    }
}

function verificarRadioBox(){
    if($('#radioGoogle').is(':checked')){
        return 'Google';
    }
    else if($('#radioFacebook').is(':checked')){
        return 'Facebook';
    }
    else if($('#radioIndicacao').is(':checked')){
        return 'Indicação';
    }
    else {
        return 'erro';
    }
}

function camposValidos(campos){

    if (campos.length == 2){

        if (validaEmail(campos[0])){
            return true;
        } else {
            return false;
        }

    } else if (campos.length == 3){

        if (validaNome(campos[0]) && validaEmail(campos[1])){
            return true;
        } else {
            return false;
        }

    } else if (campos.length == 4){

        if (validaNome(campos[0]) && validaEmail(campos[1]) && validaTelefone(campos[2])){
            return true;
        } else {
            return false;
        }

    } else if (campos.length == 5 || campos.length == 6){

        if (validaNome(campos[0]) && validaEmail(campos[1]) && validaTelefone(campos[2]) && validaMensagem(campos[3])){
            return true;
        } else {
            return false;
        }

    } else {
        console.log(campos.length);
        return false;
    }
}

function backendFormulario(campos){

    $.post('assets/form-contato/php/send-email.php', {
        data: campos
    }, function(retorno){
        switch(retorno){
            case 'true':
                alert('Eviado com sucesso!');
                window.location.href = 'https://ofertadeveiculos.com.br';
                break;
            default:
                mostrarEsconderSpinner(true);
                alert('Ops, houve um erro!');
                console.log(retorno);
                break;
        }
    })
}

function trataData(data) {
    
    var auxiliar = data.replace('-', '/');

    console.log(auxiliar)
    return data;
}

function aplicarOnSubmit(){

    $('#form01').submit(function(e){
        mostrarEsconderSpinner(false);

        e.preventDefault();
        
        var email = $('#inputEmail').val();
        var origem = window.location.href;

        var campos = [email, origem];

        if(camposValidos(campos)){
            backendFormulario(campos);
        } else {
            mostrarEsconderSpinner(true);
            alert('Por favor, preencha corretamente o formulário.');
        }
    })

    $('#form02').submit(function(e){
        mostrarEsconderSpinner(false);

        e.preventDefault();
        
        var nome = $('#inputNome').val();
        var email = $('#inputEmail').val();
        var origem = window.location.href;

        var campos = [nome, email, origem];

        if(camposValidos(campos)){
            backendFormulario(campos);
        } else {
            mostrarEsconderSpinner(true);
            alert('Por favor, preencha corretamente o formulário.');
        }
    })

    $('#form03').submit(function(e){
        mostrarEsconderSpinner(false);

        e.preventDefault();
        
        var nome = $('#inputNome').val();
        var email = $('#inputEmail').val();
        var telefone = $('#inputTelefone').val();
        var origem = window.location.href;
        
        campos = [nome, email, telefone, origem];

        if(camposValidos(campos)){
            backendFormulario(campos);
        } else {
            mostrarEsconderSpinner(true);
            alert('Por favor, preencha corretamente o formulário.');
        }
    })

    $('#form04').submit(function(e){
        mostrarEsconderSpinner(false);

        e.preventDefault();
        
        var nome = $('#inputNome').val();
        var email = $('#inputEmail').val();
        var telefone = $('#inputTelefone').val();
        var mensagem = $('#inputMensagem').val();
        var origem = window.location.href;
        
        campos = [nome, email, telefone, mensagem, origem];

        if(camposValidos(campos)){
            backendFormulario(campos);
        } else {
            mostrarEsconderSpinner(true);
            alert('Por favor, preencha corretamente o formulário.');
        }
    })

    $('#form05').submit(function(e){
        mostrarEsconderSpinner(false);

        e.preventDefault();
        
        var nome = $('#inputNome').val();
        var email = $('#inputEmail').val();
        var telefone = $('#inputTelefone').val();
        var mensagem = $('#inputMensagem').val();
        var comoConheceu = verificarRadioBox();
        var origem = window.location.href;

        var campos = [nome, email, telefone, mensagem, comoConheceu, origem];

        if(camposValidos(campos)){
            backendFormulario(campos);
        } else {
            mostrarEsconderSpinner(true);
            alert('Por favor, preencha corretamente o formulário.');
        }
    })

    $('#form06').submit(function(e){
        mostrarEsconderSpinner(false);

        e.preventDefault();
        
        var nome = $('#inputNome').val();
        var email = $('#inputEmail').val();
        var telefone = $('#inputTelefone').val();
        var dataDeNascimento = trataData($('#inputDataDeNascimento').val());
        var mensagem = $('#inputMensagem').val();
        var comoConheceu = verificarRadioBox();
        var origem = window.location.href;

        var campos = [nome, email, telefone, dataDeNascimento, mensagem, comoConheceu, origem];

        if(camposValidos(campos)){
            backendFormulario(campos);
        } else {
            mostrarEsconderSpinner(true);
            alert('Por favor, preencha corretamente o formulário.');
        }
    })
    
}

$(document).ready(function(){
    $('#radioGoogle').click();

    if ($('#inputTelefone').length){
        aplicarFocusIn();
    }
    
    aplicarFocusOut();
    aplicarOnSubmit();
})