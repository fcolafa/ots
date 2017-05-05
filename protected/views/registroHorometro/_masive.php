<?php
/* @var $this RegistroHorometroController */
/* @var $model RegistroHorometro */
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
	                <th width='18%'>Fecha Registro</th>
	                <th width='12%'>Horómetro</th>                
	                <th width='40%'>Observación</th>
	            </tr>
	        </tbody>
	        <tbody>
	            <?php 
	                foreach ($model_equipos as $e) {
	                ?>
	                	<tr>
	            			<td><input type="hidden" name="RegistroHorometro[<?=$e->ID_EQUIPO?>][ID_EQUIPO]" value="<?=$e->ID_EQUIPO?>"> </input>
	                        	<b><?=$e->NOMBRE_EQUIPO?> </b></td>
	                        <td class='text-center'><input type='text' class='span12 text-right' name='RegistroHorometro[<?=$e->ID_EQUIPO?>][FECHA_REGISTRO]' value='<?=date("Y-m-d")?>'></td>
	                        <td class='text-center'><input type='text' class='span12 text-right' name='RegistroHorometro[<?=$e->ID_EQUIPO?>][HOROMETRO]' value='' ></td>
	                        
	                        <td class='text-center'><input type='text' class='span12 text-right' name='RegistroHorometro[<?=$e->ID_EQUIPO?>][OBSERVACION]' value='' ></td>
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