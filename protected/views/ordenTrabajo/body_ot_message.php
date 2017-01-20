


<h1> <?php echo $subject ?></h1>
<br>
<div>
<p><?php echo $content ?></p>
<p>
    <?php 
    $server=$_SERVER["SERVER_NAME"];
    if($server=='localhost')
             $server.='/ots';
           
    ?>
    <?php echo CHtml::link("Haga clic aqui ",$_SERVER["SERVER_NAME"]."/ordenTrabajo/".$model->ID_OT);  ?> para revisar.
</p>
</div>


