<p>
   <?=$subject?>  <?php echo CHtml::link("Haga clic aqui ",$_SERVER["SERVER_NAME"]."/ticket/view?id=".$model->ID_TICKET);  ?> para revisar
</p>


<?php //CHtml::link("http://".$_SERVER["SERVER_NAME"].Yii::app()->controller->renderPartial('render', array(),true), array("presupuesto/view&id=".$data->ID_PRESUPUESTO)));?>

