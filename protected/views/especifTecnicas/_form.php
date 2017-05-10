
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tables.css" />

<div class="form">

<?php $form2=$this->beginWidget('CActiveForm', array(
	'id'=>'especif-tecnica-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form2->errorSummary($model); ?>

	<div class="row">
        <div class="guide update">
            <table>
                <thead>
                    <tr>
                        <th>Pieza</th> 
                        <th>Característica</th> 
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>           

		            <tr>
		                <td>
		                    <?= $form2->dropDownList($model, 'ID_PIEZA', CHtml::listData(PiezasEquipos::model()->findAll(array('condition' => 'ID_EQUIPO=' . $model->ID_EQUIPO, 'order'=>'NOMBRE_PIEZA')), 'ID_PIEZA', 'NOMBRE_PIEZA')); ?>
		                    <?= $form2->error($model, 'ID_PIEZA'); ?> 
		                </td>
		                <td>
		                    <?= $form2->textField($model, 'CARACTERISTICA'); ?>
		                    <?= $form2->error($model, 'CARACTERISTICA'); ?>    
		                </td>
		                <td>
		                    <?= $form2->textField($model, 'DESCRIPCION'); ?>
		                    <?= $form2->error($model, 'DESCRIPCION'); ?>  
		                </td>
		                <td> 
		                    <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions', 'Create') : Yii::t('actions', 'Grabar'), array('onclick' => "js:function(){ }")); ?>
		                </td>
		            </tr>
            	</tbody>
            </table>
        </div>
    </div>
    <?php $this->endWidget(); ?>
    

</div><!-- form -->