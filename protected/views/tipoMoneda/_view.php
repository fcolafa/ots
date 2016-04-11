<?php
/* @var $this TipoMonedaController */
/* @var $data TipoMoneda */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TIPO_MONEDA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_TIPO_MONEDA), array('view', 'id'=>$data->ID_TIPO_MONEDA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPO_MONEDA')); ?>:</b>
	<?php echo CHtml::encode($data->TIPO_MONEDA); ?>
	<br />


</div>