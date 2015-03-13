<? $Title = "Índice de Defeitos X Nº Par";

	include("inc/top_imp.inc.php"); 



		$SQL = "select C.PESSOA C_CODIGO, C.NOME C_NOME, ";

		$SQL.= "       sum(I.item_qtde) as QTDE";

		$SQL.= " from rar_lancamento L, pessoa C, pessoa F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by C.PESSOA, C.NOME";

		$SQL.= " order by qtde desc, c_nome, c_codigo";

		//die($SQL);

		$Stmt = mysql_query($SQL);

?>

<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td height="16" class="imp_normal_total"><div align="left"><strong>Cliente</strong></div></td>

    <td width="3%" class="imp_normal_total"><div align="center"><strong>33</strong></div></td>

    <td width="3%" class="imp_normal_total"><div align="center"><strong>34</strong></div></td>

    <td width="3%" class="imp_normal_total"><div align="center"><strong>35</strong></div></td>

    <td width="3%" class="imp_normal_total"><div align="center"><strong>36</strong></div></td>

    <td width="3%" class="imp_normal_total"><div align="center"><strong>37</strong></div></td>

    <td width="3%" class="imp_normal_total"><div align="center"><strong>38</strong></div></td>

    <td width="3%" class="imp_normal_total"><div align="center"><strong>39</strong></div></td>

    <td width="3%" class="imp_normal_total"><div align="center"><strong>40</strong></div></td>

    <td width="5%" class="imp_normal_total"><div align="center"><strong>Total</strong></div></td>

  </tr>

<?  



	$Valor33T = 0;

	$Valor34T = 0;

	$Valor35T = 0;

	$Valor36T = 0;

	$Valor37T = 0;

	$Valor38T = 0;

	$Valor39T = 0;

	$Valor40T = 0;

	$ValorTT = 0;

	while($Rs = mysql_fetch_assoc($Stmt)){

		$SQL = "select C.PESSOA C_CODIGO, C.NOME C_NOME,";

		$SQL.= " sum(I.item_qtde) as QTDE, I.ITEM_PAR PAR";

		$SQL.= " from rar_lancamento L, pessoa C, pessoa F, rar_avaliacao A, rar_item I ";

		$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and L.lanca_fabri_ido = F.PESSOA " .$SqlCriterios;

		$SQL.= "       and C.PESSOA = '" .$Rs["C_CODIGO"]. "' ";

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by C.PESSOA, C.NOME, I.ITEM_PAR";

		$SQL.= " order by c_nome, c_codigo";

		$Stmt2 = mysql_query($SQL);

		$Valor33 = 0;

		$Valor34 = 0;

		$Valor35 = 0;

		$Valor36 = 0;

		$Valor37 = 0;

		$Valor38 = 0;

		$Valor39 = 0;

		$Valor40 = 0;

		$ValorT = 0;

		while($Rs2 = mysql_fetch_assoc($Stmt2)){

			if ($Rs2["PAR"] == "33") {$Valor33=$Rs2["QTDE"];}

			if ($Rs2["PAR"] == "34") {$Valor34=$Rs2["QTDE"];}

			if ($Rs2["PAR"] == "35") {$Valor35=$Rs2["QTDE"];}

			if ($Rs2["PAR"] == "36") {$Valor36=$Rs2["QTDE"];}

			if ($Rs2["PAR"] == "37") {$Valor37=$Rs2["QTDE"];}

			if ($Rs2["PAR"] == "38") {$Valor38=$Rs2["QTDE"];}

			if ($Rs2["PAR"] == "39") {$Valor39=$Rs2["QTDE"];}

			if ($Rs2["PAR"] == "40") {$Valor40=$Rs2["QTDE"];}

			$ValorT = $Valor33 + $Valor34 + $Valor35 + $Valor36 + $Valor37 + $Valor38 + $Valor39 + $Valor40;

			}?>

	  <tr>

	    <td class="imp_normal"><?=$Rs["C_CODIGO"]."-".$Rs["C_NOME"]?></td>

	    <td class="imp_normal" align="right"><?=$Valor33?></td>

	    <td class="imp_normal" align="right"><?=$Valor34?></td>

	    <td class="imp_normal" align="right"><?=$Valor35?></td>

	    <td class="imp_normal" align="right"><?=$Valor36?></td>

	    <td class="imp_normal" align="right"><?=$Valor37?></td>

	    <td class="imp_normal" align="right"><?=$Valor38?></td>

	    <td class="imp_normal" align="right"><?=$Valor39?></td>

	    <td class="imp_normal" align="right"><?=$Valor40?></td>

	    <td class="imp_normal" align="right"><?=$ValorT?></td>

  </tr>

	<? 	$Valor33T+= $Valor33;

		$Valor34T+= $Valor34;

		$Valor35T+= $Valor35;

		$Valor36T+= $Valor36;

		$Valor37T+= $Valor37;

		$Valor38T+= $Valor38;

		$Valor39T+= $Valor39;

		$Valor40T+= $Valor40;

		$ValorTT+= $ValorT;	

	} ?>

	  <tr>

	    <td class="imp_normal" align="right"><div align="right"><strong>Total Geral:</strong></div></td>

		<td class="imp_normal" align="right"><strong><?=$Valor33T?></strong></td>

	    <td class="imp_normal" align="right"><strong><?=$Valor34T?></strong></td>

	    <td class="imp_normal" align="right"><strong><?=$Valor35T?></strong></td>

	    <td class="imp_normal" align="right"><strong><?=$Valor36T?></strong></td>

	    <td class="imp_normal" align="right"><strong><?=$Valor37T?></strong></td>

	    <td class="imp_normal" align="right"><strong><?=$Valor38T?></strong></td>

	    <td class="imp_normal" align="right"><strong><?=$Valor39T?></strong></td>

	    <td class="imp_normal" align="right"><strong><?=$Valor40T?></strong></td>

	    <td class="imp_normal" align="right"><strong><?=$ValorTT?></strong></td>



	</tr>

	  <tr>

	    <td class="imp_normal" align="right">&nbsp;</td>

	    <td class="imp_normal" align="right">&nbsp;</td>

	    <td class="imp_normal" align="right">&nbsp;</td>

	    <td class="imp_normal" align="right">&nbsp;</td>

	    <td class="imp_normal" align="right">&nbsp;</td>

	    <td class="imp_normal" align="right">&nbsp;</td>

	    <td class="imp_normal" align="right">&nbsp;</td>

	    <td class="imp_normal" align="right">&nbsp;</td>

	    <td class="imp_normal" align="right">&nbsp;</td>

	    <td class="imp_normal" align="right">&nbsp;</td>

  </tr>

	  <tr>

	    <td class="imp_normal" align="right" colspan="10"><div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

