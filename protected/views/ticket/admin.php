<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs = array(
    'Administrar',
);

$this->menu = array(
    array('label' => 'Crear Ticket', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ticket-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Tickets</h1>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php echo CHtml::link('Busqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'ticket-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'afterAjaxUpdate' => "function() {
 	jQuery('#Projects_presentationDate').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 	}",
    'columns' => array(
        'ID_TICKET',
        'ASUNTO_TICKET',
        array(
            'name' => 'FECHA_TICKET',
            'value' => 'Yii::app()->dateFormatter->format("d MMMM y \n HH:mm:ss",strtotime($data->FECHA_TICKET))',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'FECHA_TICKET',
                'language' => 'es',
                'htmlOptions' => array(
                    'id' => 'Projects_presentationDate',
                    'dateFormat' => 'yy-mm-dd',
                ),
                'options' => array(// (#3)
                    'showOn' => 'focus',
                    'dateFormat' => 'yy-mm-dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
                    ), true),
        ),
        array(
            'name' => 'ESTADO_TICKET',
            'value' => '$data->ESTADO_TICKET=="Cerrado"? "../themes/default/img/icons/ticketclose.png":"../themes/default/img/icons/ticketopen.png"',
            'type' => 'image',
            //'value'=>'"../themes/default/img/icons/aprove.png"',
            'filter' => array('Cerrado' => 'Cerrado', 'Pendiente' => 'Pendiente'),
            'htmlOptions' => array('width' => '1%', 'align' => 'center'),
        ),
        array('class' => 'CButtonColumn',
            'template' => '{view}',
        ),
    ),
));
?>
