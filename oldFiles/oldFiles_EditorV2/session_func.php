	<?						//Session functions and tables
	 $ids=explode('-',$ids);
		foreach($ids as $i){
			
			
	 echo("
	 
	 $('#trigger_".$i."').click(function(){
        $('#panel_".$i."').toggle('slow');
		
		
		if($('#trigger_".$i."').find('.cT').text()=='Close'){
			$('#trigger_".$i."').find('.cT').text('Add Presenters');
		}else{
			$('#trigger_".$i."').find('.cT').text('Close');
		}
    });
	$('#triggerAP_".$i."').click(function(){
        $('#panelAP_".$i."').toggle('slow');						
		if($('#triggerAP_".$i."').find('.cT2').text()=='Close'){
			$('#triggerAP_".$i."').find('.cT2').text('Add People');
		}else{
			$('#triggerAP_".$i."').find('.cT2').text('Close');
		}
    });
	 $('#triggerTar_".$i."').click(function(){
        $('#panelTar_".$i."').toggle('slow');						
		if($('#triggerTar_".$i."').find('.cT3').text()=='Close'){
			$('#triggerTar_".$i."').find('.cT3').text('Add Targeted Groups');
		}else{
			$('#triggerTar_".$i."').find('.cT3').text('Close');
		}
    });
	 var table_".$i." = $('#ViewP_".$i."').dataTable();
	 var tableP_".$i." = $('#AddP_".$i."').dataTable();
	 var tableAP_".$i." = $('#ViewAP_".$i."').dataTable();
	 var tableAPA_".$i." = $('#AddAP_".$i."').dataTable();
	 var tableTar_".$i." = $('#ViewTar_".$i."').dataTable();
	 var tableTarg_".$i." = $('#AddTar_".$i."').dataTable();
	 table_".$i.".$('.edit').editable( 'edit_in_place_server.php', {
		'submitdata': function ( value, settings ) {
            return {
                'id': $(this).attr('id'),
				'val': value,
                'column': table_".$i.".fnGetPosition( this )[2]
            };
        },
        'height': '14px',
        'width': '100%',
		'onblur' : 'submit'
    } );
	 $('#ViewP_".$i." tbody tr').live('click', function( e ) {
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            table_".$i.".$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });
	 $('#deleteP_".$i."').click( function( e ) {		
        var anSelected = fnGetSelected( table_".$i." );
        if ( anSelected.length !== 0 ) {
			$.post('edit_in_place_server.php',
  				{data: anSelected[0].cells[0].textContent, table: 'Presenter_Of_Session', IDCol: 'Presenter_ID', IDCol2: 'Session_ID', id2:".$i."}
  				
			);
			
            table_".$i.".fnDeleteRow( anSelected[0] );
        }
    } );
	$('#ViewAP_".$i." tbody tr').live('click', function( e ) {
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            tableAP_".$i.".$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });
	 $('#deleteAP_".$i."').click( function( e ) {		
        var anSelected = fnGetSelected( tableAP_".$i." );
        if ( anSelected.length !== 0 ) {
			$.post('edit_in_place_server.php',
  				{data: anSelected[0].cells[0].textContent, table: 'Person_Of_Session', IDCol: 'Person_ID', IDCol2: 'Session_ID', id2:".$i."}
  				
			);
			
            tableAP_".$i.".fnDeleteRow( anSelected[0] );
        }
    } );
	$('#ViewTar_".$i." tbody tr').live('click', function( e ) {
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            tableTar_".$i.".$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });
	 $('#deleteTar_".$i."').click( function( e ) {		
        var anSelected = fnGetSelected( tableTar_".$i." );
        if ( anSelected.length !== 0 ) {
			$.post('edit_in_place_server.php',
  				{data: anSelected[0].cells[0].textContent, table: 'Session_Target', IDCol: 'Audience', IDCol2: 'Session_ID', id2:".$i."}
  				
			);
			
            tableTar_".$i.".fnDeleteRow( anSelected[0] );
        }
    } );
	 ");
		} ?>