<? include("../inc/conn_externa.inc.php"); ?>

_menuCloseDelay=500;

_menuOpenDelay=150;

_subOffsetTop=0;

_subOffsetLeft=0;



with(horizStyle=new mm_style()){

styleid=1;

bordercolor="#999999"; // borda menu principal

borderstyle="solid";

borderwidth=0;

fontfamily="tahoma"; // fonte do menu principal

fontsize="100%"; // tamanho da fonte do menu principal

fontstyle="normal";

headerbgcolor="#f5f5f5";// nao sei

headerborder=0;

headercolor="#000099";

offbgcolor="#ffffff"; // AZUL DO MENU PRINCIPAL "#B3D1EB"

offcolor="#000000";

onbgcolor="#f5f5f5"; // bg color qdo mouse over

offbgcolor="#CCCCCC";

onborder="1px solid #999999";

oncolor="#000000"; //cor da fonte qdo mouse on

//offcolor="#999999"; //cor da fonte qdo mouse off

onsubimage="menu/on_downboxed.gif";

overbgimage="menu/fundo_menu_horizontal_novo.gif"; // imagem rollover sobre menu principal

padding=3;

pagebgcolor="#f5f5f5";

pagecolor="#000066";

pageimage="db_red.gif";

separatoralign="center";

separatorcolor="#999999";

separatorwidth="85%";

subimage="menu/downboxed.gif";

}



with(vertStyle=new mm_style()){

bordercolor="#999999";

borderstyle="solid";

borderwidth=1;

fontfamily="tahoma";

fontsize="100%";

fontstyle="normal";

headerbgcolor="#f5f5f5";

headerborder=1;

headercolor="#000099";

image="menu/18_blank.gif";

imagepadding=3;

menubgimage="menu/fundo_menu_vertical_novo.gif"; // imagem submenus fundo

offbgcolor="transparent";

offcolor="#000000";

onbgcolor="#BFBFBF";

onborder="1px solid #999999";

oncolor="#000000";

onsubimage="menu/on_13x13_greyboxed.gif";

outfilter="randomdissolve(duration=0.2)";

overfilter="Fade(duration=0.1);Alpha(opacity=95);Shadow(color=#777777', Direction=135, Strength=3)";

padding=3;

pagebgcolor="#f5f5f5";

pagecolor="#000066";

pageimage="menu/db_red.gif";

separatoralign="right";

separatorcolor="#999999";

separatorpadding=1;

separatorwidth="85%";

subimage="menu/black_13x13_greyboxed.gif";

menubgcolor="#CFE2D1";

}



with(teste=new menuname("Sample mainmenu")){

alwaysvisible=1;

left=38;

margin=2;

orientation="horizontal";

style=horizStyle;

top=100;



<? 	if (returnAcess('CADAGENTE') == 'N' && returnAcess('IAF_CAD_PESQUISA') == 'N' && returnAcess('CADIAF_SUBITEM_INDIC') == 'N' && returnAcess('CADIAF_INDICADOR_I') == 'N' && returnAcess('CADIAF_INDICADOR') == 'N' && returnAcess('CADVINCSANJOCOORD') == 'N' && returnAcess('CADPDV_PERGUNTA') == 'N' && returnAcess('CADVINCSERVEQUIPPROD') == 'N' && returnAcess('CADCLIENTE') == 'N' && returnAcess('CADTIPOSERVICO') == 'N' && returnAcess('CADVINCULOEQUIPE') == 'N' && returnAcess('CADEQUIPE') == 'N' && returnAcess('CADUSUARIO') == 'N' && returnAcess('CADVINCULOCLIENTE') == 'N' && returnAcess('CADDEFEITO') == 'N' && returnAcess('CADCONTATO') == 'N' && returnAcess('CADTRANSP') == 'N') {

	}

	else{?>

		aI("showmenu=Cadastro;text=Cadastros;");

	<? }?>



<? if($_SESSION['Menu'] == 2){ ?>

	<? 	if (returnAcess('WFAREC_CONSCHAT') == 'N' && returnAcess('WFAREC_INC') == 'N' && returnAcess('WFAREC_CONS') == 'N' && returnAcess('WFAREC_EMITIRNF') == 'N') {

	}

	else{?>

		aI("showmenu=Servico_Cliente;text=Usuário;");

	<? }?>

	

	<? 	if (returnAcess('SERV_GER_SOLICMATERIAL') == 'N' && returnAcess('SERV_RET_RELPENDENCIA') == 'N' && returnAcess('SERV_RET_PENDENC') == 'N' && returnAcess('SERV_RET_PENDEQUIP') == 'N' && returnAcess('SERV_RET_PENDCLIENTE') == 'N') {

	}

	else{?>

		aI("showmenu=servico_retaguarda;text=Retaguarda;");

	<? }?>

	

	<? 	if (returnAcess('SERV_PARC_PENDEQUIPE') == 'N' && returnAcess('SERV_PARC_SOLICCOLET') == 'N' && returnAcess('SERV_PARC_COLETACLI') == 'N' && returnAcess('SERV_PARC_CHEGADACOL') == 'N') {

	}

	else{?>

		aI("showmenu=servico_parceiro;text=Parceiros;");

	<? }?>

	

	aI("showmenu=relatorio_servico;text=Relatórios;");

	

<? } ?>





<? if($_SESSION['Menu'] != "2" && $_SESSION['Menu'] != "4" && $_SESSION['Menu'] != "5" && $_SESSION['Menu'] != "6"){ ?>

	<? 	if (returnAcess('INCRECLAMACAO') == 'N' && returnAcess('CLIPESQRECLAMACAO') == 'N' && returnAcess('CLINFEEMITIR') == 'N'  && returnAcess('CLIEN_INATIVAPRENF') == 'N') {

	}

	else{?>

		aI("showmenu=lancamento;text=Cliente;");

	<? }?>

	

	<? 	if (returnAcess('ADMV_CONSEMAILENV') == 'N' && returnAcess('REL_PARES_FABRICA') == 'N' && returnAcess('ARZ_AVALIPENDENTE') == 'N' && returnAcess('ARZ_CONS_PRENF') == 'N' && returnAcess('ARZ_CONS_INDIV') == 'N' && returnAcess('ARZCONSAVALIACAO') == 'N' && returnAcess('ARZ_AUTORIZACAOCOLET') == 'N' && returnAcess('ARZ_RECEBTOAREZZO') == 'N' && returnAcess('ARZ_GERAIMPORTACAO') == 'N') {

	}

	else{?>

		aI("showmenu=retaguarda;text=Retaguarda;");

	<? }?>

	

	<? 	if (returnAcess('TRANS_COLETACLIENTE') == 'N' && returnAcess('TRANS_CONFTRANSCONT') == 'N' && returnAcess('FORN_AVALREAL') == 'N' && returnAcess('FORN_CONFRECBTO') == 'N' && returnAcess('FORN_CREDITOPEND') == 'N') {

		}

		else{?>

			aI("showmenu=Parceiros;text=Parceiros;");

	<? } ?>

	

	aI("showmenu=relatorio;text=Relatórios;");

	

	



<? } ?>

<? 	if (returnAcess('CONFIG_PROGRAMAS') == 'N') {

}

else{?>

	aI("showmenu=Configurações;text=Configurações;");

<? } ?>



<? 	if (returnAcess('DES_UTIL_SERV_ALTNF') == 'N' && returnAcess('DES_UTIL_IAF_ALTSTATUS') == 'N' && returnAcess('DES_UTIL_SERV_DEL') == 'N' && returnAcess('DES_UTILITARIO_RAR') == 'N' && returnAcess('DES_UTIL_ICMS') == 'N' && returnAcess('DES_UTIL_IMPORT_DATA') == 'N' && returnAcess('DES_UTIL_ALT_DATA') == 'N' && returnAcess('DES_UTIL_ALT_SERIE') == 'N' && returnAcess('DES_UTIL_ALT_NNF') == 'N' && returnAcess('DES_UTIL_ALT_FAB') == 'N') {

}

else{?>

	aI("showmenu=desenvolvimento;text=Utilitários;");

<? }?>



aI("showmenu=support;text=Ajuda;");

aI("showmenu=Alternar;text=Alternar;");



}



with(teste=new menuname("Parceiros")){

margin=3;

overflow="scroll";

style=vertStyle;

	<? 	if (returnAcess('TRANS_COLETACLIENTE') == 'N' && returnAcess('TRANS_CONFTRANSCONT') == 'N') {

		}

		else{?>

			aI("showmenu=transportadora;text=Transportadora;");

	<? } ?>

	<? 	if (returnAcess('FORN_AVALREAL') == 'N' && returnAcess('FORN_CONFRECBTO') == 'N' && returnAcess('FORN_CREDITOPEND') == 'N') {

		}

		else{?>

			aI("showmenu=fornecedor;text=Fornecedor;");

	<? } ?>

}



with(teste=new menuname("fornecedor")){

margin=3;

overflow="scroll";

style=vertStyle;

	<? if (returnAcess('FORN_AVALREAL') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Avaliações realizadas;url=pesq_avaliacoes_realizadas_forn.php;");

	<? } ?>

	<? if (returnAcess('FORN_CONFRECBTO') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Confirmação de recebimento;url=pesq_forne_conf_recebto.php;");

	<? } ?>

	<? if (returnAcess('FORN_CREDITOPEND') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Créditos pendentes;url=pesq_forne_credito.php;");

	<? } ?>

}



with(teste=new menuname("Cadastro")){

margin=3;

style=vertStyle;

top="offset=2";

<? if (returnAcess('CADCLIENTE') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Cadastro de cliente;url=pesq_cliente.php;");

<? } ?>



<? if (returnAcess('CADOPERADORLOJA') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Cadastro de Operador Loja;url=pesq_operadorloja.php;");

<? } ?>



<? if (returnAcess('CADUSUARIO') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Cadastro de usuários;url=pesq_usuarios.php;");

<? } ?>



<? if (returnAcess('CADFABRICANTE') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Cadastro de fabricante;url=pesq_fabricante.php;");

<? } ?>



<? if (returnAcess('CADAGENTE') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Cadastro de agente;url=pesq_agente.php;");

<? } ?>



<? if (returnAcess('CADVINCULOCLIENTE') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Vinculação de usuário x cliente;url=pesq_usuarioxcliente.php;");

<? } ?>



<? if (returnAcess('CADVINCULOFORNECEDOR') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Vinculação de usuário x fornecedor;url=pesq_usuarioxfornecedor.php;");

<? } ?>



<? if (returnAcess('CADDEFEITO') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Cadastro de grupos de defeitos ;url=pesq_defeitos_grupo.php;");

<? } ?>



<? if (returnAcess('CADDEFEITO') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Cadastro de sub-grupos de defeitos ;url=pesq_defeitos_subgrupo.php;");

<? } ?>



<? if (returnAcess('CADMATERIALGRUPO') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Cadastro de grupos de material ;url=pesq_material_grupo.php;");

<? } ?>



<? if (returnAcess('CADFABRICA') != 'N') { ?>

	//aI("image=menu/18_license.gif;text=Cadastro de fábrica;url=pesq_fabricas.php;");

<? } ?>



<? if (returnAcess('CADCONTATO') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Cadastro de contatos ;url=pesq_contato.php;");

<? } ?>



<? if (returnAcess('CADTRANSP') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Cadastro de transportadora ;url=pesq_transportadoras.php;");

<? } ?>



}



with(teste=new menuname("lancamento")){

margin=3;

style=vertStyle;

top="offset=2";

<? if (returnAcess('INCRECLAMACAO') != 'N') { ?>

	aI("image=menu/18_version.gif;text=Inclusão de reclamação;url=pesq_reclamacao.php;");

<? } ?>



<? if (returnAcess('CLIPESQRECLAMACAO') != 'N') { ?>

	aI("image=menu/18_product.gif;text=Avaliações realizadas;url=pesq_avaliacoes_reliazadas.php;");

<? } ?>



<? if (returnAcess('CLINFEEMITIR') != 'N') { ?>

	aI("image=menu/18_contact.gif;text=Pendência de NF a emitir;url=pesq_nf_emitir.php;");

<? } ?>



<? if (returnAcess('INCRECLAMACAO') != 'N') { ?>

	aI("image=menu/18_contact.gif;text=Cancelamento de reclamação;url=pesq_cancelamento.php;");

<? } ?>



<? if (returnAcess('CLIEN_INATIVAPRENF') != 'N') { ?>

	aI("image=menu/18_freelic.gif;text=Consulta pré-notas inativas;url=pesq_prenf_inativa.php?cliente=S;");

<? } ?>



<? if (returnAcess('WFAREC_EMITIRNF') != 'N' && $_SESSION['Menu'] == "3") { ?>

	aI("image=menu/18_license.gif;text=Consulta log de e-mail pré-nota;url=pesq_prenf_logemail.php;");

<? } ?>

}



with(teste=new menuname("retaguarda")){

margin=3;

style=vertStyle;

top="offset=2";

<? if (returnAcess('ARZ_AVALIPENDENTE') != 'N') { ?>

	aI("image=menu/18_quick.gif;text=Avaliações pendentes;url=pesq_avaliacoes_pendentes.php?Categoria=1,2,3,4;");

<? } ?>

<? if (returnAcess('ARZ_AVALIPENDENTE') != 'N') { ?>

	//aI("separatorsize=1;image=menu/18_quick.gif;text=Avaliações pendentes :: Bolsa - Cinto - Carteira;url=pesq_avaliacoes_pendentes.php?Categoria=2,3,4;");

<? } ?>



<? if (returnAcess('ARZ_CONS_INDIV') != 'N') { ?>

	aI("image=menu/18_product.gif;text=Consulta - individual de reclamação;url=pesq_avaliacoes_individual_arz.php;");

<? } ?>



<? if (returnAcess('ARZ_CONS_PRENF') != 'N') { ?>

	aI("image=menu/18_product.gif;text=Consulta - pré-nota;url=pesq_retaguarda_prenota.php;");

<? } ?>



<? if (returnAcess('ARZCONSAVALIACAO') != 'N') { ?>

	aI("image=menu/18_product.gif;text=Consulta - avaliações realizadas;url=pesq_avaliacoes_reliazadas_arz.php;");

<? } ?>



<? if (returnAcess('ARZCONSAVALIACAO') != 'N') { ?>

	aI("image=menu/18_product.gif;text=Consulta - avaliações realizadas - resumido;url=pesq_avaliacoes_reliazadas_arz_res.php;");

<? } ?>



aI("showmenu=ger_coleta;text=Gerenciamento de coletas;");



<? if (returnAcess('ARZ_RECEBTOAREZZO') != 'N') { ?>

	//aI("image=menu/18_freelic.gif;text=Confirmação recebimento WEBDevol;url=pesq_receb_arrezo.php;");

<? } ?>



<? if (returnAcess('ARZ_GERAIMPORTACAO') != 'N') { ?>

	//aI("image=menu/18_iis.gif;text=Gerar importação WEBDevol;url=pesq_impor_arezzo.php;");

<? } ?>



<? if (returnAcess('CONS_PESQUISA') != 'N') { ?>

	aI("image=menu/18_faq.gif;text=Consulta pesquisa de satisfação;url=pesq_satisfacao.php;");

<? } ?>



<? if (returnAcess('REL_PARES_FABRICA') != 'N') { ?>

	aI("image=menu/18_faq.gif;text=Relatório - Pares x Fábrica;url=rel_fabrica_nf.php;");

<? } ?>



<? if (returnAcess('REL_ARQUIVO_CSV') != 'N') { ?>

	aI("image=menu/18_faq.gif;text=Relatório Geral - Gerar arquivo CSV;url=rel_relatorio_csv.php;");

<? } ?>



<? if (returnAcess('ADMV_CONSPRENFINATIV') != 'N') { ?>

	aI("image=menu/18_freelic.gif;text=Assinalar pré-notas vencidas;url=pesq_prenf_vencida.php;");

<? } ?>

<? if (returnAcess('ADMV_INATIVAPRENF') != 'N') { ?>

	aI("image=menu/18_freelic.gif;text=Consulta pré-notas inativas;url=pesq_prenf_inativa.php;");

<? } ?>

<? if (returnAcess('ADMV_CONSRARINATIVA') != 'N') { ?>

	//aI("image=menu/18_freelic.gif;text=Consulta reclamações inativas;url=pesq_reclamacao_inativa.php;");

<? } ?>



<? 	if (returnAcess('ADMV_CONSPRENFINATIV') == 'N' && returnAcess('ADMV_INATIVAPRENF') == 'N' && returnAcess('ADMV_CONSRARINATIVA') == 'N') {

	}

	else{?>

<? if (returnAcess('ADMV_CONSEMAILENV') != 'N') { ?>

	aI("image=menu/18_freelic.gif;text=Consulta de e-mails enviados;url=pesq_emails_enviados.php;");

<? } ?>



<? if (returnAcess('ADMV_CONSLOGEXCLUSAO') != 'N') { ?>

	aI("image=menu/18_freelic.gif;text=Consulta de exclusão de reclamação/pré-nota;url=pesq_log_exclusao.php;");

<? } ?>

		//aI("showmenu=ADMV;text=ADMV;");

<? } ?>





}



with(teste=new menuname("ger_coleta")){

margin=3;

overflow="scroll";

style=vertStyle;

	//aI("showmenu=gercoleta_calcado;text=Calçados;");

	//aI("showmenu=gercoleta_license;text=Bolsa - Cinto - Carteira;");

	aI("showmenu=gercoleta_geral;text=Geral;");

}



with(teste=new menuname("gercoleta_calcado")){

margin=3;

overflow="scroll";

style=vertStyle;



<? if (returnAcess('ARZ_AUTORIZACAOCOLET') != 'N') { ?>

	aI("image=menu/18_product.gif;text=Gerar pré-notas para cliente;url=pesq_autorizacao_coleta.php?Categoria=1,2,3,4;");

<? } ?>

}



with(teste=new menuname("gercoleta_license")){

margin=3;

overflow="scroll";

style=vertStyle;



<? if (returnAcess('ARZ_AUTORIZACAOCOLET') != 'N') { ?>

	aI("image=menu/18_product.gif;text=Gerar pré-notas para cliente;url=pesq_autorizacao_coleta.php?Categoria=2,3,4;");

<? } ?>

}



with(teste=new menuname("gercoleta_geral")){

margin=3;

overflow="scroll";

style=vertStyle;



<? if (returnAcess('ARZ_AUTORIZACAOCOLET') != 'N') { ?>

	aI("image=menu/18_product.gif;text=Gerar pré-notas para cliente;url=pesq_autorizacao_coleta.php?Categoria=1,2,3,4;");

<? } ?>

}



with(teste=new menuname("ADMV")){

margin=3;

style=vertStyle;

<? if (returnAcess('ADMV_CONSPRENFINATIV') != 'N') { ?>

	aI("image=menu/18_freelic.gif;text=Assinalar pré-notas vencidas;url=pesq_prenf_vencida.php;");

<? } ?>

<? if (returnAcess('ADMV_INATIVAPRENF') != 'N') { ?>

	aI("image=menu/18_freelic.gif;text=Consulta pré-notas inativas;url=pesq_prenf_inativa.php;");

<? } ?>

<? if (returnAcess('ADMV_CONSRARINATIVA') != 'N') { ?>

	//aI("image=menu/18_freelic.gif;text=Consulta reclamações inativas;url=pesq_reclamacao_inativa.php;");

<? } ?>





}



with(teste=new menuname("transportadora")){

margin=3;

style=vertStyle;

<? if (TipoUsuario() == 'A' || TipoUsuario() == 'C'){?>

	//aI("showmenu=transportadora_calcado;text=Calçados;");

	//aI("showmenu=transportadora_calcado;text=Coletas para WEBDevol;");

<? }?>

<? if (TipoUsuario() == 'A' || TipoUsuario() == 'L'){?>

	//aI("showmenu=transportadora_license;text=Bolsa - Cinto - Carteira;");

	aI("showmenu=transportadora_license;text=Coletas para o Fabricante;");

<? }?>

	//aI("showmenu=transportadora_servico;text=Coletas de WFA Serviços;");

}



with(teste=new menuname("transportadora_calcado")){

	margin=3;

	overflow="scroll";

	style=vertStyle;

	<? if (returnAcess('TRANS_SOLCOLETA') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Solicitação de coleta no cliente;url=pesq_solic_coleta.php?Ordem=1&Categoria=1,2,3,4;");

	<? } ?>

	<? if (returnAcess('TRANS_COLETACLIENTE') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Confirmação de coleta no cliente;url=pesq_conf_coleta.php?Ordem=1&Categoria=1,2,3,4;");

	<? } ?>

	<? if (returnAcess('TRANS_CONFTRANSCONT') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Confirmação recebimento Transcontinental;url=pesq_receb_trans.php?Ordem=1&Categoria=1,2,3,4;");

	<? } ?>

}



with(teste=new menuname("transportadora_license")){

	margin=3;

	overflow="scroll";

	style=vertStyle;

	<? if (returnAcess('TRANS_SOLCOLETA') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Solicitação de coleta no cliente;url=pesq_solic_coleta.php?Categoria=2;");

	<? } ?>

	<? if (returnAcess('TRANS_COLETACLIENTE') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Confirmação de coleta no cliente;url=pesq_conf_coleta.php?Categoria=2;");

	<? } ?>

	<? if (returnAcess('TRANS_CONFTRANSCONT') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Confirmação recebimento Transcontinental;url=pesq_receb_trans.php?Categoria=2;");

	<? } ?>

}



with(teste=new menuname("transportadora_servico")){

	margin=3;

	overflow="scroll";

	style=vertStyle;

	<? if (returnAcess('SERV_PARC_SOLICCOLET') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Solicitação de coleta no cliente;url=pesq_wfarec_solic_coleta.php?Ordem=1&Categoria=1,2,3,4;");

	<? } ?>

	<? if (returnAcess('SERV_PARC_COLETACLI') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Confirmação de coleta no cliente;url=pesq_wfarec_conf_coleta.php?Ordem=1&Categoria=1,2,3,4;");

	<? } ?>

	<? if (returnAcess('SERV_PARC_CHEGADACOL') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Confirmação recebimento Transcontinental;url=pesq_wfarec_receb_trans.php?Ordem=1&Categoria=1,2,3,4;");

	<? } ?>

}

	





with(teste=new menuname("support")){

margin=3;

style=vertStyle;

top="offset=2";

aI("image=menu/18_color.gif;text=Alterar Senha;url=altera_senha.php;");

aI("image=menu/18_color.gif;text=Ajuda;url=help.php;");

aI("image=menu/18_testimonial.gif;text=Sobre o Sistema;url=about.php;");

//aI("image=menu/18_testimonial.gif;text=Pesquisa de satisfação;url=pesquisa_satisfacao.php;");



<? if (returnAcess('CONS_PESQUISA_INST') != 'N') { ?>

	aI("image=menu/18_freelic.gif;text=Pesquisas de satisfação preenchidas;url=pesq_satisfacao_instrutor.php;");

<? } ?>



}



with(teste=new menuname("relatorio")){

margin=3;

overflow="scroll";

style=vertStyle;



	<? if (TipoUsuario() == 'A' || TipoUsuario() == 'C'){?>

		aI("showmenu=relatorio_calcado;text=Calçados;");

	<? }?>



	<? if (TipoUsuario() == 'A' || TipoUsuario() == 'L'){?>

		//aI("showmenu=relatorio_license;text=Bolsa - Cinto - Carteira;");

	<? }?>

}



with(teste=new menuname("relatorio_calcado")){

	margin=3;

	overflow="scroll";

	style=vertStyle;

	aI("text=Créditos pendentes;url=rel_creditos_pendentes.php?Categoria=1,2,3,4;")
	
	aI("text=Índice geral mensal;url=rel_indice_geral_mensal.php?Categoria=1,2,3,4;")

	aI("text=Índice geral mensal - fábrica;url=rel_indice_geral_mensal_fabrica.php?Categoria=1,2,3,4;")

	aI("text=Índice geral fábrica - mensal;url=rel_indice_geral_fabrica_mensal.php?Categoria=1,2,3,4;")

	aI("text=Índice geral mensal - linha;url=rel_indice_geral_mensal_linha.php?Categoria=1,2,3,4;")

	aI("text=Índice geral mensal - modelo;url=rel_indice_geral_mensal_modelo.php?Categoria=1,2,3,4;")

	aI("text=Índice de devolução x fábrica (com pares recebidos);url=rel_indice_devolucaoxfabrica.php?Categoria=1,2,3,4;")

	aI("text=Índice de defeitos;url=rel_indice_defeitos.php?Categoria=1,2,3,4;")

	aI("text=Índice de defeitos x fábrica;url=rel_indice_defeitoxfabrica.php?Categoria=1,2,3,4;")

	aI("text=Índice de defeitos x fábrica x linha x modelo x material;url=rel_indice_defeitoxfabricalinmodmat.php?Categoria=1,2,3,4;")

	aI("text=Índice de defeitos x coleção;url=rel_indice_defeitosxcolecao.php?Categoria=1,2,3,4;")

	aI("text=Índice de defeitos x linha;url=rel_indice_defeitosxlinha.php?Categoria=1,2,3,4;")

	aI("text=Índice de defeitos x linha x modelo;url=rel_indice_defeitosxmodelo.php?Categoria=1,2,3,4;")

	aI("text=Índice de defeitos x fábrica x linha;url=rel_indice_defeitosxlinhaxfabrica.php?Categoria=1,2,3,4;")

	aI("text=Índice de reclamações x clientes;url=rel_indice_reclamacoesxclientes.php?Categoria=1,2,3,4;")

	aI("text=Índice de defeitos x nº par;url=rel_indice_defeitosxpar.php?Categoria=1,2,3,4;")

	aI("text=Índice de defeitos x estado;url=rel_indice_defeitosxestado.php?Categoria=1,2,3,4;")

	aI("text=Índice de defeitos - resumo;url=rel_indice_defeitos_resumo.php?Categoria=1,2,3,4;")

	aI("text=Gerenciamento de etapas;url=rel_gerenciamento_etapa.php?Categoria=1,2,3,4;")

	aI("text=Relatório de etapas pendentes;url=rel_etapa_pendente.php?Categoria=1,2,3,4;")

}



with(teste=new menuname("relatorio_license")){

	margin=3;

	overflow="scroll";

	style=vertStyle;

	aI("text=Índice geral mensal;url=rel_indice_geral_mensal.php?Categoria=2,3,4;")

	aI("text=Índice geral mensal - fábrica;url=rel_indice_geral_mensal_fabrica.php?Categoria=2,3,4;")

	aI("text=Índice geral fábrica - mensal;url=rel_indice_geral_fabrica_mensal.php?Categoria=2,3,4;")

	aI("text=Índice geral mensal - linha;url=rel_indice_geral_mensal_linha.php?Categoria=2,3,4;")

	aI("text=Índice geral mensal - modelo;url=rel_indice_geral_mensal_modelo.php?Categoria=2,3,4;")

	aI("text=Índice de devolução x fábrica (com pares recebidos);url=rel_indice_devolucaoxfabrica.php?Categoria=2,3,4;")

	aI("text=Índice de defeitos;url=rel_indice_defeitos.php?Categoria=2,3,4;")

	aI("text=Índice de defeitos x fábrica;url=rel_indice_defeitoxfabrica.php?Categoria=2,3,4;")

	aI("text=Índice de defeitos x fábrica x linha x modelo x material;url=rel_indice_defeitoxfabricalinmodmat.php?Categoria=2,3,4;")

	aI("text=Índice de defeitos x coleção;url=rel_indice_defeitosxcolecao.php?Categoria=2,3,4;")

	aI("text=Índice de defeitos x linha;url=rel_indice_defeitosxlinha.php?Categoria=2,3,4;")

	aI("text=Índice de defeitos x linha x modelo;url=rel_indice_defeitosxmodelo.php?Categoria=2,3,4;")

	aI("text=Índice de defeitos x fábrica x linha;url=rel_indice_defeitosxlinhaxfabrica.php?Categoria=2,3,4;")

	aI("text=Índice de reclamações x clientes;url=rel_indice_reclamacoesxclientes.php?Categoria=2,3,4;")

	aI("text=Índice de defeitos x estado;url=rel_indice_defeitosxestado.php?Categoria=2,3,4;")

	aI("text=Índice de defeitos - resumo;url=rel_indice_defeitos_resumo.php?Categoria=2,3,4;")

	aI("text=Gerenciamento de etapas;url=rel_gerenciamento_etapa.php?Categoria=2,3,4;")

	aI("text=Relatório de etapas pendentes;url=rel_etapa_pendente.php?Categoria=2,3,4;")

}



with(teste=new menuname("relatorio_servico")){

	margin=3;

	overflow="scroll";

	style=vertStyle;

	aI("text=Gerenciamento de etapas;url=rel_gerenciamento_etapa_servico.php;")

	aI("text=Índice Geral Mensal - Serviços;url=rel_servico_indice_geral.php;")

	aI("text=Serviços x prazos;url=rel_servico_prazo.php;")

	aI("text=Serviços x RAR Comercial;url=rel_servico_rarcomercial.php;")

	aI("text=Serviços x Débito/Crédito;url=rel_servico_debitocredito.php;")

	aI("text=Pendência de entrega - Transcontinental;url=rel_servico_pendenciaentrega.php;")

	aI("text=Listagem de Serviço x Equipe x Produto;url=rel_servico_equipe_produto.php;")

	aI("text=Listagem de tipos de serviço;url=rel_servico_tiposervico.php;")

	aI("text=Relatório de solicitação material x grupo material;url=rel_servico_grupomaterial.php;")

	

}



with(teste=new menuname("Configurações")){

margin=3;

style=vertStyle;

top="offset=2";



<? if (returnAcess('CONFIG_PROGRAMAS') != 'N') { ?>

	aI("image=menu/18_integration.gif;text=Cadastro de programas;url=pesq_programas.php;");

<? } ?>

}

with(teste=new menuname("ajuda")){

margin=3;

style=vertStyle;

top="offset=2";

aI("image=menu/18_color.gif;text=Ajuda;url=../help.php;");

}



with(teste=new menuname("Alternar")){

margin=3;

style=vertStyle;

top="offset=2";

<? if (returnAcess('ALTERNAR_SERVICO') != 'N') { ?>

	//aI("image=menu/18_color.gif;text=WFA Serviços;url=redireciona.php?Menu=2;");

<? } ?>



<? if (returnAcess('ALTERNAR_TECNICO_FR') != 'N') { ?>

	aI("image=menu/18_color.gif;text=WFA Técnico Franquia;url=redireciona.php?Menu=1");

<? } ?>



<? if (returnAcess('ALTERNAR_TECNICO_MM') != 'N') { ?>

	aI("image=menu/18_color.gif;text=WFA Técnico Multimarca;url=redireciona.php?Menu=3");

<? } ?>



<? if (returnAcess('ALTERNAR_RV') != 'N') { ?>

	//aI("image=menu/18_color.gif;text=WFA RV;url=redireciona.php?Menu=4");

<? } ?>



<? if (returnAcess('ALTERNAR_IAF') != 'N') { ?>

	//aI("image=menu/18_color.gif;text=WFA IAF;url=redireciona.php?Menu=5");

<? } ?>



<? 

//if ($_SESSION['sId'] == "1" || $_SESSION['sId'] == "1278393"){

	if (returnAcess('ALTERNAR_PESQUISAS') != 'N') { ?>

		//aI("image=menu/18_color.gif;text=WFA Pesquisas;url=redireciona.php?Menu=6");

<? 	}

//}

?>

	

}



with(teste=new menuname("desenvolvimento")){

margin=3;

style=vertStyle;

top="offset=2";

<? if (returnAcess('DES_UTILITARIO_PRENF') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Deletar pré-nota;url=util_deleta_prenota.php;");

<? } ?>

<? if (returnAcess('DES_UTILITARIO_RAR') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Deletar reclamação;url=util_deleta_rar.php;");

<? } ?>

<? if (returnAcess('DES_VERIFY_SINC') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Verificar status sincronismo;url=util_status_sinc.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_VINCCLIENTE') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Vinculação de usuários x clientes;url=util_usuariosxloja.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_ICMS') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Tirar ICMS da Nota Fiscal;url=util_tira_icms.php;");

<? } ?>

<? if (returnAcess('DES_MANUT_GRUPOMAT') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Manutenção Grupos de Materiais;url=util_manut_grupo_material.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_IMPORT_DATA') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Voltar pré-nota para importação;url=util_import_data.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_ALT_DATA') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Alterar data da pré-nota;url=util_alt_data.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_ALT_SERIE') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Alterar série da pré-nota;url=util_alt_serie.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_ALT_NNF') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Alterar Número da Nota Fiscal;url=util_alt_nnota.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_ALT_FAB') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Alteração de fabricante;url=util_alt_fab.php;");

<? } ?>

<? if (returnAcess('UTIL_ALTEREMIT_PRENF') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Alterar emitente pré-nota;url=util_alt_emitente_prenota.php;");

<? } ?>



<? if (returnAcess('DES_UTIL_HISTORICO') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Lançamento de reclamações anteriores;url=util_lanca_historico.php;");

	aI("image=menu/18_license.gif;text=Lançamento de reclamações anteriores - Improcendentes;url=util_lanca_historico_imp.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_CONFIG') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Configurações gerais;url=util_config.php;");

<? } ?>



aI("showmenu=servico_util;text=Serviços;");



<? if (returnAcess('DES_UTIL_IAF_ALTSTATUS') != 'N') { ?>

	aI("image=menu/18_license.gif;text=IAF - Alterar Status;url=util_iaf_alterastatus.php;");

<? } ?>





with(teste=new menuname("servico_util")){

margin=3;

style=vertStyle;

top="offset=2";

<? if (returnAcess('DES_UTIL_SERV_DEL') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Serviço - Deletar serviço;url=util_servico_deleta_servico.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_SERV_ALTNF') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Serviço - Alterar Nº NF Devolução;url=util_servico_alterar_nf_devol.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_SERV_DELNFDEVOL') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Serviço - Deletar NF Devolução;url=util_servico_deleta_nfdevol.php;");

<? } ?>

<? if (returnAcess('DES_UTIL_SERV_STATUS') != 'N') { ?>

	aI("image=menu/18_license.gif;text=Serviço - Trocar status serviço;url=util_servico_troca_status.php;");

<? } ?>

	

}



with(teste=new menuname("servico_retaguarda")){

	margin=3;

	style=vertStyle;

	top="offset=2";

	<? if (returnAcess('SERV_RET_PENDENC') != 'N') { ?>

		aI("image=menu/18_quick.gif;text=Avaliações pendentes - anjo;url=pesq_wfarec_avaliacaopendente.php;");

	<? } ?>

	

	<? if (returnAcess('SERV_RET_PENDEQUIP') != 'N') { ?>

		aI("image=menu/18_quick.gif;text=Avaliações pendentes - equipe;url=pesq_wfarec_avaliacaopendequipe.php;");

	<? } ?>

	

	<? if (returnAcess('SERV_RET_PENDCLIENTE') != 'N') { ?>

		aI("image=menu/18_quick.gif;text=Avaliações pendentes - envio para cliente;url=pesq_wfarec_avaliacaopendcliente.php;");

	<? } ?>

	

	<? if (returnAcess('SERV_GER_SOLICMATERIAL') != 'N') { ?>

		aI("image=menu/18_quick.gif;text=Gerenciamento de solicitação de materiais;url=pesq_wfarec_ger_solicitacaomaterial.php;");

	<? } ?>

	

	<? if (returnAcess('SERV_RET_RELPENDENCIA') != 'N') { ?>

		aI("image=menu/18_quick.gif;text=Relatório de Pendências - Anjo;url=rel_wfarec_pendenciaetapa.php;");

	<? } ?>

}



with(teste=new menuname("servico_parceiro")){

	margin=3;

	style=vertStyle;

	top="offset=2";

	<? if (returnAcess('SERV_PARC_PENDEQUIPE') != 'N') { ?>

		aI("image=menu/18_quick.gif;text=Avaliações pendentes - equipe;url=pesq_wfarec_avaliacaopendequipe.php;");

	<? } ?>

	<? if (returnAcess('SERV_PARC_SOLICCOLET') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Solicitação de coleta no cliente;url=pesq_wfarec_solic_coleta.php?Ordem=1&Categoria=1,2,3,4;");

	<? } ?>

	<? if (returnAcess('SERV_PARC_COLETACLI') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Confirmação de coleta no cliente;url=pesq_wfarec_conf_coleta.php?Ordem=1&Categoria=1,2,3,4;");

	<? } ?>

	<? if (returnAcess('SERV_PARC_CHEGADACOL') != 'N') { ?>

		aI("image=menu/18_freelic.gif;text=Confirmação recebimento Transcontinental;url=pesq_wfarec_receb_trans.php?Ordem=1&Categoria=1,2,3,4;");

	<? } ?>

}



with(teste=new menuname("PDV_Cliente")){

margin=3;

style=vertStyle;

top="offset=2";

	//aI("image=menu/18_license.gif;text=Consulta de visitas;url=#;");

}



with(teste=new menuname("PDV_Consultor")){

margin=3;

style=vertStyle;

top="offset=2";

	<? if (returnAcess('PDV_CONS_INCLUSAO') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Apropriação de horas;url=pesq_pdv_inclusao.php;");

	<? } ?>

	

	<? if (returnAcess('PDV_CONS_CONS_ATIV') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Consulta de apropriação de horas;url=pesq_pdv_cons_atividade.php;");

	<? } ?>

	

	<? if (returnAcess('PDV_CONS_CONS_EMAIL') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Consulta de envio/recebimento de emails;url=pesq_pdv_cons_email.php;");

	<? } ?>

	

	

	<? if (returnAcess('RV_ENVIO_EMAILRVS') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Enviar email RV para fraqueados;url=pesq_pdv_enviaemail.php;");

	<? } ?>

}



with(teste=new menuname("IAF_Cliente")){

margin=3;

style=vertStyle;

top="offset=2";

	<? if (returnAcess('IAF_CLIEN_CONSQUEST') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Consultar IAF;url=pesq_iaf_cliente.php;");

	<? } ?>

}



with(teste=new menuname("WFAPesq_Cliente")){

margin=3;

style=vertStyle;

top="offset=2";

	<? if (returnAcess('PESQWFA_CLIEN_RESPPERG') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Responder nova pesquisa;url=pesq_wfapesq_selpesquisa.php;");

	<? } ?>

	<? if (returnAcess('PESQWFA_CLIEN_PERGUPEND') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Responder pesquisa pendente;url=pesq_wfapesq_pendente.php;");

	<? } ?>

	<? if (returnAcess('PESQWFA_CLIEN_CONSQUEST') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Consultar Pesquisa;url=pesq_wfapesq_cliente.php;");

	<? } ?>

}



with(teste=new menuname("IAF_Consultor")){

margin=3;

style=vertStyle;

top="offset=2";

	<? if (returnAcess('IAF_CONS_INCQUEST') != 'N') { ?>

		<? //if ($_SESSION['sId'] == "9638"){?>

			aI("image=menu/18_license.gif;text=Responder novo IAF;url=pesq_iaf_selquestionario.php;");

		<? //} ?>

	<? } ?>

	

	<? if (returnAcess('IAF_CONS_INCQUEST') != 'N') { ?>

		<? //if ($_SESSION['sId'] == "9638" || $_SESSION['sId'] == "1278393"){?>

			aI("image=menu/18_license.gif;text=Responder IAF Pendente;url=pesq_iaf_responderpendente.php;");

		<? //}else{?>

			//aI("image=menu/18_license.gif;text=Responder questionário;url=manutencao.php;");

		<? //} ?>

	<? } ?>

	

	<? if (returnAcess('IAF_CONS_CONSQUEST') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Consultar IAF;url=pesq_iaf_consquestionario.php;");

	<? } ?>

	

	<? if (returnAcess('IAF_CONS_STATQUEST') != 'N') { ?>

		//aI("image=menu/18_license.gif;text=Consulta status questionário;url=pesq_iaf_consstatquestionario.php;");

	<? } ?>

	

	<? if (returnAcess('IAF_GER_PLANOACAO') != 'N') { ?>

		aI("image=menu/18_license.gif;text=Gerenciamento de Planos de Ação;url=pesq_iaf_gerplanoacao.php;");

	<? } ?>

	

}



with(teste=new menuname("PDV_Relatorio")){

margin=3;

style=vertStyle;

top="offset=2";

	aI("image=menu/18_license.gif;text=Análise de apropriação de horas;url=rel_pdv_analise_horas.php;");

	aI("image=menu/18_license.gif;text=Relatório de visitas;url=rel_pdv_visita.php;");

	aI("image=menu/18_license.gif;text=Relatório de telemarketing;url=rel_pdv_telemarketing.php;");

	aI("image=menu/18_license.gif;text=Gerenciamento de apropriação de horas;url=rel_pdv_gerenciamentoapropriacao.php;");

	aI("image=menu/18_license.gif;text=Gerenciamento de envio/recebimento de e-mails;url=rel_pdv_gerenciamentoemail.php;");

}



with(teste=new menuname("IAF_Relatorio")){

margin=3;

style=vertStyle;

top="offset=2";

	<? //if ($_SESSION['sId'] == "9638" || $_SESSION['sId'] == "1278393"){ ?>

		aI("image=menu/18_license.gif;text=Tabela resumo;url=rel_iaf_tabela.php?tipo=1;");

		aI("image=menu/18_license.gif;text=Tabela de questionário;url=rel_iaf_tabela.php?tipo=2;");

		aI("image=menu/18_license.gif;text=Tabela de plano de ação;url=rel_iaf_tabela.php?tipo=3;");

		aI("image=menu/18_license.gif;text=Tabela de planejamento;url=rel_iaf_tabela.php?tipo=4;");

	<? //} ?>

}



with(teste=new menuname("WFAPesq_Relatorio")){

margin=3;

style=vertStyle;

top="offset=2";

	<? //if ($_SESSION['sId'] == "1"){ ?>

		aI("image=menu/18_license.gif;text=Relatório geral;url=rel_wfapesq_geral.php;");

	<? //} ?>

}



}

drawMenus();



