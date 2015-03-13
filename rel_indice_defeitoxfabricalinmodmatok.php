<? $Title = "Índice de Defeitos x Fábrica x Linha x Modelo x Material";



	include("inc/top_imp.inc.php"); 

	

	$SQL = "select sum(I.item_qtde) as QTDE ";

	$SQL.= " from rar_lancamento L, rar_defeito_grupo D, pessoa F, rar_avaliacao A, rar_item I, rar_fabrica, rar_agente ";

	$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

	$SQL.= "       AND LANCA_FABRI_IDO = FABRI_PESSOA";

	$SQL.= "       AND FABRI_AGENT_IDO = AGENT_IDO";

	$SQL.= "       and L.lanca_numrar = I.item_numrar ";

	$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

	$SQL.= "       and L.lanca_status <> '4'";

	if ($_SESSION["Menu"] == "3"){

		$SQL.= "    and L.lanca_numrar like 'M%'";

	}else{

		$SQL.= "    and L.lanca_numrar not like 'M%'";

	}

	$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

	$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$Stmt = mysql_query($SQL);

	

	if ($Rs = mysql_fetch_assoc($Stmt)){

		$TotalDefeitos = $Rs["QTDE"];

	} 

		

	$SQL = "select AGENT_IDO, AGENT_NOME, sum(I.item_qtde) as QTDE ";

	$SQL.= " from rar_lancamento L, rar_defeito_grupo D, pessoa F, rar_avaliacao A, rar_item I, rar_fabrica, rar_agente";

	$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

	$SQL.= "       AND LANCA_FABRI_IDO = FABRI_PESSOA";

	$SQL.= "       AND FABRI_AGENT_IDO = AGENT_IDO";

	$SQL.= "       and L.lanca_numrar = I.item_numrar ";

	$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

	$SQL.= "       and L.lanca_status <> '4'";

	if ($_SESSION["Menu"] == "3"){

		$SQL.= "    and L.lanca_numrar like 'M%'";

	}else{

		$SQL.= "    and L.lanca_numrar not like 'M%'";

	}

	$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

	$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$SQL.= " group by AGENT_IDO, AGENT_NOME ";

	$SQL.= " order by QTDE DESC, AGENT_NOME ";

	$StmtAgente = mysql_query($SQL);

?>

<link href="wfa.css" rel="stylesheet" type="text/css">



	<table width="100%" border="0" cellpadding="0" cellspacing="1">

	<? $Total = 0;

	while($RsAgente = mysql_fetch_assoc($StmtAgente)){ 

		$Total+= intval($RsAgente["QTDE"]); ?>

<tr>

			<td colspan="7" bgcolor="#E1E1E1" class="imp_normal"><strong>Agente:</strong>&nbsp;<?=$RsAgente["AGENT_NOME"]?></div></td>

		<td width="15%" bgcolor="#E1E1E1" class="imp_normal">Quantidade:<strong>&nbsp;</strong>

	    <?=number_format($RsAgente["QTDE"], 0, ',', '.')?></td>

	<td width="20%" bgcolor="#E1E1E1" class="imp_normal"><div align="right"><?=round(($RsAgente["QTDE"]/$TotalDefeitos) * 100,2)?>&nbsp;% x total </div></td>

		</tr>

		  

		<? 

		$SQL = "select F.PESSOA, F.NOME, sum(I.item_qtde) as QTDE ";

		$SQL.= " from rar_lancamento L, rar_defeito_grupo D, pessoa F, rar_avaliacao A, rar_item I, rar_fabrica ";

		$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

		$SQL.= "       AND LANCA_FABRI_IDO = FABRI_PESSOA";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		$SQL.= "       and L.lanca_status <> '4'";

		if ($_SESSION["Menu"] == "3"){

			$SQL.= "    and L.lanca_numrar like 'M%'";

		}else{

			$SQL.= "    and L.lanca_numrar not like 'M%'";

		}

		$SQL.= "       and FABRI_AGENT_IDO = '" .$RsAgente["AGENT_IDO"]. "' ";

		$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by F.PESSOA, F.NOME";

		$SQL.= " order by QTDE DESC, NOME";

		//die($SQL);

		$StmtFabrica = mysql_query($SQL);

		while($RsFabrica = mysql_fetch_assoc($StmtFabrica)){ ?>

				<tr>

				<td width="5%" >&nbsp;</td>

				<td colspan="6" bgcolor="#E6E6E6" class="imp_normal" ><strong>F&aacute;brica:</strong>&nbsp;<?=$RsFabrica["NOME"]?></td>

				<td bgcolor="#E6E6E6" class="imp_normal">Quantidade:&nbsp;<?=number_format($RsFabrica["QTDE"], 0, ',', '.')?></td>

				<td align="right" bgcolor="#E6E6E6" class="imp_normal"><?=round(($RsFabrica["QTDE"]/$RsAgente["QTDE"]) * 100,2)?>&nbsp;% x agente</td>

				</tr>

				<? 

				$F_NOME = str_replace("'","''",$RsFabrica["NOME"]);

				$SQL = "select D.DEFEIG_IDO, D.DEFEIg_DESCRICAO NOME, sum(I.item_qtde) as QTDE ";

				$SQL.= " from rar_lancamento L, rar_defeito_grupo D, pessoa F, rar_avaliacao A, rar_item I, rar_fabrica ";

				$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

				$SQL.= "       AND LANCA_FABRI_IDO = FABRI_PESSOA";

				$SQL.= "       and L.lanca_numrar = I.item_numrar ";

				$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

				$SQL.= "       and L.lanca_status <> '4'";

				if ($_SESSION["Menu"] == "3"){

					$SQL.= "    and L.lanca_numrar like 'M%'";

				}else{

					$SQL.= "    and L.lanca_numrar not like 'M%'";

				}

				$SQL.= "       and FABRI_AGENT_IDO = '" .$RsAgente["AGENT_IDO"]. "' ";

				$SQL.= "       and F.NOME = '" .$F_NOME. "' ";

				$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

				$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

				$SQL.= " group by D.DEFEIG_IDO, D.DEFEIG_DESCRICAO";

				$SQL.= " order by QTDE DESC, D.DEFEIG_DESCRICAO";

				$StmtGrupo = mysql_query($SQL);

				while($RsGrupo = mysql_fetch_assoc($StmtGrupo)){ ?>

						<tr>

						<td >&nbsp;</td>

						<td width="5%" >&nbsp;</td>

						<td colspan="5" bgcolor="#EBEBEB" class="imp_normal" ><strong>Grupo-defeito:</strong>&nbsp;<?=$RsGrupo["NOME"]?></td>

						<td bgcolor="#EBEBEB" class="imp_normal">Quantidade:&nbsp;<?=number_format($RsGrupo["QTDE"], 0, ',', '.')?></td>

						<td align="right" bgcolor="#EBEBEB" class="imp_normal"><?=round(($RsGrupo["QTDE"]/$RsFabrica["QTDE"]) * 100,2)?>&nbsp;% x fábrica</td>

						</tr>

						

						<? 

						$SQL = "select S.DEFEIS_IDO, S.DEFEIS_DESCRICAO NOME, sum(I.item_qtde) as QTDE ";

						$SQL.= " from rar_lancamento L, rar_defeito_grupo D, rar_defeito_subgrupo S, pessoa F, rar_avaliacao A, rar_item I, rar_fabrica ";

						$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

						$SQL.= "       AND LANCA_FABRI_IDO = FABRI_PESSOA";

						$SQL.= "       and AVALI_AREZ_DEFEIS_IDO = defeis_ido ";

						$SQL.= "       and L.lanca_numrar = I.item_numrar ";

						$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

						$SQL.= "       and L.lanca_status <> '4'";

						if ($_SESSION["Menu"] == "3"){

							$SQL.= "    and L.lanca_numrar like 'M%'";

						}else{

							$SQL.= "    and L.lanca_numrar not like 'M%'";

						}

						$SQL.= "       and FABRI_AGENT_IDO = '" .$RsAgente["AGENT_IDO"]. "' ";

						$SQL.= "       and F.NOME = '" .$F_NOME. "' ";

						$SQL.= "       and A.AVALI_AREZ_DEFEIG_IDO = '" .$RsGrupo["DEFEIG_IDO"]. "' ";

						$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

						$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

						$SQL.= " group by S.DEFEIS_IDO, S.DEFEIS_DESCRICAO";

						$SQL.= " order by QTDE DESC, S.DEFEIS_DESCRICAO";

						$StmtSubGrupo = mysql_query($SQL);

						while($RsSubGrupo = mysql_fetch_assoc($StmtSubGrupo)){ ?>

								<tr>

								<td >&nbsp;</td>

								<td >&nbsp;</td>

								<td width="5%" >&nbsp;</td>

								<td colspan="4" bgcolor="#F0F0F0" class="imp_normal" ><strong>SubGrupo-defeito:</strong>&nbsp;<?=$RsSubGrupo["NOME"]?></td>

								<td bgcolor="#F0F0F0" class="imp_normal">Quantidade:&nbsp;<?=number_format($RsSubGrupo["QTDE"], 0, ',', '.')?></td>

								<td align="right" bgcolor="#F0F0F0" class="imp_normal"><?=round(($RsSubGrupo["QTDE"]/$RsGrupo["QTDE"]) * 100,2)?>&nbsp;% x grupo</td>

								</tr>

								

								<? 

								$SQL = "select substr(item_referencia,1,4) LINHA, sum(I.item_qtde) as QTDE ";

								$SQL.= " from rar_lancamento L, rar_defeito_grupo D, rar_defeito_subgrupo S, pessoa F, rar_avaliacao A, rar_item I, rar_fabrica ";

								$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

								$SQL.= "       AND LANCA_FABRI_IDO = FABRI_PESSOA";

								$SQL.= "       and AVALI_AREZ_DEFEIS_IDO = defeis_ido ";

								$SQL.= "       and L.lanca_numrar = I.item_numrar ";

								$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

								$SQL.= "       and L.lanca_status <> '4'";

								if ($_SESSION["Menu"] == "3"){

									$SQL.= "    and L.lanca_numrar like 'M%'";

								}else{

									$SQL.= "    and L.lanca_numrar not like 'M%'";

								}

								$SQL.= "       and FABRI_AGENT_IDO = '" .$RsAgente["AGENT_IDO"]. "' ";

								$SQL.= "       and F.NOME = '" .$F_NOME. "' ";

								$SQL.= "       and A.AVALI_AREZ_DEFEIG_IDO = '" .$RsGrupo["DEFEIG_IDO"]. "' ";

								$SQL.= "       and A.AVALI_AREZ_DEFEIS_IDO = '" .$RsSubGrupo["DEFEIS_IDO"]. "' ";

								$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

								$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

								$SQL.= " group by substr(item_referencia,1,4)";

								$SQL.= " order by QTDE DESC, LINHA";

								$StmtLinha = mysql_query($SQL);

								while($RsLinha = mysql_fetch_assoc($StmtLinha)){ ?>

										<tr>

										<td >&nbsp;</td>

										<td >&nbsp;</td>

										<td >&nbsp;</td>

										<td width="5%" >&nbsp;</td>

										<td colspan="3" bgcolor="#F5F5F5" class="imp_normal" ><strong>Linha:</strong>&nbsp;<?=$RsLinha["LINHA"]?></td>

										<td bgcolor="#F5F5F5" class="imp_normal">Quantidade:&nbsp;<?=number_format($RsLinha["QTDE"], 0, ',', '.')?></td>

										<td align="right" bgcolor="#F5F5F5" class="imp_normal"><?=round(($RsLinha["QTDE"]/$RsSubGrupo["QTDE"]) * 100,2)?>&nbsp;% x sub-grupo</td>

										</tr>

										

										<? 

										$SQL = "select substr(item_referencia,5,4) MODELO, sum(I.item_qtde) as QTDE ";

										$SQL.= " from rar_lancamento L, rar_defeito_grupo D, rar_defeito_subgrupo S, pessoa F, rar_avaliacao A, rar_item I, rar_fabrica ";

										$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

										$SQL.= "       AND LANCA_FABRI_IDO = FABRI_PESSOA";

										$SQL.= "       and AVALI_AREZ_DEFEIS_IDO = defeis_ido ";

										$SQL.= "       and L.lanca_numrar = I.item_numrar ";

										$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

										$SQL.= "       and L.lanca_status <> '4'";

										if ($_SESSION["Menu"] == "3"){

											$SQL.= "    and L.lanca_numrar like 'M%'";

										}else{

											$SQL.= "    and L.lanca_numrar not like 'M%'";

										}

										$SQL.= "       and FABRI_AGENT_IDO = '" .$RsAgente["AGENT_IDO"]. "' ";

										$SQL.= "       and F.NOME = '" .$F_NOME. "' ";

										$SQL.= "       and A.AVALI_AREZ_DEFEIG_IDO = '" .$RsGrupo["DEFEIG_IDO"]. "' ";

										$SQL.= "       and A.AVALI_AREZ_DEFEIS_IDO = '" .$RsSubGrupo["DEFEIS_IDO"]. "' ";

										$SQL.= "       and substr(item_referencia,1,4) = '" .$RsLinha["LINHA"]. "' ";

										$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

										$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

										$SQL.= " group by substr(item_referencia,5,4)";

										$SQL.= " order by QTDE DESC, MODELO";

										$StmtModelo = mysql_query($SQL);

										while($RsModelo = mysql_fetch_assoc($StmtModelo)){ ?>

												<tr>

												<td >&nbsp;</td>

												<td >&nbsp;</td>

												<td >&nbsp;</td>

												<td >&nbsp;</td>

												<td width="5%" >&nbsp;</td>

												<td colspan="2" bgcolor="#FAFAFA" class="imp_normal" ><strong>Modelo:</strong>&nbsp;<?=$RsModelo["MODELO"]?></td>

												<td bgcolor="#FAFAFA" class="imp_normal">Quantidade:&nbsp;<?=number_format($RsModelo["QTDE"], 0, ',', '.')?></td>

												<td align="right" bgcolor="#FAFAFA" class="imp_normal"><?=round(($RsModelo["QTDE"]/$RsLinha["QTDE"]) * 100,2)?>&nbsp;% x linha</td>

												</tr>

												

												<? 

												$SQL = "select substr(item_referencia,9,4) MATERIAL, sum(I.item_qtde) as QTDE ";

												$SQL.= " from rar_lancamento L, rar_defeito_grupo D, rar_defeito_subgrupo S, pessoa F, rar_avaliacao A, rar_item I, rar_fabrica ";

												$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

												$SQL.= "       AND LANCA_FABRI_IDO = FABRI_PESSOA";

												$SQL.= "       and AVALI_AREZ_DEFEIS_IDO = defeis_ido ";

												$SQL.= "       and L.lanca_numrar = I.item_numrar ";

												$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

												$SQL.= "       and L.lanca_status <> '4'";

												if ($_SESSION["Menu"] == "3"){

													$SQL.= "    and L.lanca_numrar like 'M%'";

												}else{

													$SQL.= "    and L.lanca_numrar not like 'M%'";

												}

												$SQL.= "       and FABRI_AGENT_IDO = '" .$RsAgente["AGENT_IDO"]. "' ";

												$SQL.= "       and F.NOME = '" .$F_NOME. "' ";

												$SQL.= "       and A.AVALI_AREZ_DEFEIG_IDO = '" .$RsGrupo["DEFEIG_IDO"]. "' ";

												$SQL.= "       and A.AVALI_AREZ_DEFEIS_IDO = '" .$RsSubGrupo["DEFEIS_IDO"]. "' ";

												$SQL.= "       and substr(item_referencia,1,4) = '" .$RsLinha["LINHA"]. "' ";

												$SQL.= "       and substr(item_referencia,5,4) = '" .$RsModelo["MODELO"]. "' ";

												$SQL.= "       and A.AVALI_AREZ_DEFEIg_IDO = defeig_ido " .$SqlCriterios;

												$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

												$SQL.= " group by substr(item_referencia,9,4)";

												$SQL.= " order by QTDE DESC, MATERIAL";

												$StmtMaterial = mysql_query($SQL);

												while($RsMaterial = mysql_fetch_assoc($StmtMaterial)){ ?>

														<tr>

														<td >&nbsp;</td>

														<td >&nbsp;</td>

														<td >&nbsp;</td>

														<td >&nbsp;</td>

														<td >&nbsp;</td>

														<td width="5%" >&nbsp;</td>

														<td class="imp_normal" ><strong>Material:</strong>&nbsp;<?=$RsMaterial["MATERIAL"]?></td>

														<td class="imp_normal">Quantidade:&nbsp;<?=number_format($RsMaterial["QTDE"], 0, ',', '.')?></td>

														<td class="imp_normal" align="right"><?=round(($RsMaterial["QTDE"]/$RsModelo["QTDE"]) * 100,2)?>&nbsp;% x modelo</td>

														</tr>

													

												<?  }  //Encerra Loop Material ?>



										<?  }  //Encerra Loop Modelo ?>



								<?  }  //Encerra Loop Linha ?>



						<?  }  //Encerra Loop Sub-Grupo Defeito ?>



				<?  }  //Encerra Loop Grupo Defeito ?>



		<?  }  //Encerra Loop Fabrica ?>

		<tr>

			<td class="imp_normal_bot" colspan="9">&nbsp;</td>

		</tr>	

	<?  }  //Encerra Loop Agente ?>

    <tr>

    <td class="imp_normal_bot" colspan="9">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="7" class="imp_normal"><div align="right"></div>      

	<div align="right"><strong>Total:</strong></div></td>

    <td colspan="2" class="imp_normal"><div align="left">&nbsp;&nbsp;<?=number_format($Total, 0, ',', '.')?></div></td>

  </tr>

  <tr>

    <td colspan="7" class="imp_normal">&nbsp;</td>

    <td colspan="2" class="imp_normal">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="9" class="imp_normal"><div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div></td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

