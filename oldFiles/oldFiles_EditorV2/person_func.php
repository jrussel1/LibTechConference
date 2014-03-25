<script>
	 
		$('#trigger').click(function(){
			$('#panel').toggle('slow');
			if($('#trigger').find('.cT').text()=='Close'){
				$('#trigger').find('.cT').text('Add Sessions');
			}else{
				$('#trigger').find('.cT').text('Close');
			}
		});
		
		$('#triggerAS').click(function(){
			$('#panelAS').toggle('slow');
			if($('#triggerAS').find('.cT2').text()=='Close'){
				$('#triggerAS').find('.cT2').text('Add Sessions');
			}else{
				$('#triggerAS').find('.cT2').text('Close');
			}
		});
		
		var table_view = $('#ViewS').dataTable();
		var tableS = $('#AddS').dataTable();
		var tableASA = $('#AddAS').dataTable();
		var tableAS = $('#ViewAS').dataTable();
		
		table_view.$('.edit').editable( 'edit_in_place_server.php', {
			'submitdata': function ( value, settings ) {
				return {
					'id': $(this).attr('id'),
					'val': value,
					'column': table_view.fnGetPosition( this )[2]
				};
			},
			'height': '14px',
			'width': '100%',
			'onblur' : 'submit'
		});
		
		$('#ViewS tbody tr').live('click', function( e ) {
			if ( $(this).hasClass('row_selected') ) {
				$(this).removeClass('row_selected');
			}
			else {
				table_view.$('tr.row_selected').removeClass('row_selected');
				$(this).addClass('row_selected');
			}
		});
		
		$('#deleteS').click( function( e ) {		
			var anSelected = fnGetSelected( table_view );
			if ( anSelected.length !== 0 ) {
				$.post('edit_in_place_server.php',
					{data: anSelected[0].cells[0].textContent, table: 'Presenter_Of_Session', IDCol: 'Session_ID', IDCol2: 'Presenter_ID', id2:".$i."}	
				);
				table_view.fnDeleteRow( anSelected[0] );
			}
		});
		
		$('#ViewAS tbody tr').live('click', function( e ) {
			if ( $(this).hasClass('row_selected') ) {
				$(this).removeClass('row_selected');
			}
			else {
				tableAS.$('tr.row_selected').removeClass('row_selected');
				$(this).addClass('row_selected');
			}
		});
		
		$('#deleteAS').click( function( e ) {		
			var anSelected = fnGetSelected( tableAS );
			if( anSelected.length !== 0 ) {
				$.post('edit_in_place_server.php',
					{data: anSelected[0].cells[0].textContent, table: 'Person_Of_Session', IDCol: 'Session_ID', IDCol2: 'Person_ID', id2:".$i."}			
				);	
				tableAS.fnDeleteRow( anSelected[0] );
			}
		});
	</script>