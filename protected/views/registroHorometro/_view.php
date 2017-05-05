<?php
/* @var $this RegistroHorometroController */
/* @var $data RegistroHorometro */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_REGISTRO_HOROM')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_REGISTRO_HOROM), array('view', 'id'=>$data->ID_REGISTRO_HOROM)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EQUIPO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EQUIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_REGISTRO')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_REGISTRO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOROMETRO')); ?>:</b>
	<?php echo CHtml::encode($data->HOROMETRO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_USUARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OBSERVACION')); ?>:</b>
	<?php echo CHtml::encode($data->OBSERVACION); ?>
	<br />


</div>