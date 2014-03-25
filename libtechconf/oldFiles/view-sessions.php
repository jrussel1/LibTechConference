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

<br/><h2>View Sessions</h2>
<p>Use this to view Sessions. </p>
<table style='border-spacing:0px;'><tr><td colspan="8" align="right">Filter by Event and Section:</td><td colspan="8">
<form action="" method="post"><input type="hidden" name="utility" value="view" /> <input type="hidden" name="Utility_Select" value="Go" />
<select name="Filter" class="Event_ID">
<option value="1 OR 1=1" <?if(!isset($_POST['Filter'])){echo("selected='selected'");}?>>All Events</option>
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
        <?	
        if(!isset($_POST['Section'])){
        echo("<select name='Section' class='Section'>
			<option selected='selected' value='1 OR 1=1'>All Sections</option>
		</select>");
        }else{
        	echo("<select name='Section' class='Section'>");
       		 if(isset($_POST['Filter']))
				{
				$id=$_POST['Filter'];
				$qry=mysql_query("Select Section_ID,Section_Title FROM jrussell_Lib.Section where Event_ID='".$id."'");
				echo("<option value='1 OR 1=1' >All Sections</option>");
				while($row=mysql_fetch_array($qry))
					{
						if(isset($_POST['Section'])&&$_POST['Section']==$row["Section_ID"]){
							echo ("<option value='".$row['Section_ID']."' selected='selected'>"
							.$row['Section_Title']."</option>");
						}else{
							echo ("<option value='".$row['Section_ID']."'>".$row['Section_Title']
							."</option>");
					}
					}
				}
        echo("</select>");
		}
        ?>
        <input type="submit" value="Go" name="Go" /></form>
</td></tr><tr><td></td></tr>
<tr>
<td class='header'><strong>Session_ID</strong></td>
<td class='header'><strong>Title</strong></td>
<td class='header'><strong>Description</strong></td>
<td class='header'><strong>Location</strong></td>
<td class='header'><strong>Difficulty_Level</strong></td>
<td class='header'><strong>Section_Title</strong></td>
<td class='header'><strong>Time</strong></td>
<td class='header'><strong>Day</strong></td>
<td class='header'><strong>Building</strong></td>
<td class='header'><strong>Event_Title</strong></td>
<td class='header'><strong>Style</strong></td>
<td class='header'><strong>Target Audience</strong></td>
</tr>
<? 
	if(!isset($_POST['Filter'])){
			$qry2="SELECT Session.Session_ID,Event_Title,Section.Section_ID,Section_Title,Time,Day,Building,
					Session_Title,Session_Description,Session_Location,Difficulty_Level,Style
					FROM jrussell_Lib.Section,jrussell_Lib.Event,jrussell_Lib.Session
					where Event.Event_ID=Section.Event_ID and Session.Section_ID=Section.Section_ID;";
			$result2=mysql_query($qry2);
			$g=0;$gray;
			while ( $row2 = mysql_fetch_array($result2) ) {
				$g++;
		    	if($g%2!=0) $gray=" class='gray'";else $gray=" class='wrap'";
				
		    	echo("<tr".$gray.">
				<td".$gray.">".$row2["Session_ID"]."</td>
				<td".$gray.">".$row2["Session_Title"]."</td>
				<td".$gray.">".$row2["Session_Description"]."</td>
				<td".$gray.">".$row2["Session_Location"]."</td>
				<td".$gray.">".$row2["Difficulty_Level"]."</td>
				<td".$gray.">".$row2["Section_Title"]."</td>
				<td".$gray.">".$row2["Time"]."</td>
				<td".$gray.">".$row2["Day"]."</td>
				<td".$gray.">".$row2["Building"]."</td>
				<td".$gray.">".$row2["Event_Title"]."</td>
				<td".$gray.">".$row2["Style"]."</td><td>");
				$qry3="SELECT Audience FROM jrussell_Lib.Session_Target where Session_ID=".$row2["Session_ID"];
				$result3=mysql_query($qry3);
				if($result3) {$a="";
        			while ( $row3 = mysql_fetch_array($result3) ) {
        				$a=$a.$row3['Audience'].",";
				}
			}
				$a=substr($a,0,-1);
				echo($a."</td></tr>");
			}
	}else{if(isset($_POST['Section'])){
			$qry3="SELECT Session.Session_ID,Event_Title,Section.Section_ID,Section_Title,Time,Day,Building,
					Session_Title,Session_Description,Session_Location,Difficulty_Level,Style
					FROM jrussell_Lib.Section,jrussell_Lib.Event,jrussell_Lib.Session
					where Event.Event_ID=Section.Event_ID and Session.Section_ID=Section.Section_ID and 
					(Session.Event_ID =".$_POST['Filter']." and (Session.Section_ID=".$_POST['Section']."))";
	}else{$qry3="SELECT Session.Session_ID,Event_Title,Section.Section_ID,Section_Title,Time,Day,Building,
					Session_Title,Session_Description,Session_Location,Difficulty_Level,Style
					FROM jrussell_Lib.Section,jrussell_Lib.Event,jrussell_Lib.Session
					where Event.Event_ID=Section.Event_ID and Session.Section_ID=Section.Section_ID and (Session.Event_ID =".$_POST['Filter'].")";}
			$result3=mysql_query($qry3);
			$g=0;$gray;
			while ( $row3 = mysql_fetch_array($result3) ) {
				$g++;
		    	if($g%2!=0) $gray=" class='gray'";else $gray=" class='wrap'";
		    	echo("<tr".$gray.">
				<td".$gray.">".$row3["Session_ID"]."</td>
				<td".$gray.">".$row3["Session_Title"]."</td>
				<td".$gray.">".$row3["Session_Description"]."</td>
				<td".$gray.">".$row3["Session_Location"]."</td>
				<td".$gray.">".$row3["Difficulty_Level"]."</td>
				<td".$gray.">".$row3["Section_Title"]."</td>
				<td".$gray.">".$row3["Time"]."</td>
				<td".$gray.">".$row3["Day"]."</td>
				<td".$gray.">".$row3["Building"]."</td>
				<td".$gray.">".$row3["Event_Title"]."</td>
				<td".$gray.">".$row3["Style"]."</td>
				<td".$gray.">");
				$qry4="SELECT Audience FROM jrussell_Lib.Session_Target where Session_ID=".$row3["Session_ID"];
				$result4=mysql_query($qry4);
				if($result4) {$a="";
        			while ( $row4 = mysql_fetch_array($result4) ) {
        				$a=$a.$row4['Audience'].",";
				}
			}
				$a=substr($a,0,-1);
				echo($a."</td></tr>");
			}
			
	}
			echo("</table>");
		
?>
</body>
</html>
