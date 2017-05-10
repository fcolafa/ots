<?php
//error_reporting(E_ALL ^ E_NOTICE);
/* @var $this ItemPresupuestoController */
/* @var $model ItemPresupuesto */
/* @var $form CActiveForm */
?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/item_ppto.js'); ?>

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



    <?php echo $form->errorSummary(array($new_piezas)); ?>

   
        <div class="guide update">
            <table>
                <thead>
                    <tr>
                        <th>Nombre Pieza</th>
                        <th>Imagen</th>                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:60%">
                            <?php echo $form->textField($new_piezas,'NOMBRE_PIEZA', array('class' => 'span12')); ?>
                            <?php echo $form->error($new_piezas,'NOMBRE_PIEZA'); ?>
                        </td>
                        <td style="width:40%">
                            <?php echo CHtml::activeFileField($new_piezas,'IMAGEN_PIEZA',array('class'=>'span12')); ?>
                            <?php echo $form->error($new_piezas,'archivo'); ?>
                        </td>

                    <tr>
                <br>  
                    <tr>
                        <th>Descripción Pieza</th>  <th></th>                      
                    </tr>
                    <tr>
                        <td>
                            <?php $this->widget('ext.jqueryte.Jqueryte', array(
                                    'id'=>'PiezasEquipos_DESCRIPCION_PIEZA',
                                    'model'=>$new_piezas,
                                    'attribute'=>'DESCRIPCION_PIEZA',
                                    'value'=>$new_piezas->DESCRIPCION_PIEZA,
                                    'options'   => array(
                                        'strike'=> false,
                                        'sub'=>false,
                                        'source'=>false,
                                        'button'=>'SEND',
                                        //'format'=>false,
                                        'formats'=>'[["p","Paragraph"],["h1","My Head 1"]]',
                                       // 'fsizes'=>'["10", "15", "20"]',   
                                       // 'linktypes'=>'["Web URL", "E-mail", "Picture"]',
                                    ),
                                 ));
                            ?>
                            <?php echo $form->error($new_piezas,'DESCRIPCION_PIEZA'); ?>
                        </td>
                        <td> 
                            <?php echo CHtml::submitButton('Añadir', array('name' => 'submit_piezas')); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="guide update">
            <table BORDER="1">
                <thead>
                    <tr>
                        <td>
                            <?php echo CHtml::link('<img src="'. Yii::app()->baseUrl.'/archivos/equipos/'.$model->IMAGEN_EQUIPO.'"/>','#'); ?>                            
                        </td>
                        <td>
                            <?php echo strip_tags($model->DESCRIPCION_EQUIPO);?>                            
                        </td>
                        <td></td>
                    </tr>

                    <?php


                        foreach ($piezas as $p) {
                            echo '<tr>' .
                                '<td COLSPAN="3" style="text-align:center"><b>' . $p->NOMBRE_PIEZA . '</b></td>' .
                            '</tr>'.
                            '</thead>'.
                            '</tbody>';

                            echo '<tr>' .
                           // "<td>" . $w->weightprovider . "</td>" .
                            '<td width="30%">'. CHtml::link('<img src="'. Yii::app()->baseUrl.'/archivos/equipos/'.$p->IMAGEN_PIEZA.'" />','#',array('view', 'id'=>$p->ID_PIEZA)).' </td>' .
                            '<td width="60%">' . strip_tags($p->DESCRIPCION_PIEZA) . '</td>' .
                            '<td width="10%">';

                            $createUrl = $this->createUrl('piezasEquipos/updateFT',array('id'=>$p->ID_PIEZA), array("asDialog" => 1, "gridId" => 'address-grid'));
                            echo CHtml::link(Chtml::image(Yii::app()->theme->baseUrl . '/img/icons/edit.png', 'Modificar', array('title'=>"Modificar" ,  'width'=>"30" )) , '#', array('onclick' => "$('#cru-frame').attr('src','$createUrl '); $('#cru-dialog').dialog('open');"));
                            
                            //echo CHtml::link('link',$this->createUrl("weight/update", array("id" => $w->id_weight, "asDialog" => 1,array('id' => $w->id_weight))));
                            echo " " . CHtml::link(
                          
                                    Chtml::image(Yii::app()->theme->baseUrl . '/img/icons/delete.png',
                                            'Eliminar',
                                            array('title'=>"Eliminar" ,  'width'=>"30" )), 
                                    $this->createUrl('piezasEquipos/delete', array('id' => $p->ID_PIEZA)), array(
                                                 'onclick' => '{' .
                                                 CHtml::ajax(array(
                                                 'beforeSend' => 'js:function(){if(confirm("Esta seguro que desea eliminar este elemento ?"))return true;else return false;}',
                                                 'type' => 'POST',
                                                 'url' => $this->createUrl('piezasEquipos/delete', array('id' => $p->ID_PIEZA, 'ajax' => 'delete')),
                                                 'success' => "js:function(data){window.location='" . Yii::app()->request->baseUrl . "/equipo/update/" . $p->ID_PIEZA . "';}")) .
                                                 'return false;}', // returning false prevents the default navigation to another url on a new page                                         
                                                 'class' => 'delete-icon', 'id' => 'x' . $p->ID_PIEZA)
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
                'title' => 'Detail view',
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
        ?>