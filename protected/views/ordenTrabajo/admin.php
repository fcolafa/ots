<?php
	$this->breadcrumbs=array(
		'Orden de Trabajo'=>array('admin'),
		'Administrar',
	);

	$this->menu=array(
//		array('label'=>'Ver Presupuestos', 'url'=>array('index')),
		array('label'=>'Crear Orden de Trabajo', 'url'=>array('create'), 'visible'=>Yii::app()->user->A1()||Yii::app()->user->JDP()||Yii::app()->user->A1()||Yii::app()->user->ADM()||Yii::app()->user->GG()),
	);
?>

<h2 class="text-center">Administrar Orden de Trabajo</h2>
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#guide-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php 
  	Yii::app()->clientScript->registerScript('detallesOT', 
  	"
	//jQuery(document).on('hover', '.mas_icon', function() {
    	$('#presupuesto-grid > table > tbody > tr .mas_icon').hover(function () {
    	//var id = $(this).parent().parent().find('td:first').text();
        var id = $(this).find('td:first').text();
        // var row = $(this).find('td:first');
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
				$(this).attr('data-toggle', 'tooltip');
				$(this).attr('title', data);
				$(this).tooltip();
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

      /*  $("#presupuesto-grid > table > tbody > tr").hover(function () {

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
            
        });*/
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
				'name'=>'VOBO_JEFE_DPTO',
				'value'=>'$data->VOBO_JEFE_DPTO==1? "../themes/default/img/icons/aprove.png":"../themes/default/img/icons/pending.png"',
                                'type'=>'image',
                        	//'value'=>'"../themes/default/img/icons/aprove.png"',
                                'filter'=>array(1=>'Aprobado',0=>'Pendiente'),
				'htmlOptions'=>array('width' =>	'10%', 'align'=>'center'),
			),
			array(
				'name'=>'VOBO_ADMIN',
				'value'=>'$data->VOBO_ADMIN==1? "../themes/default/img/icons/aprove.png":"../themes/default/img/icons/pending.png"',
                                'type'=>'image',
                        	//'value'=>'"../themes/default/img/icons/aprove.png"',
                                'filter'=>array(1=>'Aprobado',0=>'Pendiente'),
				'htmlOptions'=>array('width' =>	'10%', 'align'=>'center'),
			),
			
			array(
				'name'=>'VOBO_GERENTE_OP',
				'value'=>'$data->VOBO_GERENTE_OP==1? "../themes/default/img/icons/aprove.png":"../themes/default/img/icons/pending.png"',
                                'type'=>'image',
                        	//'value'=>'"../themes/default/img/icons/aprove.png"',
                                'filter'=>array(1=>'Aprobado',0=>'Pendiente'),
				'htmlOptions'=>array('align'=>'center'),
			),
			array(
				'name'=>'VOBO_GERENTE_GRAL',
				'value'=>'$data->VOBO_GERENTE_GRAL==1? "../themes/default/img/icons/aprove.png":"../themes/default/img/icons/pending.png"',
                                'type'=>'image',
                        	//'value'=>'"../themes/default/img/icons/aprove.png"',
                                'filter'=>array(1=>'Aprobado',0=>'Pendiente'),
				'htmlOptions'=>array('align'=>'center'),
			),
			
		
			/*array(
				'name'=>'VOBO_GERENTE_GRAL',
				'value'=>'$data->VOBO_GERENTE_GRAL==1? $data->FECHA_VOBO_GG:""',
				'htmlOptions'=>array('width' =>	'10%'),
			),*/
			
            array(
                   'name' => 'check',
                   'header'=>'Seleccionar',
                   'id' => 'selectedIds',
                   'value' => '$data->ID_OT',
                   'class' => 'CCheckBoxColumn',
                   'selectableRows' => '100',
                   'htmlOptions'=>array('align'=>'center'),
               ),
			array(	'class'=>'CButtonColumn',
					'template'=>'{more}{view}{update}{delete}',
					'header'=>'Opciones',
					'buttons'=>array(
						'more' => array(
							'label' => 'Mas',
							'options' => array('class'=>'mas_icon', 'prevent'=>'default'),
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

<?php 
 
    
    echo CHtml::ajaxLink("Aprobar Order de Trabajo", $this->createUrl('ordenTrabajo/aprobarOT'), array(
        "type" => "post",
        "data" => 'js:{theIds : $.fn.yiiGridView.getChecked("presupuesto-grid","selectedIds").toString()}',
        "success" => 'js:function(data){ $.fn.yiiGridView.update("guide-grid"); location.reload();  }' ),array(
        'class' => 'btn btn-success'
        )
        );
    echo "  ";
    echo CHtml::ajaxLink("Marcar como Pendiente", $this->createUrl('ordenTrabajo/CambiarPendiente'), array(
        "type" => "post",
        "data" => 'js:{theIds : $.fn.yiiGridView.getChecked("presupuesto-grid","selectedIds").toString()}',
        "success" => 'js:function(data){ $.fn.yiiGridView.update("guide-grid"); location.reload();  }' ),array(
        'class' => 'btn btn-warning'
        )
        );

 
?>