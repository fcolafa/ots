<?php
	$this->breadcrumbs=array(
		'Orden de Trabajo'=>array('admin'),
		'Administrar',
	);

	$this->menu=array(
//		array('label'=>'Ver Presupuestos', 'url'=>array('index')),
		array('label'=>'Crear Orden de Trabajo', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JDP()||Yii::app()->user->A1()||Yii::app()->user->ADM()),
	);
?>

<h2 class="text-center">Administrar Orden de Trabajo</h2>

<?php 
  	Yii::app()->clientScript->registerScript('aprobarOt', 
  	"
   	jQuery(document).on('click', '.aprobar', function() {
   		var idOt = $(this).attr('value');
                var check=$(this);
		$.ajax({
                data:  {'idOt':idOt},
                url:   'aprobarOt',
                type:  'POST',
                
                beforeSend: function (e) {
                          var c=confirm('¿Desea aprobar esta Ot?');
                          if(c != true){
                          e.preventDefault();
                            return false;
                          }
                },
                success:  function (response) {
                        if(response)
                        	alert('Ot aprobada correctamente');
                        else
                        	alert('No se pudo aprobar Ot');
                }
        });
   	});
	", CClientScript::POS_END); 
?>

<?php 
  	Yii::app()->clientScript->registerScript('detallesOT', 
  	"
	jQuery(document).on('hover', '#presupuesto-grid > table > tbody > tr', function() {
    	//$('#presupuesto-grid > table > tbody > tr').hover(function () {
    	//var id = $(this).parent().parent().parent().html();
         var id = $(this).find('td:first').text();
         var row = $(this).find('td:first');

         $.ajax({
		  	type: 'POST',
		 	url: 'viewOt',
		  	data: {'id_ot':id},
		 	beforeSend: function (xhr) {
		 	   	if (xhr && xhr.overrideMimeType) {
		  	    	xhr.overrideMimeType('application/json;charset=utf-8');
		  	  	}
		 	},
			dataType: 'json',
			success: function (data) {
				$('.dialog').attr('data-toggle', 'tooltip');
				$('.dialog').attr('title', data);
				$('.dialog').tooltip();
		  	}
		});
    });
	", CClientScript::POS_END); 
?>
  
<script>
	function mostrarDetalles(){
	    var ID_OT = $.fn.yiiGridView.getSelection('presupuesto-grid');
	    $.fn.yiiGridView.update('el_detalle',{ data: ID_OT });
	}
	//setInterval("mostrar()", 10000);

	$( document ).ready(function() {

		/*$('.aprobar').click(function(){
			alert("Hola");
			if (!$(this).is(':checked')) {
	            $('#aprobar').hide("fast");
	        }else{
	        	$('#aprobar').show("fast");
	        }
		});*/

        $("#presupuesto-grid > table > tbody > tr").hover(function () {

        	//$("#presupuesto-grid > table > tbody > tr").hover(function () {
        	//var id = $(this).parent().parent().parent().html();
             var id = $(this).find("td:first").text();
             var row = $(this).find("td:first");

	         $.ajax({
			  	type: 'POST',
			 	url: 'viewOt',
			  	data: {'id_ot':id},
			 	beforeSend: function (xhr) {
			 	   	if (xhr && xhr.overrideMimeType) {
			  	    	xhr.overrideMimeType('application/json;charset=utf-8');
			  	  	}
			 	},
				dataType: 'json',
				success: function (data) {
					var t = '<div>'+
								'<b>Id Ot: </b>'+data.ID_OT+'<br>'+
								'<b>Valor Moneda: </b>'+data.VALOR_MONEDA+'<br>'+
								'<b>Tipo Ot: </b>'+data.ID_TIPO_OT+'<br>'+
								'<b>Supervisor: </b>'+data.SUPERVISOR+'<br>'+
								'<b>Fecha Ejecución: </b>'+data.FECHA_EJECUCION+'<br>'+
								'<b>Aplica Iva: </b>'+data.APLICA_IVA+'<br>'+
						'</div>';


					$('.dialog').attr('data-toggle', 'tooltip');
					$('.dialog').attr('title', t);
					$('.dialog').tooltip();
			  	}
			});
            
        });
    });
	
</script>

<?php
	$meses = array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');
	
	$date =  $this->widget('zii.widgets.jui.CJuiDatePicker',array(
							'name'=>'FECHA_OT',
							'language'=>'es',
							'model'=>$model,
							'attribute'=>'FECHA_OT',
							'flat'=>false,
							'options'=>array(
								'showAnim'=>'fold',
								'constrainInput'=>true,
								'currentText'=>'Now',
								'altField' => 'FECHA_OT',
								'altFormat' => 'dd-mm-yy',
								'dateFormat'=>'yy-mm-dd',
								'htmlOptions'=>array(
									'style'=>'height:20px;'
								),
							),
							),true);
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'presupuesto-grid',
		'selectionChanged'=>'mostrarDetalles',
		'dataProvider'=>$model->search(),
		'htmlOptions'=>array('style'=>'text-align:left; width: 100%;'),
		'afterAjaxUpdate'=>"function() {
 								jQuery('#FECHA_OT').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 							}",
		'filter'=>$model,
		'columns'=>array(
			array(
				'name'=>'ID_OT',
				'htmlOptions'=>array('width' =>	'5%', 'class'=>'text-center'),
			),
			array(
				'name'=>'SOLICITANTE',
				'value'=>'@$data->personal->NOMBRE_PERSONA',
				'htmlOptions'=>array('width' =>	'15%'),
			),
			array(
				'name'=>'ID_DEPARTAMENTO',
				'value'=>'@$data->departamentos->NOMBRE_DEPARTAMENTO',
				'htmlOptions'=>array('width' =>	'15%'),
			),
			array(
				'name'=>'FECHA_OT',
				//'value' => 'ltrim(substr($data->FECHA_OT, 8),"0")."-".substr($data->FECHA_OT, 5, 2)."-".substr($data->FECHA_OT, 0, 4)',
				
				'filter'=> $date,
				'htmlOptions'=>array('width' =>	'10%'),
			),
			/*array(
				'name'=>'VOBO_JEFE_DPTO',
				'value'=>'$data->VOBO_JEFE_DPTO==1? $data->FECHA_VOBO_JDPTO:""',
				'htmlOptions'=>array('width' =>	'10%'),
			),*/
			array(
				'class'=>'CCheckBoxColumn',
				'selectableRows'=>2,
				'checked'=>'$data->VOBO_JEFE_DPTO==1',
				'htmlOptions'=>array('align' =>	'center'),
				'checkBoxHtmlOptions'=>array('class'=>'aprobar'),
				'header'=>'VoBo J. Dpto.',
				'disabled'=>'!Yii::app()->user->JDP()',
			),
			/*array(
				'name'=>'VOBO_ADMIN',
				'value'=>'$data->VOBO_ADMIN==1? $data->FECHA_VOBO_ADMIN:""',
				'htmlOptions'=>array('width' =>	'10%'),
			),*/
			array(
				'class'=>'CCheckBoxColumn',
				'selectableRows'=>2,
				'checked'=>'$data->VOBO_ADMIN==1',
				'htmlOptions'=>array('align' =>	'center'),
				'checkBoxHtmlOptions'=>array('class'=>'aprobar'),
				'header'=>'VoBo Adm.',
				'disabled'=>'!Yii::app()->user->ADM()',
			),
			/*array(
				'name'=>'VOBO_GERENTE_OP',
				'value'=>'$data->VOBO_GERENTE_OP==1? $data->FECHA_VOBO_GOP:""',
				'htmlOptions'=>array('width' =>	'10%'),
			),*/
			array(
				'class'=>'CCheckBoxColumn',
				'selectableRows'=>2,
				'checked'=>'$data->VOBO_GERENTE_OP==1',
				'htmlOptions'=>array('align' =>	'center'),
				'checkBoxHtmlOptions'=>array('class'=>'aprobar'),
				'header'=>'VoBo GOP',
				'disabled'=>'!Yii::app()->user->GOP()',
			),
			/*array(
				'name'=>'VOBO_GERENTE_GRAL',
				'value'=>'$data->VOBO_GERENTE_GRAL==1? $data->FECHA_VOBO_GG:""',
				'htmlOptions'=>array('width' =>	'10%'),
			),*/
			array(
				'class'=>'CCheckBoxColumn',
				'selectableRows'=>2,
				'checked'=>'$data->VOBO_GERENTE_GRAL==1',
				'htmlOptions'=>array('align' =>	'center'),
				'checkBoxHtmlOptions'=>array('class'=>'aprobar'),
				'header'=>'VoBo G. Gral.',
				'disabled'=>'!Yii::app()->user->GG()',
			),
			array(	'class'=>'CButtonColumn',
					'template'=>'{more}{view}{update}{delete}',
					'header'=>'Opciones',
					'buttons'=>array(
						'more' => array(
							'label' => 'Mas',
							'options' => array('class'=>'dialog', 'prevent'=>'default'),
							'click' => 'js:function() { return false;}',
							'imageUrl'=>Yii::app()->theme->baseUrl.'/img/plus.png',
						),
						'update' => array('visible'=> 'Yii::app()->user->A1() || Yii::app()->user->ADM() || Yii::app()->user->GG() || Yii::app()->user->GOP() || Yii::app()->user->JDP()'),
						'delete' => array('visible'=> 'Yii::app()->user->A1() || Yii::app()->user->ADM() || Yii::app()->user->GG() || Yii::app()->user->GOP() || Yii::app()->user->JDP()'),
						),
					'htmlOptions'=>array('width' =>	'10%', 'class'=>'text-center'),
			),
		),
	)); 

	$this->widget('zii.widgets.grid.CGridView', array(
			  'id'=>'el_detalle',
			  'dataProvider'=>$dP_detalle,
			    'columns'=>array(
			    	'ID_OT',
			    	'NUMERO_SUB_ITEM',
			    	'NOMBRE_SUB_ITEM',
			    	'COSTO_CONTRATISTA',
			    	'NRO_COTIZACION',
			    	array(
						'name'=>'ID_CENTRO_COSTO',
						'value'=>'$data->centroCosto->NOMBRE_CENTRO_COSTO',
						'header'=>'Centro Costo',
					 ),
			    ),
			));
?>