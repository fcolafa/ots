<?php
/* @var $this UsuariosController */
/* @var $data Usuarios */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_USUARIO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_USUARIO), array('view', 'id'=>$data->ID_USUARIO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_USUARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONTRASENA')); ?>:</b>
	<?php echo CHtml::encode($data->CONTRASENA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_TIPO_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->COD_TIPO_USUARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_PERSONA')); ?>:</b>
	<?php echo CHtml::encode($data->ID_PERSONA); ?>
	<br />


</div>