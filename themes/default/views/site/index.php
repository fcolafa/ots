<?php
/* @var $this SiteController */

//$this->pageTitle=Yii::app()->name;
$this->pageTitle='Aprobación de Documentos';
$baseUrl = Yii::app()->theme->baseUrl; 
$variable = Yii::app()->user->A1();
?>

<?php 
    Yii::app()->clientScript->registerScript('recepcionDocPendientes', 
    "
        $.ajax({
            type: 'POST',
            url: '../RecepcionDocumentos/consultarEstados',
            beforeSend: function (xhr) {
                if (xhr && xhr.overrideMimeType) {
                    xhr.overrideMimeType('application/json;charset=utf-8');
                }
            },
            dataType: 'json',
            success: function (data) {
                if(data!=''){
                    $('#msg_warnning').html(data);
                    $('#msg_warnning').css('display','block');
                }
            }
        });
    ", CClientScript::POS_LOAD); 
?>

<div class="row-fluid" >
    <div id="msg_warnning" class="alert alert-warning" style="display: none">
        
    </div>
    
    <div id="msg_warnning" class="alert alert-warning">
        <h2> Atención:</h2>
        <ul class="notice-information">
        <li><h4>Se les recuerda a los usuarios que al momento de adjuntar una cotizacion, deben asegurarse que el nombre del archivo no contenga ningun caracter extraño <b>("º`'?ª\!@·$~%¬&/()=")</b>, ya que dichos caracteres provocan que el archivo subido no quede adjunto, debido a que el navegador lo reconoce como comandos.</h4> </li>
        </ul>
    </div>
    
    <div class="container-fluid" valign="center"  style="padding-top:0%;">
        <div>
            <!-- Div de Personal -->
            <?php if(Yii::app()->user->A1()){?>
            <div align="center" valign="top" class="messageButtonb blue">
                <?php echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/Dashboard/user_accounts.png" alt="Personal"  width="15%" />', array('personal/admin'));?>
                <div  class="dashIconText"><?php echo CHtml::link('<h4>Personal</h4>',array('personal/admin')); ?></div>
            </div>
            <?php } ?>
            <!-- Div de Contratistas -->
            <?php if(!Yii::app()->user->OTA()) {?>
            <div align="center" valign="top" class="messageButtonb blue">
                <?php echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/Dashboard/worker.png" alt="Contratistas"  width="15%" />', array('contratista/admin'));?>
                <div class="dashIconText"><?php echo CHtml::link('<h4>Contratistas</h4>',array('contratista/admin')); ?></div>
            </div>
            <?php }?>
            <!-- Div de Ordenes de Trabajo -->
            <div align="center" valign="top" class="messageButtonb blue">
                <span class="badge badge-important iconMenuBadge"><?php echo OrdenTrabajo::model()->getNumberOTR()?></span>
                <span class="badge badge-warning iconMenuBadge"><?php echo OrdenTrabajo::model()->getNumberOTP()?></span>
                <span class="badge badge-success iconMenuBadge"><?php echo OrdenTrabajo::model()->getNumberOTA()?></span>
                
                
                <?php echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/Dashboard/work-order.png" alt="Ordenes de Trabajo"  width="15%" />', array('ordenTrabajo/admin'));?>
                <div  class="dashIconText"><?php echo CHtml::link('<h4>Ordenes de Trabajo</h4>',array('ordenTrabajo/admin')); ?></div>
            </div>
            <div align="center" valign="top" class="messageButtonb blue">
                <span class="badge badge-important iconMenuBadge"><?php echo Ticket::model()->getNumberTP()?></span>
                <span class="badge badge-success iconMenuBadge"><?php echo Ticket::model()->getNumberTC()?></span>
                
                
                <?php echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/Dashboard/tickets.png" alt="Ticket Soporte"  width="15%" />', array('ticket/admin'));?>
                <div  class="dashIconText"><?php echo CHtml::link('<h4>Ticket Soporte</h4>',array('ticket/admin')); ?></div>
            </div>

            <!-- Div de Aprobacion de Documentos-->
            <!--
            <div align="center" valign="top" class="messageButtonb blue">
                <?php //echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/Dashboard/appicon.png" alt="Aprobación de Documentos"  width="15%" />', array('ordenTrabajo/admin'));?>
                <div  class="dashIconText"><?php //echo CHtml::link('<h4>Aprobación de Documentos</h4>',array('ordenTrabajo/admin')); ?></div>
            </div>-->
        </div>
    </div>
</div>



