<?php
//include("inc/headerI.inc.php"); 

include("inc/conn.inc.php"); 

if($_SESSION['Menu'] == 2){ 

	$ImagemTopo = "wfa_arezzo_r4_c4_s.jpg";

}elseif($_SESSION['Menu'] == 3){ 

	$ImagemTopo = "wfa_arezzo_r4_c4_tm.jpg";

}elseif($_SESSION['Menu'] == 4){ 

	$ImagemTopo = "wfa_arezzo_r4_c4_r.jpg";

}elseif($_SESSION['Menu'] == 5){ 

	$ImagemTopo = "wfa_arezzo_r4_c4_iaf.jpg";

}elseif($_SESSION['Menu'] == 6){ 

	$ImagemTopo = "wfa_arezzo_r4_c4_pesq.jpg";

}else{

	$ImagemTopo = "wfa_arezzo_r4_c4_t.jpg";

}

$_GET["Categoria"] = "1,2,3,4,5,6,7,8,9,10,11";
verifyAcess("ARZ_AVALIPENDENTE","S");

?>
<!DOCTYPE html>
<html>
<?php 

if ($_POST["Categoria"] != ""){
	$Categoria = $_POST['Categoria'];
}

$Texto = "Todos os produtos";
function situacao($value) {
	switch($value) {
            case "P":
                return "Improcedente"; //somente est� trocado para exibicao das imagens
                break;
            case "I":
                return "Procedente";  //somente est� trocado para exibicao das imagens
                break;
            case "E":
                return "Emanalise";  //somente est� trocado para exibicao das imagens
                break;
            case "C":
                return "Conserto";  //somente est� trocado para exibicao das imagens
                break;
            case "F":
                return "Fabrica";  //somente est� trocado para exibicao das imagens
                break;
            default:
                return "";
	}
}
?>
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <title><?=$NomeSistema?></title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.css">
    <link href="wfa.css" rel="stylesheet" type="text/css">
    <link href="css/global.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
    <script src="js/jquery-ui.min.js"></script>    
</head>
<body>
<div id="Layer1" style="position:absolute; left:249px; top:57px; width:69px; height:29px; z-index:1; visibility: hidden;"><a href=http://www.milonic.com/styleproperties.php class="style1">http://www.milonic.com/styleproperties.php</a></div>

<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="778" height="80" class="bg_topo">
    <table width="778" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="500"><h1><?=$NomeSistema?></h1></td>
        <td align="center"><h2>Ol&aacute;, <?=$_SESSION['sNome']?></h2>
          </br >
          <a href="login.php" class="email"><img src="img/bts/logof.jpg" alt="logoff" align="absmiddle" border="0"> logoff</a></td>
      </tr>
    </table>    
    </td>
    <td class="bg_topo">&nbsp;</td>
  </tr>
  <tr>
    <td height="45" class="bg_cinza02">
<!--		<table width="697" height="28" border="0" cellspacing="0" cellpadding="0" id="tabmenu">
		  <tr>
			<td width="81" background="img/bgs/menu_80_on.jpg" align="center"><h3>Gerenciador</h3></td>
			<td width="73" background="img/bgs/menu_72.jpg" align="center"><a href="cadastro.html" class="menu">Cadastros</a></td>
			<td width="55" background="img/bgs/menu_54.jpg" align="center"><a href="inclusao.html" class="menu">Cliente</a></td>
			<td width="73" background="img/bgs/menu_72.jpg" align="center"><a href="#" class="menu">Retaguarda</a></td>
			<td width="73" background="img/bgs/menu_72.jpg" align="center"><a href="#" class="menu">Parceiros</a></td>
			<td width="73" background="img/bgs/menu_72.jpg" align="center"><a href="#" class="menu">Relat�rios</a></td>
			<td width="95" background="img/bgs/menu_94.jpg" align="center"><a href="#" class="menu">Configura��es</a></td>
			<td width="65" background="img/bgs/menu_64.jpg" align="center"><a href="#" class="menu">Utilit�rios</a></td>
			<td width="55" background="img/bgs/menu_54.jpg" align="center"><a href="#" class="menu">Ajuda</a></td>
			<td width="54" background="img/bgs/menu_54.jpg" align="center"><a href="#" class="menu">Alternar</a></td>
		  </tr>
		</table>
		</td>
-->    <td class="bg_cinza02">&nbsp;</td>
  </tr>
</table>
<form name="form" method="get" action="pesq_avaliacoes_pendentes.php?Categoria=<?=$_GET['Categoria']?>">

<table>
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Avalia&ccedil;&otilde;es pendentes - <?=$Texto?></h4></td>
      </tr>
    </table>  
    <table width="100%"  border="0" class="tab_inclusao">
      <tr>
        <td width="18%" class=""><div align="left"><strong>Per&iacute;odo de pesquisa: </strong></div></td>
        <td width="29%" class=""><strong>de <input name="DT_INICIAL" type="text" class="form" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_INICIAL']?>" size="9" maxlength="10"> a 
        <input name="DT_FINAL" type="text" class="form" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DT_FINAL']?>" size="9" maxlength="10">
        </strong></td>
        <td width="26%" valign="middle" class="">
            <?php if ($Categoria != "1"){ ?>
            <strong>Categoria:</strong>
            <select name="LANCA_CATEGORIA" class="form" id="LANCA_CATEGORIA" >
                <option value="">...Selecione</option>
                <option value="1" <? if ($_GET['LANCA_CATEGORIA'] == "1"){?> selected <? }?>>Cal&ccedil;ados</option>
                <option value="2" <? if ($_GET['LANCA_CATEGORIA'] == "2"){?> selected <? }?>>Sand&aacute;lias</option>
                <option value="3" <? if ($_GET['LANCA_CATEGORIA'] == "3"){?> selected <? }?>>Botas</option>
                <option value="4" <? if ($_GET['LANCA_CATEGORIA'] == "4"){?> selected <? }?>>Tamancos</option>
                <option value="5" <? if ($_GET['LANCA_CATEGORIA'] == "5"){?> selected <? }?>>Bolsas</option>
                <option value="6" <? if ($_GET['LANCA_CATEGORIA'] == "6"){?> selected <? }?>>Cintos</option>
                <option value="7" <? if ($_GET['LANCA_CATEGORIA'] == "7"){?> selected <? }?>>Carteiras</option>
                <option value="8" <? if ($_GET['LANCA_CATEGORIA'] == "8"){?> selected <? }?>>Acess&oacute;rios</option>
            </select>
            <? } ?>
        </td>
        <td width="26%" valign="middle" class="">
            <strong>Status:</strong>
            <select name="AVALI_SITUACAO" class="form" id="AVALI_SITUACAO" >
                <option value="">...Selecione</option>
                <option value="" <? if ($_GET['AVALI_SITUACAO'] == ""){?> selected <? }?>>Todos</option>
                <option value="E" <? if ($_GET['AVALI_SITUACAO'] == "E"){?> selected <? }?>>Em an�lise</option>
                <option value="F" <? if ($_GET['AVALI_SITUACAO'] == "F"){?> selected <? }?>>Avaliado Fabricante</option>
            </select>
        </td>
        <td width="27%" valign="middle" class=""><a href="javascript:FilterSearch();"><img src="imagens/pesquisar.jpg" name="Image34" width="59" height="22" border="0" align="middle"></a></td>
      </tr>
      <tr>
      <td colspan="5"> <div align="center">
       <table width="100%" cellpadding="0" cellspacing="0" class="display" id="tableAvaliacoesPendentes">
          <thead>
            <tr>
              <td align="center"></td>
              <td align="center">Categoria</td>
              <td align="center">N&ordm; RAR</td>
              <td align="center">N&ordm; An&aacute;lise</td>
              <td align="center">Data Abertura</td>
              <td align="center">Data Avalia&ccedil;&atilde;o</td>
              <td align="center">Qtde Produtos </td>
              <td align="center">Status</td>
              <td align="left">Cliente</td>
              <td>Fabricante</td>
            </tr>
          </thead>
          <tbody>
<?php 

	$Sql = "SELECT DS_RESUMIDA_ITEM DESCRICAO,I.ITEM_QTDE, A.AVALI_SITUACAO, L.LANCA_CATEGORIA, L.LANCA_NUMRAR, L.LANCA_NBLOCO_ANALISE, date_format(L.lanca_dataabertura,'%d/%m/%Y') AS DATA,F.NOME As FABRICA,P.PESSOA,P.NOME, date_format(A.AVALI_AREZ_DATA,'%d/%m/%Y') AS DATA_AVALIACAO ".
	       " FROM pessoa P, rar_lancamento L, pessoa F, rar_avaliacao A, rar_usuarioxcliente UC, rar_item I, item_material IM ".
               " WHERE L.LANCA_FABRI_IDO = F.PESSOA ".
               "       AND L.lanca_pessoa = P.PESSOA ".
               "       AND L.LANCA_NUMRAR = I.ITEM_NUMRAR ".
               "       AND (A.avali_numrar = L.lanca_numrar or A.avali_numrar is null) ".
               "       AND LANCA_STATUS = '1' ".
               "       AND UC.USUCLI_PESSOA = L.LANCA_PESSOA ".
               "       AND I.item_REFERENCIA = IM.cd_item_material".
               "       AND UC.USUCLI_USUAR_IDO = '" .$_SESSION['sId']. "'";
	if (trim($_GET['LANCA_CATEGORIA'])) {
            $Sql.= "AND L.LANCA_CATEGORIA = '" .$_GET['LANCA_CATEGORIA']. "' ";
	}
	if (trim($_GET['AVALI_SITUACAO'])) {
            $Sql.= "AND AVALI_SITUACAO = '" .$_GET['AVALI_SITUACAO']. "' ";
	}
	if ($_SESSION['Menu'] == "3"){
            $Sql.= " AND LANCA_NUMRAR LIKE 'M%'";
	}else{
            $Sql.= " AND LANCA_NUMRAR NOT LIKE 'M%'";
	}	
	if (trim($_GET['DT_INICIAL']) && trim($_GET['DT_FINAL']))
            $Sql.= "AND L.LANCA_DATAABERTURA BETWEEN '" . strdata2db($_GET['DT_INICIAL']). "' AND '" . strdata2db($_GET['DT_FINAL']). "' ";
	//$Sql.= " ORDER BY LANCA_DATAABERTURA, LANCA_NUMRAR";
    //echo($Sql);
    $Stmt = mysql_query($Sql);
    $TotalReclamacao = 0;
    $TotalPares = 0;
    while ($row = mysql_fetch_array($Stmt)){
        $TotalReclamacao = $TotalReclamacao + 1;
        $TotalPares = $TotalPares + (int)$row["ITEM_QTDE"];		
     ?>
      <tr>
          <td align="center"><a onClick="abrir_janela_popup('email_avaliacoes_realizadas.php?Referencia=<?=$row["LANCA_NUMRAR"]?>','prenota','width=400,height=400,top=0,left=0, scrollbars=no,status=no,resizable=no,dependent=yes')" href="#"><img src="imagens/email.gif" alt="Encaminhar reclama&ccedil;&atilde;o para agenciador" width="20" height="20" border="0"></a></td>
          <td align="left"><?=$row["DESCRICAO"]?></td>
          <td align="center"><?=$row["LANCA_NUMRAR"]?></td>
          <td align="center"><?=$row["LANCA_NBLOCO_ANALISE"]?></td>
          <td align="center"><?=trim($row["DATA"])?></td>
          <td align="center"><?=$row["DATA_AVALIACAO"] ?></td>
          <td align="center"><?=$row["ITEM_QTDE"]?></td>
          <td align="center"><img src="imagens/<?=((trim(situacao($row["AVALI_SITUACAO"]))) ? "" .strtolower(situacao($row["AVALI_SITUACAO"])) : "naoavaliado")?>.gif" width="15" height="15"></td>
          <td align="left"><?=$row["PESSOA"]?> - <?=$row["NOME"]?></td>
          <td align="center"><?=$row["FABRICA"]?></td>
      </tr>
    <?php 
    }
    ?>
          </tbody>
      </table>

          <table width="100%"  border="0" align="center" class="">

            

            <tr>

              <td width="20%"><div align="center"> </td>

              <td width="20%"><div align="right"></td>

              <td width="60%"><div align="center" class="tab_conteudo">

                  <div align="right"><strong class="">Resumo da pesquisa</strong>: Total de reclama&ccedil;&otilde;es:

                      <?=$TotalReclamacao?>

&nbsp;- Total de pares:

          <?=$TotalPares?>

                  </div>

                </div>

                  <div align="center" class="style1">

                    <div align="right"></div>

                </td>

            </tr>

          </table>

          <table width="100%"  border="0">

            <tr class="">

              <td width="10%" class=""><strong>Legenda:</strong></td>

              <td class=""><div align="center"><img src="imagens/procedente.gif" width="13" height="14"></td>

              <td class=""><strong>Avalia&ccedil;&otilde;es procedentes </strong></td>

              <td width="" class=""><div align="center"><img src="imagens/improcedente.gif" width="15" height="15"></td>

              <td class=""><strong>Avalia&ccedil;&otilde;es improcedentes </strong></td>

              <td width="" class=""><div align="center"><img src="imagens/emanalise.gif" width="13" height="14"></td>

              <td class=""><strong>Avalia&ccedil;&otilde;es em an&aacute;lise </strong></td>
			  
			  <td width="" class=""><div align="center"><img src="imagens/conserto.gif" width="13" height="14"></td>

              <td class=""><strong>Avalia&ccedil;&otilde;es em conserto </strong></td>

              <td align="center"><img src="imagens/fabrica.gif" width="16" height="16"></td>
              <td><strong>Avaliado fabricante </strong></td>
            </tr>

			<tr>

                <td colspan="11">

					<div align="left" class="">

						<br />

						P&aacute;ginas:&nbsp;<?= $_pagi_navegacion ?>
					</div>				</td>
              </tr>
          </table>

          <br>

          </td>

        </tr>

    </table>

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
<script type="text/javascript" src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//jquery-datatables-column-filter.googlecode.com/svn/trunk/media/js/jquery.dataTables.columnFilter.js"></script>
<script type="text/javascript" src="js/util.js"></script>
<script type="text/javascript" src="menu/milonic_src.js"></script>
<script type="text/javascript">

    if(ns4)_d.write("<scr"+"ipt type=text/javascript src=menu/mmenuns4.js><\/scr"+"ipt>");		

      else _d.write("<scr"+"ipt type=text/javascript src=menu/mmenudom.js><\/scr"+"ipt>"); 

    function deleteById(sPage,FormID) {

            var Ids = "";

            if(confirm("Confirma a exclus�o do(s) registro(s)?")==true){

                    if (FormID) {

                            if(isArray(FormID)){

                                    if (FormID.length == undefined) {

                                            if (FormID.checked)

                                                    Ids = "'" + escape(FormID.value) + "'";

                                    }else{

                                            for(x = 0; x < FormID.length; x++) {

                                                    if (FormID[x].checked) 

                                                            Ids+= ((Ids.length == 0) ? "" : ",") + "'" + escape(FormID[x].value) + "'";

                                            }

                                    }

                            }else if (FormID.length > 0){

                                    Ids = FormID;

                            }

                    }

                    if (Ids == "")

                            alert("Deve haver pelo menos um item selecionado !");

                    else{

                            document.location.href = sPage + ((sPage.indexOf("?") == -1) ? "?" : "&") + "IdDel=" + Ids;

                    }

            }

    }



    function cancelOperation(pageDest) {

            if(confirm("Tem certeza que deseja cancelar a operacao ?"))

                    document.location.href = pageDest;

    }

</script>
<script type="text/javascript" src="menu/menu_data.php"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
        "customdatesort-pre": function(a) {
        // returns the "weight" of a cell value
        var r, x;
        if (a === null || a === "") {
          // for empty cells: weight is a "special" value which needs special handling
          r = false;
        } else {
          // otherwise: weight is the "time value" of the date
          x = a.split("/");
          r = +new Date(+x[2], +x[1] - 1, +x[0]);
        }
        //console.log("[PRECALC] " + a + " becomes " + r);
        return r;
      },
      "customdatesort-asc": function(a, b) {
        // return values are explained in Array.prototype.sort documentation
        if (a === false && b === false) {
          // if both are empty cells then order does not matter
          return 0;
        } else if (a === false) {
          // if a is an empty cell then consider a greater than b
          return 1;
        } else if (b === false) {
          // if b is an empty cell then consider a less than b
          return -1;
        } else {
          // common sense
          return a - b;
        }
      },
      "customdatesort-desc": function(a, b) {
        if (a === false && b === false) {
          return 0;
        } else if (a === false) {
          return 1;
        } else if (b === false) {
          return -1;
        } else {
          return b - a;
        }
      }
    });


    $('#tableAvaliacoesPendentes').dataTable({
        stateSave: true,
        "aoColumnDefs": [{  
            "sType": "customdatesort" , "aTargets": [4, 5]}]
    });
});
function FilterSearch() {

	/*if (document.form.DT_INICIAL.value == "" || document.form.DT_FINAL.value == "") {

		alert("Preencha os campos data final e inicial");

		return;

	}*/

	if (!JSUtilValidaData(document.form.DT_INICIAL.value,false) || !JSUtilValidaData(document.form.DT_FINAL.value,false)) {

		alert("As datas informadas devem ser datas v�lidas !");

		return;

	}

	document.form.submit();

}

</script>

<script type="text/javascript">

    function abrir_janela_popup(theURL,winName,features) { //v2.0

    window.open(theURL,winName,features);

    }



    function abrir_help(theURL,winName,features) { //v2.0

            theURL = 'help/assistenteconteudo.htm'+theURL;

            window.open(theURL,'help','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=no');

            }



    function MM_preloadImages() { //v3.0

      var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

        var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

        if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

    }



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

</script>
</body></html>