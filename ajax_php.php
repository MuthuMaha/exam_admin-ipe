<?php
include_once '../../secure_login/includes/functions.php';
sec_session_start();
if($_SESSION['is_exam_admin']==false)
{
    Header('Location:../../secure_login/'); 
}


//
// mysqli_autocommit($con,FALSE);
// mysqli_commit($con);
// mysqli_rollback($con);


//


require("../000_main_includes/config.php");
require("../000_main_includes/common_functions.php");

if(isset($_POST['show_group_list']))
{
	show_group_list($con);
}

if(isset($_POST['show_test_modes']))
{
	show_test_modes($con);
}

if(isset($_POST['show_year_list']))
{
	show_year_list($con);
}

if(isset($_POST['show_stream_list']))
{
	show_stream_list($con);
}

if(isset($_POST['show_program_name_list']))
{
	show_program_name_list($con);
}
if(isset($_POST['show_program_name_list2']))
{
	show_program_name_list2($con);
}
if(isset($_POST['show_model_year_list']))
{
	show_model_year_list($con);
}





if(isset($_POST['insert_create_exam']))
{
	insert_create_exam($con);
}



if(isset($_POST['show_setter_college']))
{
	show_setter_college($con);
}
if(isset($_POST['get_paper_setter_names']))
{
	get_paper_setter_names($con);
}
//--------------------------------------------
if(isset($_POST['show_evaluator_college']))
{
	show_evaluator_college($con);
}
if(isset($_POST['get_paper_evaluator_names']))
{
	get_paper_evaluator_names($con);
}

//--------------
if(isset($_POST['test_codes']))
{
	test_code_details($con);
}

if(isset($_POST['showstates']))
{
	showstates($con);
}






function test_code_details($con) //CRB not needed_____(small doing => Bh)
{
	$group_id=$_POST['group_id'];
	$class_id=$_POST['class_id'];
	$mode=$_POST['mode'];
	$stream=$_POST['stream'];
	$program_name=$_POST['program_name'];
	$test_type=$_POST['test_type'];
    $sql_test_codes=$con->query("select cg.GROUP_NAME,sc.DISPLAY_NAME,s.STREAM_NAME,ty.test_type_name,tm.test_mode_name from t_course_group cg,t_study_class sc,t_stream s,0_test_modes tm,0_test_types ty where cg.GROUP_ID='{$group_id}' and sc.CLASS_ID='{$class_id}' and s.STREAM_ID='{$stream}' and ty.test_type_id='{$test_type}'");
    $row=mysqli_fetch_array($sql_test_codes);
    $group_name=$row['GROUP_NAME'];
    $class_name=$row['DISPLAY_NAME'];
    $stream_name=$row['STREAM_NAME'];
    $test_type_name=$row['test_type_name'];
    $test_mode_name=$row['test_mode_name'];

    //class
    $first=$class_name[0].$class_name[1];

    //group  
    
           if($group_name=="M.P.C")
           {
              $second="MPC";	
           }
           else if($group_name == "BI.P.C")
           {
           	  $second="BIPC";
           }
           else if($group_name == "M.BI.P.C")
           {
           	  $second="MBIPC";
           }
           else 
           {
           	 $second=substr($group_name, 0,3);
           }
           
    	
      //stream 
    if($stream_name=="ICON")
    	{
    		$third="ICON";
    	}
    else
    {
   	  $third=substr($stream_name, 0, 3);
    }



    //test mode
    if($test_mode_name=="IIT_P1")
    {
    	$fourth="P1";
    }
    else if($test_mode_name=="IIT_P2")
    {
    	$fourth="P2";
    }
    else if ($test_mode_name=="IIT_P1P2") {
    	$fourth="P12";
    }
    else if ($test_mode_name=="IIT_P1_ADV") {
    	$fourth="P1_ADV";
    }

    else if ($test_mode_name=="IIT_P2_ADV") {
    	$fourth="P2_ADV";
    }
    else
    {
    	$fourth=substr($test_mode_name, 0, 3);
    }



    //test type
    if($test_type_name=="WEEK-END")
    {
    	$fifth="WEEK-END";
    }
    else if($test_type_name=="UNIT-TEST")
    {
        $fifth="UNIT-TEST";	
    }
    else if($test_type_name=="GRAND TEST")
    {
        $fifth="GRAND TEST";	
    }
    else if($test_type_name=="CUMULATIVE")
    {
        $fifth="CUMULATIVE";	
    }
    else if($test_type_name=="PART-TEST")
    {
        $fifth="PART-TEST";	
    }
    else{
    	 $fifth=substr($test_type_name, 0, 2);
    }


    //$test_code=$first . "-" . $second . "-" . $third . "-" . $fourth . "-" . $fifth;


//need to change here

    if($program_name=="PH1" || $program_name=="PH2" || $program_name=="PH3")
    {
      
       $test_code=$first."_".$third."_".$second."_".$fourth."_".$fifth."_".$program_name.'_'.$start_date.'_'.$last_date_to_upload;

    }
    else
    {
	    $pro=explode("_", $program_name);
	    
	    //$stream1=$pro[1];

	    if($pro[1]=="ICON")
	    {
	    	$pro[1]="IIT";
	    	$str=implode("_",$pro);
	    	$program=$str;

	    }
	    else
	    {
	    	$program=$program_name;
	    }
	    
	    $test_code = $program.'_'.$fourth.'_'.$fifth;
    }

    

  $sql_count=$con->query("select count(test_code) as test_code from IP_Exam_Details where test_code like '$test_code%'");
  $row1=mysqli_fetch_array($sql_count);
  $cnt=$row1['test_code'];
 
  if($fourth=="P12")
  {
  	$div=$cnt/2;
  	$count=$div+1;
  }
  else
  {
  	 $count=$cnt+1;
  }
  if($test_mode_name=="IIT_P1" || $test_mode_name=="IIT_P2" || $test_mode_name=="IIT_P1P2" || $test_mode_name=="IIT_P1_ADV" || $test_code_name=="IIT_P2_ADV")
  {
     $letter="T";	
  }
  else if($test_mode_name=="MAINS")
  {
     $letter="M";	
  }
  else if($test_mode_name=="EAMCET(MPC)" || $test_mode_name=="EAMCET(BI.PC)")
  {
     $letter="E";	
  }
  else if($test_mode_name=="NEET")
  {
     $letter="N";	
  }
  else if($test_mode_name=="KECT(MPC)" || $test_mode_name=="KECT(BI.PC)" )
  {
     $letter="K";	
  }
  else if($test_mode_name=="AIIMS" )
  {
     $letter="A";	
  }
  else if($test_mode_name=="JIPMER" )
  {
     $letter="J";	
  }
  
  $test_code=$test_code . "_" . $letter . $count;

  $date = new DateTime($_POST['start_date']);
$st=$date->format('j-F-Y');

  $date = new DateTime($_POST['last_date_to_upload']);
$ldtu=$date->format('j-F-Y');

 echo $program_name.'_'.$second.'_'.$fifth.'_'.$st.'_'.$ldtu;
    exit;

}



function show_setter_college($con)//CRB not needed....(small doing => Checked)

{ ?>
                                                 <select class="form-control  testSelAll  SumoUnder setter_college"  multiple="multiple" id="college_setter">
                                                  
                                                   <?php
                                                    $res=$con->query("select CAMPUS_ID,CAMPUS_NAME from t_campus where  PRESENT_STATUS='LIVE' and COLLEGE_TYPE='COLLEGE' ORDER BY CAMPUS_NAME");
                                                    while($row=mysqli_fetch_array($res))
                                                    {
                                                        echo '<option value='.$row['CAMPUS_ID'].'>'.$row['CAMPUS_NAME'].'</option>';
                                                    }

                                                   ?>

                                                </select>
 <?php
	//exit;
}
function show_evaluator_college($con) //CRB not needed....(small doing => Checked)

{ ?>
                                                 <select class="form-control  testSelAll  SumoUnder evaluator_college"  multiple="multiple">
                                                   
                                                   <?php
                                                    $res=$con->query("select CAMPUS_ID,CAMPUS_NAME from t_campus where  PRESENT_STATUS='LIVE' and COLLEGE_TYPE='COLLEGE' ORDER BY CAMPUS_NAME");
                                                    while($row=mysqli_fetch_array($res))
                                                    {
                                                        echo '<option value='.$row['CAMPUS_ID'].'>'.$row['CAMPUS_NAME'].'</option>';
                                                    }

                                                   ?>

                                                </select>
 <?php
	//exit;
}

function get_paper_setter_names($con) //CRB not needed....(small doing => Checked)
{

 $setter_college_id=$_POST['setter_college_id'];
 $setter_college_id_string=implode(",",$setter_college_id);
//exit;

	echo '<select multiple="multiple"  class="form-control SumoUnder paper_setter SlectBox-grp">';
	  foreach($setter_college_id as $value) 
	  {
		   $this_setter_college_id=$value;
	

		  $res2=$con->query("select CAMPUS_NAME,CAMPUS_ID from t_campus where CAMPUS_ID='$this_setter_college_id'");
		  $row2=mysqli_fetch_array($res2);$CAMPUS_NAME= $row2['CAMPUS_NAME'];
  
		  {
			  	  echo 
				  '<optgroup paper_setter_label="" class="paper_setter_label paper_setter_dropdown_'.$this_setter_college_id.'" id="paper_setter_'.$this_setter_college_id.'" label="'.$CAMPUS_NAME.'">';
				  
				  $res3=$con->query("select USER_NAME,SURNAME,EMPLOYEE_ID,SUBJECT, MOBILE from t_employee where CAMPUS_ID = $this_setter_college_id and IS_COLLEGE='COLLEGE' and STATUS='CURRENT' and EMP_TYPE='TEACH'");
				  
				    while($row3=mysqli_fetch_array($res3))
					{
					    list($fname, $lname) = explode(' ', $row3['USER_NAME'],3);
						
						$name = strlen($fname)>6 ? $fname : $fname.$lname;
						$subject = substr($row3['SUBJECT'], 0, 3); 
						$mobile=$row3['MOBILE'];

						echo '<option class="paper_setter_option_'.$this_setter_college_id.'" value="'.$row3['EMPLOYEE_ID'].'">'.$name.'-('.$subject. ')-('.$mobile.')</option>';
					}
			  
				  echo '</optgroup>';		  
		  }

  
	  }

	echo '</select>';


//exit;

}
function get_paper_evaluator_names($con) //CRB not needed.....(small doing => Checked)
{

 $evaluator_college_id=$_POST['evaluator_college_id'];
 $evaluator_college_id_string=implode(",",$evaluator_college_id); 
//exit;

	echo '<select multiple="multiple"  class="form-control SumoUnder paper_evaluator SlectBox-grp">';
	  foreach($evaluator_college_id as $value) 
	  {
		   $this_evaluator_college_id=$value;
	

		  $res2=$con->query("select CAMPUS_NAME,CAMPUS_ID from t_campus where CAMPUS_ID='$this_evaluator_college_id'");
		  $row2=mysqli_fetch_array($res2);$CAMPUS_NAME= $row2['CAMPUS_NAME'];
  
		  {
			  	  echo 
				  '<optgroup paper_evaluator_label="" class="paper_evaluator_label paper_evaluator_dropdown_'.$this_evaluator_college_id.'" id="paper_evaluator_'.$this_evaluator_college_id.'" label="'.$CAMPUS_NAME.'">';
				  
				  $res3=$con->query("select USER_NAME,SURNAME,EMPLOYEE_ID,SUBJECT, MOBILE from t_employee where CAMPUS_ID = $this_evaluator_college_id and IS_COLLEGE='COLLEGE' and STATUS='CURRENT' and EMP_TYPE='TEACH'");
				  
				    while($row3=mysqli_fetch_array($res3))
					{
					
					    list($fname, $lname) = explode(' ', $row3['USER_NAME'],3);
						$name = strlen($fname)>6 ? $fname : $fname.$lname;
						$subject = substr($row3['SUBJECT'], 0, 3); 
						$mobile=$row3['MOBILE'];
						echo '<option class="paper_evaluator_option_'.$this_evaluator_college_id.'" value="'.$row3['EMPLOYEE_ID'].'">'.$name.'-('.$subject. ')-('.$mobile.')</option>';
					}
			  
				  echo '</optgroup>';		  
		  }

  
	  }

	echo '</select>';


//exit;

}
function showstates($con) //CRB not needed.....(small doing => Checked)
{
  
   ?>
                                                 <select class="form-control  testSelAll  SumoUnder state"  multiple="multiple">
                                                  
                                                   <?php
                                                    $res=$con->query("select STATE_NAME,STATE_ID from t_state ORDER BY STATE_NAME");
                                                    while($row=mysqli_fetch_array($res))
                                                    {
                                                        echo '<option value='.$row['STATE_ID'].'>'.$row['STATE_NAME'].'</option>';
                                                    }

                                                   ?>

                                                </select>
 <?php


}

function show_group_list($con) //CRB not needed.....(small doing => Checked)
{ //echo "aww"; exit;
	$res=$con->query("select distinct GROUP_ID,GROUP_NAME from t_course_group ORDER BY GROUP_ID");
	echo '<select class="form-control testSelAll SumoUnder group" >';
	
	echo '<option value="">Select Group</option>';
	while($row=mysqli_fetch_array($res))
	{
	 
     echo '<option value="'.$row['GROUP_ID'].'">'.$row['GROUP_NAME'].'</option>';
	}
	echo '</select>';
	//exit;
}
//145279779

function show_test_modes($con) //CRB not needed.....(small doing => Checked)
{
	$group_id=$_POST['group_id'];
	if($group_id=="")
	{
		$group_id=1000;
	}
	//exit;
	$temp="%";
    $dash="-";
    $temp2=$temp.$dash.$group_id.$dash.$temp;
			
			
			
	$res=$con->query("select test_mode_id,test_mode_name from 0_test_modes where GROUP_ID LIKE '$temp2' and test_mode_id !='3'");
	echo '<select class="form-control testSelAll SumoUnder mode" id="sel_mode" onchange="test_code_details()">';
	
	echo '<option value="">Select Test Mode</option>';
	while($row=mysqli_fetch_array($res))
	{
		echo '<option value="'.$row['test_mode_id'].'">'.$row['test_mode_name'].'</option>';
	}
	echo '</select>';
	//exit;
}
function show_year_list($con) //CRB not needed......(small doing => Checked)
{ //echo "aww"; exit;
    $group_id_string=$_POST['group_id'];
	//$group_id_string=implode(",",$group_id_array);
	
	//$res=$con->query("select CLASS_NAME,DISPLAY_NAME,CLASS_ID from t_study_class where CLASS_ID in (select CLASS_ID from t_course_track where GROUP_ID='$group_id' );");
	echo '<select class="form-control testSelAll SumoUnder year" multiple="multiple">';
	$res=$con->query("select CLASS_NAME,DISPLAY_NAME,CLASS_ID from t_study_class where CLASS_ID in (select CLASS_ID from t_course_track where GROUP_ID = $group_id_string );");
	
	
	while($row=mysqli_fetch_array($res))
	{
	 
     echo '<option value="'.$row['CLASS_ID'].'">'.$row['DISPLAY_NAME'].'('.$row['CLASS_NAME'].')</option>';
	}
	echo '</select>';
	//exit;
}


function show_stream_list($con) //CRB not needed.....(small doing => Checked)
{
    $group_id_string=$_POST['group_id']; //single group id
	//$group_id_string=implode(",",$group_id_array);
	
	$class_id_array=$_POST['class_id'];
	$class_id_string=implode(",",$class_id_array);

	
	echo '<select multiple="multiple"  class="form-control SumoUnder stream SlectBox-grp">';
	
	

	  foreach($class_id_array as $value) 
	  {
		  $this_class_id=$value;
		  $res1=$con->query("select GROUP_NAME from t_course_group where GROUP_ID='$group_id_string'");
		  $row1=mysqli_fetch_array($res1);$GROUP_NAME= $row1['GROUP_NAME'];
		  
		  $res2=$con->query("select CLASS_NAME,DISPLAY_NAME from t_study_class where CLASS_ID='$this_class_id'");
		  $row2=mysqli_fetch_array($res2);$CLASS_NAME= $row2['CLASS_NAME'];$DISPLAY_NAME= $row2['DISPLAY_NAME'];
		  
		  {
			  	  echo 
				  '<optgroup stream_label="" class="stream_label stream_dropdown_'.$this_class_id.'" id="stream_'.$this_class_id.'" label="'.$GROUP_NAME.'('.$DISPLAY_NAME.')">';
				  
				  $res3=$con->query("select STREAM_ID,STREAM_NAME from t_stream where STREAM_ID IN (select distinct STREAM_ID from  t_course_track where (STREAM <> 'NULL') and GROUP_ID = $group_id_string and CLASS_ID = $this_class_id)");
				  
				    while($row3=mysqli_fetch_array($res3))
					{
						echo '<option class="stream_option_'.$this_class_id.' class'.$row3['STREAM_ID'].'" value="'.$row3['STREAM_ID'].'">'.$row3['STREAM_NAME'].'</option>';
					}
				  
				 
				  
				  echo '</optgroup>';		  
		  }
  
	  }

	echo '</select>';
	//exit;
}

function show_program_name_list($con) //CRB not needed....(small doing => Checked)
{
		








	 $group_id=$_POST['group_id'];
	 
	 
	 $class_year_id_array=$_POST['class_year'];
	 $stream_program_name_list_array=$_POST['stream_program_name_list_array'];
	 
	 $class_year_id_array_length=sizeof($class_year_id_array);
	 $stream_program_name_list_array_length=sizeof($stream_program_name_list_array);
	 
	 $combined_length=$class_year_id_array_length * $stream_program_name_list_array_length;
	$i=0;
	$flag=1;
	echo '<select multiple="multiple"  class="form-control SumoUnder program_name SlectBox-grp"  >';
		  foreach($class_year_id_array as $value) 
	  {
		  $this_class_id=$value;
		  $res1=$con->query("select GROUP_NAME from t_course_group where GROUP_ID='$group_id'");
		  $row1=mysqli_fetch_array($res1);$GROUP_NAME= $row1['GROUP_NAME'];
		  
		  $res2=$con->query("select CLASS_NAME,DISPLAY_NAME from t_study_class where CLASS_ID='$this_class_id'");
		  $row2=mysqli_fetch_array($res2);$CLASS_NAME= $row2['CLASS_NAME'];$DISPLAY_NAME= $row2['DISPLAY_NAME'];
		  
		    
			 $individual= $stream_program_name_list_array[$i++];
			  $individual_array=explode(",",$individual);
		
			 $j=0;
			 
			 foreach($individual_array as $val)
			 { 
				 $res3=$con->query("select STREAM_ID,STREAM_NAME from t_stream where STREAM_ID = $val");
				 $row3=mysqli_fetch_array($res3);
				$val=trim($val);
				 
				 echo 
				  '<optgroup program_label="" class="program_label program_dropdown_'.$flag++.'"  label="'.$GROUP_NAME.'('.$DISPLAY_NAME.')<br> '.$row3['STREAM_NAME'].'">';
				  
				     $res4=$con->query("select PROGRAM_ID,PROGRAM_NAME from  t_program_name where stream_ID = $val and CLASS_ID = $this_class_id ");
				  
				    while($row4=mysqli_fetch_array($res4))
					{
						$val=trim($val);
						echo '<option class="program_option_'.($flag-1).'" value="'.$row4['PROGRAM_ID'].'">'.$row4['PROGRAM_NAME'].'</option>';
						
						//echo '<option class="stream_option_'.$this_class_id.' class'.$row3['STREAM_ID'].'" value="'.$row3['STREAM_ID'].'">'.$row3['STREAM_NAME'].'</option>';
					}
				  
				 
				  
				  echo '</optgroup>';
			 } //$flag++;
			  

	  }

	echo '</select>';


       




			  
}//fun emds


function show_program_name_list2($con) //CRB not needed....(small doing => Checked)
{
		








	 $group_id=$_POST['group_id'];
	 
	 
	 $class_year_id_array=$_POST['class_year'];
	 $stream_program_name_list_array=$_POST['stream_program_name_list_array'];
	 
	 $class_year_id_array_length=sizeof($class_year_id_array);
	 $stream_program_name_list_array_length=sizeof($stream_program_name_list_array);
	 
	 $combined_length=$class_year_id_array_length * $stream_program_name_list_array_length;
	$i=0;
	$flag=1;
	echo '<select   class="form-control SumoUnder  SlectBox-grp main_program"  >';
	echo '<option  value="">Scheduled Prog</option>';
		  foreach($class_year_id_array as $value) 
	  {
		  $this_class_id=$value;
		  $res1=$con->query("select GROUP_NAME from t_course_group where GROUP_ID='$group_id'");
		  $row1=mysqli_fetch_array($res1);$GROUP_NAME= $row1['GROUP_NAME'];
		  
		  $res2=$con->query("select CLASS_NAME,DISPLAY_NAME from t_study_class where CLASS_ID='$this_class_id'");
		  $row2=mysqli_fetch_array($res2);$CLASS_NAME= $row2['CLASS_NAME'];$DISPLAY_NAME= $row2['DISPLAY_NAME'];
		  
		    
			 $individual= $stream_program_name_list_array[$i++];
			  $individual_array=explode(",",$individual);
		
			 $j=0;
			 
			 foreach($individual_array as $val)
			 { 
				 $res3=$con->query("select STREAM_ID,STREAM_NAME from t_stream where STREAM_ID = $val");
				 $row3=mysqli_fetch_array($res3);
				$val=trim($val);
				 
				 echo 
				  '<optgroup program_label="" class=" program_dropdown_'.$flag++.'"  label="'.$GROUP_NAME.'('.$DISPLAY_NAME.')<br> '.$row3['STREAM_NAME'].'">';
				  
				     $res4=$con->query("select PROGRAM_ID,PROGRAM_NAME from  t_program_name where stream_ID = $val and CLASS_ID = $this_class_id ");
				  
				    while($row4=mysqli_fetch_array($res4))
					{
						$val=trim($val);
						echo '<option class="program_option_'.($flag-1).'" value="'.$row4['PROGRAM_ID'].'">'.$row4['PROGRAM_NAME'].'</option>';
						
						//echo '<option class="stream_option_'.$this_class_id.' class'.$row3['STREAM_ID'].'" value="'.$row3['STREAM_ID'].'">'.$row3['STREAM_NAME'].'</option>';
					}
				  
				 
				  
				  echo '</optgroup>';
			 } //$flag++;


			 echo '<option value="PH1">PHASE1</option>';
			 echo '<option value="PH2">PHASE2</option>';
			 echo '<option value="PH3">PHASE3</option>';
			  

	  }

	echo '</select>';


       




			  
}//fun emds
function show_model_year_list($con) //CRB not needed.....(small doing => Checked)
{
	$test_mode_id=$_POST['test_mode_id'];
	
	
	//if("select models_years from 0_test_modes_years where test_mode_type=(select test_mode_type from 0_test_modes where test_mode_id='$test_mode_id')" );
	
	
	$res=$con->query("select test_mode_type from 0_test_modes where test_mode_id='$test_mode_id'");
	$row=mysqli_fetch_array($res);
	$test_mode_type=$row['test_mode_type'];
	
	if($test_mode_type=="3") //P1_P2
	{
		$res2=$con->query("select model_years from 0_test_modes_years where test_mode_type='1'");
		echo '<select multiple="multiple"  class="form-control SumoUnder SlectBox-grp" id="paper_model_year_id">';
		echo '<optgroup program_label="" class=""  label="PAPER-1">';
		
			while($row2=mysqli_fetch_array($res2))
			{
				echo '<option  value="'.$row2['model_years'].'">'.$row2['model_years'].'</option>';
			}
       	echo '</optgroup>';
		
		$res3=$con->query("select model_years from 0_test_modes_years where test_mode_type='2'");
		
		echo '<optgroup program_label="" class=""  label="PAPER-2">';
		
			while($row3=mysqli_fetch_array($res3))
			{
				echo '<option  value="'.$row3['model_years'].'">'.$row3['model_years'].'</option>';
			}
       	echo '</optgroup>';
		
		
		
		
		echo '</select>'; //exit;
		
	}
	else
	{ 
		if($test_mode_type=="1" || $test_mode_type=="4") {$test_mode_type="1";} else
		if($test_mode_type=="2" || $test_mode_type=="5") {$test_mode_type="2";} 
		$res2=$con->query("select model_years from 0_test_modes_years where test_mode_type='$test_mode_type'");
		echo '<select   class="form-control SumoUnder SlectBox-grp" id="paper_model_year_id">';
			echo '<option value="">Select Model Year</option>';
			while($row2=mysqli_fetch_array($res2))
			{
				echo '<option  value="'.$row2['model_years'].'">'.$row2['model_years'].'</option>';
			}
			echo '</select>';
	}
	

	

	
	
	
}

function insert_create_exam($con) //(small doing => )
{
	 	
//echo "oloo";exit;

 /*
	mysqli_autocommit($con,FALSE);
    mysqli_commit($con);
    mysqli_rollback($con);
*/


	$group_id=$_POST['group_id'];
	$class_year_id_array=$_POST['class_year_id_array'][0];
	$stream_name_list_array=$_POST['stream_program_name_list_array'][0];
	$program_name_list_array=$_POST['program_name_list_array'][0];
	$scheduled_program_id=$_POST['scheduled_program_id'][0];
	$syllabus_id=$_POST['syllabus_id'];
	
	$test_type_id=$_POST['test_type'];
	$test_mode_id=$_POST['test_mode_id'];

	$setter_college_array=$_POST['setter_college'];



	$evaluator_college_array=$_POST['evaluator_college'];




	$paper_setter_array=$_POST['paper_setter_array'];
	//$paper_setter_array=explode(",",$paper_setter_array);
	//echo json_encode($paper_setter_array);
	//echo $paper_setter_array[0];
	//echo $paper_setter_array[1];
	

	$paper_evaluator_array=$_POST['paper_evaluator_array'];

   //echo "<br>";
	//echo json_encode($paper_evaluator_array);
    //echo $paper_evaluator_array[0];
   

    //$paper_evaluator_array=explode(",",$paper_evaluator_array);


//exit;
	 $state=$_POST['state'];
	
	//ARRAY AND STRING CHECK
	 
	
	
	//ARRAY AND STRING CHECK
	
	$start_date=$_POST['start_date'];
	$last_date_to_upload=$_POST['last_date_to_upload'];
	$time=date("H:i", strtotime($_POST['time']));
	
	$test_code=$_POST['test_code'];

	$start_date=date("Y-m-d", strtotime($_POST['start_date'])); 
	
	$last_date_to_upload=date("Y-m-d", strtotime($_POST['last_date_to_upload']));
	
	//$res1=$con->query("select * from 1_exam_admin_create_exam where test_code='$test_code'"); //S

    $res1=$con->query("select count(sl) as c from IP_Exam_Details where test_code='$test_code'");
    $row1=mysqli_fetch_array($res1);

	$count=$row1['c'];

	if($count>=1){ echo "Test_code_already_exist"; exit;}
	
	$posted_date=current_date_y_m_d();
	$posted_time=current_time_12_hour_format_h_m_s();
	$posted_date_and_time=$posted_date." ".$posted_time;
	
	
	$originalDate = $posted_date;
    $d_m_y = date("d-m-Y", strtotime($originalDate));


    $edit_status="This Test@Created On@$d_m_y@$posted_time";
	
	
	$paper_model_year_input=$_POST['paper_model_year'];
		
   $res=$con->query("select test_mode_name,test_mode_type,adv1_nonadv0 from 0_test_modes where test_mode_id='$test_mode_id'");
   $row=mysqli_fetch_array($res);
   $adv1_nonadv0=$row['adv1_nonadv0'];
   $test_mode_type=$row['test_mode_type'];
   
   $do_for_paper="";
   
   if($adv1_nonadv0==1)
   {
	    $omr_scanning_type="advanced";
		  if($test_mode_type==3)
		  {
			  $do_for_paper="two_paper";
              $paper_model_array=array();

           // echo $paper_model_year_input;

            // $paper_model_year_input_array=explode(",",$paper_model_year_input); //format=  2009-P1,2010-P2
             $first_year_with_paper= $paper_model_year_input[0];
             $second_year_with_paper=$paper_model_year_input[1];

             $temp1= explode("-",$first_year_with_paper);
             $first_year=$temp1[0];
              $paper_model_array[]=$first_year;
             $temp2= explode("-",$second_year_with_paper);
             $second_year=$temp2[0];
             $paper_model_array[]=$second_year;

             


			  
		  }
		  else
		  {
			  $paper_model_year_input_array=explode("-",$paper_model_year_input);
			  $paper_model_year=$paper_model_year_input_array[0];
			  $P1_or_P2=$paper_model_year_input_array[1];
			  $do_for_paper="one_paper";
		  }
	   
   }
   else
   {
	   $omr_scanning_type="non_advanced";
	   
	   $paper_model_year=$paper_model_year_input;
	   $P1_or_P2="";
	   $do_for_paper="one_paper";
   }
	

  if($do_for_paper=="one_paper")
  { // one paper start


	mysqli_autocommit($con,FALSE);
   
   

      
    //SINGLE LINE MAIN EXAM CREATE INSERT
    $state_id_comma_seperated_string=implode(",",$state);
	$res2=$con->query("insert into IP_Exam_Details(`Exam_name`, `Date_exam`, `End_Date`, `last_date_to_upload`, `Test_type_id`, `Board`, `created_by`, `updated_by`)values('{$test_code}','{$start_date}','{$start_date}','{$last_date_to_upload}','{$test_type_id}','{$test_type_id}','{$_SESSION['payroll_id']}','{$_SESSION['payroll_id']}')");
	$last_query_id= mysqli_insert_id($con); //exit;

	 $counter=0;
	 foreach($class_year_id_array as $key=>$class_year_individual)
	 {
		    $individual_stream_group=$stream_name_list_array[$key];
			$individual_stream_group=explode(",",$individual_stream_group);
			 
			 foreach($individual_stream_group as $stream_atom)
			 {
                $individual_program_group=$program_name_list_array[$counter++];
				$individual_program_group=explode(",",$individual_program_group);
				
				                   foreach($individual_program_group as $program_atom)
								   {
									   //echo "ClassID=".$class_year_individual."StreamID=".$stream_atom."ProgramId=".$program_atom; echo "\n";
									  $res3=$con->query("insert into IP_Exam_Conducted_For(`exam_id`, `group_id`, `classyear_id`, `stream_id`, `program_id`)values('{$last_query_id}','{$group_id}','{$class_year_id_array}','{$stream_name_list_array}','{$program_name_list_array}')");
//echo mysqli_error($con);									  
									  
									   
								   }
                
				
			 }		 	
		
	 }
	 //echo mysqli_error($con);exit;




//echo json_encode($paper_setter_array); 

//echo json_encode($paper_evaluator_array);exit;



	 //paper setter insert start
     // foreach($paper_setter_array as $individual_paper_setter_employee_id)
     // {
     
     //   $individual_paper_setter_employee_id=trim($individual_paper_setter_employee_id);

     //   //echo "Paper Setter= last q".$last_query_id."-->setter id=".$individual_paper_setter_employee_id;

     //   $res4=$con->query("insert into paper_setter(slno,emp_id)values('{$last_query_id}','{$individual_paper_setter_employee_id}')");
     //   echo mysqli_error($con); //exit;

     // }

	 //paper setter insert ends
	  //paper evaluator insert start
     // foreach($paper_evaluator_array as $individual_paper_evaluator_employee_id)
     // {

     //   $individual_paper_evaluator_employee_id=trim($individual_paper_evaluator_employee_id);
     //  // echo "Paper eval= last q".$last_query_id."-->eval id=".$individual_paper_evaluator_employee_id;
     //   $res5=$con->query("insert into paper_verifier(slno,emp_id)values('{$last_query_id}','{$individual_paper_evaluator_employee_id}')");
     //   echo mysqli_error($con);

     // }

	 //paper evaluator insert ends


	 
	     if(($res2)&&($res3))
		 {  mysqli_commit($con);
			echo "added_successfully";exit; 
		 }
		 else
		 { 

  echo("Error description: " . mysqli_error($con));
  
		 	 mysqli_rollback($con);
		 	 exit;
		 }
	 


	 
	  
  }// one paper ends here
	
	



	// TWO START

      if($do_for_paper=="two_paper")
  { // two paper start



      mysqli_autocommit($con,FALSE);
    //SINGLE LINE MAIN EXAM CREATE INSERT
      $paper_array = array("P1","P2");
       $itr=1;
        for($itr=0;$itr<=1;$itr++)
      { // for start

           $P1_or_P2=$paper_array[$itr];
           $paper_model_year=$paper_model_array[$itr];

    $state_id_comma_seperated_string=implode(",",$state);
	$res2=$con->query("insert into IP_Exam_Details(omr_scanning_type,test_type,mode,test_mode_type,model_year,paper,test_code,start_date,last_date_to_upload,posted_date_and_time,edit_status,state_id,syllabus_id)values('{$omr_scanning_type}','{$test_type_id}','{$test_mode_id}','{$test_mode_type}','{$paper_model_year}','{$P1_or_P2}','{$test_code}','{$start_date}','{$last_date_to_upload}','{$posted_date_and_time}','{$edit_status}','{$state_id_comma_seperated_string}','{$syllabus_id}')");
	$last_query_id= mysqli_insert_id($con); //exit;

	 $counter=0;
	 foreach($class_year_id_array as $key=>$class_year_individual)
	 {
		    $individual_stream_group=$stream_name_list_array[$key];
			$individual_stream_group=explode(",",$individual_stream_group);
			 
			 foreach($individual_stream_group as $stream_atom)
			 {
                $individual_program_group=$program_name_list_array[$counter++];
				$individual_program_group=explode(",",$individual_program_group);
				
				                   foreach($individual_program_group as $program_atom)
								   {
									   //echo "ClassID=".$class_year_individual."StreamID=".$stream_atom."ProgramId=".$program_atom; echo "\n";
									  $res3=$con->query("insert into 1_exam_gcsp_id(test_sl,GROUP_ID,CLASS_ID,STREAM_ID,PROGRAM_ID)values('{$last_query_id}','{$group_id}','{$class_year_individual}','{$stream_atom}','{$program_atom}')");
//echo mysqli_error($con);									  
									  
									   
								   }
                
				
			 }		 	
		
	 }


	 //paper setter insert start
     foreach($paper_setter_array as $individual_paper_setter_employee_id)
     {
       $res4=$con->query("insert into paper_setter(slno,emp_id)values('{$last_query_id}','{$individual_paper_setter_employee_id}')");
       //echo mysqli_error($con);exit;

     }

	 //paper setter insert ends
	  //paper evaluator insert start
     foreach($paper_evaluator_array as $individual_paper_evaluator_employee_id)
     {
       $res5=$con->query("insert into paper_verifier(slno,emp_id)values('{$last_query_id}','{$individual_paper_evaluator_employee_id}')");
       //echo mysqli_error($con);

     }

	 //paper evaluator insert ends

      }//for end
	 
	     if(($res2)&&($res3)&&($res4)&&($res5))
		 {
		 	mysqli_commit($con);
			echo "added_successfully";exit; 
		 }
		  else
		 {   echo "ajax_error";
		 	 mysqli_rollback($con);
		 	 exit;
		 }
	 


	 
	  
  }// two paper ends here


    // TWO ENDS

  
	
	exit;
}

?>

    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="sumoselect/jquery.sumoselect.js"></script>
    <script src="sumoselect/sumoselect.js"></script>
	
	<script>

		    $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
    
	
	//$(document).ready(function(){ // removed ready function... removed repeated fun calls...
	    
	
	
	
	$("#group").change(function(){
	//alert("groupd change");

	show_year_list();
	//show_test_modes();
    //$('#test_type').prop('selectedIndex',0);
    //$('#test_type option:first-child').attr("selected", "selected");
    });



    //----------------------------

    $("#paper_model_year").change(function(){

     var mode=$("#sel_mode").val();
     


     if(mode==3)
     {

     validate_p1_p2_dropdown();


     }



         
     });
 //-----------------------------------------------------
	$("#year").change(function(){
    //alert("year change fun calling");
	show_stream_list();
	$("#test_code").val("");
	$('#test_type').val("selected");
	//show_test_modes();
    });


	$("#stream").change(function(){
		//alert("streamchangedfunction");
		//alert("stream");
		validate_stream_dropdown();
		$("#test_code").val("");
	$('#test_type').val("selected");
	//show_test_modes();
	});

//////
	$("#paper_model_year_id").change(function(){
////////alert("oooo");
showstates();
});
 //-----------------------------------------------------
    $("#setter_college").change(function(){




   


    get_paper_setter_names();

    });

	
	$("#paper_setter").change(function(){
      
      validate_paper_setter_dropdown();
	});
	
 //-----------------------------------------------------
  //-----------------------------------------------------
    $("#evaluator_college").change(function(){

    get_paper_evaluator_names();

    });

	
	$("#paper_evaluator").change(function(){
      
      validate_paper_evaluator_dropdown();
	});
	
 //-----------------------------------------------------

		$("#program_name").change(function(){
		//alert("streamchangedfunction");
		validate_program_name_dropdown();
		var group_id=$(".group").val();
		
		$("#test_code").val("");
	    $('#test_type').val("selected");
	    //show_test_modes();
	});
	
	
		$("#mode").change(function(){
		show_model_year_list();
		
	});
	

function validate_p1_p2_dropdown()
{
    
    var paper_model_year_id=$("#paper_model_year_id").val();

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


	return false;
}
	function validate_paper_setter_dropdown() //lopp
	 {
	 	//alert("insv");
        var setter_college=$(".setter_college").val();
        var paper_setter_label_array=[];
		var paper_setter_input_error_display_array=[];

		$('.paper_setter_label').each(function()
		{   //;
			paper_setter_label_array.push( $(this).attr('label'));
		});

         		
		
		$.each(setter_college, function(index, value) 
		           { 
                       var count=0;
								   $('.paper_setter_dropdown_'+value+' option').each(function()
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
							paper_setter_input_error_display_array.push(paper_setter_label_array[index]) 
						 }
                   });
				 var length_error=paper_setter_input_error_display_array.length;
				 var d_string="";
				 if(length_error>0)
				 {
					 $.each(paper_setter_input_error_display_array, function(index, value)
					 {
						 d_string=d_string+value+"\n";
					 });
					 alert("Minimum One Paper Setter for the Below College needs to be Selected \n"+d_string+"\nElse Remove the above College in Colleger Filter..!!");
					 
					 return false;
				 }
				 else
				 {
					// show_program_name_list();
					show_evaluator_college();
				 }


	 }
	 	function validate_paper_evaluator_dropdown() //lopp
	 {
	 	//alert("insv");
        var evaluator_college=$(".evaluator_college").val();
        var paper_evaluator_label_array=[];
		var paper_evaluator_input_error_display_array=[];

		$('.paper_evaluator_label').each(function()
		{   //;
			paper_evaluator_label_array.push( $(this).attr('label'));
		});

         		
		
		$.each(evaluator_college, function(index, value) 
		           { 
                       var count=0;
								   $('.paper_evaluator_dropdown_'+value+' option').each(function()
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
							paper_evaluator_input_error_display_array.push(paper_evaluator_label_array[index]) 
						 }
                   });
				 var length_error=paper_evaluator_input_error_display_array.length;
				 var d_string="";
				 if(length_error>0)
				 {
					 $.each(paper_evaluator_input_error_display_array, function(index, value)
					 {
						 d_string=d_string+value+"\n";
					 });
					 alert("Minimum One Paper Evaluator for the Below College needs to be Selected \n"+d_string+"\nElse Remove the above College in Colleger Filter..!!");
					 
					 return false;
				 }
				 else
				 {
					// show_program_name_list();
					//show_evaluator_college();
				 }


	 }
	

	function validate_stream_dropdown()
	{ //alert("std");
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
//}); removed ready function... removed repeated fun calls...

	</script>
	<script src="../assets/js/bootstrap-datepicker.min.js"></script>
