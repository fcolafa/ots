<script type="text/javascript">
	/* Invierte la fecha */
    function Asignate(target)
    {
        var choose = target.value;
        if(target.id == 'FECHAvs')
        {
        	var pieces = choose.split('-');
			pieces.reverse();
			var reversed = pieces.join('-');
            document.getElementById('Presupuesto_FECHA').value = reversed;
            document.getElementById('FECHAvs').value = choose;
        }
    }

    $( document ).ready(function() {
    	if ( $('#cb_tipo_moneda').val() == 1 ) {
  			$('#tb_valor_moneda').val("1");
			$("#tb_valor_moneda").attr("readonly","readonly"); 
  		}

  		$('#OrdenTrabajo_ID_CONTRATISTA').change(function(){
  			var id = $(this).val();
  			$.ajax({
	            type: 'POST',
	            url: '../RecepcionDocumentos/consultarEstadoDocumentos',
	            data: {'id_cont':id},
	            beforeSend: function (xhr) {
	                if (xhr && xhr.overrideMimeType) {
	                    xhr.overrideMimeType('application/json;charset=utf-8');
	                }
	            },
	            dataType: 'json',
	            success: function (data) {
	                if(data!=''){
	                    $('#msg_warnning').html(data);
	                    $('#msg_warnning').css('display','block');
	                }else{
	                	$('#msg_warnning').css('display','none');
	                }
	            }
	        });
  		});

	  	$('#cb_tipo_moneda').change(function(){
	  		if ( $('#cb_tipo_moneda').val() == 1 ) {
	  			$('#tb_valor_moneda').val("1");
				$("#tb_valor_moneda").attr("readonly","readonly"); 
	  		}else{
	  			$('#tb_valor_moneda').val("");
	  			$("#tb_valor_moneda").removeAttr("readonly");
	  		}
	  	});

	  	if ( $('#rechazar').prop('checked') ){
	  		$('#motivo_rechazo').show("fast");
	  	}else{
	  		$('#motivo_rechazo').hide("fast");
	  	}

	  	$('#rechazar').click(function() {
	        if (!$(this).is(':checked')) {
	            $('#motivo_rechazo').hide("fast");
	        }else{
	        	$('#motivo_rechazo').show("fast");
	        }
	    });
	});
</script>

<div id="msg_warnning" class="alert alert-warning" style="display: none">
    
</div>

<div class="form" style="min-width:800px; max-width:1000px;">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'presupuesto-form',
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); ?>

		<div class="row">
			<div class="row">Campos con <span class="required">*</span> son obligatorios.</div>
			<br>
			<div class="span5 alert-success" style="padding: 5px 10px;"><strong>
				<?php if ($model->isNewRecord):
						$usuario = Personal::model()->findByAttributes(array('ID_PERSONA'=>Yii::app()->user->getState('identificador')));
						echo 'Usuario Creador: '.@$usuario->NOMBRE_PERSONA." ".@$usuario->APELLIDO_PERSONA;
					else:
						$usuario = Personal::model()->findByAttributes(array('ID_PERSONA'=>$model->USUARIO_CREADOR));
						if (count($usuario) > 0):
							$userName = $usuario->NOMBRE_PERSONA;
							$userSecondName = $usuario->APELLIDO_PERSONA;
							echo 'Creado por el usuario: '.$userName." ".$userSecondName;
						endif;
					endif;
				?></strong>
			</div>
				<div class="span1">
					<label> Adjuntar:</label>
				</div>
				<div class="span4">
					<?php echo CHtml::activeFileField($model,'ARCHIVO_ADJUNTO',array('class'=>'span12')); ?>
					<?php echo $form->error($model,'archivo'); ?>
				</div>
				<div class="span2">
					<?php if(!empty($model->ARCHIVO_ADJUNTO)){
							$this->widget('zii.widgets.CMenu', array(
					                'htmlOptions'=>array('class'=>'pull-right nav'),
					                'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					                'itemCssClass'=>'item-test',
					                'encodeLabel'=>false,
					                'items' => array(
					                    array('label' => '<img src='.'"'. Yii::app()->theme->baseUrl.'/img/small_icons/attach.png" title="Ver Archivo" width="25" /> Ver Archivo', 'url' => "http://".$_SERVER["SERVER_NAME"].Yii::app()->request->baseUrl."/archivos/pdf/".$model->ARCHIVO_ADJUNTO),
					                ),
					            ));
						}
					?>
				</div>				
		</div>
		<hr>
		<div class="row">
			<div class="span3">
				<?php echo $form->labelEx($model,'APLICA_IVA'); ?>
				<?php echo $form->dropDownList($model,'APLICA_IVA', OrdenTrabajo::getTax()); ?>
				<?php echo $form->error($model,'APLICA_IVA'); ?>
			</div>
			<div class="span3">
				<?php echo $form->labelEx($model,'ID_TIPO_MONEDA'); ?>
				<?php echo $form->dropDownList($model,'ID_TIPO_MONEDA', TipoMoneda::getTiposMoneda(), array('id'=>'cb_tipo_moneda')); ?>
				<?php echo $form->error($model,'ID_TIPO_MONEDA'); ?>
			</div>
			<div class="span3">
				<?php echo $form->labelEx($model,'VALOR_MONEDA'); ?>
				<?php echo $form->textField($model,'VALOR_MONEDA',array('maxlength'=>13, 'class'=>'span12','id'=>'tb_valor_moneda')); ?>
				<?php echo $form->error($model,'VALOR_MONEDA'); ?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($model,'ID_TIPO_OT'); ?>
				<?php echo $form->dropDownList($model,'ID_TIPO_OT', array(''=>'Tipo de OT')+CHtml::listData(TipoDeOT::model()->findAll(array('order'=>'NOMBRE_TIPO_OT DESC')),'ID_TIPO_OT', 'NOMBRE_TIPO_OT'), array( 'class'=>'span12')); ?>
				<?php echo $form->error($model,'ID_TIPO_OT'); ?>
			</div>
		</div>
		<hr>	
		<div class="row">
<!--			<div class="span3">
				<?php  // echo $form->labelEx($model,'ID_EMPRESA'); ?>
				<?php //echo $form->dropDownList($model,'ID_EMPRESA', CHtml::listData(Empresa::model()->findAll(), 'ID_EMPRESA', 'NOMBRE_EMPRESA'), array('empty'=> 'Indicar Empresa','id'=>'cb_empresaPres', 'class'=>'span12' )); ?>
				<?php // echo $form->error($model,'ID_EMPRESA'); ?>
			</div>-->
			<div class="span3">
				<?php echo $form->labelEx($model,'ID_CONTRATISTA'); ?>
				<?php echo $form->dropDownList($model,'ID_CONTRATISTA', array(''=>'Indicar Contratista')+CHtml::listData(Contratista::model()->findAll(), 'ID_CONTRATISTA', 'NOMBRE_CONTRATISTA'), array('class'=>'span12' )); ?>
				<?php echo $form->error($model,'ID_CONTRATISTA'); ?>
			</div>
			<div class="span3">
				<?php echo $form->labelEx($model,'SUPERVISOR'); ?>
				<?php echo $form->dropDownList($model,'SUPERVISOR',$this->getSupervisor(), array('empty'=>'Indicar Supervisor','class'=>'span12' )); ?>
				<?php echo $form->error($model,'SUPERVISOR'); ?>
			</div>
			
		</div>

		<div class="row">
			<div class="span3">
				<?php echo $form->labelEx($model,'SOLICITANTE'); ?>
				<?php echo $form->dropDownList($model, 'SOLICITANTE', 
							Personal::getPersonal(),
							array(
								'empty'=>'Indicar Solicitante',
								'ajax'=>array(
									'type'=>'POST',
									'url'=>CController::createUrl('departamentos/getDepartamentos'),
									'update'=>'#'.CHtml::activeId($model,'ID_DEPARTAMENTO'),
								),
							)
					); ?>
				<?php echo $form->error($model,'SOLICITANTE'); ?>
			</div>
			<div class="span3">
				<?php echo $form->labelEx($model,'ID_DEPARTAMENTO'); ?>
				<?php 
					$lista_dep = array();
					if(isset($model->ID_DEPARTAMENTO)){
						$id_dep = intval($model->ID_DEPARTAMENTO); 
		                $lista_dep = CHtml::listData(Departamentos::model()->findAllByAttributes(array('ID_DEPARTAMENTO'=>$id_dep)),'ID_DEPARTAMENTO','NOMBRE_DEPARTAMENTO');
		            } 
					echo $form->dropDownList($model,'ID_DEPARTAMENTO', $lista_dep); 
				?>
				<?php echo $form->error($model,'ID_DEPARTAMENTO'); ?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($model,'FECHA_EJECUCION'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'name'=>'OrdenTrabajo[FECHA_EJECUCION]',
						'language'=>'es',
						'id'=>'fecha_ini',
						'flat'=>false,
						'value'=> Yii::app()->dateFormatter->format('dd-MM-yyyy', $model->FECHA_EJECUCION),
						'options'=>array(
							'firstDay'=>1,
							'showAnim'=>'fold',
							'constrainInput'=>true,
							'currentText'=>'Now',
//								'dateFormat' => 'yy-mm-dd',
							'dateFormat'=>'dd-mm-yy',
							'altField' => '#FECHA_EJECUCION',
							'buttonImage'=> Yii::app()->baseUrl.'/images/Iconos/calendario.png', 'buttonImageOnly'=>true, 'showButtonPanel'=>true, 'showOn'=>'both',
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;',
							'onchange' => 'Asignate(this)',
							'class'=>'text-right span9'
						),
						));
				?>
				<?php echo $form->error($model,'FECHA_EJECUCION'); ?>
			</div>
		</div>

		<div class="row">
			<div class="span12">
				<?php echo $form->labelEx($model,'DESCRIPCION_OT'); ?>
				<?php echo $form->textField($model,'DESCRIPCION_OT',array('maxlength'=>50, 'class'=>'span12')); ?>
				<?php echo $form->error($model,'DESCRIPCION_OT'); ?>
			</div>
		</div>

		<div class="row" id="reportarerror"></div>

		<?php if($model->isNewRecord==false){ ?>
		<br><br>
		<div class="row">
			<div class="span3">
				<?php if ( Yii::app()->user->A1() || Yii::app()->user->GG()){
								echo $form->labelEx($model,'VOBO_GERENTE_GRAL');
								echo $form->checkBox($model,'VOBO_GERENTE_GRAL');
								if ($model->VOBO_GERENTE_GRAL)
									echo $form->label($model,' &nbsp;&nbsp; Vo.Bo. Gerente General ');
								else
									echo $form->label($model,' &nbsp;&nbsp; Pendiente de Validacion');
								echo $form->error($model,'VOBO_GERENTE_GRAL');
							} elseif ( Yii::app()->user->A1() || Yii::app()->user->GOP()){
								echo $form->labelEx($model,'VOBO_GERENTE_OP');
								echo $form->checkBox($model,'VOBO_GERENTE_OP');
								if ($model->VOBO_GERENTE_OP)
									echo $form->label($model,' &nbsp;&nbsp; Vo.Bo. Gerente Operaciones ');
								else
									echo $form->label($model,' &nbsp;&nbsp; Pendiente de Validacion');
								echo $form->error($model,'VOBO_GERENTE_OP');
							} elseif ( Yii::app()->user->A1() || Yii::app()->user->ADM()){
								echo $form->labelEx($model,'VOBO_ADMIN');
								echo $form->checkBox($model,'VOBO_ADMIN');
								if ($model->VOBO_ADMIN)
									echo $form->label($model,' &nbsp;&nbsp; Vo.Bo. Administrador ');
								else
									echo $form->label($model,' &nbsp;&nbsp; Pendiente de Validacion');
								echo $form->error($model,'VOBO_ADMIN');
							} elseif ( Yii::app()->user->A1() || Yii::app()->user->JDP()){
								echo $form->labelEx($model,'VOBO_JEFE_DPTO');
								echo $form->checkBox($model,'VOBO_JEFE_DPTO');
								if ($model->VOBO_JEFE_DPTO)
									echo $form->label($model,' &nbsp;&nbsp; Vo.Bo. Jefe de Departamento ');
								else
									echo $form->label($model,' &nbsp;&nbsp; Pendiente de Validacion');
								echo $form->error($model,'VOBO_JEFE_DPTO');
							}
				?>
			</div>

			<div class="span2">
				<?php 
					echo $form->labelEx($model,'RECHAZAR_OT');
					echo $form->checkBox($model,'RECHAZAR_OT',array('id'=>'rechazar'));
				?>	
			</div>
			<div id="motivo_rechazo" class="span7">
				<?php 
					echo $form->labelEx($model,'MOTIVO_RECHAZO');
					echo $form->textField($model,'MOTIVO_RECHAZO',array('maxlength'=>50, 'class'=>'span12'));
				?>	
			</div>

			
		</div>
		<?php }?>
		<div class="row">
			<div class="span3" style="margin-top: 25px;">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'offset1 btn btn-success', 'name' => 'submit_ot')); ?>		
			</div>	
		</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

