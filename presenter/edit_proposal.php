<?php
    require_once('../resources/config_local.php');
    $conn = pdo_connect();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Presenter Portal</title>
	<link rel="stylesheet" href="css/portal.css" type="text/css" media="screen" />
	<? include('login_panel/header_incl.php');?>
	<script type="text/javascript" src="../resources/tinymce_4.0b3/tinymce/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">tinymce.init({selector: "textarea", menubar: false, statusbar: false}); </script>
	<script src="../resources/chosen/chosen.jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../resources/chosen/chosen.css" type="text/css" media="screen" />
	<style>.default{width:232px !important;}</style>
</head>

<body>
	<? include('login_panel/panel.php'); ?>
	<br /><br />
	<div id="wrapper">
	<img src="images/banner.png" />
	<div id="nav"><? if($_SESSION['id']){ include "navbar1.html"; }else{ include "navbar2.html";}// include the navbar based on whether the user is logged in or not ---- navbar1 if in, navbar2 if not ?> </div><div id="container" class="rounded-corners">
	<div id="sidebar" class="rounded-corners" style="height:450px;" ><h3>INFORMATION NEEDED TO SUBMIT A SESSION PROPOSAL:</h3>
            <p><strong>Each session submission must include the following:</strong></p>
            <ul>
                <li>Session title;</li>
                <li>Presenter information including the full name, institution, and email address for each presenter;</li>
                <li>Identification of lead presenter- the presenter which should be primary contact for session submission and who should receive the registration discount;</li>
                <li>Full session proposal which gives complete session description (up to 300 words) that will be used to evaluate submission;</li>
				<li>Limit 150 word session abstract that can be published on the conference web site and in the conference program.</li>
            </ul>
        </div>
	<h1>Submit a Proposal</h1>
	<?
		//Sequence of editing a proposal
		if (!empty($_POST["submissiontitle"])) {
			$qry=" SELECT * FROM `".DB_DATABASE."`.`Submission` WHERE Submission.Submission_Title ='".$_POST['submissiontitle']."';";
			$result=mysql_query($qry);
			if($result) {
				$num_results = mysql_num_rows($result);
				while ( $row = mysql_fetch_array($result) ) {
					if ($num_results > 0){
						$data = mysql_fetch_array($result);
						echo ("<form action='' method='post' name='update_submission'>
						<table>
							<tr>
								<td colspan='4'><h2>Submission Info</h2></td>
							</tr>
							<tr>
								<td><label id='l".$row["Submission_Title"]."_Submission_Title' for='".$row["Sumbission_ID"]."_Submission_Title'>Title:</label></td>						
								<td><input type='text' name='".$row["Submission_Title"]."_Submission_Title' id='Submission_Title' value='".$row['Submission_Title']."'/></td>
							</tr>
							<tr>
								<td><label id='lSubmission_Style' for='Submission_Style'>Style:</label></td>
								<td><select name='Submission_Style' id='Submission_Style'>
								<option disabled='disabled' selected='selected'>Please select a type:</option>");
									$qry2="SELECT * FROM ".DB_DATABASE.".Session_Style;";
									$result2=mysql_query($qry2);
									if($result2) {
										while ( $row2 = mysql_fetch_array($result2) ) {
											echo("<option value='".$row2['Style']."' ");
											if($row['Style']==$row2['Style']){
												echo("selected='selected'");
											}
											echo(">".$row2['Style']."</option>");
										}
									}
								echo("</select></td>
							</tr>
							<tr>
								<td><label id='lDifficulty_Level' for='Difficulty_Level'>Difficulty:</label></td>
								<td><select name='Difficulty_Level' id='Difficulty_Level'>
									<option disabled='disabled' selected='selected'>Please select a difficulty:</option>          
									<option value='Beginner'"); if($row['Difficulty_Level']==="Beginner"){echo(" selected='selected'");} echo(">Beginner</option>
									<option value='Intermediate'"); if($row['Difficulty_Level']==="Intermediate"){echo(" selected='selected'");} echo(">Intermediate</option>
									<option value='Advanced'"); if($row['Difficulty_Level']==="Advanced"){echo(" selected='selected'");} echo(">Advanced</option>
								</select></td>
							</tr>					
							<tr>
								<td><label id='lMain_Presenter' for='Main_Presenter'>Main Presenter(s):</label></td>
								<td><select multiple name='Main_Presenter' id='Main_Presenter' class='chzn-limited-width' data-placeholder='Please select main presenters:'>
								");
									$qry3="SELECT * FROM `".DB_DATABASE."`.`Person`;";
									$result3=mysql_query($qry3);
									if($result3) {
										while ($row3 = mysql_fetch_array($result3)) {
											echo("<option value='".$row3['First_Name']." ".$row3['Last_Name']."' ");
											echo(">".$row3['First_Name']." ".$row3['Last_Name']."</option>");
										}
									}
								echo("</select></td>
							</tr>
							<tr>
								<td><label id='lPresenter' for='Presenter'>Presenter(s):</label></td>
								<td><select multiple name='Presenter' id='Presenter' class='chzn-unlimited-width' data-placeholder='Please select any additional presenters:'>
								");
									$qry4="SELECT * FROM ".DB_DATABASE.".Person;";
									$result4=mysql_query($qry3);
									if($result4) {
										while ($row4 = mysql_fetch_array($result4)) {
											echo("<option value='".$row4['First_Name']." ".$row4['Last_Name']."' ");
											echo(">".$row4['First_Name']." ".$row4['Last_Name']."</option>");
										}
									}
								echo("</select></td>
							</tr>
							<tr>
								<td></td><td><input type='button' id='hideshow' value='Add Presenters'></td>
							</tr>
							<tr>
								<td></td><td><div id='content' style='display:none;'><form action='' method='post'>
								First Name: <input type='text' name='firstname'>
								Last Name: <input type='text' name='lastname'>
								Institution Name: <input type='text' name='institutionname'>
								Email Address: <input type='text' name='emailaddress'>
								</form></div></td>
							</tr>
							<tr>
								<table>
								<tr>
									<td><label id='l".$row["Submission_Abstract"]."_Submission_Abstract' for='".$row["Submission_Abstract"]."_Submission_Abstract'>Abstract:</label></td>
								</tr>
								<tr>
									<tr><td></td><td><textarea>".$row["Submission_Abstract"]."</textarea></td></tr>
								</tr>
								<tr>
									<td><label id='l".$row["Description"]."_Description' for='".$row["Description"]."_Description'>Description:</label></td>
								</tr>
								<tr>
									<td></td><td><textarea>".$row["Description"]."</textarea></td>
								</tr></table>
							</tr>
						</table>
						</form>");
					}
				}
				
			}
		
		//Sequence for the creation of a new proposal
		} else {
			echo ("
			<form action='' method='post' name='submission-form'>
				<input type='hidden' value='Add' name='action' />
				<table>
					<tr>
						<td colspan='4'><h2>Submission Info</h2></td>
					</tr>
					<tr>
						<td><label>Title:</label></td>
						<td><input type='text' name='submission' id='submission-title' /></td>
					</tr>
					<tr>
								<td><label>Style:</label></td>
								<td><select name='submission-form' id='submission-style'>
								<option disabled='disabled' selected='selected'>Please select a type:</option>");
									$sql='SELECT * FROM Session_Style';
                                    foreach ($conn->query($sql) as $row) {
                                        echo "<option value='", $row['Style'], "' >", $row['Style'], "</option>";
                                    }
								echo("</select></td>
							</tr>
							<tr>
								<td><label>Difficulty:</label></td>
								<td><select name='submission-form' id='difficulty-level'>
									<option disabled='disabled' selected='selected'>Please select a difficulty:</option>          
									<option value='Beginner'>Beginner</option>
									<option value='Intermediate'>Intermediate</option>
									<option value='Advanced'>Advanced</option>
									</select>
								</td>
							</tr>					
							<tr>
								<td><label>Main Presenter:</label></td>
								<td>
								<select name='submission-form' id='main-presenter' class='chzn-limited-width'>
								<option disabled='disabled' selected='selected'>Please select a main presenter:</option>          
								");
									$sql="SELECT * FROM Person`;";
                                    $qry = $conn->query($sql);
                                    $people = $qry->fetchAll();
                                    foreach ($people as $row) {
											echo("<option value='".$row['Person_First_Name']." ".$row['Person_Last_Name']."'>".$row['Person_First_Name']." ".$row['Person_Last_Name']."</option>");
                                    }
								echo("</select></td>
							</tr>
							<tr>
								<td><label>Presenter(s):</label></td>
								<td><select multiple name='submission-form' id='presenter' class='chzn-unlimited-width' data-placeholder='Please select any additional presenters:'>
								");
                                    foreach ($people as $row) {
                                        echo("<option value='".$row['Person_First_Name']." ".$row['Person_Last_Name']."'>".$row['Person_First_Name']." ".$row['Person_Last_Name']."</option>");
                                    }
								echo("</select></td>
							</tr>
							<tr>
								<td></td><td><input type='button' id='hide-show' value='Add New Presenter'></td>
							</tr>
							<tr>
								<td colspan=2><div id='hide-show-content' style='display:none;'>
								<table>
									<tr>
										<td><label for='first-name'>First Name:</label></td>
										<td><input type='text' id='first-name'></td>
									</tr>
									<tr>
										<td><label for='last-name'>Last Name:</label></td>
										<td><input type='text' id='last-name'></td></td>
									</tr>
									<tr>
										<td><label for='institution-name'>Institution Name:</label></td>
										<td><input type='text' id='institution-name'></td>
									</tr>
									<tr>
										<td><label for='email-address'>Email Address:</label></td>
										<td><input type='text' id='email-address'></td>
									</tr>
									<tr>
										<td colspan=2 style='text-align:right;'>
											<button id='add-person-button' type='button'>Add Person</button>
										</td>
									</tr>
								</table>
								</div></td>
							</tr>
							<tr>
								<table>
								<tr>
									<td><label for='abstract'>Abstract:</label></td>
								</tr>
								<tr>
									<tr><td></td><td><textarea id='abstract'></textarea></td></tr>
								</tr>
								<tr>
									<td><label for='description'>Description:</label></td>
								</tr>
								<tr>
									<td></td><td><textarea id ='description'></textarea></td>
								</tr></table>
							</tr>
						</table>
						</form>");
		}
?>

</div>
</div>
</body>

</html>

<script type="text/javascript"> 
jQuery(document).ready(function(){
	//Function for hide/show of update presenter
    $('#hideshow').live('click', function(event) {        
        $('#content').toggle('show');
    });
	//Configuration for chosen
    var config = {
      '.chzn-limited'           	: {max_selected_options:2},	//This is how to limit selected options. Create another class with this option, so we can have both infinite and finite selects.
      '.chzn-limited-deselect'  	: {max_selected_options:2,allow_single_deselect:true},
      '.chzn-limited-no-single' 	: {max_selected_options:2,disable_search_threshold:10},
      '.chzn-limited-no-results'	: {max_selected_options:2,no_results_text:'Oops, nothing found!'},
      '.chzn-limited-width'     	: {max_selected_options:2,width:"232px"},
      '.chzn-unlimited'           	: {},
      '.chzn-unlimited-deselect'  	: {allow_single_deselect:true},
      '.chzn-unlimited-no-single' 	: {disable_search_threshold:10},
      '.chzn-unlimited-no-results'	: {no_results_text:'Oops, nothing found!'},
      '.chzn-unlimited-width'     	: {width:"232px"}
    }
	//Set all selectors to chosen
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
	//Links main presenter to presenter selector
	$("#Main_Presenter").chosen().change(function(e){
		var presenter_name = $(this).chosen().val();
		$("#Presenter").children().removeAttr('disabled');
		$("#Presenter").children().each(function(){
			if (presenter_name == $(this).val()) {
				$(this).attr('disabled', "disabled");
			}
		}).trigger("chosen:updated");
	});
	//Links presenter to main presenter selector
	$("#Presenter").chosen().change(function() {
		var presenter_names = $(this).chosen().val();
		$("#Main_Presenter").children().removeAttr('disabled');
		$("#Main_Presenter").children().each(function(){
			var main_presenter = $(this);
			$.each(presenter_names, function(index,value) {
				if (main_presenter.val() == value) {
					main_presenter.attr('disabled', "disabled");
				}});
		}).trigger("chosen:updated");
		
	});
	
	$("#addPersonButton").click(function( event ) {
		console.log(event);
		
		// Grab the form and the target url
		var $form = $("#New_Submission"),
			url = $form.attr("action");
		
		// Grab the terms from the form
		var $firstName = $form.find("input[name=firstName]"),
			$lastName = $form.find("input[name=lastName]"),
			$instituionName = $form.find("input[name=institutionName]"),
			$emailAddress = $form.find("input[name=emailAddress");
		
		var terms = new Array($firstName.val(),
							$lastName.val(),
							$instituionName.val(),
							$emailAddress.val());
		
		console.log(terms);
		
		// Send the data using post
		$.post(url, { 'newPerson': terms });
				
		// Clear the form inputs
		$firstName.val('');
		$lastName.val('');
		$instituionName.val('');
		$emailAddress.val('');
		
				
		// Toggle the hide/show form
		$('#content').toggle('show');
		
		
		
	});
	
	
	
	
});
</script>