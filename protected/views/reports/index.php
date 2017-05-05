<?php 
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/reports.js');
/* @var $this ReportsController */


$this->breadcrumbs = array(
    Yii::t('database', 'Reportes') => array('index'),
);
?>
<script type="text/javascript">
 $(document).ready(function () { 
       $('#Reports_company').change(function () {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?=Yii::app()->baseUrl?>/Contratista/getContratistas',
                data: {'id_emp': id,'all':1},
                beforeSend: function (xhr) {
                    if (xhr && xhr.overrideMimeType) {
                        xhr.overrideMimeType('application/json;charset=utf-8');
                    }
                },
                dataType: 'json',
                success: function (data) {
                    $('#Reports_contractor').html(data);
                }
            });
            $.ajax({
                type: 'POST',
                url: '<?=Yii::app()->baseUrl?>/CentroDeCostos/GetCentroDeCostos',
                data: {'id_emp': id},
                beforeSend: function (xhr) {
                    if (xhr && xhr.overrideMimeType) {
                        xhr.overrideMimeType('application/json;charset=utf-8');
                    }
                },
                dataType: 'json',
                success: function (data) {
                    $('#Reports_costc').html(data);
                }
            });
        });
 });
</script>
<div class="form">
    <div class="span2" >
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'Reports',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
   
  
        <div class="report">
            <?php if(Yii::app()->user->A1()|| Yii::app()->user->ADM()||Yii::app()->user->GG()){?>
        <div class="row ">
            <?php echo $form->labelEx($model, 'company'); ?>
            <?php echo $form->dropDownList($model, 'company', array('' => 'Indicar Empresa') + CHtml::listData(Empresa::model()->findAll(), 'ID_EMPRESA', 'NOMBRE_EMPRESA')); ?>
            <?php echo $form->error($model, 'company'); ?>
        </div>
            <?php }
?>

    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->dropDownList($model, 'type', $model->types(), array('prompt' => 'Seleccione tipo de reporte')); ?>
        <?php echo $form->error($model, 'type'); ?>  
    </div>
           
           <?php 
            $contratistas = array();
            $cc=array();
           
           if(!empty($model->company)){
                $idemp = intval($model->company);
                    
     
                $contratistas=CHtml::listData(Contratista::model()->findAllByAttributes(array('ID_EMPRESA' => $idemp),array('condition'=>'ID_CONTRATISTA<>105','order'=>'NOMBRE_CONTRATISTA ASC')), 'ID_CONTRATISTA', 'concatened');
                $cc = CHtml::listData(CentroDeCostos::model()->findAllByAttributes(array('ID_EMPRESA' => $idemp),array('order'=>'NOMBRE_CENTRO_COSTO ASC')), 'ID_CENTRO_COSTO', 'concatened');
                
                $cc[0]='---Seleccionar todo---';
                $contratistas[0]='---Seleccionar todo---';
                
               
           }
    ?>
    <div class="row" id="contractor">
        <?php echo $form->labelEx($model, 'contractor'); ?>
        <?php echo $form->dropDownList($model, 'contractor',$contratistas,array('multiple'=>'multiple')); ?>
        <?php echo $form->error($model, 'contractor'); ?>  
    </div>
    <div class="row" id="cc">
        
        <?php echo $form->labelEx($model, 'costc'); ?>
        <?php echo $form->dropDownList($model, 'costc',$cc, array('0'=>'Seleccionar Todos','multiple'=>'multiple')); ?>
        <?php echo $form->error($model, 'costc'); ?>  
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'range'); ?>
        <?php echo $form->dropDownList($model, 'range', $model->range(), array('prompt' => 'Seleccione rango de tiempo')); ?>
        <?php echo $form->error($model, 'range'); ?>  
    </div>
    
        <div class="row" id="range">
           <?php echo $form->labelEx($model,'initdate'); ?>
            <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
            $this->widget('CJuiDateTimePicker',array(
            'model'=>$model, //Model object
            'attribute'=>'initdate', //attribute name
                   'mode'=>'datetime', //use "time","date" or "datetime" (default)
            'options'=>array(
                'dateFormat'=>'dd-mm-yy',
                'maxDate' => 'today',
            ), // jquery plugin options
        ));?>
         <?php echo $form->error($model,'initdate'); ?>
            <?php echo $form->labelEx($model,'endate'); ?>
            <?php $this->widget('CJuiDateTimePicker',array(
            'model'=>$model, //Model object
            'attribute'=>'endate', //attribute name
                    'mode'=>'datetime', //use "time","date" or "datetime" (default)
            'options'=>array(
                'dateFormat'=>'dd-mm-yy',
                'maxDate' => 'today',
            ), // jquery plugin options
        ));?>  
        <?php echo $form->error($model,'endate'); ?>

    </div>
            <div class="row button-column">
                <?php echo CHtml::submitButton(Yii::t('actions', 'Cargar Datos'), array('name' => 'loadData','class'=>'btn btn-success' )); ?>
                <br><br>
                <?php
                if (!empty($model->data))
                    echo CHtml::submitButton(Yii::t('actions',  'Generar Documento Excel'), array('name' => 'generatexls','class'=>'btn btn-success'));
                ?>
            </div>
        </div>
    </div>
    
    <div style="width: 85%;float:right; min-height: 500px;">
         <?php echo $form->errorSummary($model); ?>
        <?php   
        if(!empty($model->data)){
            $tabs=  $this->setReport($model->data);
	$this->widget('zii.widgets.jui.CJuiTabs',array(
   		'tabs'=>$tabs,
   		'options'=>array(
       		'collapsible'=>true,
       		'disabled' => 1,
    	),
 	    'htmlOptions'=>array(
        'style'=>'min-width:1000px;'
    	),

    	'id'=>'MyTabOTs',
	));

        }
        ?>
    </div>
   

</div>
    <?php $this->endWidget(); ?>
<script type="text/javascript">
range();   
</script>