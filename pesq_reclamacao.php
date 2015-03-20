<?php
include("inc/headerI.inc.php");

verifyAcess("INCRECLAMACAO","S");

if ($_GET["LANCA_CATEGORIA"] == ""){

	$Categoria = "1";

}else{

	$Categoria = $_GET["LANCA_CATEGORIA"];

}



function validazero($campo){

	if ($campo = "" || $campo = " "){

		return 0;

	}else{

		return $campo;

	}

}



$Num33 = validazero($_GET['ITEM_NUM33']);

$Num34 = validazero($_GET['ITEM_NUM34']);

$Num35 = validazero($_GET['ITEM_NUM35']);

$Num36 = validazero($_GET['ITEM_NUM36']);

$Num37 = validazero($_GET['ITEM_NUM37']);

$Num38 = validazero($_GET['ITEM_NUM38']);

$Num39 = validazero($_GET['ITEM_NUM39']);

$Num40 = validazero($_GET['ITEM_NUM40']);



?>

<!--<script src="js/jquery.min.js" type="text/javascript"></script> -->
<script src="js/ajaxupload.3.6.js" type="text/javascript"></script>


<link href="wfa.css" rel="stylesheet" type="text/css">

<form name="form" method="post" action="pesq_reclamacaook.php" enctype="multipart/form-data">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="100%" class="tab_titulo"><h4>Inclus&atilde;o de reclama&ccedil;&atilde;o</h4></td>

      </tr>

    </table>

   <table width="100%"  border="0" class="tab_inclusao">

     <tr>
       <td height="10" class=""><strong>Categoria</strong></td>
       <td height="10" colspan="3" bgcolor="#FFFFFF"><table id='tbCategoria' width="100%"  border="0">
         <tr valign="middle" bgcolor="#FFFFFF" class="">
           <td><input name="LANCA_CATEGORIA" type="radio" class="" value="1" <?php if ($Categoria == "1"){?> checked <?php }?> onClick="MostraDados(1);clearNF();">
             Cal&ccedil;ado</td>
           <td class=""><input name="LANCA_CATEGORIA" type="radio" class="" value="5" <?php if ($Categoria == "5"){?> checked="checked" <?php }?> onclick="MostraDados(2);clearNF();" />
Bolsa</td>
           <td class=""><input name="LANCA_CATEGORIA" type="radio" class="" value="6" <?php if ($Categoria == "6"){?> checked="checked" <?php }?> onclick="MostraDados(3);clearNF();" />
             Cinto</td>
           <td><input name="LANCA_CATEGORIA" type="radio" class="" value="7" <?php if ($Categoria == "7"){?> checked="checked" <?php }?> onclick="MostraDados(4);clearNF();" />
             Carteira</td>
           </tr>
         <tr valign="middle" bgcolor="#FFFFFF" class="">
           <td><input name="LANCA_CATEGORIA" type="radio" class="" value="2" <?php if ($Categoria == "2"){?> checked="checked" <?php }?> onclick="MostraDados(1);clearNF();" />
             Sand&aacute;lia
</td>
           <td class=""><input name="LANCA_CATEGORIA" type="radio" class="" value="3" <?php if ($Categoria == "3"){?> checked="checked" <?php }?> onclick="MostraDados(1);clearNF();" />
             Botas
</td>
           <td class=""><input name="LANCA_CATEGORIA" type="radio" class="" value="4" <?php if ($Categoria == "4"){?> checked="checked" <?php }?> onclick="MostraDados(1);clearNF();" />
             Tamanco
</td>
           <td><input name="LANCA_CATEGORIA" type="radio" class="" value="8" <?php if ($Categoria == "8"){?> checked="checked" <?php }?> onclick="MostraDados(4);clearNF();" />
             Acess&oacute;rios
</td>
         </tr>

       </table></td>

       </tr>

     <tr>

       <td width="15%" height="10" class=""><strong>C&oacute;digo</strong></td>

       <td width="38%" height="10"><select name="LANCA_PESSOA" class="form" id="LANCA_PESSOA" onChange="CompleteData(this);clearNF();" style="width: 225px;">

	   				<option value="">..Selecione</option>

					<?php

					$Sql = " SELECT DISTINCT USUCLI_PESSOA, FANTASIA ";

					$Sql.= " FROM rar_usuarioxcliente, pessoa ";

					$Sql.= " WHERE USUCLI_USUAR_IDO = " .$_SESSION['sId'];

					$Sql.= "       AND USUCLI_PESSOA = PESSOA ";

					if ($_SESSION['Menu'] == "1"){

						$Sql.= "   AND CATEGORIA_CLIENTE IN (6,8,9) ";

					}

					if ($_SESSION['Menu'] == "3"){

						$Sql.= "   AND CATEGORIA_CLIENTE IN (10) ";

					}

					$Sql.= " ORDER BY FANTASIA, USUCLI_PESSOA";

					$Stmt = mysql_query($Sql);

				   while($Rs = mysql_fetch_assoc($Stmt)) {  ?>

				   <option value="<?=$Rs["USUCLI_PESSOA"]?>" <?=(($_GET['LANCA_PESSOA'] == $Rs["USUCLI_PESSOA"]) ? "selected" : "")?>><?=arrumaPessoa($Rs["FANTASIA"])?></option>

				<?php } ?>

			</select></td>

       <td width="14%" height="10">&nbsp;</td>

       <td width="33%" height="10"><input name="DIAS" type="hidden" class="campo_amarelo" id="DIAS" value="<?=$_GET['DIAS']?>" size="5" maxlength="5" readOnly>

         <input name="MENU" type="hidden" class="campo_amarelo" id="MENU" value="<?=$_SESSION['Menu']?>" size="5" maxlength="5" readOnly>
          <?php if(!empty($_GET['DIAS'])){?>
            <span class="campo_amarelo">
          <?php } ?>
         <?=$Rs["SERVI_PESSO_IDO"]?>

         </span></td>

     </tr>

     <tr>

       <td height="10" class=""><strong>Nome do cliente </strong></td>

       <td height="10" colspan="3"><input name="NOME" type="text" class="form" id="NOME" value="<?=$_GET['NOME']?>" size="50" maxlength="50" readOnly></td>

       </tr>

     <tr>

       <td height="10" class=""><strong>Endere&ccedil;o</strong></td>

       <td height="10" class="" ><input name="ENDERECO" type="text" class="form" id="form" value="<?=$_GET['ENDERECO']?>" size="50" maxlength="50" readOnly></td>

       <td height="10" class=""><strong>Bairro</strong></td>

       <td height="10" ><input name="BAIRRO" type="text" class="form" id="BAIRRO" value="<?=$_GET['BAIRRO']?>" size="20" maxlength="50" readOnly></td>

     </tr>

     <tr>

       <td height="10" class=""><strong>Cidade</strong></td>

       <td height="10" class=""><input name="CIDADE" type="text" class="form" id="CIDADE" value="<?=$_GET['CIDADE']?>" size="50" maxlength="50" readOnly></td>

       <td height="10"><strong class="">UF</strong></td>

       <td height="10" ><input name="UF" type="text" class="form" id="UF" value="<?=$_GET['UF']?>" size="5" maxlength="5" readOnly></td>

     </tr>

     <tr>

       <td height="10" class=""><strong>Solicitante</strong></td>

       <td height="10" colspan="3"><input name="LANCA_SOLICITANTE" type="text" class="form" id="LANCA_SOLICITANTE" value="<?=$_GET['LANCA_SOLICITANTE']?>" size="50" maxlength="50" readOnly></td>

       </tr>

     <tr>

       <td height="10" class=""><strong>Motivo da solicita&ccedil;&atilde;o </strong></td>

       <td height="10" colspan="3"><textarea name="LANCA_MOVITO" cols="100%" rows="5" class="txt" id="LANCA_MOVITO"><?=$_GET['LANCA_MOVITO']?></textarea></td>

     </tr>

     <tr bgcolor = "#FFFFFF" class="">

        <td colspan="4" class="tit_form"><strong>Dados do consumidor </strong></td>

        </tr>

	   <tr>

	   <td height="10" class=""><strong>Tipo reclama&ccedil;&atilde;o: </strong></td>

	   <td height="10" class="">

	   <input name="LANCA_TIPORECLAMACAO" type="radio" value="C" <?php if ($_GET['LANCA_TIPORECLAMACAO'] == "C") {?> checked <?php } ?> > Defeito consumidor

	   <input name="LANCA_TIPORECLAMACAO" type="radio" value="L" <?php if ($_GET['LANCA_TIPORECLAMACAO'] == "L") {?> checked <?php } ?> > Defeito loja </td>

	   <td height="10" class="">&nbsp;</td>

	   <td height="10">&nbsp;</td>

	   </tr>

	 <tr>

       <td height="10" class=""><strong>Nome: </strong></td>

       <td height="10"><input name="CLIENTE_NOME" type="text" class="form" id="CLIENTE_NOME" value="<?=$_GET['CLIENTE_NOME']?>" size="50" maxlength="50"></td>

       <td height="10" class=""><strong>Fone: </strong></td>

       <td height="10"><input name="CLIENTE_FONE" type="text" class="form" id="CLIENTE_FONE" value="<?=$_GET['CLIENTE_FONE']?>" size="30" maxlength="30"></td>

	 </tr>



     <tr bgcolor="#FFFFFF" class="">

       <td colspan="4" class="tit_form"><strong>Descri&ccedil;&atilde;o do &iacute;tem com problema </strong></td>

       </tr>

     <tr>

       <td height="15" class=""><strong>Emitente</strong></td>

       <td height="15" class=""><input name="ITEM_PESSOA_EMITENTE" type="text" readonly class="form" id="ITEM_PESSOA_EMITENTE" size="5" maxlength="5" onKeyDown="clearNF()"></td>

       <td height="15" class=""><strong>N<sup>o</sup> do Bloco de An&aacute;lise</strong></td>

       <td height="15" class=""><input name="NUM_BLOCO_ANALISE" type="text" required class="form" id="NUM_BLOCO_ANALISE" size="30" maxlength="15"></td>

     </tr>

     <tr>

       <td height="15" class=""><strong>Refer&ecirc;ncia</strong></td>

       <td height="15" class=""><input name="ITEM_REFERENCIA" type="text" class="form" id="ITEM_REFERENCIA" size="19" maxlength="11" onKeyDown="clearNF()" value="<?=$_GET['ITEM_REFERENCIA']?>"></td>

       <td height="15" colspan="2" class="">

	   <div id="numeropar" style="display:">

		   <table width="100%"  border="0">

			 <tr class="">

			   <td width="4%">&nbsp;</td>

			   <td width="12%"><div align="center">33</div></td>

			   <td width="12%"><div align="center">34</div></td>

			   <td width="12%"><div align="center">35</div></td>

			   <td width="12%"><div align="center">36</div></td>

			   <td width="12%"><div align="center">37</div></td>

			   <td width="12%"><div align="center">38</div></td>

			   <td width="12%"><div align="center">39</div></td>

			   <td width="12%"><div align="center">40</div></td>

			 </tr>

			 <tr class="">

			   <td>Qtde</td>

			   <td align="center"><input name="ITEM_NUM33" type="text" align="center" class="form txt_numero" id="ITEM_NUM33" value="<?=$Num33?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

			   <td align="center"><input name="ITEM_NUM34" type="text" align="center" class="form txt_numero" id="ITEM_NUM34" value="<?=$Num34?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

			   <td align="center"><input name="ITEM_NUM35" type="text" align="center" class="form txt_numero" id="ITEM_NUM35" value="<?=$Num35?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

			   <td align="center"><input name="ITEM_NUM36" type="text" align="center" class="form txt_numero" id="ITEM_NUM36" value="<?=$Num36?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

			   <td align="center"><input name="ITEM_NUM37" type="text" align="center" class="form txt_numero" id="ITEM_NUM37" value="<?=$Num37?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

			   <td align="center"><input name="ITEM_NUM38" type="text" align="center" class="form txt_numero" id="ITEM_NUM38" value="<?=$Num38?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

			   <td align="center"><input name="ITEM_NUM39" type="text" align="center" class="form txt_numero" id="ITEM_NUM39" value="<?=$Num39?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

			   <td align="center"><input name="ITEM_NUM40" type="text" align="center" class="form txt_numero" id="ITEM_NUM40" value="<?=$Num40?>" size="3" maxlength="3" onChange="SomaQtde();"></td>

			   </tr>

		   </table>

		 </div>	   </td>

       </tr>

     <tr>

       <td height="15" class=""><strong>Fabricante&nbsp;<a href="Javascript:abre_listagem();"><img src="imagens/icn_help.gif" alt="Exibir listagem de fabricantes" width="16" height="16" border="0"></a></strong></td>

       <td height="15" colspan="3"><select name="LANCA_FABRI_IDO" class="form" id="select2">

       </select></td>

       </tr>

     <tr>

       <td height="15" class=""><strong>Cole&ccedil;&atilde;o</strong></td>

       <td height="15"><span class=""><span class="">

         <input name="ITEM_COLECAO" type="text" readonly class="form" id="ITEM_COLECAO" size="30" maxlength="50">

       </span></span></td>

       <td height="15" colspan="2" class="">

	   <div id="qtdepar" style="display:none">

		   <table width="100%"  border="0" cellpadding="0" cellspacing="0">

			 <tr>

			   <td width="30%" class=""><strong>Qtde reclamada</strong></td>

			   <td width="70%"><span class="">

				 <input name="ITEM_QTDE" type="text" class="campo_texto" id="ITEM_QTDE2" size="5" maxlength="50" onKeyUp="calcAll()" value="<?=$_GET['ITEM_QTDE']?>">

			   </span></td>

			 </tr>

		   </table>

		  </div>

	   </td>

       </tr>

     <tr>

       <td height="15" class=""><strong>N. NF origem </strong></td>

       <td height="15" class=""><input name="ITEM_NF" type="text" class="form" id="ITEM_NF" size="6" maxlength="6" onKeyDown="clearNF()" value="<?=$_GET['ITEM_NF']?>">

       &nbsp;&nbsp;

       <strong>N. S&eacute;rie </strong>

       <input name="ITEM_SERIE" type="text"  readOnly class="form" id="ITEM_SERIE" size="4" maxlength="3">

       </td>

       <td height="15"><strong class="">Data NF</strong></td>

       <td height="15"><span class="">

         <input name="ITEM_DATA_EMISSAO" type="text" readOnly class="form" id="ITEM_DATA_EMISSAO" size="20" maxlength="50">

       </span></td>

     </tr>

     <tr>

       <td height="15" class=""><strong>Valor unit&aacute;rio </strong></td>

       <td height="15"><span class="">

         <input name="ITEM_VALOR_UNITARIO" type="text" readOnly class="form" id="ITEM_VALOR_UNITARIO" size="20" maxlength="20">

         <input name="ITEM_VALOR_ROYALTIE" type="hidden" readOnly class="campo_amarelo" id="ITEM_VALOR_ROYALTIE" size="20" maxlength="20">

</span></td>

       <td height="15"><strong class="">Valor total </strong></td>

       <td height="15"><span class="">

         <input name="ITEM_VALOR_TOTAL" type="text" readOnly class="form" id="ITEM_VALOR_TOTAL" size="20" maxlength="20">

         <span class="style2"></span></span></td>

     </tr>

     <tr>

       <td colspan="4" class=""><div align="center">

	   <a href="javascript: ConsistNotaFiscal();" ><img src="img/bts/pesquisa.jpg" name="Image351" border="0" id="Image351"></a>

       	</div>

	    </td>

       </tr>

     <tr>

       <td colspan="4" class=""><table width="100%"  border="0">

         <tr>

           <td width="32%"><table width="99%"  border="0">

             <tr class="">

               <td class="">

			   	<div id="mensagem_foto1_1" style="display:">

					<table width="100%"  border="0">

						<tr>

							<td><div align="left"><strong>Foto do produto</strong></div></td>

						</tr>

					</table>

				</div>



			   	<div id="mensagem_foto1_2" style="display:none">

					<table width="100%"  border="0">

						<tr>

							<td><div align="left"><strong>Foto do produto - frente </strong></div></td>

						</tr>

					</table>

			   	</div>

			   </td>

             </tr>



             <tr>

               <td>

                 <div align="left">
                   <input name="fileProd" type="file" class="campo_texto" id="fileProd" onchange="LoadImagemProduto();" size="15">
				           <input type="hidden" name="fileProdNome" id="fileProdNome" value="" />
                 </div></td>

               </tr>

             <tr>

               <td><img src="img/foto.jpg" name="imgFile1" id="imgFile1" width="250"></td>

             </tr>

			 <?php if ($_SESSION["Menu"] == "3"){?>

             <tr>

               <td class="style1"><!--<div align="center" class="texto_obrigatorio">Com a inclus&atilde;o das fotos a probabilidade de aceita&ccedil;&atilde;o do defeito &eacute; maior</div>--></td>

             </tr>

			 <?php } ?>

           </table></td>

           <td width="33%"><table width="99%"  border="0">

             <tr class="">

               <td class="">

			   <div id="mensagem_foto2_1" style="display:">

					<table width="100%"  border="0">

						<tr>

							<td><div align="left"><strong>Foto da sola</strong></div></td>

						</tr>

					</table>

				</div>



			   	<div id="mensagem_foto2_2" style="display:none">

					<table width="100%"  border="0">

						<tr>

							<td><div align="center"><strong>Foto do produto - verso </strong></div></td>

						</tr>

					</table>

			   	</div>



			   </td>

             </tr>



             <tr>

               <td>

                 <div align="left">

                   <input name="fileSola" type="file" class="campo_texto" id="fileSola" size="15">
				   <input type="hidden" name="fileSolaNome" id="fileSolaNome" value="" />

                 </div></td>

               </tr>

             <tr>

               <td><img src="img/foto.jpg" name="imgFile2" id="imgFile2" width="250"></td>

             </tr>

			 <?php if ($_SESSION["Menu"] == "3"){?>

             <tr>

               <td class="style1"><!--<div align="center" class="texto_obrigatorio">Com a inclus&atilde;o das fotos a probabilidade de aceita&ccedil;&atilde;o do defeito &eacute; maior</div>--></td>

             </tr>

			 <?php } ?>

           </table></td>

           <td width="33%"><table width="99%"  border="0">

             <tr class="">

               <td class="">



			   <div id="mensagem_foto3_1" style="display:">

					<table width="100%"  border="0">

						<tr>

							<td><div align="left"><strong>Foto do defeito</strong></div></td>

						</tr>

					</table>

				</div>



			   	<div id="mensagem_foto3_2" style="display:none">

					<table width="100%"  border="0">

						<tr>

							<td><div align="center"><strong>Foto do defeito </strong></div></td>

						</tr>

					</table>

			   	</div>



			   </td>

             </tr>



               <td>

                 <div align="left">

                   <input name="fileDefe" type="file" class="campo_texto" id="fileDefe" size="15">
				   <input type="hidden" name="fileDefeNome" id="fileDefeNome" value="" />

                 </div></td>

               </tr>

             <tr>

               <td><img src="img/foto.jpg" name="imgFile3" id="imgFile3" width="250"></td>

             </tr>

			 <?php if ($_SESSION["Menu"] == "3"){?>

             <tr>

               <td class="style1"><!--<div align="center" class="texto_obrigatorio">Com a inclus&atilde;o das fotos a probabilidade de aceita&ccedil;&atilde;o do defeito &eacute; maior</div>--></td>

             </tr>

			 <?php } ?>

           </table></td>

         </tr>

       </table>         </td>

       </tr>

     <tr>

       <td colspan="4">

	   <div id="idButtons" style="display:" align="center">

	   <a href="javascript:verificaForm(document.form);" ><img src="img/bts/gravar.jpg" name="Image351" border="0" id="Image351"></a><a href="pesq_defeitos.php" ><img src="img/bts/cancelar.jpg" name="Image361" border="0" id="Image361"></a></div></td>

       </tr>

   </table>

   <input type="hidden" name="TOTAL_ITENS" value="15">

</form>

	<br/ ><br/ >

	</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>

    <td bgcolor="#333333">&nbsp;</td>

  </tr>

</table>





<script language="javascript" type="text/javascript">

<!--

function selectCategoria(valor){
    jQuery(document).ready(function($){
        elemento = document.getElementById("tbCategoria");
        for(var i=0;i<elemento.length;i++){
           elemento[i].checked = false;
        }
        $("#tbCategoria input[value="+valor+"]").attr("checked", true);
    });
}


function SomaQtde(){

	$Qtde = 0;

	if (document.form.ITEM_NUM33.value != ""){

		$Qtde = $Qtde + parseInt(document.form.ITEM_NUM33.value);

	}

	if (document.form.ITEM_NUM34.value != ""){

		$Qtde = $Qtde + parseInt(document.form.ITEM_NUM34.value);

	}

	if (document.form.ITEM_NUM35.value != ""){

		$Qtde = $Qtde + parseInt(document.form.ITEM_NUM35.value);

	}

	if (document.form.ITEM_NUM36.value != ""){

		$Qtde = $Qtde + parseInt(document.form.ITEM_NUM36.value);

	}

	if (document.form.ITEM_NUM37.value != ""){

		$Qtde = $Qtde + parseInt(document.form.ITEM_NUM37.value);

	}

	if (document.form.ITEM_NUM38.value != ""){

		$Qtde = $Qtde + parseInt(document.form.ITEM_NUM38.value);

	}

	if (document.form.ITEM_NUM39.value != ""){

		$Qtde = $Qtde + parseInt(document.form.ITEM_NUM39.value);

	}

	if (document.form.ITEM_NUM40.value != ""){

		$Qtde = $Qtde + parseInt(document.form.ITEM_NUM40.value);

	}

	document.form.ITEM_QTDE.value = $Qtde;



	calcAll();

}



function CompleteData(fieldPessoa) {
	if (fieldPessoa.value != "")
		JSUtilRequest("autoCompletar.php?cmd=d_c&PESSOA=" + fieldPessoa.value);
}

function viewImage(fieldFile,optionValue) {

  if (fieldFile.value != "")

	document.images['imgFile' + optionValue].src = "file://" + fieldFile.value;

}



function calcAll() {

	/*if (document.form.TOTAL_ITENS.value != "" && parseInt(document.form.TOTAL_ITENS.value)  < parseInt(document.form.ITEM_QTDE.value)) {

		alert("A quantidade foi excedida !");

		document.form.ITEM_QTDE.value = "";

	}*/

	if (document.form.ITEM_QTDE.value == "" || document.form.ITEM_VALOR_UNITARIO.value == "")

		document.form.ITEM_VALOR_TOTAL.value = "R$ 0,00";

	else

		document.form.ITEM_VALOR_TOTAL.value = "R$ " + arredondaNumber(parseFloat(document.form.ITEM_VALOR_UNITARIO.value.substring(3).replace(",",".")) * parseInt(document.form.ITEM_QTDE.value),",",2,true);

}



function ConsistNotaFiscal() {

	if (document.form.LANCA_PESSOA.value == "" || document.form.ITEM_REFERENCIA.value == "")

		alert("Os campos \"Cliente, Referência\" devem estar preechidos\npara realizar esta operação");

	else

		clearNF();

		if (document.form.LANCA_CATEGORIA[0].checked){
			categoria = document.form.LANCA_CATEGORIA[0].value;
		}

		if (document.form.LANCA_CATEGORIA[1].checked){
			categoria = document.form.LANCA_CATEGORIA[1].value;
		}

		if (document.form.LANCA_CATEGORIA[2].checked){
			categoria = document.form.LANCA_CATEGORIA[2].value;
		}

		if (document.form.LANCA_CATEGORIA[3].checked){
			categoria = document.form.LANCA_CATEGORIA[3].value;
		}

		if (document.form.LANCA_CATEGORIA[4].checked){
			categoria = document.form.LANCA_CATEGORIA[4].value;
		}

		if (document.form.LANCA_CATEGORIA[5].checked){
			categoria = document.form.LANCA_CATEGORIA[5].value;
		}

		if (document.form.LANCA_CATEGORIA[6].checked){
			categoria = document.form.LANCA_CATEGORIA[6].value;
		}

		if (document.form.LANCA_CATEGORIA[7].checked){
			categoria = document.form.LANCA_CATEGORIA[7].value;
		}
    var url = 'autoCompletar.php?cmd=p_r&NF=' + escape(document.form.ITEM_NF.value) + '&PESSOA=' + escape(document.form.LANCA_PESSOA.value) + '&REFERENCIA=' + escape(document.form.ITEM_REFERENCIA.value) + '&NOMECLIENTE=' + escape(document.form.NOME.value) + '&Categoria='+escape(categoria);
		JSUtilRequest(url);
}

function updateFabrica() {

	JSUtilRequest('autoCompletar.php?cmd=p_f&PESSOA=' + escape(document.form.LANCA_PESSOA.value) + '&REFERENCIA=' + escape(document.form.ITEM_REFERENCIA.value));

}



function validaTypeImg(fieldFile) {

	extension = (fieldFile.substring(fieldFile.lastIndexOf(".") + 1)).toLowerCase();

	if (extension == "jpg" || extension == "gif" || extension == "jpeg")

		return true;

	else

		return false;

}

function verificaForm(formObj) {

	if (document.form.LANCA_CATEGORIA[0].checked){

		SomaQtde();

	}



	/*if (formObj.DIAS.value > 180){

		alert("A NF selecionada foi comercializada a mais de 6 meses. Selecione outra NF !");

		return;

	}*/



	if (formObj.LANCA_PESSOA.value == "") {

		alert("Preencha o campo \"Cliente\"");

		return;

	}

	if (formObj.LANCA_SOLICITANTE.value == "") {

		alert("Preencha o campo \"Solicitante\"");

		formObj.LANCA_SOLICITANTE.focus();

		return;

	}

	if (formObj.LANCA_MOVITO.value == "") {

		alert("Preencha o campo \"Motivo\"");

		formObj.LANCA_MOVITO.focus();

		return;

	}

	if (formObj.CLIENTE_NOME.value == "") {

		alert("Preencha o campo \"Nome do consumidor\"");

		formObj.CLIENTE_NOME.focus();

		return;

	}

	if (formObj.CLIENTE_FONE.value == "") {

		alert("Preencha o campo \"Fone do consumidor\"");

		formObj.CLIENTE_FONE.focus();

		return;

	}



	if (!formObj.LANCA_TIPORECLAMACAO[0].checked && !formObj.LANCA_TIPORECLAMACAO[1].checked) {

		alert("Preencha o campo \"Tipo de reclama��o\"");

		return;

	}

	if (formObj.LANCA_FABRI_IDO.value == "") {

		alert("Preencha o campo \"Fabricante\"");

		return;

	}

	if (document.form.ITEM_QTDE.value == "") {

		if (document.form.LANCA_CATEGORIA[0].checked){

			alert("Preencha a grade com a quantidade de pares reclamados !\nQuantidade='"+document.form.ITEM_QTDE.value+"'");

			document.form.ITEM_NUM33.focus();

		}else{

			alert("Preencha o campo \"Quantidade\"");

			document.form.ITEM_QTDE.focus();

		}

		return;

	}

	if (document.form.ITEM_QTDE.value == 0) {

		if (document.form.LANCA_CATEGORIA[0].checked){

			alert("Preencha a grade com a quantidade de pares reclamados. Todas as quantidades est�o zeradas !");

			document.form.ITEM_NUM33.focus();

		}else{

			alert("O campo \"Quantidade\" deve ser maior que ZERO !");

			document.form.ITEM_QTDE.focus();

		}

		return;

	}



	/*if (document.form.ITEM_PAR.value == "") {

		alert("Preencha o campo \"N� DO PAR\"");

		document.form.ITEM_PAR.focus();

		return;

	}*/

	if (document.form.ITEM_DATA_EMISSAO.value == "") {

		alert("Nota fiscal n�o validada no sistema !");

		return;

	}



	if (formObj.MENU.value != "3" || (formObj.MENU.value == "3" && !document.form.LANCA_CATEGORIA[0].checked)){

		if (document.getElementById("fileProdNome").value == "") {

			alert("Preencha a foto do produto");

			return;

		}else if (!validaTypeImg(document.getElementById("fileProdNome").value)) {

			alert("Imagem \"foto do produto\" no formato incorreto.");

			return;

		}

		if (document.getElementById("fileSolaNome").value == "") {

			alert("Preencha a foto da sola");

			return;

		}else if (!validaTypeImg(document.getElementById("fileProdNome").value)) {

			alert("Imagem \"foto da sola\" no formato incorreto.");

			return;

		}

		if (document.getElementById("fileDefeNome").value == "") {

			alert("Preencha a foto do defeito");

			return;

		}else if (!validaTypeImg(document.getElementById("fileDefeNome").value)) {

			alert("Imagem \"foto do defeito\" no formato incorreto.");

			return;

		}

	}

	document.getElementById("idButtons").style.display = "none";



	formObj.action = "pesq_reclamacaook.php";

	document.form.submit();

}



function MostraDados(opcao){

	if (opcao == 1){

		document.getElementById("numeropar").style.display = "";

		document.getElementById("qtdepar").style.display = "none";

		document.getElementById("mensagem_foto1_1").style.display = "";

		document.getElementById("mensagem_foto1_2").style.display = "none";

		document.getElementById("mensagem_foto2_1").style.display = "";

		document.getElementById("mensagem_foto2_2").style.display = "none";

		document.getElementById("mensagem_foto3_1").style.display = "";

		document.getElementById("mensagem_foto3_2").style.display = "none";

	}



	if (opcao == 2 || opcao == 3 || opcao == 4){

		document.getElementById("numeropar").style.display = "none";

		document.getElementById("qtdepar").style.display = "";

		document.getElementById("mensagem_foto1_1").style.display = "none";

		document.getElementById("mensagem_foto1_2").style.display = "";

		document.getElementById("mensagem_foto2_1").style.display = "none";

		document.getElementById("mensagem_foto2_2").style.display = "";

		document.getElementById("mensagem_foto3_1").style.display = "none";

		document.getElementById("mensagem_foto3_2").style.display = "";

	}



}



function abrir_janela_popup(theURL,winName,features) {

		window.open(theURL,winName,features);

	}



function abre_listagem(){

	abrir_janela_popup('rel_listagem_fabrica.php','popup_nf','width=600,height=500,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes');

}
function clearNF() {

	document.form.ITEM_COLECAO.value = "";

	document.form.ITEM_SERIE.value = "";

	document.form.ITEM_DATA_EMISSAO.value = "";

	document.form.ITEM_QTDE.value = "";

	document.form.ITEM_VALOR_UNITARIO.value = "R$ 0,00";

	document.form.ITEM_VALOR_ROYALTIE.value = "R$ 0,00";

	document.form.ITEM_VALOR_TOTAL.value = "R$ 0,00";

	document.form.ITEM_PESSOA_EMITENTE.value = "";

	for (x = 0;x < document.form.LANCA_FABRI_IDO.length; x++)

		document.form.LANCA_FABRI_IDO.options[0] = null;

}

<?php	if (trim($_GET['LANCA_PESSOA']) && trim($_GET['LANCA_MOVITO'])) { ?>

	ConsistNotaFiscal();

	MostraDados(<?=$Categoria?>);

	alert("N�o foi possivel realizar a reclama��o,\nUma ou mais imagens atingiram o tamanho m�ximo de 150Kb !");



<?php } ?>



//-->

</script>

<script>
    new AjaxUpload('#fileProd',
            {
                    action: 'upload_preview.php',
                    name: 'foto',
                    onComplete : function(file, response)
                    {
                        if (response == "#TAMANHOINVALIDO#")
                        {
                            alert("O tamanho máximo permitido para as imagens é 150Kb!");
                        }
                        else
                        {
                            document.getElementById("imgFile1").src = response;
                            document.getElementById("fileProdNome").value = response;
                        }
                    }
            }
    );

    new AjaxUpload('#fileSola',
            {
                    action: 'upload_preview.php',
                    name: 'foto',
                    onComplete : function(file, response)
                    {
                        if (response == "#TAMANHOINVALIDO#")
                        {
                            alert("O tamanho máximo permitido para as imagens é 150Kb!");
                        }
                        else
                        {
                            document.getElementById("imgFile2").src = response;
                            document.getElementById("fileSolaNome").value = response;
                        }
                    }
            }
    );

	 new AjaxUpload('#fileDefe',
            {
                    action: 'upload_preview.php',
                    name: 'foto',
                    onComplete : function(file, response)
                    {
                        if (response == "#TAMANHOINVALIDO#")
                        {
                            alert("O tamanho máximo permitido para as imagens é 150Kb!");
                        }
                        else
                        {
                            document.getElementById("imgFile3").src = response;
                            document.getElementById("fileDefeNome").value = response;
                        }
                    }
            }
    );
</script>

</body>

</html>