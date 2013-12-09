<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Report';
$this->breadcrumbs=array(
	'Report',
);
?>
<h1>Report</h1>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').dataTable( {
			"aaData": <?php echo $model->aaData ?>,
		    "aoColumns": <?php echo $model->aoColumns ?>,
			"sPaginationType": "full_numbers"
		} );
	
		$( "#fromDate" ).datepicker({
			dateFormat: 'dd/mm/yy',
			onClose: function( selectedDate ) {
				$( "#toDate" ).datepicker( "option", "minDate", selectedDate );
			},
			beforeShow: function( selectedDate ) {
				$( "#fromDate" ).datepicker( "option", "maxDate", $( "#toDate" ).datepicker("getDate") );
			}	   
		}).datepicker("setDate", new Date("<?php echo $model->fromDate ?>"));
		
		$( "#toDate" ).datepicker({
			dateFormat: 'dd/mm/yy',
			onClose: function( selectedDate ) {
				$( "#fromDate" ).datepicker( "option", "maxDate", selectedDate );
			},
			beforeShow: function( selectedDate ) {
				$( "#toDate" ).datepicker( "option", "minDate", $( "#fromDate" ).datepicker("getDate") );
			}
		}).datepicker("setDate", new Date("<?php echo $model->toDate ?>"));
	} );
</script>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'report-form',
	'action' => $this->createUrl('merchant/report')
)); ?>

<div id="dt_example" class="example_alt_pagination">
From: <input type="text" id="fromDate" name="fromDate" style="width: 80px"> To: <input type="text" id="toDate" name="toDate" style="width: 80px">
<?php echo CHtml::submitButton('Search', array('class' => 'buttonClass')); ?>
<br/>
<br/>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<tfoot>
		<tr>
			<th colspan="6"></th>
		</tr>
	</tfoot>
</table>
</div>

<?php $this->endWidget(); ?>