<?php
include("inc/conn.inc.php"); 
	verifyAcess("INCRECLAMACAO","S");
	if ($_SESSION["Menu"] == 3){
		$LANCA_TIPO = "M";
	}else{
		$LANCA_TIPO = "F";
	}
	
        $Sql = "SELECT * FROM rar_cliente_coleta WHERE CLIEN_COL_PESSOA = '" .$_POST['LANCA_PESSOA']. "'";
        $Stmt = mysql_query($Sql);
        $Rs = mysql_fetch_assoc($Stmt);

        $ID = intval($Rs["CLIEN_SEQ_RECLAMACAO"]) + 1;
        $Sql = "UPDATE rar_cliente_coleta SET CLIEN_SEQ_RECLAMACAO = CLIEN_SEQ_RECLAMACAO + 1 WHERE CLIEN_COL_PESSOA = '" .$_POST['LANCA_PESSOA']. "'";
        $Stmt = mysql_query($Sql);

        $ID = arrumaPessoa($_POST['LANCA_PESSOA']) ."-". arrumaPessoa($ID);
        if ($_SESSION['Menu'] == "3"){
                $ID = "M".$ID;
        }
        $Sql = "INSERT INTO rar_lancamento (
                   LANCA_NUMRAR,
                   LANCA_PESSOA,
                   LANCA_FABRI_IDO,
                   LANCA_STATUS,
                   LANCA_MOTIVO,
                   LANCA_SOLICITANTE,
                   LANCA_PESSOA_EMITENTE,
                   LANCA_DATAABERTURA,
                   LANCA_TIPORECLAMACAO,
                   LANCA_CLIENTE_NOME,
                   LANCA_CATEGORIA,
                   LANCA_NBLOCO_ANALISE,
                   LANCA_CLIENTE_FONE, LANCA_TIPO) VALUES ('".
                   $ID. "'," .
                   $_POST['LANCA_PESSOA']. ","  .
                   $_POST['LANCA_FABRI_IDO']. ",
                   '1','" .
                   $_POST['LANCA_MOVITO']. "',
                   '" .$_POST['LANCA_SOLICITANTE']. "',
                   " .$_POST['ITEM_PESSOA_EMITENTE']. ",
                   NOW(), '" .
                   $_POST['LANCA_TIPORECLAMACAO']."','".
                   $_POST['CLIENTE_NOME']."','".
                   $_POST['LANCA_CATEGORIA']."','".
                   $_POST['NUM_BLOCO_ANALISE']."','".
                   $_POST['CLIENTE_FONE']."','".$LANCA_TIPO."')" ;
        $Stmt = mysql_query($Sql);

        $uploaddir = $_SERVER["DOCUMENT_ROOT"] . '/webdevol/uploads/';

        $fileProdNome = str_replace("/webdevol/uploads/", "", $_POST['fileProdNome']);
        $fileSolaNome = str_replace("/webdevol/uploads/", "", $_POST['fileSolaNome']);
        $fileDefeNome = str_replace("/webdevol/uploads/", "", $_POST['fileDefeNome']);

        $FP = str_replace("-","_",$ID). "_" . $_POST['ITEM_REFERENCIA']. "_PROD." .substr($fileProdNome, strrpos($fileProdNome, ".") + 1);
        $FS = str_replace("-","_",$ID). "_" . $_POST['ITEM_REFERENCIA']. "_SOLA." .substr($fileSolaNome, strrpos($fileSolaNome, ".") + 1);
        $FD = str_replace("-","_",$ID). "_" . $_POST['ITEM_REFERENCIA']. "_DEFEITO." .substr($fileDefeNome, strrpos($fileDefeNome, ".") + 1);

		/*echo ("Origem: ".$uploaddir . $fileProdNome."<br>Destino: ".$PathImagens .$FP);
		die();*/


        copy($uploaddir . $fileProdNome, $PathImagens .$FP);
        copy($uploaddir . $fileSolaNome, $PathImagens .$FS);
        copy($uploaddir . $fileDefeNome, $PathImagens .$FD);

        unlink($uploaddir . $fileProdNome);
        unlink($uploaddir . $fileSolaNome);
        unlink($uploaddir . $fileDefeNome);

        $IDO = newIDO();

        $Sql = "INSERT INTO rar_item (ITEM_NUMRAR,
                        ITEM_NUMITEM,
                        ITEM_FOTOPROD,
                        ITEM_FOTOSOLA,
                        ITEM_FOTODEFEITO,
                        ITEM_PESSOA_EMITENTE,
                        ITEM_COLECAO,
                        ITEM_REFERENCIA,
                        ITEM_NF,
                        ITEM_DATA,
                        ITEM_VALOR,
                        ITEM_VALOR_ROYALTIE,
                        ITEM_QTDE,
                        ITEM_NUM33,
                        ITEM_NUM34,
                        ITEM_NUM35,
                        ITEM_NUM36,
                        ITEM_NUM37,
                        ITEM_NUM38,
                        ITEM_NUM39,
                        ITEM_NUM40,
                        ITEM_SERIE) VALUES ('".
                        $ID. "'," .
                        $IDO. ",'" .
                        $FP. "', '" .
                        $FS. "','" .
                        $FD. "','" .
                        //$_POST['ITEM_PAR']. "'," .
                        $_POST['ITEM_PESSOA_EMITENTE']. "','".
                        substr($_POST['ITEM_COLECAO'],0,7). "','" .
                        $_POST['ITEM_REFERENCIA']. "','" .
                        $_POST['ITEM_NF']. "','" .
                        formatadata($_POST['ITEM_DATA_EMISSAO']). "'," .
                        str_replace(",",".",substr($_POST['ITEM_VALOR_UNITARIO'],3)). "," .
                        str_replace(",",".",substr($_POST['ITEM_VALOR_ROYALTIE'],3)). ",'" .
                        $_POST['ITEM_QTDE']. "','" .
                        $_POST['ITEM_NUM33']. "','" .
                        $_POST['ITEM_NUM34']. "','" .
                        $_POST['ITEM_NUM35']. "','" .
                        $_POST['ITEM_NUM36']. "','" .
                        $_POST['ITEM_NUM37']. "','" .
                        $_POST['ITEM_NUM38']. "','" .
                        $_POST['ITEM_NUM39']. "','" .
                        $_POST['ITEM_NUM40']. "','" .
                        $_POST['ITEM_SERIE']. "')";
        $Stmt = mysql_query($Sql);

        $Sql = "INSERT INTO rar_avaliacao (AVALI_NUMRAR) VALUES ('" .$ID. "')";
        $Stmt = mysql_query($Sql);
		
?>
<script language="javascript" type="text/javascript">
	function abrir_janela_popup(theURL,winName,features) {
		window.open(theURL,winName,features);
	}
	abrir_janela_popup('imp_etiqueta.php?Valor=<?=$ID?>&Fabrica=<?=$_POST['LANCA_FABRI_IDO']?>&Referencia=<?=$_POST['ITEM_REFERENCIA']?>&Qtde=<?=$_POST['ITEM_QTDE']?>','popup_nf','width=500,height=280,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes');
	document.location.href = 'pesq_reclamacao.php';
</script>
