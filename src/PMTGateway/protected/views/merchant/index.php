<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Merchant';
$this->breadcrumbs=array(
	'Merchant',
);
?>
<h1>
	<?php 
		$title = "Merchant Configuration";
		if($model -> merchantName != "")
		{
			$title .= " - " . $model -> merchantName;
		}
		echo $title;
	?>
	
</h1>

<div class="form">
	
	<?php $form = $this -> beginWidget('CActiveForm', array(
		'id' => 'load-form',
		'action' => $this -> createUrl('merchant/load')
	)); ?>
	<table cellpadding="5" cellspacing="0" align="center">		
		<tr>
			<td align="right">Merchant</td>
			<td width="200px">
				<div class="field">
					<?php echo $form->dropDownList($model, 'merchantId', $model -> merchant, array('onchange' => 'loadField();', 'onfocus' => 'onControlFocus(this);', 'onblur' => 'onControlBlur(this)', 'class' => 'control')); ?>
				</div>
			</td>			
		</tr>
	</table>
	<?php $this->endWidget(); ?>
			
	<?php $form = $this -> beginWidget('CActiveForm', array(
		'id' => 'save-form',
		'action' => $this -> createUrl('merchant/save')
	)); ?>	
	<table id="tblField" width="650px" cellpadding="5" cellspacing="0" align="center">	
		<col width="100px" /><col width="250px" /><col width="250px" /><col width="50px"/>
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Value</th>
			<th></th>
		</tr>
		<tr>		
			<?php
				for($i = 0; $i < count($model -> field); $i++)
				{					
					$no = $i + 1;
					$key = array_keys($model -> field)[$i];
					$item = $model -> field[$key];
					$name = "field[" . $i . "][name]";
					$value = "field[" . $i . "][value]";
					
					echo "<tr>";
					echo "<td align='center'>" . str_pad($no, 2, "0", STR_PAD_LEFT) . "</td>";
					echo "<td><div class='field'><input type='text' name='$name' value='$item[name]' class='control' maxlength='50' onfocus='onControlFocus(this);' onblur='onControlBlur(this)' /></div></td>";
					echo "<td><div class='field'><input type='text' name='$value' value='$item[value]' class='control' onfocus='onControlFocus(this);' onblur='onControlBlur(this)'/></div></td>";
					echo "<td align='center'><div class='image-button-delete' onclick='deleteField(this);'></div></td>";
					echo "</tr>";
				}
			?>
		</tr>		
	</table>
	<table width="600px" cellpadding="5" cellspacing="0" align="center">		
		<tr>			
			<td align="center">
				<input type="button" value="Add" class="button" onclick="addField()" />
				<?php echo CHtml::submitButton('Save', array('class' => 'button', 'onclick' => 'return onBeforeSave();')); ?>
			</td>
		</tr>
	</table>
	<input type="hidden" id="hidMerchantId" name="merchantId" value=""/>
	<?php $this->endWidget(); ?>
	
</div>

<script type="text/javascript">
	var count = <?php echo count($model -> field) ?>;

	function onControlFocus(element)
	{
		$(element).parent().addClass("focus");
	}
	
	function onControlBlur(element)
	{
		$(element).parent().removeClass("focus");
	}
	
	function loadField()
	{
		var form = document.getElementById("load-form");
		form.submit();
	}
	
	function addField()
	{
		var index = count;	
		count++;		
		
		var container = $("#tblField");
		var html = "";
		html += "<tr>";
		html += "<td align='center'>" + (count < 10 ? "0" + count : count) + "</td>";
		html += "<td><div class='field'><input type='text' name='field[" + index + "][name]' class='control' maxlength='50' onfocus='onControlFocus(this);' onblur='onControlBlur(this)'/></div></td>";
		html += "<td><div class='field'><input type='text' name='field[" + index + "][value]' class='control' onfocus='onControlFocus(this);' onblur='onControlBlur(this)'/></div></td>";
		html += "<td align='center'><div class='image-button-delete' onclick='deleteField(this);'></div></td>";
		
		html += "</tr>";
		
		container.append(html);
	}
	
	function deleteField(element)
	{		
		var row = $(element).closest("tr");
		if(confirm("Are you want to delete this Field?"))
		{
			row.remove();
		}
	}
	
	function onBeforeSave()
	{
		try
		{
			var elements = $("input:text.control");
			
			if(elements.length == 0)
			{
				alert("Please add field.");
				return false;
			}
			
			for(var i = 0; i < elements.length; i++)
			{				
				var element = elements[i];
				var container = $(element).parent();
				if(element.value.trim() == "")
				{
					alert("Please input a value.");	
					container.addClass("alert");
					element.focus();
					return false;
				}
				else
				{
					container.removeClass("alert");
				}
			}
		}
		catch(ex)
		{
			alert(ex);
			return false;
		}
		
		document.getElementById("hidMerchantId").value = document.getElementById("MerchantForm_merchantId").value;
		return true;
	}
</script>
