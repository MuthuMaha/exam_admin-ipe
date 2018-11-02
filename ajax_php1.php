<?php
include_once '../../secure_login/includes/functions.php';
sec_session_start();
if($_SESSION['is_exam_admin']==false)
{
    Header('Location:../../secure_login/'); 
}
require("../000_main_includes/config.php");
require("../000_main_includes/common_functions.php");




if(isset($_POST['get_all_created_exam_list']))
{
	get_all_created_exam_list($con);
}
if(isset($_POST['edit_date_time_of_sl']))
{
	edit_date_time_of_sl($con);
}

if(isset($_POST['open_add_edit_imk_modal_of_sl']))
{
	open_add_edit_imk_modal_of_sl($con);
}
if(isset($_POST['open_add_edit_imk_modal_of_sl_advanced']))
{
	open_add_edit_imk_modal_of_sl_advanced($con);
}
if(isset($_POST['generate_rank_of_sl_open_div']))
{
	generate_rank_of_sl_open_div($con);
}


			  
			  
if(isset($_POST['insert_info_file_of_sl']))
{
	insert_info_file_of_sl($con);
}
if(isset($_POST['delete_and_edit_info_and_mark_of_sl']))
{
	delete_and_edit_info_and_mark_of_sl($con);
}

if(isset($_POST['insert_mark_file_of_sl']))
{
	insert_mark_file_of_sl($con);
}
if(isset($_POST['insert_key_answer_file_of_sl']))
{
	insert_key_answer_file_of_sl($con);
}
if(isset($_POST['edit_key_answer_file_of_sl']))
{
	edit_key_answer_file_of_sl($con);
}
if(isset($_POST['delete_all_branches_result_of_sl']))
{
	delete_all_branches_result_of_sl($con);
}
if(isset($_POST['track_college_uploads_of_sl']))
{
	track_college_uploads_of_sl($con);
}
if(isset($_POST['view_status_info_modal_of_sl']))
{
	view_status_info_modal_of_sl($con);
}
if(isset($_POST['delete_all_approval_of_sl']))
{
	delete_all_approval_of_sl($con);
}
if(isset($_POST['show_approve_status_of']))
{
	show_approve_status_of($con);
}



if(isset($_POST['display_merged_msg']))
{
	 
	display_merged_data($con);
	
}

if(isset($_POST['display_exam_msg']))
{
	 
	display_exams_data($con);
	
}

if(isset($_POST['display_states']))
{
	 
	display_states($con);
	
}

if(isset($_POST['display_class']))
{
	 
	display_class($con);
	
}

if(isset($_POST['display_stream']))
{
	 
	display_stream($con);
	
}

if(isset($_POST['display_program']))
{
	 
	display_program($con);
	
}

if(isset($_POST['add_details']))
{
	 
	add_details($con);
	
}
if(isset($_POST['add_states']))
{
	 
	add_states($con);
	
}

if(isset($_POST['delete_exams']))
{
	 
	delete_exams($con);
	
}

if(isset($_POST['open_reprocess_modal_of_sl']))
{
	 
	open_reprocess_modal_of_sl($con);
	
}

if(isset($_POST['get_campuses_down']))
{
	$sl=$_POST['sl'];
	 
	get_campuses_down($con,$sl);
	
}

if(isset($_POST['del_campus_req']))
{
	
	 
	del_campus_req($con);
	
}






/*if(isset($_POST['edit_date_time']))
{
	 
	edit_date_time_of_sl($con);
	
}*/

 /*
	mysqli_autocommit($con,FALSE);
    mysqli_commit($con);
    mysqli_rollback($con);
*/

function get_all_created_exam_list($con) //CRB not required...(small doing=>Checked)
{
	
	echo ' <div class="content table-responsive ">
                                <table class="table table-hover  table-bordered table-break-down" >
                                    <thead>
                                        <!--<th>Test Code</th>-->
                                    	<!--<th>Scanning Type</th>-->
                                    	<th style="width: 3%;text-align:center;"></th>
                                    	 <th style="width: 2%;text-align:center;">Sl</th>
                                      
                                        <th>Exam Date</th>
                                        <th style="width: 12%;">Test Code</th>
                                    	<th>Group</th>
										<th>Class</th>
                                    	<th>Stream</th>
										<th>Program Name</th>
										<th>Test Type</th>
										<th>Mode</th>
										<th>Model Year</th>
										
										
                                        <th>View/Add/Edit(I/M/K)</th>
										<th style="color:red;">Status<br>Info</th>
										
										<th>Track Uploads</th>
                                    	<th style="width:8%;">Gen Ranks</th>
                                        <th colspan=3 style="width:12%;">Downloads</th>
                                        <th style="width:37px;">R</th>
                                        
                                    </thead>
                                    <tbody>';
									$show_limit=$_POST['show_limit'];
									//$res=$con->query("select * from 1_exam_admin_create_exam ORDER BY sl desc LIMIT $show_limit,8"); //S
									$res=$con->query("select sl,omr_scanning_type,result_generated1_no0,test_type,mode,test_code,model_year,state_id,start_date from 1_exam_admin_create_exam ORDER BY sl desc LIMIT $show_limit,10"); 
									

									$show_count=mysqli_num_rows($res);	
									if($show_count==0)
									{
                                       echo '<center><p style="color:red;font-=weight:bold;">No more Results to Show</p></center>';
										exit;
									}

									$class_name_array=array();
									$stream_name_array=array();
									$program_name_array=array();
									$group_name_array=array();

									while($row=mysqli_fetch_array($res))
									{ 
								      $class_name_array=array();
									  $stream_name_array=array();
									  $program_name_array=array();
								      $group_name_array=array();


								       $result_generated1_no0=$row['result_generated1_no0'];
								       $test_sl=$row['sl'];
									   $omr_scanning_type=$row['omr_scanning_type'];
									   $test_type=$row['test_type'];
									   $test_mode=$row['mode'];
									   
								       $res_in=$con->query("select GROUP_ID,STREAM_ID,PROGRAM_ID,CLASS_ID from 1_exam_gcsp_id where test_sl='$test_sl'");
									   $count_ins=mysqli_num_rows($res_in);
									   
								
								      if($count_ins==1)
									  {
										  
										  
									  }
								       while($row_in=mysqli_fetch_array($res_in))
									   {
										  $group_id=$row_in['GROUP_ID'];
										  $stream_id=$row_in['STREAM_ID'];
										  $program_id=$row_in['PROGRAM_ID'];
										  $class_id=$row_in['CLASS_ID'];
										  
										  $res_group=$con->query("select GROUP_NAME from t_course_group where GROUP_ID='$group_id'");
										  $row_group=mysqli_fetch_array($res_group);
										  $group_name_array[]=$group_name=$row_group['GROUP_NAME'];
										  
										  $res_stream=$con->query("select STREAM_NAME from t_stream where STREAM_ID='$stream_id'");
										  $row_stream=mysqli_fetch_array($res_stream);
										  $stream_name_array[]=$stream_name=$row_stream['STREAM_NAME'];
										  
										  $res_program_name=$con->query("select PROGRAM_NAME from t_program_name where PROGRAM_ID='$program_id'");
										  $row_program_name=mysqli_fetch_array($res_program_name);
										  $program_name_array[]=$program_name=$row_program_name['PROGRAM_NAME'];
										  
										  $res_class_name=$con->query("select DISPLAY_NAME from t_study_class where CLASS_ID='$class_id'");
										  $row_class_name=mysqli_fetch_array($res_class_name);
										  $class_name_array[]=$class_name=$row_class_name['DISPLAY_NAME'];
										  
										  //$res_c
										   
										   
									   }
								   
								      //$sl=$row['sl'];
									  //$resa=$con->query("select state_id from 1_exam_admin_create_exam where sl='{$sl}'");
										//$rowa=mysqli_fetch_array($resa);
										$string=$row['state_id'];



										$state_name=array();
										$resb=$con->query("select STATE_NAME from t_state where STATE_ID IN($string)");
										while( $rowb=mysqli_fetch_array($resb))
										{
										$state_name[]=$rowb['STATE_NAME'];
										}

										$state_string=implode(",",$state_name);



                                   


									  
									  $start_date=$row['start_date'];
									  $date_d_m_y = date("d-m-Y", strtotime($start_date));
										
							          echo '  <tr>';
							          if($omr_scanning_type=="merged")
							          {
							          	echo '<td style="padding:0px!important;"></td>';
							          }
							          else
                                    {    echo '<td style="padding:0px!important;"><i class="fa fa-edit pointer" style="font-size:24px" onClick="display_exams('.$row['sl'].')"></i></td>';
                                	}
                                	echo '

							                      
							                    <td > <a href="#" class="tooltip">'.$row['sl'].' <span>
                                                      
                                                       <strong>Exam States</strong><br />'. $state_string . '
                                                        
                                                    </span></td>
                                        	<!--<td>'.$row['test_code'].'</td>-->
											<!--<td>'.$row['omr_scanning_type'].'</td>-->';

                                            if($omr_scanning_type !="merged")
                                            {
                                            	echo '<td>'.$date_d_m_y.'</td>
											          <td>'.$row['test_code'].'</td>';

                                            }
											



											
											$len=sizeof($class_name_array);
											if($len==1)
											{
												if($omr_scanning_type=="merged")
												{
                                                   
                                                    echo '<td></td><td></td><td></td><td></td>';
												}
												else
												{
													echo '<td>'.$group_name_array[0].'</td><td>'.$class_name_array[0].'</td><td>'.$stream_name_array[0].'</td><td>'.$program_name_array[0].'</td>';
												}

												
											}


											else
										    if($len>1)
											{
												$string="";
												$display_two="";
												$it=0;
												
												for($i=0;$i<$len;$i++)
												{   $a=$class_name_array[$i];
													$b=$stream_name_array[$i];
													$c=$program_name_array[$i];
													$d=$group_name_array[$i];
													$string=$string."( (".$d."-".$a."-".$b."-".$c.")"; //CLASS-STREAM-PROGRAMNAME
													if($i==0)
													{  $it++;
														$display_two=$display_two."(".$d."-".$a."-".$b."-".$c.")";
													}
													

												}

//bhargav

                                             if($it>=0)
                                             {
              echo '<td colspan="4">'.$display_two.'<img src="../assets/img/more.png" style=" cursor:pointer;height: 23px;width: 23px;margin-left: 1%;" onClick="display_all(\'' . $string . '\',\''.$row['test_code'].'\')"></td>';
                                             }
                                             else
                                             {
                                             	echo '<td colspan="3">'.$string.'</td>';
                                             }
											



											}
											
											$t=$row['test_type'];
											$res_now1=$con->query("select test_type_name from 0_test_types where test_type_id='$t'");
											$row_now1=mysqli_fetch_array($res_now1);
											$test_type_name=$row_now1['test_type_name'];
											
											$m=$row['mode'];
											$res_now2=$con->query("select test_mode_name from 0_test_modes where test_mode_id='$m'");
											$row_now2=mysqli_fetch_array($res_now2);
											$test_mode_name=$row_now2['test_mode_name'];
											
											
											$paper=$row['paper'];
											if($paper=="")
											{
												$paper=$paper;
											}
											else
											{
												$paper="-".$paper;
											}

		                                         if($omr_scanning_type=="merged")
                                            {


                                            	    $sl_array=array();
													$r2=$con->query("select merged_exam_id from 1_merged_exams where exam_id='$test_sl'");
													while($row22=mysqli_fetch_array($r2))
													{
														$sl_array[]=$row22['merged_exam_id'];
													}
                                                        $sl_string=implode(",",$sl_array);



                                            	echo '<td></td>
                                            	<td>'.$row['test_code'].'</td>

                                            	<td colspan="4" style="font-weight:bold;color:green;">(IIT_P1P2) MERGED EXAM OF SL:  '.$sl_string. '<img src="../assets/img/more.png" style=" cursor:pointer;height: 23px;width: 23px;margin-left: 1%;" onClick="display_merged(\'' . $sl_string . '\')"> </td>';
                                            }

											echo '<td>'.$test_type_name.'</td>
											<td>'.$test_mode_name.'</td>';

                                           if($omr_scanning_type!="merged")
                                            {

											echo '<td>'.$row['model_year'].' '.$paper.'</td>';
											
									       }
									       else
									       {
									       	echo '<td></td><td></td>';
									       }
											
											
                                        
										    if($omr_scanning_type=="non_advanced")
											{
											echo '<td> 
                                           <button type="submit" class="btn btn-info btn-fill" onclick="add_edit_imk_modal_of_sl('.$row['sl'].')" data-toggle="modal" >I-M-K</button></td>';	
											} 
											else
												if($omr_scanning_type=="advanced")
												{
												echo '<td> 
                                           <button type="submit" class="btn btn-info btn-fill" onclick="add_edit_imk_modal_of_sl_advanced('.$row['sl'].')" data-toggle="modal" >I-M-K</button></td>';	
												}
										   

                                               if($omr_scanning_type =="merged")
                                               {

                                                  echo '<td></td><td></td>';
                                               }
                                               else
                                               {
                                               		 echo '<td> 
                                           <button type="submit" class="btn btn-info btn-fill" onclick="view_status_info_modal_of_sl('.$row['sl'].')" data-toggle="modal" >Status</button></td>
										   
										   <td> 
                                           <button type="submit" class="btn btn-info btn-fill" onclick="track_college_uploads_of_sl('.$row['sl'].')" >Track</button></td>';
                                               }







										   
										    echo '<td> 
     <button type="submit" class="btn btn-info btn-fill" onclick="generate_rank_of_sl_open_div('.$row['sl'].')"  >Gen Rank</button></td>';
         					
                        /*if($row['result_generated1_no0']==1)
         					{
                        		echo'<button type="submit" class="btn btn-info btn-fill"  ><a href="pdf_files/generate_pdf.php?exam_identifier='.$row['sl'].'" style="    color: white;" target="_blank">PDF</a></button></td>
                                          <td><button type="submit" class="btn btn-info btn-fill"><a href="pdf_files/generate_excel.php?exam_identifier='.$row['sl'].'" style="    color: white;">EXCEL</a></button>';
                                        	
          					}       
				          else{
				          		echo'<button type="submit" class="btn btn-info btn-fill" disabled >PDF</button></td>
                                          <td><button type="submit" class="btn btn-info btn-fill" disabled>EXCEL</button>';                        	
				               }

				               */




				               $res_recompute=$con->query("select * from 1_exam_recompute_request_campus_id where sl='$test_sl'");
				               $count_recompute=mysqli_num_rows($res_recompute);

                                 if(($row['result_generated1_no0']==1) || ($count_recompute>0))
                       





         									{
			                        		echo'<td><a href="generate-zip/index.php?sl='.$row['sl'].'" style=" color: white;" target="_blank"><img src="../assets/img/zip.png" style="height:30px;width:30px"/></a></td>
													 <td><a href="pdf_files/?exam_identifier='.$row['sl'].'" style="    color: white;" target="_blank"><img src="../assets/img/pdf.png" style="height:30px;width:30px"/></a></td>
			                                          <td><a href="pdf_files/generate_excel.php?exam_identifier='.$row['sl'].'" style="    color: white;" target="_blank"><img src="../assets/img/excel.png" style="height:30px;width:30px"/></a></td>
			                                          <td><img src="../assets/img/r.png" onclick="reprocess_modal_of_sl('.$row['sl'].')" style="height:30px;width:30px;cursor:pointer;"/></a></td>



													  ';
			                                        	
			          					   }       
							          else
			          					   {
							          		echo'<td></td>
			                                          <td></td>
													  <td></td>
													  <td></td>';                        	
							               }

                                            echo'<!--<td><button type="submit" class="btn btn-info btn-fill" onclick="get_value_of_sl('.$row['sl'].')" >Upload</button></td>
                                            <td><button type="submit" class="btn btn-info btn-fill" onclick="display_result_of_sl('.$row['sl'].')" >Result</button></td>-->
                                             </tr>';	
									}
									

										
										
										
										
										
                                       
                                   echo ' </tbody>
                                </table>

                            </div>';
  
	

  
  
	
	exit;
}

function open_add_edit_imk_modal_of_sl($con) //CRB not required.....(small doing=> Checked)
{
	$sl=$_POST['sl'];
	$res=$con->query("select mode,test_code,subject_string_final,to_from_range,total_questions,info_file_edited_date_and_time,mark_file_long_string,mark_file_rows,mark_file_edited_date_and_time,key_answer_file_long_string,key_answer_file_edited_date_and_time from 1_exam_admin_create_exam where sl='$sl'");
	$row=mysqli_fetch_array($res);
	
	$test_code=$row['test_code'];
	$test_mode_id=$row['mode'];



	$res_now=$con->query("select test_mode_name,test_mode_subjects from 0_test_modes where test_mode_id='$test_mode_id'");
	$row_now=mysqli_fetch_array($res_now);
	 $test_mode_subjects=$row_now['test_mode_subjects']; //ID
	//exit;
	
		$subject_array=array();		
		$sub=$con->query("select subject_name from 0_subjects where subject_id IN($test_mode_subjects) ORDER BY FIND_IN_SET(subject_id,'$test_mode_subjects')");
		while($row_sub=mysqli_fetch_array($sub))
		{
			$subject_array[]=$row_sub['subject_name'];
		}
		

	 $subject_string_initial=implode(",",$subject_array);
	
	
	$total_subject=sizeof($subject_array);
	
	//$subject_string_initial=$row['subject_string_initial'];
	$temp=array();
	$subject_string_final=$row['subject_string_final']; //THIS IS ID
	$subject_string_id_final_array=explode(",",$subject_string_final);
	foreach($subject_string_id_final_array as $ind_id)
	{
		$res_here=$con->query("select subject_name from 0_subjects where subject_id='$ind_id'");
		$row_here=mysqli_fetch_array($res_here);
	    $temp[]=$row_here['subject_name'];
	}
	$subject_string_final=implode(",",$temp);
	

	
	$total_questions=$row['total_questions'];
	//exit;
	$info_file_edited_date_and_time=$row['info_file_edited_date_and_time'];
	if($info_file_edited_date_and_time !="")
	{
	$date_and_time_array=explode(" ",$info_file_edited_date_and_time);	
	$originalDate = $date_and_time_array[0];
    $info_d_m_y = date("d-m-Y", strtotime($originalDate));
	$info_time=$date_and_time_array[1];
	$info_file_edited_date_and_time=$info_d_m_y." at ".$info_time;
	}
	else
	if($info_file_edited_date_and_time==""){$info_file_edited_date_and_time="Didnt Add Yet";}
	
	
	//MARK File
	$mark_file_long_string=$row['mark_file_long_string'];
	$mark_file_long_string_array=explode(",",$mark_file_long_string);
	$mark_file_rows=$row['mark_file_rows'];
	$mark_file_edited_date_and_time=$row['mark_file_edited_date_and_time'];
		if($mark_file_edited_date_and_time !="")
	{
	$date_and_time_array=explode(" ",$mark_file_edited_date_and_time);	
	$originalDate = $date_and_time_array[0];
    $mark_d_m_y = date("d-m-Y", strtotime($originalDate));
	$mark_time=$date_and_time_array[1];
	$mark_file_edited_date_and_time=$mark_d_m_y." at ".$mark_time;
	}
	else
	if($mark_file_edited_date_and_time==""){$mark_file_edited_date_and_time="Didnt Add Yet";}
	
	
	
	//MARK FILE
	
	//ANSWER KEY FILE
	$key_answer_file_long_string=$row['key_answer_file_long_string'];
	$key_answer_file_edited_date_and_time=$row['key_answer_file_edited_date_and_time'];
	if($key_answer_file_edited_date_and_time !="")
	{
	$date_and_time_array=explode(" ",$key_answer_file_edited_date_and_time);	
	$originalDate = $date_and_time_array[0];
    $key_d_m_y = date("d-m-Y", strtotime($originalDate));
	$key_time=$date_and_time_array[1];
	$key_answer_file_edited_date_and_time=$key_d_m_y." at ".$key_time;
	}
	else
	
	if($key_answer_file_edited_date_and_time==""){$key_answer_file_edited_date_and_time="Didnt Add Yet";}
	//ANSWER KEY FILE
	
	
	 echo '<div class="modal-dialog modal-lg">
      <div class="modal-content" style="    width: 125%;left: -13%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="display:inline;">info/key/Ans for Test Code: <span style="font-weight:500">' . $test_code .'</span></h4><h4 class="modal-title" style="display:inline;position:relative;    left: 52%;"><!--Last Edited On:11-11-2017--></h4>
        </div>
        <div class="modal-body">
         <div class="row">
            <div class="col-md-6">
              <div class="card">
                                <h6 style="display:inline;position:relative;    left: 56%;">Last Edited On:'.$info_file_edited_date_and_time.'</h6><br>
                                <h4 style="display:inline;" class="title">Info File</h4>';
                             
							 if($subject_string_final=="")
							 {
								 $subject_string_initial_array=explode(',',$subject_string_initial);
							 
							 
							 $id=1;
							 foreach($subject_string_initial_array as $val)
							 {
								 if($total_subject !=1)
								 {echo '<button id="button'.$id.'" value="no" onclick="bring_this_down('.$id.','.$total_subject.')">'.$val.'</button>';
								 $id++;
								 }
							 }
							 
							 }
							 
							 
                            echo '<div class="content table-responsive ">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Subject Name</th>
                                        <th>Question Start No</th>
                                        <th>Question End No</th>
                                        
                                    </thead>
                                    <tbody>';
									/*
									echo '<style type="text/css">
.no-spin::-webkit-inner-spin-button, .no-spin::-webkit-outer-spin-button {
    -webkit-appearance: none !important;
    margin: 0 !important;
    -moz-appearance:textfield !important;
}</style>';
						*/			
									
									        if($subject_string_final=="")
											{	
											$init=1;
											for($init=1;$init<=$total_subject;$init++) 
											{
												if($total_subject==1)
												{
											 echo '<tr> <td id="sub'.$init.'">'.$subject_string_initial.'</td>
										     <td><input type="number" class="form-control left no-spin"  id="start'.$init.'" ></td>
                                             <td><input type="number" class="form-control right no-spin"  id="end'.$init.'"   ></td>
                                        </tr>';
													
												}
												else
												{
											 echo '<tr> <td id="sub'.$init.'"></td>
										     <td><input type="number" class="form-control left no-spin"  id="start'.$init.'" style="background:#efd6d6;" disabled ></td>
                                             <td><input type="number" class="form-control right no-spin" temp="'.$init.'" id="end'.$init.'"  style="background:#efd6d6;" disabled  ></td>
                                        </tr>';
													
												}	
					
												
											}			
                                  
                                            }
											else
											{
												
												$m=1;
												$subject_string_final_array=explode(",",$subject_string_final);
												$to_from_range=$row['to_from_range'];
												$to_from_range_array=explode(",",$to_from_range);
												
												for($m=0;$m<$total_subject;$m++)
												{
													$first_from_to=$to_from_range_array[$m];
													$internal_explode_array=explode("-",$first_from_to);
													
													echo '<tr><td>'.$subject_string_final_array[$m].'</td>
													           <td>'.$internal_explode_array[0].'</td>
															   <td>'.$internal_explode_array[1].'</td>
															   </tr>';
													
												}
												
												
												
												
												
												
												
												
											}
                                       
                                   echo '</tbody>
								   
                                </table>';
								if($total_subject==1)
								{
								echo '<button type="submit" id="store" onclick="insert_info_file_of_sl('.$sl.','.$total_subject.')" class="btn btn-info btn-fill" style="margin-left: 84%;">STORE</button>';
								}
								else
								{
								echo '<button type="submit" id="store" onclick="insert_info_file_of_sl('.$sl.','.$total_subject.')" class="btn btn-info btn-fill hidden" style="margin-left: 84%;">STORE</button>';	
								}
								if($subject_string_final!="")
								{
									echo '<button type="submit"  onclick="delete_and_edit_info_and_mark_of_sl('.$sl.')" class="btn btn-info btn-fill " style="margin-left: 34%;">Delete Info+Mark+Answer Key File to Update Newly</button>';		
									
								}
								
								

                           echo '</div>
                        </div>
                
            </div>
            <div class="col-md-6">
                 <div class="card">
                                <h6 style="display:inline;position:relative;    left: 57%;">Last Edited On:'.$mark_file_edited_date_and_time.'</h6><br>
                                <h4 style="display:inline;" class="title">Mark File</h4>
                             
                            <div class="content table-responsive ">
                                <table class="table table-hover ">
                                    <thead>
                                        <th>QNo From</th>
                                         <th>QNo To</th>
                                        <th>+ve Mark</th>
                                        <th>-ve Mark</th>
                                        
                                    </thead>
                                    <tbody>';
									
									        if($mark_file_long_string=="")
											{
											echo '<tr>
                                      
                                            <td id="mrow1">  <input type="number" class="form-control mleft no-spin" id="mstart1" placeholder="1"></td>
                                            <td>  <input type="number" class="form-control mright no-spin" id="mend1" mtemp="1" 
											total_questions="'.$total_questions.'"  ></td>
                                            <td>  <input type="number" class="form-control no-spin" id="mpositive1" required></td>
                                            <td>  <input type="number" class="form-control no-spin" id="mnegative1"  required></td>
                                        </tr>';
									
									for($minit=2;$minit<=10;$minit++)
									{
										echo '<tr id="mrow'.$minit.'" class="hidden">
                                      
                                            <td>  <input type="number" class="form-control mleft no-spin" id="mstart'.$minit.'" ></td>
                                            <td>  <input type="number" class="form-control mright no-spin" id="mend'.$minit.'" mtemp="'.$minit.'"  total_questions="'.$total_questions.'"></td>
                                            <td>  <input type="number" class="form-control no-spin" required id="mpositive'.$minit.'"  ></td>
                                            <td>  <input type="number" class="form-control no-spin" required id="mnegative'.$minit.'"  ></td>
                                        </tr>';
										
									} 
                                       
                                
                             
                                    echo '</tbody>
                                </table>';
									echo '<button type="submit" id="mark_store" onclick="insert_mark_file_of_sl('.$sl.','.$total_questions.')" class="btn btn-info btn-fill hidden" style="margin-left: 84%;">STORE </button>';
									
											}
											else
											{
					
									$iterate=0;
									for($minit=1;$minit<=$mark_file_rows;$minit++)
									{
										
										
										
										echo '<tr id="mrow'.$minit.'" >
                                      
                                            <td>'.$mark_file_long_string_array[$iterate++].'</td>
                                            <td>'.$mark_file_long_string_array[$iterate++].'</td>
                                            <td>'.$mark_file_long_string_array[$iterate++].'</td>
                                            <td>'.$mark_file_long_string_array[$iterate++].'</td>
                                        </tr>';
										
									} 
                                       
                                
                             
                                    echo '</tbody>
                                </table>';
									echo '<button type="submit"  onclick="delete_and_edit_info_and_mark_of_sl('.$sl.')" class="btn btn-info btn-fill " style="margin-left: 34%;">Delete Info+Mark+Answer  to Update Newly</button>';
									
											}
									
									
									
									
									
									
                           echo '</div>
                        </div>
                         <div class="col-md-12">&nbsp;</div>

                 		 <div class="card">
                 		 		<h6 style="display:inline;position:relative;    left: 57%;">Last Edited On:'.$mark_file_edited_date_and_time.'</h6><br>
                                <h4 style="display:inline;" class="title">Qestion Level</h4>
                                        <div class="content table-responsive ">
                                <table class="table table-hover ">
                                    <thead>
                                        <th>Q Level</th>
                                         <th>QNO</th>
                                        
                                        
                                    </thead>
                                    <tbody>
                                    	<tr>
                                    	    <td>MCQ</td>
                                    	    <td><input type="text" class="form-control "  placeholder="Example : 1-10,20-30" ></td>
                                    	</tr>
                                    	<tr>
                                    	    <td>MCQ</td>
                                    	    <td><input type="text" class="form-control "  placeholder="Example : 1-10,20-30" ></td>
                                    	</tr>
                                    	<tr>
                                    	    <td>MCQ</td>
                                    	    <td><input type="text" class="form-control "  placeholder="Example : 1-10,20-30" ></td>
                                    	</tr>
                                    </tbody>
                                </table>
                                 <button type="submit"   class="btn btn-info btn-fill " style="margin-left: 34%;">Submit</button>
                 		 </div>
                 		 </div>
            </div>

            <div class="col-md-12">
                 <div class="card">
                           
                                <h4 style="display:inline;" class="title">Answer Key File</h4><h6 style="display:inline;    position: relative;
    left: 65%;">Last Edited On:'.$key_answer_file_edited_date_and_time.'</h6>';
                             if($key_answer_file_long_string=="")
							 { 
                            echo '<div class="content table-responsive table-break-down">
                                <table class="table table-hover " style="text-align:left;">
                                    <thead>
                                        <th >Q NO</th>
                                        <th>X1</th>
                                        <th>X2</th>
                                        <th>X3</th>
                                        <th>X4</th>
                                        <th>X5</th>
                                        <th>X6</th>
                                        <th>X7</th>
                                        <th>X8</th>
                                        <th>X9</th>
                                        <th>X10</th>
										<th>Y1</th>
                                        <th>Y2</th>
                                        <th>Y3</th>
                                        <th>Y4</th>
                                        <th>Y5</th>
                                        <th>Y6</th>
                                        <th>Y7</th>
                                        <th>Y8</th>
                                        <th>Y9</th>
                                        <th>Y10</th>
                                   
                                        
                                        
                                    </thead>
                                    <tbody>';
									
									 $loop=1;
									$total_row=ceil($total_questions/20);
									$dstart=1;$dend=20;
									
									$i=1;
									
									$count_to_twenty=1;
					for($loop=1;$loop<=$total_row;$loop++)
					 { 
						echo '<tr><td>'.$dstart.'-<br>'.$dend.'</td>';
						
						         
								 for($count_to_twenty=1;$count_to_twenty<=20;$count_to_twenty++)
								 {
									if($i<=$total_questions)
                                    {
									 echo '<td>  <input type="text"  id="key'.$i.'" class="form-control key no-spin" required></td>';   
									} 
									$i++; 
								 
					
									
								 }$dstart+=20;$dend+=20; 
								 
								echo '</tr>';
					 }

                                       
                                    echo '</tbody>
                                </table>';
								
								if(($subject_string_final !="") && ($mark_file_long_string !=""))
								{
									echo '<button type="submit" id="answer_key_file_store" onclick="insert_key_answer_file_of_sl('.$sl.','.$total_questions.',1)" class="btn btn-info btn-fill" style="margin-left: 92%;">STORE</button>';
									
								}	

                            echo '</div>';
							
							 }//	key_answer_file_long_string
							 
							 
							 
							 
							                   else if($key_answer_file_long_string!="")
							 { 
                            echo '<div class="content table-responsive table-break-down" id="key_answer_div">
                                <table class="table table-hover " style="text-align:left;">
                                    <thead>
                                        <th style="width: 100px;">Q NO</th>
                                        <th>X1</th>
                                        <th>X2</th>
                                        <th>X3</th>
                                        <th>X4</th>
                                        <th>X5</th>
                                        <th>X6</th>
                                        <th>X7</th>
                                        <th>X8</th>
                                        <th>X9</th>
                                        <th>X10</th>
										<th>Y1</th>
                                        <th>Y2</th>
                                        <th>Y3</th>
                                        <th>Y4</th>
                                        <th>Y5</th>
                                        <th>Y6</th>
                                        <th>Y7</th>
                                        <th>Y8</th>
                                        <th>Y9</th>
                                        <th>Y10</th>
                                   
                                        
                                        
                                    </thead>
                                    <tbody>';
									
									 $loop=1;
									$total_row=ceil($total_questions/20);
									$dstart=1;$dend=20;
									$key_answer_file_long_string_array=explode(",",$key_answer_file_long_string);
									
									$i=0;
									
									$count_to_twenty=1;
					for($loop=1;$loop<=$total_row;$loop++)
					 { 
						echo '<tr><td>'.$dstart.'-'.$dend.'</td>';
						
						         
								 for($count_to_twenty=1;$count_to_twenty<=20;$count_to_twenty++)
								 {
									if($i<$total_questions)
                                    {
									 echo '<td> '.$key_answer_file_long_string_array[$i].'</td>';   
									} 
									$i++; 
								 
					
									
								 }$dstart+=20;$dend+=20; 
								 
								echo '</tr>';
					 }

                                       
                                    echo '</tbody>
                                </table>';
								echo '<button type="submit" id="store" onclick="edit_key_answer_file_of_sl('.$sl.','.$total_questions.')" class="btn btn-info btn-fill" style="margin-left: 92%;">EDIT</button>';

                            echo '</div>';
							
							 }//
							 
							 
							 
							 
							 
                        echo '</div>
            </div>



            
          </div>

          
        </div>
        <div class="modal-footer">
             
          
        </div>
      </div>
    </div>';
	
	
	
	//exit;
}

function insert_info_file_of_sl($con) //CRB not required......(small doing=> Checked)
{
	
    $to_from_range=$_POST['to_from_range'];
	$sl=$_POST['sl'];
	$subject_string_final_array=$_POST['subject_string_final_array'];
	$subject_string_final_string=implode(',',$subject_string_final_array);
	 
	 
	 $sub_id_array=array();
	 foreach($subject_string_final_array as $individual_subject)
	 { 
		$res=$con->query("select subject_id from 0_subjects where subject_name='$individual_subject' "); 
		$row=mysqli_fetch_array($res);
		$sub_id_array[]=$row['subject_id'];
	 }
	 $subject_string_final_string=implode(',',$sub_id_array);
	
	
	$total_questions=$_POST['total_questions'];
	
	$current_date=current_date_y_m_d();
    $current_time=current_time_12_hour_format_h_m_s();
	$info_file_edited_date_and_time=$current_date." ".$current_time;
	
	$originalDate = $current_date;
    $d_m_y = date("d-m-Y", strtotime($originalDate));
	
	
	$res=$con->query("update 1_exam_admin_create_exam set subject_string_final='$subject_string_final_string',to_from_range='$to_from_range',total_questions='$total_questions',info_file_edited_date_and_time='$info_file_edited_date_and_time',edit_status = CONCAT(edit_status, ',Info File@Added On@$d_m_y@$current_time') where sl='$sl'");
	//echo mysqli_error($con);
	if($res)
	{
		echo "Info File Data Added Successfully";
	}
	else
	{
       echo "ajax_error";
	}
	
	exit;
}
//DELETE INFO-MARK-ANSWER KEY FILE
function delete_and_edit_info_and_mark_of_sl($con) //CRB not required......(small doing=>Checked )
{   $blank="";
	$sl=$_POST['sl'];
    $current_date=current_date_y_m_d();
	$current_time=current_time_12_hour_format_h_m_s();
	$current_date_and_time=$current_date." ".$current_time;
	
	
	$originalDate = $current_date;
    $d_m_y = date("d-m-Y", strtotime($originalDate));
	
		//AUTO COMIT OFF IT	
	
	$res=$con->query("update 1_exam_admin_create_exam set subject_string_final='',to_from_range='',total_questions='0',	info_file_edited_date_and_time='',mark_file_long_string='',max_marks='0',mark_file_rows='0',mark_file_edited_date_and_time='',
	key_answer_file_long_string='',key_answer_file_edited_date_and_time='',status_serialized='',edit_status = CONCAT(edit_status, ',Info-Mark-Key File@Deleted On@$d_m_y@$current_time') where sl='$sl'");
	echo mysqli_error($con);
	
   // $res2=$con->query("delete from 2_exam_marks_upload where test_code_sl_id='$sl'");
	
	if($res){echo "Info,Mark,Answer Key File Deleted Successfully";}
		else
	{
       echo "ajax_error";
	}
	exit;
}

function insert_mark_file_of_sl($con) //CRB not required.....(small doing=>Checked )
{


	$sl=$_POST['sl'];
	$mark_file_long_string_array=$_POST['mark_file_long_string_array'];
	$mark_file_long_string_array_string=implode(",",$mark_file_long_string_array);
	$row_length=$_POST['row_length'];
	$current_date=current_date_y_m_d();
    $current_time=current_time_12_hour_format_h_m_s();
	$mark_file_edited_date_and_time=$current_date." ".$current_time;
	$originalDate = $current_date;
    $d_m_y = date("d-m-Y", strtotime($originalDate));
    //$max_marks=get_max_marks_from_mark_file_long_string_array_string($mark_file_long_string_array_string);
	
	$res=$con->query("update 1_exam_admin_create_exam set mark_file_long_string='$mark_file_long_string_array_string',mark_file_rows='$row_length',mark_file_edited_date_and_time='$mark_file_edited_date_and_time',edit_status = CONCAT(edit_status, ',Mark File@Added On@$d_m_y@$current_time') where sl='$sl'");
	if($res){echo "Mark File Inserted Successfully";}
			else
	{
       echo "ajax_error";
	}
	
	exit;
}




function get_max_marks_from_mark_file_long_string_array_string($mark_file_long_string_array_string)  //(small doing=>Checked)
{

   //$mark_file_long_string_array_string="1,10,4,2";
   $mark_file_long_string_array=explode(",",$mark_file_long_string_array_string);
   $size=sizeof($mark_file_long_string_array);
   $loop_count=$size/4;

   $from_index=0;
   $to_index=1;
   $marks_index=2;

   $max_marks=0;
   $this_marks=0;
   for($i=1;$i<=$loop_count;$i++)
   {

     $this_no_of_question=($mark_file_long_string_array[$to_index]-$mark_file_long_string_array[$from_index])+1;
     $this_marks=$this_no_of_question*$mark_file_long_string_array[$marks_index];
     $max_marks=$max_marks+$this_marks;


   $from_index=$from_index+4;
   $to_index=$to_index+4;
   $marks_index=$marks_index+4;

   }
   return $max_marks;

}

function insert_key_answer_file_of_sl($con) //CRB not required.....//(small doing=>Checked)
{
	//NON ADVANCED
	$sl=$_POST['sl'];
	$type=$_POST['type'];
	$current_date=current_date_y_m_d();
    $current_time=current_time_12_hour_format_h_m_s();
	$key_answer_file_edited_date_and_time=$current_date." ".$current_time;
	$originalDate = $current_date;
    $d_m_y = date("d-m-Y", strtotime($originalDate));
	
	$key_answer_array=$_POST['key_answer_array'];
	$key_answer_string=implode(",",$key_answer_array);
	
	//$res_now=$con->query("select * from 1_exam_admin_create_exam where sl='$sl'"); //S
    $res_now=$con->query("select key_answer_file_long_string,mark_file_long_string,to_from_range from 1_exam_admin_create_exam where sl='$sl'");
    

	$row_now=mysqli_fetch_array($res_now);
	$previous_key=$row_now['key_answer_file_long_string'];
	$mark_file_long_string=$row_now['mark_file_long_string'];
	$to_from_range=$row_now['to_from_range'];
	
	if($previous_key==$key_answer_string)
	{
		
		echo "same_as_before"; exit;
	}


   //$max_marks=get_max_marks_from_mark_file_long_string_array_string($mark_file_long_string);
   //$marks_to_del=get_marks_deleted($mark_file_long_string,$key_answer_string);

   //$new_max_marks=$max_marks-$marks_to_del;
    $key_answer_file_long_string=$key_answer_string;
    $subject_wise_max_marks_string=get_max_marks_subject_wise_string($to_from_range,$mark_file_long_string,$key_answer_file_long_string);

	//echo  $subject_wise_max_marks_string;  exit;
	//AUTO COMIT OFF IT
	$res=$con->query("update 1_exam_admin_create_exam set status_serialized='',key_answer_file_long_string='$key_answer_string',max_marks='$subject_wise_max_marks_string',key_answer_file_edited_date_and_time='$key_answer_file_edited_date_and_time',edit_status = CONCAT(edit_status, ',Key File@$type On@$d_m_y@$current_time') where sl='$sl'");
	
	//$res2=$con->query("delete from 2_exam_marks_upload where test_code_sl_id='$sl'");
	
	
	if($res)
	{
		echo "success";
	}
	else
	{
       echo "ajax_error";
	}
	exit;
}

function get_marks_deleted($mark_file_long_string,$key_answer_string) //CRB not required....(small doing=>Checked)
{
  //$mark_file_long_string="1,15,4,1,16,30,5,1";
  $mark_file_long_string_array=explode(",",$mark_file_long_string);
  $size=sizeof($mark_file_long_string_array);
  $loop_count=$size/4;

  //$key_answer_string="A,B,X,D,A,B,C,D,A,B,C,D,A,B,C,D,A,B,C,D,A,B,C,D,A,B,C,D,A,B";
  $key_answer_string_array=explode(",",$key_answer_string);
  $marks_to_del=0;
  foreach($key_answer_string_array as $key=>$val)
  {
     if($val=="X")
     {


     	   $from_index=0;
		   $to_index=1;
		   $marks_index=2;
             for($i=1;$i<=$loop_count;$i++)
               {    
                    
                   if( (($key+1) >= $mark_file_long_string_array[$from_index] )&& (($key+1) <= $mark_file_long_string_array[$to_index] ) )
                   {
                   	$marks_to_del=$marks_to_del+$mark_file_long_string_array[$marks_index];
                   }
                 
                      $from_index=$from_index+4;
					  $to_index=$to_index+4;
					  $marks_index=$marks_index+4;
               }   


     }

  

  }

return $marks_to_del;



}







function delete_all_branches_result_of_sl($con) //CRB  required....(small doing=>Checked)
{
	$sl=$_POST['sl'];
	//AUTO COMMIT OFF It
    mysqli_autocommit($con,FALSE);

    $res=$con->query("select mode,result_generated1_no0 from 1_exam_admin_create_exam where sl='$sl'");
    $row=mysqli_fetch_array($res);
    $test_mode_id=$row['mode'];
    $result_generated1_no0=$row['result_generated1_no0'];

 $res2=$con->query("select marks_upload_temp_table_name,marks_upload_final_table_name from 0_test_modes where test_mode_id='$test_mode_id'");
 $row2=mysqli_fetch_array($res2);

 $marks_upload_temp_table_name=$row2['marks_upload_temp_table_name'];
 $marks_upload_final_table_name=$row2['marks_upload_final_table_name'];


// 26 sep.. as of now only one table is deleting depending upon result_generated1_no0..
// now below ll flush both the table

if($result_generated1_no0==0)
{
	$marks_upload_table=$marks_upload_temp_table_name;
}
else
if($result_generated1_no0==1)
{
	$marks_upload_table=$marks_upload_final_table_name;
}




//101_mismatch_approval_request



	$current_date=current_date_y_m_d();
    $current_time=current_time_12_hour_format_h_m_s();
	$originalDate = $current_date;
    $d_m_y = date("d-m-Y", strtotime($originalDate));
	

/*Below single query ($res_up)taking care of
1. result_generated1_no0
2. status_serialized
3. is_college_id_mobile_uploaded
4. edit_status= CONCAT(edit_status, ',ALL BRANCH MARKS & RESULT@Deleted On@$d_m_y@$current_time')


*/
	$res_up=$con->query("update 1_exam_admin_create_exam set result_generated1_no0=0,status_serialized='',is_college_id_mobile_uploaded='',edit_status = CONCAT(edit_status, ',ALL BRANCH MARKS & RESULT@Deleted On@$d_m_y@$current_time') where sl='$sl'");
	
	//$res2=$con->query("delete from 2_exam_marks_upload where test_code_sl_id='$sl'");

//flushing both temp and final table
$res_del1=$con->query("delete from $marks_upload_temp_table_name where test_code_sl_id='$sl'");
$res_del2=$con->query("delete from $marks_upload_final_table_name where test_code_sl_id='$sl'");

$res_del3=$con->query("delete from 101_mismatch_approval_request where test_sl='$sl'");
   

//delete "is_uploaded" (1_exam_recompute_req_c_id)
$res_del4=$con ->query("delete from 1_exam_recompute_request_campus_id where sl='$sl'");

   $str="../../College/3_view_created_exam/uploads/$sl";


//delete all folder of uploads/sl
delete_directory_and_subdir_and_files_recursive($str);





// When an exam is deleted then its merged related exams and results also should be deleted....
   $flagging=0;
   $res5=$con->query("select exam_id from 1_merged_exams where merged_exam_id='$sl'");
   if(mysqli_num_rows($res5)>0)
   {
   	$flagging=1;
   //echo "in";exit;
    //delete results first from final table.. here temp table storing wont be there for merged
      $row5=mysqli_fetch_array($res5);
      $merged_new_created_exam_id=$row5['exam_id'];
      $res6=$con->query("delete from $marks_upload_final_table_name where test_code_sl_id='$merged_new_created_exam_id'");
      //echo mysqli_error($con); exit;
      //delete from 1_merged_exams table

      $res7=$con->query("delete from 1_merged_exams where exam_id='$merged_new_created_exam_id'");

      //delete entire row of 1_exam_admin_create_exam


      $res8=$con->query("delete from 1_exam_admin_create_exam where sl='$merged_new_created_exam_id'");

   }


    if($flagging==0)
    {

      	if($res_up && $res_del1 && $res_del2 && $res_del3 && $res_del4)
	{   mysqli_commit($con);
		echo "deleted_success";
	}


		  else
	  {    mysqli_rollback($con);
	       echo "ajax_error";
	  }
	
	exit;

    }

    else
    	if($flagging==1)
    	{

		  if($res_up && $res_del1 && $res_del2 && $res_del3 && $res_del4 && $res5 && $res6 && $res7 && $res8)
			{   mysqli_commit($con);
				echo "deleted_success";
			}


				  else
			  {    mysqli_rollback($con);
			       echo "ajax_error";
			  }
	
	exit;

    	}
    



}

function delete_directory_and_subdir_and_files_recursive($str)
 {
    //It it's a file.
    if (is_file($str)) {
        //Attempt to delete it.
        return unlink($str);
    }
    //If it's a directory.
    elseif (is_dir($str)) {
        //Get a list of the files in this directory.
        $scan = glob(rtrim($str,'/').'/*');
        //Loop through the list of files.
        foreach($scan as $index=>$path) {
            //Call our recursive function.
            delete_directory_and_subdir_and_files_recursive($path);
        }
        //Remove the directory itself.
        return @rmdir($str);
    }
}






function edit_key_answer_file_of_sl($con) //CRB not required.....(small doing=>Checked)
{
	$sl=$_POST['sl'];
	$res=$con->query("select total_questions,key_answer_file_long_string from 1_exam_admin_create_exam where sl='$sl'");
	$row=mysqli_fetch_array($res);

	$key_answer_file_long_string=$row['key_answer_file_long_string'];
	$key_answer_file_long_array=explode(",",$key_answer_file_long_string);
	$total_questions=$row['total_questions'];
	
	//$res=$con->query("select * from 1_exam_admin_create_exam where sl='$sl'");
	
	
	                             if($key_answer_file_long_string!="")
							 { 
                            echo '<div class="content table-responsive table-break-down">
                                <table class="table table-hover ">
                                    <thead>
                                        <th style="    width: 52px;">Q NO</th>
                                        <th>X1</th>
                                        <th>X2</th>
                                        <th>X3</th>
                                        <th>X4</th>
                                        <th>X5</th>
                                        <th>X6</th>
                                        <th>X7</th>
                                        <th>X8</th>
                                        <th>X9</th>
                                        <th>X10</th>
										<th>Y1</th>
                                        <th>Y2</th>
                                        <th>Y3</th>
                                        <th>Y4</th>
                                        <th>Y5</th>
                                        <th>Y6</th>
                                        <th>Y7</th>
                                        <th>Y8</th>
                                        <th>Y9</th>
                                        <th>Y10</th>
                                   
                                        
                                        
                                    </thead>
                                    <tbody>';
									
									 $loop=1;
									$total_row=ceil($total_questions/20);
									$dstart=1;$dend=20;
									
									$i=1;
									
									$count_to_twenty=1;
					for($loop=1;$loop<=$total_row;$loop++)
					 { 
						echo '<tr><td>'.$dstart.'-<br>'.$dend.'</td>';
						
						         
								 for($count_to_twenty=1;$count_to_twenty<=20;$count_to_twenty++)
								 {
									if($i<=$total_questions)
                                    {
									 echo '<td>  <input type="text" te="sec" value="'.$key_answer_file_long_array[$i-1].'" id="key'.$i.'" class="form-control key no-spin" required></td>';   
									} 
									$i++; 
								 
					
									
								 }$dstart+=20;$dend+=20; 
								 
								echo '</tr>';
					 }

                                       
                                    echo '</tbody>
                                </table>';
								echo '<button type="submit" id="store" onclick="insert_key_answer_file_of_sl('.$sl.','.$total_questions.',2)" class="btn btn-info btn-fill" style="margin-left: 92%;">Update</button>';

                            echo '</div>';
							
							 }//	key_answer_file_long_string
							 
							 
	exit;
}

function track_college_uploads_of_sl($con) //CRB not required........ (small doing=>Checked)
{
	$sl=$_POST['sl'];
				$current_date=current_date_d_m_y();
			$current_time=current_time_12_hour_format_h_m_s();


	//echo '<script>alert("ooo);</script>';
	        $res=$con->query("select test_code,status_serialized from 1_exam_admin_create_exam where sl='$sl'");
			$row=mysqli_fetch_array($res);
		    $status_serialized=$row['status_serialized'];
			$test_code_name=$row['test_code'];


	echo '<div class="modal-dialog modal-lg">
      <div class="modal-content" style="    width: 125%;left: -13%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="font-size:38px;">×</button>
          <div style="    width: 56%;    display: inline-block;">
          <h4 class="modal-title" style="display:inline;">Branch Wise Uploaded Status for Test: <span style="font-weight:500;">'.$test_code_name.'</span></h4>
          	</div>
          	<div style=" display: inline-block;">
          <h4 class="modal-title" style="display:inline;">
		  Last Data as on: '.$current_date.' at '.$current_time.'</h4>
		   
		   <img src="../assets/img/refresh.png" height="60" width="60" style="display:inline;cursor:pointer;    margin-top: -1%;" onclick="track_college_uploads_of_sl('.$sl.');">
		  </div>
        </div>
        <div class="modal-body">
         <div class="row" style="min-height:500px;">
		 <div class="col-md-offset-1 col-md-10">';
     
	 
	 echo '<table class="table table-hover table-bordered">
			      <tr><th>Sl</th><th>Branch Name</th><th>Branch ID</th><th>Total Valid Uploaded Students</th><th style="color:red;">Approval awaiting Students</th><th style="color:green;">Approved Students</th><th>Approve</th><th>Uploaded Date</th><th>Uploaded Time</th><th>Status</th></tr>';

			if($status_serialized !="")
			{
				 $status_non_serialized_array=unserialize($status_serialized);
				 $i=1;			 
					 foreach($status_non_serialized_array as $key=>$value)
					  {
						  $this_value=$value;
						  $this_value_array=explode(" ",$this_value);
						  	$originalDate = $this_value_array[1];
							$this_value_array[1] = date("d-m-Y", strtotime($originalDate));
							$r=$con->query("select t.*,c.CITY_NAME from t_campus t left join t_city c on t.CITY_ID=c.CITY_ID where CAMPUS_ID='$key'");
							$r=mysqli_fetch_array($r);

							$res_in=$con->query("select count(*) as c from 101_mismatch_approval_request where test_sl='$sl' and this_college_id='$key' and status='0'");
							$row_in=mysqli_fetch_array($res_in);
							$approval_count=$row_in['c'];

							$res_in=$con->query("select count(*) as c from 101_mismatch_approval_request where test_sl='$sl' and this_college_id='$key' and status='1'");
							$row_in=mysqli_fetch_array($res_in);
							$approved_count=$row_in['c'];

							$short_city = substr($r['CITY_NAME'], 0, 3);
						  
						 echo '<tr><td>'.$i++.'</td><td>'.$r['CAMPUS_NAME'].'</td><td>'.$key.'-'.$short_city.'</td><td>'.$this_value_array[0].'</td><td style="color:red;">'.$approval_count.'</td>
						 <td style="color:green;">'.$approved_count.'</td>

                         <td><button class="btn btn-info btn-fill btn-xs" onclick="show_approve_status_of('.$sl.','.$key.')">Info</button></td>
						 <td>'.$this_value_array[1].'</td><td>'.$this_value_array[2].'</td><td style="color:green;font-weight:bold;">Verified</td></tr>'; 
					  }
				 
				 
				 
			}
			else
			{
				echo '<center style="color:red;font-weight: bold;font-size: 22px;"> No Branches Have Uploaded Yet </center>';
			}
			
			

			
			
			    echo ' </div></table>';

           
          
        echo '</div>
		</div>
        <div class="modal-footer">
             
          
        </div>
      </div>
    </div>';
	
	exit;
}



function view_status_info_modal_of_sl($con) //CRB not required ......(small doing=>Checked)
{
	$sl=$_POST['sl'];
	//$this_college_id=9999;
	
	        $res=$con->query("select * from 1_exam_admin_create_exam where sl='$sl'");
			$row=mysqli_fetch_array($res);
		  
			$test_code_name=$row['test_code'];
			$edit_status=$row['edit_status'];
			$edit_status_array=explode(",",$edit_status);
			$last_date_to_upload=date("d-m-Y", strtotime($row['last_date_to_upload']));
			$last_time_to_upload=$row['last_time_to_upload'];
			$test_code=$row['test_code'];
			$upload_date_time_string="";
			

			
			if($upload_date_time_string=="")
			{
				$upload_date_time_string_array=array();
			}
			else
			{
			$upload_date_time_string_array=explode(",",$upload_date_time_string);	
			}
			
			//echo json_encode($upload_date_time_string_array);exit;
			$current_date=current_date_d_m_y();
			$current_time=current_time_12_hour_format_h_m_s();
	echo '<div class="modal-dialog modal-lg">
      <div class="modal-content" style="  width: 125%;left: -13%; ">  <!---->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="font-size:38px;">×</button>
          <div style="    width: 56%;    display: inline-block;">
          <h4 class="modal-title" style="display:inline;">Test Status-Info of: <span style="font-weight:500;">'.$test_code.'</span></h4>
		  </div>
          <div style=" display: inline-block;">
		  <h4 class="modal-title" style="display:inline;">Last Data as on: '.$current_date.' at '.$current_time.'</h4>
		  <img src="../assets/img/refresh.png" height="60" width="60" style="display:inline;cursor:pointer;    margin-top: -1%;" onclick="view_status_info_modal_of_sl('.$sl.');">
		  </div>
		 
        </div>
        <div class="modal-body">
         <div class="row" style="min-height:500px;">
		 
		 <div class="col-md-3" style="text-align: justify;">
		  <ul>
		    <li style="border-bottom: 1px solid #ccc8c8;">When a Info-Mark-Key File of a particular Test is \'deleted or Updated\' then All Branches Previous Uploaded Marks and generated Ranks will be deleted. So all branches have to Upload their individual .DAT and regenerate the Result once again(AKC)</li>
			<!--<li style="border-bottom: 1px solid #ccc8c8;"> When the <button class="btn btn-fill btn-danger">Upload</button> Button is <span style="color:red;font-weight:bold;">RED</span>. It Means Uploading is Pending
			</li>
			<li style="border-bottom: 1px solid #ccc8c8;"> When the <button class="btn btn-fill btn-success">Upload</button> Button is <span style="color:green;font-weight:bold;">GREEN</span>. It Means Uploading of .Dat is Finished and the Result is Successfully Generated
			</li> -->
			<li style="border-bottom: 1px solid #ccc8c8;">
			You will get the Information of the Current Upload Status of all the Branches in the <button class="btn btn-fill btn-info">Track</button> Section..
			Once You get the confirmation about all the branches have uploaded their .DAT then you can generate the Ranking at the End(District Rank,State Rank,All India Rank)
			</li>
			<li style="border-bottom: 1px solid #ccc8c8;">When You  Change/Delete the Info-Mark-Key OR Delete the Result =>then All Marks and Ranks will be deleted, then again all Branches have to Upload the .DAT and should regenerate the Result. 
			</li>
		  </ul>
		 </div>
		 
		 <div class=" col-md-7">';
		 
		 echo "<span style='color:blue;'>Last Date to Upload .dat/.iit:<input id='dt' class=' datepicker' type='text' placeholder='DD-MM-YYYY' value='$last_date_to_upload'>
		 Time: <input type='text' id='tm' value='$last_time_to_upload' /></span>
         <button id='clk' onclick='edit_date_time_of_sl($sl)' class='btn btn-fill btn-info'>Edit</button>
		 "; echo '<br><br>';
          echo '<table class="table table-hover" style="border:1px solid #d6d5d5;">
		   <tr><th>File</th><th>Task</th><th>Date</th><th>Time</th></tr>';
		     $date_time_array=array();
		   $file_task_desc_array=array();
		   	     foreach($edit_status_array as $val)
		 {
			 
			 $this_line_array=explode("@",$val);
			 
			 array_push($file_task_desc_array,$this_line_array[0]."|".$this_line_array[1]);
			 $this_line_date_dmy=$this_line_array[2];
			 $this_line_date_ymd=date("Y-m-d", strtotime($this_line_date_dmy));
			 $this_line_date_ymd_and_time=$this_line_date_ymd." ".$this_line_array[3];
			 
			 
			 array_push($date_time_array,$this_line_date_ymd_and_time);
			 
			 
	     }
		 // echo $after_count=count($date_time_array);		 
		   //echo "before=";echo json_encode($date_time_array);
		  asort($date_time_array);
		   //echo json_encode($date_time_array);
		   $index_array=array();
		   $value_array=array();
		   foreach($date_time_array as $key=>$value)
		   {
			   $index_array[]=$key;
			   $value_array[]=$value;
			   
		   }
		   
		   		   foreach($index_array as $indexval)
		   {
			   $this_file_and_task=$file_task_desc_array[$indexval];
			   $this_file_and_task_array=explode("|",$this_file_and_task);
			   $file=$this_file_and_task_array[0];
			   $task=$this_file_and_task_array[1];
			   $this_value=$date_time_array[$indexval];
			   $this_value_array=explode(" ",$this_value);
			   $date_ymd=$this_value_array[0];
			   $date=date("d-m-Y", strtotime($date_ymd));
			   
			   $time=$this_value_array[1];
			   $color=""; $weight="";
			   
			   
			   					      if (strpos($task, '.DAT') !== false) 
									 {
										 $color="green";
										 $weight="bold";
									 }
									 else
										 if (strpos($task, 'Updated') !== false) 
									 {
										 $color="red";
										 $weight="bold";
									 }
									  else
										 if (strpos($file, 'ALL BRANCH') !== false) 
									 {
										 $color="#1b6e80";
										 $weight="bold";
									 }
									 
									 
									 
			     echo '<tr style="color:'.$color.';">
									  <td style="font-weight:'.$weight.'">'.$file.'</td>
									  <td style="font-weight:'.$weight.'">'.$task.'</td>
									  <td style="font-weight:'.$weight.'">'.$date.'</td>
									  <td style="font-weight:'.$weight.'">'.$time.'</td></tr>';
			   
		   }
										 $color="red";
										 $weight="bold";
		   
		   echo '
									  
		  </table>
		  <center style="color:red;font-weight:bold;">* When Any INFO/MARK/KEY file is updated then All Branches Previous Uploads and Results will be deleted</center>';
	echo '</div>
	
					<div class="col-md-2">
		            <button class="btn btn-fill btn-danger" onclick="delete_all_branches_result_of_sl('.$sl.')">DELETE <br>ALL BRANCHES<br>MARKS &<br>RESULTS</button>
		            </div>
				
	
		
		

		

		


        <div class="modal-footer">
             
          
        </div>
      </div>
    </div>';

   
    echo'<script>
     $("#tm").mdtimepicker();

      var today = new Date();
    $( "#dt" ).datepicker(
       {
           dateFormat: "dd-mm-yy" ,
           minDate: 0     
       }
    );
  </script>';
	
	exit;
}


//  BLOCK IS FOR ADVANCED--STARTS
if(isset($_POST['save_ias_key_of_sl']))
{
	save_ias_key_of_sl($con);
}

function open_add_edit_imk_modal_of_sl_advanced($con) //CRB not required
{  $sl=$_POST['sl'];
   $res=$con->query("select * from 1_exam_admin_create_exam where sl='$sl'");
   $row=mysqli_fetch_array($res);
   $key_answer_file_long_string=$row['key_answer_file_long_string'];
   if($key_answer_file_long_string=="")
   {
	   for($s=1;$s<=150;$s++)
	   {
		 $key_answer_file_long_string_array[]="";  
	   }
   }
   else
   {
	  $key_answer_file_long_string_array=explode(",",$key_answer_file_long_string); 
   }
   
   
   $model_year=$row['model_year'];
   $paper=$row['paper'];
   $test_code=$row['test_code'];
  //RIYAZ.. Get value from another table .. Answer Key

  echo '<!-- commented  .table thead th:last-child 
		   {
             padding-right: 10px;
		   }-->';
		 echo '<style>
		 .c 
		    {padding:0.5px ! important;
}
		 </style><div class="modal-dialog modal-lg">
      <div class="modal-content" style="    width: 140%;left: -18%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="font-size: 38px;">&times;</button>
          <h4 class="modal-title" style="display:inline;">Key file (.ias) for Test  Code: <span style="font-weight:500;">'.$test_code .'</span> and Exam ID: <span style="font-weight:500">'.$sl.'</span></h4><h4 class="modal-title" style="display:inline;position:relative;    left: 52%;"><!--Last Edited On:11-11-2017--></h4>
        </div>
        <div class="modal-body">
         <div class="row">
            <div class="col-md-12">
              <div class="card">';
			  
			  
	 	   
			   include "z_ias_format.php";
			  
			   $response_array=ias_model_year_paper($model_year,$paper);
			  
			   $sub_array=$response_array[0];
			   $class_array=$response_array[1];
			   $no_of_question_per_section=$response_array[2];
			   $total_q=$response_array[3];
			   $question_number_array=$response_array[4];
			   
			   $temp=$no_of_question_per_section;
			  
               
			 
			  
			   $lc=1;
              $row_c= ceil($no_of_question_per_section/6);
			
			
			
			                      $count=1;
                    $question_series_count=1;
					
                    for($i=1;$i<=3;$i++)
                   {
                 echo ' <h5>'.$sub_array[$i].':</h5>
				
                <table class="table table-bordered">
                    <tbody>';
                        $break=0;
                        $question_series_count=1;
                        for($j=1;$j<=$row_c;$j++)
                        { 
                        echo

                         '<tr>';
                            
                            for($count=1;$count<=6;$count++)
                            {
                                   if($question_series_count<=$no_of_question_per_section)
                                {
                                   echo '<td class="c">'.$question_number_array[$lc-1].'</td>



                                         <td class="c"><input type="text" id="ias'.$lc.'"  class="'.$class_array[$lc].' inpclass" custom="'.$class_array[$lc].'" value="'.$key_answer_file_long_string_array[$lc-1].'"/></td>';  $lc++;




                                         $question_series_count++;
                                         
                                }
                                else
                                { 
                                   //// echo '<td></td>
                                    //     <td></td>';

                                    //$question_series_count=1;
//$
                                }



                            };
                        


                       

                        echo '</tr>';  


                        }




                    
                   echo ' </tbody>
                  </table>';          
        }
			  

			  //
			  echo '</div>
			  </div> <button class="btn btn-info btn-fill pull-right"  onclick="save_ias_key_of_sl('.$sl.','.$total_q.')">SAVE</button>
			  </div></div></div></div>'; 
			   // else end--- for non big matrix block

			  
			  
			  
			  
			  
			  
	
}






function save_ias_key_of_sl($con) //CRB not required
{
	//ADVANCED
	$current_date=current_date_y_m_d();
    $current_time=current_time_12_hour_format_h_m_s();
	$key_answer_file_edited_date_and_time=$current_date." ".$current_time;
	
	
	$sl=$_POST['sl'];

	
	 $ias_array=$_POST['ias_array'];
	 $ias_string=implode(",",$ias_array);
	
	$res=$con->query("select * from 1_exam_admin_create_exam where sl='$sl'");
	$row=mysqli_fetch_array($res);
	$current_ias=$row['key_answer_file_long_string'];

	$model_year=$row['model_year'];
	$paper=$row['paper'];

	include_once "z_ias_format.php";
	$response_array=ias_model_year_paper($model_year,$paper);
	$mark_file_long_string=$response_array[5];
	$to_from_range=$response_array[6];


	
	if($current_ias=="")
	{
		$type="Added";
	}
	else
	{
		$type="Updated";
	}
	
	
	if($ias_string==$current_ias)
	{  echo "same_value";
		exit;
	}
	
	

   //$max_marks=get_max_marks_from_mark_file_long_string_array_string($mark_file_long_string);
   //$marks_to_del=get_marks_deleted($mark_file_long_string,$ias_string);

   //$new_max_marks=$max_marks-$marks_to_del;

   $key_answer_file_long_string=$ias_string;
   $subject_wise_max_marks_string=get_max_marks_subject_wise_string($to_from_range,$mark_file_long_string,$key_answer_file_long_string);
  
//exit;

	//
	
	$originalDate = $current_date;
    $d_m_y = date("d-m-Y", strtotime($originalDate));

	//AUTO COMIT OFF IT
	
	
	//MASTER // WHILE UPDATING WHAT TO DO WITH PREVIOUSLY UPLOADED MARKS.... ?? BEFORE AND AFTER KEY CORRECTION
	
	
	
	$res=$con->query("update 1_exam_admin_create_exam set status_serialized='',key_answer_file_long_string='$ias_string',max_marks='$subject_wise_max_marks_string',key_answer_file_edited_date_and_time='$key_answer_file_edited_date_and_time',edit_status = CONCAT(edit_status, ',Key File@$type On@$d_m_y@$current_time') where sl='$sl'");
	
	//$res2=$con->query("delete from 4_iit_marks_upload where test_code_sl_id='$sl'");
	
	
	if($res)
	{
		echo $type;
	}
	  else
  {
       echo "ajax_error";
  }
	exit;
	
	
	//
	
	
	

}
function get_max_marks_subject_wise_string($to_from_range,$mark_file_long_string,$key_answer_file_long_string) //CRB not required
{

$to_from_range_array=explode(",",$to_from_range);

$mark_file_array=explode(",",$mark_file_long_string);

$key_answer_file_long_string_array=explode(",",$key_answer_file_long_string);
$to_from_range_array=explode(",",$to_from_range);
$no_of_sub=sizeof($to_from_range_array);

//extend marks string
$loop_count=sizeof(explode(",",$mark_file_long_string))/4;
$all_sub_marks_array=array();
$from=0;
$to=1;
$mark=2;

for($i=1;$i<=$loop_count;$i++)
{ $one=$mark_file_array[$from];
  $two=$mark_file_array[$to];
  $this_mark=$mark_file_array[$mark];
    for($m=$one;$m<=$two;$m++)
    {
       $all_sub_marks_array[]=$this_mark;

    }
$from=$from+4;
$to=$to+4;
$mark=$mark+4;
}

//get sub wise max marks - X (Minus X)

$subject_wise_max_marks_array=array();
for($j=1;$j<=$no_of_sub;$j++)
{
  $this_sub_to_from=$to_from_range_array[$j-1];
  $this_sub_to_from_array=explode("-",$this_sub_to_from);  
   $left=$this_sub_to_from_array[0];
  $right=$this_sub_to_from_array[1]; //exit;
  $this_sub_max_marks=0;
     for($k=$left;$k<=$right;$k++)
     {
     	if($key_answer_file_long_string_array[$k-1] !="X")
     	{
     	$this_sub_max_marks=$this_sub_max_marks+$all_sub_marks_array[$k-1];	
     	}       
     }
$subject_wise_max_marks_array[]=$this_sub_max_marks;
}

$subject_wise_max_marks_string=implode(",",$subject_wise_max_marks_array);

return $subject_wise_max_marks_string;



}












if(isset($_POST['approve_delete']))
{
	$this_campus_id=$_POST['this_campus_id'];
	approve_delete($con,$this_campus_id);
}
function approve_delete($con,$this_campus_id)  //CRB REQUIRED=>Done
{
  $sl=$_POST['sl']; 
   $approve_selected=$_POST['approve_selected'];
   $student_id_array=explode(",",$approve_selected);
    $delete_selected=$_POST['delete_selected'];
   $delete_selected_array=explode(",",$delete_selected);
    $delete_count=sizeof($delete_selected_array);
   if($delete_selected=="")
   {
   	$delete_count=0;
   }

   //echo $delete_count;
   //exit;

 $res=$con->query("select omr_scanning_type,subject_string_final,mode from 1_exam_admin_create_exam where sl='$sl'");
 $row=mysqli_fetch_array($res);
 
   $omr_scanning_type=$row['omr_scanning_type']; 
 $test_mode_id=$row['mode'];



$res_table_name=$con->query("select marks_upload_temp_table_name from 0_test_modes where test_mode_id='$test_mode_id'");
$row_table_name=mysqli_fetch_array($res_table_name);

 $marks_upload_temp_table_name=$row_table_name['marks_upload_temp_table_name'];




 $subject_array=array();
 $marks_array=array();

 if($omr_scanning_type=="advanced")
 {
    $subject_array=array();
    $subject_array[]="PHYSICS";
    $subject_array[]="CHEMISTRY";
    $subject_array[]="MATHEMATICS";
 	$total_array=array();
 	$_R_U_W_array=array();

    $marks_array=array();

    if($this_campus_id=="all")
    {
    $res=$con->query("select * from 101_mismatch_approval_request where STUD_ID IN($approve_selected) and  test_sl='$sl' ORDER BY FIND_IN_SET(STUD_ID,'$approve_selected')");	
    }
    else
    {
    $res=$con->query("select * from 101_mismatch_approval_request where STUD_ID IN($approve_selected) and this_college_id='$this_campus_id' and test_sl='$sl' ORDER BY FIND_IN_SET(STUD_ID,'$approve_selected')");
    }
 	
 	
 	while($row=mysqli_fetch_array($res))
 	{
    $p=$row['PHYSICS'];
 	$c=$row['CHEMISTRY'];
 	$m=$row['MATHEMATICS'];
    $three=$p.",".$c.",".$m;
    $marks_array[]=$three;

 	$total_array[]=$row['TOTAL'];
 	$_R_U_W_array[]=$row['Result_String'];




 	}
 }

 else
if($omr_scanning_type=="non_advanced")
{

     $temp=$row['subject_string_final'];  //overriding previous value
     $_R_U_W_array=array();
    
	$res=$con->query("select subject_name from 0_subjects where subject_id IN($temp) ORDER BY FIND_IN_SET(subject_id,'$temp')");
	
	$subject_array=array();
	while($row=mysqli_fetch_array($res))
	{
		$s=$row['subject_name'];
		$subject_array[]=strtoupper($s);
	}
    $marks_array=array();
	
    if($this_campus_id=="all")
    {
    $res=$con->query("select * from 101_mismatch_approval_request where STUD_ID IN($approve_selected) and  test_sl='$sl' ORDER BY FIND_IN_SET(STUD_ID,'$approve_selected')");	
    }
    else
    {
    $res=$con->query("select * from 101_mismatch_approval_request where STUD_ID IN($approve_selected) and this_college_id='$this_campus_id' and test_sl='$sl' ORDER BY FIND_IN_SET(STUD_ID,'$approve_selected')");
    }
	//echo "COUNT=".mysqli_num_rows($res);// exit;
 	
 	while($row=mysqli_fetch_array($res))
 	{
     $marks_array[]=$row['other_subjects_info'];
 	 $total_array[]=$row['TOTAL'];
 	 $_R_U_W_array[]=$row['Result_String'];

 	}

 	//echo json_encode($marks_array); exit;

}

$total_stud=sizeof($marks_array);





	$inside_string="test_code_sl_id,STUD_ID,";
	$subject_name_string=implode(",",$subject_array);
	 $number_of_subject=sizeof($subject_array); //exit;

	$last_string=$inside_string.$subject_name_string.",TOTAL,this_college_id,Result_String";
	
//echo json_encode($student_id_array);
//exit;


	//APPROVING.........


mysqli_autocommit($con,FALSE);

$approval_count=sizeof($student_id_array);
foreach($student_id_array as $key=>$ind_id)



{ //echo "in".$key."in";
	 $line=$marks_array[$key];
	//json_encode($line); //exit;
    $this_R_U_W_string=$_R_U_W_array[$key];

	$mark_line=explode(",",$line); 
   // echo json_encode($mark_line);
    //exit;
	 
	 if($number_of_subject==3)
	 {      $r=$con->query("select CAMPUS_ID from t_student where ADM_NO='$ind_id'");
	        $rw=mysqli_fetch_array($r);
	        $this_campus_id=$rw['CAMPUS_ID'];

			$res1=$con->query("insert into $marks_upload_temp_table_name($last_string)
	values('{$sl}','{$ind_id}','{$mark_line[0]}','{$mark_line[1]}','{$mark_line[2]}','{$total_array[$key]}','{$this_campus_id}','{$this_R_U_W_string}')"); 

            $approved_status=1;

            if($this_campus_id=="all")
            {
            	$current_user_employee_id=$_SESSION['EMPLOYEE_ID'];
            	$res2=$con->query("update 101_mismatch_approval_request set status='$approved_status',approval_status_by='$current_user_employee_id' where STUD_ID='$ind_id' and test_sl='$sl'");
            }
            else
            {   $current_user_employee_id=$_SESSION['EMPLOYEE_ID'];
            	$res2=$con->query("update 101_mismatch_approval_request set status='$approved_status',approval_status_by='$current_user_employee_id' where STUD_ID='$ind_id' and test_sl='$sl' and this_college_id='$this_campus_id'");
            }
			

			//echo "fine"; exit;
	 }
	 
  else
	 if($number_of_subject==4)
	 {          $r=$con->query("select CAMPUS_ID from t_student where ADM_NO='$ind_id'");
	        $rw=mysqli_fetch_array($r);
	        $this_campus_id=$rw['CAMPUS_ID'];
         //echo $last_string; exit;

				$res1=$con->query("insert into $marks_upload_temp_table_name($last_string)
	values('{$sl}','{$ind_id}','{$mark_line[0]}','{$mark_line[1]}','{$mark_line[2]}','{$mark_line[3]}','{$total_array[$key]}','{$this_campus_id}','{$this_R_U_W_string}')"); 

				echo mysqli_error($con);

            $approved_status=1;
			if($this_campus_id=="all")
            {   $current_user_employee_id=$_SESSION['EMPLOYEE_ID'];
            	$res2=$con->query("update 101_mismatch_approval_request set status='$approved_status',approval_status_by='$current_user_employee_id' where STUD_ID='$ind_id' and test_sl='$sl'");
            }
            else
            {   $current_user_employee_id=$_SESSION['EMPLOYEE_ID'];
            	$res2=$con->query("update 101_mismatch_approval_request set status='$approved_status',approval_status_by='$current_user_employee_id' where STUD_ID='$ind_id' and test_sl='$sl' and this_college_id='$this_campus_id'");
            }
	 }

else	 
	if($number_of_subject==5)
	 {          $r=$con->query("select CAMPUS_ID from t_student where ADM_NO='$ind_id'");
	        $rw=mysqli_fetch_array($r);
	        $this_campus_id=$rw['CAMPUS_ID'];
				$res1=$con->query("insert into $marks_upload_temp_table_name($last_string)
	values('{$sl}','{$ind_id}','{$mark_line[0]}','{$mark_line[1]}','{$mark_line[2]}','{$mark_line[3]}','{$mark_line[4]}','{$total_array[$key]}','{$this_campus_id}','{$this_R_U_W_string}')"); 

             $approved_status=1;
			 if($this_campus_id=="all")
            {   $current_user_employee_id=$_SESSION['EMPLOYEE_ID'];
            	$res2=$con->query("update 101_mismatch_approval_request set status='$approved_status',approval_status_by='$current_user_employee_id' where STUD_ID='$ind_id' and test_sl='$sl'");
            }
            else
            {   $current_user_employee_id=$_SESSION['EMPLOYEE_ID'];
            	$res2=$con->query("update 101_mismatch_approval_request set status='$approved_status',approval_status_by='$current_user_employee_id' where STUD_ID='$ind_id' and test_sl='$sl' and this_college_id='$this_campus_id'");
            }
	 }





}
	//echo $delete_count; exit;
	
 //DELETING

if($delete_count>=1)
{
	$deleted_status=2;

	         if($this_campus_id=="all")
            {   $current_user_employee_id=$_SESSION['EMPLOYEE_ID'];
            	$res_del=$con->query("update 101_mismatch_approval_request set status='$deleted_status',approval_status_by='$current_user_employee_id' where STUD_ID IN($delete_selected)  and test_sl='$sl'"); 
            }
            else
            {    $current_user_employee_id=$_SESSION['EMPLOYEE_ID'];
            	$res_del=$con->query("update 101_mismatch_approval_request set status='$deleted_status',approval_status_by='$current_user_employee_id' where STUD_ID IN($delete_selected) and this_college_id='$this_campus_id' and test_sl='$sl'"); 
            }


	
}
//leenuu

if(($delete_count>=1) && ($approval_count>=1))
{

	if($res1 && $res2 && $res_del)
	{
       mysqli_commit($con);
       echo "done";

	}
	  else
  {    mysqli_rollback($con);
       echo "ajax_error";
  }
}


else
	if(($delete_count==0) && ($approval_count>=1))
      {

			if($res1 && $res2)
			{
		       mysqli_commit($con);
		       echo "done";

			}
			  else
		  {    mysqli_rollback($con);
		       echo "ajax_errorxxx";
		  }
      }

else
	if(($delete_count>=1) && ($approval_count==0))
      {

			if($res_del)
			{
		       mysqli_commit($con);
		       echo "done";

			}
			  else
		  {    mysqli_rollback($con);
		       echo "ajax_error";
		  }
      }



//echo mysqli_error($con);
exit;
}

function delete_all_approval_of_sl($con) //exited function
{
  exit;


$sl=$_POST['sl'];

//$res=$con->query("delete from 101_mismatch_approval_request where test_sl='$sl'");
if($res===TRUE)
{

	echo "delete_success";
}

exit;
}



if(isset($_POST['get_approval_filtered_only_content'])) 
{

    $sl=$_POST['sl'];
    $city_id=$_POST['city_id'];
    $college_id=$_POST['college_id'];


	get_approval_filtered_only_content($con,$sl,$city_id,$college_id);
}

function get_approval_filtered_only_content($con,$sl,$city_id,$college_id) //CRB not REQUIRED
{

$res2=$con->query("select * from 1_exam_admin_create_exam  where sl='$sl'");
$row2=mysqli_fetch_array($res2);
$test_mode_id=$row2['mode'];

$omr_scanning_type=$row2['omr_scanning_type'];
$result_generated1_no0=$row2['result_generated1_no0'];

if($omr_scanning_type=="advanced")
{
$subject_string_final="1,2,3";
$student_mark_subject_flow_array=explode(",",$subject_string_final);
}
else
if($omr_scanning_type=="non_advanced")
{
$subject_string_final=$row2['subject_string_final'];//id
$student_mark_subject_flow_array=explode(",",$subject_string_final);
}
   

// if(($city_id !="all") && ($college_id=="all"))
 {
   // $res_now=$con->query("select * from 101_mismatch_approval_request where test_sl='$sl' and status='0' and this_college_id='$college_id' ORDER BY TOTAL DESC");
 }
 
//else
if($college_id !="all")
{
	$res_now=$con->query("select * from 101_mismatch_approval_request where test_sl='$sl' and status='0' and this_college_id='$college_id' ORDER BY TOTAL DESC");
}
else
{
	$res_now=$con->query("select * from 101_mismatch_approval_request where test_sl='$sl' and status='0'  ORDER BY TOTAL DESC");
	
}




 $count_now=mysqli_num_rows($res_now);

 if($count_now==0) 
 {
 	$r=$con->query("select COUNT(*) as count from 101_mismatch_approval_request where test_sl='$sl' and status='0'");
 	$ro=mysqli_fetch_array($r);
 	$cc=$ro['count'];

 	if($cc==0)
 	{
 		echo "All_Deleted"; exit;
 	}
 	else
 	{
 		echo '<center style="color: red;font-weight: bold;">Other Students are Present in Different College.. Change the Input Filter and recheck.. </center>';
 	}
 	
 }



   $temp=$subject_string_final;  //overriding previous value

	$res=$con->query("select subject_name from 0_subjects where subject_id IN($temp) ORDER BY FIND_IN_SET(subject_id,'$temp')");
	
	$subject_array=array();
	while($row=mysqli_fetch_array($res))
	{
		$subject_array[]=$row['subject_name'];
	}


                 echo '<table class="table table-responsive table-hover table-bordered " style="border:1px solid #dec6c6;text-align:center;">';
			  
			  if($result_generated1_no0==0)
			  { echo '<tr><th width="70%">College Name</th><th>Status</th><th>Sl</th><th>Student Id</th>';
			  }
			  else
			  {
			  	echo '<tr><th>Sl</th><th>Student Id</th>';
			  }
                
				
				 foreach($subject_array as $subject_name_individual)
				 { $subject_name_individual=strtoupper($subject_name_individual);
					 echo '<th>'.$subject_name_individual.'</th>';
				 }
				//echo '<th>PHY Marks</th><th>MAT Marks</th><th>BIO Marks</th><th>CHE Marks</th>';
				
                   if($result_generated1_no0==0)
                     {  echo '<th>Total</th>';
                     	 if($count_now>=1){
                     	 	 echo '<th>Approve</th><th>Delete</th>';  
                     	 }
                     	
                     }
                     else
                     {
                     echo '<th>Total</th><th>Section</th><th>Campus</th><th>City</th><th>District</th><th>State</th><th>All India</th>';	
                     }

				
				
				echo '</tr>';

               
                 if($count_now>=1)
                 {
                    $a_int=1;
                    $r=1;
                     while($row_now=mysqli_fetch_array($res_now))
					{

                        if($omr_scanning_type=="advanced")
                        {
                        //$subject_marks_string=$row_now['other_subjects_info'];	
                    
                        $p=$row_now['PHYSICS'];
                        $c=$row_now['CHEMISTRY'];
                        $m=$row_now['MATHEMATICS'];
                        $subject_marks_string=$p.",".$c.",".$m;

                        }
                     else
                      if($omr_scanning_type=="non_advanced")
                        {
                        $subject_marks_string=$row_now['other_subjects_info'];

                        }



                   $subject_marks_array=explode(",",$subject_marks_string);
                          $adm_no=$row_now['STUD_ID'];
                          $res_col_n=$con->query("select CAMPUS_NAME from t_campus where CAMPUS_ID=(select CAMPUS_ID from t_student where ADM_NO='$adm_no')");
                          $row_col_n=mysqli_fetch_array($res_col_n);
                          $c_n=$row_col_n['CAMPUS_NAME'];

						echo '<tr style="background-color:#ff9c7e;"><td style="width:50%;">'.$c_n.'</td><td style="">Approval</td><td>'.$a_int++.'</td><td>'.$adm_no.'</td>';
						foreach($subject_marks_array as $key=>$value)
						{
							echo '<td>'.$value.'</td>';
						}
                      echo '<td>'.$row_now['TOTAL'].'</td>';

                        if($count_now>=1)
                        {
                        	   echo '<td><input type="radio" class="approve" value="'.$row_now['STUD_ID'].'" name="radio'.$r.'"></td>
                               <td><input type="radio" class="delete" value="'.$row_now['STUD_ID'].'" name="radio'.$r++.'"></td>';
                        }
                   
					}

                 }

  echo '</table>';
 



return $count_now;



} //function ends


function display_merged_data($con)
{
	$sl_array_merged=$_POST['sl_array'];
     $result=array();
	foreach($sl_array_merged as $value)
	{
    $sql=$con->query("select ea.sl,ea.test_code,tc.GROUP_NAME,ts.STREAM_NAME,tp.PROGRAM_NAME,tsc.DISPLAY_NAME,tm.test_type_name,m.test_mode_name,ea.model_year,ea.paper,DATE_FORMAT(ea.start_date, '%d-%m-%Y') as start_date from 1_exam_admin_create_exam ea,1_exam_gcsp_id eg,t_course_group tc,t_stream ts,t_program_name tp,t_study_class tsc,0_test_modes m,0_test_types tm where ea.sl='{$value}' and ea.sl=eg.test_sl and eg.GROUP_ID=tc.GROUP_ID and eg.STREAM_ID=ts.STREAM_ID and eg.PROGRAM_ID=tp.PROGRAM_ID and eg.CLASS_ID=tsc.CLASS_ID and ea.test_type=tm.test_type_id and ea.mode=m.test_mode_id");
                    
       while($row=mysqli_fetch_array($sql))
       {
       	$result[]=$row;
       }
     }
    echo ' <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>Exam Sl</th>
        <th>Test Code</th>
        <th>Group</th>
        <th>Class</th>
        <th>Stream</th>
        <th>Program</th>
        <th>Test Type</th>
        <th>Mode</th>
        <th>Model Year</th>
        <th>Exam Date</th>
        
      </tr>
    </thead>
    <tbody>';
    foreach($result as $value)
    {
         echo '<tr><td>'.$value['sl'].'</td><td>'.$value['test_code'].'</td><td>'.$value['GROUP_NAME'].'</td><td>'.$value['DISPLAY_NAME'].'</td><td>'.$value['STREAM_NAME'].'</td><td>'.$value['PROGRAM_NAME'].'</td><td>'.$value['test_type_name'].'</td><td>'.$value['test_mode_name'].'</td><td>'.$value['model_year']. '-'. $value['paper']. '</td><td>'.$value['start_date'].  '</td></tr>';
     } 
    echo'</tbody>
  </table>';
  exit;
 }

function display_exams_data($con)
{
	$sl_exam=$_POST['sl_exam'];
     $result=array();
	
    $sql=$con->query(" select eg.sl,ea.test_code,cg.GROUP_NAME,sc.DISPLAY_NAME,s.STREAM_NAME,pn.PROGRAM_NAME from 1_exam_admin_create_exam ea,1_exam_gcsp_id eg,t_course_group cg,t_study_class sc,t_stream s,t_program_name pn where eg.test_sl='{$sl_exam}' and eg.test_sl=ea.sl and eg.GROUP_ID=cg.GROUP_ID and eg.CLASS_ID=sc.CLASS_ID and eg.STREAM_ID=s.STREAM_ID and eg.PROGRAM_ID=pn.PROGRAM_ID");
                    
       while($row=mysqli_fetch_array($sql))
       {
       	$result[]=$row;
       }
   
    echo '<div> <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>Test Code</th>
        <th>Group</th>
        <th>Class</th>
        <th>Stream</th>
        <th>Program</th>
        <th></th>
        
      </tr>
    </thead>
    <tbody>';
    foreach($result as $value)
    {
         echo '<tr><td>'.$value['test_code'].'</td><td>'.$value['GROUP_NAME'].'</td><td>'.$value['DISPLAY_NAME'].'</td><td>'.$value['STREAM_NAME'].'</td><td>'.$value['PROGRAM_NAME'].'</td><td style="    text-align: center;"><i class="fa fa-trash-o pointer" style="color: red;" onclick="delete_exam('.$value['sl'].','.$sl_exam.')"></i></td></tr>';
     } 
    echo'</tbody>
  </table></div>';
 echo "<div>&nbsp;</div>";

$group_details=array();
$class_details=array();
$stream_detils=array();
$program_details=array();
$state_details=array();
$state_details1=array();
$group=$con->query("select GROUP_ID,GROUP_NAME from t_course_group");
while($row1=mysqli_fetch_array($group))
       {
       	$group_details[]=$row1;
       }
  
  $sql1=$con->query("select state_id from 1_exam_admin_create_exam where sl='{$sl_exam}'");
   $row4=mysqli_fetch_array($sql1);
   $data=$row4['state_id'];
   //$state_id_prev=int($data);

 $states=$con->query("select STATE_ID,STATE_NAME from t_state where STATE_ID NOT IN ($data)");
while($row2=mysqli_fetch_array($states))
       {
       	$state_details[]=$row2;
       } 


        $states1=$con->query("select s.STATE_NAME from t_state s,1_exam_admin_create_exam e where find_in_set(s.STATE_ID,e.state_id) and e.sl='{$sl_exam}'");
while($row3=mysqli_fetch_array($states1))
       {
       	$state_details1[]=$row3['STATE_NAME'];
       } 

     // print_r(json_encode($state_details1));
     // exit;

       $state_names=implode(",",$state_details1);     


 echo '<div >
        
       <div  style="width:23%;    display: inline-block;">
            <div class="form-group" style="    padding-right: 5%;">
			  <label for="sel1">Select Group:</label>
			  <select class="form-control " id="group" style="    height: 40px;" onchange="change_group()">
			    <option>Select Group</option>';
               foreach($group_details as $value)
    			{
         		echo '<option value="'.$value['GROUP_ID'].'">'.$value['GROUP_NAME'].'</option>';
     			} 
			   echo'
			  </select>
			</div>



       </div>

       
       <div class="class" style="width:23%;    display: inline-block;">
            <div class="form-group" style="    padding-right: 5%;">
			  <label for="sel1">Select Class:</label>
			  <select class="form-control" id="class" style="    height: 40px;" >
			    <option>Select Class</option>
			  </select>
			</div>

       </div>
       <div class=" stream"  style="width:23%;    display: inline-block;">
            <div class="form-group" style="    padding-right: 5%;">
			  <label for="sel1">Select Stream:</label>
			  <select class="form-control" id="stream" style="    height: 40px;" >
			   <option>Select Stream</option>
			  </select>
			</div>

       </div>
       <div class="program"  style="width:23%;    display: inline-block;">
            <div class="form-group" style="    padding-right: 5%;">
			  <label for="sel1">Select Program:</label>
			  <select class="form-control" id="program" style="    height: 40px;" >
				<option>Select Program</option>
			  </select>
			</div>

       </div>
      <div  style="width:6%;    display: inline-block;">
      <label for="sel1">&nbsp;</label>
         <button type="button" class="btn btn-primary pull-right" id="add_exam_details" disabled onClick="add_details('.$sl_exam.')" >ADD</button>
      </div>
      
 </div>

     <hr  style="    border-top: 2px solid #52c7eb;"> 
                 <div class="col-md-12">
                 
			  <div class=" col-md-3" style="font-weight: bold;">Selected States</div>
                 <div class=" col-md-9" >'.$state_names.'</div>
     			 
			   
			</div>
             <div class="col-md-12">&nbsp;</div>
             <div class="col-md-12">


             <div class="col-md-4 states_not"    ">
             <div class="form-group">
               <label>Select States</label>
			     <div >
	             <select class="form-control testSelAll SumoUnder states" multiple="multiple">';
               
               foreach($state_details as $value)
    			{
         		echo '<option value="'.$value['STATE_ID'].'">'.$value['STATE_NAME'].'</option>';
     			} 
			   echo'</select>
			</div>
           </div>
           	<script src="sumoselect/jquery.sumoselect.js"></script>
    <script src="sumoselect/sumoselect.js"></script>
       </div>
        
        

       <div class="col-md-4" style="width:6%;   ">
      <label for="sel1">&nbsp;</label>
         <button type="button" class="btn btn-primary pull-right" id="add_states"  onClick="add_states('.$sl_exam.')" >ADD</button>
      </div>

     
    </div>

 ';




  exit;
 }



function display_class($con) //CRB not required
{
	 $group=$_POST['group'];

	 $class=$con->query("select CLASS_NAME,DISPLAY_NAME,CLASS_ID from t_study_class where CLASS_ID in (select CLASS_ID from t_course_track where GROUP_ID = $group )");
       while($row2=mysqli_fetch_array($class))
       {
       	$class_details[]=$row2;
       }
      echo' 
            <div class="form-group" style=" padding-right: 5%;">
			  <label for="sel1">Select Class:</label>
			  <select class="form-control" id="class" style="    height: 40px;" onchange="change_class()">
			    <option>Select Class</option>';
               foreach($class_details as $value)
    			{
         		echo '<option value="'.$value['CLASS_ID'].'">'.$value['DISPLAY_NAME'].'</option>';
     			} 
			   echo'
			  </select>
			</div>';
			  exit;
}
function display_stream($con) //CRB not required
{
	 $group=$_POST['group'];
	 $class_id=$_POST['class_id'];

	 $stream=$con->query("select STREAM_ID,STREAM_NAME from t_stream where STREAM_ID IN (select distinct STREAM_ID from  t_course_track where (STREAM <> 'NULL') and GROUP_ID = $group and CLASS_ID = $class_id)");
       while($row3=mysqli_fetch_array($stream))
       {
       	$stream_details[]=$row3;
       }
      echo' 
           <div class="form-group" style=" padding-right: 5%;">
			  <label for="sel1">Select Stream:</label>
			  <select class="form-control" id="stream" style="    height: 40px;" onchange="change_stream()" >
			   <option>Select Stream</option>';
               foreach($stream_details as $value)
    			{
         		echo '<option value="'.$value['STREAM_ID'].'">'.$value['STREAM_NAME'].'</option>';
     			} 
			   echo'
			  </select>
			</div>';
			  exit;
}


function display_program($con) //CRB not required
{
	 $group=$_POST['group'];
	 $class_id=$_POST['class_id'];
     $stream=$_POST['stream'];
	 $program=$con->query("select PROGRAM_ID,PROGRAM_NAME from  t_program_name where stream_ID = $stream and CLASS_ID = $class_id ");
       while($row4=mysqli_fetch_array($program))
       {
       	$program_details[]=$row4;
       }
      echo' 
          <div class="form-group" style=" padding-right: 5%;">
			  <label for="sel1">Select Program:</label>
			  <select class="form-control" id="program" style="    height: 40px;" onchange="change_program()">
				<option>Select Program</option>';
               foreach($program_details as $value)
    			{
         		echo '<option value="'.$value['PROGRAM_ID'].'">'.$value['PROGRAM_NAME'].'</option>';
     			} 
			   echo'
			  </select>
			</div>';
			  exit;
}

 function add_details($con) //CRB not required
 {
 	$sl=$_POST['sl'];
 	$group=$_POST['group'];
 	$class=$_POST['class_id'];
 	$stream=$_POST['stream'];
 	$program=$_POST['program'];
 	$sql_exam=$con->query("select * from 1_exam_gcsp_id where test_sl='{$sl}' and GROUP_id='{$group}' and CLASS_ID='{$class}' and STREAM_ID='{$stream}' and PROGRAM_ID='{$program}'");
 	$count=mysqli_num_rows($sql_exam);

 	if($count==0)
 	{
	 	$sql_gcsp=$con->query(" insert into 1_exam_gcsp_id(test_sl,GROUP_ID,CLASS_ID,STREAM_ID,PROGRAM_ID) values ('{$sl}','{$group}','{$class}','{$stream}','{$program}')");
	 	if($sql_gcsp)
	 	{
	 		echo "added_success";
	 	}
	 	exit;
    }
    else
    {
    	echo "Duplicate";
    	exit;
    }
 }

//states adding
 function add_states($con) 
 {
 	$new_states=array();
 	$sl=$_POST['stream'];
 	$states=$_POST['states'];
     foreach ($states as $key => $value) {
     	$new_states[]=$value;
     }
 	$states_new=implode(",",$new_states);

 	//echo "here"; echo $sl; exit;
 	
 	$sql=$con->query("select state_id from 1_exam_admin_create_exam where sl='{$sl}'");
 	$row=mysqli_fetch_array($sql);
      
       $state_id=$row['state_id'];
     

       $new_data=$state_id.','.$states_new;
       
     
      $update=$con->query("update 1_exam_admin_create_exam set state_id='{$new_data}' where sl='{$sl}'");
      exit;   
 }

 function delete_exams($con) //CRB not required
 {
 	$sl=$_POST['sl'];
 	$sql_gcsp=$con->query("delete from 1_exam_gcsp_id where sl='{$sl}'");
 	exit;
 }


function generate_rank_of_sl_open_div($con) //CRB not required
{


   $sl=$_POST['sl']; 

  $res=$con->query("select * from 1_exam_admin_create_exam where sl='$sl'");
  $row=mysqli_fetch_array($res);

  $result_generated1_no0=$row['result_generated1_no0'];
  $omr_scanning_type=$row['omr_scanning_type']; // exit;
  $subject_string_final=$row['subject_string_final']; //using this variable bit down down
  $test_code=$row['test_code'];


 $res_re=$con->query("select campus_id,is_uploaded from 1_exam_recompute_request_campus_id where sl='$sl'");
 $count_re=mysqli_num_rows($res_re);
if($count_re>=1)
{
	$is_count=0;
	$campus_name_arr=array();
	 while($row_re=mysqli_fetch_array($res_re))
 {
    $is_uploaded=$row_re['is_uploaded'];
    $campus_id=$row_re['campus_id'];
    if($is_uploaded==1){$is_count++;}
    if($is_uploaded==0)
    {
    	$res_n=$con->query("select CAMPUS_NAME from t_campus where CAMPUS_ID='$campus_id'");
    	$row_n=mysqli_fetch_array($res_n);
    	$campus_name_arr[]=$row_n['CAMPUS_NAME'];

    }
 }

   if($count_re!=$is_count)
   {
   	$campus_name_string=implode(",",$campus_name_arr);
     echo "split".$campus_name_string; exit;

   }
}






  if($result_generated1_no0==1)
  {
  	echo "result_already_generated"; exit;
  }



if($omr_scanning_type !="merged")
{
  $status_serialized=$row['status_serialized'];
  if($status_serialized=="")
  {
    echo "no_branch_uploaded_yet";
  	exit;
  }

}



            $current_date=current_date_d_m_y();
			$current_time=current_time_12_hour_format_h_m_s();
			


		


echo '<formm id="" method="post">
<div  style="background-color: #1dc7ea;color: white; text-shadow: 2px 2px 4px #000000;    margin-bottom: 0px;"> 
                  <div style="     margin-left: 2%;    width: 68%;   display: inline-block;">
             <p>  Test Code: <span style="font-weight:500;">' . $test_code .'</span> </p>
              </div>
               <div style=" display: inline-block;">
                 <span > Last Data as on: '.$current_date.' at '.$current_time.' </span>

                 	 <img src="../assets/img/refresh.png" height="60" width="60" style="display:inline;position:relative;cursor:pointer;    margin-top: -1%; " onclick="generate_rank_of_sl_open_div('.$sl.');">
                 
                 	 <span onclick="close_this_div()"; style="cursor:pointer;"> &nbsp;&nbsp;&nbsp;X </span>
                 	 </div></div>
             '; 
                        
  
  //$res2=$con->query("select campus_name,campus_id as tcid from t_campus where campus_id IN(select distinct this_college_id as cid from 101_mismatch_approval_request where test_sl='$sl' ORDER BY this_college_id)");

  $res2=$con->query("select CAMPUS_NAME,CAMPUS_ID ,CITY_ID from t_campus where CAMPUS_ID IN(select distinct this_college_id from 101_mismatch_approval_request where test_sl='$sl' and status='0' ORDER BY this_college_id)");
                 $city_id_array=array();
                 $campus_id_array=array();
                 $campus_name_array=array();
  	            while($row2=mysqli_fetch_array($res2))
	            {
	            	$city_id_array[]=$row2['CITY_ID'];
	            	$campus_id_array[]=$row2['CAMPUS_ID'];
	            	$campus_name_array[]=$row2['CAMPUS_NAME'];
	            	// echo '<option value="'.$row2['CAMPUS_ID'].'">'.$row2['CAMPUS_NAME'].'</option>';
	            }

	             $city_id_array= array_unique($city_id_array);
	             $city_id_string=implode(",",$city_id_array);


  $count=mysqli_num_rows($res2);
  $jump=0;
  if($count>=1)
  {
     echo ' <div class="row"> <div class="col-md-12">&nbsp;</div>
             <div class="col-md-12">';




            echo '<div class="col-md-2">&nbsp;</div><div class="col-md-3" style="padding:0px;">
            <span style="font-weight: 600;">College Cities &nbsp;</span>
            <select id="city_id" onchange="city_changed_of_sl('.$sl.');">'; 
            $res3=$con->query("select CITY_ID,CITY_NAME from t_city where CITY_ID IN($city_id_string)");
            echo '<option value="all">ALL Cities</option>';
            while($row3=mysqli_fetch_array($res3))
            {
            	 echo '<option value="'.$row3['CITY_ID'].'">'.$row3['CITY_NAME'].'</option>';
            }
            


            echo '</select>

              </div>';


       

              echo '<div class="col-md-4">
              <span style="font-weight: 600;">College Name &nbsp;</span>
                 <select id="college_id" onchange="college_changed_of_sl('.$sl.');">'; 

	            echo '<option value="all">ALL College</option>';
	            
	             foreach($campus_id_array as $key=>$value)
	             {
	             	echo '<option value="'.$campus_id_array[$key].'">'.$campus_name_array[$key].'</option>';
	             }

                    
	         
	          

	            echo '</select>

             </div>';




             echo '</div><div class="col-md-12">&nbsp;</div>
            </div>'; 





// 
	echo '<div class="row" style="max-height:500px; overflow-x:scroll;width: 100%;">
           
            <div class="col-md-offset-2 col-md-8">';

                       echo '<div id="inner_display">';
                       $all="all";
                        $count_now=get_approval_filtered_only_content($con,$sl,$all,$all);
                        echo '</div>';




                   echo '</div>';



                           if($count_now>=1)
                   {
                    echo '<div class="col-md-2"  >
                           <input type="radio" id="approve_all" name="all" style="position:fixed;z-index: 9999;"><span style="position:fixed;z-index: 9999;margin-left: 1%;">Approve All</span><br>
                       <input type="radio" id="delete_all" name="all" style="position:fixed;z-index: 9999;"><span style="position:fixed;z-index: 9999;margin-left: 1%;">Delete All</span><br>
                       <input type="radio" id="reset_all" name="all" style="position:fixed;z-index: 9999;"><span style="position:fixed;z-index: 9999;margin-left: 1%;">Reset All</span><br>
                       <button class="btn btn-success btn-fill" style="position:fixed;z-index: 9999;" onclick="approve_delete('.$sl.')">Approve<br>Delete</button>
                      </div>';
                   }

            ?> <script>
                     $("#approve_all").click(function(){


 $(".approve").each(function(){

    $(this).prop('checked', true);
 });


});

$("#delete_all").click(function(){

 $(".delete").each(function(){

    $(this).prop('checked', true);
 });

});

   
 $("#reset_all").click(function(){


 $(".approve").each(function(){

    $(this).prop('checked', false);
 });

  $(".delete").each(function(){

    $(this).prop('checked', false);
 });

});



                  </script> <?php 


  exit;
  } /*
    echo '<center style="color:red;font-weight: bold;">Approval Pending Students</center>';
    echo '<div style="max-height:500px;overflow-y:scroll;overflow-x: hidden;">
          <div class="row">
          <div class="col-md-offset-1 col-md-6">

    ';
    echo '<center><table class="table table-hover "><tr><th style="width: 20%;">College Name</th><th style="width: 15%;">Total Students</th><th>USN</th></tr>';
     while($row2=mysqli_fetch_array($res2))
     {
     	
         $cn=$row2['campus_name'];
     	 $this_college_id=$row2['tcid'];

       

     	 $res3=$con->query("select * from 101_mismatch_approval_request where test_sl='$sl' and this_college_id='$this_college_id'");
     	 $usn_array=array();
     	 while($row3=mysqli_fetch_array($res3)) 
     	    {
     	    	 $usn_array[]=$row3['STUD_ID'];
               
     	    	 
     	    }
     	    $count=sizeof($usn_array);
     	    $usn_string=implode(", ",$usn_array);
             echo '<tr><td>'.$cn.'</td><td>'.$count.'</td><td style="width:100px;color:blue;">'.$usn_string.'</td></tr>';
     }

     echo '</table></center></div>

      <div col-md-2>
       <span style="color:red;">Contact the College Principal <br>for the Pending Approval <br> </span>
      

     OR..<br> Delete all the Approval Awaiting Students and Generate the Ranking<br>

     <button class="btn btn-fill btn-danger" onclick="delete_all_approval_of_sl('.$sl.')">DELETE</button>

     </div>
  
     </div>
     </div>
 
     ';
     exit;
  	//<button class="btn btn-fill btn-danger" onclick="delete_all_branches_result_of_sl(23)">DELETE ALL <br>APPROVAL AWAITING<br>STUDENTS &amp;<br>GENERATE RANKING</button>
  }
     */
 



                        echo '<center>GENERATE RANK</center>';

?>
   <div class="row">
    <div class="col-md-12">
    <div class="col-md-offset-1 col-md-4">
      <input type="radio" name="radio_type" value="subject_priority"> 
      Select Subject Priority for <span style="color:green;">Rank Generation</span> <br>
      <input type="radio" name="radio_type" value="same_rank" > 
      Same Rank for Same Total <br>
  <?php

  if(($omr_scanning_type=="advanced")||($omr_scanning_type=="merged"))
  {
    $test_mode_subjects_id="1,2,3"; 
  }
  else

  	if($omr_scanning_type=="non_advanced")
  	{
      $test_mode_subjects_id=$subject_string_final;
  	}


   $res2=$con->query("select subject_id,subject_name from 0_subjects where subject_id IN($test_mode_subjects_id) ORDER BY FIND_IN_SET(subject_id,'$test_mode_subjects_id')"); 
   $subject_count=mysqli_num_rows($res2);




  ?>
  <select id='keep-order' multiple='multiple'>
  <?php while($row2=mysqli_fetch_array($res2))
   {
     echo '<option value="'.$row2['subject_id'].'">'.$row2['subject_name'].'</option>';
   }
  ?>
    
    
  </select><br>

      <input type="radio" name="rank_type" value="skip_rank"> 
      Skip Rank <span style="color:green;">1-1-3</span> <br>
      <input type="radio" name="rank_type" value="continuous_rank" > 
      Continuous Rank <span style="color:green;">1-1-2</span> <br>





 <?php echo '<center><button class="btn btn-info btn-fill" onclick="generate_final_rank_of_sl('.$sl.','.$subject_count.',\''.$omr_scanning_type.'\')">Generate Rank</button></center>'; ?>
    </div>

    
       <style>
        #mysection { width: 100%; background-color: #ddd; } #section { width: 10%; height: 30px; background-color: #4CAF50; text-align: center; line-height: 30px; color: white; } 
        #mystream { width: 100%; background-color: #ddd; } #stream { width: 10%; height: 30px; background-color: #4CAF50; text-align: center; line-height: 30px; color: white; } 
        #myprogram { width: 100%; background-color: #ddd; } #program { width: 10%; height: 30px; background-color: #4CAF50; text-align: center; line-height: 30px; color: white; } 
        #mycampus { width: 100%; background-color: #ddd; } #campus { width: 10%; height: 30px; background-color: #4CAF50; text-align: center; line-height: 30px; color: white; } 
        #mycity { width: 100%; background-color: #ddd; } #city { width: 10%; height: 30px; background-color: #4CAF50; text-align: center; line-height: 30px; color: white; } 
        #mydistrict { width: 100%; background-color: #ddd; } #district { width: 10%; height: 30px; background-color: #4CAF50; text-align: center; line-height: 30px; color: white; }
        #mystate { width: 100%; background-color: #ddd; } #state { width: 10%; height: 30px; background-color: #4CAF50; text-align: center; line-height: 30px; color: white; }
        #mycountry { width: 100%; background-color: #ddd; } #country { width: 10%; height: 30px; background-color: #4CAF50; text-align: center; line-height: 30px; color: white; }

       </style>
               <div class="col-md-offset-1 col-md-5">

                 <br>Section Rank<div id="mysection"><div id="section">0%</div></div>
                 Stream Rank<div id="mystream"><div id="stream">0%</div></div>
                 Program Rank<div id="myprogram"><div id="program">0%</div></div>
                 Campus Rank<div id="mycampus"><div id="campus">0%</div></div>
                 City Rank<div id="mycity"><div id="city">0%</div></div>
                 District Rank<div id="mydistrict"><div id="district">0%</div></div>
                 State Rank<div id="mystate"><div id="state">0%</div></div>
                 All India Rank<div id="mycountry"><div id="country">0%</div></div>




               </div>
        </div> <!--md12 close-->
     </div> <!--row close-->

            <?php            
                    echo '
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="select_support/multi-select.css">
                    </div>
                    <div class="form-group hidden" style="color: #847575;">
                        
                       

                   
                </form>
                <center><b style="margin-left:-33%;color: #847575;">Step(2 of 2): Finalizing the Result</b></center>
                <div style="width:80%;position:relative;top:48%;left:10%;z-idex:100000000;"><b>
                <div id="pgb" style="border-bottom: 1px solid #d4acac;color:#6c9e33 ! important;">
                <div class="progress progress_streamtext" data-progress="0" data-progresstext="0 Percent Completed"><div class="progress__bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-valuetext="0 Percent Completed" style="width: 0%;"></div></div></div>
                </b>
                
                <div style="margin-left:88%;"><br>
                
                <button type="button" id="ref_page" class="btn btn-primary">Close</button>
                </div><br>
                
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
  <script src="select_support/jquery.multi-select.js"></script>
  <script type="text/javascript">
  // run pre selected options
  $("#keep-order").multiSelect({ keepOrder: true });

  $("#keep-order").multiSelect({
  selectableHeader: "<div class=\'custom-header\'>Selectable items</div>",
  selectionHeader: "<div class=\'custom-header\'>Selection items</div>",
  selectableFooter: "<div class=\'custom-header\'>Selectable footer</div>",
  selectionFooter: "<div class=\'custom-header\'>Selection footer</div>"
});

$("input[name=radio_type]").change(function(){

var type= $("input[name=radio_type]:checked").val();

if(type=="subject_priority")
{

	$("#ms-keep-order").css("opacity","1");
}
if(type=="same_rank")
{

	$("#ms-keep-order").css("opacity","0.3");
}

});







  </script>';




	exit;
}

function edit_date_time_of_sl($con) //CRB not required
{
  $sl=$_POST['sl'];
  $date=date("Y-m-d", strtotime($_POST['date']));
  $time=date("H:i", strtotime($_POST['time']));

  $res=$con->query("update 1_exam_admin_create_exam set last_date_to_upload='$date',last_time_to_upload='$time' where sl='$sl'");
   if($res)
   {
   	echo "updated";
   }
     else
  {
       echo "ajax_error";
  }

exit;

}


function show_approve_status_of($con) //CRB not required
{
   $sl=$_POST['sl'];
   $college_id=$_POST['college_id'];

       echo '
       <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="    width: 150%;
    margin-left: -28%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Approval Status Details of Exam ID: '.$sl.'</h4>
        </div>
        <div class="modal-body">';

           echo '<table class="table table-hover">
                 <tr><th>Sl</th><th>USN</th><th>Approval Sent By</th><th>Status</th><th>Status By</th><th>Designation</th><tr>
           ';
            $res=$con->query("select * from 101_mismatch_approval_request where test_sl='$sl' and this_college_id='$college_id'");
            $ccc=1;
            while($row=mysqli_fetch_array($res))
            {
                $status=$row['status'];
                $approval_sent_by=$row['approval_sent_by'];
               $approval_status_by=$row['approval_status_by'];
              
               $res2=$con->query("select USER_NAME from t_employee where EMPLOYEE_ID='$approval_sent_by'");
               $row2=mysqli_fetch_array($res2);
               $approval_sent_name=$row2['USER_NAME'];


               if($approval_status_by !="")
               {
               	 $res3=$con->query("select USER_NAME,DESIGNATION from t_employee where EMPLOYEE_ID='$approval_status_by'");
               }
              else
              	if($approval_status_by =="")
              	{
              	  $res3=$con->query("select USER_NAME,DESIGNATION from t_employee where EMPLOYEE_ID='$approval_sent_by'");  
              	}



               $row3=mysqli_fetch_array($res3);
                $approval_status_by_name=$row3['USER_NAME'];
                $desig=$row3['DESIGNATION'];
               //
               if($status==1)
               {
               	$output="Approved";
               	$colour="green";
               }
                   if($status==2)
               {
               	$output="Deleted";
               	$colour="black";
               }
                 if($status==0)
               {
               	$output="Approval Requested";
               	$colour="red";
               	$approval_status_by_name=$approval_sent_name;
               }


               echo '<tr><td>'.$ccc++.'</td><td>'.$row['STUD_ID'].'</td><td>'.$approval_sent_name.'</td><td style="color:'.$colour.'">'.$output.'</td><td>'.$approval_status_by_name.'</td><td>'.$desig.'</td></tr>';


            }
             echo '<table>';




        echo '</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>';


	exit;
}




function open_reprocess_modal_of_sl($con) //CRB not required
{
$sl=$_POST['sl'];

$res=$con->query("select result_generated1_no0 from 1_exam_admin_create_exam where sl='$sl'");
$row=mysqli_fetch_array($res);
$result_generated1_no0=$row['result_generated1_no0'];


				               $res_recompute=$con->query("select * from 1_exam_recompute_request_campus_id where sl='$sl'");
				               $count_recompute=mysqli_num_rows($res_recompute);



if(($result_generated1_no0==1) && ($count_recompute==0))
{
	//result is generated but college is not added for reuploading....show R icon data...
}
else

if(($result_generated1_no0==0) && ($count_recompute>0))
 {
    // result generated became 0 and some colleges have been added for reuploading...show R icon data...
 }
   else
   {
   	 $res=$con->query("update 1_exam_admin_create_exam set result_generated1_no0='1' where sl='$sl'");
      echo "result_not_generated"; exit;
   }

	

/*
if(($result_generated1_no0==1) &&($count_recompute==0))
{
	echo "result_not_generated"; exit;
}
*/

	echo '
     <div class="modal-dialog modal-lg">
      <div class="modal-content" style="    width: 125%;left: -13%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="font-size:38px;">×</button>
          <div style="    width: 56%;    display: inline-block;">
          <h4 class="modal-title" style="display:inline;">Branch Wise Uploaded Status for Test: <span style="font-weight:500;">J-MPC-IIT-P1-WE-T3</span></h4>
          	</div>
          	<div style=" display: inline-block;">
          <h4 class="modal-title" style="display:inline;">
		  Last Data as on: 02-07-2018 at 18:45:46</h4>
		   
		   <img src="../assets/img/refresh.png" height="60" width="60" style="display:inline;cursor:pointer;    margin-top: -1%;" onclick="reprocess_modal_of_sl('.$sl.');">
		  </div>
        </div>
        <div class="modal-body">
         <div class="row" style="min-height:500px;">
		 <div class="col-md-offset-1 col-md-10">



 <style type="text/css">
        .sumo_name_will_become_class{
            position: absolute;
        }
        .select-all {height:37px!important;}
    </style>';
    echo '<script type="text/javascript">
        $(document).ready(function () {
            window.asd = $(".SlectBox").SumoSelect({ csvDispCount: 3, selectAll:true, captionFormatAllSelected: "Yeah, OK, so everything." });
            window.test = $(".testsel").SumoSelect({okCancelInMulti:true, captionFormatAllSelected: "Yeah, OK, so everything." });

            window.testSelAll = $(".testSelAll").SumoSelect({okCancelInMulti:true, selectAll:true });

            window.testSelAll2 = $(".testSelAll2").SumoSelect({selectAll:true});

            window.testSelAlld = $(".SlectBox-grp").SumoSelect({okCancelInMulti:true, selectAll:true, isClickAwayOk:true });

            window.Search = $(".search-box").SumoSelect({ csvDispCount: 3, search: true, searchText:"Enter here." });
            window.sb = $(".SlectBox-grp-src").SumoSelect({ csvDispCount: 3, search: true, searchText:"Enter here.", selectAll:true });
            window.searchSelAll = $(".search-box-sel-all").SumoSelect({ csvDispCount: 3, selectAll:true, search: true, searchText:"Enter here", okCancelInMulti:true });
            window.searchSelAll = $(".search-box-open-up").SumoSelect({ csvDispCount: 3, selectAll:true, search: false, searchText:"Enter here.", up:true });
            window.Search = $(".search-box-custom-fn").SumoSelect({ csvDispCount: 3, search: true, searchText:"Enter here.", searchFn: function(haystack, needle) {
              var re = RegExp("^" + needle.replace(/([^\w\d])/gi, "\\$1"), "i");
              return !haystack.match(re);
            } });

            window.groups_eg_g = $(".groups_eg_g").SumoSelect({selectAll:true, search:true });


            $(".SlectBox").on("sumo:opened", function(o) {
              console.log("dropdown opened", o)
            });

        });
    </script>';


$file_array=scandir("../../College/3_view_created_exam/uploads/$sl/final/");
//echo json_encode($file_array);
echo
'<div style=" width:100px; height: 52px; overflow: hidden;">
    <select name="name_will_become_class" id="college_id" multiple="multiple" placeholder="Select College" onchange="college_id('.$sl.')" class="search-box-sel-all">';

foreach($file_array as $key=>$individual_file_name)
{
  if(($individual_file_name==".") || ($individual_file_name=="..")) continue;
  $exploded_array=explode(".",$individual_file_name);
  $college_id=$exploded_array[0];
  $res=$con->query("select CAMPUS_NAME from t_campus where CAMPUS_ID='$college_id'");
  while($row=mysqli_fetch_array($res))
  {
    $campus_name=$row['CAMPUS_NAME'];
    $campus_id=$row['CAMPUS_ID'];
 echo '<option value="'.$college_id.'">'.$campus_name.'</option>';

  }


}
    echo '</select>
</div>';


//get_campuses_down($con,$sl);

    echo '







<div id="append">



</div>






		  </div>
		</div>
        <div class="modal-footer">
             
          
        </div>
      </div>
    </div></div>


'



	;


	exit;
}



function get_campuses_down($con,$sl)  // CRB required=>Done
{


//echo "run";

	
mysqli_autocommit($con,FALSE);
$college_id=array();



//$college_id[]=5;

if(isset($_POST['college_id'])) //Array...
{
	$college_id=$_POST['college_id'];
    //make rankgenerated as 0
    $size=sizeof($college_id);



    //echo $college_id[0];exit;
    if(($size>0) && ($college_id[0] !=""))
    {
    $zero="0";
	   $res_update=$con->query("update 1_exam_admin_create_exam set result_generated1_no0='$zero' where sl='$sl'");
    }




}

//echo json_encode($college_id);



$res_status_ser=$con->query("select status_serialized,is_college_id_mobile_uploaded from 1_exam_admin_create_exam where sl='$sl'");
$row_status_ser=mysqli_fetch_array($res_status_ser);
$status_serialized_string=$row_status_ser['status_serialized'];
$status_non_serialized_array=unserialize($status_serialized_string);

$is_college_id_mobile_uploaded=$row_status_ser['is_college_id_mobile_uploaded'];
$is_college_id_mobile_uploaded_array=explode(",",$is_college_id_mobile_uploaded);


//echo json_encode($college_id); exit;

foreach($college_id as $individual_college_id)
{
//echo "innn";exit;
$resa=$con->query("select * from 1_exam_recompute_request_campus_id where campus_id='$individual_college_id' and sl='$sl'");
$counta=mysqli_fetch_array($resa);


$resb="1";
if($counta==0)
{
	$resb=$con->query("insert into 1_exam_recompute_request_campus_id(sl,campus_id)values('{$sl}','{$individual_college_id}')");

	//echo "resb=".$resb;
	echo mysqli_error($con); 
}

 unset($status_non_serialized_array[$individual_college_id]);


//removing the college id's from is_mobile_college_uploaded

       foreach (array_keys($is_college_id_mobile_uploaded_array,$individual_college_id) as $key)
            { //echo $individual_college_id;
			    unset($is_college_id_mobile_uploaded_array[$key]);
			}

//echo json_encode($is_college_id_mobile_uploaded_array)."--"; 


}

$is_college_id_mobile_uploaded_string=implode(",",$is_college_id_mobile_uploaded_array);

$status_serialized=serialize($status_non_serialized_array);
$res_update2=$con->query("update 1_exam_admin_create_exam set status_serialized='$status_serialized',is_college_id_mobile_uploaded='$is_college_id_mobile_uploaded_string' where sl='$sl'");




if($res_update && $res_update2 && $resb)
{
	mysqli_commit($con);
}




else
{
	mysqli_rollback($con);
}



//$resa=$con->query("select ");

echo '<table class="table table-hover table-bordered">
	<tbody><tr><th>Sl</th><th>Branch Name</th><th>Request for Re-upload</th><th>Campus Upload Status</th><th style="color:red;"><i class="fa fa-trash-o"></i></th></tr> </tbody>';
  $res=$con->query("select sl_auto,campus_id,is_uploaded from 1_exam_recompute_request_campus_id where sl='$sl' ");
  $c=1;
   $count=mysqli_num_rows($res);
  if($count>=1)
  {
   while($row=mysqli_fetch_array($res))
   {
   	  $sl_auto=$row['sl_auto'];
      $campus_id=$row['campus_id'];
      $is_uploaded=$row['is_uploaded'];
      $res2=$con->query("select CAMPUS_NAME from t_campus where CAMPUS_ID='$campus_id'");
      $row2=mysqli_fetch_array($res2);
      $campus_name=$row2['CAMPUS_NAME'];
      $status=$is_uploaded==0?"Didnt upload yet" :"Campus Uploaded again";
      $color=$is_uploaded==0?"red" :"green";
      $m='<i class="fa fa-trash-o pointer" style="color:red;cursor:pointer;"onclick="del_campus_req('.$sl_auto.','.$sl.')"></i>';

      
      echo '<tr><td>'.$c++.'</td><td>'.$campus_name.'</td><td style="color:blue">"Permitted to Upload"</td><td style="color:'.$color.'">'.$status.'</td><td>'.$m.'</td></tr>';
   }


  }


//$res=$con->query("");
echo '
    </table>';

}




function del_campus_req($con) //CRB not required
{

	$sl_auto=$_POST['sl_auto'];
	//echo $sl_auto."oo";
	$res=$con->query("delete from 1_exam_recompute_request_campus_id where sl_auto='$sl_auto'");
	$affected_rows= mysqli_affected_rows($con);
	if($affected_rows==1)
	{
		echo "deleted_success";
	}







  else
  {
       echo "ajax_error";
  }


	
	exit;
}


//  BLOCK IS FOR ADVANCED--ENDS
?>



<script>
$("#mstart1").val(1);
$(".mleft").prop("disabled", true);
$(".mleft").css("background","#efd6d6");

function insert_info_file_of_sl(sl,total_subject)
 {
	 	var this_error_flag=0;
		$(".left").each(function(){
			var this_left_val=$(this).val();
			if(this_left_val=="")
			{
				this_error_flag=1;
				$(".left").val('');
				$(".right").val('');
				$("#start1").val(1);
				
			}
			
			//return false;
		});
		if(this_error_flag==1)
		{
			alert("Insert Once again from Starting Slowly...!!");
				return false;
		}
		
		var to_from_range="";
		var subject_string_final_array=[];
		
	 var loop=1;
	 var error_plug=0;
	 for(loop=1;loop<=total_subject;loop++)
	 { //for start
	var end_val= $("#end"+loop).val();
	var start_val=$("#start"+loop).val();
	var total_question=0;
	if(to_from_range=="")
	{
		to_from_range=to_from_range+start_val+"-"+end_val;
		total_questions=(+end_val);
	}
	else
	{
		to_from_range=to_from_range+","+start_val+"-"+end_val;
		total_questions=(+end_val);
	}
	subject_string_final_array.push($("#sub"+loop).html());

	
	
	
	//alert(start_val+"--"+end_val);
	if(+end_val < +start_val)
	{ //alert("end is less than start");
		$("#start"+loop).css("background","red");
		$("#end"+loop).css("background","red");
		error_plug=1;
		
	}else
	{ //alert("end is more than start");
		$("#start"+loop).css("background","white");
		$("#end"+loop).css("background","white");
	}
	
	
	
	 } // for end
	 
	 if(error_plug==1)
	 {  alert("Insert the Range Correctly...!!");
		return false; 
	 }
	 //alert(to_from_range);
	 var insert_info_file_of_sl="yes";
	  $.ajax({
		       url:"ajax_php.php",
			   data:{insert_info_file_of_sl:insert_info_file_of_sl,to_from_range:to_from_range,subject_string_final_array:subject_string_final_array,total_questions:total_questions,sl:sl},
			   type:"POST",
			   success:function(data)
			   {
				   data=data.trim();
				   alert(data);
				   localStorage.setItem("inc_reset_status","final");
				   add_edit_imk_modal_of_sl(sl);

				   					  
					  	if(data=="ajax_error")
					  	{
                            alert("There was an error occured during the process.. Please try again.. or contact application admin");
					  		return false;
					  	}

			   }
		  
	        });
	 
	 
	 return false;
	 
	 
		var start_string="";
		var end_string="";
		var start_array=[];
		start_array.push(0);
		var end_array=[];
		end_array.push(0);
		var colour_count=1;
		var colour_array=[];
		colour_array.push("yellow");colour_array.push("red");colour_array.push("blue");colour_array.push("orange");colour_array.push("pink");
		var one_error_colour="violet";
		var initial_range_error=0;
		
		
	
	var i=1;
	for(i=1;i<=total_subject;i++)
	{
      this_start_value=$("#start"+i).val();
	  start_array.push(this_start_value);
	  
	  this_end_value=$("#end"+i).val();
	  end_array.push(this_end_value);
	 
      
		
	}
	var j=1;
	
	for(j=1;j<=total_subject;j++)
	{
	
		if(j>=2)
		{
		    if( (+start_array[j]) != ( +end_array[j-1]+ +1))
		{
			initial_range_error=1;
			//alert("Invalid Range");
			$("#start"+j).css("background",colour_array[colour_count]);
			$("#end"+(j-1)).css("background",colour_array[colour_count++]);
			
		}
		
		else
		    {
			 			$("#start"+j).css("background","white");
			            $("#end"+(j-1)).css("background","white");
		    }
		
		}
		
					if(start_array[1] !=1)
		{
			$("#start1").css("background",one_error_colour);
			initial_range_error=1;
		}
		else
		{
			$("#start1").css("background","white");
		}
		


		
		
	}
	if(initial_range_error==1)
	{
		alert("Invalid Range...Recheck Again"); return false;
	}
	
}

$(".right").keyup(function(){
	
	var this_value=$(this).val();
	if(this_value !="")
	{
			this_value++;
	var this_id=$(this).attr('temp');
	
	
	
	var end_val= $("#end"+this_id).val();
	var start_val=$("#start"+this_id).val();
	//alert(start_val+"--"+end_val);
	if(+end_val < +start_val)
	{
		$("#start"+this_id).css("background","red");
		$("#end"+this_id).css("background","red");
		
	}else
	{
		$("#start"+this_id).css("background","white");
		$("#end"+this_id).css("background","white");
	}
	
	
	
	this_id++;
	$("#start"+this_id).val(this_value);
	}

	
	
});

function delete_and_edit_info_and_mark_of_sl(sl)
{
	if(!confirm("This will Delete Info-Key-Answer Key File... \n Deleting this will also Delete All the Branches Uploaded Marks and Results.\n Are You Sure You want to Delete?	"))
	{
		return false;
	}
	
	

	var delete_and_edit_info_and_mark_of_sl="yes";
	$.ajax({
		     url:"ajax_php.php",
			 data:{delete_and_edit_info_and_mark_of_sl:delete_and_edit_info_and_mark_of_sl,sl:sl},
		     type:"POST",
			 success:function(data)
			 {
				 data=data.trim();
				 alert(data);
				 localStorage.setItem("inc_reset_status","final");
				 add_edit_imk_modal_of_sl(sl);

                 if(data=="ajax_error")
					  	{
                            alert("There was an error occured during the process.. Please try again.. or contact application admin");
					  		return false;
					  	}


			 }
	      });
}


$(".mright").keyup(function(){
	
	
	var total_question=$(this).attr('total_questions');
	
	var this_value=$(this).val();
	if(this_value !="")
	{
			this_value++;
	var this_id=$(this).attr('mtemp');
	
	
	
	var mend_val= $("#mend"+this_id).val();
	var mstart_val=$("#mstart"+this_id).val();
	//alert(start_val+"--"+end_val);
	if(+mend_val < +mstart_val)
	{
		$("#mstart"+this_id).css("background","red");
		$("#mend"+this_id).css("background","red");
		
	}else
	{
		$("#mstart"+this_id).css("background","white");
		$("#mend"+this_id).css("background","white");
	}
	
	if(+mend_val< +total_question)
	{
	$("#mark_store").addClass('hidden');	
	this_id++; //alert(this_id);
	$("#mrow"+this_id).removeClass('hidden');
	$("#mstart"+this_id).val(this_value);
	}
	else if(+mend_val ==+total_question)
	{
		this_id++; //alert(this_id);
		var s=this_id;
		for(s=this_id;s<=10;s++)
		{
			$("#mstart"+s).val('');
			$("#mend"+s).val('');
			$("#mpositive"+s).val('');
			$("#mnegative"+s).val('');
			
			$("#mpositive"+s).css("background","white");
			$("#mnegative"+s).css("background","white");
			$("#mrow"+s).addClass('hidden');
			
		}
		$("#mark_store").removeClass('hidden');
		
	}
		else if(+mend_val >+total_question)
	{
		$("#mark_store").addClass('hidden');
		var reset=this_id;
		this_id++; 
		var s=this_id;
		for(s=this_id;s<=10;s++)
		{
			$("#mstart"+s).val('');
			$("#mend"+s).val('');
			$("#mpositive"+s).val('');
			$("#mnegative"+s).val('');
			$("#mrow"+s).addClass('hidden');
		}
		
		
		$("#mend"+reset).val('');
		alert("Range Exceeded...!!");
	}
	
	
	
	}

	
	
});



function insert_mark_file_of_sl(sl,total_question)
 {   var mark_file_long_string_array=[];
	 
	 
	 var mark_file_long_string="";
	 
	 //var total_question=80;
	  $(".mright").each(function(){
		 
		var this_val=$(this).val();
		//alert("thisval="+this_val);
		if(+this_val== +total_question)
		{
			var row_length= $(this).attr('mtemp');
			//alert("rowlength="+row_length);
		
		
		
		var iterate=1;
		var error_track=0;
		//alert("befor for start");
		for(iterate=1;iterate<=row_length;iterate++)
		{ //alert("count");
			var mstart=$("#mstart"+iterate).val();
			var mend  =$("#mend"+iterate).val();
			if(+mend <+mstart)
			{   error_track=1;
				$("#mstart"+iterate).css("background","red");
				$("#mend"+iterate).css("background","red");
				
			}
			else
			{
			    $("#mstart"+iterate).css("background","white");
				$("#mend"+iterate).css("background","white");	
			}
		}
		 if(error_track==1)
		 {
			 alert("Error in Range"); return false;
		 }
		 
		 var this_loop=1;
		 var here_count=0;
		 var mark_neg_flag=0;
		 for(this_loop=1;this_loop<=row_length;this_loop++)
		 {
			 var this_mpositive=$("#mpositive"+this_loop).val();
			 var this_mnegative=$("#mnegative"+this_loop).val();
			 //alert(this_mnegative);
			 if((this_mpositive=="") || (this_mnegative==""))
			 { //alert(+this_mnegative);
			 	if(this_mnegative<0)
			 		{mark_neg_flag++;
			 		$("#mnegative"+this_loop).css("background","#efd6d6"); }
				 here_count++;
				 $("#mpositive"+this_loop).css("background","#efd6d6");//lol
				 $("#mnegative"+this_loop).css("background","#efd6d6");
				 
			 }
			 else
			 {   if(this_mnegative<0)
			 		{mark_neg_flag++;

                     $("#mnegative"+this_loop).css("background","#efd6d6"); 
			 		}
				 $("#mpositive"+this_loop).css("background","white");
				 $("#mnegative"+this_loop).css("background","white"); 
			 }
			 
			 var i_mstart=$("#mstart"+this_loop).val();	
             mark_file_long_string_array.push(i_mstart);			 
			 var i_mend=$("#mend"+this_loop).val();
			 mark_file_long_string_array.push(i_mend);
			 var i_mpositive=$("#mpositive"+this_loop).val();
			 mark_file_long_string_array.push(i_mpositive);
			 var i_mnegative=$("#mnegative"+this_loop).val();
			 mark_file_long_string_array.push(i_mnegative);
			 
			  
		 }
		   if(here_count>0)
		   {
			   alert("Enter All Positive and Negative Marks"); return false;
		   }
		 
		  if(mark_neg_flag>0)
		  { alert("Input Negative Mark without Negative (-) Sign");
		  	return false;
		  }
		 //alert(mark_file_long_string_array);
		     //var t=count(mark_file_long_string_array);alert(count);
			 
		       var insert_mark_file_of_sl="yes";
		       $.ajax({
			             url:"ajax_php.php",
						 data:{insert_mark_file_of_sl:insert_mark_file_of_sl,mark_file_long_string_array:mark_file_long_string_array,sl,sl,
						 row_length:row_length,},
						 type:"POST",
						 success:function(data)
						 {
							 data=data.trim();
							 alert(data);
							 add_edit_imk_modal_of_sl(sl);
				                             
				                 if(data=="ajax_error")
				              {
				                alert("There was an error occured during the process.. Please try again.. or contact application admin");
				                return false;
				              }


						 }
						 
			 
		             });
		       
		     
		 
		 }
		
		});
		 
	      
	 
	
			
 }

function insert_key_answer_file_of_sl(sl,total_questions,insert_or_update)
{
	//insert_or_update    1is insert,2 is update
	//alert(insert_or_update);
	var type="";
	if(insert_or_update==1) {type="Added"}else
	if(insert_or_update==2) {type="Updated"}
	
	var error_here=0;
    var input_error=0;

	$(".key").each(function(){
		
		var this_value=$(this).val();
           //  A2        A2       A2      A3     A3          A4              B2     B2        B3        C
		   //OR-A-B  OR-A-C  OR-A-D   OR-A-B-C  OR-A-C-D   OR-A-B-C-D      OR-B-C  OR-B-D  OR-B-C-D   OR-C-D 



		//alert(this_value);
		if( (this_value!="A") &&(this_value!="B")&&(this_value!="C")&&(this_value!="D")&&(this_value!="G")&&(this_value!="X")&&(this_value!="OR-A-B")&&(this_value!="OR-A-C")
			&&(this_value!="OR-A-D")&&(this_value!="OR-A-B-C")&&(this_value!="OR-A-C-D")&&(this_value!="OR-A-B-C-D")&&(this_value!="OR-B-C")&&(this_value!="OR-B-D")
			&&(this_value!="OR-B-C-D")&&(this_value!="OR-C-D"))
		{
			$(this).css("background","#efd6d6");
			error_here=1;
		}
		else
		{
			$(this).css("background","white");
		}





	});
	
	if(error_here==1){alert("Insert A/B/C/D as the Input \n For \"OR\" Type of Question follow the Pattern OR-A-B"); return false;}
	
	var loop=1;
	var key_answer_array=[];
	for(loop=1;loop<=total_questions;loop++)
	{
	 var this_value=$("#key"+loop).val();
	 key_answer_array.push(this_value);
	}
	
	var insert_key_answer_file_of_sl="yes";
	$.ajax({
		    url:"ajax_php.php",
			data:{insert_key_answer_file_of_sl:insert_key_answer_file_of_sl,sl:sl,key_answer_array:key_answer_array,type:type},
			type:"POST",
			success:function(data)
			{
				data=data.trim();
				//alert(data);
				
				if(data=="same_as_before")
				{
					alert("Key is not updated.. Because its same as the last one");
					add_edit_imk_modal_of_sl(sl);
				}
				else
					if(data=="success")
					{
						alert("Key answer "+type+" Successfully");
						add_edit_imk_modal_of_sl(sl);
					}
               else
                 if(data=="ajax_error")
              {
                alert("There was an error occured during the process.. Please try again.. or contact application admin");
                add_edit_imk_modal_of_sl(sl);
                return false;
              }
            
				
			}
		
	      });
	
} 

function edit_key_answer_file_of_sl(sl)
{
	//alert(sl);
	
	var edit_key_answer_file_of_sl="yes";
	$.ajax({
		    url:"ajax_php.php",
			data:{edit_key_answer_file_of_sl:edit_key_answer_file_of_sl,sl:sl},
			type:"POST",
			success:function(data)
			{
				data=data.trim();
				//alert(data);
				//add_edit_imk_modal_of_sl(sl);
				$("#key_answer_div").html(data);
			}
		
		
	      });
	
	
}


</script>


<script> //BELOW ARE ADVANCED JQUERY
$(".s").each(function(){
$(this).attr("placeholder","Single answer type");	
	
});
$(".i").each(function(){
$(this).attr("placeholder","Integer type");	
	
});
$(".m").each(function(){
$(this).attr("placeholder","Multiple Correct");	
	
});
$(".cs").each(function(){
$(this).attr("placeholder","Comprehension Sin");	
	
});
$(".cm").each(function(){
$(this).attr("placeholder","Comprehension Mul");	
	
});
$(".ms").each(function(){
$(this).attr("placeholder","Matrix Single");	
	
});

$(".mb").each(function(){
$(this).attr("placeholder","Matrix PQRST");	
	
});


$(".s,.cs,.ms").keyup(function(){
	
	$(this).css("background","white");
	var current_val=$(this).val(); //alert(current_val);

    var first_one= current_val.substring(0, 1);
	var first_two = current_val.substring(0, 2);
	length=current_val.length;

    if(first_one=="O") {

    }
     else
		if((current_val=="") ||(current_val=="A") || (current_val=="B") || (current_val=="C") || (current_val=="D") || (current_val=="X") || (current_val=="G"))
	{
		
	}
	else
		if(length>1){$(this).val(''); alert("Only one of A/B/C/D Should be entered..Input Length Exceeded!!"); return false;}
	else
	{
		$(this).val(''); alert("Only one of A/B/C/D Should be entered..\n Enter \"X\" to delete the question \n Enter \"G\" to give the Grace Marks !!"); return false;
	}
	
	//alert(length);
	

});

$(".i").keyup(function(){
	$(this).css("background","white");
	var current_val=$(this).val(); //alert(current_val);
    var first_one= current_val.substring(0, 1);
	var first_two = current_val.substring(0, 2);
	length=current_val.length;

    if(first_one=="O") {

    }

	else
		if((current_val>=0) && (current_val<=9))
	{
		
	}

	else if((current_val=="X") || (current_val=="G"))
	{

	}
	else
	 if(length>1){$(this).val(''); alert("Only one number from 0 to 9 Should be entered..Input Length Exceeded !!"); return false;}
    else
	{
		$(this).val(''); alert("Only one number from 0 to 9 Should be entered..\n Enter \"X\" to delete the question \n Enter \"G\" to give the Grace Marks !!"); return false;
	}
	
	
	
	

	
});

$(".m,.cm").keyup(function(){
	$(this).css("background","white");
var current_val=$(this).val();

    var first_one= current_val.substring(0, 1);
	var first_two = current_val.substring(0, 2);
	length=current_val.length;

    if(first_one=="O") {

    }
     else

		if((current_val=="A") ||(current_val=="AB") || (current_val=="AC") || (current_val=="AD") || (current_val=="ABC") ||
		   (current_val=="ABD") ||(current_val=="ACD") || (current_val=="ABCD") || (current_val=="B") || (current_val=="BC") ||
	  (current_val=="BD") ||(current_val=="BCD") || (current_val=="C") || (current_val=="CD") || (current_val=="D") ||
	   (current_val=="") || (current_val=="X") || (current_val=="G")) 
	{
		
	}
	else
	{
		$(this).val(''); alert("Only one or Multiple of A/B/C/D Should be entered..\n Enter \"X\" to delete the question \n Enter \"G\" to give the Grace Marks !!"); return false;
	}	
	
	
});





$(".mb").keyup(function(){  //matrix big.. PQRST custom validation
	$(this).css("background","white");
var current_val=$(this).val();
    var first_one= current_val.substring(0, 1);
	var first_two = current_val.substring(0, 2);
	length=current_val.length;

    if(first_one=="O") {

    }

	else

		if((current_val=="") || (current_val=="P") ||(current_val=="PQ") ||  (current_val=="PR") ||(current_val=="PS") ||(current_val=="PT") ||(current_val=="PQR") ||(current_val=="PQS") ||(current_val=="PQT") ||(current_val=="PRS") ||(current_val=="PRT") ||(current_val=="PST") ||(current_val=="PQRS")||(current_val=="PQRT")||(current_val=="PQST") ||(current_val=="PQRST") ||(current_val=="Q") ||(current_val=="QR") ||(current_val=="QS") ||(current_val=="QT") ||(current_val=="QRS") ||(current_val=="QRT") ||(current_val=="QST") ||(current_val=="QRST") ||(current_val=="R") ||(current_val=="RS") ||(current_val=="RT") ||(current_val=="RST")||(current_val=="S")||(current_val=="ST")||(current_val=="T")||(current_val=="X")||(current_val=="G"))
	{
		
	}
	else
	{
		$(this).val(''); alert("Only one or Multiple of P/Q/R/S/T Should be entered..\n Enter \"X\" to delete the question \n Enter \"G\" to give the Grace Marks !!"); return false;
	}	
	
	
});






</script>



