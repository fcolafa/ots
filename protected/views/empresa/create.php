<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	//'Empresas'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Ver Documentos Contratista', 'url'=>array('index')),
	array('label'=>'Administrar Empresas', 'url'=>array('admin')),
);

?>

<h2 class="text-center">Crear Empresa</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>