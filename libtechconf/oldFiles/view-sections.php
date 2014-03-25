<?php
	require_once('auth.php');
	require_once('config.php');
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

<br/><h2>View Sections</h2>
<p>Use this to view sections. </p>
<table><tr><td colspan="5" align="right">Filter by Event:</td><td>
<form action="" method="post"><input type="hidden" name="utility" value="view" /> <input type="hidden" name="Utility_Select" value="Go" />
<select name="Filter">
<option value="1 OR 1=1" <?if(!isset($_POST['Filter'])){echo("selected='selected'");}?>>All</option>
<?
		$qry="SELECT Event_ID,Event_Title FROM jrussell_Lib.Event";
		$result=mysql_query($qry);

		//Check whether the query was successful or not
		if($result) {
			while ( $row = mysql_fetch_array($result) ) {
				if(isset($_POST['Filter'])&&$_POST['Filter']==$row["Event_ID"]){
			    	echo("<option value='".$row["Event_ID"]."' selected='selected'/>".$row["Event_Title"]."</option>");
				}else{
					echo("<option value='".$row["Event_ID"]."' />".$row["Event_Title"]."</option>");
				}
			}
		}else {
			die("Query failed");
		}

?>
		</select>
        <input type="submit" value="Go" name="Go" /></form>
</td></tr><tr><td></td></tr>
<tr><td><strong>Section_ID</strong></td><td><strong>Section_Title</strong></td><td><strong>Time</strong></td><td><strong>Day</strong></td><td><strong>Building</strong></td><td><strong>Event_ID</strong></td></tr>
<? 
	if(!isset($_POST['Filter'])){
			$qry2="SELECT * FROM jrussell_Lib.Section";
			$result2=mysql_query($qry2);
			$g=0;$gray;
			while ( $row2 = mysql_fetch_array($result2) ) {
				$g++;
		    	if($g%2!=0) $gray=" class='gray'";else $gray=" class='wrap'";
				
		    	echo("<tr".$gray.">
				<td".$gray.">". $row2["Section_ID"]."</td>
				<td".$gray.">". $row2["Section_Title"]."</td>
				<td".$gray.">". $row2["Time"]."</td>
				<td".$gray.">".$row2["Day"]."</td>
				<td".$gray.">".$row2["Building"]."</td>
				<td".$gray.">".$row2["Event_ID"]."</td></tr>");
			}
	}else{
			$qry3="SELECT * FROM jrussell_Lib.Section where Event_ID =".$_POST['Filter'];
			$result3=mysql_query($qry3);
			$g=0;$gray;
			while ( $row3 = mysql_fetch_array($result3) ) {
		    	$g++;
		    	if($g%2!=0) $gray=" class='gray'";else $gray=" class='wrap'";
				
		    	echo("<tr".$gray.">
				<td".$gray.">". $row3["Section_ID"]."</td>
				<td".$gray.">". $row2["Section_Title"]."</td>
				<td".$gray.">". $row3["Time"]."</td>
				<td".$gray.">".$row3["Day"]."</td>
				<td".$gray.">".$row3["Building"]."</td>
				<td".$gray.">".$row3["Event_ID"]."</td></tr>");
			}
	}
			echo("</table>");
		
?>
</body>
</html>
