<?php
/* @var $this EquipoController */
/* @var $data Equipo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EQUIPO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_EQUIPO), array('view', 'id'=>$data->ID_EQUIPO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TAG_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->TAG_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TIPO_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_TIPO_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_MODELO_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_MODELO_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIEMPO_MANTENCION')); ?>:</b>
	<?php echo CHtml::encode($data->TIEMPO_MANTENCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('YEAR_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->YEAR_EQUIPO); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('NUMERO_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->NUMERO_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UBICACION_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->UBICACION_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAPACIDAD')); ?>:</b>
	<?php echo CHtml::encode($data->CAPACIDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_ADQUISICION')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_ADQUISICION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_EMPRESA')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_EMPRESA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IMAGEN_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->IMAGEN_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESTADO_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->ESTADO_EQUIPO); ?>
	<br />

	*/ ?>

</div>