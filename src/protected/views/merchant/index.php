<?php
$this -> pageTitle = Yii::app()->name . ' - Merchant';
$this -> breadcrumbs = array(
	'Merchant',
);
?>
<h1>Merchant</h1>

<div class="form">
	<?php $form = $this -> beginWidget('CActiveForm', array(
		'id' => 'load-form',
		'action' => $this -> createUrl('merchant/index')
	)); ?>
	<center>
		<table cellpadding="5" cellspacing="0">		
			<tr>
				<td class="bold" align="right">Merchant</td>
				<td width="200px">				
					<?php echo $form->dropDownList($model, 'merchantId', $model -> merchant, array('onchange' => 'loadMerchant();')); ?>				
				</td>
				<td>
					<input type="button" value="Add" class="buttonClass" onclick="addMerchant()"/>
				</td>
			</tr>
		</table>
	</center>
	<?php $this->endWidget(); ?>
	
	<?php 
		if($model -> message != '')
		{
			echo '<div class="flash-success">' . $model -> message . '</div>';
		}
	?>
	<div class="flash-error" style="display: none;"></div>
	
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Infomation',
		));
	?>
	
		<?php $form = $this -> beginWidget('CActiveForm', array(
			'id' => 'save-form',
			'action' => $this -> createUrl('merchant/update')
		)); ?>
		<center>
			<table cellpadding="5" cellspacing="0">
				<col width="150px"/><col width="200px"/><col width="150px"/><col width="200px"/>
				<tr>
					<td align="right">Provider Code<span class="required">*</span></td>
					<td>
						<?php echo $form -> textField($model, 'merchantCode', array('class' => 'control', 'title' => 'Provider Code')); ?>
					</td>
					<td align="right">Provider Name<span class="required">*</span></td>
					<td>
						<?php echo $form -> textField($model, 'merchantName', array('class' => 'control', 'title' => 'Provider Name')); ?>
					</td>
				</tr>				
				<tr>
					<td align="right" style="vertical-align: top !important">Description</td>
					<td colspan="3">
						<?php echo $form -> textarea($model, 'description'); ?>
					</td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="merchantId" value="<?php echo $model -> merchantId ?>"/>
					</td>
					<td colspan="3">
						<input type="submit" value="Save" class="buttonClass" onclick="return onBeforeSave()"/>
					</td>
				</tr>
			</table>
		</center>
		<?php $this->endWidget(); ?>
	<?php $this->endWidget();?>
</div>

<script type="text/javascript">
	function loadMerchant()
	{
		var form = document.getElementById("load-form");
		form.submit();
	}
	
	function addMerchant()
	{
		var form = $("#save-form");
		var element = form.find("input:hidden");
		element.val(0);
		
		var elements = form.find("input:text, textarea");
		elements.val("");
		elements[0].focus();
	}
	
	function alertError(message)
	{
		var element = $("div.flash-error");
		element.html(message);
		element.show();
	}

	function onBeforeSave()
	{
		try
		{
			var elements = $("input:text.control");
			
			for(var i = 0; i < elements.length; i++)
			{				
				var element = elements[i];				
				if(element.value.trim() == "")
				{
					alertError(element.title + " is required.");	
					$(element).addClass("error");
					element.focus();
					return false;
				}
				else
				{
					$(element).removeClass("error");
				}
			}
		}
		catch(ex)
		{
			alert(ex);
			return false;
		}
				
		return true;
	}
</script>
