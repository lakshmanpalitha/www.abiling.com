jQuery(document).ready(function($) {



    //registration form birthday jpicker
    if ($(".datepicker").length > 0){
    //$('.datepicker').datepicker();
    }
	
    // Add validation to form
    if ($("#user_registration_form").length > 0){
        $("#user_registration_form").validationEngine();
    }
	
    if ($("#vehiclelead").length > 0){
        $("#vehiclelead").validationEngine();
    }
	
	
	
    if ($("#login_form").length > 0){
        $("#login_form").validationEngine();
    }
	
	
	
    //Apply main banner animation
    if ($("#slider").length > 0){
        $('#slider').after('<div id="nav">').cycle({ 
            fx:     'fade', 
            speed:  'fast', 
            timeout: 3000, 
            pager:  '#nav' 
        });
    }
	
	
    // Script for accodion
    if ($(".accordion").length > 0){
        var allPanels = $('.accordion > dd').hide();

        $('.accordion > dt > a').click(function() {
            $this = $(this);
            $target =  $this.parent().next();

            if(!$target.hasClass('active')){
                allPanels.removeClass('active').slideUp();
                $target.addClass('active').slideDown();
            }
      
            return false;
	
        });
    }

    if ($(".sub_block").length > 0){
        $(function() {
            $( "#from" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                numberOfMonths: 3,
                onClose: function( selectedDate ) {
                    $( "#to" ).datepicker( "option", "minDate", selectedDate );
                }
            });
            $( "#to" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                dateFormat: 'yy-mm-dd',
                numberOfMonths: 3,
                onClose: function( selectedDate ) {
                    $( "#from" ).datepicker( "option", "maxDate", selectedDate );
                }
            });
        });
		
		
    }


    //Script for adding Filea feald for add submit box
    var counter = 2;

    $("#addButton").click(function () {
 
        if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
        }   
 
        var newTextBoxDiv = $(document.createElement('div'))
        .attr("id", 'TextBoxDiv' + counter).addClass("TextBoxDiv");
 
        newTextBoxDiv.after().html('<label>File #'+ counter + ' : </label>' +
            '<input name="file[]" type="file" id="textbox' + counter + '" value="" >');
 
        newTextBoxDiv.appendTo("#TextBoxesGroup");
 
 
        counter++;
    });
 
    $("#removeButton").click(function () {
        if(counter==1){
            alert("No more textbox to remove");
            return false;
        }   
 
        counter--;
 
        $("#TextBoxDiv" + counter).remove();
 
    });
 
    $("#getButtonValue").click(function () {
 
        var msg = '';
        for(i=1; i<counter; i++){
            msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
        }
        alert(msg);
    });

    //close documant ready

    //if country all check
   
});

//If special display time required
$("#spnp").delegate("#np", "click", function() {
 
    if($('#np').is(':checked')){
            
       
        $('.datepicker').attr('disabled','disabled');
    }else{
        
      
        $('.datepicker').attr('disabled',false); 
    }
 
});

$("#spf_t").delegate("#np", "click", function() {
 
    if($('#np').is(':checked')){
            
       
        $('.datepicker').attr('disabled','disabled');
    }else{
        
      
        $('.datepicker').attr('disabled',false); 
    }
 
});


$(".ad_type").click(function () {
    if($(this).val()==1){
        document.getElementById("url").style.display = "block";
        document.getElementById("info").style.display = "none";  
    }else if($(this).val()==2){
        document.getElementById("info").style.display = "block";  
        document.getElementById("url").style.display = "none";
    }
	
});

$("#coun_all").click(function () {
    if($('#coun_all').is(':checked')){
        //$('.coun').parent("span").addClass("checked");
        $('.coun').attr('checked',false).attr('disabled','disabled').parent("span").removeClass("checked");

    }else{
        $('.coun').attr('checked',false).attr('disabled',false).parent("span").removeClass("checked");
    }
 
});

$("#pro_all").click(function () {
 
    if($('#pro_all').is(':checked')){
            
        $('.pro').attr('checked',false).attr('disabled','disabled');
    }else{
        
        $('.pro').attr('checked',false).attr('disabled',false); 
    }
 
});

$("#dis_all").click(function () {
 
    if($('#dis_all').is(':checked')){
            
        $('.dis').attr('checked',false).attr('disabled','disabled');
    }else{
        
        $('.dis').attr('checked',false).attr('disabled',false); 
    }
 
});

$("#job_all").click(function () {
 
    if($('#job_all').is(':checked')){
            
        $('.job').attr('checked',false).attr('disabled','disabled');
    }else{
        
        $('.job').attr('checked',false).attr('disabled',false); 
    }
 
});