<div class="col-md-12">
	<h2>Creación Personal - Usuario</h2>
	<hr class="hr_title_tema_inf">
</div>
<div class="col-md-12 fuente_texto">
	<p>
		La opción para crear nuevos registros de personal en el sistema se encuentra en el menú "Maestros->Personal", esta opción nos muestra un recuadro de las personas ya ingresadas en el sistema y las diferentes acciones que se pueden realizar con ellas. Además tenemos la opción de crear nuevos registros de personal.
	</p>
	<center class="imagenes_center">
		<?php echo CHtml::image(Yii::app()->baseUrl."/images/manual/adminPersonal.PNG",'',array('style'=>'width: 90%;','valign'=>'left'));?>
	</center>
	<p>
		Para crear una nueva persona debemos rellenar el siguiente formulario con los datos solicitados:
	</p>
	<center class="imagenes_center">
		<?php echo CHtml::image(Yii::app()->baseUrl."/images/manual/formPersonal.PNG",'',array('style'=>'width: 90%;','valign'=>'left'));?>
	</center>
	<p>
		Además se puede agregar la persona como usuario en el sistema seleccionando la opción "Es Usuario" y completando los datos solicitados.
	</p>
	<center class="imagenes_center">
		<?php echo CHtml::image(Yii::app()->baseUrl."/images/manual/formEsUsuario.PNG",'',array('style'=>'width: 90%;','valign'=>'left'));?>
	</center>
	<p>
		Al crear el usuario accedemos a una nueva opción la cual consiste en asignar los documentos que puede autorizar dicho usuario, para esto debemos ir a "administrar Personal" (Imagen 1), seleccionamos el usuario que queremos editar con la opción "Editar" y podemos ver la siguiente función:
	</p>
	<center class="imagenes_center">
		<?php echo CHtml::image(Yii::app()->baseUrl."/images/manual/formApruebaDocs.PNG",'',array('style'=>'width: 90%;','valign'=>'left'));?>
	</center>
</div>