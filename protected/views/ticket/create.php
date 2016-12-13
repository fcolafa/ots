<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Ticket', 'url'=>array('index')),
	array('label'=>'Administrar Ticket', 'url'=>array('admin')),
);
?>

<h1>Crear Ticket</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>