<?php
/* @var $this NivelAprobacionController */
/* @var $data NivelAprobacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_NIVEL_APROB')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_NIVEL_APROB), array('view', 'id'=>$data->ID_NIVEL_APROB)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TIPO_DOC')); ?>:</b>
	<?php echo CHtml::encode($data->ID_TIPO_DOC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_NIVEL')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_NIVEL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NIVEL_APROB')); ?>:</b>
	<?php echo CHtml::encode($data->NIVEL_APROB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MONTO_APROB')); ?>:</b>
	<?php echo CHtml::encode($data->MONTO_APROB); ?>
	<br />


</div>