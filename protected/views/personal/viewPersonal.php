<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->breadcrumbs=array(
	//'Personals'=>array('index'),
	$model->ID_PERSONA,
);

$this->menu=array(
	//array('label'=>'Ver Personal', 'url'=>array('index')),
	//array('label'=>'Crear Personal', 'url'=>array('create')),
	array('label'=>'Modificar Datos', 'url'=>array('updatePersonal', 'id'=>$model->ID_PERSONA)),
	//array('label'=>'Borrar Personal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_PERSONA),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
	//array('label'=>'Administrar Personal', 'url'=>array('admin')),
);
?>


<div class="borde-azul">
    
    
    <table width="100%">
			<thead class="borde-abajo">
				<tr>
					<td width="20%">
						<b><?=$model->iDEMPRESA->NOMBRE_EMPRESA ?></b>
					</td>
					<td rowspan="4"><h3 class="text-center"> Datos de Usuario</h3></td>
				</tr>
				<tr>
					<td width="20%"> RUT : 
						<?=$model->RUT_PERSONA?>
					</td>
				</tr>
				<tr>
					<td width="20%"> Nombre :
						<?=$model->NOMBRE_PERSONA.' '.$model->APELLIDO_PERSONA?>
					</td>
				</tr>
				
				<tr>
					<td width="20%"> Telefono :
						<?=$model->TELEFONO ?>
					</td>
				</tr>
				<tr>
					<td width="20%"> Email:
						<?=$model->EMAIL ?>
					</td>
				</tr>
				<tr>
					<td width="20%"> Cargo:
						<?=@$model->iDCARGO->NOMBRE_CARGO ?>
					</td>
				</tr>
				<tr>
					<td width="20%"> Cargo:
						<?=@$model->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO?>
					</td>
				</tr>
			</thead>
		</table>

</div>