<?php
/* @var $this PersonalController */
/* @var $model Personal */

$this->breadcrumbs = array(
    //'Personals'=>array('index'),
    $model->ID_PERSONA,
);

$this->menu = array(
    //array('label'=>'Ver Personal', 'url'=>array('index')),
    //array('label'=>'Crear Personal', 'url'=>array('create')),
    array('label' => 'Modificar Datos', 'url' => array('updatePersonal', 'id' => $model->ID_PERSONA)),
        //array('label'=>'Borrar Personal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_PERSONA),'confirm'=>'está usted seguro que desea eliminar del sistema este elemento?')),
        //array('label'=>'Administrar Personal', 'url'=>array('admin')),
);
?>



<div class="profile" >
    <div class="title"><h3>Perfil de Usuario</h3></div>
    <div class="profileImage">
        <img style="max-width:100px;max-height:150px" src="<?php echo Yii:: app()->theme->baseUrl . '/img/icons/profile.jpg' ?>">
    </div>
    <div class="profileContent" >

        <table>
            <tr>
                <td>
                    <b> Rut:</b>              
                </td>
                <td>
                    <?= $model->RUT_PERSONA ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b> Nombre Usuario:</b>              
                </td>
                <td>
                    <?= $model->NOMBRE_PERSONA . ' ' . $model->APELLIDO_PERSONA ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b> Correo Electronico:     </b>         
                </td>
                <td>
                    <?php echo $model->EMAIL ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b> Telefonoo:     </b>         
                </td>
                <td>
                    <?php echo $model->TELEFONO ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b> cargo:     </b>         
                </td>
                <td>
                    <?= @$model->iDCARGO->NOMBRE_CARGO ?>

                </td>
            </tr>
            <tr>
                <td>
                    <b> Departamento:     </b>         
                </td>
                <td>
                    <?= @$model->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO ?>

                </td>
            </tr>


        </table>
    </div>




</div>