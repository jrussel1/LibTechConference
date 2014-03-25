/**
 * Created by jesse on 1/23/14.
 */
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

$(document).ready(function(){


    //this is the floating content
    var $floatingSidebar = $('#floatingSidebar');
    $floatingSidebar.css({
        top: $("tr#days").height()
    });
    if($('#body').length > 0){

        var bodyY = parseInt($('#body').offset().top) - 20;

        $(window).scroll(function () {

            var scrollY = $(window).scrollTop();

            if($floatingSidebar.length > 0){

                if ( scrollY >= bodyY) {
                    $floatingSidebar.stop().css({
                        position: 'fixed',
                        top: $("tr#days").height()
                    });
                }
            }
        });
    }
    //Creates the schedule
    $.ajax("ajaxProcessing/scheduleSections.php").done(function(result){
        var sections = JSON.parse(result);
        var sessions = {};	//Make session dict
        for(var sec in sections){
            for(var sess in sections[sec].child_sessions){
                sessions[sess]=sections[sec].child_sessions[sess];
            }
        }

        //gather the days for header
        var days = {};
        $.each(sections, function(index, value) {
            if($.inArray(value.Section_Title.split(' ')[0],days)<0){
                days[value.Day]=value.Section_Title.split(' ')[0];
            }

        });
        //place days in header
        $.each(days, function(index,value) {
            $("tr#days").append("<td><h2>"+value+"</h2></td>");
            //Add day container to sidebar cart
            $("div#cart").append("<div class='cart-day-container' id='"+index+"'><h2>"+value+"</h2></div>");
        });
        //get each start time
        var startTimes = [];
        $.each(sections, function(index, value) {
            var startToEnd = value.Start_Time+"-"+value.End_Time;
            if($.inArray(startToEnd,startTimes)<0){
                startTimes.push(startToEnd);
            }
            //Add time containers to sidebar cart
            $("div#cart").find("div#"+value.Day).append("<div class='cart-time-container' id='"
                    +startToEnd.replace(/\:/g, '')+"'><h4>"+value.Section_Title+"</h4></div>");

        });
        //Add rows for each start time with columns corresponding to each day
        $.each(startTimes, function() {
            var startToEnd = this.replace(/\:/g, '');
            var row="<tr id='"+startToEnd+"'><td class='time'><h3>"+this+"</h3></td>";
            for(var day in days){
                row+="<td class='sessCells' id='"+startToEnd+"_"+day+"'></td>";
            }
            $("table#sched").append(row+"</tr>");

        });

        $.each(sections, function(index, value) {
            var startToEnd = value.Start_Time.replace(/\:/g, '')+"-"+value.End_Time.replace(/\:/g, '');
            var cell = $("td#"+startToEnd+"_"+value.Day);

            $.each(value.child_sessions, function(index, value) {
                if(value.Session_Title!=null){
                    cell.append("<div class='session' id='"+value.Session_ID+"_"+cell.attr("id")+"'>"+value.Session_Title+"</div>");
                }
            });

        });
        $.each(sections, function(index, value) {
            var startToEnd = value.Start_Time.replace(/\:/g, '')+"-"+value.End_Time.replace(/\:/g, '');
            var cell = $("td#"+startToEnd+"_"+value.Day);
            var hue = 'rgb(' + (Math.floor((256-199)*Math.random()) + 200) + ',' + (Math.floor((256-199)*Math.random()) + 200) + ',' + (Math.floor((256-199)*Math.random()) + 200) + ')';
            cell.find("div").each(function(){
                $(this).css("background-color",hue).css("width",$(this).width());
            });
        });
                //TODO: Change this to be to the left if in main table and to the right if in sidebar. Also fix the off screen issue
//            $("div.session").hover(function () {
//                    var info = sessions[$(this).attr("id").split('_')[0]];
//                    $("#tooltip").html("<h2>"+info.Session_Title+"</h2><br/><p>"+info.Session_Location+"<br/><br/>"+sections[info.Section_ID].Section_Title+"<br/><br/>"+info.Session_Description+"</p>");
//                    var pos = $(this).position(); //offset()
//                    var width = $(this).width();
//                    var height = $(this).height();
//                    if(!$(this).hasClass("selected-sess")){
//                        $(this).addClass("selected-sess");
//                    }//FIX ME!!! GOES OFF TOP!!!
//                    if($("#tooltip").height()+pos.top<window.pageYOffset+window.innerHeight){
//                        $("#tooltip").css("top",(pos.top+height)+15).css("left",pos.left+(width/2)-($("#tooltip").width()/2));
//                        $(".arrow-up").css("top",(pos.top+height)+5).css("left",pos.left+(width/2));
//                        $("#tooltip").fadeIn();
//                        $(".arrow-up").fadeIn();
//                    }
//                    else{
//                        $("#tooltip").css("top",(pos.top)-30-$("#tooltip").height()).css("left",pos.left+(width/2)-($("#tooltip").width()/2));
//                        $(".arrow-down").css("top",(pos.top)-10).css("left",pos.left+(width/2));
//                        $("#tooltip").fadeIn();
//                        $(".arrow-down").fadeIn();
//                    }
//                },
//                function () {
//                    $("#tooltip").finish().hide();
//                    $(".arrow-up").finish().hide();
//                    $(".arrow-down").finish().hide();
//                    if($(this).hasClass("selected-sess")){
//                        $(this).removeClass("selected-sess");
//                    }
//                }
//            );

        //Add options for multiselects
        $.each(startTimes, function() {
            var option="<option value='"+this+"'>"+this+"</option>";
            $("#start_time_select").append(option);

        });
        var sessionStyles = [];
        $.each(sessions, function() {
            //console.log(this);
            var option="<option value='"+this.Session_Title+"'>"+this.Session_Title+"</option>";
            $("#session_title_select").append(option);

            //collect session styles for next set of options
            if($.inArray(this.Style,sessionStyles)<0){
                sessionStyles.push(this.Style);
            }
        });
        $.each(sessionStyles, function() {
            var option="<option value='"+this+"'>"+this+"</option>";
            $("#session_style_select").append(option);

        });
        //Must be placed after options are added
        $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});

        //On change to multiselects, rebuild schedule to reflect selections
        var allFilters = true;
        var fadeTimes = function(){
            console.log(allFilters);
            //Get current selected times
            var currentTimes = [];
            $("#start_time_select option:selected").each(function(){
                currentTimes.push(this.value.replace(/\:/g, ''));
            });
            //if there are selections
            if(currentTimes.length>0){
                if(allFilters){
                    $("tr").each(function(){
                        //if row isn't in currentTimes and has a td with class 'time' then fade it out
                        if($.inArray(this.id,currentTimes)<0 && $(this).find("td.time").length != 0){
                            $(this).fadeOut();
                        }
                        //else make sure it is faded in
                        else{
                            $(this).fadeIn();
                        }
                    });
                }
                else{
                    $("tr").each(function(){
                        //if row isn't in currentTimes and has a td with class 'time' then fade it out
                        if($.inArray(this.id,currentTimes)<0 && $(this).find("td.time").length != 0){
                            $(this).find("td").each(function(){
                                $(this).fadeOut();
                            });
                        }
                        //else make sure it is faded in
                        else{
                            $(this).find("td").each(function(){
                                $(this).fadeIn();
                            });
                        }
                    });
                    fadeSessions();
                }
                //else make sure every row is faded in
            }else{
                $("tr").each(function(){
                    $(this).find("td").each(function(){
                        $(this).fadeIn();
                    });
                });
            }
        };

        var fadeSessions = function() {console.log(allFilters);
            //Get current selected styles
            var currentStyles = [];
            var currentStyleTitles = [];
            $("#session_style_select option:selected").each(function(){
                currentStyles.push(this.value);
            });
            //if there are selections for styles
            if(currentStyles.length>0){
                $.each(sessions,function(){
                    //if session has a style not in currentStyles
                    if($.inArray(this.Style,currentStyles)>=0){
                        currentStyleTitles.push(this.Session_Title);
                    }
                });
            }
            var currentTitles = [];
            //Get current selected titles
            $("#session_title_select option:selected").each(function(){
                currentTitles.push(this.value);
            });
            //if there are selections
            if(currentTitles.length>0&&currentStyles.length>0){
                $("div.session").each(function(){
                    //if div with class session isn't in currentTitles
                    //if allFilters is set, then session must match all filters. If not, then it must just match one filter.
                    if(allFilters){
                        if($.inArray($(this).text(),currentTitles)<0 || $.inArray($(this).text(),currentStyleTitles)<0){
                            $(this).fadeOut();
                        }
                        //else make sure it is faded in
                        else{
                            $(this).fadeIn();
                        }
                    }
                    else{
                        if($.inArray($(this).text(),currentTitles)<0 && $.inArray($(this).text(),currentStyleTitles)<0){
                            $(this).fadeOut();
                        }
                        //else make sure it is faded in
                        else{
                            $(this).fadeIn();
                        }
                    }
                });
                //else make sure every session is faded in
            }else if(currentTitles.length>0&&currentStyles.length==0){
                $("div.session").each(function(){
                    //if div with class session isn't in currentTitles
                    if($.inArray($(this).text(),currentTitles)<0){
                        $(this).fadeOut();
                    }
                    //else make sure it is faded in
                    else{
                        $(this).fadeIn();
                    }
                });
            }else if(currentTitles.length==0&&currentStyles.length>0){
                $("div.session").each(function(){
                    //if div with class session isn't in currentTitles
                    if($.inArray($(this).text(),currentStyleTitles)<0){
                        $(this).fadeOut();
                    }
                    //else make sure it is faded in
                    else{
                        $(this).fadeIn();
                    }
                });
            }else{
                $("div.session").each(function(){
                    $(this).fadeIn();
                });
            }
        };
        //Set event handlers
        $("#start_time_select").on('change', function(){ fadeTimes(); });
        $("#session_title_select, #session_style_select").on('change', function(){ fadeSessions(); });

        $("#clearAll").on("click", function(){
            $("option:selected").removeAttr("selected");
            $("#start_time_select, #session_title_select, #session_style_select").trigger("chosen:updated");
            fadeTimes();
            fadeSessions();
        });
        $("#filterSetting").toggles({text:{on:'ALL',off:'ANY'},checkbox:$("#filterBox"),on:true});
        $("#filterSetting").on("click", function(){
            allFilters = $("#filterBox").prop('checked');
        });

        $( "div.session" ).draggable({
            revert: true,
            helper: "clone",
            start:function(){
                $(this).fadeOut(500);
            },
            stop:function(){
                $(this).fadeIn(500);
            }
        });
        var cart = $("#cart");
        cart.droppable({
            tolerance: "pointer",
            drop: function( event, ui ) {
                $(ui.helper[0]).fadeOut(500, function() {
                    var session = $(ui.helper.context);
                    var sessionArray = session.attr("id").split("_");
                    var container = cart.find("div#"+sessionArray[2]+" div#"+sessionArray[1]);
//                    console.log(container);
//                    console.log(session);
                    session.css("width","");
                    if(container.css("display")=="block"){
                        session.appendTo(container).fadeIn(500);
                    }else if(container.parent().css("display")=="block"){
                        session.css("display","block");
                        container.append(session).fadeIn(500);
                    }else{
                        container.css("display","block");
                        session.css("display","block");
                        container.append(session).parent().fadeIn(500);
                    }
                    session.css("width",session.width());
                });
                $(ui.helper[0]).remove();
            }
        });
        function fadeOutSidebarContainers(){
            cart.find("div.cart-day-container").each(function(){
                var flag=false;
                $(this).find("div.cart-time-container").each(function(){
                    if($(this).children().length<2){
                        $(this).fadeOut(500);
                    }else{
                        flag=true;
                    }
                });
                if(!flag){
                    $(this).fadeOut(500);
                }
            });
        }
        var mainTable = $("#sched");
        mainTable.droppable({
            tolerance: "pointer",
            drop: function( event, ui ) {
                $(ui.helper[0]).fadeOut(500, function() {
                    var session = $(ui.helper.context);
                    var sessionArray = session.attr("id").split("_");
                    var container = mainTable.find("td#"+sessionArray[1]+"_"+sessionArray[2]);
                    session.css("width","");
                    session.css("display","");
                    session.appendTo(container).fadeIn(500);
                    session.css("width",session.width());
                    fadeOutSidebarContainers();
                });
                $(ui.helper[0]).remove();
            }
        });
    });



});