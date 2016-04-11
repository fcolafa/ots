<?php
/* @var $this PersonalController */
/* @var $data Personal */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_PERSONA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_PERSONA), array('view', 'id'=>$data->ID_PERSONA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_EMPRESA')); ?>:</b>
	<?php echo CHtml::encode($data->iDEMPRESA->NOMBRE_EMPRESA).", ".CHtml::encode($data->iDEMPRESA->NOMBRE_EMPRESA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUT_PERSONA')); ?>:</b>
	<?php echo CHtml::encode($data->RUT_PERSONA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_PERSONA')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_PERSONA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('APELLIDO_PERSONA')); ?>:</b>
	<?php echo CHtml::encode($data->APELLIDO_PERSONA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TELEFONO')); ?>:</b>
	<?php echo CHtml::encode($data->TELEFONO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMAIL')); ?>:</b>
	<?php echo CHtml::encode($data->EMAIL); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CARGO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_CARGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_DEPARTAMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_DEPARTAMENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ES_SUPERVISOR')); ?>:</b>
	<?php echo CHtml::encode($data->ES_SUPERVISOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_TIPO_USUARIO')); ?>:</b>
	<?php echo CHtml::encode($data->COD_TIPO_USUARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONTRASENA')); ?>:</b>
	<?php echo CHtml::encode($data->CONTRASENA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NIVEL_APROBACION')); ?>:</b>
	<?php echo CHtml::encode($data->NIVEL_APROBACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MONTO_APROBACION')); ?>:</b>
	<?php echo CHtml::encode($data->MONTO_APROBACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESTADO_TRABAJADOR')); ?>:</b>
	<?php echo CHtml::encode($data->ESTADO_TRABAJADOR); ?>
	<br />

	*/ ?>

</div>