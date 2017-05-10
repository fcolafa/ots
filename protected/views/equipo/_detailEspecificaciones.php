<?php
//error_reporting(E_ALL ^ E_NOTICE);
/* @var $this EquipoController */
/* @var $model Equipo */
/* @var $form CActiveForm */
?>

<div class="form" style="width: 100%">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'piezas-equipo-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <?php echo $form->errorSummary(array($especificaciones)); ?>

        <div class="row"> <b>Crear Pieza a Equipo</b>
            <?php 
                $createUrl = $this->createUrl('piezasEquipos/createPartial', array('id'=>$model->ID_EQUIPO), array("asDialog" => 1, "gridId" => 'address-grid'));

                echo CHtml::link(Chtml::image(Yii::app()->theme->baseUrl . '/img/icons/new.png','Crear Piezas',
                                            array('title'=>"Crear Pieza" ,  'width'=>30 )) , '#', 
                                    array('onclick' => "$('#cru-frame2').attr('src','$createUrl '); $('#cru-dialog2').dialog('open');"));
            ?>
        
        </div>

        <div class="especif update">
            <table>
                <thead>
                    <tr>
                        <th>Nombre Pieza</th>
                        <th>Característica</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:20%">
                            <?= $form->dropDownList($especificaciones, 'ID_PIEZA', CHtml::listData(PiezasEquipos::model()->findAll(array('condition' => 'ID_EQUIPO=' . $model->ID_EQUIPO, 'order'=>'NOMBRE_PIEZA')), 'ID_PIEZA', 'NOMBRE_PIEZA'), array('class' => 'span12')); ?>
                            <?= $form->error($especificaciones, 'ID_PIEZA'); ?> 
                        </td>
                        <td style="width:30%">
                            <?php echo $form->textField($especificaciones,'CARACTERISTICA', array('class' => 'span12')); ?>
                            <?php echo $form->error($especificaciones,'CARACTERISTICA'); ?>
                        </td>
                        <td style="width:50%">
                            <?php echo $form->textField($especificaciones,'DESCRIPCION',array('class'=>'span12')); ?>
                            <?php echo $form->error($especificaciones,'DESCRIPCION'); ?>
                        </td>
                        <td> 
                            <?php echo CHtml::submitButton('Añadir', array('name' => 'submit_et')); ?>
                        </td>
                    <tr>
                <br>  
                    <?php           //pieza_anterior y pieza_actual para capturar los cambios de pieza
                        $total = 0; $pieza_anterior = -1 ; $pieza_actual = 0;  

                        foreach ($especif_tec as $w) {
                            $pieza_actual = $w->ID_PIEZA;
                            if ($pieza_actual != $pieza_anterior):
                                $pieza_anterior = $pieza_actual;
                                echo '<br><tr><td COLSPAN="4" class="text-center"><b>' . $w->piezasEquipos->NOMBRE_PIEZA . '</b></td></tr>' ;
                            endif;

                            echo "<tr>" .                            
                            "<td COLSPAN = '2'>" . $w->CARACTERISTICA . "</td>" .
                            "<td>" . $w->DESCRIPCION . "</td>" .
                            "<td>";

                            $createUrl = $this->createUrl('especifTecnicas/updatePartial',array('id'=>$w->ID_ESPEC_TECNICA), array("asDialog" => 1, "gridId" => 'address-grid'));

                                echo CHtml::link(Chtml::image(Yii::app()->theme->baseUrl . '/img/icons/edit.png','Modificar',
                                            array('title'=>"Modificar" ,  'width'=>"30" )) , '#', 
                                    array('onclick' => "$('#cru-frame').attr('src','$createUrl '); $('#cru-dialog').dialog('open');"));

                                echo " " . CHtml::link(
                          
                                    Chtml::image(Yii::app()->theme->baseUrl . '/img/icons/delete.png',
                                            'Eliminar',
                                            array('title'=>"Eliminar" ,  'width'=>"30" )), 
                                    $this->createUrl('especifTecnicas/delete', array('id' => $w->ID_ESPEC_TECNICA)), array(
                                                 'onclick' => '{' .
                                                 CHtml::ajax(array(
                                                 'beforeSend' => 'js:function(){if(confirm("Esta seguro que desea eliminar este elemento ?"))return true;else return false;}',
                                                 'type' => 'POST',
                                                 'url' => $this->createUrl('especifTecnicas/delete', array('id' => $w->ID_ESPEC_TECNICA, 'ajax' => 'delete')),
                                                 'success' => "js:function(data){window.location='" . Yii::app()->request->baseUrl . "/equipo/update/" . $w->ID_EQUIPO . "';}")) .
                                                 'return false;}', // returning false prevents the default navigation to another url on a new page                                         
                                                 'class' => 'delete-icon', 'id' => 'x' . $w->ID_EQUIPO)
                                                 );
                                                 echo "</td></tr>";
                        }
                    ?>

                </tbody>

            </table>
        </div>

    <?php $this->endWidget(); ?>

</div>



        <?php
//--------------------- begin new code --------------------------
        // add the (closed) dialog for the iframe
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'cru-dialog',
            'options' => array(
                'title' => 'Detalle Espqcificación Técnica',
                'autoOpen' => false,
                'modal' => false,
                'width' => 800,
                'height' => 200,
                'position'=>array(500,200),
            ),
        ));
        ?>
        <iframe id="cru-frame" width="100%" height="100%"></iframe>
        <?php
        $this->endWidget();
//--------------------- end new code --------------------------


//--------------------- begin new code --------------------------
        // add the (closed) dialog for the iframe
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'cru-dialog2',
            'options' => array(
                'title' => 'Crear Piezas de equipo',
                'autoOpen' => false,
                'modal' => false,
                'width' => 800,
                'height' => 200,
                'position'=>array(500,200),
            ),
        ));
        ?>
        <iframe id="cru-frame2" width="100%" height="100%"></iframe>
        <?php
        $this->endWidget();
//--------------------- end new code --------------------------
        ?>