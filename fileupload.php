<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
</head>
<?php 
include("pdo/Db.class.php");
include("pdo/easyCRUD/LogAvaliacoes.class.php");
session_start();
if(isset($_FILES['file']) && isset($_POST['Id'])){
    $errors= array();
    $file_name = $_FILES['file']['name'];
    $file_size =$_FILES['file']['size'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $file_type=$_FILES['file']['type'];   
    $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
    $extensions = array("pdf"); 		
    if(in_array($file_ext,$extensions )=== false){
     $errors[]="Extensão não aceitável. Por favor, escolha um arquivo em PDF";
    }
    if($file_size > 2097152){
    $errors[]='O arquivo não deve exceder 2MB';
    }				
    if(empty($errors)==true){
    	$temp = explode(".",$file_name);
		$newfilename = sha1(time()) . '.' .end($temp);
        move_uploaded_file($file_tmp,"uploads/".$newfilename);
        $log = new LogAvaliacoes();

		$log->created = date('Y-m-d H:i:s');
		$log->usuario_id = $_SESSION['sId'];
		$log->num_rar = $_POST['Id'];
		$log->token = session_id();
		$log->texto = "Nova nota fiscal anexada";
		$log->filename = $newfilename;
		$log->type = 2;
		$saved = $log->Create();

        if($saved){
        	echo "Arquivo enviado com sucesso";
        }else{
			echo "Erro ao salvar o arquivo.";
        }
    }else{
        print_r($errors);
    }
}
?>
<body>
<link rel="stylesheet" href="css/bootstrap-theme.min.css" />
<form action="?Id=<?=$_GET['Id']?>" method="post" enctype="multipart/form-data" role="form">
	<fieldset>
		<legend>Notas Fiscais Eletr&ocirc;nicas</legend>
		<div class="form-group input-hidden hidden"><input type="hidden" name="Id" value="<?=$_GET['Id']?>" /></div>
		<div class="form-group input-file">
			<label for="file">Insira o Arquivo:</label>
			<input type="file" class="form-control" name="file" size="25" />
		</div>
		<div class="form-group input-buttons">
			<input type="submit" class="btn btn-default" name="submit" value="Submit" />
		</div>
	</fieldset>
</form>
<table class="table table-condensed">
	<thead>
		<tr>
			<th>Nome do Arquivo</th>
			<th>Data de Envio</th>
		</tr>
	</thead>
	<tbody>
	<?php $files = new LogAvaliacoes(); $files = $files->findByNumRarFiles($_GET['Id']);
	  foreach($files as $file):	?>
			<tr>
				<td width="30%" align="left">
					<a href="uploads/<?=$file['filename']?>" target="_blank"><?=$file['filename']?></a>
				</td>
				<td width="70%" align="center">
					<?=date('d/m/Y H:i:s', strtotime($file['updated']))?>
				</td>
			</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>