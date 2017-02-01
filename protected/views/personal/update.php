<?php
/* @var $this PersonalController */
/* @var $model Personal */

?>
<h2 class="text-center">Modificar Datos <?php echo $model->NOMBRE_PERSONA; ?></h2>

<?php $this->renderPartial('_fasView', array('model'=>$model, 'usuario'=>$usuario,'aprovacion'=>$aprovacion, 'aprobados'=>$aprobados,)); ?>