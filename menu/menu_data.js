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
fontsize="70%"; // tamanho da fonte do menu principal
fontstyle="normal";
headerbgcolor="#AFD1B5";// nao sei
headerborder=0;
headercolor="#000099";
offbgcolor="#ffffff"; // AZUL DO MENU PRINCIPAL "#B3D1EB"
offcolor="#000000";
onbgcolor="black"; // nao sei
onborder="1px solid #999999";
oncolor="#000000";
onsubimage="menu/on_downboxed.gif";
overbgimage="menu/backon_beige.gif"; // imagem rollover sobre menu principal
padding=3;
pagebgcolor="#CFE2D1";
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
fontsize="70%";
fontstyle="normal";
headerbgcolor="#AFD1B5";
headerborder=1;
headercolor="#000099";
image="menu/18_blank.gif";
imagepadding=3;
menubgimage="menu/backoff_green.gif"; // imagem submenus fundo
offbgcolor="transparent";
offcolor="#000000";
onbgcolor="#FEFAD2";
onborder="1px solid #999999";
oncolor="#000000";
onsubimage="menu/on_13x13_greyboxed.gif";
outfilter="randomdissolve(duration=0.2)";
overfilter="Fade(duration=0.1);Alpha(opacity=95);Shadow(color=#777777', Direction=135, Strength=3)";
padding=3;
pagebgcolor="#CFE2D1";
pagecolor="#000066";
pageimage="menu/db_red.gif";
separatoralign="right";
separatorcolor="#999999";
separatorpadding=1;
separatorwidth="85%";
subimage="menu/black_13x13_greyboxed.gif";
menubgcolor="#F5F5F5";
}

with(teste=new menuname("Sample mainmenu")){
alwaysvisible=1;
left=38;
margin=2;
orientation="horizontal";
style=horizStyle;
top=100;
aI("showmenu=Cadastro;text=Cadastros;");
aI("showmenu=lancamento;text=Cliente;");
aI("showmenu=retaguarda;text=Retaguarda;");
aI("showmenu=relatorio;text=Relat�rios;");
aI("showmenu=transportadora;text=Transportadora;");
aI("showmenu=Configura��es;text=Configura��es;");
aI("showmenu=support;text=Sobre;url=/about.php;");
aI("showmenu=ajuda;text=Ajuda;url=/help.php;");

}

with(teste=new menuname("Cadastro")){
margin=3;
style=vertStyle;
top="offset=2";
/*aI("image=menu/18_testimonial.gif;text=Cadastro de gerente comercial;url=pesq_gerente_comercial.php;");*/
/*aI("image=menu/18_corporate.gif;text=Cadastro de coordenador;url=pesq_coordenador.php;");*/
/*aI("image=menu/18_nonprofit.gif;text=Cadastro de consultor;url=pesq_consultor.php;");*/
aI("image=menu/18_license.gif;text=Cadastro de cliente;url=pesq_cliente.php;");
aI("image=menu/18_license.gif;text=Cadastro de usu�rios;url=pesq_usuarios.php;");
aI("image=menu/18_license.gif;text=Vincula��o de usu�rio x cliente;url=pesq_usuarioxcliente.php;");
aI("image=menu/18_license.gif;text=Cadastro de defeitos ;url=pesq_defeitos.php;");
aI("image=menu/18_license.gif;text=Cadastro de grupos de defeitos ;url=pesq_defeitos_grupo.php;");
aI("image=menu/18_license.gif;text=Cadastro de sub-grupos de defeitos ;url=pesq_defeitos_subgrupo.php;");
aI("image=menu/18_license.gif;text=Cadastro de f�brica;url=pesq_fabricas.php;");
}

with(teste=new menuname("lancamento")){
margin=3;
style=vertStyle;
top="offset=2";
aI("image=menu/18_version.gif;text=Inclus�o de reclama��o;url=pesq_reclamacao.php;");
aI("image=menu/18_product.gif;text=Avalia��es realizadas;url=pesq_avaliacoes_reliazadas.php;");
aI("image=menu/18_contact.gif;text=Pend�ncia de NF a emitir;url=pesq_nf_emitir.php;");
}

with(teste=new menuname("retaguarda")){
margin=3;
style=vertStyle;
top="offset=2";
aI("separatorsize=1;image=menu/18_quick.gif;text=Avalia��es pendentes;url=pesq_avaliacoes_pendentes.php;");
aI("image=menu/18_product.gif;text=Consulta - avalia��es realizadas;url=pesq_avaliacoes_reliazadas_arz.php;");
aI("image=menu/18_product.gif;text=Gerenciamento de autoriza��o de coleta;url=pesq_autorizacao_coleta.php;");
aI("image=menu/18_freelic.gif;text=Confirma��o recebimento WEBDevol;url=pesq_receb_arrezo.php;");
aI("image=menu/18_iis.gif;text=Gerar importa��o WEBDevol;url=pesq_impor_arezzo.php;");
//aI("image=menu/18_integration.gif;text=Cancelamento de reclama��o;url=pesq_cancelamento.php;");
}

with(teste=new menuname("transportadora")){
margin=3;
style=vertStyle;
aI("image=menu/18_freelic.gif;text=Confirma��o de coleta no cliente;url=pesq_conf_coleta.php;");
aI("image=menu/18_freelic.gif;text=Confirma��o recebimento Transcontinental;url=pesq_receb_trans.php;");



}

with(teste=new menuname("support")){
margin=3;
style=vertStyle;
top="offset=2";
aI("image=menu/18_testimonial.gif;text=Sobre o Sistema1;url=about.php;");
aI("image=menu/18_testimonial.gif;text=Pesquisa de satisfa��o;url=pesquisa_satisfacao.php;");
/*aI("text=Customer Tech Support System;url=/support/;");
aI("image=menu/18_news.gif;separatorsize=1;text=Newsletter Subscription;url=/newsletter.php;");
aI("text=Removing the Forced link to teste;url=/removelink.php;");
aI("image=menu/18_googlemenu.gif;text=Search Engines and the Menu;url=/searchengines_teste.php;");
aI("image=menu/18_tablecell.gif;text=Embedding a Menu inside a Table Cell;url=/tablemenu.php;");
aI("text=Adding Multiple Menus to a Web Page;url=/multiplemenus.php;");
aI("image=menu/18_css.gif;text=CSS Based Menus;url=/cssbasedmenus.php;");
aI("image=menu/18_faq.gif;separatorsize=1;showmenu=Sample faq;text=FAQ;");
aI("text=Apache Web Server Installation;url=/apachesetup.php;");
aI("image=menu/18_iis.gif;text=Internet Information Server Setup;url=/iissetup.php;");*/
}

with(teste=new menuname("consulta")){
margin=3;
style=vertStyle;
aI("image=menu/18_product.gif;text=Avalia��es realizadas;url=pesq_avaliacoes_reliazadas.php;");

}

with(teste=new menuname("relatorio")){
margin=3;
overflow="scroll";
style=vertStyle;
aI("text=�ndice geral;url=rel_indice_geral.php;")
aI("text=�ndice de devolu��o x f�brica;url=rel_indice_devolucaoxfabrica.php;")
aI("text=�ndice de defeitos;url=rel_indice_defeitos.php;")
aI("text=�ndice de defeitos x f�brica;url=rel_indice_defeitoxfabrica.php;")
aI("text=�ndice de defeitos x cole��o;url=rel_indice_defeitosxcolecao.php;")
aI("text=�ndice de defeitos x linha;url=rel_indice_defeitosxlinha.php;")
aI("text=�ndice de defeitos x modelo;url=rel_indice_defeitosxmodelo.php;")
aI("text=�ndice de defeitos x linha x f�brica;url=rel_indice_defeitosxlinhaxfabrica.php;")
aI("text=�ndice de reclama��es x clientes;url=rel_indice_reclamacoesxclientes.php;")
aI("text=�ndice de defeitos x n� par;url=rel_indice_defeitosxpar.php;")
//aI("text=Listagem de cliente x �ltima data de coleta;url=rel_listagem_clientexultimacoleta.php;")
//aI("text=Reclama��es canceladas;url=rel_reclamacoes_canceladas.php;")


}

with(teste=new menuname("Configura��es")){
margin=3;
style=vertStyle;
top="offset=2";
aI("image=menu/18_integration.gif;text=Par�metros do sistema;url=conf_parametros_sistema.php;");
aI("image=menu/18_integration.gif;text=Cadastro de programas;url=pesq_programas.php;");
}
with(teste=new menuname("ajuda")){
margin=3;
style=vertStyle;
top="offset=2";
aI("image=menu/18_color.gif;text=Ajuda;");
}

drawMenus();

