
$(document).ready(function(){
	    $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
	show_group_list();	
});

function isInViewport(element){
  if(element.offsetTop<window.innerHeight && 
       element.offsetTop>-element.offsetHeight
     && element.offsetLeft>-element.offsetWidth
     && element.offsetLeft<window.innerWidth){
      return true;
    } else {
      
      return false;
    }
}


$("#time").click(function(){ 
	show_setter_college();

});

function show_setter_college()
{
//alert("calling");
   	var show_setter_college="yes";
	$.ajax({ url:"ajax_php.php",
	         data:{show_setter_college:show_setter_college},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				 //alert(data);
				$("#setter_college").html(data);
				//enable_year();
				
			 }
		
	      });

}
function show_evaluator_college()
{
//alert("calling");
   	var show_evaluator_college="yes";
	$.ajax({ url:"ajax_php.php",
	         data:{show_evaluator_college:show_evaluator_college},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				 //alert(data);
				$("#evaluator_college").html(data);
				//enable_year();
				
			 }
		
	      });

}


function get_paper_setter_names()
{
  //alert("inside");

  var setter_college_id=$(".setter_college").val();

  var s=setter_college_id.length;
  if(s>=5)
  {
     alert("You Cannot Choose More than 5 College for the Paper Setter's College.... \nBecause Employee's Loading Takes more time.. \nContact Application Admin for any Issue or Changes"); return false;
  }

  //alert(setter_college_id);
  var get_paper_setter_names="yes";

  $.ajax({
            url:"ajax_php.php",
            data:{get_paper_setter_names:get_paper_setter_names,setter_college_id:setter_college_id},
            type:"POST",
            success:function(data)
            {
            	data=data.trim();
            	//alert(data);
            	$("#paper_setter").html(data);
            	
            }


       });

}


function get_paper_evaluator_names()
{
  //alert("eva called");
  var evaluator_college_id=$(".evaluator_college").val();

  var e=evaluator_college_id.length;
  if(e>=5)
  {
     alert("You Cannot Choose More than 5 College for the Paper Evaluator's College.... \nBecause Employee's Loading Takes more time.. \nContact Application Admin for any Issue or Changes"); return false;
  }
 // alert(evaluator_college_id);
  var get_paper_evaluator_names="yes";

  $.ajax({
            url:"ajax_php.php",
            data:{get_paper_evaluator_names:get_paper_evaluator_names,evaluator_college_id:evaluator_college_id},
            type:"POST",
            success:function(data)
            {
            	data=data.trim();
            	//alert(data);
            	$("#paper_evaluator").html(data);
            }


       });

}

function showstates()
{
	var showstates="yes";
	$.ajax({ 
            url:"ajax_php.php",
            data:{showstates:showstates},
            type:"POST",
            success:function(data)
            {
            	data=data.trim();
            	//alert(data);
            	$("#states").html(data);
            }

	      });
}




function show_group_list()
{

	//alert("show group list calling");
	var show_group_list="yes";
	$.ajax({ url:"ajax_php.php",
	         data:{show_group_list:show_group_list},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				// alert(data);
				//alert("show group data response");
				$("#group").html(data);
				//enable_year();
				
			 }
		
	      });
}


/////////////////////////////campus names/////////////////////////////////////////////////

function show_campusnames()
{
	var campusnames=$(".campus.").val();

	$.ajax({
		url:"ajax_php.php",
		type:"POST",
		success:function(data)
		{
			alert(data);
			data=data.trim();
			 $('#Campus').find('option').remove().end().append(data);

		}

	});
}


//////////////////////////campus names///////////////////////////////////////////////////









function show_test_modes()
{
	//alert("show test modes fun calling");
	var group_id=$(".group").val();

	var show_test_modes="yes";
	$.ajax({ url:"ajax_php.php",
	         data:{show_test_modes:show_test_modes,group_id:group_id},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				//alert("show test mode response");
				$("#mode").html(data);
				$("#test_code").val("");
			 }
		
	      });
} 




function test_code_details()
{

	//alert("get test code details fun");
	var group_id=$(".group").val();
	var mode=$("#sel_mode").val();
	var class_id=$(".year").val();
	var SCHEDULED_PROGRAM_ID=$('.main_program').val();
	//var program_name=$(".main_program").val();

	var program_name=$(".main_program").find(':selected').text();
	var program_id=$(".program_name").val();


	//console.log(program_name);
	var stream=$(".stream").val();	
	var test_type=$("#test_type").val();
	//var program_length=program_name.length;
	
	var start_date=$("#start_date").val(); //end date is date for .dat/.iit to upload before.. 
	var last_date_to_upload=$("#last_date_to_upload").val();
	var stream_length=stream.length;
	var test_codes="yes";

            $.ajax({ url:"http://103.206.115.37/ipe/public/api/ip-name",
	         data:{
				test_codes:test_codes,
				start_date:start_date,
				last_date_to_upload:last_date_to_upload,
				group_id:group_id,
				mode:mode,
				class_id:class_id,
				stream:stream,
				test_type:test_type,
				program_name:program_name,
				program_id:program_id,
				SCHEDULED_PROGRAM_ID:SCHEDULED_PROGRAM_ID
				},
			 type:"POST",
			 success:function(data)
			 {	if(data){
				 $('#test_code').val(data);			 	
			 
				console.log(data);
				var test_code=data;
	            $("#test_code").attr("readonly", false);
	        	}
	        	else{
	        	$("#test_code").attr("readonly", false);
	        	$("#test_code").attr("placeholder", "Enter your Test code here");
	        	}
	        		 
			 }

		
	      });
	


	
}




function show_year_list()
{
	//alert("year function calling");
	
	var group_id=$(".group").val();
	//alert(group_id);
	var show_year_list="yes";
	$.ajax({ url:"ajax_php.php",
	         data:{show_year_list:show_year_list,group_id:group_id},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				
				//alert("show year fun response");
				$("#year").html(data);
				$("#test_code").val("");
				$('#test_type').val("selected");
				//$("#test_type").val($("#test_type option:first").val());
			 }
		
	      });
}

function show_stream_list()
{

	//alert("show stream function called");
	var group_id=$(".group").val();
	var class_id=$(".year").val();
	
	var show_stream_list="yes";
	$.ajax({ url:"ajax_php.php",
	         data:{show_stream_list:show_stream_list,group_id:group_id,class_id:class_id},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				// alert("stream");
				 
				$("#stream").html(data);
				
			 }
		
	      });
}

function show_program_name_list()
{
	    var group_id=$(".group").val();
        var class_year = $(".year").val(); //Its in Array
		var stream_label_array=[];
		var stream_input_error_display_array=[];
		

           var temp;
		   var stream_program_name_list_array=[];
		   
		   $.each(class_year, function(index, value) 
		           { 
                    
						 temp=$(".stream_option_"+value+":selected").map(function()
						       { 
						          return this.value 
							   }).get().join(", ");	   
							   
						stream_program_name_list_array.push(temp); 
				   });
				   
				   class_year_length=class_year.length;
				   //alert(class_year_length);
				   
				   stream_program_name_list_array_length=stream_program_name_list_array.length;
				   //alert(stream_program_name_list_array_length);
				   
				   if(class_year_length !=stream_program_name_list_array_length)
				   {
					   alert("Refresh the Page and Choose the Data Correctly...!!");
					   return false;
				   }
				   

	var show_program_name_list="yes";
	$.ajax({ url:"ajax_php.php",
	         data:{show_program_name_list:show_program_name_list,group_id:group_id,class_year:class_year,stream_program_name_list_array:stream_program_name_list_array},
			 type:"POST",
			 success:function(data)
			 {//succ
				 data=data.trim();
				//alert(data);
				//alert("show program");
				$("#program_name").html(data);
				//$("#main").html(data);
      
					    var show_program_name_list2="yes"; var two="two";
						$.ajax({ url:"ajax_php.php",
						         data:{show_program_name_list2:show_program_name_list2,group_id:group_id,class_year:class_year,stream_program_name_list_array:stream_program_name_list_array},
								 type:"POST",
								 success:function(data)
								 {
									 data=data.trim();
									//alert(data);
									//alert("show program");
									//$("#program_name").html(data);
									$("#main").html(data);



					                        



								 }
							
						      });

                        



			 }//succ
		
	      });
	
}




function show_model_year_list()
{
	
	var test_mode_id=$("#sel_mode").val();
	var show_model_year_list="yes";
		$.ajax({ url:"ajax_php.php",
	         data:{show_model_year_list:show_model_year_list,test_mode_id:test_mode_id},
			 type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				//alert(data);
				$("#paper_model_year").html(data);
			 }
		
	      });
	
}




$("#mode").change(function(){
	/*
	$('input[name="paper"]').prop('checked', false);
	var mode=$("#mode").val();
	
	if(mode=="IIT")
	{
		$(".iit_group").removeClass("hidden");
	}
	else
	{
	  $(".iit_group").addClass("hidden");	
	}
	*/
});

$("#create_exam_button").click(function(){
	
	
	//DO INPUT VALIDATION...ITS PENDING=====>Done
	
	
	
	var group_id=$(".group").val(); //not array
	if(group_id=="") 
	{ alert("Group is Blank");  return false;
	
	}

	// var syllabus_id=$("#syllabus_id").val(); 
	// if(syllabus_id=="") 
	// { alert("Select Syllabus");  return false;
	
	// }




//alert(syllabus_id);


	
	 //return false;
   //var class_year_id_array=[];
	var class_year_id_array=$(".year").val(); //array

	if(class_year_id_array==null) 
	{ alert("Class Year Id is Blank");  return false;
	
	}
    
	
	
	 //STREAM LIST FETCH START
	 
	 var stream=$(".stream").val();
	 if(stream==null) 
	{ alert("Stream is Blank");  return false;
	
	}
	 
	 

	       var temp;
		   var stream_program_name_list_array=[];
		   
		   $.each(class_year_id_array, function(index, value) 
		           { 
                    
						 temp=$(".stream_option_"+value+":selected").map(function()
						       { 
						          return this.value 
							   }).get().join(", ");	   
							   
						stream_program_name_list_array.push(temp); 
				   });
				
				
				
				//validate_stream_dropdown();
	//STREAM LIST FETCH ENDS			   

	
	//VALIDATE STREAM COPIED FROM AJAXPHP STARTS
	
	       var class_year = $(".year").val(); //Its in Array
		var stream_label_array=[];
		var stream_input_error_display_array=[];
		
		$('.stream_label').each(function()
		{   //;
			stream_label_array.push( $(this).attr('label'));
		});
		
		//alert(stream_label_array);
		
		
		
		
		$.each(class_year, function(index, value) 
		           { 
                       var count=0;
								   $('.stream_dropdown_'+value+' option').each(function()
								   {
										if($(this).is(':selected'))
										{
											//alert("selected");
											count++;
										}
										else
										{
											//alert("not selected");
										}
								   
								   
								   //alert(index + ': ' + value);
							      });
				   
				         if(count==0)
						 {
							//$string="Minimum One Stream for the Below Class needs to be Selected";
							//$string=String+"\n You S"stream_label_array[0];
							stream_input_error_display_array.push(stream_label_array[index]) 
						 }
                   });
				 var length_error=stream_input_error_display_array.length;
				 var d_string="";
				 if(length_error>0)
				 {
					 $.each(stream_input_error_display_array, function(index, value)
					 {
						 d_string=d_string+value+"\n";
					 });
					 alert("Minimum One Stream for the Below Class needs to be Selected \n"+d_string+"\nElse Remove the above Class in Year Filter..!!");
					 
					 return false;
				 }
	
	
	
	
	
	//VALIDATE STREAM COPIED FROM AJAXPHP ENDS
	
	
	
	
	
	//Below Program name
	
		 var program_name=$(".program_name").val();
	 if(program_name==null) 
	{ alert("Program Name is Blank");  return false;
	
	}
	
    var scheduled_program_id=$(".main_program").val();
	 if(scheduled_program_id==null) 
	{ alert("Scheduled Program name should be selected");  return false;
	
	}



	

						var program_label_array=[];
						var program_input_error_display_array=[];
						
						$('.program_label').each(function()
						{   //;
							program_label_array.push( $(this).attr('label'));
						});
						
						
						

									var loop_length=program_label_array.length;
								//alert(loop_length);	
								   
								   var start=1;
								   for(start=1;start<=loop_length;start++)
								   {
									   
									    var count=0;
														   $('.program_dropdown_'+start+' option').each(function()
														   {
															  // alert(individual_stream_id);
																if($(this).is(':selected'))
																{
																	//alert("selected");
																	count++;
																}
																else
																{
																	//alert("not selected");
																}
														   
														   
														   //alert(index + ': ' + value);
														  }); 
										   
															 if(count==0)
															 {
																//$string="Minimum One Stream for the Below Class needs to be Selected";
																//$string=String+"\n You S"stream_label_array[0];
																program_input_error_display_array.push(program_label_array[start-1]); 
															 }
															 		  
									   
								   }
								   
								   
									var temp;
									var program_name_list_array=[];
		   
		   
								   for(start=1;start<=loop_length;start++)
								   {
									   						 temp=$(".program_option_"+start+":selected").map(function()
																   { 
																	  return this.value 
																   }).get().join(", ");	   
																   
															program_name_list_array.push(temp); 
									   
									   
								   }
				// alert(program_name_list_array);
				 
				 
	   //VALIDATE PROGRAM COPIED FROM AJAXPHP STARTS
	                     var class_year=$(".year").val(); //array
						var program_label_array=[];
						var program_input_error_display_array=[];
						
						$('.program_label').each(function()
						{   //;
							program_label_array.push( $(this).attr('label'));
						});
							//STREAM LIST FETCH START
						   var temp;
						   var stream_program_name_list_array=[];
								   $.each(class_year, function(index, value) 
								   { 
									
										 temp=$(".stream_option_"+value+":selected").map(function()
											   { 
												  return this.value 
											   }).get().join(", ");	   
											   
										stream_program_name_list_array.push(temp); 
								   });
								   
							var loop_length=program_label_array.length;
								//alert(loop_length);	
								   
								   var start=1;
								   for(start=1;start<=loop_length;start++)
								   {
									   
									    var count=0;
														   $('.program_dropdown_'+start+' option').each(function()
														   {
															  // alert(individual_stream_id);
																if($(this).is(':selected'))
																{
																	//alert("selected");
																	count++;
																}
																else
																{
																	//alert("not selected");
																}
														   
														   
														   //alert(index + ': ' + value);
														  }); 
										   
															 if(count==0)
															 {
																//$string="Minimum One Stream for the Below Class needs to be Selected";
																//$string=String+"\n You S"stream_label_array[0];
																program_input_error_display_array.push(program_label_array[start-1]); 
															 }
															 		  
									   
								   }
								   
								   									 var length_error=program_input_error_display_array.length;
																	 var d_string="";
																	 if(length_error>0)
																	 {
																		 $.each(program_input_error_display_array, function(index, value)
																		 {
																			 d_string=d_string+value+"\n";
																		 });
																		 alert("Minimum One Program for the Below Stream needs to be Selected \n"+d_string+"\nElse Remove the above Stream in Stream Filter..!!");
																		 
																		 return false;
																	 }
	
	  //VALIDATE PROGRAM COPIED FROM AJAXPHP ENDS
	
//alert(stream_program_name_list_array);
//alert(program_name_list_array);

//console.log(stream_program_name_list_array);
//console.log(program_name_list_array);
			
				   
	

	//
var mode=$("#sel_mode").val();
     


     if(mode==3)
     {


  	 //alert("iiii");
  	var paper_model_year_id=$("#paper_model_year_id").val();

  	if(paper_model_year_id==null)
  	{
  		alert("Select Model Year"); return false;
  	}

    var len= paper_model_year_id.length;
    
    if(len !=2)
    {
    	alert("Choose Both the Model Paper 1 and Paper 2");
    	return false;
    }


    var first= paper_model_year_id[0];
    var second=paper_model_year_id[1];

   //alert(first); alert(second);

   var a=first.slice(-1); 
   var b=second.slice(-1);

   if((a!="1") || (b!="2"))
   {
        alert("Choose only One Model Paper from Paper 1 and One Paper from Paper 2 "); return false;
   }


  }
	






	
	var test_type=$("#test_type").val();
	
	//alert(test_type); return false;
	if(test_type=="selected")
	{ alert("Select Test Type");
		return false;
	}
	
	var test_mode_id=$("#sel_mode").val();
	//alert(test_mode);
		if(test_mode_id=="")
	{ alert("Select Test Mode");
		return false;
	}
	
	//var test_code=$("#test_code").val();
	  //change array for iit p1 / and p11 p2...
	var paper_model_year=$("#paper_model_year_id").val();
	//alert(paper_model_year);
			if(paper_model_year=="")
	{ alert("Select Test Model Year");
		return false;
	}
	
	
	
	var start_date=$("#start_date").val(); //end date is date for .dat/.iit to upload before.. 
	var last_date_to_upload=$("#last_date_to_upload").val();
	var time=$("#time").val();
	var test_code=$("#test_code").val();
	if(((start_date=="") || (last_date_to_upload=="") || (time=="") ))
	{
		alert("Dates and Time Should be properly Inserted"); return false;
	}
	if(test_code=="")
	{
		alert("Test Code Cannot be Blank"); return false;
	}
	
	//alert(start_date+last_date_to_upload);
	if(last_date_to_upload !="")
	{
	  	if(start_date>=last_date_to_upload)
	{
		alert("Date to upload .DAT/.iit should be after Exam creation Date"); return false;
	}	
	}


	//  var setter_college=$(".setter_college").val();
	//  if(setter_college==null) 
	// { alert("Select the College of the Paper Setter and Choose the Paper Setter Name");  return false;

 //    }

 //    var paper_setter=$(".paper_setter").val();
	//  if(paper_setter==null) 
	// { alert("Select the Paper Setter from the Drop Down List");  return false;

 //    }

  //VALIDATE SETTER COLLEGE DROP DOWN=> PAPER SETTER CHOOSING  (COPIED FROM AJAX_PHP)=> STARTS



  //  var setter_college=$(".setter_college").val();
  //       var paper_setter_label_array=[];
		// var paper_setter_input_error_display_array=[];

		// $('.paper_setter_label').each(function()
		// {   //;
		// 	paper_setter_label_array.push( $(this).attr('label'));
		// });

         		
		
		// $.each(setter_college, function(index, value) 
		//            { 
  //                      var count=0;
		// 						   $('.paper_setter_dropdown_'+value+' option').each(function()
		// 						   {
		// 								if($(this).is(':selected'))
		// 								{
		// 									//alert("selected");
		// 									count++;
		// 								}
		// 								else
		// 								{
		// 									//alert("not selected");
		// 								}
								   
								   
		// 						   //alert(index + ': ' + value);
		// 					      });
				   
		// 		         if(count==0)
		// 				 {
		// 					//$string="Minimum One Stream for the Below Class needs to be Selected";
		// 					//$string=String+"\n You S"stream_label_array[0];
		// 					paper_setter_input_error_display_array.push(paper_setter_label_array[index]) 
		// 				 }
  //                  });
		// 		 var length_error=paper_setter_input_error_display_array.length;
		// 		 var d_string="";
		// 		 if(length_error>0)
		// 		 {
		// 			 $.each(paper_setter_input_error_display_array, function(index, value)
		// 			 {
		// 				 d_string=d_string+value+"\n";
		// 			 });
		// 			 alert("Minimum One Paper Setter for the Below College needs to be Selected \n"+d_string+"\nElse Remove the above College in Colleger Filter..!!");
					 
		// 			 return false;
		// 		 }
		// 		 else
		// 		 {
		// 			// show_program_name_list();
		// 			//show_evaluator_college();
		// 		 }


   //VALIDATE SETTER COLLEGE DROP DOWN=> PAPER SETTER CHOOSING (COPIED FROM AJAX_PHP)=> ENDS


	//  var evaluator_college=$(".evaluator_college").val();
	//  if(evaluator_college==null) 
	// { alert("Select the College of the Paper Evaluator and Choose the Paper Evaluator Name");  return false;

 //    }

 //    var paper_evaluator=$(".paper_evaluator").val();
	//  if(paper_evaluator==null) 
	// { alert("Select the Paper Evaluator from the Drop Down List");  return false;

 //    }


  //VALIDATE EVALUATOR COLLEGE DROP DOWN=> PAPER EVALUATOR CHOOSING (COPIED FROM AJAX_PHP)=> STARTS

  // var evaluator_college=$(".evaluator_college").val();
  //       var paper_evaluator_label_array=[];
		// var paper_evaluator_input_error_display_array=[];

		// $('.paper_evaluator_label').each(function()
		// {   //;
		// 	paper_evaluator_label_array.push( $(this).attr('label'));
		// });

         		
		
		// $.each(evaluator_college, function(index, value) 
		//            { 
  //                      var count=0;
		// 						   $('.paper_evaluator_dropdown_'+value+' option').each(function()
		// 						   {
		// 								if($(this).is(':selected'))
		// 								{
		// 									//alert("selected");
		// 									count++;
		// 								}
		// 								else
		// 								{
		// 									//alert("not selected");
		// 								}
								   
								   
		// 						   //alert(index + ': ' + value);
		// 					      });
				   
		// 		         if(count==0)
		// 				 {
		// 					//$string="Minimum One Stream for the Below Class needs to be Selected";
		// 					//$string=String+"\n You S"stream_label_array[0];
		// 					paper_evaluator_input_error_display_array.push(paper_evaluator_label_array[index]) 
		// 				 }
  //                  });
		// 		 var length_error=paper_evaluator_input_error_display_array.length;
		// 		 var d_string="";
		// 		 if(length_error>0)
		// 		 {
		// 			 $.each(paper_evaluator_input_error_display_array, function(index, value)
		// 			 {
		// 				 d_string=d_string+value+"\n";
		// 			 });
		// 			 alert("Minimum One Paper Evaluator for the Below College needs to be Selected \n"+d_string+"\nElse Remove the above College in Colleger Filter..!!");
					 
		// 			 return false;
		// 		 }
		// 		 else
		// 		 {
		// 			// show_program_name_list();
		// 			//show_evaluator_college();
		// 		 }





   //VALIDATE EVALUATOR COLLEGE DROP DOWN=> PAPER EVALUATOR CHOOSING (COPIED FROM AJAX_PHP)=> ENDS



	//        var temp;
	// 	   var paper_setter_array=[];
		   
	// 	   $.each(setter_college, function(index, value) 
	// 	           { 
                    
	// 					 temp=$(".paper_setter_option_"+value+":selected").map(function()
	// 					       { 
	// 					          return this.value 
	// 						   }).get().join(", ");	   
							   
	// 					paper_setter_array.push(temp); 
	// 			   });




	// 	   var temp;
	// 	   var paper_evaluator_array=[];
		   
	// 	   $.each(evaluator_college, function(index, value) 
	// 	           { 
                    
	// 					 temp=$(".paper_evaluator_option_"+value+":selected").map(function()
	// 					       { 
	// 					          return this.value 
	// 						   }).get().join(", ");	   
							   
	// 					paper_evaluator_array.push(temp); 
	// 			   });



	// var state=$(".state").val(); //array

	// if(state==null) 
	// { alert("Select All the States whose Colleges are eligible to write this exam");  return false;
	
	// }

	
    // var paper_setter_array=$(".paper_setter").val();
    // var paper_evaluator_array=$(".paper_evaluator").val();

	//return false;
	var insert_create_exam="yes";
	var Board='23';
	var sp=$('.main_program').val();

	var User=$('#User').val();
	$.ajax({
		      url:"http://103.206.115.37/ipe/public/api/ip-create",
			   data:{insert_create_exam:insert_create_exam,Group_Id:group_id,
			   	Classyear_Id:class_year_id_array,Stream_Id:stream_program_name_list_array,
			   	Program_Id:program_name_list_array,Test_type_id:test_type,test_mode_id:test_mode_id,
			   	paper_model_year:paper_model_year,Date_exam:start_date,End_Date:start_date,last_date_to_upload:last_date_to_upload,
			   	time:time,Exam_name:test_code,Program_Id:program_name,Board:Board,User:User,update:"0",SCHEDULED_PROGRAM_ID:sp,},
			  type:"POST",
			  success:function(data)
			  {
			  	if(data){
			  	alert("Exam Created Successfully");
			  			}
				  // data=data.trim();
				  // // alert(data); return false;
				  // if(data=="Test_code_already_exist")
				  // {
					 // check_blank_each_select_input_colour();
					 // display_alert("danger","Test Code Already Exist","5000"); //Type (danger-success,Content,time) 
				  // }
				  // else
					 //  if(data=="added_successfully")
					 //  {
						//  check_blank_each_select_input_colour();
						//  display_alert("success","Entered Test Added Successfully... !!","2000"); 
						//  setTimeout(function(){  window.location.href=""; }, 3000);
						
					 //  }
					 //  else
					 //  	if(data=="ajax_error")
					 //  	{
      //                       alert("There was an error occured during the process.. Please try again.. or contact application admin");
					 //  		return false;
					 //  	}
			  }
		
		
	      });
});

function display_alert(type,content,time)
{
	if(type=="danger")
	{
		$("#danger_alert").removeClass("hidden");
		$("#danger_alert_content").html(content);
		setTimeout(function(){ $("#danger_alert").addClass("hidden"); }, time);
	}
		if(type=="success")
	{
		$("#success_alert").removeClass("hidden");
		$("#success_alert_content").html(content);
		setTimeout(function(){ $("#success_alert").addClass("hidden"); }, time);
	}
	  
}

function check_blank_each_select_input_colour()
{
			$("select,input").each(function(){
			var current_value=$(this).val();
			if(current_value=="")
			{  $(this).css("border-color","red");
		       $(this).append("<br><b>Required</b>");
			   $(this).append( "<strong>Hello</strong>" );
		      
			   $(this).css("background-color","red");		     
			   setTimeout(function(){ $(this).css("background-color","white"); }.bind(this), 300);
		    } 
		       
		    else {$(this).css("border-color","#E3E3E3");}
		});
}

