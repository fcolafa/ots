<?php
/* @var $this DocumentosContratistaController */
/* @var $data DocumentosContratista */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_DOCUMENTO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_DOCUMENTO), array('view', 'id'=>$data->ID_DOCUMENTO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_DOCUMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_DOCUMENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION); ?>
	<br />


</div>