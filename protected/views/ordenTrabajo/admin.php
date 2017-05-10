<?php
$this->breadcrumbs = array(
    'Orden de Trabajo' => array('admin'),
    'Administrar',
);

$this->menu = array(
//		array('label'=>'Ver Presupuestos', 'url'=>array('index')),
    array('label' => 'Crear Orden de Trabajo', 'url' => array('create'), 'visible' => Yii::app()->user->OP() || Yii::app()->user->LOG() || Yii::app()->user->A1() || Yii::app()->user->JDP() || Yii::app()->user->A1() || Yii::app()->user->ADM() || Yii::app()->user->GG() || Yii::app()->user->GOP()),
);
?>

<h2 class="text-center">Administrar Orden de Trabajo</h2>



<script>
    function mostrarDetalles() {
        var ID_OT = null;

        if ($.fn.yiiGridView.getSelection('presupuesto-grid1') != '')
            ID_OT = $.fn.yiiGridView.getSelection('presupuesto-grid1');
        if ($.fn.yiiGridView.getSelection('presupuesto-grid2') != '')
            ID_OT = $.fn.yiiGridView.getSelection('presupuesto-grid2');
        if ($.fn.yiiGridView.getSelection('presupuesto-grid3') != '')
            ID_OT = $.fn.yiiGridView.getSelection('presupuesto-grid3');



        $.fn.yiiGridView.update('el_detalle', {data: ID_OT});
    }
    $(document).ready(function () {
    });

</script>


 <div id="msg_warnning" class="alert alert-warning">
        <h2> Modificaciones:</h2>
        <ul class="notice-information">
            <li>Se ha añadido nueva función rapida en la grilla, 
                ahora se visualiza el documento en pdf directamente en la grilla con la salvedad que aquellos que no esten aprobados completamente aparecerá 
                una marca de agua indicando dicha condición</li>
        </ul>
        <img src="<?= Yii::app()->theme->baseUrl ?>/img/icons/pdf-icon.png" style="width:10%;">
    </div>

<?php
//$meses = array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');

$date = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'FECHA_OT',
    'language' => 'es',
    'model' => $model,
    'attribute' => 'FECHA_OT',
    'flat' => false,
    'options' => array(
        'showAnim' => 'fold',
        'constrainInput' => true,
        'currentText' => 'Now',
        'altField' => 'FECHA_OT',
        'altFormat' => 'dd-mm-yy',
        'dateFormat' => 'yy-mm-dd',
        'htmlOptions' => array(
            'style' => 'height:20px;'
        ),
    ),
        ), true);
$data = '';
if (!Yii::app()->user->allCompany()) {
    $search = $model->search();
    $empresa = Empresa::model()->findAll('ID_EMPRESA=' . Usuarios::model()->getCompany(Yii::app()->user->id));
} else {
    $empresa = Empresa::model()->findAll();
}

foreach ($empresa as $e) {
    if (Yii::app()->user->allCompany()) {
        $search = $model->searchAllcompany($e->ID_EMPRESA);
        echo '<dt><div class="companyButton blue">' . $e->NOMBRE_EMPRESA .
        '<span class="badge badge-success">' . OrdenTrabajo::model()->getNumberOTA($e->ID_EMPRESA) . '</span>
                 <span class="badge badge-warning">' . OrdenTrabajo::model()->getNumberOTP($e->ID_EMPRESA) . '</span>
                 <span class="badge badge-important">' . OrdenTrabajo::model()->getNumberOTR($e->ID_EMPRESA) . '</span>
                 </div>
                 </dt>
              <dd>';
    }
    "var id=" . $e->ID_EMPRESA;

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'presupuesto-grid' . $e->ID_EMPRESA,
        'selectionChanged' => 'mostrarDetalles',
        'dataProvider' => $search,
        'htmlOptions' => array('style' => 'text-align:left; width: 100%;'),
        'afterAjaxUpdate' => "function() {
 		jQuery('#FECHA_OT').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['es'], {'showAnim':'fold','dateFormat':'yy-mm-dd','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
 							}",
        'filter' => $model,
        'columns' => array(
            array(
                'name' => 'NUMERO_OT',
                'htmlOptions' => array('width' => '5%', 'class' => 'text-center'),
            ),
            array(
                'name' => 'fullname',
                'value' => '@$data->solicitante->NOMBRE_PERSONA',
                'filter' => CHtml::activeTextField($model, 'fullname'),
                'htmlOptions' => array('width' => '15%'),
            ),
            array(
                'name' => 'lastname',
                'value' => '@$data->solicitante->APELLIDO_PERSONA',
                'filter' => CHtml::activeTextField($model, 'lastname'),
                'htmlOptions' => array('width' => '15%'),
            ),
            array(
                'name' => '_contratista',
                'value' => '@$data->contratista->NOMBRE_CONTRATISTA',
                'filter' => CHtml::activeTextField($model, '_contratista'),
                'htmlOptions' => array('width' => '15%'),
            ),
            array(
                'name' => '_rutcontratista',
                'value' => '@$data->contratista->RUT_CONTRATISTA',
                'filter' => CHtml::activeTextField($model, '_rutcontratista'),
                'htmlOptions' => array('width' => '15%'),
            ),
            array(
                'name' => 'FECHA_OT',
                //'value' => 'ltrim(substr($data->FECHA_OT, 8),"0")."-".substr($data->FECHA_OT, 5, 2)."-".substr($data->FECHA_OT, 0, 4)',
                'filter' => $date,
                'htmlOptions' => array('width' => '10%'),
            ),
            array(
                'name' => 'VOBO_JEFE_DPTO',
                'value' => '$data->VOBO_JEFE_DPTO==1? "../themes/default/img/icons/aprove.png":"../themes/default/img/icons/pending.png"',
                'type' => 'image',
                //'value'=>'"../themes/default/img/icons/aprove.png"',
                'filter' => array(1 => 'Aprobado', 0 => 'Pendiente'),
                'htmlOptions' => array('width' => '5%', 'align' => 'center'),
            ),
            array(
                'name' => 'VOBO_GERENTE_OP',
                'header' => $model->attributeLabels($e->ID_EMPRESA)['VOBO_GERENTE_OP'],
                'value' => '$data->VOBO_GERENTE_OP==1? "../themes/default/img/icons/aprove.png":"../themes/default/img/icons/pending.png"',
                'type' => 'image',
                //'value'=>'"../themes/default/img/icons/aprove.png"',
                'filter' => array(1 => 'Aprobado', 0 => 'Pendiente'),
                'htmlOptions' => array('align' => 'center', 'width' => '5%'),
                'visible' => $e->ID_EMPRESA != 1,
            ),
            array(
                'name' => 'VOBO_ADMIN',
                'value' => '$data->VOBO_ADMIN==1? "../themes/default/img/icons/aprove.png":"../themes/default/img/icons/pending.png"',
                'type' => 'image',
                //'value'=>'"../themes/default/img/icons/aprove.png"',
                'filter' => array(1 => 'Aprobado', 0 => 'Pendiente'),
                'htmlOptions' => array('width' => '5%', 'align' => 'center'),
            ),
            array(
                'name' => 'VOBO_GERENTE_OP',
                'header' => $model->attributeLabels($e->ID_EMPRESA)['VOBO_GERENTE_OP'],
                'value' => '$data->VOBO_GERENTE_OP==1? "../themes/default/img/icons/aprove.png":"../themes/default/img/icons/pending.png"',
                'type' => 'image',
                //'value'=>'"../themes/default/img/icons/aprove.png"',
                'filter' => array(1 => 'Aprobado', 0 => 'Pendiente'),
                'htmlOptions' => array('align' => 'center', 'width' => '5%'),
                'visible' => $e->ID_EMPRESA == 1,
            ),
            array(
                'name' => 'VOBO_GERENTE_GRAL',
                'value' => '$data->VOBO_GERENTE_GRAL==1? "../themes/default/img/icons/aprove.png":"../themes/default/img/icons/pending.png"',
                'type' => 'image',
                //'value'=>'"../themes/default/img/icons/aprove.png"',
                'filter' => array(1 => 'Aprobado', 0 => 'Pendiente'),
                'htmlOptions' => array('align' => 'center', 'width' => '5%'),
            ),
            array(
                'header' => 'Estado Orden de trabajo ',
                'name' => 'ESTADO_OT',
                'type' => 'image',
                'value' => '$data->getStatusImage($data->ESTADO_OT)',
                'filter' => array(1 => 'Aprobado', 2 => 'Rechazado', 0 => 'Pendiente'),
                'htmlOptions' => array('align' => 'center', 'width' => '5%'),
            ),
            array(
                'header' => 'Total',
                'name' => 'total',
                'value' => '$data->getTotal()',
                'filter' => false,
                'htmlOptions' => array('align' => 'center', 'width' => '5%'),
            ),
            array(
                'name' => 'check',
                'header' => 'Seleccionar',
                'id' => 'selectedIds',
                'value' => '$data->ID_OT',
                'class' => 'CCheckBoxColumn',
                'selectableRows' => '100',
                'htmlOptions' => array('align' => 'center'),
                'visible' => !Yii::app()->user->LOG() && !Yii::app()->user->OP(),
            ),
            array('class' => 'CButtonColumn',
                'template' => '{view2}{view}{update}{pdfexport}{delete}',
                'header' => 'Opciones',
                'buttons' => array(
                    /* 	'more' => array(
                      'label' => 'Mas',
                      'options' => array('class'=>'mas_icon', 'prevent'=>'default'),
                      'click' => 'js:function() { return false;}',
                      'imageUrl'=>Yii::app()->theme->baseUrl.'/img/plus.png',
                      ), */
                    'view' => array(
                        'imageUrl' => Yii::app()->theme->baseUrl . '/img/icons/document.png',
                        'options' => array('class' => 'icon-view', 'title' => "Vista detallada"),
                        'url' => 'Yii::app()->controller->createUrl("view",array("id"=>"$data->ID_OT"));',
                    ),
                    'update' => array(
                        'imageUrl' => Yii::app()->theme->baseUrl . '/img/icons/edit.png',
                        'options' => array('class' => 'icon-update', 'title' => "Modificar"),
                        'visible' => 'Yii::app()->user->A1()|| ($data->VOBO_GERENTE_GRAL!=1&&(Yii::app()->user->LOG() || Yii::app()->user->ADM() || Yii::app()->user->GG() || Yii::app()->user->GOP() || Yii::app()->user->JDP()|| Yii::app()->user->OP()))'),
                    'view2' => array(
                        'options' => array('class' => 'icon-edit', 'title' => "Vista Rapida"),
                        'imageUrl' => Yii::app()->theme->baseUrl . '/img/icons/fastview.png',
                        'url' => '$this->grid->controller->createUrl("fastView", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                        'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',),
                    'pdfexport' => array(
                        'options' => array('class' => 'icon-edit', 'title' => "Documento PDF"),
                        'imageUrl' => Yii::app()->theme->baseUrl . '/img/icons/pdf-icon.png',
                        'url' => '$this->grid->controller->createUrl("viewPDF", array("id"=>$data->primaryKey))',
                    ),
                    'delete' => array(
                        'options' => array('class' => 'icon-delete', 'title' => "Eliminar"),
                        //'imageUrl' => Yii::app()->theme->baseUrl . '/img/icons/pdf-icon.png',
                        'visible' => 'Yii::app()->user->A1()',
                    )
                ),
                'htmlOptions' => array('width' => '10%', 'class' => 'text-center'),
            ),
        ),
    ));
    $data .= 'theIds' . $e->ID_EMPRESA . ' : $.fn.yiiGridView.getChecked("presupuesto-grid' . $e->ID_EMPRESA . ' ","selectedIds").toString(),';
}


if (Yii::app()->user->A1() || Yii::app()->user->ADM() || Yii::app()->user->GG()) {
    echo CHtml::ajaxLink("Aprobar Orden(es) de Trabajo(s)", $this->createUrl('ordenTrabajo/aprobarOT'), array(
        "type" => "post",
        "data" => 'js:{'
        . $data
        . '}',
        "success" => 'js:function(data){ $.fn.yiiGridView.update("guide-grid"); location.reload();  }')
            , array(
        'class' => 'btn btn-success'
            )
    );
}
//    echo CHtml::ajaxLink("Marcar como Pendiente", $this->createUrl('ordenTrabajo/CambiarPendiente'), array(
//        "type" => "post",
//        "data" => 'js:{theIds : $.fn.yiiGridView.getChecked("presupuesto-grid","selectedIds").toString()}',
//        "success" => 'js:function(data){ $.fn.yiiGridView.update("guide-grid"); location.reload();  }' ),array(
//        'class' => 'btn btn-warning'
//        )
//        );
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'cru-dialog',
    'options' => array(
        'title' => 'Vista Rapida',
        'autoOpen' => false,
        'modal' => false,
        'width' => 800,
        'height' => 500,
    ),
));
?>

<iframe id="cru-frame" width="100%" height="100%"></iframe>
<?php
$this->endWidget();
