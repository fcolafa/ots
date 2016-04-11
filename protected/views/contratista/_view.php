<?php
/* @var $this ContratistaController */
/* @var $data Contratista */
?>

<div class="view">

<font size="3">	
	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_EMPRESA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->NOMBRE_CONTRATISTA), array('view', 'id'=>$data->ID_CONTRATISTA)); ?>
	<br />
</font>

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUT_CONTRATISTA')); ?>:</b>
	<?php echo CHtml::encode($data->RUT_CONTRATISTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIRECCION_CONTRATISTA')); ?>:</b>
	<?php echo CHtml::encode($data->DIRECCION_CONTRATISTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CIUDAD_CONTRATISTA')); ?>:</b>
	<?php echo CHtml::encode($data->CIUDAD_CONTRATISTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TELEFONO_CONTRATISTA')); ?>:</b>
	<?php echo CHtml::encode($data->TELEFONO_CONTRATISTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GIRO_AREA')); ?>:</b>
	<?php echo CHtml::encode($data->GIRO_AREA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ENCARGADO')); ?>:</b>
	<?php echo CHtml::encode($data->ENCARGADO); ?>
	<br />

</div>