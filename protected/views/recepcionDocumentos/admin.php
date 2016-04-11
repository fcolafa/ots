<?php
/* @var $this RecepciondocumentosController */
/* @var $model Recepciondocumentos */

$this->breadcrumbs=array(
	'Recepciondocumentoses'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Ver Recepcion documentos', 'url'=>array('index')),
	array('label'=>'Crear Recepcion documentos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#recepciondocumentos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Administrar Recepcion Documentos</h3>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div class=" grid-view">
	<table  class='table items table-hover' border="2">
		<tr align="Center" class="titulo-grid">
			<th>Contratista</th>
			<th>Fecha Recepcion</th>
			<th>F30</th>
			<th>F29</th>
			<th>Cotizacion</th>
		</tr>
		 <?php
		 	$array_datos=array();
		 	$fila=0;
		 	$c='';
		 	$d='';
		 	foreach ($detalle as $det) 
		 	{
		 		if($det->iDCONTRATISTAS->NOMBRE_CONTRATISTA != $c)
		 		{
		 			$pos=0;
		 			$fila++;
		 			$c=$det->iDCONTRATISTAS->NOMBRE_CONTRATISTA;
                    $array_datos[$fila][$pos]=$c;
                    $pos++;
		 			$array_datos[$fila][$pos]=$det->FECHA_RECEPCION;
		 		}
		 		if($det->iDDOCUMENTOS->NOMBRE_DOCUMENTO != $d)
		 			{
		 				$pos = $pos + $det->ID_DOCUMENTO;
		 				$d=$det->ESTADO;
		 				$array_datos[$fila][$pos]=$d;
		 			}
		 	}
		 	//print_r($array_datos);
		 	//print_r($pos);
		 	$x=0;
            foreach ($array_datos as $dato => $valor)
            {
            	$x++;
            	echo "<tr>";
            	for($i=0;$i<=$pos;$i++)
            	{	
            		if(!empty($array_datos[$x][$i]))
            		{
            		 echo '<td>'.@$array_datos[$x][$i].'</td>';
            		 }
            		 	
            	}
            	echo "</tr>";
            }

		 ?>
	</table>

</div>

<!--<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'recepciondocumentos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_RECEPCION',
		'FECHA_RECEPCION',
		array('name'=>'contratista','value'=>'$data->iDCONTRATISTAS->NOMBRE_CONTRATISTA'),
		//'ID_CONTRATISTA',
		array('name'=>'documento','value'=>'$data->iDDOCUMENTOS->NOMBRE_DOCUMENTO'),
		//'ID_DOCUMENTO',
		array('name'=>'documento','value'=>$data->ESTADO==0?"Pendiente":"Entregado"),
		//'ESTADO',
		array(
			'class'=>'CButtonColumn',
		),
	),
));*/ ?>-->
