//variaveis uteis
var JSValidacaoFormNome = "";
/*
*	Cpf
*/
function JSValidacaocpf(Objeto,Obrigatorio) {
	if (Objeto.value != "") {
		if (Objeto.value.length != 14)
			return false;
		CpfSemMascara = Objeto.value.substr(0,3) + Objeto.value.substr(4,3) + Objeto.value.substr(8,3) + Objeto.value.substr(12,2);
		CpfDigito = Objeto.value.substr(12,2);
		SomaTeste1 = 0;
		SomaTeste2 = 0;
	
		for (y = 0; y < 9; y++) {
			SomaTeste1+= CpfSemMascara.substr(y,1) * (10 - y);
			SomaTeste2+= CpfSemMascara.substr(y,1) * (11 - y);
		}
		if (SomaTeste1 == 0)
			return false;
		SomaTeste1 = 11 - (SomaTeste1 % 11);
		if (SomaTeste1 > 9)
			SomaTeste1 = 0;
		if (CpfDigito.substr(0,1) != SomaTeste1)
			return false;
		SomaTeste2+=  SomaTeste1 * 2;
		SomaTeste2 = 11 - (SomaTeste2 % 11);	
		if (SomaTeste2 > 9)
			SomaTeste2 = 0;
		if (CpfDigito.substr(1,1) != SomaTeste2)
			return false;
		return true;
	}else{
		if (Obrigatorio)
			return false;
		else
			return true;
	}	
}
/*
* Numero
*/
function JSValidacaonbr(ObjetoOuString,Obrigatorio) {
	ObjetoOuString = (typeof ObjetoOuString == "object") ? ObjetoOuString.value : ObjetoOuString;

	var CaracteresValidos = "0123456789";
	for (y = 0; y < ObjetoOuString.length; y++) {
		if (CaracteresValidos.indexOf(ObjetoOuString.charAt(y)) == -1)
			return false;
	}
	if (Obrigatorio && ObjetoOuString == "")
		return false;
		
	return true;
}
/*
* Moeda
*/
function JSValidacaomed(ObjetoOuString,Obrigatorio) {
	ObjetoOuString = (typeof ObjetoOuString == "object") ? ObjetoOuString.value : ObjetoOuString;

	var CaracteresValidos = "0123456789,.";
	for (y = 0; y < ObjetoOuString.length; y++) {
		if (CaracteresValidos.indexOf(ObjetoOuString.charAt(y)) == -1)
			return false;
	}
	if (Obrigatorio && ObjetoOuString == "")
		return false;
		
	return true;
}
/*
*	Horas
*/
function JSValidacaohrs(ObjetoOuString,Obrigatorio) {
	ObjetoOuString = (typeof ObjetoOuString == "object") ? ObjetoOuString.value : ObjetoOuString;
	
	if (ObjetoOuString.length != 0) {
		if (ObjetoOuString.length != 5)
			return false;
		StrHora = ObjetoOuString.substr(0,2);
		StrMinuto = ObjetoOuString.substr(3,2);
		if (!JSValidacaonbr(StrHora,true) || !JSValidacaonbr(StrMinuto,true))
			return false;
		
		if (StrHora < 0 || StrHora > 23 || StrMinuto < 0 || StrMinuto > 59)
			return false;
		return true;	
	}else{
		if (Obrigatorio)
			return false;
		else
			return true;
	}				
}
/*
*	E-mail
*/

function Verifica_Email(email, obrigatorio) {
    //Se o par�metro obrigat�rio for igual � zero, significa que elepode estar vazio, caso contr�rio, n�o
    var email = document.getElementById(email);
    if ((obrigatorio == 1) || (obrigatorio == 0 && email.value != "")) {
        if (!email.value.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi)) {
            //alert("Informe um e-mail v�lido");
            //email.focus();
            return false}
    }
}

function JSValidacaoeml(ObjetoOuString,Obrigatorio) {
	ObjetoOuString = (typeof ObjetoOuString == "object") ? ObjetoOuString.value : ObjetoOuString;
	var caracteresInvalidos = "��������������������������������������������� '!#$%�&*()=+[{�`~^}]�\|,<>:;/?";

	for (y = 0;	 y < caracteresInvalidos.length; y++) {
		if (ObjetoOuString.indexOf(caracteresInvalidos.charAt(y)) != -1)
				return false;
	}
	if (ObjetoOuString.indexOf("@") != ObjetoOuString.lastIndexOf("@") || 
		ObjetoOuString.lastIndexOf("@") > ObjetoOuString.lastIndexOf(".") || 
		ObjetoOuString.indexOf('"') != -1 ||
		ObjetoOuString.indexOf('www') != -1 ||
		ObjetoOuString.indexOf('WWW') != -1)
			return false;

	if (Obrigatorio) {
		if (ObjetoOuString == "" ||
			ObjetoOuString.indexOf("@") <= 0 ||
			ObjetoOuString.lastIndexOf(".") ==  ObjetoOuString.length -1)
				return false;
	}
	return true;
}
/*
* Data
*/
function JSValidacaodat(ObjetoOuString,Obrigatorio) {
	ObjetoOuString = (typeof ObjetoOuString == "object") ? ObjetoOuString.value : ObjetoOuString;
				
	if (ObjetoOuString.length != 0) {
		if (ObjetoOuString.length != 10)
			return false;

		StrDia = ObjetoOuString.substr(0,2);
		StrMes = ObjetoOuString.substr(3,2);
		StrAno = ObjetoOuString.substr(6,4);
	
		if (!JSValidacaonbr(StrDia,true) || !JSValidacaonbr(StrMes,true) || !JSValidacaonbr(StrAno,true))
			return false;

		if (StrDia < 1 || StrDia > 31 || StrMes < 1 || StrMes > 12)
			return false;
	
		TotalDiasDoMes = new Date(StrAno,StrMes,0).getDate();
		if (StrDia <= 0 || StrDia > TotalDiasDoMes)
			return false;
	}else{
		if (Obrigatorio)
			return false;
		else
			return true;
	}		
	return true;	
}
/*
*	Radio Button
*/
function JSValidacaordb(Objeto,Obrigatorio) {
	totalCampos = Objeto.length;
	if (Obrigatorio) {
		for (y = 0; y < totalCampos; y++) {
			if (Objeto[y].checked)
				return true;
		}
		return false;
	}
	return true;
}
/*
*	Select e List
*/
function JSValidacaoslt(Objeto,Obrigatorio) {
	if (Obrigatorio) {
		if (Objeto.value != "")
			return true;
		else
			return false;
	}
	return true;
}
/*
*	CheckBox
*/
function JSValidacaockb(Objeto,Obrigatorio){
	if (Obrigatorio)
		return Objeto.checked;

	return true;	
}
/*
*	CNPJ _ CGC.heheh
*/
function JSValidacaocgc(ObjetoOuString,Obrigatorio){
	ObjetoOuString = (typeof ObjetoOuString == "object") ? ObjetoOuString.value : ObjetoOuString;
	
	if (ObjetoOuString.length != 0) {
		if (ObjetoOuString.length != 18)
			return false;
		CnpjSemMascara = ObjetoOuString.substr(0,2) + ObjetoOuString.substr(3,3) + ObjetoOuString.substr(7,3) + ObjetoOuString.substr(11,4) + ObjetoOuString.substr(16,2);

		if (!JSValidacaonbr(CnpjSemMascara,true))
			return false;

		Multiplicador2 = 2;
		CnpjSoma1 = 0;
		CnpjSoma2 = 0;
		
		for(y = 11; y >= 0; y--) {
			Multiplicador1 = Multiplicador2;
			if (Multiplicador2 < 9)
				Multiplicador2++;
			else
				Multiplicador2 = 2;
			CnpjSoma1+= CnpjSemMascara.charAt(y) * Multiplicador1;
			CnpjSoma2+= CnpjSemMascara.charAt(y) * Multiplicador2;
		}
		CnpjSoma1 = CnpjSoma1 % 11;
		if(CnpjSoma1 < 2)
			CnpjSoma1 = 0;
		else
			CnpjSoma1 = 11 - CnpjSoma1;
		
		CnpjSoma2 = (CnpjSoma2 + (2 * CnpjSoma1)) % 11;
		if(CnpjSoma2 < 2)
			CnpjSoma2 = 0;
		else
			CnpjSoma2 = 11 - CnpjSoma2;
		if (CnpjSoma1 != CnpjSemMascara.charAt(12) || CnpjSoma2 != CnpjSemMascara.charAt(13))
			return false;
		return true;	
	}else{
		if (Obrigatorio)
			return false;
		else
			return true;
	}
}
/*
* Senha
*/
function JSValidacaopwd(ObjetoOuString,Obrigatorio){
	ObjetoOuString = (typeof ObjetoOuString == "object") ? ObjetoOuString.value : ObjetoOuString;
	if (ObjetoOuString.length != 0) {
		ObjetoOuString = ObjetoOuString.toLowerCase();
		CaracteresValidos = "abcdefghijlmnopqrstuvxzwky1234567890";
		
		for (y = 0; y < ObjetoOuString.length; y++) {
			if (CaracteresValidos.indexOf(ObjetoOuString.charAt(y)) == -1)
				return false;
		}
		return true;
	}else{
		if (Obrigatorio)
			return false;
		else
			return true;
	}		
}
/*
*	repeticao de senha
*/
function JSValidacaopw2(Objeto,Obrigatorio) {
	Senha1 = document.forms[JSValidacaoFormNome].elements['pwd' + Objeto.name.substring(3,Objeto.name.length) + "_"].value;
	Senha2 = Objeto.value;
	if (! JSValidacaopwd(Senha1,Obrigatorio) || ! JSValidacaopwd(Senha2,Obrigatorio))
		return false;
	if (Senha1 != Senha2)
		return false;

	return true;
}
/*
*	Textoo
*/
function JSValidacaotxt(ObjetoOuString,Obrigatorio) {
	ObjetoOuString = (typeof ObjetoOuString == "object") ? ObjetoOuString.value : ObjetoOuString;
	
	if (Obrigatorio) {
		if (ObjetoOuString.length == 0)
			return false;
	}
	return true;
}

function Compara_Datas(data_inicial, data_final, msg) {
    //Verifica se a data inicial � maior que a data final
    var data_inicial = document.getElementById(data_inicial);
    var data_final = document.getElementById(data_final);
    str_data_inicial = data_inicial.value;
    str_data_final = data_final.value;
    dia_inicial = data_inicial.value.substr(0, 2);
    dia_final = data_final.value.substr(0, 2);
    mes_inicial = data_inicial.value.substr(3, 2);
    mes_final = data_final.value.substr(3, 2);
    ano_inicial = data_inicial.value.substr(6, 4);
    ano_final = data_final.value.substr(6, 4);
    if (ano_inicial > ano_final) {
        alert(msg);
        data_inicial.focus();
        return false}
    else {
        if (ano_inicial == ano_final) {
            if (mes_inicial > mes_final) {
                alert(msg);
                data_final.focus();
                return false}
            else {
                if (mes_inicial == mes_final) {
                    if (dia_inicial > dia_final) {
                        alert(msg);
                        data_final.focus();
                        return false}
                }
            }
        }
    }
}

function ComparaDatas(data_inicial, data_final) {
    //Verifica se a data inicial � maior que a data final
    var data_inicial = data_inicial;
    var data_final = data_final;
    str_data_inicial = data_inicial.value;
    str_data_final = data_final.value;
    dia_inicial = data_inicial.substr(0, 2);
    dia_final = data_final.substr(0, 2);
    mes_inicial = data_inicial.substr(3, 2);
    mes_final = data_final.substr(3, 2);
    ano_inicial = data_inicial.substr(6, 4);
    ano_final = data_final.substr(6, 4);
    if (ano_inicial > ano_final) {
        //alert(msg);
        return false}
    else {
        if (ano_inicial == ano_final) {
            if (mes_inicial > mes_final) {
                return false
            } else {
                if (mes_inicial == mes_final) {
                    if (dia_inicial > dia_final) {
                        return false
					}else{
						return true;
					}
                }else{
					return true;
				}
            }
        }else{
			return true;
		}
		
    }
}