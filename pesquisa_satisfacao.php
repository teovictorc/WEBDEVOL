<? include("inc/headerI.inc.php"); 

	$msg = $_GET['msg']; 

	if ($msg == ""){

		$msg = "2";

	}

	

?>

<script language="JavaScript" type="text/JavaScript">

<!--

function MM_swapImgRestore() { //v3.0

  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

}



function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}



function MM_findObj(n, d) { //v4.01

  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

  if(!x && d.getElementById) x=d.getElementById(n); return x;

}



//-->

</script>

<link href="wfa.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/JavaScript">

<!--

function MM_swapImage() { //v3.0

  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)

   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

}

//-->

</script>

<body onLoad="MM_preloadImages('imagens/gravar2.jpg','imagens/cancelar2.jpg')">

<form name="form" method="post" action="cad_defeitosok.php">

<input type="hidden" name="ID" value="<?=$ID?>">

<table width="100%"  border="0" align="center">

     <tr>

       <td><div align="center"><span class="titulo">:: Pesquisa de satisfa&ccedil;&atilde;o - WFA Web ::</span> </div>         <div align="right"></div></td>

     </tr>

  </table>

</td>

   <td><img name="webdevol_r7_c11" src="imagens/img/webdevol_r7_c11.jpg" width="33" height="38" border="0" alt=""></td>

  </tr>

  <tr>

   <td background="imagens/img/webdevol_r8_c1.jpg">&nbsp;</td>

   <td colspan="9">

    <table width="100%"  border="0" class="tabela">

      <tr>

        <td colspan="2" class="style2"><p align="center" class="TextNormal_12">&Eacute; com grande satisfa&ccedil;&atilde;o que encerramos nosso treinamento sobre o WFA Web. Assim, gostar&iacute;amos de ter uma an&aacute;lise sua para sabermos como foram os servi&ccedil;os prestados quanto ao treinamento, assim como um parecer sobre a nova vers&atilde;o do sistema.</p>

          <p align="center" class="TextNormal_12">Para isso, elaboramos um pequeno question&aacute;rio, no qual solicitamos que seja respondido pela pessoa que recebeu o treinamento. Desde j&aacute; agradecemos a oportunidade e estamos sempre a disposi&ccedil;&atilde;o para esclarecimento de quaisquer d&uacute;vidas que vierem a surgir. </p></td>

        </tr>

      <tr>

        <td colspan="2" class="style2">&nbsp;</td>

      </tr>

      <tr bgcolor="#FFFF99" class="listagem_autorgerada">

        <td colspan="2" ><div align="center"><strong>:: Relat&oacute;rio de avalia&ccedil;&atilde;o de treinamento - Sistema WFA Web :: </strong></div></td>

      </tr>

      <tr>

        <td class="style2">C&oacute;digo da loja: </td>

        <td class="style2"><input name="pesq_pessoa" type="text" class="campo_texto" id="pesq_pessoa" value="" size="7" maxlength="5"></td>

      </tr>

      <tr>

        <td class="style2">Nome da loja: </td>

        <td class="style2"><input name="pesq_nome" type="text" class="campo_texto" id="pesq_nome" value="" size="50" maxlength="50"></td>

      </tr>

      <tr>

        <td class="style2">Respons&aacute;vel:</td>

        <td class="style2"><input name="pesq_responsavel" type="text" class="campo_texto" id="pesq_responsavel" value="" size="50" maxlength="50"></td>

      </tr>

      <tr>

        <td colspan="2" class="style2"><p align="center">Responda o question&aacute;rio abaixo, informando o n&iacute;vel de satisfa&ccedil;&atilde;o em cada &iacute;tem, aonde:<br> 

          <strong>1 &eacute; totalmente satisfeito e 5 &eacute; totalmente insatisfeito</strong>:</p></td>

      </tr>

      <tr>

        <td colspan="2" class="style2"><strong>:: Quanto as melhorias do sistema </strong></td>

        </tr>

      <tr>

        <td width="14%" class="style2"><strong>

          <select name="pesq_pergunta1" class="style1" id="pesq_pergunta1">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td width="86%" class="style1"> Como considera a nova vers&atilde;o do sistema, aonde muitos dados s&atilde;o trazidos de forma autom&aacute;tica ? </td>

      </tr>

      <tr>

        <td class="style2"><strong>

          <select name="pesq_pergunta2" class="style1" id="pesq_pergunta2">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td class="style1"> A integra&ccedil;&atilde;o online com a transportadora, aonde a mesma j&aacute; recebe de forma autom&aacute;tica todas as notas fiscais que est&atilde;o dispon&iacute;veis para coleta </td>

      </tr>

      <tr>

        <td class="style2"><strong>

          <select name="pesq_pergunta3" class="style1" id="pesq_pergunta3">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td class="style1"> A facilidade na emiss&atilde;o da nota fiscal de devolu&ccedil;&atilde;o, aonde agora basta apenas copiar os dados que s&atilde;o enviados na pr&eacute;-nota </td>

      </tr>

      <tr>

        <td class="style2"><strong>

          <select name="pesq_pergunta4" class="style1" id="pesq_pergunta4">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td class="style1"><p>A interface web da nova vers&atilde;o ficou mais amig&aacute;vel e pr&aacute;tica ? </p></td>

      </tr>

      <tr>

        <td class="style2"><strong>

          <select name="pesq_pergunta5" class="style1" id="pesq_pergunta5">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td class="style1"> Quanto ao relat&oacute;rio de gerenciamento de etapas, aonde o mesmo demonstra de forma clara e cronol&oacute;gica em qual etapa est&aacute; a reclama&ccedil;&atilde;o. </td>

      </tr>

      <tr>

        <td class="style2">&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td colspan="2" class="style2"><strong>:: Quanto ao treinamento </strong></td>

        </tr>

      <tr>

        <td class="style2"><strong>

          <select name="pesq_pergunta6" class="style1" id="pesq_pergunta6">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td class="style1">Dura&ccedil;&atilde;o do treinamento</td>

      </tr>

      <tr>

        <td class="style2"><strong>

          <select name="pesq_pergunta7" class="style1" id="pesq_pergunta7">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td class="style1"><p>Dom&iacute;nio do assunto pelo instrutor</p></td>

      </tr>

      <tr>

        <td class="style2"><strong>

          <select name="pesq_pergunta8" class="style1" id="pesq_pergunta8">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td class="style1"><p>Conhecimento adquirido</p></td>

      </tr>

      <tr>

        <td class="style2"><strong>

          <select name="pesq_pergunta9" class="style1" id="pesq_pergunta9">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td class="style1"><p>Facilidade no relacionamento do instrutor</p></td>

      </tr>

      <tr>

        <td class="style2"><strong>

          <select name="pesq_pergunta10" class="style1" id="pesq_pergunta10">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td class="style1"><p>Atingimento das expectativas</p></td>

      </tr>

      <tr>

        <td class="style2"><strong>

          <select name="pesq_pergunta11" class="style1" id="select10">

            <option value="">-- Selecione --</option>

            <option value="1">1</option>

            <option value="2">2</option>

            <option value="3">3</option>

            <option value="4">4</option>

            <option value="5">5</option>

          </select>

        </strong></td>

        <td class="style1"> Resolu&ccedil;&atilde;o de d&uacute;vidas pelo instrutor </td>

      </tr>

      <tr>

        <td class="style2">&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td colspan="2" class="style2"><strong>:: Sugest&otilde;es/cr&iacute;ticas/melhorias</strong></td>

        </tr>

      <tr>

        <td colspan="2" class="style2"><textarea name="pesq_comentario" cols="100%" rows="5" class="campo_texto" id="pesq_comentario"></textarea></td>

        </tr>

      <tr>

        <td colspan="2">&nbsp;</td>

      </tr>

      <tr>

        <td height="30" colspan="2" class="listagem_procedenteFonte"><div align="center" class="texto_obrigatorio"><strong>Agradecemos pela aten&ccedil;&atilde;o !</strong></div></td>

      </tr>

      <tr>

        <td colspan="2">&nbsp;</td>

      </tr>

      <tr>

        <td colspan="2"> <div align="center"><a href="javascript:verificaForm();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)">

           

          </a><a href="javascript:verificaForm(document.form)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)"><img src="imagens/gravar.jpg" alt="Gravar dados" name="Image351" width="58" height="20" border="0" id="Image351"></a><a href="javascript:verificaForm();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image351','','imagens/gravar2.jpg',1)">

        </a><a href="pesq_defeitos.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image361','','imagens/cancelar2.jpg',1)"><img src="imagens/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" width="68" height="20" border="0" id="Image361"></a></div></td>

        </tr>

    </table>

</form>

<? include("inc/headerF.inc.php"); ?>

<script language="javascript" type="text/javascript">

<!--

if (<?=$msg?> == "1"){

	alert("Pesquisa de satisfação enviada com sucesso !\n\nA equipe de desenvolvimento Freehold - WFA Web agradece a sua participação e nos colocamos a sua total disposição.\n\n------------------------------------------------\nFreehold Assessoria e Tecnologia Ltda\n:: Soluções e inovações tecnológicas para sua empresa ::\n51 8146-9019\nfreehold@freehold.com.br\nwww.freehold.com.br");

}



function verificaForm(formObj) {

	if (formObj.pesq_pessoa.value == "") {

		alert("Preencha o campo \"CÓDIGO DA LOJA\"");

		formObj.pesq_pessoa.focus();

		return;

	}

	if (formObj.pesq_nome.value == "") {

		alert("Preencha o campo \"NOME DA LOJA\"");

		formObj.pesq_nome.focus();

		return;

	}

	if (formObj.pesq_responsavel.value == "") {

		alert("Preencha o campo \"RESPONSÁVEL\"");

		formObj.pesq_responsavel.focus();

		return;

	}

	if (formObj.pesq_pergunta1.value == "") {

		alert("Preencha a resposta para a pergunta 1 !");

		formObj.pesq_pergunta1.focus();

		return;

	}

	if (formObj.pesq_pergunta2.value == "") {

		alert("Preencha a resposta para a pergunta 2 !");

		formObj.pesq_pergunta2.focus();

		return;

	}

	if (formObj.pesq_pergunta3.value == "") {

		alert("Preencha a resposta para a pergunta 3 !");

		formObj.pesq_pergunta3.focus();

		return;

	}

	if (formObj.pesq_pergunta4.value == "") {

		alert("Preencha a resposta para a pergunta 4 !");

		formObj.pesq_pergunta4.focus();

		return;

	}

	if (formObj.pesq_pergunta5.value == "") {

		alert("Preencha a resposta para a pergunta 5 !");

		formObj.pesq_pergunta5.focus();

		return;

	}

	if (formObj.pesq_pergunta6.value == "") {

		alert("Preencha a resposta para a pergunta 6 !");

		formObj.pesq_pergunta6.focus();

		return;

	}

	if (formObj.pesq_pergunta7.value == "") {

		alert("Preencha a resposta para a pergunta 7 !");

		formObj.pesq_pergunta7.focus();

		return;

	}

	if (formObj.pesq_pergunta8.value == "") {

		alert("Preencha a resposta para a pergunta 8 !");

		formObj.pesq_pergunta8.focus();

		return;

	}

	if (formObj.pesq_pergunta9.value == "") {

		alert("Preencha a resposta para a pergunta 9 !");

		formObj.pesq_pergunta9.focus();

		return;

	}

	if (formObj.pesq_pergunta10.value == "") {

		alert("Preencha a resposta para a pergunta 10 !");

		formObj.pesq_pergunta10.focus();

		return;

	}

	if (formObj.pesq_pergunta11.value == "") {

		alert("Preencha a resposta para a pergunta 11 !");

		formObj.pesq_pergunta11.focus();

		return;

	}

	formObj.action = "pesquisa_satisfacaook.php";		

	document.form.submit();

}



//-->

</script>