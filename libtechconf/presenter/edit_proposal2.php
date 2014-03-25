<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Presenter Portal</title>
    <link rel="stylesheet" href="css/portal.css" type="text/css" media="screen"/>
    <?php
    include('login_panel/header_incl.php');
    ?>
    <script type="text/javascript" src="../resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" href="../resources/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../resources/tinymce_4.0b3/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">tinymce.init({selector: "textarea", menubar: false, statusbar: false}); </script>
    <script src="../resources/chosen/chosen.jquery.min.js" type="text/javascript"></script>
    <script src="js/edit_proposal.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../resources/chosen/chosen.css" type="text/css" media="screen"/>
    <style>.default {
            width: 232px !important;
        }</style>
</head>

<body>
<?php
include('login_panel/panel.php');
?>
<br/><br/>

<div id="wrapper">
    <img src="images/banner.png"/>

    <div id="nav">
        <?php
        if ($_SESSION['id']) {
            include "navbar1.html";
        } else {
            include "navbar2.html";
        } // include the navbar based on whether the user is logged in or not ---- navbar1 if in, navbar2 if not
        ?>
    </div>
    <div id="container" class="rounded-corners">
        <div id="sidebar" class="rounded-corners" style="height:450px;">
            <h3>INFORMATION NEEDED TO SUBMIT A SESSION PROPOSAL:</h3>

            <p><strong>Each session submission must include the following:</strong></p>
            <ul>
                <li>Session title;</li>
                <li>Presenter information including the full name, institution, and email address for each presenter;
                </li>
                <li>Identification of lead presenter- the presenter which should be primary contact for session
                    submission and who should receive the registration discount;
                </li>
                <li>Full session proposal which gives complete session description (up to 300 words) that will be used
                    to evaluate submission;
                </li>
                <li>Limit 150 word session abstract that can be published on the conference web site and in the
                    conference program.
                </li>
            </ul>
        </div>


        <h1>Submit a Proposal</h1>

        <?php
        // Boolean on whether or not the submission exists
        if (!empty($_POST["submissiontitle"])) {
            $edit = true;
        }
        ?>

        <form action='' method='post' name='submission-form'>
            <input type='hidden' value='Add' name='action'/>
            <table>
                <tr>
                    <td colspan='4'><h2>Submission Info</h2></td>
                </tr>
                <tr>
                    <td><label for="submission-title">Title:</label></td>
                    <td><input type="text" name="submission-form" id='submission-title'/></td>
                </tr>
                <tr>
                    <td><label for="submission-style">Style:</label></td>
                    <td><select name="submission-form" id="submission-style">
                            <option disabled="disabled" selected="selected">Please select a type:</option>
                            <!--populated by JQuery-->
                        </select></td>
                </tr>
                <tr>
                    <td><label for="difficulty-level">Difficulty:</label></td>
                    <td><select name="submission-form" id="difficulty-level">
                            <option disabled="disabled" selected="selected">Please select a difficulty:</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="main-presenter">Main Presenter:</label></td>
                    <td>
                        <select name="submission-form" id="main-presenter" class='chzn-limited-width'>
                            <option disabled='disabled' selected='selected'>Please select a main presenter:</option>
                            <!--populated by JQuery-->
                        </select></td>
                </tr>
                <tr>
                    <td><label for="presenter">Presenter(s):</label></td>
                    <td colspan="3"><select multiple name='submission-form' id='presenter' class='chzn-unlimited-width'
                                data-placeholder='Please select any additional presenters:'>
                            <!--populated by JQuery-->
                        </select></td>
                </tr>
                <tr>
                    <td colspan=4 align="right"><a id='hide-show' href='#hide-show-content'><button>Add New Person</button></a></td>
                </tr>
                <tr>
                    <td>
                        <div style='display:none;'>
                            <div id="hide-show-content">
                            <table>
                                <tr>
                                    <td><label for='first-name'>First Name:</label></td>
                                    <td><input type='text' id='first-name'></td>
                                </tr>
                                <tr>
                                    <td><label for='last-name'>Last Name:</label></td>
                                    <td><input type='text' id='last-name'></td>
                                    </td>
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
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                        <tr>
                            <td><label for='abstract'>Abstract:</label></td>
                        </tr>
                        <tr>
                        <tr>
                            <td colspan="2"><textarea id='abstract'></textarea></td>
                        </tr>
                        </tr>
                        <tr>
                            <td><label for='description'>Description:</label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><textarea id='description'></textarea></td>
                        </tr>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>

</html>