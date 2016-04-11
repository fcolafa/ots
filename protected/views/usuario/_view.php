<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_USUARIO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->NOMBRE_USUARIO), array('view', 'id'=>$data->NOMBRE_USUARIO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_TIPO_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->COD_TIPO_USUARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUT_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->RUT_USUARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_PERSONA')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_PERSONA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('APELLIDO_PERSONA')); ?>:</b>
	<?php echo CHtml::encode($data->APELLIDO_PERSONA); ?>
	<br />



</div>