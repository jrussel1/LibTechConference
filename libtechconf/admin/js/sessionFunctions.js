/**
 * Created by jesse on 1/20/14.
 */
var triggerButton = $('#trigger').find('.cT');
triggerButton.on('click',function(){
    $('#panel').toggle('slow');
    if(triggerButton.text()=='Close'){
        triggerButton.text('Add Presenters');
    }else{
        triggerButton.text('Close');
    }
});
var triggerButtonAS = $('#triggerAP').find('.cT2');
triggerButtonAS.on('click',function(){
    $('#panelAP').toggle('slow');
    if(triggerButtonAS.text()=='Close'){
        triggerButtonAS.text('Add People');
    }else{
        triggerButtonAS.text('Close');
    }
});
var triggerButtonTar = $('#triggerTar').find('.cT3');
triggerButtonTar.on('click',function(){
    $('#panelTar').toggle('slow');
    if(triggerButtonTar.text()=='Close'){
        triggerButtonTar.text('Add Targeted Groups');
    }else{
        triggerButtonTar.text('Close');
    }
});

var table_view = $('#ViewP').dataTable({"sDom": '<"H"lrpif>t<"F"p>'});
$('#AddP').dataTable({"sDom": '<"H"lrpif>t<"F"p>'});    //var tableP =
var tableAP = $('#ViewAP').dataTable({"sDom": '<"H"lrpif>t<"F"p>'});
$('#AddAP').dataTable({"sDom": '<"H"lrpif>t<"F"p>'});   //var tableAPA =
var tableTar = $('#ViewTar').dataTable({"sDom": '<"H"lrpif>t<"F"p>'});
$('#AddTar').dataTable({"sDom": '<"H"lrpif>t<"F"p>'});  //var tableTarg =

table_view.$('.edit').editable('ajaxProcessing/edit_in_place_server.php', {
    'submitdata': function (value) {
        var rowInfo = $(this).attr('id').split("-");
        //console.log(rowInfo);
        return {
            'rowID': rowInfo[2],
            'val': value,
            'column': rowInfo[1],
            'tableName': rowInfo[0],
            'rowIDCol': rowInfo[3]
        };
    },
    'height': '14px',
    'width': '100%',
    'onblur': 'submit'
});
table_view.$('tbody tr').on('click', function () {
    if ($(this).hasClass('row_selected')) {
        $(this).removeClass('row_selected');
    }
    else {
        table_view.$('tr.row_selected').removeClass('row_selected');
        $(this).addClass('row_selected');
    }
});
$('#deleteP').on('click', function () {
    var anSelected = fnGetSelected(table_view);
    if (anSelected.length !== 0) {
        $.post('ajaxProcessing/edit_in_place_server.php',
            {
                data: $.trim(anSelected[0].cells[0].textContent.replace(/\s+/g, " ")),
                table: 'Presenter_Of_Session',
                IDCol: 'Presenter_ID',
                IDCol2: 'Session_ID',
                id2: currentIndex
            }
        );

        table_view.fnDeleteRow(anSelected[0]);
    }
});
tableAP.$('tbody tr').on('click', function () {
    if ($(this).hasClass('row_selected')) {
        $(this).removeClass('row_selected');
    }
    else {
        tableAP.$('tr.row_selected').removeClass('row_selected');
        $(this).addClass('row_selected');
    }
});
$('#deleteAP').on('click', function () {
    var anSelected = fnGetSelected(tableAP);
    if (anSelected.length !== 0) {
        $.post('ajaxProcessing/edit_in_place_server.php',
            {
                data: $.trim(anSelected[0].cells[0].textContent.replace(/\s+/g, " ")),
                table: 'Person_Of_Session',
                IDCol: 'Person_ID',
                IDCol2: 'Session_ID',
                id2: currentIndex
            }

        );
        tableAP.fnDeleteRow(anSelected[0]);
    }
});
tableTar.$('tbody tr').on('click', function () {
    if ($(this).hasClass('row_selected')) {
        $(this).removeClass('row_selected');
    }
    else {
        tableTar.$('tr.row_selected').removeClass('row_selected');
        $(this).addClass('row_selected');
    }
});
$('#deleteTar').on('click', function () {
    var anSelected = fnGetSelected(tableTar);
    if (anSelected.length !== 0) {
        //console.log(e);
        $.post('ajaxProcessing/edit_in_place_server.php',
            {
                data: $.trim(anSelected[0].cells[0].textContent.replace(/\s+/g, " ")),
                table: 'Session_Target',
                IDCol: 'Audience',
                IDCol2: 'Session_ID',
                id2: currentIndex
            }
        );

        tableTar.fnDeleteRow(anSelected[0]);
    }
});