<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<table width="550px" cellspacing="0" cellpadding="5">
		<col width="100px"/><col width="200px"/><col width="250px"/>
		<tr>
			<td colspan="3">
				<p>Please fill out the following form with your login credentials:</p>
				<p class="note">Fields with <span class="required">*</span> are required.</p>
			</td>
		</tr>
		<tr>
			<td align="right">
				<?php echo $form->labelEx($model,'username'); ?>
			</td>
			<td>
				<?php echo $form->textField($model, 'username', array('class' => 'control')); ?>
			</td>
			<td>				
				<?php echo $form->error($model,'username'); ?>
			</td>
		</tr>		
		<tr>
			<td align="right">
				<?php echo $form->labelEx($model,'password'); ?>
			</td>
			<td>
				<?php echo $form->passwordField($model,'password', array('class' => 'control')); ?>				
			</td>
			<td>
				<?php echo $form->error($model,'password'); ?>
			</td>
		</tr>		
		<tr>
			<td></td>
			<td colspan="2">
				<p class="hint"></p>
				<div class="row rememberMe">
					<?php echo $form->checkBox($model,'rememberMe'); ?>
					<?php echo $form->label($model,'rememberMe'); ?>
					<?php echo $form->error($model,'rememberMe'); ?>
				</div>
			</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">
				<div class="row buttons">
					<?php echo CHtml::submitButton('Login', array('class' => 'buttonClass')); ?>
				</div>
			</td>
		</tr>
	</table>
<?php $this->endWidget(); ?>
</div><!-- form -->
