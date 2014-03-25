var triggerButton = $('#trigger').find('.cT');
triggerButton.on('click',function(){
    $('#panel').toggle('slow');
    if(triggerButton.text()=='Close'){
        triggerButton.text('Add Sessions');
    }else{
        triggerButton.text('Close');
    }
});
var triggerButtonAS = $('#triggerAS').find('.cT2');
triggerButtonAS.on('click',function(){
    $('#panelAS').toggle('slow');
    if(triggerButtonAS.text()=='Close'){
        triggerButtonAS.text('Add Sessions');
    }else{
        triggerButtonAS.text('Close');
    }
});

var table_view = $('#ViewS').dataTable({"sDom": '<"H"lrpif>t<"F"p>'});
$('#AddS').dataTable({"sDom": '<"H"lrpif>t<"F"p>'});    //var tableS =
$('#AddAS').dataTable({"sDom": '<"H"lrpif>t<"F"p>'});   //var tableASA =
var tableAS = $('#ViewAS').dataTable({"sDom": '<"H"lrpif>t<"F"p>'});

table_view.$('.edit').editable( 'ajaxProcessing/edit_in_place_server.php', {
    'submitdata': function ( value ) {
        var rowInfo = $(this).attr('id').split("-");
        return {
            'rowID': rowInfo[2],
            'val': value,
            'column': rowInfo[1],
            'tableName':rowInfo[0],
            'rowIDCol':rowInfo[3]
        };
    },
    'height': '14px',
    'width': '100%',
    'onblur' : 'submit'
});

table_view.$('tbody tr').on('click', function() {
    if ( $(this).hasClass('row_selected') ) {
        $(this).removeClass('row_selected');
    }
    else {
        table_view.$('tr.row_selected').removeClass('row_selected');
        $(this).addClass('row_selected');
    }
});

$('#deleteS').on('click', function() {
    var anSelected = fnGetSelected( table_view );
    if ( anSelected.length !== 0 ) {
        $.post('ajaxProcessing/edit_in_place_server.php',
            {
                data: $.trim(anSelected[0].cells[0].textContent.replace(/\s+/g, " ")),
                table: 'Presenter_Of_Session',
                IDCol: 'Session_ID',
                IDCol2: 'Presenter_ID',
                id2:currentIndex
            }
        );
        table_view.fnDeleteRow( anSelected[0] );
    }
});

tableAS.$('tbody tr').on('click', function() {
    if ( $(this).hasClass('row_selected') ) {
        $(this).removeClass('row_selected');
    }
    else {
        tableAS.$('tr.row_selected').removeClass('row_selected');
        $(this).addClass('row_selected');
    }
});

$('#deleteAS').on('click', function() {
    var anSelected = fnGetSelected( tableAS );
    if( anSelected.length !== 0 ) {
        $.post('ajaxProcessing/edit_in_place_server.php',
            {
                data: $.trim(anSelected[0].cells[0].textContent.replace(/\s+/g, " ")),
                table: 'Person_Of_Session',
                IDCol: 'Session_ID',
                IDCol2: 'Person_ID',
                id2:currentIndex
            }
        );
        tableAS.fnDeleteRow( anSelected[0] );
    }
});