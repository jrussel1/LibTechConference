 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

	
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico">
		
		<title>Using DataTable with Editable plugin - Custom Column Editors</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
			@import "media/css/demo_validation.css";
			@import "media/css/themes/base/jquery-ui.css";
			@import "media/css/themes/smoothness/jquery-ui-1.7.2.custom.css";
		</style>

        <script src="media/js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.jeditable.js" type="text/javascript"></script>
        <script src="media/js/jquery-ui.js" type="text/javascript"></script>
        <script src="media/js/jquery.validate.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.editable.js" type="text/javascript"></script>

		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				$('#example').dataTable().makeEditable({
									sUpdateURL: function(value, settings)
									{
                             							return(value); //Simulation of server-side response using a callback function
									},
                    							"aoColumns": [
                    									null,
                    									{
                    									},
                    									{
                									        indicator: 'Saving platforms...',
                                                            					tooltip: 'Click to edit platforms',
												type: 'textarea',
                                                 						submit:'Save changes',
												fnOnCellUpdated: function(sStatus, sValue, settings){
													alert("(Cell Callback): Cell is updated with value " + sValue);
												}
                    									},
                    									{
                                                            					tooltip: 'Click to select engine version',
                                                            					loadtext: 'loading...',
                           					                                type: 'select',
                               						            		onblur: 'cancel',
												submit: 'Ok',
                                                            					loadurl: 'EngineVersionList.php',
												loadtype: 'GET',
												sUpdateURL: "CustomUpdateEngineVersion.php"
                    									},
                    									{
                                                            					indicator: 'Saving CSS Grade...',
                                                            					tooltip: 'Click to select CSS Grade',
                                                            					loadtext: 'loading...',
                           					                                type: 'select',
                               						            		onblur: 'submit',
                                                            					data: "{'':'Please select...', 'A':'A','B':'B','C':'C'}",
												sUpdateURL: function(value, settings){
													alert("Custom function for posting results");
													return value;

												}
                                                        				}
											]									

										});
				
			} );
		</script>

	</head>




<body id="dt_example">
		<div id="container">

			<div id="demo">

<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>Rendering engine</th>
			<th>Browser</th>
			<th>Platform(s)</th>
			<th>Engine version</th>
			<th>CSS grade</th>
		</tr>
	</thead>
	
	<tbody>
		<tr class="odd_gradeX" id="2">
			<td>Trident</td>
			<td>Internet Explorer 4.0</td>
			<td>Win 95+ (Entity: &amp;)</td>
			<td class="center">4</td>

			<td class="center">X</td>
		</tr>
		
	</tbody>
</table>

			</div>
			

		</div>
	</body>


</html>