<? include("inc/headerI.inc.php"); 	

verifyAcess("DES_VERIFY_SINC","S");?>

<? 

	$Sql = "SELECT date_format(max(DT_EMIS_NF),'%d/%m/%Y') DATA_NF ".

	        " FROM NOTA_FISCAL ";

	$Stmt = mysql_query($Sql);

	if($Rs = mysql_fetch_assoc($Stmt)) { 

		$DataNF = $Rs["DATA_NF"];

	}else{

		$DataNF = "---";

	}

	

	$Sql = "SELECT date_format(max(DT_EMISSAO),'%d/%m/%Y') DATA_PEDIDO ".

	       " FROM PEDIDO_COMPRA ";

	$Stmt = mysql_query($Sql);

	if($Rs = mysql_fetch_assoc($Stmt)) { 

		$DataPedido = $Rs["DATA_PEDIDO"];

	}

	?>

<link href="wfa.css" rel="stylesheet" type="text/css">



<form name="form" method="post" action="util_deleta_rarok.php" enctype="multipart/form-data">

<table width="100%"  border="0" align="center">

     <tr>

       <td><span class="titulo">:: Status do sincronismo -  Sistema Gest&atilde;o ANDARELLA X WEBDEVOL :: </span>         <div align="right"></div></td>

     </tr>

  </table>

</td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9"><table width="100%"  border="0" >

     <tr>

       <td width="41%" height="10" class="style2"><strong>Data da &uacute;ltima nota fiscal exportada:</strong></td>

       <td width="59%" height="10" class="texto_obrigatorio"><strong><?=$DataNF?></strong></td>

       </tr>

     <tr>

       <td height="10" class="style2"><strong>Data do &uacute;ltimo pedido de compra exportado: </strong></td>

       <td height="10" class="texto_obrigatorio"><strong><?=$DataPedido?></strong></td>

     </tr>

     <tr>

       <td colspan="2">&nbsp;</td>

     </tr>

     <tr>

       <td colspan="2"> 

	   <div id="idButtons" style="display:" align="center">	   <a href="pesq_defeitos.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" name="Image361" width="68" height="20" border="0" id="Image361"></a></div></td>

       </tr>

   </table>

   <input type="hidden" name="TOTAL_ITENS" value="15">

</form>

<? include("inc/headerF.inc.php"); ?>

