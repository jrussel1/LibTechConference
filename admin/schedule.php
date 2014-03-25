<?PHP

require_once('auth.php');
require_once('../resources/config_local.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link) {
    die('Failed to connect to server: ' . mysql_error());
}

//Select database
$db = mysql_select_db(DB_DATABASE);
if(!$db) {
    die("Unable to select database");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Schedule</title>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script src="/resources/chosen/chosen.jquery.js"></script>
    <script src="/resources/jquery-toggles-master/toggles.js"></script>
    <script src="js/schedule.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="/resources/chosen/chosen.css" />
    <link rel="stylesheet" href="/resources/jquery-toggles-master/themes/toggles-light.css" />
    <link rel="stylesheet" href="css/schedule.css" />

</head>

<body id="body">
<table>
    <tr>
        <td id="sidebarCol">
            <div id="floatingSidebar">
                <table id="filters">
                    <tr>
                        <td>
                            <h4>Start Times</h4>
                        </td>
                        <td>
                            <select data-placeholder="Choose start times..." multiple class="chosen-select" id="start_time_select">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Session Style</h4>
                        </td>
                        <td>
                            <select data-placeholder="Choose session styles..." multiple class="chosen-select" id="session_style_select">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Session Title</h4>
                        </td>
                        <td>
                            <select data-placeholder="Search session titles..." multiple class="chosen-select" id="session_title_select">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Filter setting</h4>
                        </td>
                        <td>
                            <div class="toggle-light" style="vertical-align:middle;">
                                <div class="toggle" id="filterSetting" data-ontext="ALL" data-offtext="ANY">
                                </div>
                            </div>
                            <input type="checkbox" id="filterBox" style="display:none;" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Clear All Filters</h4>
                        </td>
                        <td>
                            <button id="clearAll">Clear</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="cart"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            &nbsp;
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td id="scheduleCol">
            <table id="sched">
                <tr id="days">
                    <td style="padding-right:10px;border:0 solid #999 !important;">
                        &nbsp;
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>


<div class="arrow-up" style="display:none; position:absolute; top:0; left:0;"></div>
<div class="arrow-down" style="display:none; position:absolute; top:0; left:0;"></div>
<div id="tooltip" class="tooltip"></div>

</body>
</html>
