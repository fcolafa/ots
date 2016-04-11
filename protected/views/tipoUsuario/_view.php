<?php
/* @var $this TipoUsuarioController */
/* @var $data TipoUsuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_TIPO_USUARIO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COD_TIPO_USUARIO), array('view', 'id'=>$data->COD_TIPO_USUARIO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_TIPO_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_TIPO_USUARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION_TIPO_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION_TIPO_USUARIO); ?>
	<br />


</div>