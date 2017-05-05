<?php
/* @var $this EspecifTecnicasController */
/* @var $data EspecifTecnicas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_ESPEC_TECNICA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_ESPEC_TECNICA), array('view', 'id'=>$data->ID_ESPEC_TECNICA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_PIEZA')); ?>:</b>
	<?php echo CHtml::encode($data->ID_PIEZA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CARACTERISTICA')); ?>:</b>
	<?php echo CHtml::encode($data->CARACTERISTICA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION); ?>
	<br />


</div>