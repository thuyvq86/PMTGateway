<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'View',
);
?>

	

	
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#example').dataTable( {
			"aaData": <?php echo $model-> getData() ?>,
		    "aoColumns": <?php echo $model-> aoColumns ?>,
			//"bFilter": false,
			"iDisplayLength": 10
		} );
	} );
</script>

<body id="dt_example" class="example_alt_pagination">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<tfoot>
		<tr>
			<th colspan="2"></th>
		</tr>
	</tfoot>
</table>		
</body>





 




