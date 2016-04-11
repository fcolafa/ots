<?php
/* @var $this EmpresaController */
/* @var $data Empresa */
?>

<div class="view">

	<font size ="4">

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_EMPRESA')); ?>:</b>.
	<?php echo CHtml::link(CHtml::encode($data->NOMBRE_EMPRESA), array('view', 'id'=>$data->ID_EMPRESA)); ?>
	<?php //echo CHtml::encode($data->NOMBRE_EMPRESA); ?>
	<br />
</font>

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUT_EMPRESA')); ?>:</b>
	<?php echo CHtml::encode($data->RUT_EMPRESA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CASA_MATRIZ')); ?>:</b>
	<?php echo CHtml::encode($data->CASA_MATRIZ); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CIUDAD')); ?>:</b>
	<?php echo CHtml::encode($data->CIUDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FONO')); ?>:</b>
	<?php echo CHtml::encode($data->FONO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FAX')); ?>:</b>
	<?php echo CHtml::encode($data->FAX); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('URL_LOGO')); ?>:</b>
	<?php echo CHtml::encode($data->URL_LOGO); ?>
	<br />

	*/ ?>

</div>