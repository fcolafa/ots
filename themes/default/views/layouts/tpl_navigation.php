<div class="container">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <!-- Be sure to leave the brand out there if you want it shown -->

            

                <div aling="center" class="offset3" >
                    <!--<img  width="80" src="<?php echo Yii::app()->baseUrl . "/images/logoastilleros.jpg" ?>" /> -->
                </div>

                <div class="nav-collapse">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- aquí esta el menú que se está utilizando -->
<div class="subnav navbar navbar-fixed-top">
    <?php if(!Yii::app()->user->isGuest):?>
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array('class' => 'pull-right nav'),
                    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                    'itemCssClass' => 'item-test',
                    'encodeLabel' => false,
                    'items' => array(
                        array('label' => 'Inicio', 'url' => array('/site/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Manual', 'url' => array('/manual/index'), 'visible' => !Yii::app()->user->isGuest),

                        array('label' => 'Mantenciones <span class="caret"></span>', 'url' => '#', 'visible' => Yii::app()->user->ADM() || Yii::app()->user->A1() || Yii::app()->user->JDP(), 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                array('label' => 'Ver Equipos', 'url' => array('equipo/admin')),
                                array('label' => 'Crear Equipos', 'url' => array('equipo/create')),
                                array('label' => 'Registrar Horómetros', 'url' => array('registroHorometro/create')),
                                array('label' => 'Registrar Mantenciones', 'url' => array('registroMantencion/create')),
                            )),

                        array('label' => 'Centro de Costos', 'url' => array('centroDeCostos/admin'),'visible' => Yii::app()->user->ADM()|| Yii::app()->user->A1()),
                        //menú de Ingreso de Documentos
                        array('label' => 'Documentos <span class="caret"></span>', 'url' => '#', 'visible' => !Yii::app()->user->isGuest, 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                array('label' => 'Ordenes de Trabajo <span class="badge badge-success">' . OrdenTrabajo::model()->getNumberOTA() . '</span> <span class="badge badge-warning">' . OrdenTrabajo::model()->getNumberOTP() . '</span><span class="badge badge-important">' . OrdenTrabajo::model()->getNumberOTR() . '</span>', 'url' => array('ordenTrabajo/admin')),
                            //array('label'=>'Contratistas', 'url'=>array('contratista/admin')), //'visible'=>Yii::app()->user->A1()),
                            )),
                        array('label' => 'Tickets <span class="badge badge-success">'.Ticket::model()->getNumberTC().'</span><span class="badge badge-important">' . Ticket::model()->getNumberTP() . '</span>', 'url' => array('/ticket/admin'), 'visible' => !Yii::app()->user->isGuest),
                           
                        array('label' => 'Contratistas <span class="caret"></span>', 'url' => '#', 'visible' => Yii::app()->user->ADM() || Yii::app()->user->A1() || Yii::app()->user->JDP()||Yii::app()->user->OP()|| Yii::app()->user->LOG(), 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                array('label' => 'Gestionar Contratistas', 'url' => array('contratista/admin')),
                                array('label' => 'Recepción Docs. Contratistas', 'visible' => Yii::app()->user->A1(), 'url' => array('recepcionDocumentos/admin')), //'visible'=>Yii::app()->user->A1()),
                            )),
                        //menú de Configuraciones
                        array('label' => 'Maestros <span class="caret"></span>', 'url' => '#', 'visible' => Yii::app()->user->A1(), 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                array('label' => 'Cargos', 'url' => array('cargos/admin')), //'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->JP()||Yii::app()->user->SG() ),
                                array('label' => 'Centro de Costos', 'url' => array('centroDeCostos/admin')),
                                //'visible'=>!Yii::app()->user->isGuest), // Yii::app()->user->A1()||Yii::app()->user->SG()||Yii::app()->user->JP()||Yii::app()->user->GE()),
                                array('label' => 'Departamentos', 'url' => array('departamentos/admin')), //'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->JP()||Yii::app()->user->SG() ),
                                array('label' => 'Documentos Contratistas', 'url' => array('documentosContratista/admin')),
                                //array('label'=>'Recepcion Documentos' , 'url'=>array('recepcionDocumentos/admin')),
                                array('label' => 'Empresa', 'url' => array('empresa/admin')), //'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->JP()||Yii::app()->user->SG() ),
                                array('label' => 'Personal', 'url' => array('personal/admin')), //'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->JP()||Yii::app()->user->SG()),
                                array('label' => 'Tipos de OT', 'url' => array('tipoDeOt/admin')), //'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->JP()||Yii::app()->user->SG()),
                                array('label' => 'Tipos Usuarios', 'url' => array('tipoUsuario/admin')), //'visible'=>Yii::app()->user->A1()),
                            )),
                        array('label' => 'Acceder', 'url' => array('/site/login'), 'visible' => false),
                        array('label' => Yii::app()->user->name . '<span class="caret"></span>', 'url' => '#', 'visible' => !Yii::app()->user->isGuest, 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                            'items' => array(
                                // array('label'=>'Ordenes de Trabajo <span class="badge badge-success">'. OrdenTrabajo::model()->getNumberOTA().'</span> <span class="badge badge-warning">'.  OrdenTrabajo::model()->getNumberOTP() .'</span>', 'url'=>array('ordenTrabajo/admin')), //'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->JP()||Yii::app()->user->SG() ),
                                //'visible'=>!Yii::app()->user->isGuest), // Yii::app()->user->A1()||Yii::app()->user->SG()||Yii::app()->user->JP()||Yii::app()->user->GE()),
                                array('label' => 'Cuenta', 'url' => array('Personal/viewPersonal', 'id' => Yii::app()->user->id)),
                                array('label' => 'Cerrar Sesion', 'url' => array('site/logout')),
                            //'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->JP()||Yii::app()->user->SG() ),
                            //array('label'=>'Documentos Contratistas' , 'url'=>array('documentosContratista/admin')),
                            // array('label'=>'Empresa', 'url'=>array('empresa/admin')), //'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->JP()||Yii::app()->user->SG() ),
                            //array('label'=>'Personal', 'url'=>array('personal/admin')), //'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->JP()||Yii::app()->user->SG()),
                            // array('label'=>'Tipos de OT', 'url'=>array('tipoDeOT/admin')), //'visible'=>Yii::app()->user->A1()||Yii::app()->user->GE()||Yii::app()->user->JA()||Yii::app()->user->JP()||Yii::app()->user->SG()),
                            // array('label'=>'Tipos Usuarios' , 'url'=>array('tipoUsuario/admin')), //'visible'=>Yii::app()->user->A1()),
                            )),
                    ),
                ));
                ?>
            </div>
        </div>
        <!--</div> -->
    </div>
    <?php endif; ?>
    </div>