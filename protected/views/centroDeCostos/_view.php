<?php
/* @var $this CentroDeCostosController */
/* @var $data CentroDeCostos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CENTRO_COSTO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_CENTRO_COSTO), array('view', 'id'=>$data->ID_CENTRO_COSTO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EMPRESA')); ?>:</b>
	<?php echo CHtml::encode($data->iDEMPRESA->NOMBRE_EMPRESA).", ".CHtml::encode($data->iDEMPRESA->NOMBRE_EMPRESA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CLIENTE')); ?>:</b>
	<?php echo CHtml::encode($data->ID_CLIENTE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NUMERO_CENTRO')); ?>:</b>
	<?php echo CHtml::encode($data->NUMERO_CENTRO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_CENTRO_COSTO')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_CENTRO_COSTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION_CENTRO_COSTO')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION_CENTRO_COSTO); ?>
	<br />


</div>