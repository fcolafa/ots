<?php
/* @var $this SiteController */

//$this->pageTitle=Yii::app()->name;
$this->pageTitle='Aprobación de Documentos';
$baseUrl = Yii::app()->theme->baseUrl; 
$variable = Yii::app()->user->A1();
?>


<div class="row-fluid" >
    <div class="container-fluid" valign="center"  style="padding-top:0%;">
        <div >
            <!-- Div de Personal -->
            <div align="center" valign="top" class="messageButtonb blue">
                <?php echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/Dashboard/user_accounts.png" alt="Personal"  width="15%" />', array('personal/admin'));?>
                <div  class="dashIconText"><?php echo CHtml::link('<h4>Personal</h4>',array('personal/admin')); ?></div>
            </div>
            
            <!-- Div de Contratistas -->
            <div align="center" valign="top" class="messageButtonb blue">
                <?php echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/Dashboard/worker.png" alt="Contratistas"  width="15%" />', array('contratista/admin'));?>
                <div class="dashIconText"><?php echo CHtml::link('<h4>Contratistas</h4>',array('contratista/admin')); ?></div>
            </div>

            <!-- Div de Ordenes de Trabajo -->
            <div align="center" valign="top" class="messageButtonb blue">
                <span class="badge badge-warning iconMenuBadge"><?php echo OrdenTrabajo::model()->getNumberOTP()?></span>
                <span class="badge badge-success iconMenuBadge"><?php echo OrdenTrabajo::model()->getNumberOTA()?></span>
                
                <?php echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/Dashboard/work-order.png" alt="Ordenes de Trabajo"  width="15%" />', array('ordenTrabajo/admin'));?>
                <div  class="dashIconText"><?php echo CHtml::link('<h4>Ordenes de Trabajo</h4>',array('ordenTrabajo/admin')); ?></div>
            </div>

            <!-- Div de Aprobacion de Documentos-->
            <div align="center" valign="top" class="messageButtonb blue">
                
                <?php echo CHtml::link('<img src='.'"'. Yii::app()->theme->baseUrl.'/img/big_icons/Dashboard/appicon.png" alt="Aprobación de Documentos"  width="15%" />', array('ordenTrabajo/admin'));?>
                <div  class="dashIconText"><?php echo CHtml::link('<h4>Aprobación de Documentos</h4>',array('ordenTrabajo/admin')); ?></div>
            </div>
        </div>
    </div>
</div><!--/row-->


