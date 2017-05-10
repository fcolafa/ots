
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tables.css" />

<div class="form">

<?php $form3=$this->beginWidget('CActiveForm', array(
	'id'=>'piezas-equipo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form3->errorSummary($model); ?>

	<div class="row">
        <div class="guide update">
            <table>
                <thead>
                    <tr>
                        <th>Nombre Pieza</th> 
                        <th>Descripción</th> 
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
		            <tr>
		                <td>
		                    <?= $form3->textField($model, 'NOMBRE_PIEZA'); ?>
		                    <?= $form3->error($model, 'NOMBRE_PIEZA'); ?>    
		                </td>
		                <td>
		                    <?= $form3->textField($model, 'DESCRIPCION_PIEZA'); ?>
		                    <?= $form3->error($model, 'DESCRIPCION_PIEZA'); ?>  
		                </td>
		                <td>
		                    <?php echo CHtml::activeFileField($model, 'IMAGEN_PIEZA'); ?>
		                    <?= $form3->error($model, 'IMAGEN_PIEZA'); ?>  
		                </td>
		                <td> 
		                    <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('actions', 'Create') : Yii::t('actions', 'Grabar'), array('name'=> 'submit_piezas', 'onclick' => "js:function(){ }")); ?>
		                </td>
		            </tr>
            	</tbody>
            </table>
        </div>
    </div>
    <?php $this->endWidget(); ?>
    

</div><!-- form -->