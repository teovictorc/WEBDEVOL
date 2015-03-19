<?php
include("inc/headerI.inc.php");
include("pdo/Db.class.php");
include("pdo/easyCRUD/LogAvaliacoes.class.php");

verifyAcess("ARZ_AVALIPENDENTE","S");
$Sql = "SELECT round(I.item_valor,2) ITEM_VALOR,
       L.*,
       F.NOME AS FABRICA,
       I.ITEM_NUM33,
       I.ITEM_NUM34,
       I.ITEM_NUM35,
       I.ITEM_NUM36,
       I.ITEM_NUM37,
       I.ITEM_NUM38,
       I.ITEM_NUM39,
       I.ITEM_NUM40,
       I.ITEM_REFERENCIA,
       I.ITEM_COLECAO,
       I.ITEM_NF,
       I.ITEM_PAR,
       I.ITEM_QTDE,
       I.ITEM_FOTOPROD,
       I.ITEM_FOTOSOLA,
       I.ITEM_FOTODEFEITO,
       date_format(I.item_data,'%d/%m/%Y') AS DATA ,
       P.PESSOA,
       P.NOME,
       P.LOGRADOURO,
       P.BAIRRO,
       P.NM_MUNICIPIO,
       DS_RESUMIDA_ITEM DESCRICAO,
       datediff(L.lanca_dataabertura,I.item_data) DIAS,
       P.SG_UF
FROM pessoa P,
     rar_lancamento L,
     pessoa F,
     rar_item I,
     item_material IM
WHERE L.LANCA_FABRI_IDO = F.PESSOA
  AND L.lanca_pessoa = P.PESSOA
  AND I.item_numrar = L.lanca_numrar
  AND I.item_REFERENCIA = IM.cd_item_material
  AND L.LANCA_NUMRAR = '{$_GET['Id']}'";
// die($Sql);
$Stmt = mysql_query($Sql);
if (!$Rs = mysql_fetch_assoc($Stmt)){
  die("<script>document.location.href = 'pesq_avaliacoes_pendentes.php';</script>");
}else{
  $Descricao = $Rs["DESCRICAO"];
  if ($Rs["LANCA_CATEGORIA"] == "1"){
    $Categoria = "sapato.jpg";
//$Descricao = "Calçado";
    $Foto1 =  "Foto do produto";
    $Foto2 =  "Foto da sola";
    $Foto3 =  "Foto do defeito";
  }elseif ($Rs["LANCA_CATEGORIA"] == "2"){
    $Categoria = "bolsa.jpg";
//$Descricao = "Bolsa";
    $Foto1 =  "Foto do produto - frente";
    $Foto2 =  "Foto do produto - verso";
    $Foto3 =  "Foto do defeito";
  }elseif ($Rs["LANCA_CATEGORIA"] == "3"){
    $Categoria = "cinto.jpg";
//$Descricao = "Cinto";
    $Foto1 =  "Foto do produto - frente";
    $Foto2 =  "Foto do produto - verso";
    $Foto3 =  "Foto do defeito";
  }elseif ($Rs["LANCA_CATEGORIA"] == "4"){
    $Categoria = "carteira.jpg";
//$Descricao = "Carteira";
    $Foto1 =  "Foto do produto - frente";
    $Foto2 =  "Foto do produto - verso";
    $Foto3 =  "Foto do defeito";
  }
  $Tempo = intval($Rs["DIAS"]);
  $Meses = $Rs["DIAS"]/30;
  $Dias = ($Meses - intval($Meses)) * 30;
  $Meses = intval($Meses);
  $Tempo = $Meses." meses e ".$Dias." dias";
  $Rar = $_GET['Id'];
}
?>
<script>
<!--
function atualiza(Grupo,Subg) {
parent.subgrupo.document.location.href = 'monta_subgrupo.php?Grupo=' + Grupo ;
}
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
    function MM_swapImage() { //v3.0
    var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
    if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
    }
    //-->
    </script>
    <link href="wfa.css" rel="stylesheet" type="text/css">
    <body onLoad="MM_preloadImages('imagens/cancelar2.jpg','imagens/imprimir2.jpg')">
        <table class="tab_conteudo">
          <tr>
            <td height="100%" valign="top" class="tab_conteudo">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="32" class="tab_titulo"><h4>Avalia&ccedil;&atilde;o de reclama&ccedil;&atilde;o</h4></td>
                </tr>
              </table>
              <form name="form" method="post" action="">
                <input type="hidden" name="ID" value="<?=$_GET['Id']?>">
                <input name="DT_INICIAL" type="hidden" id="DT_INICIAL" value="<?=$_GET['DT_INICIAL']?>">
                <input name="DT_FINAL" type="hidden" id="DT_FINAL" value="<?=$_GET['DT_FINAL']?>">
              <table width="100%"  border="0" class="tab_inclusao">
                <tr>
                  <td height="10" class=""><strong>Reclama&ccedil;&atilde;o</strong></td>
                  <td height="10"><span class="">
                    <input name="numrar" type="text" disabled class="form" id="numrar"  value="<?=$Rs['LANCA_NUMRAR']?>" size="12" maxlength="11">
                  </span></td>
                  <td height="10" class=""><strong>Tempo</strong></td>
                  <td width="34" height="10" colspan="2" class="" ><span class="">
                    <input name="numrar2" type="text" disabled class="form" id="numrar2"  value="<?=$Tempo?>" size="20" maxlength="20">
                  </span></td>
                </tr>
                <tr>
                  <td width="17%" height="10" class=""><strong>C&oacute;digo</strong></td>
                  <td width="35%" height="10"><span class="">
                    <input name="textfield52225" type="text" disabled class="form"  value="<?=$Rs['PESSOA']?>" size="5" maxlength="5">
                  </span></td>
                  <td width="11%" height="10"><strong>Categoria</strong></td>
                  <!--<td width="34" height="10" valign="middle" class=""><img src="imagens/<?=$Categoria?>" width="60" height="45"> </td>-->
                  <td width="27%" valign="middle" class=""><input name="textfield522252" type="text" disabled class="form"  value="<?=$Descricao?>" size="50" maxlength="50"></td>
                </tr>
                <tr>
                  <td height="10" class=""><strong>Nome do cliente </strong></td>
                  <td height="10" colspan="4" class="style1"><input name="textfield5" type="text" disabled class="form"  value="<?=$Rs['NOME']?>" size="50" maxlength="50"></td>
                </tr>
                <tr>
                  <td height="10" class=""><strong>Endere&ccedil;o</strong></td>
                  <td height="10" class=""><input name="textfield52" type="text" disabled class="form"  value="<?=$Rs['LOGRADOURO']?>" size="50" maxlength="50"></td>
                  <td height="10" class=""><strong>Bairro</strong></td>
                  <td height="10" colspan="2" class=""><input name="textfield5222" type="text" disabled class="form"  value="<?=$Rs['BAIRRO']?>" size="20" maxlength="50"></td>
                </tr>
                <tr>
                  <td height="10" class=""><strong>Cidade</strong></td>
                  <td height="10" class=""><input name="textfield522" type="text" disabled class="form"  value="<?=$Rs['NM_MUNICIPIO']?>" size="50" maxlength="50"></td>
                  <td height="10"><strong class="">UF</strong></td>
                  <td height="10" colspan="2" class=""><input name="textfield52222" type="text" disabled class="form"  value="<?=$Rs['SG_UF']?>" size="5" maxlength="5"></td>
                </tr>
                <tr>
                  <td height="10" class=""><strong>Solicitante</strong></td>
                  <td height="10" colspan="4"><span class="">
                    <input name="textfield5224" type="text" disabled class="form"  value="<?=$Rs['LANCA_SOLICITANTE']?>" size="50" maxlength="50">
                  </span></td>
                </tr>
                <tr>
                  <td height="10" class=""><strong>Fabricante</strong></td>
                  <td height="10" colspan="4"><span class="">
                    <input name="textfield5223" type="text" disabled class="form"  value="<?=$Rs['FABRICA']?>" size="50" maxlength="50">
                  </span></td>
                </tr>
                <tr>
                  <td height="10" class=""><strong>Motivo da solicita&ccedil;&atilde;o </strong></td>
                  <td height="10" colspan="4"><textarea name="textarea" cols="100%" rows="5" disabled class="style2"><?=$Rs['LANCA_MOTIVO']?></textarea></td>
                </tr>
                <tr bgcolor="#FFFFFF" class="">
                  <td colspan="5" class="tab_titulo" style="padding-top:10px;"><strong>Dados do consumidor </strong></td>
                </tr>
                <tr>
                  <td height="10" class=""><strong>Nome: </strong></td>
                  <td height="10"><input name="LANCA_CLIENTE_NOME" type="text" disabled class="form" id="LANCA_CLIENTE_NOME" value="<?=$Rs['LANCA_CLIENTE_NOME']?>" size="50" maxlength="50"></td>
                  <td height="10" class=""><strong>Fone: </strong></td>
                  <td height="10" colspan="2"><input name="LANCA_CLIENTE_FONE" type="text" disabled class="form" id="LANCA_CLIENTE_FONE" value="<?=$Rs['LANCA_CLIENTE_FONE']?>" size="30" maxlength="30"></td>
                </tr>
                <tr>
                  <td height="10" class=""><strong>Tipo reclama&ccedil;&atilde;o: </strong></td>
                  <td height="10" class="">
                    <?if($Rs['LANCA_TIPORECLAMACAO'] == "C"){?>
                    <input name="LANCA_TIPORECLAMACAO" type="radio" value="C" checked disabled>
                    <?}else{?>
                    <input name="LANCA_TIPORECLAMACAO" type="radio" value="C" disabled>
                    <?}?> Defeito consumidor
                    <?if($Rs['LANCA_TIPORECLAMACAO'] == "L"){?>
                    <input name="LANCA_TIPORECLAMACAO" type="radio" value="L" checked disabled>
                    <?}else{?>
                    <input name="LANCA_TIPORECLAMACAO" type="radio" value="L" disabled>
                  <?}?>  Defeito loja </td>
                  <td height="10" class="style2">&nbsp;</td>
                  <td height="10" colspan="2">&nbsp;</td>
                </tr>
                <tr bgcolor="#FFFFFF" class="">
                  <td colspan="5" class="tab_titulo" style="padding-top:10px;"><strong>Descri&ccedil;&atilde;o do &iacute;tem com problema </strong></td>
                </tr>
                <tr>
                  <td height="15" class=""><strong>N<sup>o</sup> do Bloco de An&aacute;lise</strong></td>
                  <td height="15" class=""><span class="">
                    <input name="NUM_BLOCO_ANALISE" type="text" disabled class="form"  value="<?=$Rs['LANCA_NBLOCO_ANALISE']?>" size="30" maxlength="50">
                  </span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td height="15" class=""><strong>Refer&ecirc;ncia</strong></td>
                  <td height="15" class=""><span class="">
                    <input name="textfield522232" type="text" disabled class="form"  value="<?=$Rs['ITEM_REFERENCIA']?>" size="30" maxlength="50">
                  </span></td>
                  <td height="15" class=""><strong>Cole&ccedil;&atilde;o</strong></td>
                  <td height="15" colspan="2" class=""><span class="">
                    <input name="textfield52223" type="text" disabled class="form"  value="<?=$Rs['ITEM_COLECAO']?>" size="30" maxlength="50">
                  </span></td>
                </tr>
                <tr>
                  <td height="15" class="">Descri&ccedil;&atilde;o do produto</td>
                  <td height="15" colspan="4"><span class=""><span class="">
                    <input name="textfield5222323" type="text" disabled class="form"  value="<?=$Rs['DESCRICAO']?>" size="110" maxlength="110">
                  </span></span></td>
                </tr>
                <tr>
                  <td height="15" class=""><strong>N. NF origem </strong></td>
                  <td height="15"><span class=""><span class="">
                    <input name="textfield5222322" type="text" disabled class="form"  value="<?=$Rs['ITEM_NF']?>" size="6" maxlength="6">
                  </span></span></td>
                  <td height="15"><strong class="">Data NF</strong></td>
                  <td height="15" colspan="2"><span class="">
                    <input name="textfield52224" type="text" disabled class="form"  value="<?=$Rs['DATA']?>" size="20" maxlength="50">
                  </span></td>
                </tr>
                <tr>
                  <td height="15" class=""><strong><strong>Quantidade</strong></strong></td>
                  <td height="15"><span class=""><span class="">         <input name="ITEM_QTDE" type="text" disabled class="form" id="ITEM_QTDE"  value="<?=$Rs['ITEM_QTDE']?>" size="6" maxlength="6">
                </span></span></td>
                <td height="15" colspan="3" class=""><span class=""><span class="">
                  <input type="hidden" name="Categoria" value="<?=$Rs['LANCA_CATEGORIA']?>">
                  <?
                  if ($Rs['LANCA_CATEGORIA'] == "1"){
                  ?>
                </span></span>
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
                    <td align="center"><input name="ITEM_NUM33" type="text" disabled class="form" id="ITEM_NUM33" value="<?=$Rs['ITEM_NUM33']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>
                    <td align="center"><input name="ITEM_NUM34" type="text" disabled class="form" id="ITEM_NUM34" value="<?=$Rs['ITEM_NUM34']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>
                    <td align="center"><input name="ITEM_NUM35" type="text" disabled class="form" id="ITEM_NUM35" value="<?=$Rs['ITEM_NUM35']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>
                    <td align="center"><input name="ITEM_NUM36" type="text" disabled class="form" id="ITEM_NUM36" value="<?=$Rs['ITEM_NUM36']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>
                    <td align="center"><input name="ITEM_NUM37" type="text" disabled class="form" id="ITEM_NUM37" value="<?=$Rs['ITEM_NUM37']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>
                    <td align="center"><input name="ITEM_NUM38" type="text" disabled class="form" id="ITEM_NUM38" value="<?=$Rs['ITEM_NUM38']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>
                    <td align="center"><input name="ITEM_NUM39" type="text" disabled class="form" id="ITEM_NUM39" value="<?=$Rs['ITEM_NUM39']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>
                    <td align="center"><input name="ITEM_NUM40" type="text" disabled class="form" id="ITEM_NUM40" value="<?=$Rs['ITEM_NUM40']?>" size="3" maxlength="3" onChange="SomaQtde();"></td>
                  </tr>
                </table>
                <? } ?>
                <span class="style2"><span class="style1">
                </span></span></td>
              </tr>
              <tr>
                <td height="15" class=""><strong>Valor unit&aacute;rio </strong></td>
                <td height="15"><span class="">
                  <input name="ITEM_VALOR_UNITARIO" type="text" disabled class="form" id="ITEM_VALOR_UNITARIO"  value="R$ <?=$Rs['ITEM_VALOR']?>" size="20" maxlength="20">
                </span></td>
                <td height="15"><strong class="">Valor total </strong></td>
                <td height="15" colspan="2"><span class="">
                  <input name="ITEM_VALOR_TOTAL" type="text" disabled class="form" id="ITEM_VALOR_TOTAL" size="20" maxlength="20">
                </span></td>
              </tr>
              <tr>
                <td colspan="5" class=""><div align="center">
                </div></td>
              </tr>
              <tr>
                <td colspan="5" class=""><table width="100%"  border="0">
                  <tr>
                    <td width="32%"><table width="99%"  border="0">
                      <tr class="">
                        <? if ($Rs['LANCA_CATEGORIA'] <> "1"){
                        $texto1="Foto do produto - frente";
                        $texto2="Foto do produto - verso";
                        $texto3="Foto do defeito";
                        } else{
                        $texto1="Foto do Produto";
                        $texto2="Foto Sola";
                        $texto3="Foto do Defeito";
                        }?>
                        <td class=""><strong><? echo $texto1;?></strong></td>
                      </tr>
                      <tr>
                        <td><div align="center"><a onClick="abrir_janela_popup('visualizar_foto.php?path=<?=$Rs['ITEM_FOTOPROD']?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" ><img src="fotos/<?=$Rs['ITEM_FOTOPROD']?>" width="180" height="150" border="0" ></a></div></td>
                      </tr>
                    </table></td>
                    <td width="35%"><table width="99%"  border="0">
                      <tr class="">
                        <td class=""><strong><? echo $texto2;?></strong></td>
                      </tr>
                      <tr>
                        <td><div align="center"><a onClick="abrir_janela_popup('visualizar_foto.php?path=<?=$Rs['ITEM_FOTOSOLA']?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" ><img src="fotos/<?=$Rs['ITEM_FOTOSOLA']?>" width="180" height="150" border="0" ></a></div></td>
                      </tr>
                    </table></td>
                    <td width="33%"><table width="99%"  border="0">
                      <tr class="">
                        <td class=""><strong><? echo $texto3;?></strong></td>
                      </tr>
                      <tr>
                        <td><div align="center"><a onClick="abrir_janela_popup('visualizar_foto.php?path=<?=$Rs['ITEM_FOTODEFEITO']?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" ><img src="fotos/<?=$Rs['ITEM_FOTODEFEITO']?>" width="180" height="150" border="0"></a></div></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr class="">
                    <td ><div align="center">Clique sobre a foto para ampliar</div></td>
                    <td ><div align="center">Clique sobre a foto para ampliar</div></td>
                    <td ><div align="center">Clique sobre a foto para ampliar</div></td>
                  </tr>
                </table>         </td>
              </tr>
            </table>
            <table width="10%" border="0" class="tab_inclusao">
              <tr>
                <td colspan="5">
                  <table width="100%"  border="0">
                    <tr class="">
                      <td colspan="4" class="tab_titulo" style="padding-top:10px;"><strong>Avalia&ccedil;&atilde;o t&eacute;cnica</strong></td>
                    </tr>
                    <tr class="">
                      <td width="100%" class="style2"><strong>Defeito encontrado</strong></td>
                      <td colspan="3" class="style2">
                        <select name="AVALI_AREZ_DEFEIG_IDO" class="form" id="AVALI_AREZ_DEFEIG_IDO" onChange="atualiza(this.value)">
                          <option value="">..Selecione Grupo</option>
                          <?
                          $Sql = " SELECT * ";
                          $Sql.= " FROM rar_defeito_grupo ";
                          //$Sql.= " WHERE DEFEIG_CATEGORIA = '".$Rs["LANCA_CATEGORIA"]."'";
                          $Sql.= " ORDER BY DEFEIG_DESCRICAO";
                          $Stmt = mysql_query($Sql);
                          while($Rs = mysql_fetch_assoc($Stmt)) {  ?>
                          <option value="<?=$Rs["DEFEIG_IDO"]?>"<?=(($AVALI_AREZ_DEFEIG_IDO == $Rs["DEFEIG_IDO"]) ? " Selected" : "")?>><?=$Rs["DEFEIG_DESCRICAO"]?></option>
                          <? } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td colspan="3">
                        <? //Esse iframe existe para carregar o combo funcionários ?>
                        <iframe name="subgrupo" scrolling="no" frameborder="0" width="0" height="0" src=""></iframe>
                        <select name="AVALI_AREZ_DEFEIS_IDO" class="form" id="AVALI_AREZ_DEFEIS_IDO">
                          <option value="">..Selecione Subgrupo</option>
                          <?
                          if ($AVALI_AREZ_DEFEIG_IDO != ""){
                          $Sql = " SELECT *";
                          $Sql.= " FROM rar_defeito_subgrupo ";
                          $Sql.= " WHERE DEFEIS_DEFEIG_IDO = '".$AVALI_AREZ_DEFEIG_IDO."'";
                          $Sql.= " ORDER BY DEFEIS_DESCRICAO";
                          $Stmt = mysql_query($Sql);
                          while($Rs = mysql_fetch_assoc($Stmt)) {  ?>
                          <option value="<?=$Rs["DEFEIS_IDO"]?>"<?=(($AVALI_AREZ_DEFEIS_IDO == $Rs["DEFEIS_IDO"]) ? " Selected" : "")?>><?=$Rs["DEFEIS_DESCRICAO"]?></option>
                          <? }
                          } ?>
                        </select>
                      </td>
                    </tr>
                    <tr class="">
                      <td class=""><strong>Detalhamento</strong></td>
                      <td colspan="3" class=""><span class="">
                        <textarea name="AVALI_AREZ_DETALHE" cols="100%" rows="5" class="style2" id="AVALI_AREZ_DETALHE"><?=$AVALI_AREZ_DETALHE?></textarea>
                      </span></td>
                    </tr>
                    <tr class="">
                      <td class=""><strong>Data avalia&ccedil;&atilde;o </strong></td>
                      <td width="19%" class=""><span class="">
                        <input name="AVALI_AREZ_DATA" value="<?=$AVALI_AREZ_DATA?>" type="text" class="form" id="AVALI_AREZ_DATA" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" size="10" maxlength="50">
                      </span></td>
                      <td width="20%" class=""><strong>Avalia&ccedil;&atilde;o encerrada </strong></td>
                      <td width="42%" class=""><input name="AVALI_AREZ_ENCERRADO" type="checkbox" id="AVALI_AREZ_ENCERRADO" value="S" <?=(($AVALI_AREZ_ENCERRADO == "S") ? "checked" : "")?> onClick="updateDateNow(this,'AVALI_AREZ_DATA');"></td>
                    </tr>
                    <tr class="">
                      <td class=""><strong>Respons&aacute;vel</strong></td>
                      <td colspan="3" class=""><span class="">
                        <input name="textfield52242" type="text" disabled class="form"  value="<?=$USUARIO?>" size="50" maxlength="50">
                      </span></td>
                    </tr>
                    <tr class="tab_titulo">
                      <td colspan="4" class=""><strong>Situa&ccedil;&atilde;o da reclama&ccedil;&atilde;o </strong></td>
                    </tr>
                    <tr class="">
                      <td colspan="4" class=""><input name="AVALI_SITUACAO" type="radio" value="P" <?=(($AVALI_SITUACAO == "P") ? "checked" : "")?> onClick="updateAvaliacaoByProcedente(true);">
                      Procedente
                      <input name="AVALI_SITUACAO" type="radio" value="I" <?=(($AVALI_SITUACAO == "I") ? "checked" : "")?> onClick="updateAvaliacaoByProcedente(true);">
                      Improcedente
                      <input name="AVALI_SITUACAO" type="radio" value="E" <?=(($AVALI_SITUACAO == "E") ? "checked" : "")?> onClick="updateAvaliacaoByProcedente(false);">
                      Em an&aacute;lise
                      <input name="AVALI_SITUACAO" type="radio" value="C" <?=(($AVALI_SITUACAO == "C") ? "checked" : "")?> onClick="updateAvaliacaoByProcedente(false);">
                      Conserto
                      <input name="AVALI_SITUACAO" type="radio" value="F" <?=(($AVALI_SITUACAO == "F") ? "checked" : "")?> onClick="updateAvaliacaoByProcedente(false);">
                    Avaliado fabricante </td>
                  </tr>
                  <!--
                  <tr class="tabela">
                    <td class="style2"><strong>Status da reclama&ccedil;&atilde;o </strong></td>
                    <td colspan="3" class="style2"><span class="style1">
                      <select name="LANCA_STATUS" class="campo_texto" onChange="updateAvaliacao()">
                        <option value="">...Selecione</option>
                        <option value="1"<?=(($LANCA_STATUS == "1") ? " selected" : "")?>>Em andamento</option>
                        <option value="3"<?=(($LANCA_STATUS == "3") ? " selected" : "")?>>Encerrada</option>
                      </select>
                    </span></td>
                  </tr>
                  //-->
                </table></td>
              </tr>
              <tr>
                <td colspan="5">
                    <div align="center">
                      <a href="javascript:verificaForm(document.form,'N');">
                      <img src="../img/bts/gravar.jpg" name="Image351" width="52" height="22" border="0" id="Image351"></a>
                      <a href="javascript:verificaForm(document.form,'S');">
                      <img src="imagens/gravar_avancar.jpg" name="Image352" width="98" height="22" border="0" id="Image352" /></a>
                      <a href="javascript:voltar();"><img src="../img/bts/cancelar.jpg" name="Image361" border="0" id="Image361"></a>
                      <a onClick="abrir_janela_popup('imp_reclamacao.php?Id=<?=$Rar?>','foto','width=780,height=480,top=0,left=0, scrollbars=yes,status=yes,resizable=no,dependent=yes')" href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3611','','imagens/imprimir2.jpg',1)"><img src="imagens/imprimir.jpg" name="Image3611" width="52" height="22" border="0" id="Image361"></a><a onClick="abrir_janela_popup('email_avaliacoes_realizadas.php?Referencia=<?=$Rar?>','prenota','width=500,height=450,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes')" href="#"><img src="imagens/enviar.jpg" alt="Encaminhar reclama&ccedil;&atilde;o para agenciador" width="52" height="22" border="0"></a>
                    </div>
                </td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </form>
<!-- Log de Mudanças -->
          <form action="saveLogMudancas.php" method="post" name="formLogMudancas" id="formLogMudancas">
            <input type="hidden" name="situacao" value="<?=$AVALI_SITUACAO?>" />
            <input type="hidden" name="num_rar" value="<?=$_GET['Id']?>" />
            <table class="tab_inclusao" style="width:100%">
              <tr>
                <td>
                  <table style="width: 100%;">
                    <tr>
                      <td colspan="2" style="width:25%" class="tab_titulo"><strong>Log de Mudan&ccedil;as</strong></td>
                      <td colspan="2"><a href="acionarFabrica.php" id="acionarFabrica">Acionar Fábrica</a></td>
                      <td colspan="2"><a href="notificarFuncionarios.php" id="notificarFuncionarios">Notificar Funcionários</a></td>
                    </tr>
                    <tr>
                      <td colspan="5">
                        <table>
                          <?php
                            $log = new LogAvaliacoes();
                            $logs = $log->findByNumRar($_GET['Id']);
                            $count_acessos = 0;
                            foreach ($logs as $key => $value):
                          ?>
                            <tr style="border-bottom:1px solid gray !important; border-top:1px solid gray !important; color: #333;<?php echo ($value['type'] == 1) ? "background-color:#F2DEDE":"" ?>">
                              <td width="25%"><h5><?=$value['USUAR_NOME']?></h5></td>
                              <td width="60%"><?=$log->informacaoLog($value['type'],$value['texto'])?></td>
                              <td width="15%"><?=date("d/m/Y H:i:s", strtotime($value['updated']));?></td>
                            </tr>
                          <?php
                          if($value['type'] == 1): $count_acessos++; else: $count_acessos = 0; endif;
                          endforeach; ?>
                          <tr>
                            <td style="width: 25%"><strong>Coment&aacute;rio</strong></td>
                            <td><textarea name="comentario" id="" style="width: 460px" rows="5"></textarea></td>
                            <td align="center"><input type="submit" value="Enviar" /></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </form>
    </td>
  </tr>
</table>
<!--/ END - Log de Mudanças -->
<table width="100%" border="0">
  <tr>
    <td colspan="5">
      <table width="100%" border="0">
        <tr>
          <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>
          <td bgcolor="#333333">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<div id="dialog-confirm" title="Acionar Fábrica">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Deseja realmente acionar a fábrica?</p>
</div>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script language="javascript" type="text/javascript">
<!--
    if (document.form.ITEM_QTDE.value == "" || document.form.ITEM_VALOR_UNITARIO.value == "")
      document.form.ITEM_VALOR_TOTAL.value = "R$ 0,00";
    else
      document.form.ITEM_VALOR_TOTAL.value = "R$ " + arredondaNumber(parseFloat(document.form.ITEM_VALOR_UNITARIO.value.substring(3).replace(",",".")) * parseInt(document.form.ITEM_QTDE.value),",",2,true);
    function verificaForm(formObj, avanca) {
      if (formObj.AVALI_AREZ_DEFEIG_IDO.value == "") {
        alert("Preencha o campo \"Grupo - Defeito encontrado\"");
        return;
      }
      if (formObj.AVALI_AREZ_DEFEIS_IDO.value == "") {
        alert("Preencha o campo \"Subgrupo - Defeito encontrado\"");
        return;
      }
      if (formObj.AVALI_AREZ_DETALHE.value == "" && formObj.AVALI_SITUACAO[1].checked) {
        alert("Preencha o campo \"Detalhamento\"");
        return;
      }
      if (!JSUtilValidaData(formObj.AVALI_AREZ_DATA.value,false)) {
        alert("Preencha o campo \"Data da avaliação\"");
        return;
      }
      if (!formObj.AVALI_SITUACAO[0].checked && !formObj.AVALI_SITUACAO[1].checked && !formObj.AVALI_SITUACAO[2].checked && !formObj.AVALI_SITUACAO[3].checked && !formObj.AVALI_SITUACAO[4].checked) {
        alert("Preencha o campo \"Situação da reclamação\"");
        return;
      }
      formObj.AVALI_AREZ_DATA.disabled = false;
      if (avanca == 'S'){
        formObj.action = "pesq_avaliacao_pendenteok2.php?avanca=S";
      }else{
        formObj.action = "pesq_avaliacao_pendenteok2.php?avanca=N";
      }
      document.form.submit();
    }
    function updateDateNow(objCheck,objDate) {
      if (objCheck.checked) {
        var dateNow = new Date();
        var mes = dateNow.getMonth() + 1;
        //substituido pela linha abaixo em 21/11/2005
        //motivo: o JAVASCRIPT começa os meses no 1
        //document.form.elements[objDate].value = ((dateNow.getDate() < 10) ? "0" : "") + dateNow.getDate() + "/" + ((dateNow.getMonth() < 10)+1 ? "0" : "") + dateNow.getMonth() + "/" + dateNow.getFullYear();
        document.form.elements[objDate].value = ((dateNow.getDate() < 10) ? "0" : "") + dateNow.getDate() + "/" + ((mes < 10) ? "0" : "") + mes + "/" + dateNow.getFullYear();
        document.form.elements[objDate].disabled = true;
      }else{
        document.form.elements[objDate].disabled = false;
        document.form.elements[objDate].value = "";
      }
    }
    function voltar(){
      history.go(-1);
    }
    function updateAvaliacaoByProcedente(checkbox) {
      document.form.AVALI_AREZ_ENCERRADO.checked = checkbox;
      updateDateNow(document.form.AVALI_AREZ_ENCERRADO,'AVALI_AREZ_DATA');
    }
    function updateAvaliacao() {
      document.form.AVALI_AREZ_ENCERRADO.checked = (document.form.LANCA_STATUS.value == "3") ? true : false;
      updateDateNow(document.form.AVALI_AREZ_ENCERRADO,'AVALI_AREZ_DATA');
    }
//-->
</script>
<?php
$session = new LogAvaliacoes();
$session->_writeAccess($_SESSION['sId'], $_GET['Id']);
$_SESSION['NUM_RAR'] = $_GET['Id'];
?>