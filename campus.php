<?php
include_once '../../secure_login/includes/functions.php';
sec_session_start();
if(($_SESSION['is_doe']==false) && ($_SESSION['is_principal']==false) && ((!isset($_SESSION['is_doe'])) || (!isset($_SESSION['is_principal']))))
{
    Header('Location:../../secure_login/'); 
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/big-logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Sri Chaitanya</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
  

    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <link href="../assets/css/demo.css" rel="stylesheet" />
<link rel="stylesheet" href="aria-progressbar.css" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
   
<style type="text/css">
.table {
   display: table;
   height: 36px;
   width: 100%;
   table-layout: fixed;
}
.panel-heading{
   background-color: #f5f5f5;
   color: black;
}
.progress {
  border-color: silver;
  border-radius: 0.35rem;
  border-width: 0.05rem;
  height: 3rem;
}
.table{
    margin-bottom: -20px;
}
.progress__bar {
  /*background-color: #5cb85c;*/
  border-radius: 0.35rem;
  border-width: 0;
  height: 3rem;
  -webkit-transition: 0.1s width ease;
  -o-transition: 0.1s width ease;
  transition: 0.1s width ease;
}
.pagination {
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
}

.pagination a.active {
    background-color: #9928d1;
    color: white;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

.form-control {
    background-color: #FFFFFF;
    border: 1px solid #E3E3E3;
    border-radius: 4px;
    color: #565656;
    padding: 8px 12px;
    height: 27px;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 2px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
.btn{
    padding:3px 10px 3px 10px;
}
.modal-header{
    /*background-color: #1DC7EA ! important;*/
}
.card {
    border-radius: 4px;
    box-shadow: 0 3px 12px grey ! important;
    background-color: #FFFFFF;
    margin-bottom: 30px;
}


.progress-bar-success {
	
    background-color: #5cb85c;
    background: #5cb85c;
    background: -webkit-linear-gradient(#12f912,#5cb85c);
    background: -o-linear-gradient(#12f912,#5cb85c);
    background: -moz-linear-gradient(#12f912,#5cb85c);
    background: linear-gradient(#12f912,#5cb85c);
}
.progress__bar {
	
	
    background-color: #5cb85c;
    background: #5cb85c;
    background: -webkit-linear-gradient(#12f912,#5cb85c);
    background: -o-linear-gradient(#12f912,#5cb85c);
    background: -moz-linear-gradient(#12f912,#5cb85c);
    background: linear-gradient(#12f912,#5cb85c);
}

.info-input{
    border: 0px;
    padding-left: 1%;
    color: red;
    font-weight: 600;
}
#sel1{
    height: 35px;
}
.table-borderless td,
.table-borderless th {
    border: 0;
}
.table > thead > tr > th{
  background-color: #23343a;
  padding: 9px;
  text-align: center;
  color: white;
}
 th,td{
  /*max-width: 50px;*/
  overflow: hidden;
  /*font-size: 11px;*/
    word-wrap: break-word;
}

.btn-info {
    border-color: transparent;
    color: #23343a;
}
.btn-info:hover {
  border-color: transparent;
}
.btn-info:active {
  border-color: transparent;
}
.btn-info:focus {
  border-color: transparent;
}
</style>

</head>
<body onload='fetchdata("http://103.206.115.37/ipe/public/api/sectionlist",0);coll();'>
<!-- info modal -->
 <!-- Modal -->

  <div class="modal fade" id="info" role="dialog" style="z-index:10000;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="left: -139%;width: 184%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Info File</h4>
        </div>
        <div class="modal-body" style="height: 90px;overflow-x: scroll">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Subject Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name" value="Maths">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Q No Start</label>
                                                <input type="text" class="form-control" placeholder="Last Name" value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Q No End</label>
                                                <input type="text" class="form-control" placeholder="Last Name" value="30">
                                            </div>
                                        </div>
        </div>
        <div class="modal-footer">
           <button type="submit" class="btn btn-info btn-fill pull-right" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>

<!-- info modal -->
 <!-- Modal -->
  <div class="modal fade" id="Mark" role="dialog" style="z-index:1000000000;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="left: 52%;width: 184%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Mark File</h4>
        </div>
        <div class="modal-body" style="height: 90px;">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Qno From</label>
                                                <input type="text" class="form-control" placeholder="Last Name" value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Q No To</label>
                                                <input type="text" class="form-control" placeholder="Last Name" value="10">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>+ve Mark</label>
                                                <input type="text" class="form-control" placeholder="Last Name" value="4">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>-ve Mark</label>
                                                <input type="text" class="form-control" placeholder="Last Name" value="1">
                                            </div>
                                        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info btn-fill pull-right" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>


<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="    width: 125%;left: -13%;">
        <div class="modal-header" style=" background-color: #23343a;">
          <h4 class="modal-title" style="display:inline;color:white;" align="center">Student Subjectwise Marks List</h4>
          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>&nbsp;&nbsp;
          <button type="submit" id="skip" class="btn btn-danger btn-fill" data-dismiss="modal"  onclick="update(1,'all','n','n','n','n')" style="float: right;"><i class="fa fa-undo"></i></button> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
          <!-- update('+value.sl+','+value.sl+','+index+',\''+value.ADM_NO+'\',\''+CAMPUS_ID+'\',\''+SECTION_ID+'\') -->
          <button type="submit" id="notify" style="float: right;" class="btn btn-warning btn-fill" data-dismiss="modal" onclick="notify()"><i class="fa fa-bell"></i></button> &nbsp;&nbsp;  
          <input type="hidden" name="notifytext" id="notifytext">
          <input type="hidden" name="campus" id="campus">
        </div>
        <div class="modal-body">
         <div class="row">

            <div class="col-md-12">
                 <div class="">
                           
                                <!-- <h4 style="display:inline;" class="title">Subject Details</h4> -->
                             
                            <div class="content table-responsive ">
                                <table class="table table-hover" id="tab">
                                    <thead class="subhead" style="background-color: #23343a;
  padding: 9px;
  text-align: center;
  color: white;">
                                       
                                        
                                        
                                    </thead>
                                    <tbody class="student_list">
                                       
                                    </tbody>
                                </table>
                                <div class="student_page">
 
                                </div>
                            </div>
                        </div>
            </div>



            
          </div>

          
        </div>
        <div class="modal-footer">
             <button type="submit" class="btn btn-info btn-fill pull-right" data-dismiss="modal">CLOSE</button>
          
        </div>
      </div>
    </div>
  </div>
  
  <!-- Result Modal Start-->
  <!-- Modal -->
  <div class="modal fade" id="display_result_modal" role="dialog">
    
  </div>
  <!-- Result Modal Ends -->
  
    <div class="modal fade" id="imk_modal_id" role="dialog">
   
  </div>
  
  
  

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
                    <a href="../3_view_created_exam/">
                        <i class="pe-7s-note2"  title="View Exam"></i>
                        <p>View Created Exam</p>
                    </a>
                </li>
                 <li>
                    <a href="">
                        <i  class="fa fa-bar-chart" title="Reports"></i>
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
                    <a class="navbar-brand" href="#">Exam</a>
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

        <div class="content" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="width: 100%;padding:0px;">
 <div class="content">
            <div class="container-fluid">
                <div class="row">
                   <!-- filter -->
                            <div class="col-md-12" style="padding-left: 0px;" >
                                    
                                    <div class="form-group form-inline col-md-6" >
                                         <label for="campus" class="font_monte" >Choose Campus: </label>
                                        
             <select id="campus_select" onchange="fetchdata('http://103.206.115.37/ipe/public/api/sectionlist',this.value)" class="form-control" style="height: 35px;">
              <option>SELECT_ALL</option>
            </select>
        </div>
        <br><br>

        <div class="col-md-12">
            <table class="table table-striped table-dark" style="margin-bottom:0px;">
            <thead><th>CAMPUS_CODE</th><th>CAMPUS_NAME</th><th>PRINCIPAL_MOBILE</th><th>CITY</th><th>STATE</th><th>DISTRICT</th><th>STATUS</th></thead></table>
            <div class="list panel-group" id="accordion" role="tablist" aria-multiselectable="false">
               
            </div>
<center>
<div class="pagination">
 
</div></center>

        </div>
    </div>
</div>

                    </div>


                 


                </div>
            </div>
        </div>

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
</div>



	<div id="upload_div" class="hidden" style="position: fixed;top: 18%;z-index: 9999;left: 28%;background-color: #F0F0F0;width: 50%;min-height: 50%;border: 2px solid grey;">
	

	</div>
	<div id="opacity_div" class="hidden" style="position: fixed;top: 0%;z-index: 9998;opacity: 0.7;background-color: grey;width: 100%;min-height: 100%;border: 2px solid grey;"></div>
	
	
	<!-- PROCESS OVERLAY STARTS-->
	<div id="opacityo_div2" class="hidden" style="position: fixed;top: 5%;z-index: 9999;left: 5%;background-color: #F0F0F0;width: 90%;min-height: 80%;border: 2px solid grey;">
	
	
	             

             <p style="background-color: #7e7eef;color: white; text-shadow: 2px 2px 4px #000000;font-size: 24px;padding: 1%;">  Invalid USN Numbers:  </p>
                    <div class="form-group">
					
					<!--<div id="error_content" style="max-height:500px;overflow-y:scroll;" > -->
                    <div id="error_content" style="max-height:500px;overflow-y:scroll;" > 
					</div>
					
                       
                        
				</b>
				<!--<div style="margin-left:88%;"><br><button type="button" class="btn btn-primary">Cancel</button></div><br>-->
                </div>
	</div>
	
	<!--PROCESS OVERLAY ENDS -->
	  <!-- Modal -->
<div id="display_all_details" class="modal fade" role="dialog" style="    height: 600px;">
  <div class="modal-dialog" style="max-height: 550px;margin-top:5%;">

    <!-- Modal content-->
    <div class="modal-content" style="    max-height: 550px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Exam Details</h4>
      </div>
      <div class="modal-body">
        <div id="display_contents" style="    height: 350px;
    overflow-y: scroll;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>

  </div>
</div> 

   <!-- Modal -->
<div id="display_merged_details" class="modal fade" role="dialog" style="    height: 600px;">
  <div class="modal-dialog" style="    height: 490px;    display: block;    margin-left: 14%;">

    <!-- Modal content-->
    <div class="modal-content" style=" max-height: 500px;    margin-top: 13%;    width: 70em;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Exam Details</h4>
      </div>
      <div class="modal-body" style="overflow-y: scroll; ">
        <div id="display_contents_merged" style="    height: 350px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>  
	
	
<!-- 	
<?php
require("../000_main_includes/common_page.php");
function get_version()
{
   return $mtime = filemtime('custom.js');
}
?> -->
</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
     
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
  

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="../assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="../assets/js/demo.js"></script>
	<!-- <script src="custom.js?v=<?php echo get_version();?>"></script> -->
	  

<div id="wait" style="width: 100%;height: 100%;z-index: 9999999;position: fixed;top: 0%;left: 0%;padding: 2px;background-color: #cecaca; opacity: 0.5;"><img onclick="window.location.href="" src="../assets/demo_wait.gif" width="64" height="64" style="
    margin-left: 50%;
    margin-top: 20%;cursor:pointer;
"><br>
<span style="margin-left:50%;">Loading..</span>

</div>
<script type="text/javascript">

    // $(document).ready(function(){

$(document).ready(function(){
        $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
    show_group_list();  
});
function fetchdata(ul,c){
  // alert(c);
    // alert(ul);
    var url="http://103.206.115.37/ipe/public/api/studlist";
        $.ajax({
            type: 'GET',
            data:{campus_id:c,exam_id:<?php echo $_GET['exam_id']; ?>},
            url:ul,
            success:function(data){
              var status='<i class="fa fa-warning"></i>';
                var select;
               $.each(data.campus, function(index, value) {    
                select+='<option value="'+value.CAMPUS_ID+'">'+value.CAMPUS_ID+'</option>';

               });
               $('#campus_select').append(select); 
         var output="";
              $.each(data.exam[0].data, function(index, value) {     
        if(data.exam[0].data[index].section.length)
        {
        if(data.exam[0].data[index].check.length==data.exam[0].data[index].section.length)
        {
          status='<i class="fa fa-check" aria-hidden="true"></i>';
        }
        output += ' <div class="panel panel-default"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+index+'" aria-controls="collapse'+index+'" aria-expanded="false" class="collapsed"><div class="" role="tab" id="heading'+index+'" style="color:black;"><table class="table table-hover  table-bordered table-break-down" style="margin-bottom:0px;"><tbody><tr ><td> '+value.CAMPUS_CODE+'</td><td>'+value.CAMPUS_NAME+'</td><td>'+value.PRINCIPAL_MOBILE+'</td><td>'+data.exam[0].data[index].city.CITY_NAME+'</td><td>'+data.exam[0].data[index].state.STATE_NAME+'</td><td>'+data.exam[0].data[index].district.DISTRICT_NAME+'</td><td><button type="button" class="btn btn-info btn-lg" data-toggle="modal">'+status+'</button></td></tr></tbody></table></div></a><div id="collapse'+index+'" class="panel-collapse collapse" aria-expanded="false" role="tabpanel" aria-labelledby="heading'+index+'"><div class="panel-body"><table class="table table-striped" style="margin-bottom:0px;"><thead><th>SECTION_ID</th><th>SECTION_NAME</th><th>ACADEMIC_ID</th><th>COURSE_TRACK_ID</th><th>CAMPUS_TRACK_ID</th><th>COURSE_FEE_ID</th><th>STATUS</th></thead><tbody style="background-color:white;">';  
         status='<i class="fa fa-warning"></i>';     
                $.each(data.exam[0].data[index].section, function(index, value) 
                {    

                  // if(value.STATUS=='1')             
        output +='<tr><td>'+value.SECTION_ID+'</td><td>'+value.section_name+'</td><td>'+value.ACADEMIC_ID+'</td><td>'+value.COURSE_TRACK_ID+'</td><td>'+value.CAMPUS_TRACK_ID+'</td><td>'+value.COURSE_FEE_ID+'</td><td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="call(\''+url+'\','+value.SECTION_ID+','+value.CAMPUS_ID+')"><i class="fa fa-eye" aria-hidden="true"></i></button></td></tr>';
         //           if(value.STATUS=='0')            
         // output +='<tr><td>'+value.SECTION_ID+'</td><td> '+value.section_name+'</td><td><button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal" onclick="call(\''+url+'\','+value.SECTION_ID+')">PENDING</button></td></tr>';
                    });
       output +='</tbody></table></div></div></div>';
  
      }
        }); 
            var paginate='';
            paginate+="<ul class='pagination'>";
                paginate+="<li><a href='#' onclick='fetchdata(\""+data.exam[0].first_page_url+"\",0);'><<</a></li>";
                paginate+="<li ><a onclick='fetchdata(\""+data.exam[0].prev_page_url+"\",0)'><</a></li>";
                 // paginate+="<li ><a href='#'>"+data.last_page+"</a></li>";
                paginate+="<li ><a href='#'>"+data.exam[0].from+"</a></li>";
                // paginate+="<li ><a href='#'>"+data.per_page+"</a></li>";
                // paginate+="<li ><a href='#'>"+data.to+"</a></li>";
                // paginate+="<li ><a href='#'>"+data.total+"</a></li>";

                paginate+="<li ><a onclick='fetchdata(\""+data.exam[0].next_page_url+"\",0)'>></a></li>";
                paginate+="<li><a href='#' onclick='fetchdata(\""+data.exam[0].last_page_url+"\",0)'>>></a></li>";
            paginate+="</ul>";
                  $('.pagination').html(paginate);
                 $('.list').html(output);
            }
        });
    return true;
}
 function call(ul,SECTION_ID,CAMPUS_ID){
  // alert(SECTION_ID);
   document.getElementById('notifytext').value=SECTION_ID;
   document.getElementById('campus').value=CAMPUS_ID;
   $.ajax({
            type: 'GET',
            data:{SECTION_ID:SECTION_ID,exam_id:<?php echo $_GET['exam_id']; ?>},
            url:ul,
            success:function(data){
              
         var output="";
              $.each(data.Student.data, function(index, value) {     
      
        output += '<tr><td><input type="checkbox" id="'+index+'" onclick="changecheck('+index+')"/></td><td>'+value.ADM_NO+'</td><td>'+value.NAME+'</td><td>'+value.PHYSICS+'</td><td>'+value.CHEMISTRY+'</td><td>'+value.MATHEMATICS+'</td><td>'+value.BIOLOGY+'</td><td>'+value.BOTANY+'</td><td>'+value.ZOOLOGY+'</td><td>'+value.ENGLISH+'</td><td> '+value.GK+'</td><td>'+data.end[0].last_date_to_upload+'</td><td> <button type="submit" id="s'+index+'"  class="btn btn-info btn-fill" onclick="update('+value.sl+','+value.sl+','+index+',\''+value.ADM_NO+'\',\''+CAMPUS_ID+'\',\''+SECTION_ID+'\')"><i class="fa fa-undo"></i></button></td></tr>';
        //data-dismiss="modal"
      
        }); 
              var output1='<th style="width:30px;"><input type="checkbox" id="selectAll" onclick="skip(this)"/></th><th>ADM_NO</th><th>NAME</th>';
              $.each(data.Subject, function(index, value) {  
              if(value.Field=='PHYSICS'||value.Field=='CHEMISTRY'||value.Field=='MATHEMATICS'||value.Field=='BIOLOGY'||value.Field=='BOTANY'||value.Field=='ZOOLOGY'||value.Field=='ENGLISH'||value.Field=='GK')        
        output1 += '<th>'+value.Field+'</th>';
      
        }); 
              output1+='<th>LASTDATE</th><th>ACTION</th>';

            var paginate='';
            paginate+="<ul class='pagination'>";
                paginate+="<li><a href='#' onclick='call(\""+data.Student.first_page_url+"\","+SECTION_ID+");'><<</a></li>";
                paginate+="<li ><a onclick='call(\""+data.Student.prev_page_url+"\","+SECTION_ID+")'><</a></li>";
                paginate+="<li ><a onclick='call(\""+data.Student.next_page_url+"\","+SECTION_ID+")'>></a></li>";
                paginate+="<li><a href='#' onclick='call(\""+data.Student.last_page_url+"\","+SECTION_ID+")'>>></a></li>";
            paginate+="</ul>";
                  $('.student_page').html(paginate);
                 $('.student_list').html(output);
                 $('.subhead').html(output1);
            }
        });
    return true;


 }

  function skip(a){
     $(a).closest('table').find('td input:checkbox').prop('checked', a.checked);
     if(a.checked)
       $('#skip').prop('disabled', false);
   if(!a.checked)
       $('#skip').prop('disabled', false);
  }
  function update(b,a,c,d,e,f){
    if(f=='n'){
       f=document.getElementById('notifytext').value;
   e=document.getElementById('campus').value;
    }
   
    
    alert("skipped successfully");
   $.ajax({
            type: 'GET',
            data:{sl:b,check:a,STUD_ID:d,EXAM_ID:<?php echo $_GET['exam_id'];?>,CAMPUS_ID:e,SECTION_ID:f},
            url:"http://103.206.115.37/ipe/public/api/updatemanage",
            success:function(data){
              
         var output="";
              $.each(data, function(index, value) {     
      
        output += '';
        //data-dismiss="modal"
      
        });
            }
        });
    return true;

  }
 function changecheck(c){
    var text='#s'+c;
    $(text).prop('disabled',false);
 }
 function notify(){
    var section_id=$('#notifytext').val();
     $.ajax({
            type: 'GET',
            data:{
                SECTION_ID:section_id,
                exam_id:<?php echo $_GET['exam_id']; ?>
            },
            url:"http://103.206.115.37/ipe/public/api/notify",
            success:function(data){
                  $.each(data.Subject, function(index, value) {     
                     $.ajax({
                        type: 'GET',
                        data:{SECTION_ID:section_id},
                        url:"http://smsc.vianett.no/v3/send.ashx?src="+value[0].MOBILENO+"&dst="+value[0].MOBILENO+"&msg="+data.Result[0].ADM_NO+','+data.Result[0].ADM_NO+'_upload_these_student_details'+"&username=muthumaharajan1992@gmail.com&password=bawq9",
                        success:function(data){                        
                            if(data=='200|OK')
                          alert('Message send to all employee');
                        }

                        });
                    });
            }
        });
 }
function coll(){

}
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
</html>
