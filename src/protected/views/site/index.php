<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php
$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=>'Message Guide',
));
?>	
	<div class="flash-error">This is an example of an error message to show you that things have gone wrong.</div>
	<div class="flash-notice">This is an example of a notice message.</div>
	<div class="flash-success" style="margin-bottom: 0px !important">This is an example of a success message to show you that things have gone according to plan.</div>
<?php $this->endWidget();?>

<p>For more details on how to use this application, please contact with <a href='<?php echo $this->createUrl("site/about") ?>'>us</a>