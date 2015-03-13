<?	session;

	include_once("inc/conn_externa.inc.php"); ?>

<!-- DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd" -->

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?=$NomeSistema?></title>

<link href="css/global.css" rel="stylesheet" type="text/css" />

</head>



<body>

<form name="form" method="post" action="verifica_login.php">

<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="778" height="80" class="bg_topo"><h1><?=$NomeSistema?></h1></td>

    <td class="bg_topo">&nbsp;</td>

  </tr>

  <tr>

    <td height="60" class="bg_cinza">&nbsp;</td>

    <td class="bg_cinza">&nbsp;</td>

  </tr>

  <tr>

    <td height="100%" valign="top" align="center">

    <!-- tabela de login -->

    <table width="225" height="148" border="0" cellspacing="0" cellpadding="0" align="center" id="login" class="bg_login">

      <tr>

        <td height="74" align="center"><input name="LOGIN" type="text" onFocus="if (this.value=='login') this.value=''" onBlur="if (this.value=='') this.value='login'" value="login" class="restrito" /></br ><input name="SENHA" type="password" onFocus="if (this.value=='senha') this.value=''" onBlur="if (this.value=='') this.value='senha'" value="senha" class="restrito" /></td>

      </tr>

      <tr>

        <td height="42" class="btn_entrar" align="right"><input src="img/bts/entrar.jpg" type="image"></td>

      </tr>

      <tr>

        <td class="senha"><a href="#">&raquo; esqueci minha senha</a></td>

      </tr>

    </table>

    <!-- //tabela de login -->    </td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td height="100%" bgcolor="#333333" class="rodape">Todos os direitos reservados</td>

    <td bgcolor="#333333">&nbsp;</td>

  </tr>

</table>

</form>

<script language="javascript" type="text/javascript">

<!--

<?

	switch($_GET['Error']) {

		case "1":

			echo "alert('Usu�rio ou senha inv�lida');";

		  break;

		case "2":

			echo "alert('Login bloqueado no sistema. Favor entrar em contato com administrador do sistema!');";

		  break;

		case "3":

			echo "alert('Sua senha expirou ou voc� n�o possui permiss�o para acessar o sistema !');";

		  break;

		case "4":

			echo "alert('Sua chave de autentica��o expirou !');";

		case "5":

			echo "alert('Usu�rio n�o encontrado no banco de dados!');";

		  break;

	} 

?>

</script>

</body>

</html>