<?php
include("../include/include.php");
$anyAdIsRun = false;
$setAdRun = false;
$isAdBlock = false;

if (!$pr->getSession("adv")) {
    $pr->redirect("../index.php");
    exit();
}
if ($read->get("action", "GET") == 'logout') {
    $adv->logout();
}
if (!$read->get("id1", "GET")) {
    $pr->redirect("my_ads.php");
    exit();
}
$de_id = $en->decode($read->get("id1", "GET"));
if (!$de_id) {
    $pr->redirect("my_ads.php");
}
$isAdBlock = $advcad->checkAdBlock($read->get("id1", "GET"));
$icon = $pr->createVerifyIcons();
//$setAdRun = $advcad->setAdIsRunning($read->get("id1", "GET"));
//$setAdRun = $advcad->tempblockAd($read->get("id1", "GET"));
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <?php include ("../include/header_css.php"); ?>
        <link rel="stylesheet" type="text/css" href="../css/viewads.css">
        <?php include ("../include/header_js.php"); ?>


    </head>
    <body>

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="main-header-wrapper">
            <div id="main-header" >
                <div id="logo" class="float-l">
                    <a href="#"><img src="../images/logo.png" width="197" height="70" alt="LOGO"></a>
                    <div id="showselect">
                        <ul id="neg1" style="display: none;">
                            <li id="neg_li"></li>
                        </ul>
                        <ul id="neg2" style="display: none;">
                            <li>Another ad is running</li>
                            <li>All ready viewed </li>
                            <li>This is expired</li>
                        </ul>
                        <ul id='pos' style="display: none;">
                            <li>Success process</li>
                            <li id="pos_li"></li>
                        </ul>
                        <?php
                        echo $icon[2];
                        ?>
                    </div>
                    <div id="showcount"><span id="count"></span><?php echo $icon[1]; ?></div>
                </div>
            </div>
        </div>
        <div id="messages">
            <?php
            $ob = $er->displayerror();

            if (($ob->error_code == 0 || $ob->error_code == 1) && $ob->error) {
                echo ($ob->error_code == 1 ? "<div class='mws-form-message error'>
                                        
                                        <ul>
                                            <li>" . $ob->error . "</li>
                                           
                                        </ul>
                                    </div>" : "<div class='mws-form-message success'>
                                        
                                        <ol>
                                            <li>" . $ob->error . "</li>
                                           
                                        </ol>
                                    </div>");
            }
            $fromValue = $er->getFromValue();
            ?>
        </div> 
        <div id="main-containt-wrapper">
            <div id="main-containt">
                <div id="ytplayer"></div>
                <?php
                $type = $con->queryUniqueObject("SELECT * FROM ads_fool WHERE ads_id='" . $de_id . "'");
                if (!$type) {
                    $pr->redirect("my_ads.php");
                }
                if ($type->adstype == 2) {
                    //check url is you tube
                    $check1 = explode(".", $type->url);
                    if ($check1) {
                        if ($check1[1] == "youtube") {
                            ?>
                            <style>
                                body,
                                html{
                                    padding:0;
                                    margin:0;
                                    overflow:hidden;
                                    background:#000;
                                }
                                #ytplayer{
                                    position:absolute;
                                    top:0;
                                    left:0;
                                    width:100%;
                                    height:1000px;
                                    z-index:1000;
                                    zoom:1;
                                    background:url(../images/dot.png) repeat;
                                }
                                #youtube-wrapper{
                                    background-color: #000000;
                                    width: 853px;
                                    margin: 80px auto 0 auto;
                                }
                                iframe body {background-color:#000;}
                            </style>
                            <?php
                            $check2 = explode("?", $type->url);
                            if ($check2) {
                                $check3 = explode("=", $check2[1]);
                                if ($check3[0] == 'v') {
                                    $id = $check3[1];
                                    if ($id) {
                                        $new_url = "http://www.youtube.com/embed/" . $id . "?modestbranding=1&controls=0&loop=1&autoplay=1&rel=0&showinfo=0";
                                    }
                                }
                            }
                            ?>
                            <div id="youtube-wrapper"><iframe width="853px" height="480px"  src="<?php echo $new_url ?>" frameborder="0"></iframe></div>
                            <?php
                        } else {
                            ?>
                            <iframe src="<?php echo $type->url ?>" width="100%" height="1000px" scrolling="yes" frameborder="0"></iframe> 
                        <?php }
                    } ?>
                <?php } else { ?>
                    <iframe src="ad.php?id1=<?php echo $read->get("id1", "GET"); ?>" width="100%" height="1000px" scrolling="yes" frameborder="0"></iframe> 
                    <?php
                }
                ?>

            </div>

            <div id="main-footer-wrapper">
                <div id="main-footer">
                    <?php //include ("../include/main_footer.php"); ?> 
                </div>
            </div>

            <?php include ("../include/footer_js.php"); ?>
            <?php
            if ($isAdBlock) {
                $cookieTime = ($type->ad_run_time + 10);
                ?>
                <script>
                    jQuery(document).ready(function($) {
                        $("#showselect").css("display","none");
                        var count = <?php echo $type->ad_run_time; ?>;
                        setCookie('ad','<?php echo $read->get("id1", "GET") ?>',<?php echo $cookieTime ?>);
                        var timerID = setInterval(function() {
                            if(count > 1){
                                $('#showcount').html(Math.floor(count-=1));
                                                                                                                                                                                                                                                                                                
                            }
                            else{
                                clearInterval(timerID); 
                                // var html="<ul id='neg'><li>another ad running</li><li>ad have viewed in ealy</li><li>ad expired</li>";
                                $('#showselect').css("display","block");
                                $("#neg1").css("display","none");
                                $("#neg2").css("display","block");
                                $("#pos").css("display","none");
                                $("#icon").css("display","none");
                                $("#sel_icon").css("display","none");
                                $('#showcount').html("");
                                del_cookie('ad');
                            } 
                        }, 2300 );
                                                                                                                                                                                                                                                                                
                    });
                </script>
                <?php
            } else {
                $cookieTime = ($type->ad_run_time + 10);
                ?>
                <script>
                    jQuery(document).ready(function($) {
                        var isCookie=false;
                        $("#showselect").css("display","none");
                        var count = <?php echo $type->ad_run_time; ?>;
                        var getcookie=getCookie("ad")
                        if(!getcookie){
                            setCookie('ad','<?php echo $read->get("id1", "GET") ?>',<?php echo $cookieTime ?>);  
                        }else{
                            isCookie=true;
                        }
                                                                                                                                                           
                        var timerID = setInterval(function() {
                            if(count > 1){
                                $('#count').html(Math.floor(count-=1));
                                                                                                                                                                                                                                                                                                
                            }
                            else{
                                clearInterval(timerID);
                                var getcookie=getCookie("ad");
                                                                                                                                                    
                                if(!isCookie){
                                    if(!getcookie && getcookie!=<?php echo $de_id ?> ){
                                        tmp('<?php echo $read->get("id1", "GET") ?>');  
                                        //var html="<ul id='neg'><li>Session error</li>";
                                        $('#showselect').css("display","block");
                                        $("#neg1").css("display","block");
                                        $("#neg2").css("display","none");
                                        $("#pos").css("display","none");
                                        $("#icon").css("display","none");
                                        $("#sel_icon").css("display","none");
                                        $('#showcount').html("");
                                        $('#neg_li').html("Session error");
                                    }else{
                                        $('#showselect').css("display","block");
                                        $("#neg1").css("display","none");
                                        $("#neg2").css("display","none");
                                        $("#pos").css("display","none");
                                        $("#count").css("display","none");
                                        $("#icon").css("display","block");
                                        $("#sel_icon").css("display","block");
                                        del_cookie('ad');
                                    }
                                }else{
                                    tmp('<?php echo $read->get("id1", "GET") ?>');  
                                    //var html="<ul id='neg'><li>Illegitimate ad click</li>";
                                    $('#showselect').css("display","block");
                                    $("#neg1").css("display","block");
                                    $("#neg2").css("display","none");
                                    $("#pos").css("display","none");
                                    $("#icon").css("display","none");
                                    $("#sel_icon").css("display","none");
                                    $('#showcount').html("");
                                    $('#neg_li').html("Session error");
                                }
                                                                                                                                                                                
                            } 
                        }, 2300 );
                                                                                                                                                                                                                                                                                
                    });
                </script>
            <?php } ?>
            <script>
                function verifyimg(id){
                   
                    if(id==2){
                        
                        verifyAd('<?php echo $read->get("id1", "GET") ?>');
                        
                    }else{
                        tmp('<?php echo $read->get("id1", "GET") ?>');
                        //var html="<ul id='neg'><li>invalid selection</li>"
                        $('#showselect').css("display","block");
                        $("#neg1").css("display","block");
                        $("#neg2").css("display","none");
                        $("#pos").css("display","none");
                        $("#icon").css("display","none");
                        $("#sel_icon").css("display","none");
                        $('#showcount').html("");
                        $('#neg_li').html("invalid selection");
                        del_cookie('ad');
                    }
                }
                    
                function tmp(adsid){
    
                    var myURL=path+"/load.php?key=tmp&id="+adsid;
                    $.ajax({    
                        type: "post",
                        url: myURL,
                        dataType: "json",
                        success: function(request) {
                            var val=request.result.response;
                            if(val=='true'){
                               
                                return true;   
                            }else{
                                return false; 
                            }
                
                        },
                        error: function(){
                            return false;
                        }// End success
                    }); // End ajax method 
    
                }
                function verifyAd(adsid){
    
                    var myURL=path+"/load.php?key=verifyAd&id="+adsid;
                    $.ajax({    
                        type: "post",
                        url: myURL,
                        dataType: "json",
                        success: function(request) {
                            var val=request.result.response;
                            if(val > 0){
                                $('#showselect').css("display","block");
                                $("#neg1").css("display","none");
                                $("#neg2").css("display","none");
                                $("#pos").css("display","block");
                                $("#icon").css("display","none");
                                $("#sel_icon").css("display","none");
                                $('#showcount').html("");
                                $('#pos_li').html("you earn $"+val);
                                del_cookie('ad');
                            }else{
                                $('#showselect').css("display","block");
                                $("#neg1").css("display","none");
                                $("#neg2").css("display","block");
                                $("#pos").css("display","none");
                                $("#icon").css("display","none");
                                $("#sel_icon").css("display","none");
                                $('#showcount').html("");
                                del_cookie('ad');
                            }
                
                        },
                        error: function(){
                            //var html="<ul id='neg'><li>unexpected error try again</li>";
                            $('#showselect').css("display","block");
                            $("#neg1").css("display","block");
                            $("#neg2").css("display","none");
                            $("#pos").css("display","none");
                            $("#icon").css("display","none");
                            $("#sel_icon").css("display","none");
                            $('#showcount').html("");
                            $('#neg_li').html("unexpected error try again");
                            del_cookie('ad');
                        }// End success
                    }); // End ajax method 
    
                }
                
                function setCookie(name, value, seconds)
                {
                    //                    var exdate=new Date();
                    //                    exdate.setDate(exdate.getTime()+(30*1000));
                    //                    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
                    //                    document.cookie=c_name + "=" + c_value;
                    if (typeof(seconds) != 'undefined') {
                        var date = new Date();
                        date.setTime(date.getTime() + (seconds*2300));
                        var expires = "; expires=" + date.toGMTString();
                    }
                    else {
                        var expires = "";
                    }
 
                    document.cookie = name+"="+value+expires+"; path=/";
                }
                function getCookie(c_name)
                {
                    var c_value = document.cookie;
                    var c_start = c_value.indexOf(" " + c_name + "=");
                    if (c_start == -1)
                    {
                        c_start = c_value.indexOf(c_name + "=");
                    }
                    if (c_start == -1)
                    {
                        c_value = null;
                    }
                    else
                    {
                        c_start = c_value.indexOf("=", c_start) + 1;
                        var c_end = c_value.indexOf(";", c_start);
                        if (c_end == -1)
                        {
                            c_end = c_value.length;
                        }
                        c_value = unescape(c_value.substring(c_start,c_end));
                    }
                    return c_value;
                }
                
                function del_cookie(name) {
                    document.cookie = name +'=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
                } 
                
   
            </script>
    </body>
</html>
