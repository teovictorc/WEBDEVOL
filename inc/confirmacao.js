/*Confirma a sa�da*/
window.onbeforeunload = function() {return "Se voc� sair, perder� todas as informa��es n�o salvas.";}
/*atribui um valor nulo a variavel window.onbeforeunload*/
function Nulo() {
	window.onbeforeunload=null;
}