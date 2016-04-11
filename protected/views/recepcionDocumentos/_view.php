<?php
/* @var $this RecepciondocumentosController */
/* @var $data Recepciondocumentos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_RECEPCION')); ?>:</b>
	<?php echo CHtml::encode($data->ID_RECEPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_RECEPCION')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_RECEPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->ESTADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->iDCONTRATISTAS->getAttributeLabel('ID_CONTRATISTA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->iDCONTRATISTAS->NOMBRE_CONTRATISTA), array('view', 'id'=>$data->ID_CONTRATISTA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->iDDOCUMENTOS->getAttributeLabel('ID_DOCUMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->iDDOCUMENTOS->NOMBRE_DOCUMENTO); ?>
	<br />


</div>