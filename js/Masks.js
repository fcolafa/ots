//var Ejemplo = new Array(3,6) --> Ejemplo de patron... numero de caracteres antes del separador.
/* MaskPhone(this,format, separador, numorlet)
 * inf = Informacion del textfield.
 * format = Formato a utilizar (cantidades).
 * separator = Simbolo utilizado para separar.
 * numorlet = Utilizara numeros? (true) o letras? (false).
 */
function MaskPhone(inf,numorlet)
{
	if(inf.value.length <= 8)
		format = new Array(0,9);
	else
		if(inf.value.length == 9)
			format = new Array(3,6);
		else
			format = new Array(inf.value.length,0)
	separator = "-";
	if(inf.valant != inf.value){
		val = inf.value;
		largo = val.length;
		val = val.split(separator);
		temp = '';
		for(i=0; i<val.length;i++)
		{
			temp += val[i];
		}
		if(numorlet)
		{
			for(i=0; i<temp.length; i++)
			{
				if(isNaN(temp.charAt(i)))
				{
					words = new RegExp(temp.charAt(i),"g");
					temp = temp.replace(words,"");
				}
			}
		}
		val = '';
		fin = new Array();
		for(i=0; i<format.length; i++)
		{
			fin[i] = temp.substring(0,format[i]);
			temp = temp.substr(format[i]);
		}
		for(i=0; i<fin.length; i++)
		{
			if(i ==0)
				val = fin[i];
			else
				if(fin[i] != "")
					val += separator + fin[i];
		}
		if(inf.value.length == 8)
			inf.value = 9+val;
		else
			inf.value = val;
		inf.valant = inf.value;
	}
}

//var Ejemplo = new Array(8,1) --> Ejemplo de patron... numero de caracteres antes del separador.
/* MaskRut(this,format, separador, numorlet)
 * inf = Informacion del textfield.
 * format = Formato a utilizar (cantidades).
 * separator = Simbolo utilizado para separar.
 * numorlet = Utilizara numeros? (true) o letras? (false).
 */

function MaskRut(inf, bool) 
{
	var invertido = ""; 
	var dtexto = ""; 
  	var count = 0; 
  	var largo = 0;
	if (bool) 
	{ 
    	inf = MaskRut(inf, false);
    	largo = inf.length; 
    	for ( i=(largo-1),j=0; i>=0; i--,j++ ) 
    		invertido = invertido + inf.charAt(i);           
    	dtexto = dtexto + invertido.charAt(0); 
    	dtexto = dtexto + '-';           
    	for ( i=1,j=2; i<largo; i++,j++ ) 
    	{ 
        		if (count == 3) 
        		{ 
          			dtexto = dtexto + '.'; 
          			j++; 
          			dtexto = dtexto + invertido.charAt(i); 
          			count = 1; 
        		} 
        		else 
        		{  
          			dtexto = dtexto + invertido.charAt(i); 
          			count++; 
        		} 
    	} 
    	invertido = ""; 
    	for ( i=(dtexto.length-1),j=0; i>=0; i--,j++ ) 
    		invertido = invertido + dtexto.charAt(i); 
    	if (invertido == '-') 
    		invertido = "" ;
    		inf = invertido; 
	} 
	else 
	{ 
  		var tmpstr = ""; 
  		for ( i=0; i < inf.length ; i++ ) 
  			if ( inf.charAt(i) != ' ' && inf.charAt(i) != '.' && inf.charAt(i) != '-' ) 
    			tmpstr = tmpstr + inf.charAt(i); 
  			inf = tmpstr; 
	} 
	return inf;
}


