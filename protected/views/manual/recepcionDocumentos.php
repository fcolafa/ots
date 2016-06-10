<div class="col-md-12">
	<h2>Recepción de Documentos</h2>
	<hr class="hr_title_tema_inf">
</div>
<div class="col-md-12 fuente_texto">
	<p>
		La opción para administrar la recepción de documentos de los contratistas se encuentra en el menú "Contratistas->Recepción Docs. Contratistas", esta opción nos muestra un recuadro de los documentos que se han entregado y cuales están pendientes, ademas podemos cambiar el estado de dichos documentos y realizar diferentes acciones sobre ellos. Además tenemos la opción de crear nuevos documentos a recibir.
	</p>
	<center class="imagenes_center">
		<?php echo CHtml::image(Yii::app()->baseUrl."/images/manual/recepDocs.PNG",'',array('style'=>'width: 90%;','valign'=>'left'));?>
	</center>
	<p>
		Para crear una nueva recepción de documentos debemos seleccionar los contratistas a los que se les debe pedir documentación y seleccionar cuales documentos deben entregar.
	</p>
	<center class="imagenes_center">
		<?php echo CHtml::image(Yii::app()->baseUrl."/images/manual/formRecepDocs.PNG",'',array('style'=>'width: 70%;','valign'=>'left'));?>
	</center>
	<p>
		Aviso sobre los documtos pendientes, este mensaje solo se muestra al pasar la fecha límite programada.
	</p>
	<center class="imagenes_center">
		<?php echo CHtml::image(Yii::app()->baseUrl."/images/manual/aviso.PNG",'',array('style'=>'width: 90%;','valign'=>'left'));?>
	</center>
</div>