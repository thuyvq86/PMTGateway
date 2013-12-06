<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Report',
);
?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').dataTable( {
			"aaData": <?php echo $model->aaData ?>,
		    "aoColumns": <?php echo $model->aoColumns ?>
		} );
	} );
</script>

<body id="dt_example" class="example_alt_pagination">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<tfoot>
		<tr>
			<th colspan="6"></th>
		</tr>
	</tfoot>
</table>		
</body>