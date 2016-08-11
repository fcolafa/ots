<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->breadcrumbs=array(
	//'Personals'=>array('index'),
	$model->ID_PERSONA,
);

$this->menu=array(
	array('label'=>'Ver Personal', 'url'=>array('index')),
	array('label'=>'Crear Personal', 'url'=>array('create')),
	array('label'=>'Actualizar Personal', 'url'=>array('update', 'id'=>$model->ID_PERSONA)),
	array('label'=>'Borrar Personal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_PERSONA),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	array('label'=>'Administrar Personal', 'url'=>array('admin')),
);
?>

<h2 class="text-center">Personal <?php echo $model->NOMBRE_PERSONA; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_PERSONA',
		array(
			'name'=>'ID_EMPRESA',
			'value'=>$model->iDEMPRESA->NOMBRE_EMPRESA,
		 ),
		'RUT_PERSONA',
		'NOMBRE_PERSONA',
		'APELLIDO_PERSONA',
		'TELEFONO',
		'EMAIL',
		array(
			'name'=>'ID_CARGO',
			'value'=>@$model->iDCARGO->NOMBRE_CARGO,
		 ),
		array(
			'name'=>'ID_DEPARTAMENTO',
			'value'=>@$model->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO,
		 ),
		array(
			'name'=>'ES_SUPERVISOR',
			'value'=>($model->ES_SUPERVISOR=="0")?"No":"Si",	
			),
		array(
			'name'=>'ESTADO_TRABAJADOR',
			'value'=>($model->ESTADO_TRABAJADOR=="0")?"Activo":"Inactivo",	
			),
              
	),
));
                        echo CHtml::link('<div  class="btn btn-error">
		    	<h4> <span class="glyphicon glyphicon-ok"></span> Restablecer contraseña</h4>
			</div>', 
			array('Personal/resetPersonal', 'id'=>$model->ID_PERSONA),
                        array('confirm' => 'Esta seguro que desea restablecer la contraseña?'));   
?>
