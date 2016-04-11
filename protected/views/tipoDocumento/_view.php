<?php
/* @var $this TipoDocumentoController */
/* @var $data TipoDocumento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_TIPO_DOC')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_TIPO_DOC), array('view', 'id'=>$data->ID_TIPO_DOC)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_DOC')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_DOC); ?>
	<br />


</div>