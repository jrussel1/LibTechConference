<?
require_once('../auth.php');
require_once('../../resources/config_local.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link) {
    die('Failed to connect to server: ' . mysql_error());
}

//Select database
$db = mysql_select_db(DB_DATABASE);
if(!$db) {
    die("Unable to select database");
}


if(isset($_POST['member_id'])&&isset($_POST['id'])){
    $member_id=$_POST['member_id'];
    $ID=$_POST['id'];
}else{
    die("Something horrible has happen...");
}

echo("<table><tr><td style='width: 25%;vertical-align: text-top;'>
        <table>");
$qry="SELECT * FROM Session WHERE `Session_ID`=$ID";
$result=mysql_query($qry);
if($result){
    $qryColumns="SHOW COLUMNS FROM Session";
    $resultColumns=mysql_query($qryColumns);
    if($resultColumns){
        while ( $row = mysql_fetch_array($result) ) {
//            echo("<tr>");
            while ( $col = mysql_fetch_array($resultColumns) ) {
                echo("<tr><td><h3>".preg_replace('/_/',' ',$col['Field'])."</h3></td><td>".$row[$col['Field']]."</td></tr>");
            }
//            echo("</tr>");
        }
    }else{
        die(mysql_error());
    }
}else{
    die(mysql_error());
}

echo("</table></td>
        <td style='width: 75%;'>
        <form name='rating_panel' method='post' action=''>
        <input type='hidden' name='member_id' value='$member_id' />
        <input type='hidden' name='session_id' value='$ID' />
        <table style='border-collapse: collapse;'><tr>");

$labels=array(
    "Relevancy"=>array(
        array(
            "title"=>"RELEVANCY TO THE CONFERENCE GOALS?",
            "questionBody"=>"Conference goals include offering sessions that address how technology is applied in diverse library settings,
            including public, academic, school, and special libraries; sessions which explore new technology or novel uses
            of existing technology in libraries; and sessions that offer the opportunity to learn new skills and tools that
            participants can apply in their home library. Using a scale of 0-5, rate whether the topic covered by this
            session proposal is relevant to the Lib Tech Conference goals."
        ),array(
            "Not relevant",
            "Minimally meets some goals of the conference",
            "&nbsp;",
            "Meets many of the goals of the conference",
            "&nbsp;",
            "Highly relevant and meets all conference goals"
        )
    ),
    "Timeliness"=>array(
        array(
            "title"=>"TIMELINESS OF THE SESSION TOPIC?",
            "questionBody"=>"The Lib Tech Conference is interested in sessions that explore new trends in library technology; examine
            broader technology issues that libraries should be aware of, or that may impact libraries in the near future;
            and share innovative perspectives on established technology issues that remain highly relevant to libraries of
            all types. Using a scale of 0-5, rate this session proposal based on the timeliness of the topic covered."
        ),
        array(
            "Not timely",
            "Somewhat dated topic that is still of interest to some libraries, but has been widely covered",
            "&nbsp;",
            "The topic has been covered at conferences, but is still highly relevant",
            "&nbsp;",
            "This is a very timely topic - it's currently a 'hot' topic in many library discussion forums"
        )
    ),
    "Anticipated_Interest"=>array(
        array(
            "title"=>"ANTICIPATED INTEREST LEVEL OF CONFERENCE PARTICIPANTS?",
            "questionBody"=>"The Lib Tech Conference attracts a broad range of participants geographically, by type of library, and by type
            of position within libraries. It's important that we select sessions that reflect the interests of all types of
            libraries – large university and smaller college academic libraries, urban library systems and small town
            public libraries, school libraries of various sizes and resources, as well as corporate and special libraries.
            Also, that we strive to meet individual users at their level of expertise from the novice/beginner to the
            advanced/expert. Using a scale of 0-5, and given what we know about past conference attendees, rate whether the
            topic covered by this session proposal will be of broad interest to conference attendees."
        ),
        array(
            "Not interest",
            "Topic would have little interest to most conference attendees",
            "&nbsp;",
            "Topic is specialized, but would be of interest to many conference attendees",
            "&nbsp;",
            "Topic would have broad appeal to almost all conference attendees"
        )
    ),
    "Quality"=>array(
        array(
            "title"=>"QUALITY OF THE PROPOSAL?",
            "questionBody"=>"The quality of a submitted session proposal - thought put into the proposal, the organization and layout of
            the proposed session, the qualifications of the presenters, as well as the actual 'public' session title and
            description can all be factors which help to indicate a session proposal that should be given strong
            consideration. Using a scale of 0-5, rate this session proposal on the quality of the title and session
            description, the organization and layout of the planned session, and the qualifications of the proposed
            presenters (to the degree this is possible)."
        ),
        array(
            "Quality is unacceptable",
            "Poorly laid out and lacks focus - should be considered, but changes are needed (or possible merging)",
            "&nbsp;",
            "The proposal is well organized but may need some minor tweaking (title and description, for example)",
            "&nbsp;",
            "Excellent session proposal; well-organized, catchy title and interesting description"
        )
    )
);
$inputHolding="";
$count=0;
$qry="SELECT * FROM Review_Proposals WHERE `Proposal_ID`=$ID AND `member_id`=$member_id";
$result=mysql_query($qry);
if($result&&mysql_num_rows($result)>0){
    while ( $row = mysql_fetch_array($result) ) {
        echo("<input type='hidden' name='update' value='true'>");
        foreach(array_keys($labels) as $question){
            echo("<tr><td colspan='6'><h2>".$labels[$question][0]['title']."</h2></td></tr>
          <tr><td colspan='6'>".$labels[$question][0]['questionBody']."</td></tr>
          <tr>");
            foreach($labels[$question][1] as $label){
                echo("<td class='labels'><label for='$question$count'>".$label."</label></td>");
                if($row[$question]==$count){
                    $inputHolding=$inputHolding
                        ."<td class='radios'><input type='radio' name='$question' value='$count' id='$question$count' checked><br/>
                        <label for='$question$count'>".$count."</label></td>";
                }else{
                $inputHolding=$inputHolding
                    ."<td class='radios'><input type='radio' name='$question' value='$count' id='$question$count'><br/>
                    <label for='$question$count'>".$count."</label></td>";
                }
                $count++;
            }
            echo("</tr><tr>$inputHolding</tr>");
            $inputHolding="";
            $count=0;
        }

        echo("<tr>
        <td>
            <label for='Comments' style='vertical-align: middle;'>Any Comments?<br/>(optional)</label>
        </td>
        <td colspan='5'><br/>
            <textarea name='Comments' id='Comments' style='width: 80%;height: 100px;'>".$row['Comments']."</textarea>
        </td>
      </tr>");
    }
}else{
    echo("<input type='hidden' name='insert' value='true'>");
    foreach(array_keys($labels) as $question){
        echo("<tr><td colspan='6'><h2>".$labels[$question][0]['title']."</h2></td></tr>
          <tr><td colspan='6'>".$labels[$question][0]['questionBody']."</td></tr>
          <tr>");
        foreach($labels[$question][1] as $label){
            echo("<td class='labels'><label for='$question$count'>".$label."</label></td>");
            $inputHolding=$inputHolding
                ."<td class='radios'><input type='radio' name='$question' value='$count' id='$question$count'><br/>
            <label for='$question$count'>".$count."</label></td>";
            $count++;
        }
        echo("</tr><tr>$inputHolding</tr>");
        $inputHolding="";
        $count=0;
    }

    echo("<tr>
        <td>
            <label for='Comments' style='vertical-align: middle;'>Any Comments?<br/>(optional)</label>
        </td>
        <td colspan='5'><br/>
            <textarea name='Comments' id='Comments' style='width: 80%;height: 100px;'></textarea>
        </td>
      </tr>");
}
echo("<tr>
        <td colspan='6'><br/>
            <button type='button' name='submit_review' value='submit'>Submit</button>
        </td>
      </tr>
    </table></form>
    </td></tr></table>");
?>
<div id="resultBox"><h3></h3></div>
<script type="text/javascript">
    $("button[name=submit_review]").on("click", function(){
        var names={};
        $("form[name=rating_panel] input:radio").each(function(){
            if(names[$(this).attr("name")]!=null){
                names[$(this).attr("name")]+=1;
            }else{
                names[$(this).attr("name")]=1;
            }
        });
        if($("form[name=rating_panel] input[type=radio]:checked").length < 4){
            //do validation
            $.each(names,function(index){
                if($("form[name=rating_panel] input[name="+index+"]:checked").length<1){
                    $("form[name=rating_panel] input[name="+index+"]").parents("tr:first").addClass("err");
                }
            });
            $(".err input:first").focus();
            $(".err").on("click",function(){
                $(this).removeClass("err");
            });
        }else{
            //submit form
            var values = {};
            $.each($("form[name=rating_panel]").serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            $.ajax({
                url:"ajaxProcessing/ratings_submit.php",
                data:values,
                type:"POST"
            })
                .done(
                function(msg){
                    var resultBox = $("#resultBox");
                    resultBox.$("h3").html(msg);
                    resultBox.center();
                    resultBox.fadeIn(1000,function(){
                        resultBox.delay(500).fadeOut(1000);
                    });
                });
        }
    });

</script>
