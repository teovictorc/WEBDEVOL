<? //include("inc/conn_externa.inc.php"); 

   include("inc/headerI.inc.php"); ?>



<script language="JavaScript" type="text/JavaScript">

<!--

function abrir_janela_popup(theURL,winName,features) { //v2.0

window.open(theURL,winName,features);

}

//-->

</script>

<script language="JavaScript" type="text/JavaScript">

<!--





function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}

//-->

</script>

<script language="JavaScript" type="text/JavaScript">

<!--

function MM_swapImgRestore() { //v3.0

  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

}



function MM_findObj(n, d) { //v4.01

  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

  if(!x && d.getElementById) x=d.getElementById(n); return x;

}



function MM_swapImage() { //v3.0

  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)

   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

}

//-->

</script>

<link href="wfa.css" rel="stylesheet" type="text/css">

</head>
<body SCROLL="auto">


<body onLoad="MM_preloadImages('imagens/fechar2.jpg','imagens/gravar2.jpg')">

<form name="form" method="post" action="email.php?Id=<?=$_GET['Referencia']?>">

<input type="hidden" name="ID" value="">

<table width="100%"  border="0" class="">

  <tr class="tab_conteudo">

    <td height="25" colspan="2" class="tab_titulo"><h4>Encaminhar avalia&ccedil;&atilde;o RAR para agenciador</h4></td>

  </tr>

  <tr class="">

    <td colspan="2" class="tab_titulo" style="padding-top:10px; padding-bottom:10px;"><div align="center"><strong>Assinale abaixo para quem dever&aacute; ser encaminhado o email com avalia&ccedil;&atilde;o da RAR foto </strong></div></td>

  </tr>

  <tr>

    <td colspan="2" class="">&nbsp;</td>

  </tr>

  <tr>

    <td><strong>N&ordm; reclama&ccedil;&atilde;o </strong></td>

    <td><input name="textfield" type="text" class="form" value="<?=$_GET['Referencia']?>" readonly></td>

  </tr>

 </table>

 <hr>	

  <table width="100%"  border="0">

     <?

      $Stmt = mysql_query("SELECT * FROM rar_contato ORDER BY CONT_NOME");

        	  while($Rs = mysql_fetch_assoc($Stmt)) 

			   { 

                $CONT_IDO = ucwords($Rs['CONT_IDO']);

	            $CONT_NOME = ucwords($Rs['CONT_NOME']);

				$CONT_EMAIL = trim(strtolower($Rs['CONT_EMAIL']));

	?>

      <tr>

        <td align="center">

		  <input type="checkbox" name="MAIL" id="MAIL" class="form" value="<? echo $CONT_EMAIL;?>">

        </td>

        <td class="style1"><? echo $CONT_NOME;?></td>

        <td><input name="textfield2" type="text"  class="form" value="<? echo $CONT_EMAIL;?>" size="50" readonly></td>

      </tr>

   <? } ?>

  </table>

  <hr>

  <table align="center">

  <tr>

    <td class="style2" valign="top"><strong>Mensagem</strong></td>

    <td><textarea name="MENSAGEM" cols="50" rows="5" class="txt" id="MENSAGEM"></textarea></td>

  </tr>

  <tr>

    <td colspan="2"><div align="center"><a href="javascript:sendMail()"><img src="imagens/enviar.jpg" alt="Gravar dados" name="Image351" width="52" height="22" border="0" id="Image351"></a><a href="javascript:window.close()" ><img src="imagens/fechar.jpg" name="Image31" width="52" height="22" border="0" id="Image31"></a></div></td>

  </tr>

</table>

<div align="center">

  <p>&nbsp;</p>

</div>

</form>

<script language="javascript" type="text/javascript">

<!--

function sendMail() {

	var Values = chk_checkedAllValues(document.form.MAIL,true,"|",true);

	if (Values == "") {

		alert("Nenhum destinatário selecionado !");

		return;

	}

	//alert(Values);

	document.form.ID.value = Values;

	document.form.submit();

}



function chk_checkAll(elementForm,checked) {

	if (elementForm) {

		if (elementForm.length == undefined)

			elementForm.checked = checked;

		else{

			for(x = 0; x < elementForm.length; x++)

				elementForm[x].checked = checked;

		}

	}

}



function isCheckedAll() {

	document.form.IDS.checked = chk_isCheckedAll(document.form.ID,true);

}

function chk_isCheckedAll(elementForm,checked) {

	if (elementForm){

		if (elementForm.length == undefined)

			return (elementForm.checked == checked);

		else{

			for(x = 0; x < elementForm.length; x++) {

				if (elementForm[x].checked != checked) 

					return false;

			}

			return true;

		}

	}

	return false;

}



function chk_checkedAllValues(elementForm,checked,optionDiv,valueEncode) {

	if (elementForm) {

		if (elementForm.length == undefined) {

			if (elementForm.checked == checked)

				return elementForm.value;

			return "";

		}else{

			var Values = "";

			optionDiv = (optionDiv == undefined) ? "," : optionDiv;

			valueEncode = (valueEncode == undefined) ? false : valueEncode;

			for(x = 0; x < elementForm.length; x++) {

				if (elementForm[x].checked == checked) 

					Values+= ((Values.length > 0) ? optionDiv : "") + ((valueEncode) ? escape(elementForm[x].value) : elementForm[x].value);

			}

			return Values;

		}

	}

	return "";

}



//-->

</script>

</body>

</html>

