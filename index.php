<?php
include_once '../../secure_login/includes/functions.php';
sec_session_start();
if(($_SESSION['is_exam_admin']==false) && (!isset($_SESSION['is_exam_admin'])))
{
    Header('Location:../../secure_login/');
} 

require("../000_main_includes/config.php");
require("../000_main_includes/common_functions.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../assets/img/big-logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Sri Chaitanya</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

     <link rel="stylesheet" href="../../css/jquery-ui.css">
     <link rel="stylesheet" href="../../css/jquery-timepicker.css">
    <!-- Bootstrap core CSS     -->
    <!--<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.min.css" />

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/mdtimepicker.css" rel="stylesheet" type="text/css">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <link href="sumoselect/sumoselect.css" rel="stylesheet" />
<style>

.SumoSelect .select-all {
    border-radius: 3px 3px 0 0;
    position: relative;
    border-bottom: 1px solid #ddd;
    background-color: #fff;
    padding: 0px 0 0px 35px;
    height: 30px;
    cursor: pointer;
}
</style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar menu-width" id="sidebar-id" data-color="purple" data-image="../assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                 <img src="../assets/img/big-logo.png" class="logo-display display-none"/>
                <a href="http://www.creative-tim.com" class="simple-text display-none" >
                    Sri Chaitanya
                </a>
                <div class="minimize display-none padding-left-8 pointer" id="slide_left"><i class="fa fa-arrow-left" style="font-size: 20px;" ></i></div>
                      <div class="maximize display-block padding-left-8 pointer" id="slide_right"><i class="fa fa-arrow-right" style="font-size: 20px;"></i></div>
            </div>

            <ul class="nav">
                <li >
                    <a href="../1_dashboard/">
                        <i class="fa fa-tachometer" title="Dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="../2_create_exam/">
                        <i class="fa fa-pencil-square-o" title="Create IPE Exam"></i>
                        <p>Create IPE Exam</p>
                    </a>
                </li>
                <li>
                    <a href="../3_view_created_exam/">
                        <i class="pe-7s-note2 " title="View Exam" ></i>
                        <p>View Created Exam</p>
                    </a>
                </li>
                <li > 
                    <a href="../5_merge_exams/">
                        <i class="fa fa-code-fork" title="Merge Exams"></i>
                        <p>Merge Exams</p>
                    </a>
                </li>
                <li >
                    <a href="../4_manage_users/">
                        <i class="fa fa-shield" title="Manage Users"></i>
                        <p> Manage Users</p>
                    </a>
                </li>
                <li class="">
                    <a href="../7_target_achived">
                        <i class="fa fa-bullseye" title="Target Achived"></i>
                        <p>Target Achived</p>
                    </a>
                </li>
                
                  <li class="">
                    <a href="../6_Reports">
                        <i class="fa fa-bar-chart" title="Reports"></i>
                        <p>Reports</p>
                    </a>
                </li>
                
               
                <li class="active-pro">
                    <a href="#">
                        <i class="pe-7s-rocket"></i>
                        <p>DEMO</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel main-panel-width"  id="main-panel-id">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Create IPE Exam</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret"></b>
                                    <span class="notification">5</span>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a>
                               <i class="fa fa-user-circle" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                           <a style="padding-left: 0px;margin-left: -4%;">
                               <?php echo $_SESSION['employee_name']; ?>
                            </a>
                        </li>
                        
                        <li>
                            <a href="../../secure_login/logout/">
                                <i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-md-12">
                        <div class="card" style=>
                            <div class="header">
                                <!--<h4 class="title">Create Exam</h4>-->
                            </div>
                            <div class="content">

                            <style>
                               select{margin-top:-3%;}
                            </style>
                                
                                   <div class="row">

                                      <div class="col-md-12">
                                       <center><p style="font-size: 24px;font-weight: bold;color: #52c7eb;">CREATE IPE EXAM</p></center>
                                      

                                      </div> 
                                       <div class="col-md-3 padding-left-4">
                                            <div class="form-group ">
                                               <label>Test Code</label>
                                               <div id="">
                                                 <input type="text" name="testcode" id="test_code" class="form-control "  style="width:450px;" readonly>
                                               
                                               </div>
                                            </div>
                                        </div>
                                         <hr style="    border-top: 2px solid #52c7eb;width: 97%;">
                                   </div>
                                    <div class="row" >
                                        <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                               <label>Group</label>
											   <div id="group">
											      <select class="form-control testSelAll SumoUnder group" >
                                                     <option value="">Select Group</option>
                                             
                                                  </select>
											   
											   </div>
                                                  
                                            </div>
                                        </div>
                                       
                                         
                                          <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                               <label>Year</label>
                                               <div id="year">
                                                  <select class="form-control testSelAll SumoUnder year" multiple="multiple">

                                            
                                                  </select>
                                               
                                               </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                               <input type="hidden" name="User" id="User" value="<?php echo $_SESSION['payroll_id']; ?>">
                                                   <label>Stream</label>
                                               <div id="stream">
                                                  <select class="form-control testSelAll SumoUnder stream" multiple="multiple">

                                            
                                                  </select>
                                               
                                               </div>
                                            </div>
                                        </div>
                                        
                                         <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                               <label>Program Name</label>
                                               <div id="program_name">
                                                  <select class="form-control testSelAll SumoUnder program_name" multiple="multiple">

                                            
                                                  </select>
                                               
                                               </div>
                                        </div>
                                        </div> 

                                        <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                               <label>Scheduled Program Name</label>
                                               <div id="main">
                                                  <select class="form-control testSelAll SumoUnder main_program" >

                                            
                                                  </select>
                                               
                                               </div>
                                        </div>
                                        </div>    




                                 
                                       
                                        
										<div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                                
                                                   <label>Test Type</label>
                                                   
                                                   <div>
                                                   <select class="form-control " id="test_type" style="width:200px;margin-top: 1%;"  >
                                                   <option value="selected">Select Test Type</option>
                                                  <?php
                                                    $res=$con->query("select * from 0_test_types where test_type_id<>0 ORDER BY test_type_id ");
                                                    while($row=mysqli_fetch_array($res))
                                                    {
                                                        echo '<option value="'.$row['test_type_id'].'">'.$row['test_type_name'].'</option>';
                                                    }
                                                    
                                                    ?>
                                                    
                                            
                                                </select>
                                                </div>
                                            </div>
                                        </div>
										 <!-- <div class="col-md-3 padding-left-4"> -->
                                            <!-- <div class="form-group">
                                               <label>Mode</label>
                                                   <div id="mode">
                                                   <select class="form-control testSelAll SumoUnder mode" >
                                                   <option value="xxx">Select Test Mode</option>
                                               
                                                    
                                            
                                                </select>
                                                </div>
                                            </div> -->
                                        <!-- </div> -->

                                        <!-- <div class="col-md-3 padding-left-4"> -->
                                           <!--  <div class="form-group" >
                                                
                                                   <label>Paper Model Year</label>
                                                   <div id="paper_model_year">
                                                   <select class="form-control testSelAll SumoUnder">
                                                   <option value="xxx">Select Model Year</option>
                                                    
                                          
                                                    
                                            
                                                   </select>
                                                   </div>
                                                   
                                                   
                                                   
                                            </div> -->
                                        <!-- </div> -->
                                        <!-- <div class="col-md-3 padding-left-4"> -->
                                               <!--  <div class="form-group">
                                                <label>Exam Conduction State</label>
                                                <div id="states">
                                                
                                                  <select class="form-control testSelAll SumoUnder states" multiple="multiple" >
                                                     <option value="">Select States</option>
                                             
                                                  </select>



                                                 </div>  
                                                </div> -->
                                        <!-- </div> -->
										

									
                                         <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                               <label>Exam Date</label>
                                               <div>
                                               
                                                <input type="text" class=" datepicker form-control testSelAll " placeholder="DD-MM-YYYY" id="start_date" style="width:200px"  onchange="test_code_details()" >
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                                <label>Last Date for Upload</label>
                                                <div>
                                                <input type="text" class=" datepicker form-control testSelAll " placeholder="DD-MM-YYYY" id="last_date_to_upload" style="width:200px" onchange="test_code_details()">
                                                </div>   
                                            </div>
                                        </div>
										     <div class="col-md-3 padding-left-4">
                                                <!-- <div class="form-group">
                                                <label>Time</label>
												<div >
                                                    <input type="text" id="time" class="  form-control testSelAll " style="width:200px;"/>
                                                </div>
                                                </div> -->
                                        </div>

                                         <div class="col-md-3 padding-left-4">
                                            <!-- <div class="form-group">
                                               <label>Syllabus</label>
                                               <div id="group">
                                                     <select class="form-control testSelAll SumoUnder" id="syllabus_id" >
                                                        <option value="">Select Syllabus</option>
                                                        <?php
                                                        $res=$con->query("select syllabus_id,syllabus_name from 0_syllabus");
                                                        while($row=mysqli_fetch_array($res))
                                                        {
                                                                echo '<option value="'.$row['syllabus_id'].'">'.$row['syllabus_name'].'</option>';
                                                        }
                                                        ?>
                                                 
                                             
                                                  </select>
                                               
                                               </div>
                                            </div> -->
                                        </div>  
										
										
										   
                                   </div>

                                     
                                     <div class="row">&nbsp;</div><!-- 
                                     <div class="row">
                                       <center><p style="font-size: 18px;color: #52c7eb;">Paper Details</p></center>
                                       <hr style="    border-top: 1px solid #52c7eb;width: 97%;">
                                   </div>
                                    
                                    <div class="row">

                                    
                                         <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                               <label>Select College of Setter</label>
                                               <div id="setter_college">
                                               
                                                <select class="form-control testSelAll SumoUnder setter_college"  multiple="multiple" onclick="test()">
                                          

                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                



                                        <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                                <label>Setter Name</label>
                                                <div id="paper_setter">
                                                 <select class="form-control testSelAll SumoUnder paper_setter" multiple="multiple" >
                                                     <option value="">Paper Setter Name</option>
                                             
                                                  </select>
                                                </div>   
                                            </div>
                                        </div>
                                             
                                   

                                        <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                               <label>Select College of Evaluator</label>
                                               <div id="evaluator_college">
                                               
                                                <select class="form-control  testSelAll  SumoUnder evaluator_college"  multiple="multiple">
                                          

                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                



                                        <div class="col-md-3 padding-left-4">
                                            <div class="form-group">
                                                <label>Evaluator Name</label>
                                                <div id="paper_evaluator">
                                                 <select class="form-control testSelAll SumoUnder paper_evaluator" multiple="multiple" >
                                                     <option value="">Paper Evaluator Name</option>
                                             
                                                  </select>
                                                </div>   
                                            </div>
                                        </div>

                                      </div>
 -->
                                    <div class="row">

                                    
                                         
                                             <div class="col-md-12 padding-left-4">
                                                <div class="form-group">

                                                <button type="submit" class="btn btn-info btn-fill pull-right" id="create_exam_button" style="position: absolute;    margin-left: 43%;" >Create</button>
                                                <!--<label>Exam Conduction City</label>-->
                                                <div>
                                                <!--<input type="text" class="timepicker form-control testSelAll " placeholder="Time" id="time" style="width:78%">-->
                                                 </div>

                                                </div>
                                        </div>
                                    </div>



                            
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>



    </div>

<?php
require("../000_main_includes/common_page.php");
     function get_version()
{
   
   return $mtime = filemtime('custom.js');



}

?>
<footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                   &copy; 2018 <a href="http://srichaitanya.net/">Sri Chaitanya Educational Institutions</a>
                </p>
            </div>
        </footer>
        </div>
</body>

<script>

</script>



  <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="../assets/js/mdtimepicker.js"></script>
	<script src="sumoselect/jquery.sumoselect.js"></script>
    <script src="sumoselect/sumoselect.js"></script>
	 <script src="../assets/js/light-bootstrap-dashboard.js"></script>
	<script src="custom.js?v=<?php echo get_version();?>"></script>
	   <script src="../../js/jquery-ui.js"></script>
       <script src="../../js/jquery-timepicker.js"></script>
       <script src="../assets/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
    
  $( function() {
    var today = new Date();
    $( ".datepicker" ).datepicker(
       {
           dateFormat: 'dd-mm-yy' ,
           minDate: 0     
       }
    );

    $('.timepicker').timepicker({
    timeFormat: 'HH:mm',
    interval: 30,
    minTime: '8',    
    //defaultTime: '10',   
    dynamic: false,
    dropdown: true,
    scrollbar: true
});

     

     $('#time').mdtimepicker();
  
  });


  
    </script>
	
	
</html>
