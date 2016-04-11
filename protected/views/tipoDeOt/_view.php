<?php
/* @var $this TipoDeOtController */
/* @var $data TipoDeOt */
?>

<div class="view">

	<font size="3">	
		<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_TIPO_OT')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->NOMBRE_TIPO_OT), array('view', 'id'=>$data->ID_TIPO_OT)); ?>
		<br />
	</font>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION_TIPO_OP')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION_TIPO_OP); ?>
	<br />


</div>