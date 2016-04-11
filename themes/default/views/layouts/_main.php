<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Sistema web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Aprobación de Documentos">
    <meta name="author" content="J Daniel Alvarado R.">
	<!-- <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'> -->

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
    <link rel="shortcut icon" href="<?php echo $baseUrl;?>/img/icons/logoastilleros.jpg">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl;?>/img/icons/logoastilleros.jpg">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl;?>/img/icons/logoastilleros.jpg">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl;?>/img/icons/logoastilleros.jpg">
	<?php  
	  $cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
	  $cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
	  $cs->registerCssFile($baseUrl.'/css/abound.css');
	  //$cs->registerCssFile($baseUrl.'/css/style-blue.css');
	  ?>
      <!-- styles for style switcher -->
      	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl;?>/css/style-green.css" />
	  <?php
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/charts.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
	  $cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
	  $cs->registerScriptFile($baseUrl.'/js/styleswitcher.js');

    $cs->registerScriptFile($baseUrl.'/js/jquery-1.12.1.min.js');
    $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
    
	?>
  </head>

<body>

<section id="navigation-main">   
<!-- Require the navigation -->
<?php require_once('tpl_navigation.php');?>
</section><!-- /#navigation-main -->
    
<section class="main-body">
    <div class="container-fluid">
            <!-- Include content pages -->
            <?php echo $content; ?>
    </div>
</section>

<!-- Require the footer -->
<?php require_once('tpl_footer.php');?>

  </body>
</html>