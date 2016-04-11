<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	//'Empresas'=>array('index'),
	$model->ID_EMPRESA=>array('view','id'=>$model->ID_EMPRESA),
	'Modificar',
);



?>

<h2 class="text-center">Modificar Empresa <?php echo $model->NOMBRE_EMPRESA; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>