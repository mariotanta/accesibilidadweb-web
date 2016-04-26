<?
function check_email_address($email) {
	// Primero se comprueba que existe una @ y que las longitudes son correctas
	if (!ereg("[^@]{1,64}@[^@]{1,255}", $email)) {
		// Email inválido por un número incorrecto de carácteres o número incorrecto de @'s
		return false;
	}
	// Partimos el email en porciones, a partir de la @ y el .
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
			return false;
		}
	}
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
		// Comprobamos si el dominio es una IP
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false; // Dominio con partes insuficientes
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
				return false;
			}
		}
	}
return true;
}
 if ($_POST) {
		if(!($_POST["nombre"]) || !($_POST["mail"]) || (($_POST["mail"]) && !(check_email_address($_POST["mail"])))) {
			$error=true;
			if(!($_POST["nombre"])) $errorNombre = true;
			if(($_POST["mail"])) {
				  if (!(check_email_address($_POST["mail"]))) $mailIncorrecto=true;
			}else $mailVacio=true;

		}else{

			$destinatario = "tanta@tantacom.com";
			$subject = "Solicitud de contacto en www.accesibilidadweb.com";
			$nombre = HTMLEntities($_POST["nombre"], ENT_COMPAT, "UTF-8");
			$solucion = HTMLEntities($_POST["solucion"], ENT_COMPAT, "UTF-8");

			$cuerpo = "Nombre: " . $nombre . "\n";
			$cuerpo .= "Solución: " . $_POST["solucion"] . "\n";
			$cuerpo .= "Correo electrónico: " . $_POST["mail"] . "\n";
			$cuerpo .= "Empresa: " . $_POST["empresa"] . "\n";
			$cuerpo .= "Telefono: " . $_POST["telefono"] . "\n";
			$cuerpo .= "Sitio Web: " . $_POST["web"] . "\n";

			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=UTF-8\r\n";
			$headers .= "From: ".$nombre." <".$_POST['mail'].">\r\n";
			$result = mail($destinatario,$subject,$cuerpo,$headers);
			header("location: ./gracias.php?ok=true");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<title>Auditoría en accesibilidad web</title>
	<!-- Metadatos de contenidos de la web -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Metadatos para los buscadores -->
<meta name="description" content="Estudiamos el nivel de Accesibilidad Web en el que se encuentra un sitio, realizamos el informe de grado de accesibilidad y recomendaciones sobre alternativas de adecuación y de su futuro mantenimiento. Consúltanos" />
<meta name="keywords" content="auditoría accesibilidad, mantenimiento, accesibilidad web, directrices de accesibilidad, WAI, UNE 139803, Disposición Adicional 5º, LSSICE, eEurope 2002, AENOR, Ley de Impulso de la Sociedad de la Información, LISI" />
<meta name="title" content="Auditoría en accesibilidad Web. Accesibilidad web.com" />
<meta name="google-site-verification" content="CXFQiJ4JSVEaT_KYOvyN9b9PQ_KlMPeTblnRFodZuCg" />


	<!-- Metadatos de navegacion semantica -->
	<link rel="start" href="index.php" title="Página inicial" />
	<link rel="index" href="index.php" title="Página inicial" />
	<link rel="author" href="accesibilidad_web.php" title="La Accesibilidad" />
	<link rel="author" href="auditoria_accesibilidad_web.php" title="Auditoría" />
	<link rel="author" href="adecuacion_accesibilidad_web.php" title="Adecuación y desarrollo" />
	<link rel="section" href="formacion_accesibilidad_web.php" title="Formación" />
	<link rel="section" href="experiencia_accesibilidad_web.php" title="Experiencia" />
	<link rel="section" href="blog/index.php" title="Blog" />
	<link rel="section" href="tanta_comunicacion.php" title="Contacto" />

	<link rel="stylesheet" type="text/css" href="css/styles.css" />

	<!-- Icono en la barra de la URL -->
	 <link rel="shortcut icon" href="favicon.ico" />
	  <!--[if lte IE 6]>
		<link rel="stylesheet" type="text/css" href="css/fixIE6.css" />
	<![endif]-->
	<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" href="css/fixIE7.css" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="css/impresion.css" media="print" />

	<script type="text/javascript" src="js/funciones.js"></script>



</head>

<body id="home">

	<div id="wrapper">
		<div class="hide">
			<ul title="Enlaces de salto:">
				<li><a href="#navBar">Menú de navegación</a></li>
				<li><a href="#content">Contenido</a></li>
			</ul>
		</div>
		<div id="header">
			<div>
				<ul>
					<li><a href="index.php" accesskey="0">Inicio</a></li>
					<li><a href="blog/index.php" accesskey="6">Blog</a></li>
					<li class="reset"><a href="tanta_comunicacion.php" accesskey="7">Contacto</a></li>
				</ul>
			</div>
			<a href="index.php"><img src="img/accesibilidadweb.gif" width="243" height="18" alt="logotipo de accesibilidadweb.com" id="logo" /></a>
		</div>
		<div id="navBar">
			<ul>
				<li><a href="accesibilidad_web.php" accesskey="1">La Accesibilidad</a></li>
				<li class="sel"><a href="auditoria_accesibilidad_web.php" accesskey="2">Auditoría</a></li>
				<li><a href="adecuacion_accesibilidad_web.php" accesskey="3">Adecuación y desarrollo</a></li>
				<li><a href="formacion_accesibilidad_web.php" accesskey="4">Formación</a></li>
				<li class="reset"><a href="experiencia_accesibilidad_web.php" accesskey="5">Experiencia</a></li>
			</ul>
		</div>
		<div id="bodyContent">

			<div id="content">
				<h1>Auditoría en accesibilidad Web</h1>
				<div class="text">
			<p><strong>Auditor&iacute;a</strong> y estudio del nivel de <strong>Accesibilidad Web</strong> en el que se encuentra un sitio, realizaci&oacute;n de informe de grado de accesibilidad y recomendaci&oacute;n sobre alternativas de <strong>adecuaci&oacute;n</strong> y de su futuro mantenimiento, en funci&oacute;n del <strong>nivel de accesibilidad</strong> que se desee conseguir (<strong>A, AA, AAA</strong>).</p>
			<span id="linkContact"><a href="#formContact" title="formulario de contacto">¡Contacta ahora!</a></span>

			<p>Nos basamos en las <strong>directrices de Accesibilidad </strong> al contenido Web recomendadas por la <strong><acronym title="Web Accesibility Initiative" lang="en">WAI</acronym></strong> / <strong><acronym title="World Wide Web Consotium" lang="en">W3C</acronym></strong>, as&iacute; como en la norma espa&ntilde;ola <a href="http://www.inteco.es/frontinteco/files/frontIntecoAction.do;jsessionid=7ACA4271DEBACF2BF769CC6A2C3B1B2D?action=getFile&amp;fileID=50363" title="descargar UNE en formato PDF"><strong><acronym title="Una Norma Espa&ntilde;ola" lang="es">UNE</acronym> 139803:2004</strong></a>.</p>

			<h2>Presupuestos tipo para empresas</h2>
			<table cellspacing="0" summary="Tabla de presupuestos de diferentes auditorías">
				<thead>
					<tr>
						<th>Servicio</th>
						<th>Número de páginas</th>
						<th>Tiempo *</th>
						<th>Presupuesto *</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="4">(*) El Tiempo y Presupuesto hacen referencia exclusivamente a la Auditoria de Accesibilidad con el alcance de número de páginas indicadas, quedando excluida la adecuación.</td>
					</tr>
<?php /*					<tr>
						<td colspan="4">(**) Consistirá en un análisis de la página inicial del sitio Web indicando si cumple o no cumple el nivel de Accesibilidad sin indicar las soluciones o alternativas en caso de detección de errores.</td>
					</tr>*/ ?>
				</tfoot>
				<tbody>
<?php /*
					<tr>
						<td>Auditoría rápida (**)</td>
						<td>1 páginas</td>
						<td>1 día</td>
						<td>99 € + <acronym title="Impuesto Valor Añadido">IVA</acronym></td>
					</tr> */ ?>
					<tr>
						<td>Auditoría básica</td>
						<td>6 páginas</td>
						<td>2 días</td>
						<td>700 € + <acronym title="Impuesto Valor Añadido">IVA</acronym></td>
					</tr>
					<tr>
						<td>Auditoría estándar</td>
						<td>12 páginas</td>
						<td>3,5 días</td>
						<td>1.250 € + <acronym title="Impuesto Valor Añadido">IVA</acronym></td>
					</tr>
					<tr>
						<td>Auditoría a medida</td>
						<td>A definir</td>
						<td>A definir</td>
						<td>A definir</td>
					</tr>
				</tbody>
			</table>

			<p class="copy">Para un presupuesto a medida de nuestros servicios de <strong>auditoría en accesibilidad Web</strong> rellena el siguiente formulario.</p>
				</div>

<div id="contact">
					<h2 class="title">¡Contacta con nosotros ahora!</h2>
					<? if($error) { ?>
					<div class="msgError">
						<ul class="errores">
							<? if($errorNombre) { ?><li>(!) El campo 'Nombre' es obligatorio</li> <?php }?>
						  <? if($mailIncorrecto) {?><li> (!) El formato del campo 'Correo electr&oacute;nico' no es correcto</li><?php }
							 else
								if($mailVacio) {?><li>	(!) El campo 'Correo electr&oacute;nico' es obligatorio</li><?php }?>
						</ul>
					</div>

					<?php }?>
					<form action="" method="post" id="formContact" name="formContact">
						<p>Los campos marcados con asterisco (*) son obligatorios.</p>
						<ul class="clearFix">
							<li class="clr">
								<label for="solucion">Cuéntanos qué buscas para que podamos darte soluciones:</label>
								<select id="solucion" name="solucion" class="text"><option>Auditoría</option><option>Formación</option><option>Adecuación y desarrollo</option></select>
							</li>
							<li>
								<label for="nombre">Tu nombre (*):</label>
								<input type="text" id="nombre" name="nombre" class="text" />
							</li>
							<li>
								<label for="mail">Tu email (*): </label>
								<input type="text" id="mail" name="mail" value="micuenta@dominio.com" class="text" />
							</li>
							<li>
								<label for="telefono">Tu teléfono:</label>
								<input type="text" id="telefono" name="telefono" class="text" />
							</li>
							<li>
								<label for="empresa">Tu empresa:</label>
								 <input type="text" id="empresa" name="empresa" class="text" />
							</li>
							<li>
								<label for="empresa">Tu web:</label>
								<input type="text" id="web" name="web" class="text" />
							</li>														
							<li class="acepto">
								<label for="acepto"><input type="checkbox" id="acepto" name="acepto"> Acepto las <a href="aviso_legal.php" target="_blank">condiciones legales</a></label>
							</li>
						</ul>
						<span class="submit"><span><input type="submit" value="Solicitar información" /></span></span>
				</form>
			</div>
			</div>
		</div>
		<div id="footer">
			&copy; <span lang="en">Copyright</span> accesibilidadweb.com: Accesibilidad Web
			<ul>
				<li><a href="aviso_legal.php" accesskey="8">Aviso Legal</a></li>
				<li class="reset"><a href="accesibilidad.php" accesskey="s">Accesibilidad del sitio</a></li>
			</ul>
		</div>

	</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-203003-27']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>