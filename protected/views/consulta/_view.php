<?php
/* @var $this ConsultaController */
/* @var $data Consulta */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CONSULTA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_CONSULTA), array('view', 'id'=>$data->ID_CONSULTA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONSULTA')); ?>:</b>
	<?php echo CHtml::encode($data->CONSULTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_CONSULTA')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_CONSULTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPO_MENSAJE')); ?>:</b>
	<?php echo CHtml::encode($data->TIPO_MENSAJE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_PERSONA')); ?>:</b>
	<?php echo CHtml::encode($data->ID_PERSONA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_OT')); ?>:</b>
	<?php echo CHtml::encode($data->ID_OT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CONSULTADO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_CONSULTADO); ?>
	<br />


</div>