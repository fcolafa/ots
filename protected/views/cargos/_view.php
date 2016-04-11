<?php
/* @var $this CargosController */
/* @var $data Cargos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CARGO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_CARGO), array('view', 'id'=>$data->ID_CARGO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EMPRESA')); ?>:</b>
	<?php echo CHtml::encode($data->iDEMPRESA->NOMBRE_EMPRESA).", ".CHtml::encode($data->iDEMPRESA->NOMBRE_EMPRESA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPENDENCIA_CARGO')); ?>:</b>
	<?php echo CHtml::encode(@$data->cargos2->NOMBRE_CARGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_CARGO')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_CARGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION_CARGO')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION_CARGO); ?>
	<br />


</div>