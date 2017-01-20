<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Acceso';
//$this->breadcrumbs=array( 'Acceso',);
?>

<?php
$this->beginWidget('zii.widgets.CPortlet', array(
));
?>
<div class="panel" >
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>        
      <?php $urlbase=  Yii::app()->theme->baseUrl?>
    <div>
        <div class="text-center ">
            <img class="" src="<?php echo Yii::app()->baseUrl?>/archivos/empresas/login.png" style="margin:20px 0;">
            <h5 class="content-group">Gestión de Documentos</h5> <small class="display-block">Acceso usuarios</small>
        </div>


      
        <?php echo $form->textField($model, 'username', 
                array('style'=>' background: url('.$urlbase.'/img/icons/user1.png) no-repeat scroll;'
                    . 'padding-left:30px;')); ?>
        <?php echo $form->error($model, 'username'); ?>
        <?php echo $form->passwordField($model, 'password',
                array( 'style'=>'background: url('.$urlbase.'/img/icons/pass.png) no-repeat scroll;'
                    . 'padding-left:30px;')
                ); ?>
        <?php echo $form->error($model, 'password'); ?>


        <!--                <div class="row">
                            <div class="span5 offset2">
        <?php // echo  $form->labelEx($model,'empresa'); ?>
        <?php //echo $form->dropDownList($model,'empresa', array(''=>'-Seleccione Empresa-')+CHtml::listData(Empresa::model()->findAll(), 'ID_EMPRESA', 'NOMBRE_EMPRESA')); ?>
        <?php //echo $form->error($model,'empresa'); ?>
                            </div>
                        </div>-->

        <div class="row rememberMe">

            <?php echo $form->checkBox($model, 'rememberMe'); ?>
            <?php echo $form->label($model, 'rememberMe'); ?>
            <?php echo $form->error($model, 'rememberMe'); ?>

        </div>
        <br>

        <?php echo CHtml::submitButton('Acceder', array('class' => 'btn btn btn-primary')); ?>


    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
<?php $this->endWidget(); ?>


