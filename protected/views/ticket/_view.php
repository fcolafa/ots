<?php
/* @var $this TicketController */
/* @var $data Ticket */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TICKET')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_TICKET), array('view', 'id'=>$data->ID_TICKET)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ASUNTO_TICKET')); ?>:</b>
	<?php echo CHtml::encode($data->ASUNTO_TICKET); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION_TICKET')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION_TICKET); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_TICKET')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_TICKET); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_PERSONA')); ?>:</b>
	<?php echo CHtml::encode($data->ID_PERSONA); ?>
	<br />


</div>