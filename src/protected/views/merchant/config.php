<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Configuration';
$this->breadcrumbs = array(
	'Configuration',
);
?>
<h1>
	<?php 
		$title = "Configuration";
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
		'action' => $this -> createUrl('merchant/config')
	)); ?>
	<center>
		<table cellpadding="5" cellspacing="0" align="center">		
			<tr>
				<td class="bold" align="right">Merchant</td>
				<td width="200px">				
					<?php echo $form->dropDownList($model, 'merchantId', $model -> merchant, array('onchange' => 'loadField();')); ?>				
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
	<div class="flash-notice" style="display: none;"></div>
			
	<?php $form = $this -> beginWidget('CActiveForm', array(
		'id' => 'save-form',
		'action' => $this -> createUrl('merchant/save')
	)); ?>	
	<table id="tblField" class="DataTable" align="center">	
		<col width="10%" /><col width="20%" /><col width="60%" /><col width="10%"/>
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Value</th>
			<th>Action</th>
		</tr>
		<tr>		
			<?php
				$count = count($model -> field);
				if($count > 0)
				{
					for($i = 0; $i < $count; $i++)
					{					
						$no = $i + 1;
						$key = array_keys($model -> field)[$i];
						$item = $model -> field[$key];
						$name = "field[" . $i . "][name]";
						$value = "field[" . $i . "][value]";
						
						echo "<tr>";
						echo "<td align='center'>" . str_pad($no, 2, "0", STR_PAD_LEFT) . "</td>";
						echo "<td><input type='text' name='$name' value='$item[name]' class='control' maxlength='50'/></td>";
						echo "<td><input type='text' name='$value' value='$item[value]' class='control'/></td>";
						echo "<td align='center'><div class='image-button-delete' onclick='deleteField(this);'></div></td>";
						echo "</tr>";
					}	
				}
				else
				{
					$count++;
					
					echo "<tr>";
					echo "<td align='center'>01</td>";
					echo "<td><input type='text' name='field[0][name]' value='' class='control' maxlength='50'/></td>";
					echo "<td><input type='text' name='field[0][value]' value='' class='control'/></td>";
					echo "<td align='center'><div class='image-button-delete' onclick='deleteField(this);'></div></td>";
					echo "</tr>";
				}
			?>
		</tr>		
	</table>
	<div align="center" style="margin: 20px 0px 0px 0px;">
		<input type="button" value="Add" class="buttonClass" onclick="addField()" />
		<?php echo CHtml::submitButton('Save', array('class' => 'buttonClass', 'onclick' => 'return onBeforeSave();')); ?>
		
		<input type="hidden" name="merchantId" value="<?php echo $model -> merchantId ?>"/>
	</div>
	<?php $this->endWidget(); ?>
	
</div>

<script type="text/javascript">
	var count = <?php echo $count ?>;
	
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
		html += "<td><input type='text' name='field[" + index + "][name]' class='control' maxlength='50'/></td>";
		html += "<td><input type='text' name='field[" + index + "][value]' class='control'/></td>";
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
			var id = $("#save-form input:hidden").val();
			if(id == "")
			{
				var divNotice = $("div.flash-notice");
				divNotice.html("Please create a new merchant before continue. Click <a href='<?php echo $this -> createUrl('merchant/index'); ?>'>here</a>.");
				divNotice.show();
				return false;
			}			
			
			var divError = $("div.flash-error");
			var elements = $("input:text.control");
			if(elements.length == 0)
			{
				alertError("Please add field for merchant.");				
				return false;
			}
			
			for(var i = 0; i < elements.length; i++)
			{				
				var element = elements[i];				
				if(element.value.trim() == "")
				{
					alertError("Please input a value.");					
					
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
