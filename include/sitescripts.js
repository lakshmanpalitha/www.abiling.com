var path="http://localhost/www.panoraadvartising.com/include";
$(document).ready(function(){
    
    
    //    $("#cuntry").change(function(){
    //        var coun = $(this).val(); 
    //        var url=path+"/load.php?key=gState&id="+coun;
    //        $.ajax({
    //           
    //            type: "POST",
    //            url:url,
    //            dataType: "json",
    //            success: function(json) {
    //                
    //                var val=json.result.state.length;
    //                var html=false;
    //                html="<option value=''>-Select State-</option>";
    //                for(var i=0; i<val; i++)
    //                {
    //                    html=html+"<option value='"+json.result.state[i].id+"'>"+json.result.state[i].name+"</option>";
    //                         
    //                         
    //                }
    //                $("#sta").css("background-image","none");    
    //                $('#sta').html(html);
    //                 
    //            },
    //            error: function(xhr, textStatus, errorThrown){
    //                alert('request failed');
    //            }
    //         
    //
    //        });
    //        
    //    
    //    });
    //    
    
    //    $("#sta").change(function(){
    //        var sta = $(this).val();
    //        var url=path+"/load.php?key=gDis&id="+sta;
    //        $.ajax({
    //           
    //            type: "POST",
    //            url:url,
    //            dataType: "json",
    //            success: function(json) {
    //                
    //                var val=json.result.district.length;
    //                var html=false;
    //                
    //                for(var i=0; i<val; i++)
    //                {
    //                    html=html+"<option value='"+json.result.district[i].id+"'>"+json.result.district[i].name+"</option>";
    //                         
    //                         
    //                }
    //                html=html+"<option value='0'>-Other-</option>";
    //                $('#dis').html(html);
    //                 
    //            },
    //            error: function(xhr, textStatus, errorThrown){
    //                var html="<option value='0'>-Other-</option>";
    //                $('#dis').html(html);
    //            }
    //         
    //
    //        });
    //    });

    if ($("#collapseOne").length > 0 || $(".accordion").length > 0 ){
	
        $(".coun").click(function () {
            var servicesCheckboxes = new Array(); 
            var adsid;
      
            $("#collapseOne input:checked").each(function () {
                //console.log($(this).val()); //works fine
                var n=$(this).val().split("/"); 
                servicesCheckboxes.push(n[0]);
                adsid=n[1];
            });
        
            var myURL=path+"/load.php?key=gMulStats&adsid="+adsid;
            $.ajax({    
                type: "post",
                url: myURL,
                dataType: "json",
                data: {
                    'query' : servicesCheckboxes
                },
                success: function(request) {
                    var html="<div class='widget-content'>";
                
                    var val=request.result.state.length;
                    for(var i=0; i<val; i++)
                    {
                        var selected=false;
                        if(request.result.state[i].isin==1){
                            selected="checked='checked'";
                        }
                    
                        html=html+"<label><input "+(selected?selected:'')+"  class='pro' name='pro[]'  value='"+request.result.state[i].id+'/'+adsid+"' type='checkbox' /> "+request.result.state[i].name+" </label>";     
                         
                    }
                    html=html+"</div>";
                    $('#collapseTwo').html(html);
                } // End success
            }); // End ajax method
   
        });

    }
        
    if ($(".widget-content").length > 0 || $(".accordion").length > 0){
        
        $(".widget-content .accordion").delegate(".pro", "click", function() {
            var nservicesCheckboxes = new Array(); 
            var adsid;
      
            $("#collapseTwo input:checked").each(function () {
                //console.log($(this).val()); //works fine
                var n=$(this).val().split("/"); 
                nservicesCheckboxes.push(n[0]);
                adsid=n[1];
            });
        
            var myURL=path+"/load.php?key=gMulDis&adsid="+adsid;
            $.ajax({    
                type: "post",
                url: myURL,
                dataType: "json",
                data: {
                    'query' : nservicesCheckboxes
                },
                success: function(request) {
                    var html="<div class='widget-content'>";
                    if(request){
                  
                        var val=request.result.district.length;
                        for(var i=0; i<val; i++)
                        {
                            var selected=false;
                            if(request.result.district[i].isin==1){
                                selected="checked='checked'";
                            }
                    
                            html=html+"<label><input "+(selected?selected:'')+" value='"+request.result.district[i].id+"' type='checkbox'  name='dis[]' /> "+request.result.district[i].name+" </label>";     
                         
                        }
                    }
                    html=html+"</div>";
                    $('#collapseFore').html(html);
                
                
                } // End success
            }); // End ajax method
        });    
    }
    
    
});

function getConfirmation(){
    var retVal = confirm("Are sure you want to delete?");
    if( retVal == true ){
      
        return true;
    }else{
        return false;
    }
}        
                     
