<?php
/* @var $this PersonalController */
/* @var $model Personal */
/* @var $form CActiveForm */
?>

<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/Masks.js');?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/Validates.js');?>

<script type="text/javascript">
     
	$( document ).ready(function() {
		//$('#formApruebaDocs').hide();
		if ( !$('.checkUsuario').is(':checked') ) {
			$('#formUsuario').hide();
		}

		if ( !$('#checkDocumentacion').is(':checked') ) {
			$('#formDocumentacion').hide();
		}

		$('.checkUsuario').click(function(){
			if (!$(this).is(':checked')) {
	            $('#formUsuario').hide("fast");
	        }else{
	        	$('#formUsuario').show("fast");
	        	$('#Usuarios_NOMBRE_USUARIO').val('');
	        	$('#Usuarios_CONTRASENA').val('');
	        }
		});

		$('#checkDocumentacion').click(function(){
			if (!$(this).is(':checked')) {
	            $('#formDocumentacion').hide("fast");
	        }else{
	        	$('#formDocumentacion').show("fast");
	        }
		});
                
                      $('#Personal_ID_EMPRESA').change(function () {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: "<?php echo $model->isNewRecord?"../Cargos/GetCargos":"../../Cargos/GetCargos"; ?>",
                data: {'id_emp': id},
                beforeSend: function (xhr) {
                    if (xhr && xhr.overrideMimeType) {
                        xhr.overrideMimeType('application/json;charset=utf-8');
                    }
                },
                dataType: 'json',
                success: function (data) {
                    $('#Personal_ID_CARGO').html(data);
                }
            });
        });
	});
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'personal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary(array($model, $usuario, $aprovacion)); ?>
            
	<div class="row">
				
		<div class="span3">
                <?php echo $form->labelEx($model,'RUT_PERSONA', array('class'=>'valida_rut')); ?>
                <?php echo $form->textField($model,'RUT_PERSONA',array('class'=>'span12 text-right','maxlength'=>13,'placeholder'=>'Ejemplo: 12345678-9', 'onkeyup' =>"this.value = MaskRut(this.value,true); ValidateRut(this.value);", 'is_numeric'=>"true")) ; ?>
                <?php echo $form->error($model,'RUT_PERSONA'); ?>
		</div>
		
		<div class="span4">
		<?php echo $form->labelEx($model,'NOMBRE_PERSONA'); ?>
		<?php echo $form->textField($model,'NOMBRE_PERSONA',array('class'=>'span12', 'maxlength'=>80)); ?>
		<?php echo $form->error($model,'NOMBRE_PERSONA'); ?>
		</div>

	<div class="span4">		
		<?php echo $form->labelEx($model,'APELLIDO_PERSONA'); ?>
		<?php echo $form->textField($model,'APELLIDO_PERSONA',array('class'=>'span12', 'maxlength'=>80)); ?>
		<?php echo $form->error($model,'APELLIDO_PERSONA'); ?>
	</div>
		
		
	</div>
	
	<div class="row">
		<div class="span3">
			<b><?php echo $form->labelEx($model,'TELEFONO'); ?></b>
			<?php echo $form->textField($model,'TELEFONO',array('class'=>'span12', 'maxlength'=>80)); ?>
			<?php echo $form->error($model,'TELEFONO'); ?>
		</div>

		<div class="span4">
			<?php echo $form->labelEx($model,'EMAIL'); ?>
			<?php echo $form->textField($model,'EMAIL',array('class'=>'span12', 'maxlength'=>80)); ?>
			<?php echo $form->error($model,'EMAIL'); ?>
		</div>	

		<div class="span2">
		<?php $mUsuario= Usuarios::model()->findbyAttributes(array('NOMBRE_USUARIO'=>Yii::app()->user->id));		
                if ( Yii::app()->user->JDP() || Yii::app()->user->A1() || Yii::app()->user->ADM()){
                                echo $form->labelEx($model,'ES_SUPERVISOR');
                                echo $form->checkBox($model,'ES_SUPERVISOR');}?>
            <?php echo $form->error($model,'ES_SUPERVISOR');?>
		</div>
		
	</div>


	<div class="row">
	<div class="span3">
		<?php echo $form->labelEx($model,'ID_EMPRESA'); ?>
		<?php echo $form->dropDownList($model,'ID_EMPRESA', CHtml::listData(Empresa::model()->findAll(), 'ID_EMPRESA', 'NOMBRE_EMPRESA'),
                       array(
                            'class' => 'span12',
                            'empty' => 'Indicar Empresa',
                                            'maxlength'=>80,
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('departamentos/getDepartamentos2'),
                            'update' => '#' . CHtml::activeId($model, 'ID_DEPARTAMENTO'),
            ))); ?>
		<?php echo $form->error($model,'ID_EMPRESA'); ?>
	</div>
		
            
                 <?php
                 $lista_dep = array();
                 $lista_cargos= array();
            if(isset($model->ID_EMPRESA)){
                $id_emp = intval($model->ID_EMPRESA);
                $lista_cargos = CHtml::listData(Cargos::model()->findAllByAttributes(array('ID_EMPRESA' => $id_emp)), 'ID_CARGO', 'NOMBRE_CARGO');
            }
                
            if (isset($model->ID_DEPARTAMENTO)) {
                $id_dep = intval($model->ID_DEPARTAMENTO);
                $lista_dep = CHtml::listData(Departamentos::model()->findAllByAttributes(array('ID_DEPARTAMENTO' => $id_dep)), 'ID_DEPARTAMENTO', 'NOMBRE_DEPARTAMENTO');
                
            }

        ?>
	<div class="span4">
		<?php echo $form->labelEx($model,'ID_DEPARTAMENTO'); ?>
		<?php echo $form->dropDownList($model,'ID_DEPARTAMENTO',$lista_dep,array( 'class'=>'span12', 'maxlength'=>80)); ?>
		<?php echo $form->error($model,'ID_DEPARTAMENTO'); ?>
	</div>
		
	<div class="span4">
		<?php echo $form->labelEx($model,'ID_CARGO'); ?>
		<?php echo $form->dropDownList($model,'ID_CARGO',$lista_cargos, array( 'class'=>'span12', 'maxlength'=>80)); ?>
		<?php echo $form->error($model,'ID_CARGO'); ?>
	</div>
	</div>

	<div class="row">	
		<?php if(!$model->isNewRecord) : ?>
		<div class="span3">
                <?php echo $form->labelEx($model,'ESTADO_TRABAJADOR'); ?>
            <?php echo $form->dropDownList($model,'ESTADO_TRABAJADOR',array('0'=>'Activo','1'=>'Inactivo'),array('class'=>'span12', 'maxlength'=>80)) ?>
        </div>
		<?php endif; ?>
	</div>	

	<br>
        
	<div class="row">
		<div class="span3">
			<?php echo $form->labelEx($model,'ES_USUARIO'); ?>
		</div>
		<div class="span3">
			<?php echo $form->checkBox($model,'ES_USUARIO', array('class'=>'checkUsuario')); ?>
		</div>
           
	</div>
         <div class="row">
             
                <div class="span3">
                        <?php echo $form->labelEx($model,'_sendmail'); ?>
                    
                </div>
                <div class="span3">
                        
                        <?php echo $form->checkbox($model,'_sendmail'); ?>
                     
                </div>
            </div>
        <div id="formUsuario" class="row">
		<fieldset>
			<legend>Datos Usuario</legend>
			<div class="span3">
				<?php echo $form->labelEx($usuario,'NOMBRE_USUARIO'); ?>
				<?php echo $form->textField($usuario,'NOMBRE_USUARIO'); ?>
				<?php echo $form->error($usuario,'NOMBRE_USUARIO'); ?>
			</div>
			<div class="span3">
                                <?php echo $form->labelEx($usuario,'TODAS_LAS_EMPRESAS'); ?>
                                <?php echo $form->checkBox($usuario,'TODAS_LAS_EMPRESAS'); ?>
                                <?php echo $form->error($usuario,'TODAS_LAS_EMPRESAS'); ?>
                        </div>
			<div class="span3">
				<?php echo $form->labelEx($usuario,'COD_TIPO_USUARIO'); ?>
				<?php echo $form->dropDownList($usuario,'COD_TIPO_USUARIO', CHtml::listData(TipoUsuario::model()->findAll(),'COD_TIPO_USUARIO','NOMBRE_TIPO_USUARIO')); ?>
				<?php echo $form->error($usuario,'COD_TIPO_USUARIO'); ?>
			</div>
		</fieldset>
	</div>
	<br>
        <!--
	
<?php //if(!$model->isNewRecord){ ?>	
	<div id="formApruebaDocs" class="row">
		<div class="span3">
			<?php echo $form->labelEx($model,'APRUEBA_DOCS'); ?>	
		</div>
		<div class="span3">
			<?php echo $form->checkBox($model,'APRUEBA_DOCS', array('id'=>'checkDocumentacion')); ?>
		</div>
	</div>
	<div id="formDocumentacion" class="row">
		<fieldset>
			<legend>Datos Aprobacion Documentos</legend>
			<div class="row">
			<div class="span3">
				<?php echo $form->labelEx($aprovacion,'ID_TIPO_DOC'); ?>
				<?php echo $form->dropDownList($aprovacion,'ID_TIPO_DOC', CHtml::listData(TipoDocumento::model()->findAll(),'ID_TIPO_DOC','NOMBRE_DOC'), array('empty'=>'Indicar Documento')); ?>
				<?php echo $form->error($aprovacion,'ID_TIPO_DOC'); ?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($aprovacion,'NOMBRE_NIVEL'); ?>
				<?php echo $form->textField($aprovacion,'NOMBRE_NIVEL', array('class'=>'span8')); ?>
				<?php echo $form->error($aprovacion,'NOMBRE_NIVEL'); ?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($aprovacion,'NIVEL_APROB'); ?>
				<?php echo $form->textField($aprovacion,'NIVEL_APROB', array('class'=>'span8')); ?>
				<?php echo $form->error($aprovacion,'NIVEL_APROB'); ?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($aprovacion,'MONTO_APROB'); ?>
				<?php echo $form->textField($aprovacion,'MONTO_APROB', array('class'=>'span10')); ?>
				<?php echo $form->error($aprovacion,'MONTO_APROB'); ?>
			</div>
			<?php if(!$model->isNewRecord) { ?>
			<div class="span2">
				<br>
				<?php echo CHtml::submitButton('Aregar Documento' ,array('class'=>'btn btn-primary', 'name' =>'nuevo_documento')); ?>
			</div>
			</div>

			<div class="row">
				<br>	
				<table class="table table-striped table-condensed lista_documentos">
					<thead>
						<th width="10%" align="center">Tipo Documento</th>
						<th width="10%">Nombre Nivel</th>
						<th width="10%">Nivel</th>
						<th width="10%">Monto Aprobacion</th>
						<th width="15%" align="center">Acciones</th>
					</thead>
					<tbody>
						<?php // foreach($aprobados as $ap) { ?>
							<tr>
								<td class="text-center"><?//=$ap->ID_TIPO_DOC?></td>
								<td class="text-center"><//?=$ap->NOMBRE_NIVEL?></td>
								<td class="text-center"><//?=$ap->NIVEL_APROB?></td>
								<td class="text-center"><//?=$ap->MONTO_APROB?></td>
								<td class="text-center">
									<?php
//									echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/small_icons/table_edit.png" title="Modificar" alt="Modificar"  width="20" />', array('NivelAprobacion/update', 'id'=> $ap->ID_NIVEL_APROB));
//
//									echo CHtml::ajaxLink(
//									    '<img src='.'"'. Yii::app()->theme->baseUrl.'/img/small_icons/delete.png" title="Eliminar" alt="Eliminar"  width="20" />', 
//									    array('NivelAprobacion/delete', 'id'=>$ap->ID_NIVEL_APROB), 
//									    $ajaxOptions=array (
//									        'type'=>'POST',
//									        'beforeSend'=>'js:function(){if(confirm("Seguro de eliminar Autorizacion a documento ?"))return true;else return false;}',
//									        'success'=>"js:function(data){window.location='".Yii::app()->request->baseUrl."?r=Personal/update&id=".$model->ID_PERSONA."';}",
//									        ), 
//									    $htmlOptions=array ()
//								    );
									?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</fieldset>
	</div><br>
       
<?php// } }?>
	 -->
         
         <?php 

        $this->widget('ext.EFineUploader.EFineUploader',
         array(
               'id'=>'cotizacion',
               'config'=>array(
                   'autoUpload'=>true,
                   'multiple'=> true,
                               'request'=>array(
                                  'endpoint'=>$this->createUrl('personal/upload'),
                                  'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                               ),
                               'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                               'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                               'callbacks'=>array(
                                                //'onComplete'=>"js:function(id, name, response){ $('li.qq-upload-success').remove(); }",
                                                //'onError'=>"js:function(id, name, errorReason){ }",
                                                 ),
                               'validation'=>array(
                                         'allowedExtensions'=>array('pdf','jpg','jpeg','png'),
                                         'sizeLimit'=>5 * 1024 * 1024,//maximum file size in bytes
                                       //  'minSizeLimit'=>0*1024*1024,// minimum file size in bytes
                                                  ),
                   'callbacks'=>array(
          'onComplete'=>"js:function(id, name, response){
              var valid=true;

             $('#Personal__firma').val(response.filename);
                  
           }",
           'onError'=>"js:function(id, name, errorReason){ }",
          'onValidateBatch' => "js:function(fileOrBlobData) {}", // because of crash
        ),
                              )
              ));

        ?>
         <div class="row" style="display: none;">
	
             
		<?php echo $form->labelEx($model,'_firma'); ?>
		<?php echo $form->textField($model,'_firma'); ?>
		<?php echo $form->error($model,'_firma'); ?>
              
        
               
              
	</div>	
         
	<?php if(!empty($model->URL_FIRMA)){ ?>
        <div class="row">
        <?php echo CHtml::image(Yii::app()->request->baseUrl.'/archivos/firmas/'.$model->URL_FIRMA,"_firma",array("width"=>200)); }?> 
        </div>
	
	<div class="row">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar' ,array('class'=>'btn btn-success', 'name'=>'modificar_personal')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->