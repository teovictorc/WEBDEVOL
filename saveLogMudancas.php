<?php
/**
*
* Arquivo de inserção do log de mudanças de Avaliação
*
**/
if(!empty($_POST['comentario']) || sizeof($_POST['comentario']) >= 0){
	include("pdo/Db.class.php");
	include("pdo/easyCRUD/LogAvaliacoes.class.php");
	session_start();
	$log = new LogAvaliacoes();
	//$log->_writeAccess($_SESSION['sId'], $_SESSION['NUM_RAR']);
	$log->created = date('Y-m-d H:i:s');
	$log->usuario_id = $_SESSION['sId'];
	$log->num_rar = $_POST['num_rar'];
	$log->token = session_id();
	$log->texto = (trim(strip_tags($_POST['comentario'])) !== '') ? $_POST['comentario'] : NULL;
	$log->type = 2;
	$log->Create();
	?>

	<script>document.location.href = 'pesq_avaliacao_pendente.php?Id=<?=$_POST['num_rar'];?>#formLogMudancas';</script>

	<?php

	/*=============================================
	=            		ATENÇÃO!!!	             =
	=============================================*/

	// Favor, não retirar essa linha
	// Necessária para que o código possa ser reutilizado posteriormente
	// unset($_SESSION['NUM_RAR']);

	/*-----  End of Section comment block  ------*/
}
?>