/*Confirma a saída*/
window.onbeforeunload = function() {return "Se você sair, perderá todas as informações não salvas.";}
/*atribui um valor nulo a variavel window.onbeforeunload*/
function Nulo() {
	window.onbeforeunload=null;
}