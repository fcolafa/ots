<?php
/* @var $this RecepciondocumentosController */
/* @var $model Recepciondocumentos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recepciondocumentos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'FECHA_RECEPCION'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'name'=>'FECHA_RECEPCION',
								'language'=>'es',
								'model'=>$model,
								'attribute'=>'FECHA_RECEPCION',
								'flat'=>false,
								//'value' => '2015/07/14',
	   				 // additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'constrainInput'=>true,
									//'buttonImage'=>Yii::app()->baseUrl.'/images/Iconos/calendario.png', 'buttonImageOnly'=>true, 'showButtonPanel'=>true, 'showOn'=>'both',
	       				// 'showOn'=>'both',
									'currentText'=>'2015/07/14',
									'dateFormat'=>'yy-mm-dd',
									),
								'htmlOptions'=>array("class"=>"form-control"),
								));
			?>
		<!--<?php //echo $form->textField($model,'FECHA_RECEPCION'); ?>-->
		<?php echo $form->error($model,'FECHA_RECEPCION'); ?>
	</div>

	<!--<div class="row">
		<?php //echo $form->labelEx($model,'ESTADO'); ?>
		<?php //echo $form->textField($model,'ESTADO'); ?>
		<?php //echo $form->error($model,'ESTADO'); ?>
	</div>-->

<?php
echo "<div class=\"row span10\">";
	$count=0;
	$cantidad_cont = count($model_contratista);
	foreach ($model_contratista as $v){
		$count++;
		echo "<div class=\"row\">";
			if ($cantidad_cont == $count) {
				echo "<div class=\"span4\">";//clase: contratista_final
				echo "<input type=\"checkbox\" id=\"c_".$v->ID_CONTRATISTA."\" name=\"contratista[]\" value=\"".$v->ID_CONTRATISTA."\" onClick=\"javascript:showContent(".$v->ID_CONTRATISTA.")\"/>".$v->NOMBRE_CONTRATISTA."";
				echo "</div>";	
			}else{
				echo "<div class=\"span4\">";// clase contratista
				echo "<input type=\"checkbox\" id=\"c_".$v->ID_CONTRATISTA."\" name=\"contratista[]\" value=\"".$v->ID_CONTRATISTA."\" onClick=\"javascript:showContent(".$v->ID_CONTRATISTA.")\"/>".$v->NOMBRE_CONTRATISTA."";
				echo "</div>";
			}
			echo "<div class=\"formularios_rec\" id=\"d_".$v->ID_CONTRATISTA."\" style=\"display: none;\">";
			foreach ($model_documentos as $k){
				echo "<div class=\"span2\">";
			 		echo "<input type=\"checkbox\" id=\"d_".$v->ID_CONTRATISTA.",".$k->ID_DOCUMENTO."\" name=\"documento[]\" value=\"".$v->ID_CONTRATISTA.",".$k->ID_DOCUMENTO."\" class=\"c_".$v->ID_CONTRATISTA."\" />".$k->NOMBRE_DOCUMENTO."";
			 	echo "</div>";
			}
			echo "</div>";
		echo "</div>";
	}
echo '</div>';
?>

<?php /*
$tabla = "<table class=\"table\">".
	'<thead>'.
		'<th>Contratista</th>'.
		'<th>Formulario 1</th>'.
		'<th>Formulario 2</th>'.
		'<th>Formulario 3</th>'.
	'</thead>'.
	'<tbody>';
		$count=0;
		foreach ($model_contratista as $v){
		$count++;
			$tabla.='<tr>';
			$tabla.="<td class=\"span4\">";
				$tabla.="<input type=\"checkbox\" id=\"c_".$v->ID_CONTRATISTA."\" name=\"contratista[]\" value=\"".$v->ID_CONTRATISTA."\" onClick=\"javascript:showContent(".$v->ID_CONTRATISTA.")\"/>".$v->NOMBRE_CONTRATISTA."";
			$tabla.="</td>";
			//echo "<div id=\"d_".$v->ID_CONTRATISTA."\" style=\"display: none;\">";
			foreach ($model_documentos as $k){
				$tabla.="<td class=\"span2\">";
			 		$tabla.="<input type=\"checkbox\" id=\"d_".$v->ID_CONTRATISTA.",".$k->ID_DOCUMENTO."\" name=\"documento[]\" value=\"".$v->ID_CONTRATISTA.",".$k->ID_DOCUMENTO."\" class=\"c_".$v->ID_CONTRATISTA."\" />".$k->NOMBRE_DOCUMENTO."";
			 	$tabla.="</td>";

			}
			$tabla.='</tr>';
			//echo "</div>";
		}
	$tabla.='</tbody>';
$tabla.='</table>';
echo $tabla;*/
?>

<?php
	echo "<div class=\"row\">";
	/*
		 echo $form->labelEx($model,'ID_DOCUMENTO'); 
		 echo $form->textField($model,'ID_DOCUMENTO'); 
		 echo $form->error($model,'ID_DOCUMENTO'); */
	echo '</div>'
?>
	<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    function showContent($id) {
    	var accion="c_"+$id;
    	var content="d_"+$id;
    	var clase="c_"+$id;
        element = document.getElementById(content);
        check = document.getElementById(accion);
        if (check.checked) {
            element.style.display='block';
            $('.c_'+$id).prop( "checked", true );
        }
        else {
            element.style.display='none';
            $('.c_'+$id).prop( "checked", false );
         
        }
    }
</script>