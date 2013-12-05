<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>For more details on how to further develop this application, please contact with <a href='<?php echo $this->createUrl("site/about") ?>'>us</a>