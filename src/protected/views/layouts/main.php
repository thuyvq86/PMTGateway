<?php  
	$IsRender = ($this -> id == 'billPayment' ? false : true);
	$home = Yii::app()->homeUrl;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
	
	<!--<link href="<?php echo Yii::app()->request->baseUrl; ?>/media/css/demo_page.css" type="text/css" rel="stylesheet">-->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/media/css/demo_table.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/media/js/jquery.dataTables.js"></script>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css">
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	
	<?php if($IsRender) { ?>
	<div id="topnav">
		<div class="topnav_text">
			<?php
				echo '<a href='. $home . '>Home</a> | ';
				
				if(Yii::app() -> user -> isGuest)
				{
					echo '<a href='. $this -> createUrl('site/login') . '>Login</a>';
				}
				else
				{
					echo '<a href="#">My Account</a> | ';
					echo '<a href='. $this -> createUrl('site/logout') . '>Logout (' . Yii::app() -> user -> name . ')</a>';
				}
			?>
		</div>
	</div>
	<?php } ?>
	
	<div id="header">
		<div id="logo">
			<?php if($IsRender)
				{
			?>
					<a href='<?php echo $home ?>'>
						<?php echo CHtml::encode(Yii::app()->name); ?>
					</a>
			<?php
				}
				else
				{
					echo '<div>' . CHtml::encode(Yii::app()->name) . '</div>';
				}
			?>
		</div>
	</div><!-- header -->

	<?php if($IsRender) { ?>
		<div id="mainmenu">
			<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index')),				
					array('label'=>'About', 'url'=>array('/site/about')),
					
					array('label' => 'Merchant', 'url' => array('/merchant/index'), 'visible' => !Yii::app() -> user -> isGuest),
					array('label' => 'Configuration', 'url' => array('/merchant/config'), 'visible' => !Yii::app() -> user -> isGuest),
					
					array('label' => 'Report', 'url' => array('/merchant/report'), 'visible' => !Yii::app() -> user -> isGuest),
					array('label' => 'View', 'url' => array('/trxnmonitoring/view'), 'visible' => !Yii::app() -> user -> isGuest)
					
					//array('label'=>'Bill Payment', 'url'=>array('/BillPayment/BillPayment'))
				),
			)); ?>
		</div><!-- mainmenu -->
	<?php } ?>
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
