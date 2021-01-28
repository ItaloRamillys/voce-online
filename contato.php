<link rel="stylesheet" type="text/css" href="<?=$configBase?>/css/contact-social.css">
<link rel="stylesheet" type="text/css" href="<?=$configBase?>/css/header-contato.css">
<link rel="stylesheet" type="text/css" href="<?=$configBase?>/css/contato.css">
<link href="<?=$configBase?>/css/como-funciona.css" rel="stylesheet" type="text/css"/>
<header id="box-header-main">
	<div id="black-layer-img-header-main">
		<p class="animate" data-animate="animate__slideInLeft" delay-animate="400">Entre em contato </p> 
		<p class="animate" data-animate="animate__slideInRight" delay-animate="1000">com nossos advogados</p>
		<button>Fale agora</button>
	</div>
</header>

<?php require('logo-contato.php'); ?>

<div id="contact">
	<h2>Contato</h2>
	<div id="contact-internal">
		<div id="box-form-contact">
			<form>
				<div class="row-field">
					<label>Nome completo </label> <input type="text" name="" id="name">
				</div>
				<div class="row-field">
					<label>Celular </label> <input type="text" name="" id="phone">
				</div>
				<div class="row-field">
					<label>E-mail </label> <input type="text" name="" id="email">
				</div>
				<div class="row-field">
					<label>Assunto </label> 
          <select id="subject">
            <option value="">Selecione um assunto</option>
            <option value="Autoral">Autoral</option>
            <option value="Cívil">Cívil</option>
            <option value="Criminal">Criminal</option>
            <option value="Familiar">Familiar</option>
            <option value="Previdenciário">Previdenciário</option>
            <option value="Trabalhista">Trabalhista</option>
            <option value="Outros">Outros</option>
          </select>
				</div>
				<div class="row-field">
					<label>Mensagem </label> <textarea id="body"></textarea>
				</div>
				<div class="row-field">
					<label>Enviar documento </label> <div class="div-70"><input type="file" id="document-file" value="" style="display: none"> <label for="document-file">Escolher arquivo</label> <label>Nenhum documento selecionado</label></div>
				</div>
				<div class="row-field">
					<input type="button" id="btn-send-email" name="" value="Enviar">
				</div>
				<div id="response-send-email" class="row-field all-center flex-column">
					
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    $("#btn-send-email").on('click', function(e){
    	e.preventDefault();
        var name = $("#name");
        var phone = $("#phone");
        var email = $("#email");
        var subject = $("#subject");
        var body = $("#body");

        if (isNotEmpty(name) && isNotEmpty(phone) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {

            $.ajax({
               url: 'sendEmail.php',
               method: 'POST',
               dataType: 'json',
               data: {
                   name: name.val(),
                   email: email.val(),
                   subject: subject.val(),
                   phone: phone.val(),
                   body: body.val()
               }, success: function (response) {
                    if (response.status == "success")
                        $("#response-send-email").append("<p class='msg msg-success'>Email enviado com sucesso<i class='fas fa-times-circle icon-close'></i></p>");
                    else {
                        $("#response-send-email").append("<p class='msg msg-error'>Falha ao enviar email<i class='fas fa-times-circle icon-close'></i></p> <p><a href='https://www.gmail.com' target='_blank'>Enviar email diretamente pelo Gmail</a></p>");
                    }
                    $(".icon-close").click(function(e) {
		        	$(e.target).parent("p").remove();
		      	});
               }
            });
        }
    });

    function isNotEmpty(caller) {
        if (caller.val() == "") {
            caller.css('border', '1px solid red');
            $('html, body').delay('500').animate({scrollTop : caller.offset().top - 100},800);
            return false;
        } else
            caller.css('border', '');

        return true;
    }
    </script>



