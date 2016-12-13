<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$model->ID_TICKET=>array('view','id'=>$model->ID_TICKET),
	'Modificar',
);

$this->menu=array(
	array('label'=>' Ticket', 'url'=>array('index')),
	array('label'=>'Crear Ticket', 'url'=>array('create')),
	array('label'=>'Ver Ticket', 'url'=>array('view', 'id'=>$model->ID_TICKET)),
	array('label'=>'Administrar Ticket', 'url'=>array('admin')),
);
?>

<h1>Modificar Ticket <?php echo $model->ID_TICKET; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>