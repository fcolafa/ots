<?php
/* @var $this InsumosOtController */
/* @var $model InsumosOt */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'insumos-ot-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
<?php echo $form->hiddenField($model, 'ID_OT'); ?>
    </div>

    <div class="row mod_insumo">
        <div class="col-2">
            <?php echo $form->labelEx($model, 'NUMERO_SUB_ITEM'); ?>
<?php echo $form->textField($model, 'NUMERO_SUB_ITEM', array('size' => 60, 'maxlength' => 100, 'class' => 'col-8')); ?>
            <?php echo $form->error($model, 'NUMERO_SUB_ITEM'); ?>
        </div>
        <div class="col-4">
            <?php echo $form->labelEx($model, 'NOMBRE_SUB_ITEM'); ?>
<?php echo $form->textField($model, 'NOMBRE_SUB_ITEM', array('size' => 60, 'maxlength' => 200, 'class' => 'col-10')); ?>
            <?php echo $form->error($model, 'NOMBRE_SUB_ITEM'); ?>	
        </div>
        <div class="col-3">
            <?php echo $form->labelEx($model, 'COSTO_CONTRATISTA'); ?>
<?php echo $form->textField($model, 'COSTO_CONTRATISTA', array('size' => 10, 'maxlength' => 10)); ?>
            <?php echo $form->error($model, 'COSTO_CONTRATISTA'); ?>
        </div>
        <div class="col-2">
            <?php echo $form->labelEx($model, 'NRO_COTIZACION'); ?>
<?php echo $form->textField($model, 'NRO_COTIZACION', array('size' => 50, 'maxlength' => 50)); ?>
<?php echo $form->error($model, 'NRO_COTIZACION'); ?>
        </div>
    </div>

    <div class="mod_insumo">
        <div class="col-3">
            <?php echo $form->labelEx($model, 'ID_CENTRO_COSTO'); ?>
            <?php
            $criteria = new CDbCriteria();
            $criteria->condition = "ID_EMPRESA=" . $model->iDOT->ID_EMPRESA;
            $criteria->order = 'NUMERO_CENTRO';
            echo $form->dropDownList($model, 'ID_CENTRO_COSTO', CHtml::listData(CentroDeCostos::model()->findAll($criteria), 'ID_CENTRO_COSTO', 'concatened'), 
                    array(
                
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('OrdenTrabajo/SelectCuentas'),
                    'update' => '#' . CHtml::activeId($model, 'ID_CCC'),
                    'beforeSend' => 'function(){
	                               $("#InsumosOT_ID_CCC").find("option").remove();
	                               $("#InsumosOT_ID_SCC").find("option").remove();
	                               $("#InsumosOT_ID_SEC").find("option").remove();
	                           }',
                ),
                'prompt' => 'Seleccione',
                    )
            );
            ?>
            <?php $form->error($model, 'ID_CENTRO_COSTO'); ?>
        </div>
        <div class="col-3">
            <label>Numero cuenta *</label>
            <?php //echo $form->labelEx($model,'ID_CCC'); ?>
            <?php
            $lista_dos = array();
            if (isset($model->ID_CCC)) {
                $id_cc = intval($model->ID_CENTRO_COSTO);
                $lista_dos = CHtml::listData(Ccc::model()->findAll("ID_CENTRO_COSTO='$id_cc'"), 'ID_CCC', 'concatened');
            }
            echo $form->dropDownList($model, 'ID_CCC', $lista_dos, array(
                
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('OrdenTrabajo/SelectSubCentros'),
                    'update' => '#' . CHtml::activeId($model, 'ID_SCC'),
                    'beforeSend' => 'function(){
	                          		$("#InsumosOT_ID_SCC").find("option").remove();
		                            $("#InsumosOT_ID_SEC").find("option").remove();
	                           	}',
                ),
                'prompt' => 'Seleccione')
            );
            echo $form->error($model, 'ID_CCC');
            ?>
            <?php $form->error($model, 'ID_CCC'); ?>
        </div>
        <div class="col-3">
            <?php //echo $form->labelEx($model,'ID_SCC');  ?>
            <label>Numero Subcentro Costo *</label>
            <?php
            $lista_tres = array();
            if (isset($model->ID_SCC)) {
                $id_ccc = intval($model->ID_CCC);
                $lista_tres = CHtml::listData(Scc::model()->findAll("ID_CCC='$id_ccc'"), 'ID_SCC', 'concatened');
            }
            echo $form->dropDownList($model, 'ID_SCC', $lista_tres, array(
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('OrdenTrabajo/SelectSecciones'),
                    'update' => '#' . CHtml::activeId($model, 'ID_SEC'),
                    'beforeSend' => 'function(){
	                            $("#InsumosOT_ID_SEC").find("option").remove();
	                       	}',
                ),
                'prompt' => 'Seleccione')
            );
            echo $form->error($model, 'ID_SCC');
            ?>
            <?php $form->error($model, 'ID_SCC'); ?>
        </div>
        <div class="col-3">
            <label>Numero Sección *</label>
<?php
$lista_cuatro = array();
if (isset($model->ID_SEC)) {
    $id_scc = intval($model->ID_SCC);
    $lista_cuatro = CHtml::listData(Sec::model()->findAll("ID_SCC='$id_scc'"), 'ID_SEC', 'concatened');
}
echo $form->dropDownList($model, 'ID_SEC', $lista_cuatro);
?>
            <?php $form->error($model, 'ID_SEC'); ?>
        </div>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->