//valida el rut 
function ValidateRut(rut)
{
	rut = rut.replace( /\./g, "" );
	if (rut.length<8){
    	return(false);
  }

 	i1 = rut.indexOf("-");
	dv = rut.substr(i1+1);
	dv = dv.toUpperCase();
	nu = rut.substr(0,i1);

	cnt = 0;
	suma = 0;
	for (i = nu.length-1; i>=0; i--)
	{
		dig = nu.substr(i,1);
		fc = cnt+2;
		suma += parseInt(dig)*fc;
		cnt = (cnt+1) % 6;
	}
	dvok = 11-(suma%11);
		if (dvok==11) 
			dvokstr="0";
		if (dvok==10)
			dvokstr="K";
		if ((dvok!=11) && (dvok!=10)) 
			dvokstr=""+dvok;
    if (dvokstr==dv)
		{
	   	$(".valida_rut").css("background-color","#2ecc71");
	    return(true);
		}
		else
		{
    	$(".valida_rut").css("background-color","#e67e22");
      return(false);
    }
}