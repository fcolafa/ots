<?php
/* @var $this InsumosOtController */
/* @var $data InsumosOt */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_INSUMOS_OT')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_INSUMOS_OT), array('view', 'id'=>$data->ID_INSUMOS_OT)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_OT')); ?>:</b>
	<?php echo CHtml::encode($data->ID_OT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_SUB_ITEM')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_SUB_ITEM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COSTO_CONTRATISTA')); ?>:</b>
	<?php echo CHtml::encode($data->COSTO_CONTRATISTA); ?>
	<br />

</div>