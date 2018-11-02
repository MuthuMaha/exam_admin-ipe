

$(document).ready(function(){
	    $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
	
	localStorage.setItem("inc_reset_status","initial");
	localStorage.setItem("show_limit","0");
	var show_limit=0;
	list("http://103.206.115.37/ipe/public/api/ip-view",show_limit);




		  

	
});



function more()
{

	
	var show_limit=localStorage.getItem("show_limit");
	show_limit=( +show_limit+10);
	localStorage.setItem("show_limit",show_limit);
    list(show_limit);

}


	
	function list(url,show_limit)
	{//alert("ll");
		    var get_all_created_exam_list="yes"; 
		    var table="";
	$.ajax({
		      url:url,
			  data:{get_all_created_exam_list:get_all_created_exam_list,show_limit:show_limit},
			  type:"POST",
			  success:function(data)
			  {
				  // data=data.trim();
				  // alert(data);
		

table+='<div class="content table-responsive">';
table+='<table  class="table table-striped table-bordered table-list KKK" id="tab1" ><thead  style="background-color:#335533; color:white; ">';
     table+='<th style="width: 2%;text-align:center;">Sl</th><th>Date_exam</th><th style="width: 12%;">Exam_name</th>';
      table+='<th>End_Date</th><th>last_date_to_upload</th><th>Test_type_id</th><th>Board</th><th>Edit</th>';
      table+='</thead><tbody>';   
          $.each(data.data, function(index, value) {  
table+='<tr><td>'+value.exam_id+'</td><td  class="Prc">'+value.Date_exam+'</td><td>'+value.Exam_name+'</td>';
table+='<td>'+value.End_Date+'</td><td>'+value.last_date_to_upload+'</td><td>'+value.Test_type_id+'</td>';
table+='<td>'+value.Board+'</td><td><a href="#" onclick="call('+value.exam_id+')"><i class="fa fa-pencil-square-o"></i></a></td></td><tr>';

          });       

                table+='</tbody></table>';    
                 var paginate='';
            paginate+="<ul class='pagination'>";
                paginate+="<li><a href='#' onclick='list(\""+data.first_page_url+"\",0);'><<</a></li>";
                paginate+="<li ><a onclick='list(\""+data.prev_page_url+"\",0)'><</a></li>";
                paginate+="<li ><a onclick='list(\""+data.next_page_url+"\",0)'>></a></li>";
                paginate+="<li><a href='#' onclick='list(\""+data.last_page_url+"\",0)'>>></a></li>";
            paginate+="</ul>";
                  $('.pagination').html(paginate);              
				  $("#display_all_created_exam_list").html(table);
				  applyEdit("tab1", [1, 2, 3, 4,5,6]);
			  }
		
	      });
	}

	function call1(exam_id){
		// alert(exam_id);
		document.getElementById('exam_id').value=exam_id;
		  var get_all_created_exam_list="yes"; 
		    var table="";
	$.ajax({
		      url:"http://103.206.115.37/ipe/public/api/edit_exam_details",
			  data:{id:exam_id},
			  type:"GET",
			  success:function(data)
			  {
			  $('#display_merged_details').modal('show');

table+='<div class="content table-responsive">';
table+='<table  class="table table-striped table-bordered table-list"><thead>';
table+='<th style="width: 2%;text-align:center;">Test_Code</th><th style="width: 2%;text-align:center;">GROUP_NAME</th><th>CLASS_NAME</th><th style="width: 12%;">STREAM_NAME</th><th>PROGRAM_NAME</th>';
table+='<th style="width:80px;">Action</th></thead><tbody>';   
          $.each(data, function(index, value) {  

table+='<tr><td>'+value.Exam_name+'</td><td>'+value.GROUP_NAME+'</td><td>'+value.CLASS_NAME+'</td><td>'+value.STREAM_NAME+'</td>';
table+='<td>'+value.PROGRAM_NAME+'</td>';
table+='<td><a href="#" class="btn-lg" onclick="deletes('+exam_id+',\''+value.action+'\')"><i class="fa fa-trash"></i></a></td></td><tr>';

          });  
table+='</tbody></table><br><hr style="border-top: 2px solid #52c7eb;">';
          $('#display_contents_merged').html(table);     
			  }
		
	      });
	}
	function deletes(exam_id,url){
		// alert(url)
		$.ajax({
                 url:url,
                 type:"DELETE",
                 success:function(data)
                 {
                 	// alert(data);
                 	call1(exam_id);
                 }


		      });
	}
	function edit_date_time_of_sl(sl)
	{ 

		var date=$("#dt").val();
		var time=$("#tm").val();
        if((dt=="") || (tm==""))
        {

        	alert("Insert Proper Date and Time Format"); return false;
        }
        var edit_date_time_of_sl="yes";
		$.ajax({
                 url:"ajax_php1.php",
                 data:{edit_date_time_of_sl:edit_date_time_of_sl,sl:sl,date:date,time:time},
                 type:"POST",
                 success:function(data)
                 {
                 	data=data.trim();
                 	if(data=="updated")
                 	{
                 		alert("Last Date & Time for Uploading .dat/.iit Updated Successfully");
                 		view_status_info_modal_of_sl(sl);
                 	}
                 	   else  if(data=="ajax_error")
			              {
			               alert("There was an error occured during the process.. Please try again.. or contact application admin");
			               view_status_info_modal_of_sl(sl);
			                return false;
			              }


                 }


		      });
	}

function add_edit_imk_modal_of_sl(sl)
{
	//alert(sl);
	localStorage.setItem("inc_reset_status","final");
	var open_add_edit_imk_modal_of_sl="yes";
	$.ajax({
		     url:"ajax_php1.php",
			 data:{open_add_edit_imk_modal_of_sl:open_add_edit_imk_modal_of_sl,sl:sl},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				 //alert(data);
				 $("#imk_modal_id").html(data);
				 $("#imk_modal_id").modal('show');
				 
				 
			 }
		
		
	      });
	
}

function create(){
	var group=$('.group').val();
	var year=$('.year').val();
	var stream=$('.stream').val();
	var program_name=$('.program_name').val();
	var exam_id=$('#exam_id').val();
            $.ajax({ 
            	url:"http://103.206.115.37/ipe/public/api/ip-create",
		        data:{
		        	Group_Id:group,
				   	Classyear_Id:year,
				   	Stream_Id:stream,
				   	Program_Id:program_name,
				   	exam_id:exam_id,
				   	update:"1"

				   },
			  type:"POST",

			 success:function(data)
			 {	
			 call1(exam_id); 
			 }

		
	      });
	}

var inc=1;
function bring_this_down(id,total_subject)
{
 //alert(inc);
     var cur=localStorage.getItem("inc_reset_status");//alert(cur);
	 //alert("inc="+inc+"cur="+cur);
		 if(cur=="final")
		 { //alert("here");
			  inc=1;
			 localStorage.setItem("inc_reset_status","initial");
		 }
		 
	 
	
	
	if(inc==(total_subject-1))
	{
		var this_html=$("#button"+id).html();
		$("#button"+id).val("yes");
		$("#button"+id).hide();
		$("#sub"+inc).html(this_html);
		
		
		
		var x=$('button[value="no"]').attr('id');
		
		//alert(x);
		
	    inc++;
		this_html=$("#"+x).html();
		
		$("#"+x).hide();
		$("#sub"+inc).html(this_html);
		
		$(".left,.right").removeAttr('disabled');
		$(".left,.right").css("background","white");
		
		$("#store").removeClass('hidden');
		
		$("#start1").val(1);
		
		$(".left").prop("disabled", true);
		$(".left").css("background","#efd6d6");
		
	    return false; 
	 
	}
	var this_html=$("#button"+id).html();
	$("#button"+id).val("yes");
	$("#button"+id).hide();
	$("#sub"+inc).html(this_html);
	 inc++;
	
}

function track_college_uploads_of_sl(sl)
{
	//alert("going");
		var track_college_uploads_of_sl="yes";
	$.ajax({
		     url:"ajax_php1.php",
			 data:{track_college_uploads_of_sl:track_college_uploads_of_sl,sl:sl},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				 //alert(data);
				 $("#imk_modal_id").html(data);
				 $("#imk_modal_id").modal('show');
				 
				 
				 						                         
				 
				 
				 
			 }
		
		
	      });
}

function view_status_info_modal_of_sl(sl)
{
	//alert(sl);
	var view_status_info_modal_of_sl="yes";
	$.ajax({
		     url:"ajax_php1.php",
			 data:{view_status_info_modal_of_sl:view_status_info_modal_of_sl,sl:sl},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				// alert(data);
				 $("#imk_modal_id").html(data);
				 $("#imk_modal_id").modal('show');
				 
				 
			 }
		
		
	      });
	
}

function delete_all_branches_result_of_sl(sl)
{
	//alert(sl);
	
	if (!confirm("Are You Sure you want to Delete All the Branches Marks and Result Generated of this Test ? \n All Branches Should Upload the .DAT/.IIT once again and should regenerate the Result Later \n Also Proceeding will delete all the Exam and Results which are Associated and Merged with this Exam(Advanced Exam).. i.e Exam Admin should again merge two exams in that case."))
	{
		return false;
	}
	var delete_all_branches_result_of_sl="yes";
	$.ajax({
		    url:"ajax_php1.php",
			data:{delete_all_branches_result_of_sl:delete_all_branches_result_of_sl,sl:sl},
			type:"POST",
			success:function(data)
			{
				data=data.trim();
				alert(data);
				if(data=="deleted_success")
				{
					alert("All Branches Marks and Results Deleted Successfully");
					view_status_info_modal_of_sl(sl);
				}
                 if(data=="ajax_error")
              {
                 alert("There was an error occured during the process.. Please try again.. or contact application admin");
                 view_status_info_modal_of_sl(sl);
                 return false;
              }




			}
		
	      })

}
// BELOW ARE JQUERY FOR ADVANCED THINGS


function add_edit_imk_modal_of_sl_advanced(sl)
{
	//alert(sl);

	var open_add_edit_imk_modal_of_sl_advanced="yes";
	$.ajax({
		     url:"ajax_php1.php",
			 data:{open_add_edit_imk_modal_of_sl_advanced:open_add_edit_imk_modal_of_sl_advanced,sl:sl},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				 //alert(data);
				 //alert("again");
				 $("#imk_modal_id").html(data);
				 $("#imk_modal_id").modal('show');
				 
				 
			 }
		
		
	      });
	
}
function save_ias_key_of_sl(sl,total_question)
{	//alert("sl->"+sl+"qu->"+total_question);
 
    //FLUSH BACKGROUND COLOR AS WHITE AT EACH START
	 $(".inpclass").each(function(){
		$(this).css("background","white"); 
	 });
	
	//

    
	var input_range_error_flag=0;
	var input_range_error_flag_array=[];
	
	var input_blank_error_flag=0;
	var input_blank_error_flag_array=[];
	

	var invalid_OR_format_error_flag=0;
	var invalid_OR_format_error_flag_array=[];



	
	var ias_array=[];
    for(i=1;i<=total_question;i++)
	{
		var this_val=$("#ias"+i).val();
		var current_val=this_val;
		
		
	    var get_this_class=$("#ias"+i).attr('custom');
		//alert(get_this_class);
		
		if(this_val==""){input_blank_error_flag++; input_blank_error_flag_array.push(i); }
		
		if((get_this_class=="s") || (get_this_class=="cs")|| (get_this_class=="ms"))
		{
           var first_three = current_val.substring(0, 3);
		    if(first_three=="OR-") 
		    {
               var newarray = current_val.split("-");
            //lert(newarray);
             var eligible = ["A","B","C","D","OR"];
             var invalid_flag=0;
             jQuery.each( newarray, function( k, val ) 
                  {
                     var a=jQuery.inArray( val, eligible );
                     if(a==-1)
                     {
                     	//invalid_flag++;
                     	 invalid_OR_format_error_flag++;
                     	 invalid_OR_format_error_flag_array.push(i);

                     }
                 
			      });

		       
		     }          
           else
               if((current_val=="") ||(current_val=="A") || (current_val=="B") || 
               	(current_val=="C") || (current_val=="D") || (current_val=="X") || (current_val=="G"))
               {}
			else {input_range_error_flag++; input_range_error_flag_array.push(i);}
	
		}
		else
	    if(get_this_class=="i")
		{

             var first_three = current_val.substring(0, 3);
		    if(first_three=="OR-") 
		    {
               var newarray = current_val.split("-");
            //lert(newarray);
             var eligible = ["0","1","2","3","4","5","6","7","8","9","OR"];
             var invalid_flag=0;
             jQuery.each( newarray, function( k, val ) 
                  {
                     var a=jQuery.inArray( val, eligible );
                     if(a==-1)
                     {
                     	 invalid_OR_format_error_flag++;
                     	 invalid_OR_format_error_flag_array.push(i);
                     }
                 
			      });

		    
		     }          
           else
               if((current_val=="") ||(current_val=="0") || (current_val=="1") || 
               	(current_val=="2") || (current_val=="3") || (current_val=="4") || (current_val=="5") ||
               	(current_val=="6") || (current_val=="7") ||
               	(current_val=="8") || (current_val=="9") ||
               	(current_val=="X") || (current_val=="G"))
               {}
			else {input_range_error_flag++; input_range_error_flag_array.push(i);}
	
	
		}
		else
		if((get_this_class=="m") || (get_this_class=="cm"))
		{
            var first_three = current_val.substring(0, 3);
		    if(first_three=="OR-") 
		    {
               var newarray = current_val.split("-");
            //lert(newarray);
             var eligible = ["A","B","C","D","AB","AC","AD","ABC","ABD","ACD","ABCD","BC","BD","BCD","CD","OR"];
             var invalid_flag=0;
             jQuery.each( newarray, function( k, val ) 
                  {
                     var a=jQuery.inArray( val, eligible );
                     if(a==-1)
                     {
                     	 invalid_OR_format_error_flag++;
                     	 invalid_OR_format_error_flag_array.push(i);
                     }
                 
			      });

		    
		     }          
           else
               if((current_val=="") ||(current_val=="A") || (current_val=="B") || 
               	(current_val=="C") || (current_val=="D") || (current_val=="AB") || (current_val=="AC") ||
               	(current_val=="AD") || (current_val=="ABC") ||
               	(current_val=="ABD") || (current_val=="ACD") ||
               	(current_val=="ABCD") || (current_val=="BC") ||
               	(current_val=="BD") || (current_val=="BCD") ||
               	(current_val=="CD") ||(current_val=="X") || (current_val=="G"))
               {}
			else {input_range_error_flag++; input_range_error_flag_array.push(i);}

	
		}
		  
		else
			 if(get_this_class=="mb")
		{

             var first_three = current_val.substring(0, 3);
		    if(first_three=="OR-") 
		    {
               var newarray = current_val.split("-");
            //lert(newarray);
             var eligible = ["P","PQ","PR","PS","PT","PQR","PQS","PQT","PRS","PRT","PST","PQRS","PQRT","PQST","PQRST",
             ,"Q","QR","QS","QT","QRS","QRT","QST","QRST","R","RS","RT","RST","S","ST","T","OR"];
             var invalid_flag=0;
             jQuery.each( newarray, function( k, val ) 
                  {
                     var a=jQuery.inArray( val, eligible );
                     if(a==-1)
                     {
                     	 invalid_OR_format_error_flag++;
                     	 invalid_OR_format_error_flag_array.push(i);
                     }
                 
			      });

		    
		     }          
           else
               if((current_val=="") ||(current_val=="P") || (current_val=="PQ") || 
               	(current_val=="PR") || (current_val=="PS") || (current_val=="PT") || (current_val=="PQR") ||
               	(current_val=="PQS") || (current_val=="PQT") ||
               	(current_val=="PRS") || (current_val=="PRT") ||
               	(current_val=="PST") || (current_val=="PQRS") ||
               	(current_val=="PQRT") || (current_val=="PQST") ||
               	(current_val=="PQRST") || (current_val=="Q") ||
               	(current_val=="QR") || (current_val=="QS") ||
               	(current_val=="QT") || (current_val=="QRS") ||
               	(current_val=="QRT") || (current_val=="QST") ||
               	(current_val=="QRST") || (current_val=="R") ||
               	(current_val=="RS") || (current_val=="RT") ||
               	(current_val=="RST") || (current_val=="S") ||
               	(current_val=="ST") || (current_val=="T") ||        

               	(current_val=="X") || (current_val=="G"))
               {}
			else {input_range_error_flag++; input_range_error_flag_array.push(i);}

	
		}
	
	 
			 ias_array.push(this_val);

	}		
		//alert(ias_array);
				if(invalid_OR_format_error_flag>0)
		{
			for(c1=0;c1<=invalid_OR_format_error_flag;c1++)
			{
				var this_input_id=invalid_OR_format_error_flag_array[c1];
				$("#ias"+this_input_id).css("background","#ffcb55");
			}
		}


		
		if(input_blank_error_flag>0)
		{
			for(c1=0;c1<=input_blank_error_flag;c1++)
			{
				var this_input_id=input_blank_error_flag_array[c1];
				$("#ias"+this_input_id).css("background","#efd6d6");
			}
		}
		
		
		if(input_range_error_flag>0)
		{
			for(c1=0;c1<=input_range_error_flag;c1++)
			{
				var this_input_id=input_range_error_flag_array[c1];
				$("#ias"+this_input_id).css("background","red");
			}
		}
		
		if(invalid_OR_format_error_flag>0)
		{   alert("Invalid \"OR\" Option Format... !!");
			return false;
		}


		if((input_blank_error_flag>0) && (input_range_error_flag>0))
		{   alert("\"Pink\" fields should not be empty... And \"Red\" Fields Values are mismatching to the question type");
			return false;
		}
		if((input_blank_error_flag>0) && (input_range_error_flag==0))
		{   alert("\"Pink\" fields should not be empty");
			return false;
		}
		if((input_blank_error_flag==0) && (input_range_error_flag>0))
		{   alert("\"Red\" Fields Values are mismatching to the question type");
			return false;
		}
			

	//alert("here");
	var save_ias_key_of_sl="yes";
		$.ajax({
		    url:"ajax_php1.php",
			data:{save_ias_key_of_sl:save_ias_key_of_sl,sl:sl,ias_array:ias_array},
			type:"POST",
			success:function(data)
			{
				data=data.trim();
				//alert(data);
				//return false;
				if(data=="Added")
				{
					alert(".ias Key Added Successfully");
					add_edit_imk_modal_of_sl_advanced(sl);
				}
				else if(data=="Updated")
				{
					alert(".ias Key Updated Successfully");
					add_edit_imk_modal_of_sl_advanced(sl);
				}
				else
					if(data=="same_value")
					{
						alert("Didnt Update Key File... Because its same as the last one");
						return false;
					}
				else
	                 if(data=="ajax_error")
              {
                            alert("There was an error occured during the process.. Please try again.. or contact application admin");
                return false;
              }


				
				//add_edit_imk_modal_of_sl(sl);
				//$("#key_answer_div").html(data);
			}
		
		
	      });
}


function generate_rank_of_sl_open_div(sl)
{

  var generate_rank_of_sl_open_div="yes";
  $.ajax({
           url:"ajax_php1.php",
           data:{generate_rank_of_sl_open_div:generate_rank_of_sl_open_div,sl:sl},
           type:"POST",
           success:function(data)
           {
           	data=data.trim();
	           //alert(data); return false;
                 var res = data.substring(0, 5);
                 if(res=="split")
                 {
                 	 var res2 = data.split("split"); //alert(res2[1]);
alert("After Rank Generation You have given permission to colleges to Re Upload the .dat/.iit...\nBelow are the Campus whose uploading are pending:\n"+res2[1]+"\nStill if you want to Generate the Rank Leaving those Campus, then delete their name by Clicking R Icon...!!"); return false;

                 }
	       
	           if(data=="result_already_generated")
	           {
	           	alert("Result is Already Generated for this Test"); return false;
	           }

	           if(data=="no_branch_uploaded_yet")
	           {
	           	 alert("No Branch have uploaded the .DAT/.IIT Files yet \n You cant generate the result now");return false;
	           }
	           $("#upload_divv").html(data);
	           $("#upload_divv").removeClass('hidden');
	           $("#opacity_divv").removeClass('hidden');
	           return false;
           }
           



       });


}






function generate_final_rank_of_sl(sl,subject_count,omr_scanning_type)
{



if ($("input[name=radio_type]").is(':checked'))
{

}
else
{
	alert("Select One of the Rank Generation Type\n1: Type 1: Ranks Will Be Allotted According to Subject Priority (for Same Total)\n2: Type 2: Same Rank will Be Allotted According to Same Total ");
    return false;
}




if ($("input[name=rank_type]").is(':checked'))
{

}
else
{
	alert("Select One of the Rank Generation Algorithm\n1: Type 1: Skip Ranking (1-1-3)\n2: Type 2: Continuous Ranking (1-1-2) ");
    return false;
}









var type= $("input[name='radio_type']:checked").val();
var rank_type=$("input[name='rank_type']:checked").val();

//alert(rank_type);
//return false;

if(type=="subject_priority")
{

    var left=$("#keep-order").val(); 
	var len=left.length; 

	if(len <subject_count)
	{
		alert("Select all the Subject name with highest priority first"); return false;
	}

}
if(type=="same_rank")
{

	
}

//alert(type); // return false;
//BELOw when all selected
var priority_wise_subject_name_array=[];
$('.ms-selection .ms-list li span').each(function()
	{ var this_sub= $(this).html(); 
		priority_wise_subject_name_array.push(this_sub);
	});
    //alert("after");

	//alert(priority_wise_subject_name_array);

	var rank_generation="yes";
	var option="start";
    progress_move_start(option);
	$.ajax({
             url:"rank_generation.php",
             data:{rank_generation:rank_generation,sl:sl,priority_wise_subject_name_array:priority_wise_subject_name_array,type:type,omr_scanning_type:omr_scanning_type,rank_type:rank_type},
             type:"POST",
             success:function(data)
             {
             	data=data.trim();

             	//alert("Alerting rank gen fun");
             	//alert(data); //return false;
             	//console.log(data);
             	//return false;
                //return false;


             	if(data=="rank_already_generated")
             	{
                    alert("Rank of this test is already been Generated");
             		return false;
             	}
             	  if(data=="all_result_generated")
             	{  var option="finish";
             		progress_move_start(option);
             	}
             	
             	return false;
             	  if(omr_scanning_type=="anon_advanced")
                {
                   alert("All Ranking of this Test is Generated");
                   //window.location.href="";
                	return false;
                }
             //	if(data=="all_result_generated")
             	{  var option="finish";
             		progress_move_start(option);
             	}





             }

	      });

}





function progress_move_start(option)
{
    var section = document.getElementById("section"); 
    var stream = document.getElementById("stream"); 
    var program = document.getElementById("program"); 
    var campus = document.getElementById("campus"); 
    var city = document.getElementById("city"); 
    var district = document.getElementById("district"); 
    var country = document.getElementById("country"); 
	if(option=="finish")
	{
		var interval_id=localStorage.getItem("interval_id");
        clearInterval(interval_id);
        var final_stopped=$("#section").html();
        final_stopped = final_stopped.slice(0, -1);
        final_stopped=Math.ceil(final_stopped);

        var diff_to_hundred=(100-final_stopped);
        var div3=diff_to_hundred/3;
        div3=Math.ceil(div3);

        var stop_id = setInterval(stop, 1000);
        var width=0;
            function stop()
            {
                      if(width>=100)
			            {
			              clearInterval(stop_id);
                          alert("All Ranking of this Test is Generated");
                          window.location.href="";
			              return false;
			            }


                width = +width + div3;

                if(width>=100) width=100;
                section.style.width = width + '%'; 
                section.innerHTML = width * 1 + '%';

                stream.style.width = (width) + '%'; 
                stream.innerHTML = (width) * 1 + '%';

                program.style.width = (width) + '%'; 
                program.innerHTML = (width) * 1 + '%';

                campus.style.width = (width) + '%'; 
                campus.innerHTML = (width) * 1 + '%';

                city.style.width = (width) + '%'; 
                city.innerHTML = (width) * 1 + '%';

                district.style.width = (width) + '%'; 
                district.innerHTML = (width) * 1 + '%';

                state.style.width = (width) + '%'; 
                state.innerHTML = (width) * 1 + '%';

                country.style.width = (width) + '%'; 
                country.innerHTML = (width) * 1 + '%';


            }
     

        
		 

         
      return false;
	}





    var width = 7;
    var streamid = setInterval(frame, 1000);
    localStorage.setItem("interval_id",streamid);
    function frame() 
    {
        if (width >= 100) {
            clearInterval(streamid);
        } else {
            width++; 

              if( (+width>=80) && (+width<90)) 
              {
                width = +width + 0.5;
                section.style.width = width + '%'; 
                section.innerHTML = width * 1 + '%';

                stream.style.width = (width-1) + '%'; 
                stream.innerHTML = (width-1) * 1 + '%';

                program.style.width = (width-2) + '%'; 
                program.innerHTML = (width-2) * 1 + '%';

                campus.style.width = (width-3) + '%'; 
                campus.innerHTML = (width-3) * 1 + '%';

                city.style.width = (width-4) + '%'; 
                city.innerHTML = (width-4) * 1 + '%';

                district.style.width = (width-5) + '%'; 
                district.innerHTML = (width-5) * 1 + '%';

                state.style.width = (width-6) + '%'; 
                state.innerHTML = (width-6) * 1 + '%';

                country.style.width = (width-7) + '%'; 
                country.innerHTML = (width-7) * 1 + '%';

              }
              else
              	if(+width >=90)
              	{

              	}
             else
             {
             	section.style.width = width + '%'; 
                section.innerHTML = width * 1 + '%';

                stream.style.width = (width-1) + '%'; 
                stream.innerHTML = (width-1) * 1 + '%';

                program.style.width = (width-2) + '%'; 
                program.innerHTML = (width-2) * 1 + '%';

                campus.style.width = (width-3) + '%'; 
                campus.innerHTML = (width-3) * 1 + '%';

                city.style.width = (width-4) + '%'; 
                city.innerHTML = (width-4) * 1 + '%';

                district.style.width = (width-5) + '%'; 
                district.innerHTML = (width-5) * 1 + '%';

                state.style.width = (width-6) + '%'; 
                state.innerHTML = (width-6) * 1 + '%';

                country.style.width = (width-7) + '%'; 
                country.innerHTML = (width-7) * 1 + '%';                
             } 
               }
    }



}









function close_this_div()

{
window.location.href="";
 return false;
}

function delete_all_approval_of_sl(sl)
{
	if (!confirm("Are You Sure you want to Delete All the Students awaiting Approval for this Test ?"))
	{
		return false;
	}
	
	var delete_all_approval_of_sl="yes";
    	$.ajax({
             url:"ajax_php1.php",
             data:{delete_all_approval_of_sl:delete_all_approval_of_sl,sl:sl},
             type:"POST",
             success:function(data)
             {
             	data=data.trim();
             	//alert(data);
             	if(data=="delete_success")
             	{
             		generate_rank_of_sl_open_div(sl);
             	}
             }

	      });


}



function city_changed_of_sl(sl)
{

$("#reset_all").click();
var city_id=$("#city_id").val();


	$("#college_id").val("all");

college_changed_of_sl(sl);
}

function college_changed_of_sl(sl)
{
	$("#reset_all").click();
var city_id=$("#city_id").val();
var college_id=$("#college_id").val();

// generate_rank_of_sl_open_div(sl);


//return false;
var get_approval_filtered_only_content="yes";
   $.ajax({
             url:"ajax_php1.php",
             data:{get_approval_filtered_only_content:get_approval_filtered_only_content,sl:sl,city_id:city_id,college_id:college_id},
             type:"POST",
             success:function(data)
             {
             	data=data.trim();
             //alert(data);
              if(data=="All_Deleted")
              {
                 generate_rank_of_sl_open_div(sl);
                 return false;

              }

             $("#inner_display").html(data);
             }
             
             

         })
}

function approve_delete(sl)
{
  var this_campus_id=$("#college_id").val();
 // alert(this_campus_id);
     var approve_selected=$(".approve:checked").map(function()
		 { 
			 return this.value 
		 }).get().join(",");	 

      var delete_selected=$(".delete:checked").map(function()
		 { 
			 return this.value 
		 }).get().join(",");	


if((approve_selected=="") && (delete_selected==""))
{
	alert("Select The Students USN and Valid Options"); return false;
}

    var approve_delete="yes";
    $.ajax({
             url:"ajax_php1.php",
             data:{approve_delete:approve_delete,sl:sl,approve_selected:approve_selected,delete_selected:delete_selected,this_campus_id:this_campus_id},
             type:"POST",
             success:function(data)
             {
             	data=data.trim();
             	//alert(data); return false;
             	//console.log(data);
             	if(data=="done")
             	{
                    alert("Successfully Approved/Deleted Selected USN");
                   // display_result_of_sl(sl)
                   college_changed_of_sl(sl);
             		return false;
             	}
               if(data=="ajax_error")
              {
                            alert("There was an error occured during the process.. Please try again.. or contact application admin");
                            college_changed_of_sl(sl);
                return false;
              }




             }

         });

	
}


function display_all(stream,test_code)
{

	var res = stream.split("( ");
	console.log(test_code);
       
  
      var myTable= "<table class='table table-hover  table-bordered' ><tr><th >Sl No</td><th>Test Code</th>";
    myTable+= "<th >Class-Stream-Program Name</td>";
    
  for (var i=0; i<res.length; i++) {
  	  if(res[i]!="")
  	  {
    myTable+="<tr><td >"+i+"</td>";
    myTable+="<td>"+test_code+"</td>";
    myTable+="<td >" + res[i] + "</td></tr>";
   }
  }  
   myTable+="</table>";
   $("#display_contents").html(myTable);
	$("#display_all_details").modal('show');
}


function display_merged(stream)
{
	var sl_array=stream.split(",");
	
	var display_merged_msg="yes";
	$.ajax({
             url:"ajax_php1.php",
             data:{display_merged_msg:display_merged_msg,sl_array:sl_array},
             type:"POST",
             success:function(data)
             {
             	 
             	 $("#display_contents_merged").html(data);
             	 $("#display_merged_details").modal('show');
             }

         });
}

function display_exams(stream)
{
	var sl_exam=stream;
	
	var display_exam_msg="yes";
	$.ajax({
             url:"ajax_php1.php",
             data:{display_exam_msg:display_exam_msg,sl_exam:sl_exam},
             type:"POST",
             success:function(data)
             {
             	 //console.log(data);
             	 $("#display_exams").html(data);
             	 $("#exams").modal('show');
             }

         });
}



function change_group(){
   var group=$( "#group" ).val();
   var display_class="yes";
   $('#add_exam_details').prop("disabled", true); 
   $.ajax({
             url:"ajax_php1.php",
             data:{display_class:display_class,group:group},
             type:"POST",
             success:function(data)
             {
             	 
             	 $(".class").html(data);
             }

         });
}

function change_class(){
   var group=$( "#group" ).val();
   var class_id=$( "#class" ).val();
   var display_stream="yes";
   $('#add_exam_details').prop("disabled", true); 
   $.ajax({
             url:"ajax_php1.php",
             data:{display_stream:display_stream,group:group,class_id:class_id},
             type:"POST",
             success:function(data)
             {
             	
             	 $(".stream").html(data);
             }

         });
}

function change_stream(){
   var group=$( "#group" ).val();
   var class_id=$( "#class" ).val();
   var stream=$( "#stream" ).val();
   var display_program="yes";
   $('#add_exam_details').prop("disabled", true); 

   $.ajax({
             url:"ajax_php1.php",
             data:{display_program:display_program,group:group,class_id:class_id,stream:stream},
             type:"POST",
             success:function(data)
             {
             	
             	 $(".program").html(data);
             	 
             }

         });
}

function change_program(){



     	$('#add_exam_details').prop("disabled", false); 
}


function add_states(stream)
{
	 var states=$( ".states" ).val();

	//console.log(states);
       var add_states="yes";
	$('#add_states').prop("disabled", true); 

   $.ajax({
             url:"ajax_php1.php",
             data:{add_states:add_states,states:states,stream:stream},
             type:"POST",
             success:function(data)
             {
             	//alert(data);
                  //console.log(data);
             	  display_exams(stream);
             	 $('#add_states').prop("disabled", false); 
             	 
             }

         });
}



function add_details(stream)
{
	var sl=stream; 
	var group=$( "#group" ).val();
	var program=$( "#program" ).val();
	var stream=$( "#stream" ).val();
	var class_id=$( "#class" ).val();
	console.log()
	var add_details="yes";
	$.ajax({
             url:"ajax_php1.php",
             data:{add_details:add_details,sl:sl,group:group,program:program,stream:stream,class_id:class_id},
             type:"POST",
             success:function(data)
             {
             	
             	if(data=="Duplicate") 
             	{
             		alert("Cannot Add Duplicate Exam Details");
             	}
             	else if(data=="added_success") 
             	{
             	  alert ("Exam Details added Successfully");
             	   display_exams(sl)	
             	}
             	else
             	{
             		alert("Error !! The Selected Options cant be added");
             	}
             	
             }

         });
}

function delete_exam(stream,sl)
{
	var exam_id=sl;
	console.log(exam_id);
	var sl=stream;
	var delete_exams="yes";
	 //confirm("Sure! you want to delete this row?");
	 if (confirm('Are you Sure! You want to delete this exam?')) {
       $.ajax({
             url:"ajax_php1.php",
             data:{delete_exams:delete_exams,sl:sl},
             type:"POST",
             success:function(data)
             {
             	
             	 display_exams(exam_id)
             }

         });
    }
}


function show_approve_status_of(sl,college_id)
{


	//alert(sl); alert(college_id);

	var show_approve_status_of="yes";
	$.ajax({
              url:"ajax_php1.php",
              data:{show_approve_status_of:show_approve_status_of,sl:sl,college_id:college_id},
             type:"POST",
             success:function(data)
             {
             	 
             	data=data.trim();
             	//alert(data);
             	$("#approval_status").html(data);
             	$("#approval_status").modal('show');
             }
           

	      });
}

function reprocess_modal_of_sl(sl)
{

	//alert(sl);

	var open_reprocess_modal_of_sl="yes";
	$.ajax({
              url:"ajax_php1.php",
              data:{open_reprocess_modal_of_sl:open_reprocess_modal_of_sl,sl:sl},
              type:"POST",
              success:function(data)
               {
               	data=data.trim();
               //	alert(data);
                 if(data=="result_not_generated"){ alert("Error.. Result is Not yet generated... You cannot Send for Re Upload");}
               	$("#recompute").html(data);
               	$("#recompute").modal('show');
               
                 college_id(sl);

               }

	      })
}

function college_id(sl)
{
	var college_id=$("#college_id").val();
	//alert(college_id);
//alert(sl); return false;
    var get_campuses_down="yes";

	$.ajax({
              url:"ajax_php1.php",
              data:{get_campuses_down:get_campuses_down,college_id:college_id,sl:sl},
              type:"POST",
              success:function(data)
              {
              	data=data.trim();
              	alert(data);
              	$("#append").html(data);
              //	alert(data);
              }


	     });
}

function del_campus_req(sl_auto,sl)
{
	if(!confirm("Are You Sure You want to delete this College ?"))
	{
      return false;
	}

	var del_campus_req="yes";
	 $.ajax({
              url:"ajax_php1.php",
              data:{del_campus_req:del_campus_req,sl_auto:sl_auto},
              type:"POST",
              success:function(data)
              {
              	data=data.trim();
              	//alert(data);
              	if(data=="deleted_success")
              	{   alert("The Selected College deleted Successfully...");
                    reprocess_modal_of_sl(sl); return false;
              	}

                 if(data=="ajax_error")
              {
                alert("There was an error occured during the process.. Please try again.. or contact application admin");
                return false;
              }




              }

	       });
}
