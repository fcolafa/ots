
<div id="msg_warnning" class="alert alert-warning" style="display: none">

</div>

<div class="form" style="min-width:800px; max-width:1000px;">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'equipo-form',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
    
    <div class="row">
        <div class="row">Campos con <span class="required">*</span> son obligatorios.</div>
        <br>         
    </div>

    <div class="row">
        <div class="span5">
            <?php echo $form->labelEx($model,'NOMBRE_EQUIPO'); ?>
            <?php echo $form->textField($model,'NOMBRE_EQUIPO', array('class' => 'span12')); ?>
            <?php echo $form->error($model,'NOMBRE_EQUIPO'); ?>
        </div>
        <div class="span2">
            <?php echo $form->labelEx($model,'NUMERO_EQUIPO'); ?>
            <?php echo $form->textField($model,'NUMERO_EQUIPO', array('class' => 'span12')); ?>
            <?php echo $form->error($model,'NUMERO_EQUIPO'); ?>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'ID_MODELO_EQUIPO'); ?>
            <?php echo $form->dropDownList($model, 'ID_MODELO_EQUIPO', array('' => 'Marca - Modelo') + CHtml::listData(ModelEquipo::model()->findAll(array('order' => 'ID_MODELO_EQUIPO ASC')), 'ID_MODELO_EQUIPO', 'marcaEquipos.NOMBRE_MARCA_EQUIPO', 'NOMBRE_MODELO_EQUIPO'), array('class' => 'span12')); ?>
            <?php echo $form->error($model, 'ID_MODELO_EQUIPO'); ?>
        </div>
    </div>

    <div class="row">
        <div class="span3">
            <?php echo $form->labelEx($model,'YEAR_EQUIPO'); ?>
            <?php echo $form->textField($model,'YEAR_EQUIPO', array('class' => 'span12')); ?>
            <?php echo $form->error($model,'YEAR_EQUIPO'); ?>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'FECHA_ADQUISICION'); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'OrdenTrabajo[FECHA_ADQUISICION]',
                'language' => 'es',
                'id' => 'fecha_adq',
                'flat' => false,
                'value' => Yii::app()->dateFormatter->format('dd-MM-yyyy', $model->FECHA_ADQUISICION),
                'options' => array(
                    'firstDay' => 1,
                    'showAnim' => 'fold',
                    'constrainInput' => true,
                    'currentText' => 'Now',
//                              'dateFormat' => 'yy-mm-dd',
                    'dateFormat' => 'dd-mm-yy',
                    'altField' => '#FECHA_ADQUISICION',
                    'buttonImage' => Yii::app()->baseUrl . '/images/Iconos/calendario.png', 'buttonImageOnly' => true, 'showButtonPanel' => true, 'showOn' => 'both',
                ),
                'htmlOptions' => array(
                    'style' => 'height:20px;',
                    'onchange' => 'Asignate(this)',
                    'class' => 'text-right span9'
                ),
            ));
            ?>
            <?php echo $form->error($model, 'FECHA_ADQUISICION'); ?>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'FECHA_EMPRESA'); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'OrdenTrabajo[FECHA_EMPRESA]',
                'language' => 'es',
                'id' => 'fecha_emp',
                'flat' => false,
                'value' => Yii::app()->dateFormatter->format('dd-MM-yyyy', $model->FECHA_EMPRESA),
                'options' => array(
                    'firstDay' => 1,
                    'showAnim' => 'fold',
                    'constrainInput' => true,
                    'currentText' => 'Now',
//                              'dateFormat' => 'yy-mm-dd',
                    'dateFormat' => 'dd-mm-yy',
                    'altField' => '#FECHA_EMPRESA',
                    'buttonImage' => Yii::app()->baseUrl . '/images/Iconos/calendario.png', 'buttonImageOnly' => true, 'showButtonPanel' => true, 'showOn' => 'both',
                ),
                'htmlOptions' => array(
                    'style' => 'height:20px;',
                    'onchange' => 'Asignate(this)',
                    'class' => 'text-right span9'
                ),
            ));
            ?>
            <?php echo $form->error($model, 'FECHA_EMPRESA'); ?>
        </div>
        <div class="span2">
            <?php echo $form->labelEx($model,'CAPACIDAD'); ?>
            <?php echo $form->textField($model,'CAPACIDAD', array('class' => 'span12')); ?>
            <?php echo $form->error($model,'CAPACIDAD'); ?>
        </div>
    </div>

    <div class="row">
        <div class="span4">
            <?php echo $form->labelEx($model,'UBICACION_EQUIPO'); ?>
            <?php echo $form->textField($model,'UBICACION_EQUIPO', array('class' => 'span12')); ?>
            <?php echo $form->error($model,'UBICACION_EQUIPO'); ?>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model,'TIEMPO_MANTENCION'); ?>
            <?php echo $form->textField($model,'TIEMPO_MANTENCION', array('class' => 'span12')); ?>
            <?php echo $form->error($model,'TIEMPO_MANTENCION'); ?>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model,'IMAGEN_EQUIPO'); ?>
            <?php echo CHtml::activeFileField($model,'IMAGEN_EQUIPO',array('class'=>'span12')); ?>
            <?php echo $form->error($model,'archivo'); ?>
        </div>   
    </div>

    <HR>
    <div class="row">
        <font size="4"><?php echo $form->labelEx($model,'DESCRIPCION_EQUIPO'); ?> </font>
        <?php $this->widget('ext.jqueryte.Jqueryte', array(
                'id'=>'DESCRIPCION_EQUIPO',
                'model'=>$model,
                'attribute'=>'DESCRIPCION_EQUIPO',
                'value'=>$model->DESCRIPCION_EQUIPO,
                'options'   => array(
                    'strike'=> false,
                    'sub'=>false,
                    'source'=>false,
                    'button'=>'SEND',
                    //'format'=>false,
                    'formats'=>'[["p","Paragraph"],["h1","My Head 1"]]',
                   // 'fsizes'=>'["10", "15", "20"]',   
                   // 'linktypes'=>'["Web URL", "E-mail", "Picture"]',
                ),
             ));
        ?>
        <?php echo $form->error($model,'DESCRIPCION_EQUIPO'); ?>
    </div>

    <div class="row" id="reportarerror"></div>

    <div class="row">
        <div class="span3" style="margin-top: 25px;">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Modificar', array('class' => 'offset1 btn btn-success', 'name' => 'submit_equipo')); ?>     
        </div>  
    </div>

     <?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    /* Invierte la fecha */
    function Asignate(target)
    {
        var choose = target.value;
        if(target.id == 'fecha_adq')
        {
            var pieces = choose.split('-');
            pieces.reverse();
            var reversed = pieces.join('-');
            document.getElementById('fecha_adq').value = reversed;
            document.getElementById('fecha_adq').value = choose;
        }else if(target.id == 'fecha_emp')
        {
            var pieces = choose.split('-');
            pieces.reverse();
            var reversed = pieces.join('-');
            document.getElementById('fecha_emp').value = reversed;
            document.getElementById('fecha_emp').value = choose;
        }
    }
</script>