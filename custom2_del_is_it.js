$(document).ready(function(){
	    
		    $(document).ajaxStart(function(){
		    	alert("ree");
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });


//return false;
	
	
	$("#group").change(function(){
	alert("groupd change");

	show_year_list();
	show_test_modes();

    });

	$("#year").change(function(){
    alert("year2");
	//show_stream_list();
	
    });

	$("#stream").change(function(){
		//alert("streamchangedfunction");
		validate_stream_dropdown();
		
	});
	
	

		$("#program_name").change(function(){
		//alert("streamchangedfunction");
		validate_program_name_dropdown();
		
	});
	
	
		$("#mode").change(function(){
		show_model_year_list();
		
	});
	
	

	function validate_stream_dropdown()
	{ alert("std");
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
				 else
				 {
					 show_program_name_list();
				 }

	 }
	 
	 
	 function validate_program_name_dropdown()
	 {
		 
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
																	 else
																	 {
																		 //show_program_name_list();
																	 }
								   
								   
					
		 //if valid
		 
	 }
});