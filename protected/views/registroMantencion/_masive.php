<?php
/* @var $this RegistroMantencionController */
/* @var $model RegistroMantencion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registro-horometro-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="grid-view">
	    <table width="100%" class="table items table-hover table-bordered">
	        <tbody>
	            <tr>
	                <th width='30%'>Equipo</th>
	                <th width='18%'>Fecha Mantención</th>
	                <th width='12%'>Horómetro Mantención</th>                
	                <th width='40%'>Observación de Mantención</th>
	            </tr>
	        </tbody>
	        <tbody>
	            <?php 
	                foreach ($model_equipos as $e) {
	                ?>
	                	<tr>
	            			<td><input type="hidden" name="RegistroMantencion[<?=$e->ID_EQUIPO?>][ID_EQUIPO]" value="<?=$e->ID_EQUIPO?>"> </input>
	                        	<b><?=$e->NOMBRE_EQUIPO?> </b></td>
	                        <td class='text-center'> 
		                        <?php
					            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					                'name' => 'RegistroMantencion['.$e->ID_EQUIPO.'][FECHA_REGISTRO]',
					                'language' => 'es',
					                'id' => 'fecha_mant'.$e->ID_EQUIPO,
					                'flat' => false,
					                'value' => '', //Yii::app()->dateFormatter->format('dd-MM-yyyy', $e->FECHA_REGISTRO),
					                'options' => array(
					                    'firstDay' => 1,
					                    'showAnim' => 'fold',
					                    'constrainInput' => true,
					                    'currentText' => 'Now',
					//                              'dateFormat' => 'yy-mm-dd',
					                    'dateFormat' => 'yy-mm-dd',
					                    'altField' => '#FECHA_REGISTRO',
					                    'buttonImage' => Yii::app()->baseUrl . '/images/Iconos/calendario.png', 'buttonImageOnly' => true, 'showButtonPanel' => true, 'showOn' => 'both',
					                ),
					                'htmlOptions' => array(
					                    'style' => 'height:20px;',
					                    'onchange' => 'Asignate(this)',
					                    'class' => 'text-right span9'
					                ),
					            ));
					            ?>
					        </td>

	                        <td class='text-center'><input type='text' class='span12 text-right' name='RegistroMantencion[<?=$e->ID_EQUIPO?>][REGISTRO_MARCADO]' value='' ></td>
	                        
	                        <td class='text-center'><input type='text' class='span12 text-right' name='RegistroMantencion[<?=$e->ID_EQUIPO?>][COMENTARIO_REGISTRO]' value='' ></td>
	                    </tr>

	            <?php } ?>

	        </tbody>
	    </table>

	        <div class="row">
	            <div class="span2 offset4">
	                <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array("class"=>"btn btn-primary")); ?>
	            </div>
	        </div>
    </div>
    
    <p id="reportarerror" class="text-error"></p>

    <?php $this->endWidget(); ?>

</div><!-- form -->