<div class="col-md-12">
	<h2>Aprobación de Ordenes de Trabajo</h2>
	<hr class="hr_title_tema_inf">
</div>
<div class="col-md-12 fuente_texto">
	<p> 
		La aprobación de las Ots se realizan de forma jerarquica. En primer lugar la Ot debe ser aprobada por el Jefe de Departamento, luego el Administrador, opcionalmente debe ser aprobada por el Gerente de Operaciones y por último por el Gerente General o Zonal. Para aprobar las ots se deben seleccionar las que se desean aprobar y posteriormente presionar el botón "Aprobar Orden de Trabajo".
	</p>
	<center class="imagenes_center">
		<?php echo CHtml::image(Yii::app()->baseUrl."/images/manual/admOt.PNG",'',array('style'=>'width: 90%;','valign'=>'left'));?>
	</center>
	<p>
		Una vez una Ot se ha marcado como "Aprobada" se puede volver a seleccionar y marcar como pendiente solo en el caso que no haya sido aprobada por la siguiente persona. Ej: si el Jefe de Departamento a aprobado una Ot y desea volver a marcarla como pendiente, esta acción se puede llevar a cabo solo si no ha sido aprobada por alguien superior en este caso el Administrador, en el caso en que ya haya sido aprobada por el administrador, el Jefe de Departamento no podrá marcarla como pendiente. En este caso el administrador debe marcarla como pendiente en primer lugar y luego el Jefe de Departamento.
	</p>
</div>