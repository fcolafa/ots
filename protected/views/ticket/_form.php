<?php
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/addCotFile.js');
?>
<script type="text/javascript">
     $(document).ready(function () {
      
<?php
if ($model->_files) {
    $files = $model->_files;
    $jfiles = json_encode($files);
    echo "var jfiles = " . $jfiles . ";\n";
    echo "for(var j in jfiles){ ";
    echo "item=jfiles[j];";
    echo "addFiles('tblFile','Ticket__files',item);";
    echo "indexcot=indexcot+1;" ;
    echo "}";
}
?>
    });
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ASUNTO_TICKET'); ?>
		<?php echo $form->textField($model,'ASUNTO_TICKET',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'ASUNTO_TICKET'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DESCRIPCION_TICKET'); ?>
		<?php echo $form->textArea($model,'DESCRIPCION_TICKET',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DESCRIPCION_TICKET'); ?>
	</div>
             <div class="row">
            <label></label>
        <?php 

        $this->widget('ext.EFineUploader.EFineUploader',
         array(
               'id'=>'FineUploader',
               'config'=>array(
                   'autoUpload'=>true,
                   'multiple'=> true,
                   
                  
        
                               'request'=>array(
                                  'endpoint'=>$this->createUrl('ordenTrabajo/upload'),
                                  'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                               ),
                               'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                               'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                               'callbacks'=>array(
                                                //'onComplete'=>"js:function(id, name, response){ $('li.qq-upload-success').remove(); }",
                                                //'onError'=>"js:function(id, name, errorReason){ }",
                                                 ),
                               'validation'=>array(
                                         'allowedExtensions'=>array('pdf','jpg','jpeg','png','txt','rtf','doc','docx','xls','xlsx','gif','ppt','pptx'),
                                         'sizeLimit'=>5 * 1024 * 1024,//maximum file size in bytes
                                       //  'minSizeLimit'=>0*1024*1024,// minimum file size in bytes
                                                  ),
                   'callbacks'=>array(
          'onComplete'=>"js:function(id, name, response){
             
               $('#Ticket__files').append(new Option(response.filename, response.filename, true, true));          
             addFiles('tblFile','Ticket__files',response.filename);
             indexcot=indexcot+1; 
             
           }",
           'onError'=>"js:function(id, name, errorReason){ }",
          'onValidateBatch' => "js:function(fileOrBlobData) {}", // because of crash
        ),
                              )
              ));

        ?>
        </div>
        <div class="row" style="display:none">		
        <?php echo $form->dropdownlist($model, '_files', $model->_files, array('multiple' => 'multiple')); ?>
        </div>
        <table  class="">
               <thead id="tblCotHead">
                               
               </thead>
               <tbody id="tblFile">

               </tbody>           
        </table>
        <div class="row">
            <label></label>
            
            <?php $this->widget('CCaptcha'); ?>
        </div>
        

        <div class="row">
               <?php echo $form->labelEx($model,'_verifyCode'); ?>
               <?php echo $form->textField($model,'_verifyCode'); ?>
               <?php echo $form->error($model,'_verifyCode'); ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->