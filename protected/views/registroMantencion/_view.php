<?php
/* @var $this RegistroMantencionController */
/* @var $data RegistroMantencion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_REGISTRO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_REGISTRO), array('view', 'id'=>$data->ID_REGISTRO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_REGISTRO')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_REGISTRO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REGISTRO_MARCADO')); ?>:</b>
	<?php echo CHtml::encode($data->REGISTRO_MARCADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COMENTARIO_REGISTRO')); ?>:</b>
	<?php echo CHtml::encode($data->COMENTARIO_REGISTRO); ?>
	<br />


</div>