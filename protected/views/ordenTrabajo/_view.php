<?php
/* @var $this OrdenTrabajoController */
/* @var $data OrdenTrabajo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_OT')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_OT), array('view', 'id'=>$data->ID_OT)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EMPRESA')); ?>:</b>
	<?php echo CHtml::encode($data->ID_EMPRESA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CONTRATISTA')); ?>:</b>
	<?php echo CHtml::encode($data->ID_CONTRATISTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USUARIO_CREADOR')); ?>:</b>
	<?php echo CHtml::encode($data->USUARIO_CREADOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SOLICITANTE')); ?>:</b>
	<?php echo CHtml::encode($data->SOLICITANTE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SUPERVISOR')); ?>:</b>
	<?php echo CHtml::encode($data->SUPERVISOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_DEPARTAMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_DEPARTAMENTO); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_EJECUCION')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_EJECUCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TIPO_OT')); ?>:</b>
	<?php echo CHtml::encode($data->ID_TIPO_OT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION_OT')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION_OT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_OT')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_OT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VOBO_JEFE_DPTO')); ?>:</b>
	<?php echo CHtml::encode($data->VOBO_JEFE_DPTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VOBO_ADMIN')); ?>:</b>
	<?php echo CHtml::encode($data->VOBO_ADMIN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VOBO_GERENTE_OP')); ?>:</b>
	<?php echo CHtml::encode($data->VOBO_GERENTE_OP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VOBO_GERENTE_GRAL')); ?>:</b>
	<?php echo CHtml::encode($data->VOBO_GERENTE_GRAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ARCHIVO_ADJUNTO')); ?>:</b>
	<?php echo CHtml::encode($data->ARCHIVO_ADJUNTO); ?>
	<br />

	*/ ?>

</div>