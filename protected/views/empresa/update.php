<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	//'Empresas'=>array('index'),
	$model->ID_EMPRESA=>array('view','id'=>$model->ID_EMPRESA),
	'Modificar',
);
$this->menu=array(
	//array('label'=>'Ver Documentos Contratista', 'url'=>array('index')),
	array('label'=>'Administrar Empresas', 'url'=>array('admin')),
	array('label'=>'Crear Empresas', 'url'=>array('create')),
);


?>

<h2 class="text-center">Modificar Empresa <?php echo $model->NOMBRE_EMPRESA; ?></h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>