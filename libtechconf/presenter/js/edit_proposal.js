/**
 * Created by Benjamin on 3/20/14.
 */

jQuery(document).ready(function () {
//Configuration for chosen
    var config = {
        '.chzn-limited': {max_selected_options: 2},	//This is how to limit selected options. Create another class with this option, so we can have both infinite and finite selects.
        '.chzn-limited-deselect': {max_selected_options: 2, allow_single_deselect: true},
        '.chzn-limited-no-single': {max_selected_options: 2, disable_search_threshold: 10},
        '.chzn-limited-no-results': {max_selected_options: 2, no_results_text: 'Oops, nothing found!'},
        '.chzn-limited-width': {max_selected_options: 2, width: "232px"},
        '.chzn-unlimited': {},
        '.chzn-unlimited-deselect': {allow_single_deselect: true},
        '.chzn-unlimited-no-single': {disable_search_threshold: 10},
        '.chzn-unlimited-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chzn-unlimited-width': {width: "400px"}
    }
//Set all selectors to chosen
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
// Populate the submission-style select
    $.getJSON('./ajaxProcessing/model_edit_proposal.php', {method: 'submission-style'}, function (data) {
        var _select = $('<select>');
        $.each(data, function (index) {
            _select.append(
                $('<option></option>').val(index).html(data[index][0])
            );
        });
        $("#submission-style").append(_select.html());
    });
// Populate the presenter selects
    $.getJSON('./ajaxProcessing/model_edit_proposal.php', {method: 'person'}, function (data) {
        var _select = $('<select multiple>');
        $.each(data, function (index) {
            console.log(data[index][1] + ' ' + data[index][2]);
            _select.append(
                $('<option></option>').val(index).html(data[index][1] + ' ' + data[index][2])
            );
        });
        $("#main-presenter").append(_select.html()).trigger("chosen:updated");
        $("#presenter").append(_select.html()).trigger("chosen:updated");
    });
// Add the fancy box for the creation of a new presenter
    $("#hide-show").fancybox({
        'hideOnContentClick': false,
        'onClose': function () {
            parent.location.reload(true);
        }
    });
////Links main presenter to presenter selector
//    $("#main-presenter").chosen().change(function (e) {
//        var presenter_name = $(this).chosen().val();
//        $("#presenter").children().removeAttr('disabled');
//        $("#presenter").children().each(function () {
//            if (presenter_name == $(this).val()) {
//                $(this).attr('disabled', "disabled");
//            }
//        }).trigger("chosen:updated");
//    });
////Links presenter to main presenter selector
//    $("#presenter").chosen().change(function () {
//        var presenter_names = $(this).chosen().val();
//        $("#main-presenter").children().removeAttr('disabled');
//        $("#main-presenter").children().each(function () {
//            var main_presenter = $(this);
//            $.each(presenter_names, function (index, value) {
//                if (main_presenter.val() == value) {
//                    main_presenter.attr('disabled', "disabled");
//                }
//            });
//        }).trigger("chosen:updated");
//
//    });

//    $("#add-person-button").click(function (event) {
//        console.log(event);
//
//        // Grab the form and the target url
//        var $form = $("#new-person"),
//            url = $form.attr("action");
//
//        // Grab the terms from the form
//        var $firstName = $form.find("input[id=firs-name]"),
//            $lastName = $form.find("input[id=last-name]"),
//            $instituionName = $form.find("input[id=institution-name]"),
//            $emailAddress = $form.find("input[id=email-address");
//
//        var terms = new Array($firstName.val(),
//            $lastName.val(),
//            $instituionName.val(),
//            $emailAddress.val());
//
//        console.log(terms);
//
//        // Send the data using post
//        $.post(url, { 'newPerson': terms });
//
//// Clear the form inputs
//        $firstName.val('');
//        $lastName.val('');
//        $instituionName.val('');
//        $emailAddress.val('');
//
//
//// Toggle the hide/show form
//    $('#hide-show-content').toggle('show');
//});

});