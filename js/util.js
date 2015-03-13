jQuery(document).ready(function($){
    $(".txt_numero").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
if (navigator.appName.indexOf('Microsoft') !=  - 1) {
    clientNavigator = "IE";
}
else {
    clientNavigator = "Other";
}

function isArray(obj)  {
    if (obj[0]) {
        return true; }
    else {
        return false; }
}

function JSUtilMascara(Campo,Evento,MascaraFormato) {
	
	for (x = 0; x < Campo.value.length; x++) {
		if (MascaraFormato.charAt(x) != "_" && MascaraFormato.charAt(x) != Campo.value.charAt(x)) {
			caracteresValidos = "0123456789";
			Retorno = "";
			for (x = 0; x < Campo.value.length; x++) {
				if (caracteresValidos.indexOf(Campo.value.charAt(x)) != -1) {
					CaracterM = MascaraFormato.charAt(Retorno.length);
					if (CaracterM != "_")
						Retorno+= CaracterM;
					Retorno+= Campo.value.charAt(x);
				}
			}
			Campo.value = Retorno;
		}
	}
	if (Campo.value.length > MascaraFormato.length) {
		Campo.value = Campo.value.substring(0,MascaraFormato.length);
	}
	
	if (!Evento.keyCode)
		Evento.keyCode = Evento.which;
	if (Evento.keyCode != 8) {
		CaracterM = MascaraFormato.charAt(Campo.value.length);
		if (CaracterM != "_" && CaracterM != "")
			Campo.value+= CaracterM;
	}
}

function JSUtilValidaData(Campo,Obrigatorio) {
	Campo = (typeof Campo == "object") ? Campo.value : Campo;

	if (Campo.length != 0) {
		if (Campo.length != 10)
			return false;

		if (!JSUtilValidaNumeros(Campo.substr(0,2)) || !JSUtilValidaNumeros(Campo.substr(3,2)) || !JSUtilValidaNumeros(Campo.substr(6,4)))
			return false;

		StrDia = parseInt((Campo.substr(0,1) == "0") ? Campo.substr(1,1) :Campo.substr(0,2));
		StrMes = parseInt((Campo.substr(3,1) == "0") ? Campo.substr(4,1) :Campo.substr(3,2));
		StrAno = parseInt(Campo.substr(6,4));
	
		if (StrDia < 1 || StrDia > 31 || StrMes < 1 || StrMes > 12 || StrAno < 1900 || StrAno > 2100)
			return false;
		
		TotDias = (new Date(StrAno,StrMes,0)).getDate();
		if (TotDias < StrDia)
			return false;

		return true;
	}else{
		if (Obrigatorio)
			return false;
		else
			return true;
	}		
}
function JSUtilValidaNumeros(Campo) {
	var CaracteresValidos = "0123456789";
	
	for (y = 0; y < Campo.length; y++) {
		if (CaracteresValidos.indexOf(Campo.charAt(y)) == -1)
			return false;
	}

	return true;
}


/*
function JSUtilApenasNumero(Evento) {
        if (!Evento.keyCode)
            Evento.keyCode = Evento.which;
	if (Evento.keyCode == 44)
            return true;
	if (Evento.keyCode >= 48 && Evento.keyCode <= 57 )
            return true;
        return 0;
}*/
	
function JSUtilDataMaior(Data1,Data2) {
	Data1 = (typeof Data1 == "object") ? Data1.value : Data1;
	Data2 = (typeof Data2 == "object") ? Data2.value : Data2;
	Data1F = parseInt(Data1.substr(6,4) + Data1.substr(3,2) + Data1.substr(0,2));
	Data2F = parseInt(Data2.substr(6,4) + Data2.substr(3,2) + Data2.substr(0,2));

	if (Data1F > Data2F)
		return true;
	else
		return false;
}

function JSUtilBrSeNecessario(StringTexto,y) {
	for (x=0; x < StringTexto.length - y; x++) {
		if (StringTexto.substr(x,y+1).lastIndexOf(" ") == -1 && StringTexto.substr(x,y+1).lastIndexOf("\n") == -1) {
			StringTexto = StringTexto.substr(0,x+y) + " " + StringTexto.substr(x+y,StringTexto.length - (x+y));
			x+=3;
		}else{
			if (StringTexto.substr(x,y+1).lastIndexOf(" ") > StringTexto.substr(x,y+1).lastIndexOf("\n"))
				x+= StringTexto.substr(x,y+1).lastIndexOf(" ");
			else
				x+= StringTexto.substr(x,y+1).lastIndexOf("\n");
		}
	}
	return StringTexto;
}

function JSUtilTamanhoTextArea(Objeto,tamanho) {
	if (Objeto.value.length >= tamanho)
		Objeto.value = Objeto.value.substr(0,tamanho);
}
function JSUtilRemoveAcentos(StringTexto) {
	comAcento = "������������������������������������������������";
	semAcento = "aaaaaAAAAAeeeeEEEEiiiiIIIIoooooOOOOOuuuuUUUUcCnN";
	for (x=0; x < comAcento.length; x++) {
		while (StringTexto.indexOf(comAcento.charAt(x)) != -1)
			StringTexto = StringTexto.replace(comAcento.charAt(x),semAcento.charAt(x));
	}
	return StringTexto;
}

function JSUtilPrimeiraMaiusculo(StringTexto) {
	minusculo =	"abcdefghijlmnopqrstuvxzwyk ";
	maiusculo =	"ABCDEFGHIJLMNOPQRSTUVXZWYK ";
	for (x=0; x < StringTexto.length; x++) {
		if (StringTexto.substr(x-1,1) == " " || x == 0)
			StringTexto = StringTexto.substr(0,x) + ((minusculo.indexOf(StringTexto.substr(x,1)) != -1) ? (maiusculo.charAt(minusculo.indexOf(StringTexto.substr(x,1)))) : (StringTexto.substr(x,1))) + StringTexto.substr((x+1),StringTexto.length - x); 
		else
			StringTexto = StringTexto.substr(0,x) + ((maiusculo.indexOf(StringTexto.substr(x,1)) != -1) ? (minusculo.charAt(maiusculo.indexOf(StringTexto.substr(x,1)))) : (StringTexto.substr(x,1))) + StringTexto.substr(x+1,StringTexto.length - x);		
	}
	return StringTexto;
}

function arredondaNumber(valorCampo,chSeparador,casaDecimais,bMoney) {
	valorCampo = (typeof valorCampo == "object") ? new String(valorCampo.value) : new String(valorCampo);
	var sZeros = "00000000000000000000000000000000000000000";

	if (valorCampo.length > 0) {
		var posicaoPonto = valorCampo.indexOf(".");
		if (posicaoPonto == -1) {
			valorCampo+= chSeparador + sZeros.substr(0,casaDecimais);
		}else{
			valorCampo = valorCampo.replace(".",",");
			if (posicaoPonto + casaDecimais + 1 <= valorCampo.length)
				valorCampo = valorCampo.substring(0,posicaoPonto + casaDecimais + 1);

			valorCampo+= sZeros.substr(0,casaDecimais - ((valorCampo.length - 1) - valorCampo.indexOf(",")));
		}
		if (bMoney) {
			for (x = 6; x < valorCampo.length; x+= 4) {
				valorCampo = valorCampo.substring(0,valorCampo.length - x) + "." + valorCampo.substring(valorCampo.length - x);
			}
		}
	}
	return valorCampo;
}
var httpRequest;
function JSUtilRequest(URL) {
	httpRequest = (window.ActiveXObject) ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
	httpRequest.onreadystatechange = executeResponse
	httpRequest.open("GET",URL,true);
	httpRequest.send();
}

function JSUtilRequestPost(URL) {
	httpRequest = (window.ActiveXObject) ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
	httpRequest.onreadystatechange = executeResponse
	httpRequest.open("POST",URL,true);
	httpRequest.send();
}

function executeResponse() {
	if (httpRequest.readyState == 4) {
		if (httpRequest.status == 200) {
			var retorno = httpRequest.responseText;
			//eval(BinaryToString(httpRequest.responseText));
			eval(httpRequest.responseText);
		}else
			alert("Error -> Request");
	}
}

function BinaryToString(value) {
	var ASCII = "";
	while (value.length % 8 == 0 && value.length != 0) {
		ASCII += String.fromCharCode(parseInt(value.substr(0,8),2));
		value = value.substring(8);
	}
	return ASCII;
}

function isArray(obj)  {
    if (obj[0]) {
        return true; }
    else {
        return false; }
}

String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}

function Limpar(valor, validos) {
// retira caracteres invalidos da string
var result = "";
var aux;
for (var i=0; i < valor.length; i++) {
aux = validos.indexOf(valor.substring(i, i+1));
if (aux>=0) {
result += aux;
}
}
return result;
}


function Formata(campo,tammax,teclapres,decimal) {
	var tecla = teclapres.keyCode;
	vr = Limpar(campo.value,"0123456789");
	tam = vr.length;
	dec=decimal
	
	if (tam < tammax && tecla != 8){ tam = vr.length + 1 ; }
	
	if (tecla == 8 )
	{ tam = tam - 1 ; }
	
	if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 )
	{
	
	if ( tam <= dec )
	{ campo.value = vr ; }
	
	if ( (tam > dec) && (tam <= 5) ){
	campo.value = vr.substr( 0, tam - 2 ) + "," + vr.substr( tam - dec, tam ) ; }
	if ( (tam >= 6) && (tam <= 8) ){
	campo.value = vr.substr( 0, tam - 5 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; 
	}
	if ( (tam >= 9) && (tam <= 11) ){
	campo.value = vr.substr( 0, tam - 8 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
	if ( (tam >= 12) && (tam <= 14) ){
	campo.value = vr.substr( 0, tam - 11 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
	if ( (tam >= 15) && (tam <= 17) ){
	campo.value = vr.substr( 0, tam - 14 ) + "." + vr.substr( tam - 14, 3 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - 2, tam ) ;}
	} 

}

function FormataCep(input, evnt) {
    //Ajusta m�scara de CEP e s� permite digita��o de n�meros
    if (input.value.length == 5) {
        if (clientNavigator == "IE") {
            input.value += "-";
        }
        else {
            if (evnt.keyCode == 0) {
                input.value += "-";
            }
        }
    }
    //Chama a fun��o Bloqueia_Caracteres para s� permitir a digita��o de n�meros
    return JSUtilApenasNumero(evnt);
}

function FormataFone(input, evnt) {
    //Ajusta m�scara de CEP e s� permite digita��o de n�meros
    if (input.value.length == 1) {
        if (clientNavigator == "IE") {
            input.value = "("+input.value;
        }
        else {
            if (evnt.keyCode == 1) {
                input.value = "("+input.value;
            }
        }
    }
	
	if (input.value.length == 3) {
        if (clientNavigator == "IE") {
            input.value += ")";
        }
        else {
            if (evnt.keyCode == 3) {
                input.value += ")";
            }
        }
    }
	
	if (input.value.length == 8) {
        if (clientNavigator == "IE") {
            input.value += "-";
        }
        else {
            if (evnt.keyCode == 8) {
                input.value += "-";
            }
        }
    }
	
    return JSUtilApenasNumero(evnt);
}

function Limpar(valor, validos) {
	// retira caracteres invalidos da string
	var result = "";
	var aux;
	for (var i=0; i < valor.length; i++) {
		aux = validos.indexOf(valor.substring(i, i+1));
		if (aux>=0) {
			result += aux;
		}
	}
	return result;
}

function Formata(campo,tammax,teclapres,decimal) {
	var tecla = teclapres.keyCode;
	vr = Limpar(campo.value,"0123456789");
	tam = vr.length;
	dec=decimal
	if (tam < tammax && tecla != 8){ tam = vr.length + 1 ; }

if (tecla == 8 )
{ tam = tam - 1 ; }

if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 )
{

if ( tam <= dec )
{ campo.value = vr ; }

if ( (tam > dec) && (tam <= 5) ){
campo.value = vr.substr( 0, tam - 2 ) + "," + vr.substr( tam - dec, tam ) ; }
if ( (tam >= 6) && (tam <= 8) ){
campo.value = vr.substr( 0, tam - 5 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; 
}
if ( (tam >= 9) && (tam <= 11) ){
campo.value = vr.substr( 0, tam - 8 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
if ( (tam >= 12) && (tam <= 14) ){
campo.value = vr.substr( 0, tam - 11 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
if ( (tam >= 15) && (tam <= 17) ){
campo.value = vr.substr( 0, tam - 14 ) + "." + vr.substr( tam - 14, 3 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - 2, tam ) ;}
} 

return JSUtilApenasNumero(teclapres);

}


function viewImage(fieldFile,optionValue) {
  if (fieldFile.value != "")
	document.images['imgFile' + optionValue].src = "file://" + fieldFile.value;
}

function validaTypeImg(fieldFile) {
	extension = (fieldFile.substring(fieldFile.lastIndexOf(".") + 1)).toLowerCase();
	if (extension == "jpg" || extension == "gif" || extension == "jpeg")
		return true;
	else
		return false;
}