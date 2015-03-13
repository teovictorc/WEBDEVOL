<? include("inc/conn_externa.inc.php");



	function formatCurrencyPrint($Valor) {

		if (strlen($Valor) == 0)

			return "0,00";

		if (strpos($Valor,".") === false){

			$Valor.= ",";

			$positionPot = strlen($Valor) - 1;

		}else

			$positionPot = strpos($Valor,".");

			

		$Valor.= substr("00",0,2 - ((strlen($Valor) - 1) - $positionPot));

		$Valor = str_replace(".",",",$Valor);

		for ($x = 6; $x < strlen($Valor); $x+= 4)

			$Valor = substr($Valor,0,strlen($Valor) - $x) . "." . substr($Valor,strlen($Valor) - x);

		return $Valor;

	}





function situacao($value) {

	switch($value) {

		case "P":

				return "Procedente";

			break;

		case "I":

				return "Improcedente";

			break;
			
		case "C":

				return "Conserto";

			break;

		default:

				return "";

	}

}

function status($value) {

	switch($value) {

		case "1":

				return "Em aberto";

			break;

		case "3":

				return "Encerrado";

			break;

		default:

				return "";

	}

}

  

	$Criterios = "";

	$SqlCriterios = "";

	$SqlCriteriosData = "";

	

	if ($_POST['SERVICO'] != "S"){

		$SqlCriterios.= " AND L.LANCA_STATUS <> 'I' ";

		$SqlCriterios.= " and lanca_fabri_ido in (select usufor_pessoa from rar_usuarioxfornecedor where USUFOR_USUAR_IDO = " .$_SESSION['sId'].")";

	}

	

	if ($_POST['PDV'] == "S"){

		if (trim($_POST['COORDENADOR'])) {

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Coordenador: " .$_POST['COORDENADOR'];

		}

		

		if (trim($_POST['CONSULTOR'])) {

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Consultor: " .$_POST['CONSULTOR'];

		}

		

		if (trim($_POST['PDVRG_PESSOA'])) {

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Loja: " .$_POST['PDVRG_PESSOA'];

		}

		

		if (trim($_POST['PDVRG_DATA_INICIO']) && trim($_POST['PDVRG_DATA_FIM'])) {

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Data da atividade: " .$_POST['PDVRG_DATA_INICIO'] . " até ".$_POST['PDVRG_DATA_FIM'];

		}

		

		if ($Criterios == "") {

			$Criterios = " Todos os registros de atividades ";

		}

		

		if ($_POST["TIPO"] == "S"){

			$Criterios.=" - Tipo: Sintético";

		}elseif ($_POST["TIPO"] == "A"){

			$Criterios.=" - Tipo: Analítico";

			if ($_POST["ORDEM"] == "D"){

				$Criterios.=" - Ordenado por: data";

			}elseif ($_POST["ORDEM"] == "A"){

				$Criterios.=" - Ordenado por: atividade";

			}

		}

	}

	elseif ($_POST['SERVICO'] != "S"){

		if (trim($_POST['LANCA_NUMRAR'])) {

			$SqlCriterios.= "AND L.LANCA_NUMRAR = '" .$_POST['LANCA_NUMRAR']. "' ";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."N.º Reclamação: " .$_POST['LANCA_NUMRAR'];

		}

		

		if (trim($_POST['FABRI_AGENT_IDO'])) {

			$SqlCriterios.= "AND FABRI_AGENT_IDO = '" .$_POST['FABRI_AGENT_IDO']. "' ";

			$Sql = "SELECT AGENT_NOME FROM RAR_AGENTE WHERE AGENT_IDO = '" .$_POST['FABRI_AGENT_IDO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Agente: " .$Rs["AGENT_NOME"];

		}

		

		if (trim($_POST['LANCA_FABRI_IDO'])) {

			$SqlCriterios.= "AND L.LANCA_FABRI_IDO = '" .$_POST['LANCA_FABRI_IDO']. "' ";

			//$Stmt = @mysql_query("SELECT NOME FROM PESSOA WHERE PESSOA = '" .$_POST['LANCA_FABRI_IDO']. "'");

			//@ociexecute($Stmt);

			//@ocifetch($Stmt);

			$Sql = "SELECT NOME FROM PESSOA WHERE PESSOA = '" .$_POST['LANCA_FABRI_IDO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				//$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Fabricante: " .ociresult($Stmt,"NOME");

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Fabricante: " .$Rs["NOME"];

		}

		if (trim($_POST['LANCA_PESSOA'])) {

			$SqlCriterios.= "AND L.LANCA_PESSOA = '" .$_POST['LANCA_PESSOA']. "' ";

			//$Stmt = @mysql_query("SELECT NOME FROM PESSOA WHERE PESSOA = '" .$_POST['LANCA_PESSOA']. "'");

			//@ociexecute($Stmt);

			//@ocifetch($Stmt);

			$Sql = "SELECT NOME FROM PESSOA WHERE PESSOA = '" .$_POST['LANCA_PESSOA']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				//$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Cliente: " .ociresult($Stmt,"NOME");

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Cliente: " .$Rs["NOME"];

		}

		if (trim($_POST['LINHA'])) {

			$SqlCriterios.= "AND SUBSTR(I.ITEM_REFERENCIA,1,4) = '" .$_POST['LINHA']. "' ";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Linha: " .$_POST['LINHA'];

		}

		if (trim($_POST['MODELO'])) {

			$SqlCriterios.= "AND SUBSTR(I.ITEM_REFERENCIA,5,4) = '" .$_POST['MODELO']. "' ";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Modelo: " .$_POST['MODELO'];

		}

		if (trim($_POST['LANCA_DATAABERTURAI']) && trim($_POST['LANCA_DATAABERTURAF'])) {

			$DataIni = substr($_POST['LANCA_DATAABERTURAI'],6,4)."-".substr($_POST['LANCA_DATAABERTURAI'],3,2)."-".substr($_POST['LANCA_DATAABERTURAI'],0,2);

			$DataFim = substr($_POST['LANCA_DATAABERTURAF'],6,4)."-".substr($_POST['LANCA_DATAABERTURAF'],3,2)."-".substr($_POST['LANCA_DATAABERTURAF'],0,2);

			

			$SqlCriterios.= " AND (L.LANCA_DATAABERTURA BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

				   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

			$SqlCriteriosData.= " AND (dt_saida_entrada BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

				   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Data de abertura: " .$_POST['LANCA_DATAABERTURAI'] . " até ".$_POST['LANCA_DATAABERTURAF'];

		}

		if (trim($_POST['AVALI_AREZ_DATAI']) && trim($_POST['AVALI_AREZ_DATAF'])) {

			$DataIni = substr($_POST['AVALI_AREZ_DATAI'],6,4)."-".substr($_POST['AVALI_AREZ_DATAI'],3,2)."-".substr($_POST['AVALI_AREZ_DATAI'],0,2);

			$DataFim = substr($_POST['AVALI_AREZ_DATAF'],6,4)."-".substr($_POST['AVALI_AREZ_DATAF'],3,2)."-".substr($_POST['AVALI_AREZ_DATAF'],0,2);

			$SqlCriterios.= " AND (A.AVALI_AREZ_DATA BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

				   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

			$SqlCriteriosData.= " AND (dt_saida_entrada BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

				   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Data de avaliação: " .$_POST['AVALI_AREZ_DATAI'] ." até " .$_POST['AVALI_AREZ_DATAF'];

		}

		if (trim($_POST['LANCA_STATUS'])) {

			$SqlCriterios.= "AND L.LANCA_STATUS = '" .$_POST['LANCA_STATUS']. "' ";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Status da reclamação: " .status($_POST['LANCA_STATUS']);

		}

		if (trim($_POST['AVALI_SITUACAO'])) {

			$SqlCriterios.= "AND A.AVALI_SITUACAO = '" .$_POST['AVALI_SITUACAO']. "' ";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Situação da reclamação: " .situacao($_POST['AVALI_SITUACAO']);

		}

		

		if (trim($_POST['LANCA_CATEGORIA'])) {

			$SqlCriterios.= "AND L.LANCA_CATEGORIA in (" .$_POST['LANCA_CATEGORIA']. ") ";

			if ($_POST['LANCA_CATEGORIA'] == "1"){

				$Categoria = "Calçados";

			}elseif ($_POST['LANCA_CATEGORIA'] == "2,3,4"){

				$Categoria = "License";

			}

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Categoria da reclamação: " .$Categoria;

		}

		

		if (trim($_POST['AVALI_AREZ_DEFEIG_IDO'])) {

			$SqlCriterios.= "AND A.AVALI_AREZ_DEFEIG_IDO = '" .$_POST['AVALI_AREZ_DEFEIG_IDO']. "' ";

			$Sql = "SELECT DEFEIG_DESCRICAO FROM rar_defeito_grupo WHERE DEFEIG_IDO = '" .$_POST['AVALI_AREZ_DEFEIG_IDO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Grupo de defeito: " .$Rs["DEFEIG_DESCRICAO"];

		}

		

		if (trim($_POST['CHEGADAI']) && trim($_POST['CHEGADAF'])) {

			$DataIni = substr($_POST['CHEGADAI'],6,4)."-".substr($_POST['CHEGADAI'],3,2)."-".substr($_POST['CHEGADAI'],0,2);

			$DataFim = substr($_POST['CHEGADAF'],6,4)."-".substr($_POST['CHEGADAF'],3,2)."-".substr($_POST['CHEGADAF'],0,2);

	

			$SqlCriterios.= " AND (PRENF_DATA_RECEBTO_COLETA BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

				   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

			$SqlCriteriosData.= " AND (PRENF_DATA_RECEBTO_COLETA BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

				   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Chegada transportadora: " .$_POST['CHEGADAI'] . " até ".$_POST['CHEGADAF'];

		

		}

		

		if (trim($_POST['CHEGADA2I']) && trim($_POST['CHEGADA2F'])) {

			$DataIni = substr($_POST['CHEGADA2I'],6,4)."-".substr($_POST['CHEGADA2I'],3,2)."-".substr($_POST['CHEGADA2I'],0,2);

			$DataFim = substr($_POST['CHEGADA2F'],6,4)."-".substr($_POST['CHEGADA2F'],3,2)."-".substr($_POST['CHEGADA2F'],0,2);

	

			if ($_POST['LANCA_CATEGORIA'] == "1"){

				$SqlCriterios.= " AND (PRENF_DATA_RECEBTO_AREZZO BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

				   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

				$SqlCriteriosData.= " AND (PRENF_DATA_RECEBTO_AREZZO BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

					   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Chegada na Arezzo: " .$_POST['CHEGADAI'] . " até ".$_POST['CHEGADAF'];

			

			}elseif ($_POST['LANCA_CATEGORIA'] == "2,3,4"){

				$SqlCriterios.= " AND (PRENF_DATA_RECEBTO_AREZZO BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

					   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

				$SqlCriteriosData.= " AND (PRENF_DATA_RECEBTO_AREZZO BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

					   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Chegada no fornecedor: " .$_POST['CHEGADAI'] . " até ".$_POST['CHEGADAF'];

			}

		}

		

		if (trim($_POST['etapa'])) {

			if ($_POST["etapa"] == "1"){

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: Avaliação";

			}

			

			if ($_POST["etapa"] == "2"){

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: Pré-nota";

			}

			

			if ($_POST["etapa"] == "3"){

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: NF Devolução";

			}

			

			if ($_POST["etapa"] == "4"){

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: Solicitação de coleta";

			}

			if ($_POST["etapa"] == "5"){

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: Coleta no cliente";

			}

			if ($_POST["etapa"] == "6"){

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: Chegada transportadora";

			}

			if ($_POST["etapa"] == "7"){

				if ($_POST['LANCA_CATEGORIA'] == "1"){

					$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: Chegada Arezzo";

				}elseif ($_POST['LANCA_CATEGORIA'] == "2,3,4"){

					$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: Chegada no fornecedor";

				}

			}

			if ($_POST["etapa"] == "8"){

				if ($_POST['LANCA_CATEGORIA'] == "1"){

					$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: Importação Sistema Arezzo";

				}elseif ($_POST['LANCA_CATEGORIA'] == "2,3,4"){

					$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: Informação de crédito";

				}

			}

			if ($_POST["etapa"] == "9"){

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa pendente: Crédito concedido";

			}

		}

		

		

		if ($Criterios == "") {

			$Criterios = " Todas as reclamações ";

		}



	}else{

	

		//WFA SERVIÇOS ------------- ***************************** -----------------

		if (trim($_POST['SERVI_STATUS'])) {

			$SqlCriterios.= " AND SERVI_STATUS in (" .$_POST['SERVI_STATUS']. ") ";

			if ($_POST['RELPENDENCIA'] == "S"){

				if ($_POST['SERVI_STATUS'] == "1"){

					$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa: pendente - anjo";

				}else{

					$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Etapa: pendente - retorno ao cliente";

				}

			}else{

				if ($_POST['SERVI_STATUS'] == "4"){

					$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Status: Concluído";

				}else{

					$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Status: Pendente";

				}

			}

			

		}

		

		if (trim($_POST['SERVI_NUMERO'])) {

			$SqlCriterios.= " AND SERVI_NUMERO = '" .$_POST['SERVI_NUMERO']. "' ";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."N.º Serviço: " .$_POST['SERVI_NUMERO'];

		}

		

		if (trim($_POST['SERVI_PESSO_IDO'])) {

			$SqlCriterios.= " AND SERVI_PESSO_IDO = '" .$_POST['SERVI_PESSO_IDO']. "' ";

			$Sql = "SELECT NOME FROM PESSOA WHERE PESSOA = '" .$_POST['SERVI_PESSO_IDO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Cliente: " .$Rs["NOME"];

		}

		

		if (trim($_POST['SERVI_COB_PESSOA_CREDITO'])) {

			$SqlCriterios.= " AND SERVI_COB_PESSOA_CREDITO = '" .$_POST['SERVI_COB_PESSOA_CREDITO']. "' ";

			$Sql = "SELECT NOME FROM PESSOA WHERE PESSOA = '" .$_POST['SERVI_COB_PESSOA_CREDITO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Fornecedor crédito: " .$Rs["NOME"];

		}

		

		if (trim($_POST['SERVI_COB_PESSOA_DEBITO'])) {

			$SqlCriterios.= " AND SERVI_COB_PESSOA_DEBITO = '" .$_POST['SERVI_COB_PESSOA_DEBITO']. "' ";

			$Sql = "SELECT NOME FROM PESSOA WHERE PESSOA = '" .$_POST['SERVI_COB_PESSOA_DEBITO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Fornecedor débito: " .$Rs["NOME"];

		}

		

		if (trim($_POST['SERVI_FABRI_IDO'])) {

			$SqlCriterios.= " AND SERVI_NUMERO IN (";

			$SqlCriterios.= " 	SELECT sernf_servi_numero servi_numero ";

			$SqlCriterios.= " 	  FROM rar_servico_nf ";

			$SqlCriterios.= " 	 WHERE sernf_pessoa_emitente = '" .$_POST['SERVI_FABRI_IDO']. "' ";

			$SqlCriterios.= " 	 UNION ";

			$SqlCriterios.= " 	SELECT serdv_servi_numero servi_numero ";

			$SqlCriterios.= " 	  FROM rar_servico_nf_dev ";

			$SqlCriterios.= " 	 WHERE serdv_pessoa_emitente = '" .$_POST['SERVI_FABRI_IDO']. "' ";

			$SqlCriterios.= " 	 UNION ";

			$SqlCriterios.= " 	SELECT serpr_servi_numero servi_numero ";

			$SqlCriterios.= " 	  FROM rar_servico_nf_prod ";

			$SqlCriterios.= " 	 WHERE serpr_pessoa_emitente = '" .$_POST['SERVI_FABRI_IDO']. "' ";

			$SqlCriterios.= " 	 UNION ";

			$SqlCriterios.= " 	SELECT sprnf_servi_numero servi_numero ";

			$SqlCriterios.= "  	  FROM rar_servico_nf_prod_dev ";

			$SqlCriterios.= " 	 WHERE sprnf_pessoa_destinatario = '" .$_POST['SERVI_FABRI_IDO']. "' ";

			$SqlCriterios.= " ) ";



			$Sql = "SELECT NOME FROM PESSOA WHERE PESSOA = '" .$_POST['SERVI_FABRI_IDO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Fabricante: " .$Rs["NOME"];

		}

		

		if (trim($_POST['SERVI_EQUIP_IDO'])) {

			$SqlCriterios.= " AND SERVI_EQUIP_IDO = '" .$_POST['SERVI_EQUIP_IDO']. "' ";

			$Sql = "SELECT * FROM RAR_EQUIPE WHERE EQUIP_IDO = '" .$_POST['SERVI_EQUIP_IDO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Equipe: " .$Rs["EQUIP_NOME"];

		}

		

		if (trim($_POST['SERVI_TISER_IDO'])) {

			$SqlCriterios.= " AND SERVI_TISER_IDO = '" .$_POST['SERVI_TISER_IDO']. "' ";

			$Sql = "SELECT * FROM RAR_TIPOSERVICO WHERE TISER_IDO = '" .$_POST['SERVI_TISER_IDO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Serviço: " .$Rs["TISER_NOME"];

		}

		

		if (trim($_POST['SERVI_TIPPR_IDO'])) {

			$SqlCriterios.= " AND SERVI_TIPPR_IDO = '" .$_POST['SERVI_TIPPR_IDO']. "' ";

			$Sql = "SELECT * FROM RAR_TIPOPRODUTO WHERE TIPPR_IDO = '" .$_POST['SERVI_TIPPR_IDO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Tipo de produto: " .$Rs["TIPPR_DESCRICAO"];

		}

		

		if (trim($_POST['SERSM_ENTREGUE'])) {

			$SqlCriterios.= " AND SERSM_ENTREGUE = '" .$_POST['SERSM_ENTREGUE']. "' ";

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Status solicitação material: " .(($_POST['SERSM_ENTREGUE'] == "S") ? "Entregue" : "Não entregue");

		}

		

		if (trim($_POST['SERSM_MATERG_IDO'])) {

			$SqlCriterios.= " AND SERSM_MATERG_IDO = '" .$_POST['SERSM_MATERG_IDO']. "' ";

			$Sql = " SELECT * FROM RAR_MATERIAL_GRUPO, RAR_TIPOPRODUTO";

			$Sql.= " WHERE MATERG_IDO = '" .$_POST['SERSM_MATERG_IDO']. "'";

			$Sql.= "       AND MATERG_CATEGORIA = TIPPR_IDO";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Grupo de material: " .$Rs["TIPPR_DESCRICAO"]." - ".$Rs["MATERG_DESCRICAO"];

		}

		

		if (trim($_POST['SERVI_USUAR_ANJO'])) {

			$SqlCriterios.= " AND SERVI_USUAR_ANJO = '" .$_POST['SERVI_USUAR_ANJO']. "' ";

			$Sql = "SELECT USUAR_NOME FROM RAR_USUARIO WHERE USUAR_IDO = '" .$_POST['SERVI_USUAR_ANJO']. "'";

			$Stmt = mysql_query($Sql);

			if ($Rs = mysql_fetch_assoc($Stmt))

				$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Anjo: " .$Rs["USUAR_NOME"];

		}

		

		if (trim($_POST['SERVI_DATAABERTURAI']) && trim($_POST['SERVI_DATAABERTURAF'])){

			$DataIni = substr($_POST['SERVI_DATAABERTURAI'],6,4)."-".substr($_POST['SERVI_DATAABERTURAI'],3,2)."-".substr($_POST['SERVI_DATAABERTURAI'],0,2);

			$DataFim = substr($_POST['SERVI_DATAABERTURAF'],6,4)."-".substr($_POST['SERVI_DATAABERTURAF'],3,2)."-".substr($_POST['SERVI_DATAABERTURAF'],0,2);

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Data de abertura: " .$_POST['SERVI_DATAABERTURAI'] . " até ".$_POST['SERVI_DATAABERTURAF'];

			$SqlCriterios.= " AND (date_format(SERVI_DATAABERTURA,'%Y-%m-%d') BETWEEN date_format('" .$DataIni. "','%Y-%m-%d') ".

				   " AND date_format('" .$DataFim. "','%Y-%m-%d'))";

			

			//$SqlCriterios.= " AND (SERVI_DATAABERTURA BETWEEN date_format('" .$_POST['SERVI_DATAABERTURAI']. " 00:00','%d/%m/%Y %h:%%i') ".

			//	   "                                      AND date_format('" .$_POST['SERVI_DATAABERTURAF']. " 23:59','%d/%m/%Y %h:%%i'))";

		}

		

		   

		if (trim($_POST['SERVI_DATA_ENCERRAMENTOI']) && trim($_POST['SERVI_DATA_ENCERRAMENTOF'])){

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Data de conclusão: " .$_POST['SERVI_DATA_ENCERRAMENTOI'] . " até ".$_POST['SERVI_DATA_ENCERRAMENTOF'];

			$SqlCriterios.= " AND (SERVI_DATA_ENCERRAMENTO BETWEEN date_format('" .$_POST['SERVI_DATA_ENCERRAMENTOI']. " 00:00','%d/%m/%Y %h:%%i') ".

				   "                                           AND date_format('" .$_POST['SERVI_DATA_ENCERRAMENTOF']. " 23:59','%d/%m/%Y %h:%%i'))";

		}

		

		if (trim($_POST['TISER_CATEGORIA'])) {

			if ($_POST['TISER_CATEGORIA'] == "C"){

				$Categoria = "Consultor";

			}elseif ($_POST['TISER_CATEGORIA'] == "F"){

				$Categoria = "Franqueado";

			}elseif ($_POST['TISER_CATEGORIA'] == "L"){

				$Categoria = "Operador logístico";

			}

			$Criterios.= ((strlen($Criterios) == 0) ? "" : " - ") ."Categoria: " .$Categoria;

		}

				   

		if ($Criterios == "") {

			$Criterios = " Todos os serviços ";

		}

	}

	

	

?>

<html>

<head>

<link href="wfa.css" rel="stylesheet" type="text/css">

<style type="text/css">

<!--

body {

	margin-left: 5px;

	margin-top: 5px;

	margin-right: 5px;

	margin-bottom: 5px;

}

-->

</style>

<title><?=$Title?></title>

<style type="text/css">

<!--

.style3 {font-size: 18px}

-->

</style>

</head>

<body>

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td width="77%" rowspan="2" class="imp_normal_bot"><h1><?=$NomeSistema?></h1></td>

    <td width="23%" height="10%" class="imp_normal">&nbsp;</td>

  </tr>

  <tr>

    <td  class="imp_normal_bot"><div align="right">Data de emiss&atilde;o:

        <?=date("d/m/Y")?>

    </div></td>

  </tr>

  <tr>

  <? if ($Categoria != "" && $_POST["TISER_CATEGORIA"] == ""){

  		$Title = $Title." - ".$Categoria;

	}

  ?>

  

    <td height="39" colspan="2"><div align="center" class="TextNormal_12Negrito style3"><strong><?=$Title?><br>

</strong></div></td>

  </tr>

  <tr valign="top">

    <td height="17" colspan="2" class="imp_normal_bot"><strong>Crit&eacute;rios da pesquisa : </strong>

    <?=$Criterios?></td>

  </tr>

  <tr valign="top">

    <td height="15" colspan="2" class="imp_normal">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2">