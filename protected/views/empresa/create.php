<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	//'Empresas'=>array('index'),
	'Crear',
);


?>

<h2 class="text-center">Crear Empresa</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>