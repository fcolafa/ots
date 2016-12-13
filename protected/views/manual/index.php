<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

Yii::app()->clientScript->registerScript('helpers', '
        someUrl = '.CJSON::encode(Yii::app()->createUrl('manual')).';
        baseUrl = '.CJSON::encode(Yii::app()->baseUrl).';
');
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/acordeon.js');
$cs->registerCssFile($baseUrl.'/css/acordeon.css');
$cs->registerCssFile($baseUrl.'/css/manual.css');
?>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#creacion").click(function(event) {
			$.ajax({
		        url:"<?php echo Yii::app()->createUrl('manual/creacionOt');?>",
		        data:{},
		        type:"POST",
		        dataType:"html",
		        success:function(response){
		        	$('#contenido').empty();
		            $('#contenido').append(response);
		        },
		    });
		});

		$("#aprobar").click(function(event) {
			$.ajax({
		        url:"<?php echo Yii::app()->createUrl('manual/aprobacion');?>",
		        data:{},
		        type:"POST",
		        dataType:"html",
		        success:function(response){
		        	$('#contenido').empty();
		            $('#contenido').append(response);
		        },
		    });
		});

		$("#creacion_usuario").click(function(event) {
			$.ajax({
		        url:"<?php echo Yii::app()->createUrl('manual/creacionUsuario');?>",
		        data:{},
		        type:"POST",
		        dataType:"html",
		        success:function(response){
		        	$('#contenido').empty();
		            $('#contenido').append(response);
		        },
		    });
		});
		$("#creacion_ticket").click(function(event) {
			$.ajax({
		        url:"<?php echo Yii::app()->createUrl('manual/creacionTicket');?>",
		        data:{},
		        type:"POST",
		        dataType:"html",
		        success:function(response){
		        	$('#contenido').empty();
		            $('#contenido').append(response);
		        },
		    });
		});

		$("#adm_contrat").click(function(event) {
			$.ajax({
		        url:"<?php echo Yii::app()->createUrl('manual/Contratistas');?>",
		        data:{},
		        type:"POST",
		        dataType:"html",
		        success:function(response){
		        	$('#contenido').empty();
		            $('#contenido').append(response);
		        },
		    });
		});

		$("#docs_contrat").click(function(event) {
			$.ajax({
		        url:"<?php echo Yii::app()->createUrl('manual/DocumentosContratista');?>",
		        data:{},
		        type:"POST",
		        dataType:"html",
		        success:function(response){
		        	$('#contenido').empty();
		            $('#contenido').append(response);
		        },
		    });
		});
		
		$("#recep_docs").click(function(event) {
			$.ajax({
		        url:"<?php echo Yii::app()->createUrl('manual/RecepcionDocumentos');?>",
		        data:{},
		        type:"POST",
		        dataType:"html",
		        success:function(response){
		        	$('#contenido').empty();
		            $('#contenido').append(response);
		        },
		    });
		});
	});
</script>
<!--<div class="container2">-->
	<div class="row2">
		<div class="col-md-9" id="main_manual">
			<h1>Manual Sistema de Ordenes de Trabajo</h1><hr class="hr_title">
			<div id="contenido" class="row2">
				<center>
					<?php //echo CHtml::image(Yii::app()->baseUrl."/images/laportada-midlogo.png",'',array('style'=>'width: 40%;','valign'=>'left'));?>
				</center>
			</div>
		</div>
		<div class="col-md-2">
			<?php include("menu.php"); ?>		
		</div>
	</div>
<!--</div>-->
