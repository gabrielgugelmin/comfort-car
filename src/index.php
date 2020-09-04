<?php

/**
 * COMFORTCAR
 *
 * @author Inffus
 * @version 1.0
 * @copyright COMFORTAR 2019
 * @link http://www.comfortcar.com.br
 */

ini_set('display_errors',-1);
//error_reporting(	E_ALL);
error_reporting(E_ERROR | E_PARSE );

//Verifica existencia de arquivo de conexao
if(!file_exists('templates/class/dao/sql/ConnectionProperty.class.php')){ header('Location: install.php'); }

//Inicia sessions
session_start();

require_once('application/include_dao.php');

/**
 * @var mixed $transaction Cria nova instância da classe
 */
$transaction = new Transaction();


/**
 * @var mixed $transaction Cria nova instância da classe
 */
include_once('core/core.php');


?>
    <!DOCTYPE html>
    <html lang="pr-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="google-site-verification" content="h7v_5X7g7NZNvcc7tdmwfx4b0bHfn64WvksPbA4tGLw" />

        <title><?=$siteTitle?></title>

        <!-- Og -->
        <meta property="og:title" content="<?=$siteTitle?>"/>
        <meta property="og:description" content="<?=$siteDescription?>"/>
        <?=$metaImages?>
        <meta property="og:url" content="<?=$siteUrl?>"/>
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="<?=$siteTitle?>"/>
        <meta name="google-site-verification" content="t1t6T5WchdoxS3_eYAaa_aMkpIW2e6oRf55aMDlDTpo" />

        <!-- Metas -->
        <meta name="description" content="<?=$siteDescription;?>">
        <meta name="keywords" content="<?=$siteKeywords;?>" />
        <meta name="author" content="Inffus WEB">


        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?=$URLSITE?>/page/assets/img/favicons/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$URLSITE?>/page/assets/img/favicons/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$URLSITE?>/page/assets/img/favicons/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$URLSITE?>/page/assets/img/favicons/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?=$URLSITE?>/page/assets/img/favicons/apple-touch-icon-60x60.png" />
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?=$URLSITE?>/page/assets/img/favicons/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?=$URLSITE?>/page/assets/img/favicons/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?=$URLSITE?>/page/assets/img/favicons/apple-touch-icon-152x152.png" />
        <meta name="application-name" content="&nbsp;"/>
        <meta name="msapplication-TileColor" content="#FFFFFF" />
        <meta name="msapplication-TileImage" content="<?=$URLSITE?>/page/assets/img/favicons/mstile-144x144.png" />
        <meta name="msapplication-square70x70logo" content="<?=$URLSITE?>/page/assets/img/favicons/mstile-70x70.png" />
        <meta name="msapplication-square150x150logo" content="<?=$URLSITE?>/page/assets/img/favicons/mstile-150x150.png" />
        <meta name="msapplication-wide310x150logo" content="<?=$URLSITE?>/page/assets/img/favicons/mstile-310x150.png" />
        <meta name="msapplication-square310x310logo" content="<?=$URLSITE?>/page/assets/img/favicons/mstile-310x310.png" />

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Ubuntu:400,700" rel="stylesheet">


        <!-- CSS -->
        <link rel="stylesheet" href="<?=$URLSITE?>/page/assets/css/main.min.css">



    </head>
    <body>

    <div class="overlay"></div>
		
		<div class="modal fade" id="modalSucesso" tabindex="-1" role="dialog" aria-labelledby="modalSucessoTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<div class="modal__title">Mensagem enviada com sucesso!</div>
						<p class="modal__text">Em breve entraremos em contato com você.</p>

						<button class="button button--orange" data-micromodal-close="sucesso">OK</button>
					</div>
				</div>
			</div>
  	</div>
		
		<div class="modal fade" id="modalContato" tabindex="-1" role="dialog" aria-labelledby="modalContatoTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="modal__title">Entrar em contato</div>
						<form class="form" id="formContato" method="post" action="">
							<div class="form__control">
									<input type="text" name="nome" class="form__input" placeholder="Nome">
							</div>
							<div class="form__control">
									<input type="email" name="email" class="form__input" placeholder="E-mail">
							</div>
							<div class="form__control">
									<input type="tel" name="telefone" class="form__input js-phone" placeholder="Telefone">
							</div>
							<div class="form__control">
									<textarea class="form__input" name="mensagem" placeholder="Mensagem"></textarea>
							</div>
							<div class="form__footer">
									<div class="checkbox">
											<input id="newsletter" name="newsletter" type="checkbox" class="form__checkbox"/>
											<label for="newsletter">Assine nossa newsletter</label>
									</div>
									<button class="button button--orange" type="submit" >Enviar</button>
							</div>
						</form>
						<br>
						<hr>
						<div class="col-lg-12 ">
							<div class="footer__columns">
								<div class="footer__info">
									
									<h6 class="form__title">Nossos contatos</h6>
									
										<p>Rua Emília Marengo, 377<br>Jardim Anália Franco - SP</p>
										<p>Telefone: <a href="tel:1120959595" target="_blank">11 2095-9595</a></p>
										<p>WhatsApp: <a href="https://api.whatsapp.com/send?phone=5511989402988" target="_blank" rel="noopener">11 98940-2988</a></p>
										<p>digital@comfortcar.com.br</p>
								</div>
								<div class="footer__info">
									
									<h6 class="form__title">Horários de atendimento</h6>
										<p>Segunda - sexta:<br>
												9:00 às 18:00</p>

										<p>Sábados:<br>
												9:00 às 14:00</p>

										<p>Domingos e Feriados:<br>
												FECHADO</p>
								</div>
								<div class="footer__info">
									<h6 class="form__title">Siga nossas redes sociais</h6>

									<ul class="social social--orange">
										<li class="social__item">
												<a href="https://www.facebook.com/comfortcarveiculos/" target="_blank">
														<svg viewBox="-110 1 511 511.99996" xmlns="http://www.w3.org/2000/svg"><path d="m180 512h-81.992188c-13.695312 0-24.835937-11.140625-24.835937-24.835938v-184.9375h-47.835937c-13.695313 0-24.835938-11.144531-24.835938-24.835937v-79.246094c0-13.695312 11.140625-24.835937 24.835938-24.835937h47.835937v-39.683594c0-39.347656 12.355469-72.824219 35.726563-96.804688 23.476562-24.089843 56.285156-36.820312 94.878906-36.820312l62.53125.101562c13.671875.023438 24.792968 11.164063 24.792968 24.835938v73.578125c0 13.695313-11.136718 24.835937-24.828124 24.835937l-42.101563.015626c-12.839844 0-16.109375 2.574218-16.808594 3.363281-1.152343 1.308593-2.523437 5.007812-2.523437 15.222656v31.351563h58.269531c4.386719 0 8.636719 1.082031 12.289063 3.121093 7.878906 4.402344 12.777343 12.726563 12.777343 21.722657l-.03125 79.246093c0 13.6875-11.140625 24.828125-24.835937 24.828125h-58.46875v184.941406c0 13.695313-11.144532 24.835938-24.839844 24.835938zm-76.8125-30.015625h71.632812v-193.195313c0-9.144531 7.441407-16.582031 16.582032-16.582031h66.726562l.027344-68.882812h-66.757812c-9.140626 0-16.578126-7.4375-16.578126-16.582031v-44.789063c0-11.726563 1.191407-25.0625 10.042969-35.085937 10.695313-12.117188 27.550781-13.515626 39.300781-13.515626l36.921876-.015624v-63.226563l-57.332032-.09375c-62.023437 0-100.566406 39.703125-100.566406 103.609375v53.117188c0 9.140624-7.4375 16.582031-16.578125 16.582031h-56.09375v68.882812h56.09375c9.140625 0 16.578125 7.4375 16.578125 16.582031zm163.0625-451.867187h.003906zm0 0"/></svg>
												</a>
										</li>
										<li class="social__item">
												<a href="https://www.instagram.com/comfortcar.br/" target="_blank">
														<svg viewBox="0 0 512.00096 512.00096" xmlns="http://www.w3.org/2000/svg"><path d="m373.40625 0h-234.8125c-76.421875 0-138.59375 62.171875-138.59375 138.59375v234.816406c0 76.417969 62.171875 138.589844 138.59375 138.589844h234.816406c76.417969 0 138.589844-62.171875 138.589844-138.589844v-234.816406c0-76.421875-62.171875-138.59375-138.59375-138.59375zm108.578125 373.410156c0 59.867188-48.707031 108.574219-108.578125 108.574219h-234.8125c-59.871094 0-108.578125-48.707031-108.578125-108.574219v-234.816406c0-59.871094 48.707031-108.578125 108.578125-108.578125h234.816406c59.867188 0 108.574219 48.707031 108.574219 108.578125zm0 0"/><path d="m256 116.003906c-77.195312 0-139.996094 62.800782-139.996094 139.996094s62.800782 139.996094 139.996094 139.996094 139.996094-62.800782 139.996094-139.996094-62.800782-139.996094-139.996094-139.996094zm0 249.976563c-60.640625 0-109.980469-49.335938-109.980469-109.980469 0-60.640625 49.339844-109.980469 109.980469-109.980469 60.644531 0 109.980469 49.339844 109.980469 109.980469 0 60.644531-49.335938 109.980469-109.980469 109.980469zm0 0"/><path d="m399.34375 66.285156c-22.8125 0-41.367188 18.558594-41.367188 41.367188 0 22.8125 18.554688 41.371094 41.367188 41.371094s41.371094-18.558594 41.371094-41.371094-18.558594-41.367188-41.371094-41.367188zm0 52.71875c-6.257812 0-11.351562-5.09375-11.351562-11.351562 0-6.261719 5.09375-11.351563 11.351562-11.351563 6.261719 0 11.355469 5.089844 11.355469 11.351563 0 6.257812-5.09375 11.351562-11.355469 11.351562zm0 0"/></svg>
												</a>
										</li>
										<li class="social__item">
											<a target="_blank" rel="noopener" href="https://api.whatsapp.com/send?phone=5511989402988" target="_blank">
												<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m439.277344 72.722656c-46.898438-46.898437-109.238282-72.722656-175.566406-72.722656-.003907 0-.019532 0-.023438 0-32.804688.00390625-64.773438 6.355469-95.011719 18.882812-30.242187 12.527344-57.335937 30.640626-80.535156 53.839844-46.894531 46.894532-72.71875 109.246094-72.71875 175.566406 0 39.550782 9.542969 78.855469 27.625 113.875l-41.734375 119.226563c-2.941406 8.410156-.859375 17.550781 5.445312 23.851563 4.410157 4.414062 10.214844 6.757812 16.183594 6.757812 2.558594 0 5.144532-.429688 7.667969-1.3125l119.226563-41.730469c35.019531 18.082031 74.324218 27.625 113.875 27.625 66.320312 0 128.667968-25.828125 175.566406-72.722656 46.894531-46.894531 72.722656-109.246094 72.722656-175.566406 0-66.324219-25.824219-128.675781-72.722656-175.570313zm-21.234375 329.902344c-41.222657 41.226562-96.035157 63.925781-154.332031 63.925781-35.664063 0-71.09375-8.820312-102.460938-25.515625-5.6875-3.023437-12.410156-3.542968-18.445312-1.429687l-108.320313 37.910156 37.914063-108.320313c2.113281-6.042968 1.589843-12.765624-1.433594-18.449218-16.691406-31.359375-25.515625-66.789063-25.515625-102.457032 0-58.296874 22.703125-113.109374 63.925781-154.332031 41.21875-41.21875 96.023438-63.921875 154.316406-63.929687h.019532c58.300781 0 113.109374 22.703125 154.332031 63.929687 41.226562 41.222657 63.929687 96.03125 63.929687 154.332031 0 58.300782-22.703125 113.113282-63.929687 154.335938zm0 0"/><path d="m355.984375 270.46875c-11.421875-11.421875-30.007813-11.421875-41.429687 0l-12.492188 12.492188c-31.019531-16.902344-56.121094-42.003907-73.027344-73.023438l12.492188-12.492188c11.425781-11.421874 11.425781-30.007812 0-41.429687l-33.664063-33.664063c-11.421875-11.421874-30.007812-11.421874-41.429687 0l-26.929688 26.929688c-15.425781 15.425781-16.195312 41.945312-2.167968 74.675781 12.179687 28.417969 34.46875 59.652344 62.761718 87.945313 28.292969 28.292968 59.527344 50.582031 87.945313 62.761718 15.550781 6.664063 29.695312 9.988282 41.917969 9.988282 13.503906 0 24.660156-4.058594 32.757812-12.15625l26.929688-26.933594v.003906c5.535156-5.535156 8.582031-12.890625 8.582031-20.714844 0-7.828124-3.046875-15.183593-8.582031-20.714843zm-14.5 80.792969c-4.402344 4.402343-17.941406 5.945312-41.609375-4.195313-24.992188-10.710937-52.886719-30.742187-78.542969-56.398437s-45.683593-53.546875-56.394531-78.539063c-10.144531-23.667968-8.601562-37.210937-4.199219-41.613281l26.414063-26.414063 32.625 32.628907-15.636719 15.640625c-7.070313 7.070312-8.777344 17.792968-4.242187 26.683594 20.558593 40.3125 52.734374 72.488281 93.046874 93.046874 8.894532 4.535157 19.617188 2.832032 26.6875-4.242187l15.636719-15.636719 32.628907 32.628906zm0 0"/></svg>
											</a>
										</li>
									</ul>
								</div>  
							</div>
						</div>    
					</div>
				</div>
			</div>
  	</div>

    <div class="modal fade" id="modalVender" tabindex="-1" role="dialog" aria-labelledby="modalVenderTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="modal__title">Avaliação Digital</div>
						<p>Preencha o formulário que faremos uma avaliação justa e rapidamente entraremos em contato.</p>
						<form class="form" method="post" id="formAvaliacao" action="">
							<br>
							<div class="form__control">
								<div class="checkbox">
									<input id="avaliacao-anos" type="checkbox" name="avaliacao_menor4anos" class="form__checkbox"/>
									<label for="avaliacao-anos">Meu carro possui até 4 anos da data de fabricação</label>
								</div>
							</div>
							<div class="form__control">
								<div class="checkbox">
									<input id="avaliacao-valor" type="checkbox" name="avaliacao_valemais50" class="form__checkbox"/>
									<label for="avaliacao-valor">Meu carro vale entre R$ 80.000,00 e R$ 200.000,00</label>
								</div>
							</div>
							<div class="form__control">
								<div class="checkbox">
									<input id="avaliacao-km" type="checkbox" name="avaliacao_menos50km" class="form__checkbox"/>
									<label for="avaliacao-km">Meu carro possui até 40 Mil km rodados</label>
								</div>
							</div>
									
							<br>
					
							<div class="form__control">
								<input type="text" name="avaliacao_nome" class="form__input" required="" placeholder="Nome">
							</div>
							<div class="form__control">
								<input type="email" name="avaliacao_email" class="form__input" required="" placeholder="E-mail">
							</div>
							<div class="form__control">
								<input type="tel" name="avaliacao_telefone" class="form__input js-phone" required="" placeholder="Telefone">
							</div>
							<div class="form__control">
							<select class="form__input" required="" name="avaliacao_marca">
								<option value="" selected disabled="" >Marca</option>
								<?php 
									$marcaAvaliacao = DAOFactory::getMarcaDAO()->relTable(' SELECT nome FROM Marca WHERE status=1 ');
									for($im=0;$im<count($marcaAvaliacao);$im++){
										echo  '<option value="'.$marcaAvaliacao[$im]->nome.'">'.$marcaAvaliacao[$im]->nome.'</option>';
									}    
								?>
							</select>
							</div>
							<div class="form__control">
								<input type="text" name="avaliacao_modelo" required="" class="form__input" placeholder="Modelo">
							</div>
							<div class="form__control">
								<input type="text" name="avaliacao_cor" required="" class="form__input" placeholder="Cor">
							</div>
							<div class="form__control">
								<input type="text" name="avaliacao_ano" class="form__input js-ano" placeholder="Ano/Modelo">
							</div>
							<div class="form__control">
								<input type="text" name="avaliacao_km" class="form__input" placeholder="KM">
							</div>
							<div class="form__control">
								<input type="text" name="avaliacao_motor" class="form__input" placeholder="Motor">
							</div>
							<div class="form__control">
								<input type="text" name="avaliacao_cambio" required="" class="form__input" placeholder="Câmbio">
							</div>
							
							<div class="form__control">
								<textarea class="form__input" name="avaliacao_obs" required="" placeholder="Observações, opcionais e detalhes importantes"></textarea>
							</div>
							<div class="form__control form__submit">
								<button type="submit" class="button button--orange">enviar</button>
							</div>
							</form>
					</div>
				</div>
			</div>
  	</div>

    <div class="page-wrapper">

        <?php

        include_once("page/include/nav.phtml");


        if($pagina!=""){


            //Se existir o arquivo correspondente ao texto recebido na variavel modulo inclui
            if(file_exists('page/'.$pagina.'.phtml')){

                //Verifica se o arquivo existe e um arquivo verdadeiro
                include_once((is_file('page/'.$pagina.'.phtml')) ? 'page/'.$pagina.'.phtml' : 'page/home.phtml');
                

            }else{

                //Do contrario mosta a pagina de erro
                include_once("page/404.phtml");

            }

        }else{

            //Do contrario mosta a pagina de erro
            include_once("page/home.phtml");

        }


        ?>






    </div><!-- Page Wrapper -->


<?php if (!$error){ ?>



    <section class="section instagram">
        <div class="container">
            <h4 class="section__title wow fadeInDown" data-wow-delay=".2s">SIGA NOSSO PERFIL NO INSTAGRAM</h4>
            <div id="instafeed" class="instafeed"></div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <img src="<?= $URLSITE?>/page/assets/img/logo-vertical.png" alt="Logo da Comfortcar" class="footer__img">

            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <ul class="footer__list">
                        <li class="footer__item"><a href="/estoque">estoque</a></li>
                        <!-- <li class="footer__item"><a onclick="return false;" data-micromodal-trigger="proposta" href="">comprar</a></li>-->
                        <li class="footer__item"><a href="" onclick="return false;" data-toggle="modal" data-target="#modalVender" >vender</a></li>
                        <!--li class="footer__item"><a href="#!">consignação</a></li-->
<!--                         <li class="footer__item"><a href="/blog">blog</a></li> -->
                        <li class="footer__item"><a href="" onclick="return false;" data-micromodal-trigger="contato">contato</a></li>
                        <li class="footer__item"><a href="/sobre">sobre</a></li>
                    </ul>
                </div>
            </div>




            <ul class="social social--orange">
                <li class="social__item">
                    <a href="https://www.facebook.com/comfortcarveiculos/" target="_blank">
                        <svg viewBox="-110 1 511 511.99996" xmlns="http://www.w3.org/2000/svg"><path d="m180 512h-81.992188c-13.695312 0-24.835937-11.140625-24.835937-24.835938v-184.9375h-47.835937c-13.695313 0-24.835938-11.144531-24.835938-24.835937v-79.246094c0-13.695312 11.140625-24.835937 24.835938-24.835937h47.835937v-39.683594c0-39.347656 12.355469-72.824219 35.726563-96.804688 23.476562-24.089843 56.285156-36.820312 94.878906-36.820312l62.53125.101562c13.671875.023438 24.792968 11.164063 24.792968 24.835938v73.578125c0 13.695313-11.136718 24.835937-24.828124 24.835937l-42.101563.015626c-12.839844 0-16.109375 2.574218-16.808594 3.363281-1.152343 1.308593-2.523437 5.007812-2.523437 15.222656v31.351563h58.269531c4.386719 0 8.636719 1.082031 12.289063 3.121093 7.878906 4.402344 12.777343 12.726563 12.777343 21.722657l-.03125 79.246093c0 13.6875-11.140625 24.828125-24.835937 24.828125h-58.46875v184.941406c0 13.695313-11.144532 24.835938-24.839844 24.835938zm-76.8125-30.015625h71.632812v-193.195313c0-9.144531 7.441407-16.582031 16.582032-16.582031h66.726562l.027344-68.882812h-66.757812c-9.140626 0-16.578126-7.4375-16.578126-16.582031v-44.789063c0-11.726563 1.191407-25.0625 10.042969-35.085937 10.695313-12.117188 27.550781-13.515626 39.300781-13.515626l36.921876-.015624v-63.226563l-57.332032-.09375c-62.023437 0-100.566406 39.703125-100.566406 103.609375v53.117188c0 9.140624-7.4375 16.582031-16.578125 16.582031h-56.09375v68.882812h56.09375c9.140625 0 16.578125 7.4375 16.578125 16.582031zm163.0625-451.867187h.003906zm0 0"/></svg>
                    </a>
                </li>
                <li class="social__item">
                    <a href="https://www.instagram.com/comfortcar.br/" target="_blank">
                        <svg viewBox="0 0 512.00096 512.00096" xmlns="http://www.w3.org/2000/svg"><path d="m373.40625 0h-234.8125c-76.421875 0-138.59375 62.171875-138.59375 138.59375v234.816406c0 76.417969 62.171875 138.589844 138.59375 138.589844h234.816406c76.417969 0 138.589844-62.171875 138.589844-138.589844v-234.816406c0-76.421875-62.171875-138.59375-138.59375-138.59375zm108.578125 373.410156c0 59.867188-48.707031 108.574219-108.578125 108.574219h-234.8125c-59.871094 0-108.578125-48.707031-108.578125-108.574219v-234.816406c0-59.871094 48.707031-108.578125 108.578125-108.578125h234.816406c59.867188 0 108.574219 48.707031 108.574219 108.578125zm0 0"/><path d="m256 116.003906c-77.195312 0-139.996094 62.800782-139.996094 139.996094s62.800782 139.996094 139.996094 139.996094 139.996094-62.800782 139.996094-139.996094-62.800782-139.996094-139.996094-139.996094zm0 249.976563c-60.640625 0-109.980469-49.335938-109.980469-109.980469 0-60.640625 49.339844-109.980469 109.980469-109.980469 60.644531 0 109.980469 49.339844 109.980469 109.980469 0 60.644531-49.335938 109.980469-109.980469 109.980469zm0 0"/><path d="m399.34375 66.285156c-22.8125 0-41.367188 18.558594-41.367188 41.367188 0 22.8125 18.554688 41.371094 41.367188 41.371094s41.371094-18.558594 41.371094-41.371094-18.558594-41.367188-41.371094-41.367188zm0 52.71875c-6.257812 0-11.351562-5.09375-11.351562-11.351562 0-6.261719 5.09375-11.351563 11.351562-11.351563 6.261719 0 11.355469 5.089844 11.355469 11.351563 0 6.257812-5.09375 11.351562-11.355469 11.351562zm0 0"/></svg>
                    </a>
                </li>
                <li class="social__item">
                    <a target="_blank" rel="noopener" href="https://api.whatsapp.com/send?phone=5511989402988" target="_blank">
                        <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m439.277344 72.722656c-46.898438-46.898437-109.238282-72.722656-175.566406-72.722656-.003907 0-.019532 0-.023438 0-32.804688.00390625-64.773438 6.355469-95.011719 18.882812-30.242187 12.527344-57.335937 30.640626-80.535156 53.839844-46.894531 46.894532-72.71875 109.246094-72.71875 175.566406 0 39.550782 9.542969 78.855469 27.625 113.875l-41.734375 119.226563c-2.941406 8.410156-.859375 17.550781 5.445312 23.851563 4.410157 4.414062 10.214844 6.757812 16.183594 6.757812 2.558594 0 5.144532-.429688 7.667969-1.3125l119.226563-41.730469c35.019531 18.082031 74.324218 27.625 113.875 27.625 66.320312 0 128.667968-25.828125 175.566406-72.722656 46.894531-46.894531 72.722656-109.246094 72.722656-175.566406 0-66.324219-25.824219-128.675781-72.722656-175.570313zm-21.234375 329.902344c-41.222657 41.226562-96.035157 63.925781-154.332031 63.925781-35.664063 0-71.09375-8.820312-102.460938-25.515625-5.6875-3.023437-12.410156-3.542968-18.445312-1.429687l-108.320313 37.910156 37.914063-108.320313c2.113281-6.042968 1.589843-12.765624-1.433594-18.449218-16.691406-31.359375-25.515625-66.789063-25.515625-102.457032 0-58.296874 22.703125-113.109374 63.925781-154.332031 41.21875-41.21875 96.023438-63.921875 154.316406-63.929687h.019532c58.300781 0 113.109374 22.703125 154.332031 63.929687 41.226562 41.222657 63.929687 96.03125 63.929687 154.332031 0 58.300782-22.703125 113.113282-63.929687 154.335938zm0 0"/><path d="m355.984375 270.46875c-11.421875-11.421875-30.007813-11.421875-41.429687 0l-12.492188 12.492188c-31.019531-16.902344-56.121094-42.003907-73.027344-73.023438l12.492188-12.492188c11.425781-11.421874 11.425781-30.007812 0-41.429687l-33.664063-33.664063c-11.421875-11.421874-30.007812-11.421874-41.429687 0l-26.929688 26.929688c-15.425781 15.425781-16.195312 41.945312-2.167968 74.675781 12.179687 28.417969 34.46875 59.652344 62.761718 87.945313 28.292969 28.292968 59.527344 50.582031 87.945313 62.761718 15.550781 6.664063 29.695312 9.988282 41.917969 9.988282 13.503906 0 24.660156-4.058594 32.757812-12.15625l26.929688-26.933594v.003906c5.535156-5.535156 8.582031-12.890625 8.582031-20.714844 0-7.828124-3.046875-15.183593-8.582031-20.714843zm-14.5 80.792969c-4.402344 4.402343-17.941406 5.945312-41.609375-4.195313-24.992188-10.710937-52.886719-30.742187-78.542969-56.398437s-45.683593-53.546875-56.394531-78.539063c-10.144531-23.667968-8.601562-37.210937-4.199219-41.613281l26.414063-26.414063 32.625 32.628907-15.636719 15.640625c-7.070313 7.070312-8.777344 17.792968-4.242187 26.683594 20.558593 40.3125 52.734374 72.488281 93.046874 93.046874 8.894532 4.535157 19.617188 2.832032 26.6875-4.242187l15.636719-15.636719 32.628907 32.628906zm0 0"/></svg>
                    </a>
                </li>
<!--
                <li class="social__item">
                    <a href="" onclick="return false;">
                        <svg viewBox="0 -62 512.00199 512" xmlns="http://www.w3.org/2000/svg"><path d="m334.808594 170.992188-113.113282-61.890626c-6.503906-3.558593-14.191406-3.425781-20.566406.351563-6.378906 3.78125-10.183594 10.460937-10.183594 17.875v122.71875c0 7.378906 3.78125 14.046875 10.117188 17.832031 3.308594 1.976563 6.976562 2.96875 10.652344 2.96875 3.367187 0 6.742187-.832031 9.847656-2.503906l113.117188-60.824219c6.714843-3.613281 10.90625-10.59375 10.9375-18.222656.027343-7.628906-4.113282-14.640625-10.808594-18.304687zm-113.859375 63.617187v-91.71875l84.539062 46.257813zm0 0"/><path d="m508.234375 91.527344-.023437-.234375c-.433594-4.121094-4.75-40.777344-22.570313-59.421875-20.597656-21.929688-43.949219-24.59375-55.179687-25.871094-.929688-.105469-1.78125-.203125-2.542969-.304688l-.894531-.09375c-67.6875-4.921874-169.910157-5.5937495-170.933594-5.59765575l-.089844-.00390625-.089844.00390625c-1.023437.00390625-103.246094.67578175-171.542968 5.59765575l-.902344.09375c-.726563.097657-1.527344.1875-2.398438.289063-11.101562 1.28125-34.203125 3.949219-54.859375 26.671875-16.972656 18.445312-21.878906 54.316406-22.382812 58.347656l-.058594.523438c-.152344 1.714844-3.765625 42.539062-3.765625 83.523437v38.3125c0 40.984375 3.613281 81.808594 3.765625 83.527344l.027344.257813c.433593 4.054687 4.746093 40.039062 22.484375 58.691406 19.367187 21.195312 43.855468 24 57.027344 25.507812 2.082031.238282 3.875.441406 5.097656.65625l1.183594.164063c39.082031 3.71875 161.617187 5.550781 166.8125 5.625l.15625.003906.15625-.003906c1.023437-.003907 103.242187-.675781 170.929687-5.597657l.894531-.09375c.855469-.113281 1.816406-.214843 2.871094-.324218 11.039062-1.171875 34.015625-3.605469 54.386719-26.019532 16.972656-18.449218 21.882812-54.320312 22.382812-58.347656l.058594-.523437c.152344-1.71875 3.769531-42.539063 3.769531-83.523438v-38.3125c-.003906-40.984375-3.617187-81.804687-3.769531-83.523437zm-26.238281 121.835937c0 37.933594-3.3125 77-3.625 80.585938-1.273438 9.878906-6.449219 32.574219-14.71875 41.5625-12.75 14.027343-25.847656 15.417969-35.410156 16.429687-1.15625.121094-2.226563.238282-3.195313.359375-65.46875 4.734375-163.832031 5.460938-168.363281 5.488281-5.082032-.074218-125.824219-1.921874-163.714844-5.441406-1.941406-.316406-4.039062-.558594-6.25-.808594-11.214844-1.285156-26.566406-3.042968-38.371094-16.027343l-.277344-.296875c-8.125-8.464844-13.152343-29.6875-14.429687-41.148438-.238281-2.710937-3.636719-42.238281-3.636719-80.703125v-38.3125c0-37.890625 3.304688-76.914062 3.625-80.574219 1.519532-11.636718 6.792969-32.957031 14.71875-41.574218 13.140625-14.453125 26.996094-16.054688 36.160156-17.113282.875-.101562 1.691407-.195312 2.445313-.292968 66.421875-4.757813 165.492187-5.464844 169.046875-5.492188 3.554688.023438 102.589844.734375 168.421875 5.492188.808594.101562 1.691406.203125 2.640625.3125 9.425781 1.074218 23.671875 2.699218 36.746094 16.644531l.121094.128906c8.125 8.464844 13.152343 30.058594 14.429687 41.75.226563 2.558594 3.636719 42.171875 3.636719 80.71875zm0 0"/></svg>
                    </a>
                </li>
-->
            </ul>

            <div class="col-lg-10 offset-lg-1">
                <div class="footer__columns">
                    <div class="footer__info">
                        <p><a href="https://goo.gl/maps/iPey1xPMd6dcpu1y9" target="_blank">Rua Emília Marengo, 377,<br>Tatuapé, São Paulo - SP,<br> CEP: 03336-000</a></p>
                        <p>Telefone: <a href="tel:1120959595" target="_blank">11 2095-9595</a></p>
                        <p>WhatsApp: <a href="https://api.whatsapp.com/send?phone=5511989402988" target="_blank" rel="noopener">11 98940-2988</a></p>
                        <p><a href="mailto:digital@comfortcar.com.br">digital@comfortcar.com.br</a></p>
                    </div>
                    <div class="footer__info">
                        <p>Segunda - sexta:<br>
                            9:00 às 18:00</p>

                        <p>Sábados:<br>
                            9:00 às 14:00</p>

                        <p>Domingos e Feriados:<br>
                            FECHADO</p>
                    </div>
                    <div class="footer__info">
                        <h6 class="form__title">Assine nossa newsletter</h6>

                        <form class="form" id="formNewsletter" method="post" action="">
                            <div class="form__control">
                                <input type="text" name="newsletter_nome" class="form__input" placeholder="Nome" required>
                            </div>
                            <div class="form__control">
                                <input type="email" name="newsletter_email" class="form__input" placeholder="E-mail" required>
                            </div>
                            <div class="form__control form__submit">
                                <button class="button button--orange">enviar</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>

            <small class="footer__legal">
                © 2019 - Comfortcar. Todos os direitos reservados
            </small>
        </div>
    </footer>

    <div class="contact">
        <div class="container">
            <div class="contact__list">
                <a class="contact__item" href="tel:1120959595">
                    <h6 class="contact__title">Ligue agora</h6>
                    <img class="contact__img" src="<?=$URLSITE?>/page/assets/img/tel.png">
                    <p class="contact__text">11 2095-9595</p>
                </a>
                <a class="contact__item" href="tel:11989402988" onclick="return false;">
                    <h6 class="contact__title">Ligue agora</h6>
                    <img class="contact__img" src="<?=$URLSITE?>/page/assets/img/whats.png">
                    <p class="contact__text">11 98940-2988</p>
                </a>
                <a class="contact__item" href="mailto:emaildacomfort@email.com">
                    <h6 class="contact__title">Atendimento</h6>
                    <img class="contact__img" src="<?=$URLSITE?>/page/assets/img/email.png">
                    <p class="contact__text">por e-mail</p>
                </a>
                <a class="contact__item" target="_blank" rel="noopener" href="https://api.whatsapp.com/send?phone=5511989402988">
                    <h6 class="contact__title">Atendimento</h6>
                    <img class="contact__img" src="<?=$URLSITE?>/page/assets/img/whats.png">
                    <p class="contact__text">WhatsApp</p>
                </a>
            </div>
        </div>
    </div>


    






<? } ?>






    <?php include_once("aviso.php"); ?>



    <?php if($siteAnalytics!=''){ ?>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', '<?php echo $siteAnalytics; ?>', 'auto');
            ga('send', 'pageview');

        </script>

    <?php } ?>

    <script src="<?=$URLSITE?>/page/assets/js/bundle.min.js"></script>
    <!--script src="<?=$URLSITE?>/page/assets/js/teste/bundle.min.js"></script>
    <script src="<?=$URLSITE?>/page/assets/js/teste/vendors/jquery.mask.min.js"></script>
    <script src="<?=$URLSITE?>/page/assets/js/teste/main.js"></script-->




    </body>
    </html>

<?php

//commit transaction
$transaction->commit();

?>