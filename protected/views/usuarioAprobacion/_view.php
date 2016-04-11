<?php
/* @var $this UsuarioAprobacionController */
/* @var $data UsuarioAprobacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_USUARIO_APROBACION')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_USUARIO_APROBACION), array('view', 'id'=>$data->ID_USUARIO_APROBACION)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_USUARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_NIVEL_APROB')); ?>:</b>
	<?php echo CHtml::encode($data->ID_NIVEL_APROB); ?>
	<br />


</div>