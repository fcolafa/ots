<?php
/* @var $this DepartamentosController */
/* @var $data Departamentos */
?>

<div class="view">

	<font size="3">
		<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_DEPARTAMENTO')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->NOMBRE_DEPARTAMENTO), array('view', 'id'=>$data->ID_DEPARTAMENTO)); ?>
		<br />
	</font>

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION_DEPARTAMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION_DEPARTAMENTO); ?>
	<br />


</div>