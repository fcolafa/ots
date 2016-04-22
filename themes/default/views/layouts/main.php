<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Sistema web.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Aprobación de Documentos">
    <meta name="author" content="J Daniel Alvarado Ruiz">
	  <!-- <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>  -->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	  $cs = Yii::app()->getClientScript();
	  Yii::app()->clientScript->registerCoreScript('jquery');
	?>
    <!-- Fav and Touch and touch icons -->
    <link rel="shortcut icon" href="<?php echo $baseUrl;?>/img/icons/logoastilleros.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl;?>/img/icons/logoastilleros.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl;?>/img/icons/logoastilleros.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl;?>/img/icons/logoastilleros.png">
	<?php  
	  $cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
	  $cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
	  $cs->registerCssFile($baseUrl.'/css/abound.css');
	  $cs->registerCssFile($baseUrl.'/css/tables.css');
      $cs->registerCssFile($baseUrl.'/css/styles.css');
    //$cs->registerCssFile($baseUrl.'/css/icons-style.css');
	  //$cs->registerCssFile($baseUrl.'/css/style-blue.css');
	  ?>
      <!-- styles for style switcher -->
      	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>/css/style-green.css" />
	  <?php
    //$cs->registerScriptFile($baseUrl.'/js/controlTiempo.php');

    $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
    //$cs->registerScriptFile($baseUrl.'/js/jquery-ui.min.js');    
    
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/charts.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/styleswitcher.js');
	?>
        
    <script type="text/javascript">    
        var guest="<?php echo Yii::app()->user->isGuest?'false':'true'?>";
        var stime=5;
        $(document).ready(function () {
		var idleState = false;
		var idleTimer = null;
        $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
            clearTimeout(idleTimer);
            if (idleState == true && guest=='true') { 
                 alert("Sesión expirada por Inactividad ") ; 
                 window.location.replace("<?php echo Yii::app()->createAbsoluteUrl("Site/logout"); ?>");
                 idleState=false;
            }
            idleState = false;
            idleTimer = setTimeout(function () {idleState = true; }, stime*60000);
        });
    }
    );     
     </script>      

  </head>

<body>
<section id="navigation-main">   
<!-- Require the navigation -->
<?php require_once('tpl_navigation.php');?>
</section><!-- /#navigation-main -->
    
<section class="main-body">
    <div class="container-fluid">
            <!-- Include content pages -->
            
            	 <div class="info" style="text-align: left;">
         
        <?php $flashMessages=Yii::app()->user->getFlashes();
        
        if($flashMessages){
            echo '<ul class="flashes">';
            foreach ( $flashMessages as $key =>$message){
                echo '<li><div class="flash-'.$key.'">'. $message . "</div></li>\n";
        }
      echo '</ul>';
            }   
        ?>
        </div>
            <?php echo $content; ?>
    </div>
</section>

<!-- Require the footer -->
<?php require_once('tpl_footer.php');?>

  </body>
</html>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect',
        '$(".info").animate({opacity:1.0},10000).slideUp("slow");',
        CClientScript::POS_READY
        );