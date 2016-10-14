var arrayPrices = new Array();
var arrayPricesUpdate = new Array();
var arrayTempCostoSubItem = new Array();

/* Funcion que calcula el "Total del Costo de Contratista" */
function costoContratista(target) {
    var str = target.id;
    var strId = "SubItemPresupuesto_";
    var identificador = str.split(strId, 2);
    var indice = identificador[1].charAt(0);
    //si es actualizar 
    if (indice == 'u') {
        var strId = "SubItemPresupuesto_u___";
        var identificador = str.split(strId, 2);
        identificador = identificador[1].split("_COSTO_CONTRATISTA", 2);
        var costo = parseInt(target.value);
        var cantidad = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_CANTIDAD').value);
        if (isNaN(costo))
            costo = 0;
        if (isNaN(cantidad))
            cantidad = 1;
        var total = (costo * cantidad);
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_TOTAL_CONTRATISTA').value = total + "";
        costoAstilleroUpdate(identificador[0]);
        costoUnitarioMaterialesUpdate(identificador[0], cantidad);

    } //si es crear
    else {
        var strId = "SubItemPresupuesto_COSTO_CONTRATISTA";
        var identificador = str.split(strId, 2);
        if (identificador[1] > 1) {
            //document.getElementById('NotaDeVenta_NUMERO_NOTA_VENTA').value = "hola";
            var costo = parseInt(target.value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD' + identificador[1]).value);
            if (isNaN(costo))
                costo = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = (costo * cantidad);
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_TOTAL_CONTRATISTA' + identificador[1]).value = total + "";
            this.costoAstillero(identificador[1]);
            costoUnitarioMateriales(identificador[1]);

        } else {
            var costo = parseInt(target.value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD').value);
            if (isNaN(costo))
                costo = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = (costo * cantidad);
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_TOTAL_CONTRATISTA').value = total + "";
            this.costoAstillero(identificador[1]);
            costoUnitarioMateriales(identificador[1]);
        }
    }
}

//funcion que calcula el total del costo de materiales
function costoMateriales(target)
{
    var str = target.id;
    var strId = "SubItemPresupuesto_";
    var identificador = str.split(strId, 2);
    var indice = identificador[1].charAt(0);
    //si es actualizar 
    if (indice == 'u')
    {
        var strId = "SubItemPresupuesto_u___";
        var identificador = str.split(strId, 2);
        identificador = identificador[1].split("_COSTO_MATERIALES", 2);
        var costo = parseInt(target.value);
        var cantidad = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_CANTIDAD').value);
        if (isNaN(costo))
            costo = 0;
        if (isNaN(cantidad))
            cantidad = 1;
        var total = (costo * cantidad);
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_TOTAL_MATERIALES').value = total + "";
        this.costoAstilleroUpdate(identificador[0]);

    } //si es crear
    else
    {
        var strId = "SubItemPresupuesto_COSTO_MATERIALES";
        var identificador = str.split(strId, 2);
        if (identificador[1] > 1)
        {
            var costo = parseInt(target.value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD' + identificador[1]).value);
            if (isNaN(costo))
                costo = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = (costo * cantidad);
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_TOTAL_MATERIALES' + identificador[1]).value = total + "";
            this.costoAstillero(identificador[1]);
        } else
        {
            var costo = parseInt(target.value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD').value);
            if (isNaN(costo))
                costo = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = (costo * cantidad);
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_TOTAL_MATERIALES').value = total + "";
            this.costoAstillero(identificador[1]);
        }
    }
}



//funcion que calcula el costo unitario de los materiales
function costoUnitarioMateriales(identificador)
{
    var porcentaje = parseInt(document.getElementById('ItemPresupuesto_FACTOR_MATERIAL_ITEM').value) / 100;
    if (isNaN(porcentaje))
        porcentaje = 0;

    if (identificador > 1)
    {
        var costo_contratista = parseInt(document.getElementById('SubItemPresupuesto_COSTO_CONTRATISTA' + identificador).value);
        if (isNaN(costo_contratista))
            costo_contratista = 0;

        var total = (costo_contratista * porcentaje);
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_COSTO_MATERIALES' + identificador).value = total + "";
        this.costoMateriales(identificador);
    } else
    {
        var costo_contratista = parseInt(document.getElementById('SubItemPresupuesto_COSTO_CONTRATISTA').value);
        if (isNaN(costo_contratista))
            costo_contratista = 0;

        var total = (costo_contratista * porcentaje);
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_COSTO_MATERIALES').value = total + "";
        this.costoMateriales(identificador);
    }
}

function costoUnitarioMaterialesUpdate(identificador, cantidad) {
    var porcentaje = parseFloat(document.getElementById('ItemPresupuesto_FACTOR_MATERIAL_ITEM').value) / 100;
    var costo_contratista = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador + '_COSTO_CONTRATISTA').value);
    if (isNaN(porcentaje))
        porcentaje = 0;
    if (isNaN(costo_contratista))
        costo_contratista = 0;
    var total = (costo_contratista * porcentaje);
    var total_mat = (total * cantidad).toFixed();
    total = total.toFixed();
    document.getElementById('SubItemPresupuesto_u___' + identificador + '_COSTO_MATERIALES').value = total + "";
    document.getElementById('SubItemPresupuesto_u___' + identificador + '_TOTAL_MATERIALES').value = total_mat + "";
    //this.costoMaterialesUpdate(identificador);
}


//funcion que actualiza el valor de Astilleros GG al cambiar el costo del contratista o del material
function costoAstillero(identificador) {

    var porcentaje = parseInt(document.getElementById('ItemPresupuesto_FACTOR_ASTILLERO_GG').value) / 100;
    if (identificador > 1) {
        var costo_contratista = parseInt(document.getElementById('SubItemPresupuesto_COSTO_CONTRATISTA' + identificador).value);
        var costo_materiales = parseInt(document.getElementById('SubItemPresupuesto_COSTO_MATERIALES' + identificador).value);
        // var total = (costo_contratista + costo_materiales)*porcentaje;
        if (isNaN(costo_contratista))
            costo_contratista = 0;
        if (isNaN(porcentaje))
            porcentaje = 0;
        if (isNaN(costo_materiales))
            costo_materiales = 0;
        // var total = (costo_contratista)*porcentaje;
        var total = (costo_contratista + costo_materiales) * porcentaje;
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_ASTILLERO_GG' + identificador).value = total + "";
        this.costoUnitario(identificador);

    } else
    {
        var costo_contratista = parseInt(document.getElementById('SubItemPresupuesto_COSTO_CONTRATISTA').value);
        var costo_materiales = parseInt(document.getElementById('SubItemPresupuesto_COSTO_MATERIALES').value);
        //  var total = (costo_contratista + costo_materiales)*porcentaje;
        if (isNaN(costo_contratista))
            costo_contratista = 0;
        if (isNaN(porcentaje))
            porcentaje = 0;
        if (isNaN(costo_materiales))
            costo_materiales = 0;
        // var total = (costo_contratista)*porcentaje;
        var total = (costo_contratista + costo_materiales) * porcentaje;
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_ASTILLERO_GG').value = total + "";
        this.costoUnitario(identificador);
    }
}

function costoAstilleroUpdate(identificador)
{
    var porcentaje = parseFloat(document.getElementById('ItemPresupuesto_FACTOR_ASTILLERO_GG').value) / 100;
    var costo_contratista = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador + '_COSTO_CONTRATISTA').value);
    //var costo_materiales  = parseInt(document.getElementById('SubItemPresupuesto_u___'+identificador+'_COSTO_MATERIALES').value);

    if (isNaN(costo_contratista))
        costo_contratista = 0;
    if (isNaN(porcentaje))
        porcentaje = 0;
    //var total = (costo_contratista)*porcentaje;
    var total = (costo_contratista /*+ costo_materiales*/) * porcentaje;
    total = total.toFixed()
    document.getElementById('SubItemPresupuesto_u___' + identificador + '_ASTILLERO_GG').value = total + "";
    this.costoUnitarioUpdate(identificador);
}

//funciÃ³n que calcula el total unitario.
function costoUnitario(identificador)
{
    if (identificador > 1)
    {
        var costo_contratista = parseInt(document.getElementById('SubItemPresupuesto_COSTO_CONTRATISTA' + identificador).value);
        var costo_materiales = parseInt(document.getElementById('SubItemPresupuesto_COSTO_MATERIALES' + identificador).value);
        var costo_astillero = parseInt(document.getElementById('SubItemPresupuesto_ASTILLERO_GG' + identificador).value);
        if (isNaN(costo_contratista))
            costo_contratista = 0;
        if (isNaN(costo_materiales))
            costo_materiales = 0;
        if (isNaN(costo_astillero))
            costo_astillero = 0;
        var total = (costo_contratista + costo_materiales + costo_astillero);
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_TOTAL_UNITARIO' + identificador).value = total + "";
        costoTotal(identificador);
        valorUnitario(identificador);

    } else
    {
        var costo_contratista = parseInt(document.getElementById('SubItemPresupuesto_COSTO_CONTRATISTA').value);
        var costo_materiales = parseInt(document.getElementById('SubItemPresupuesto_COSTO_MATERIALES').value);
        var costo_astillero = parseInt(document.getElementById('SubItemPresupuesto_ASTILLERO_GG').value);
        if (isNaN(costo_contratista))
            costo_contratista = 0;
        if (isNaN(costo_materiales))
            costo_materiales = 0;
        if (isNaN(costo_astillero))
            costo_astillero = 0;
        var total = (costo_contratista + costo_materiales + costo_astillero);
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_TOTAL_UNITARIO').value = total + "";
        costoTotal(identificador);
        valorUnitario(identificador);
    }
}

function costoUnitarioUpdate(identificador) {
    //var costo_contratista= parseInt(document.getElementById('SubItemPresupuesto_u___'+identificador+'_COSTO_CONTRATISTA').value);
    //var costo_materiales = parseInt(document.getElementById('SubItemPresupuesto_u___'+identificador+'_COSTO_MATERIALES').value);
    var costo_astillero = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador + '_ASTILLERO_GG').value);
    var cantidad = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador + '_CANTIDAD').value);

    //if(isNaN(costo_contratista)) costo_contratista =0;
    //if(isNaN(costo_materiales)) costo_materiales = 0;
    if (isNaN(costo_astillero))
        costo_astillero = 0;
    if (isNaN(cantidad))
        cantidad = 0;
    //var total = (costo_contratista + costo_materiales + costo_astillero);
    var total = costo_astillero * cantidad;
    total = total.toFixed()
    document.getElementById('SubItemPresupuesto_u___' + identificador + '_TOTAL_UNITARIO').value = total + "";
    costoTotalUpdate(identificador);
    valorUnitarioUpdate(identificador);
}

//funcion que calcula el costo total 
function costoTotal(identificador) {

    if (identificador > 1) {
        var costo_total = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_UNITARIO' + identificador).value);
        var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD' + identificador).value);
        if (isNaN(costo_total))
            costo_total = 0;
        if (isNaN(cantidad))
            cantidad = 1;

        var total = (costo_total * cantidad);
        total = total.toFixed(2)
        document.getElementById('SubItemPresupuesto_COSTO_TOTAL' + identificador).value = total + "";

    } else
    {
        var costo_total = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_UNITARIO').value);
        var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD').value);
        if (isNaN(costo_total))
            costo_total = 0;
        if (isNaN(cantidad))
            cantidad = 1;
        var total = (costo_total * cantidad);
        total = total.toFixed(2)
        document.getElementById('SubItemPresupuesto_COSTO_TOTAL').value = total + "";
    }
}

function costoTotalUpdate(identificador) {
    var costo_total = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador + '_TOTAL_UNITARIO').value);
    var cantidad = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador + '_CANTIDAD').value);
    if (isNaN(costo_total))
        costo_total = 0;
    if (isNaN(cantidad))
        cantidad = 1;
    var total = (costo_total * cantidad);
    total = total.toFixed(2)
    document.getElementById('SubItemPresupuesto_u___' + identificador + '_COSTO_TOTAL').value = total + "";
}

//funcion que calcular el valor unitario del sub item.
function valorUnitario(identificador) {
    var porcentaje = parseInt(document.getElementById('ItemPresupuesto_FACTOR_TOTAL_UNIT').value) / 100;

    if (identificador > 1) {
        var total_unitario = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_UNITARIO' + identificador).value);
        if (isNaN(porcentaje))
            porcentaje = 0;
        if (isNaN(total_unitario))
            total_unitario = 0;
        var total = (1 + porcentaje) * total_unitario;
        total = total.toFixed(2)
        document.getElementById('SubItemPresupuesto_VALOR_UNITARIO' + identificador).value = total + "";
        valorSubItem(identificador);
    } else
    {
        var total_unitario = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_UNITARIO').value);
        if (isNaN(porcentaje))
            porcentaje = 0;
        if (isNaN(total_unitario))
            total_unitario = 0;
        var total = (1 + porcentaje) * total_unitario;
        total = total.toFixed(2)
        document.getElementById('SubItemPresupuesto_VALOR_UNITARIO').value = total + "";
        valorSubItem(identificador);
    }
}

function valorUnitarioUpdate(identificador) {
    var porcentaje = parseInt(document.getElementById('ItemPresupuesto_FACTOR_TOTAL_UNIT').value) / 100;
    var total_unitario = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador + '_TOTAL_UNITARIO').value);
    if (isNaN(porcentaje))
        porcentaje = 0;
    if (isNaN(total_unitario))
        total_unitario = 0;
    var total = (1 + porcentaje) * total_unitario;
    total = total.toFixed(2)
    document.getElementById('SubItemPresupuesto_u___' + identificador + '_VALOR_UNITARIO').value = total + "";
    valorSubItemUpdate(identificador);
}

//funcion que calcula el valor total del sub item.
function valorSubItem(identificador) {
    if (identificador > 1)
    {
        var valor_unitario = parseInt(document.getElementById('SubItemPresupuesto_VALOR_UNITARIO' + identificador).value);
        var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD' + identificador).value);
        if (isNaN(cantidad))
            cantidad = 1;
        if (isNaN(valor_unitario))
            valor_unitario = 0;
        var total = cantidad * valor_unitario;
        total = total.toFixed(2)
        arrayPrices[identificador] = total;
        document.getElementById('SubItemPresupuesto_VALOR_ITEM' + identificador).value = total + "";
        setTotal(identificador);
    } else
    {
        var valor_unitario = parseInt(document.getElementById('SubItemPresupuesto_VALOR_UNITARIO').value);
        var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD' + identificador).value);
        if (isNaN(cantidad))
            cantidad = 1;
        if (isNaN(valor_unitario))
            valor_unitario = 0;
        var total = cantidad * valor_unitario;
        total = total.toFixed(2)
        identificador = 0;
        arrayPrices[identificador] = total;
        document.getElementById('SubItemPresupuesto_VALOR_ITEM').value = total + "";
        setTotal(identificador);
    }
}

function valorSubItemUpdate(identificador) {


    if (arrayTempCostoSubItem[identificador] == null || arrayTempCostoSubItem[identificador] == 'undefined') {
        arrayTempCostoSubItem[identificador] = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador + '_VALOR_ITEM').value); //guardo el temporal del valor total del sub item.
        var temp = parseInt(document.getElementById('COSTO_TOTAL_HIDDEN').value);
        var subitem = parseInt(arrayTempCostoSubItem[identificador]);
        if (isNaN(subitem))
            subitem = 0;
        var dif = temp - subitem;
        // document.getElementById('ItemPresupuesto_COSTO_TOTAL_ITEM').value = dif +"";
        document.getElementById('COSTO_TOTAL_HIDDEN').value = dif + "";
    }

    var valor_unitario = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador + '_VALOR_UNITARIO').value);
    var cantidad = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador + '_CANTIDAD').value);
    if (isNaN(cantidad))
        cantidad = 1;
    if (isNaN(valor_unitario))
        valor_unitario = 0;
    var total = cantidad * valor_unitario;
    total = total.toFixed(2)
    arrayPricesUpdate[identificador] = total;
    document.getElementById('SubItemPresupuesto_u___' + identificador + '_VALOR_ITEM').value = total + "";
    //document.getElementById('COSTO_TOTAL_HIDDEN').value = total +"";

    setTotal(identificador);
}

//Funcion que coloca el total del item
function setTotal(identificador) {
    total = 0;
    for (var i = 0; i < arrayPrices.length; i++) {
        if (arrayPrices[i] != null) {
            temp = parseInt(document.getElementById('COSTO_TOTAL_HIDDEN').value);
            total = temp + total + parseInt(arrayPrices[i]);
        }
    }
    for (var i = 0; i < arrayPricesUpdate.length; i++) {
        if (arrayPricesUpdate[i] != null) {

            temp = parseInt(document.getElementById('COSTO_TOTAL_HIDDEN').value);
            total = temp + parseInt(arrayPricesUpdate[i]);
            document.getElementById('COSTO_TOTAL_HIDDEN').value = temp + "";
        }
    }
    document.getElementById('ItemPresupuesto_COSTO_TOTAL_ITEM').value = total + "";
}


//funcion que calcula el costo total del sub item a partir del costo total contratista
function costoByTotalContratista(target) {
    var str = target.id;
    var strId = "SubItemPresupuesto_";
    var identificador = str.split(strId, 2);
    var indice = identificador[1].charAt(0);
    //si es actualizar 
    if (indice == 'u') {
        var strId = "SubItemPresupuesto_u___";
        var identificador = str.split(strId, 2);
        identificador = identificador[1].split("_TOTAL_CONTRATISTA", 2);
        var total_contratista = parseInt(target.value);
        var total_materiales = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_TOTAL_MATERIALES').value);
        var costo_unitario_astillero = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_ASTILLERO_GG').value);
        var cantidad = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_CANTIDAD').value);
        if (isNaN(total_contratista))
            total_contratista = 0;
        if (isNaN(total_materiales))
            total_materiales = 0;
        if (isNaN(costo_unitario_astillero))
            costo_unitario_astillero = 0;
        if (isNaN(cantidad))
            cantidad = 1;
        var total = (total_contratista + total_materiales + (costo_unitario_astillero * cantidad));
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_COSTO_TOTAL').value = total + "";
        //this.costoAstilleroUpdate(identificador[0]);
    } //si es crear

    else {
        var strId = "SubItemPresupuesto_TOTAL_CONTRATISTA";
        var identificador = str.split(strId, 2);
        if (identificador[1] > 1) {
            var total_contratista = parseInt(target.value);
            var total_materiales = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_MATERIALES' + identificador[1]).value);
            var costo_unitario_astillero = parseInt(document.getElementById('SubItemPresupuesto_ASTILLERO_GG' + identificador[1]).value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD' + identificador[1]).value);
            if (isNaN(total_contratista))
                total_contratista = 0;
            if (isNaN(total_materiales))
                total_materiales = 0;
            if (isNaN(costo_unitario_astillero))
                costo_unitario_astillero = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = (total_contratista + total_materiales + (costo_unitario_astillero * cantidad));
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_COSTO_TOTAL' + identificador[1]).value = total + "";
            //this.costoAstillero(identificador[1]);
        } else
        {
            var total_contratista = parseInt(target.value);
            var total_materiales = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_MATERIALES').value);
            var costo_unitario_astillero = parseInt(document.getElementById('SubItemPresupuesto_ASTILLERO_GG').value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD').value);
            if (isNaN(total_contratista))
                total_contratista = 0;
            if (isNaN(total_materiales))
                total_materiales = 0;
            if (isNaN(costo_unitario_astillero))
                costo_unitario_astillero = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = (total_contratista + total_materiales + (costo_unitario_astillero * cantidad));
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_COSTO_TOTAL').value = total + "";
            // this.costoAstillero(identificador[1]);
        }
    }
}

//funcion que calcula el costo total del sub item a partir del costo total de materiales
function costoByTotalMateriales(target) {
    var str = target.id;
    var strId = "SubItemPresupuesto_";
    var identificador = str.split(strId, 2);
    var indice = identificador[1].charAt(0);
    //si es actualizar 
    if (indice == 'u') {
        var strId = "SubItemPresupuesto_u___";
        var identificador = str.split(strId, 2);
        identificador = identificador[1].split("_TOTAL_MATERIALES", 2);
        var total_contratista = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_TOTAL_CONTRATISTA').value);
        var total_materiales = parseInt(target.value);
        var costo_unitario_astillero = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_ASTILLERO_GG').value);
        var cantidad = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_CANTIDAD').value);
        if (isNaN(total_contratista))
            total_contratista = 0;
        if (isNaN(total_materiales))
            total_materiales = 0;
        if (isNaN(costo_unitario_astillero))
            costo_unitario_astillero = 0;
        if (isNaN(cantidad))
            cantidad = 1;
        var total = (total_contratista + total_materiales + (costo_unitario_astillero * cantidad));
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_COSTO_TOTAL').value = total + "";
        //this.costoAstilleroUpdate(identificador[0]);
    } //si es crear

    else {
        var strId = "SubItemPresupuesto_TOTAL_MATERIALES";
        var identificador = str.split(strId, 2);
        if (identificador[1] > 1) {
            var total_contratista = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_CONTRATISTA' + identificador[1]).value);
            var total_materiales = parseInt(target.value);
            var costo_unitario_astillero = parseInt(document.getElementById('SubItemPresupuesto_ASTILLERO_GG' + identificador[1]).value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD' + identificador[1]).value);
            if (isNaN(total_contratista))
                total_contratista = 0;
            if (isNaN(total_materiales))
                total_materiales = 0;
            if (isNaN(costo_unitario_astillero))
                costo_unitario_astillero = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = (total_contratista + total_materiales + (costo_unitario_astillero * cantidad));
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_COSTO_TOTAL' + identificador[1]).value = total + "";
            //this.costoAstillero(identificador[1]);
        } else
        {
            var total_contratista = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_CONTRATISTA').value);
            var total_materiales = parseInt(target.value);
            var costo_unitario_astillero = parseInt(document.getElementById('SubItemPresupuesto_ASTILLERO_GG').value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD').value);
            if (isNaN(total_contratista))
                total_contratista = 0;
            if (isNaN(total_materiales))
                total_materiales = 0;
            if (isNaN(costo_unitario_astillero))
                costo_unitario_astillero = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = (total_contratista + total_materiales + (costo_unitario_astillero * cantidad));
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_COSTO_TOTAL').value = total + "";
            // this.costoAstillero(identificador[1]);
        }
    }
}

//funcion que calcula el costo total al modificar el valor unitario del astillero
function costoByAstilleroGG(target) {
    var str = target.id;
    var strId = "SubItemPresupuesto_";
    var identificador = str.split(strId, 2);
    var indice = identificador[1].charAt(0);
    //si es actualizar 
    if (indice == 'u') {
        var strId = "SubItemPresupuesto_u___";
        var identificador = str.split(strId, 2);
        identificador = identificador[1].split("_ASTILLERO_GG", 2);
        var total_contratista = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_TOTAL_CONTRATISTA').value);
        var total_materiales = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_TOTAL_MATERIALES').value);
        var costo_unitario_astillero = parseInt(target.value);
        var cantidad = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_CANTIDAD').value);
        if (isNaN(total_contratista))
            total_contratista = 0;
        if (isNaN(total_materiales))
            total_materiales = 0;
        if (isNaN(costo_unitario_astillero))
            costo_unitario_astillero = 0;
        if (isNaN(cantidad))
            cantidad = 1;
        var total = (total_contratista + total_materiales + (costo_unitario_astillero * cantidad));
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_COSTO_TOTAL').value = total + "";
        //this.costoAstilleroUpdate(identificador[0]);
    } //si es crear

    else {
        var strId = "SubItemPresupuesto_ASTILLERO_GG";
        var identificador = str.split(strId, 2);
        if (identificador[1] > 1) {
            var total_contratista = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_CONTRATISTA' + identificador[1]).value);
            var total_materiales = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_MATERIALES' + identificador[1]).value);
            var costo_unitario_astillero = parseInt(target.value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD' + identificador[1]).value);
            if (isNaN(total_contratista))
                total_contratista = 0;
            if (isNaN(total_materiales))
                total_materiales = 0;
            if (isNaN(costo_unitario_astillero))
                costo_unitario_astillero = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = (total_contratista + total_materiales + (costo_unitario_astillero * cantidad));
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_COSTO_TOTAL' + identificador[1]).value = total + "";
            //this.costoAstillero(identificador[1]);
        } else
        {
            var total_contratista = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_CONTRATISTA').value);
            var total_materiales = parseInt(document.getElementById('SubItemPresupuesto_TOTAL_MATERIALES').value);
            var costo_unitario_astillero = parseInt(target.value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD').value);
            if (isNaN(total_contratista))
                total_contratista = 0;
            if (isNaN(total_materiales))
                total_materiales = 0;
            if (isNaN(costo_unitario_astillero))
                costo_unitario_astillero = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = (total_contratista + total_materiales + (costo_unitario_astillero * cantidad));
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_COSTO_TOTAL').value = total + "";
            // this.costoAstillero(identificador[1]);
        }
    }
}

//funcion que calcula el costo total al modificar el valor unitario
function costoByValorUnitario(target) {
    var str = target.id;
    var strId = "SubItemPresupuesto_";
    var identificador = str.split(strId, 2);
    var indice = identificador[1].charAt(0);
    //si es actualizar 
    if (indice == 'u') {
        var strId = "SubItemPresupuesto_u___";
        var identificador = str.split(strId, 2);
        identificador = identificador[1].split("_VALOR_UNITARIO", 2);
        var valor_unitario = parseInt(target.value);
        var cantidad = parseInt(document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_CANTIDAD').value);
        if (isNaN(valor_unitario))
            valor_unitario = 0;
        if (isNaN(cantidad))
            cantidad = 1;
        var total = ((valor_unitario * cantidad));
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_VALOR_ITEM').value = total + "";
        //this.costoAstilleroUpdate(identificador[0]);
    } //si es crear

    else {
        var strId = "SubItemPresupuesto_VALOR_UNITARIO";
        var identificador = str.split(strId, 2);
        if (identificador[1] > 1) {

            var valor_unitario = parseInt(target.value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD' + identificador[1]).value);
            if (isNaN(valor_unitario))
                valor_unitario = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = ((valor_unitario * cantidad));
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_VALOR_ITEM' + identificador[1]).value = total + "";
            //this.costoAstillero(identificador[1]);
        } else
        {
            var valor_unitario = parseInt(target.value);
            var cantidad = parseInt(document.getElementById('SubItemPresupuesto_CANTIDAD').value);
            if (isNaN(valor_unitario))
                valor_unitario = 0;
            if (isNaN(cantidad))
                cantidad = 1;
            var total = ((valor_unitario * cantidad));
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_VALOR_ITEM').value = total + "";
            // this.costoAstillero(identificador[1]);
        }
    }
}


//funcion que calcula el costo total al modificar el valor unitario
function totalByCostoTotal(target) {
    var str = target.id;
    var porcentaje = 1 + parseInt(document.getElementById('ItemPresupuesto_FACTOR_TOTAL_UNIT').value) / 100;
    var strId = "SubItemPresupuesto_";
    var identificador = str.split(strId, 2);
    var indice = identificador[1].charAt(0);
    //si es actualizar 
    if (indice == 'u') {
        var strId = "SubItemPresupuesto_u___";
        var identificador = str.split(strId, 2);
        identificador = identificador[1].split("_COSTO_TOTAL", 2);
        var costo_total = parseInt(target.value);

        if (isNaN(costo_total))
            costo_total = 0;
        if (isNaN(porcentaje))
            porcentaje = 0;
        var total = ((costo_total * porcentaje));
        total = total.toFixed()
        document.getElementById('SubItemPresupuesto_u___' + identificador[0] + '_VALOR_UNITARIO').value = total + "";
        //this.costoAstilleroUpdate(identificador[0]);
    } //si es crear

    else {
        var strId = "SubItemPresupuesto_VALOR_UNITARIO";
        var identificador = str.split(strId, 2);
        if (identificador[1] > 1) {

            var costo_total = parseInt(target.value);

            if (isNaN(costo_total))
                costo_total = 0;
            if (isNaN(porcentaje))
                porcentaje = 0;
            var total = ((costo_total * porcentaje));
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_VALOR_ITEM' + identificador[1]).value = total + "";
            //this.costoAstillero(identificador[1]);
        } else
        {
            var costo_total = parseInt(target.value);

            if (isNaN(costo_total))
                costo_total = 0;
            if (isNaN(porcentaje))
                porcentaje = 0;
            var total = ((costo_total * porcentaje));
            total = total.toFixed()
            document.getElementById('SubItemPresupuesto_VALOR_ITEM').value = total + "";
            // this.costoAstillero(identificador[1]);
        }
    }
    function deleteInsumo() {
        $("dltinsumo").click(function () {
            $("dltinsumo").after(window.location.onload());
        });
    }
}