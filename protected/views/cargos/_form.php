<?php
/* @var $this CargosController */
/* @var $model Cargos */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cargos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class'=>'form-horizontal'),
)); ?>
	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php $empresa = Yii::app()->user->getEmpresaUser(); ?>
		
		<div class="span3">

			<?php echo $form->labelEx($model,'ID_EMPRESA'); ?>
			<?php echo $form->dropDownList($model,'ID_EMPRESA', CHtml::listData(Empresa::model()->findAll(), 'ID_EMPRESA', 'NOMBRE_EMPRESA'),
                                     array(
                            'class' => 'span12',
                            'empty' => 'Indicar Empresa',
                                            'maxlength'=>80,
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('cargos/getCargos'),
                            'update' => '#' . CHtml::activeId($model, 'DEPENDENCIA_CARGO'),
                        ))); ?>
                         
			<?php echo $form->error($model,'ID_EMPRESA'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'NOMBRE_CARGO'); ?>
			<?php echo $form->textField($model,'NOMBRE_CARGO',array('class'=>'span12', 'maxlength'=>150)); ?>
			<?php echo $form->error($model,'NOMBRE_CARGO'); ?>
			</div>
		<div class="span3">
	              <?php
                 $lista_cargos = array();
            if (isset($model->DEPENDENCIA_CARGO)) {
                $id_dep = intval($model->DEPENDENCIA_CARGO);
                $lista_cargos = CHtml::listData(Departamentos::model()->findAllByAttributes(array('ID_DEPARTAMENTO' => $id_dep)), 'ID_CARGO', 'NOMBRE_CARGO');
            }

        ?>
			<?php 
				echo $form->labelEx($model,'DEPENDENCIA_CARGO');
				echo $form->dropDownList($model,'DEPENDENCIA_CARGO', $lista_cargos ,array( 'class'=>'form-control'));
				echo $form->error($model,'DEPENDENCIA_CARGO');
			?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="span10">
			<?php echo $form->labelEx($model,'DESCRIPCION_CARGO'); ?>
			<?php echo $form->textArea($model,'DESCRIPCION_CARGO',array('rows'=>2, 'class'=>'span12')); ?>
			<?php echo $form->error($model,'DESCRIPCION_CARGO'); ?>
		</div>
	</div>
	<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->