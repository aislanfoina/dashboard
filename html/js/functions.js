// JavaScript Document
$(window).load(function() {
//    	$('#telConc').mask("(99) 9999-99999");

		$('#insc-bt1').click(function(){
			//var mens = new Array();
			var email = $('#username').val();

			mens = "";
			
			if((email == '') ||  (email.indexOf("@")<2) || (email.indexOf(".")<1)){
				mens = "Favor, preencha um email valido";
			}
			else if($('#confere_email').text() == '1'){
				mens = "Ja possuimos este E-mail em nosso cadastro.";	
			}
			else if($('#nome').val()==''){
				mens = "Favor, escreva seu nome";
			}
			else if($('#dia').val()==''){
				mens = "Favor, preencha um dia";
			}
			else if($('#mes').val()==''){
				mens = "Favor, preencha um mes";
			}
			else if($('#ano').val()==''){
				mens = "Favor, preencha um ano";
			}
			else if($('#end').val()==''){
				mens = "Favor, preencha um endere&ccedil;o";
			}
			else if($('#num').val()==''){
				mens = "Favor, coloque um numero em seu endere&ccedil;o";
			}
			else if($('#cep').val()==''){
				mens = "Favor, preencha o CEP";
			}
			else if($('#bairro').val()==''){
				mens = "Favor, preencha o bairro";
			}
			else if($('#telConc').val()==''){
				mens = "Favor, preencha seu telefone de contato";
			}
			else if($('#cidade').val()==''){
				mens = "Favor, diga-nos sua cidade";
			}
			else if($('#cod_estados').val()==''){
			    mens = "Favor, diga-nos seu estado";
			}
			else if($('#senha1').val()==''){
				mens = "Favor, preencha uma senha";
			}
			else if($('#senha2').val()==''){
				mens = "Favor, preencha a confirma&ccedil;&atilde;o de sua senha";
			}
			else if($('#senha1').val()!= $('#senha2').val()){
				mens = "Sua confirma&ccedil;&atilde;o de senha n&atilde;o est&aacute; igual";
			}
			else{
				$('#users_address').val($('#end').val()+", "+$('#num').val()+", "+$('#comp').val()+", "+$('#bairro').val()+", "+$('#cep').val()+", "+$('#cidade').val()+", "+$('#cod_estados').val());
				$('#users_birthday').val($('#ano').val()+"-"+$('#mes').val()+"-"+$('#dia').val());
				$('#users_email').val($('#username').val());
				
				$('#insc-frm').fadeOut().submit();
				$('#sendingMsg').fadeIn();
				$('#error-msg').css({display:'none'});
			}
	
			$('#error-msg').css({display:'block'}).html(mens);
			if(mens!="") alert(mens);
	
		});
	
		$('#bt_frmUpload').click(function(){
			if($('#portfolio_filename').val()==''){
				mens = "Favor, selecione um arquivo v&aacute;lido";
				mens2 = "Favor, selecione um arquivo válido";
			}
			else if($('#portfolio_title').val()==''){
				mens = "Favor, preencha uma descri&ccedil;&atilde;o da imagem";
				mens2 = "Favor, preencha uma descrição da imagem";
			}
			else{
				$('#frm').fadeOut().submit();
				$('#sending-msg').fadeIn();
				$('#error-msg').css({display:'none'});
				mens = "Enviando imagem. Por favor aguarde!";
			}
			$('#error-msg').css({display:'block'}).html(mens);
			alert(mens2);
			return false;
		});

});