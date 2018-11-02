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
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../css/jquery-ui.css">
    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
   <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/mdtimepicker.css" rel="stylesheet" type="text/css">
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link href="sumoselect/sumoselect.css" rel="stylesheet" />
   

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="sumoselect/sumoselect.css" rel="stylesheet" />

<style type="text/css">
    
.table > thead > tr > th{
  background-color: #23343a;
  padding: 0px;
  text-align: center;
  color: white;
}
.table > tbody > tr > td{

  padding: 0px;
  text-align: center;
  /*color: white;*/
}
.btn-lg.active.focus, .btn-lg.active:focus, .btn-lg.active:hover, .btn-lg:active.focus, .btn-lg:active:focus, .btn-lg:active:hover, .open>.dropdown-toggle.btn-lg.focus, .open>.dropdown-toggle.btn-lg:focus, .open>.dropdown-toggle.btn-lg:hover {
    color: #1DC7EA;
    /*background-color: #269abc;*/
    /*border-color: #1b6d85;*/
}
.btn-lg:hover{
    color: #1DC7EA;
}
.SumoSelect .select-all {
    height: auto;
}
</style>
</head>
<body onload='fetchdata("http://103.206.115.37/ipe/public/api/examlist"),crudApp.createTable("VSP100606")'>
  <div class="modal fade" id="squarespaceModal1" role="dialog" style="z-index:10000;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="left: -139%;width: 184%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit </h4>
        </div>
        <div class="modal-body" style="height: 90px;">                      
                <input type="hidden" name="PAYROLL_ID" class="uppayroll">
                <input type="hidden" name="subject_id" class="subject_id">
                <input type="hidden" name="section_id" class="section_id">
                <input type="hidden" name="id" class="upid">
              <div class="form-group col-md-3">
                <label for="exampleInputEmail1">Subject</label>
               <select class="form-control" id="upsubject" name="subject">
                <option>SELECT</option>
               </select>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputPassword1">Section</label>
               <select class="form-control" id="upsection" name="section">
                <option>SELECT</option>
               </select>
              </div>
        </div>
        <div class="modal-footer">
           <button type="submit" class="btn btn-info btn-fill pull-right" id="update" data-dismiss="modal">UPDATE</button>
        </div>
      </div>
    </div>
  </div>
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
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="    width: 125%;left: -13%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="display:inline;">info/key/Ans</h4><h4 class="modal-title" style="display:inline;position:relative;    left: 62%;">Last Edited On:11-11-2017</h4>
        </div>
        <div class="modal-body">
         <div class="row">
            <div class="col-md-6">
              <div class="card">
                                <h6 style="display:inline;position:relative;    left: 67%;">Last Edited On:11-11-2017</h6><br>
                                <h4 style="display:inline;" class="title">Info File</h4><h4 style="display:inline;    position: relative;
    left: 65%;cursor:pointer" data-toggle="modal" data-target="#info">ADD <i class="fa fa-plus-circle" aria-hidden="true"></i></h4>
                             
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Subject Name</th>
                                        <th>Question Start No</th>
                                        <th>Question End No</th>
                                        
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>MAT</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                        </tr>
                                        <tr>
                                            <td>MAT</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                        </tr>
                                        <tr>
                                            <td>MAT</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                        </tr>
                                        <tr>
                                            <td>MAT</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                        </tr>
                                        <tr>
                                            <td>MAT</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                        </tr>
                                        <tr>
                                            <td>MAT</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                
            </div>
            <div class="col-md-6">
                 <div class="card">
                                <h6 style="display:inline;position:relative;    left: 67%;">Last Edited On:11-11-2017</h6><br>
                                <h4 style="display:inline;" class="title">Mark File</h4><h4 style="display:inline;    position: relative;
    left: 65%;cursor:pointer" data-toggle="modal" data-target="#Mark">ADD <i class="fa fa-plus-circle" aria-hidden="true"></i></h4>
                             
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover ">
                                    <thead>
                                        <th>QNo From</th>
                                         <th>QNo To</th>
                                        <th>+ve Mark</th>
                                        <th>-ve Mark</th>
                                        
                                    </thead>
                                    <tbody>
                                        <tr>
                                      
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="4"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                        </tr>
                                        <tr>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="4"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                        </tr>
                                        <tr>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="4"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                        </tr>
                                        <tr>
                                           <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="4"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                        </tr>
                                        <tr>
                                          <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="4"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                        </tr>
                                        <tr>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="30" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="4"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
            </div>

            <div class="col-md-12">
                 <div class="card">
                           
                                <h4 style="display:inline;" class="title">Answer Key File</h4><h6 style="display:inline;    position: relative;
    left: 70%;">Last Edited On:11-11-2017</h6>
                             
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover ">
                                    <thead>
                                        <th style="    width: 52px;">Q NO</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        <th>X1</th>
                                        
                                        
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1-20</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                        </tr>
                                        <tr>
                                             <td>1-20</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                        </tr>
                                        <tr>
                                            <td>1-20</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                        </tr>
                                        <tr>
                                            <td>1-20</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                        </tr>
                                        <tr>
                                          <td>1-20</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                        </tr>
                                        <tr>
                                             <td>1-20</td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="1" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="2"></td>
                                            <td>  <input type="text" class="form-control" placeholder="3" ></td>
                                            <td>  <input type="text" class="form-control" placeholder="1"></td>
                                            <td>  <input type="text" class="form-control" placeholder="4" ></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
            </div>            
          </div>          
        </div>
        <div class="modal-footer">
             <button type="submit" class="btn btn-info btn-fill pull-right" data-dismiss="modal">STORE</button>    </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="display_result_modal" role="dialog">
  </div>
    <div class="modal fade" id="imk_modal_id" role="dialog">
  </div>
<div class="wrapper">
    <div class="sidebar menu-width" id="sidebar-id" data-color="purple" data-image="../assets/img/sidebar-5.jpg">
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
        <nav class="navbar navbar-default navbar-fixed" style="background-color: white;border-width:0 1px 1px 1px;">
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

<div class="container" style="margin-top: 10px;margin-left: 9px;">
  <form>
    <div class="form-group col-md-2" ><label for="sel1">Year:</label>
  <select class="form-control" id="year_id" onchange='fetchdata("http://103.206.115.37/ipe/public/api/examlist")'>
    <option value="">SELECT</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
    </div>
    <div class="form-group col-md-2"><label for="sel1">Group:</label>
  <select class="form-control" id="group_id" onchange='fetchdata("http://103.206.115.37/ipe/public/api/examlist")'>
    <option value="">SELECT</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
    </div>
    <div class="form-group col-md-2"><label for="sel1">Stream:</label>
  <select class="form-control" id="stream_id" onchange='fetchdata("http://103.206.115.37/ipe/public/api/examlist")'>
    <option value="">SELECT</option>
     <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
    </div>
    <div class="form-group col-md-2"><label for="sel1">Program:</label>
  <select class="form-control" id="program_id" onchange='fetchdata("http://103.206.115.37/ipe/public/api/examlist")'>
    <option value="">SELECT</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
    </div>
    <div class="form-group col-md-2"><label for="sel1">Status:</label>
  <select class="form-control" id="status" onchange='fetchdata("http://103.206.115.37/ipe/public/api/examlist")'>
    <option value="">SELECT</option>
    <option value="0">Ongoing</option>
    <option value="1">Completed</option>
    <option value="2">Upcoming</option>
  </select>
    </div>
 </form>
</div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/lumen/bootstrap.min.css">
<div class="container" style="margin-top:-35px;">
<div class="row">
<div id="user" class="col-md-12" >
  <div class="panel panel-primary panel-table animated slideInDown">
   <!-- <div class="panel-heading " style="padding:5px;background-color: #23343a;">
        <div class="row">
        <div class="col col-xs-3 text-left">
        </div> -->
      <!--   <div class="col col-xs-5 text-center" style="height: 40px;">
            <h1 class="panel-title">Exam's List</h1>
        </div> -->
        <!-- </div> -->
    <!-- </div> -->
   <div class="panel-body">
     <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="list">
       <table class="table table-hover table-striped">
        <thead>
         <tr>
            <th class="avatar">EXAM_ID</th>
            <th>TEST_CODE</th>
            <th>START_DATE</th>
            <th>Test_type_id</th>
            <th><em class="fa fa-cog"></em> Action</th>
          </tr> 
         </thead>
         <tbody class="list">
         
          </tbody>
        </table>
      </div><!-- END id="list" -->
        
      <div role="tabpanel" class="tab-pane " id="thumb">
        <div class="row">
        <div class="col-md-12">
        
        <div class="ok">
         <div class="col-md-3">
         <div class="panel panel-default panel-thumb">
            <div class="panel-heading">
                <h3 class="panel-title">Djelal Eddine</h3>
            </div>
            <div class="panel-body avatar-card">
             
            </div>
            <div class="panel-footer">
               <a href="#" class="btn btn-primary" title="Edit"    ><i class="fa fa-pencil"></i></a>
               <a href="#" class="btn btn-warning" title="ban"   ><i class="fa fa-ban"   ></i></a>
               <a href="#" class="btn btn-danger"  title="delete"  ><i class="fa fa-trash" ></i></a>
            </div>
         </div>
         </div>
       </div>
        
        <div class="ban">
         <div class="col-md-3">
         <div class="panel panel-default panel-thumb">
            <div class="panel-heading">
                <h3 class="panel-title">Moh Aymen</h3>
            </div>
            <div class="panel-body avatar-card">
             
            </div>
            <div class="panel-footer">
               <a href="#" class="btn btn-primary" title="Edit"    ><i class="fa fa-pencil">        </i></a>
               <a href="#" class="btn btn-warning" title="ban"   ><i class="fa fa-ban"   >admitted</i></a>
               <a href="#" class="btn btn-danger"  title="delete"  ><i class="fa fa-trash" >        </i></a>
            </div>
         </div>
         </div>
       </div>
        
        <div class="new">
         <div class="col-md-3">
         <div class="panel panel-default panel-thumb">
            <div class="panel-heading">
                <h3 class="panel-title">Dia ElHak</h3>
            </div>
            <div class="panel-body avatar-card">
            
            </div>
            <div class="panel-footer">
               <a href="#" class="btn btn-primary" title="Edit"    ><i class="fa fa-pencil"   >     </i></a>
               <a href="#" class="btn btn-success" title="validate"><i class="fa fa-check-square">validate</i></a>
               <a href="#" class="btn btn-warning" title="ban"   ><i class="fa fa-ban"       >      </i></a>
               <a href="#" class="btn btn-danger"  title="delete"  ><i class="fa fa-trash"     >        </i></a>
            </div>
         </div>
         </div>
       </div>
       
       </div>
      </div>
      </div><!-- END id="thumb" -->
       
     </div><!-- END tab-content --> 
    </div>
   
   <div class="page text-center" style="margin-top: -28px;">
        
   </div>
  </div><!--END panel-table-->
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

    
  
<div id="display_merged_details" class="modal fade" role="dialog" style="    height: 100%;">
  <div class="modal-dialog" style="    height: 100%;    display: block;    margin-left: 14%;">

    <!-- Modal content-->
    <div class="modal-content" style=" max-height: 800px;    margin-top: 13%;    width: 70em;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Exam Details</h4>
      </div>
      <div class="modal-body" >
        <div id="display_contents_merged" ></div>
         <div class="row" style="height: 100%;">
            <div class="col-md-3 padding-left-2">
                <div class="form-group">
                    <input type="hidden" name="exam_id" id="exam_id">
                   <label>Group</label>
                   <div id="group">
                      <select class="form-control testSelAll SumoUnder group" >
                         <option value="">Select Group</option>
                 
                      </select>
                   
                   </div>
                      
                </div>
            </div>
           
             
              <div class="col-md-3 padding-left-2">
                <div class="form-group">
                   <label>Year</label>
                   <div id="year">
                      <select class="form-control testSelAll SumoUnder year" >

                
                      </select>
                   
                   </div>
                </div>
            </div>

            <div class="col-md-3 padding-left-2">
                <div class="form-group">
                   <input type="hidden" name="User" id="User" value="HYD106702">
                       <label>Stream</label>
                   <div id="stream">
                      <select class="form-control testSelAll SumoUnder stream" >

                
                      </select>
                   
                   </div>
                </div>
            </div>
            
             <div class="col-md-3 padding-left-2">
                <div class="form-group">
                   <label>Program Name</label>
                   <div id="program_name">
                      <select class="form-control testSelAll SumoUnder program_name" >

                
                      </select>
                   
                   </div>
            </div>
            </div> 
             <div class="col-md-3 padding-left-2">
                <div class="form-group">
                    <button class="btn btn-info" id="add" onclick="create()">ADD</button>
                </div>
            </div>
        </div>

      </div>
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
      </div>
    </div>

  </div>
</div>  

 <!-- Modal -->
  <div class="modal fade" id="exams" role="dialog">
    <div class="modal-dialog" style="    width: 65%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Exam Details</h4>
        </div>
        <div class="modal-body" style="height: 400px;">
         <div id="display_exams" ></div>
         

        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  

<div id="wait" style="width: 100%;height: 100%;z-index: 9999999;position: fixed;top: 0%;left: 0%;padding: 2px;background-color: #cecaca; opacity: 0.5;"><img onclick="window.location.href="" src="../assets/demo_wait.gif" width="64" height="64" style="
    margin-left: 50%;
    margin-top: 20%;cursor:pointer;
"><br>
<span style="margin-left:50%;">Loading..</span>

</div>   
<!-- <?php
// require("../000_main_includes/common_page.php");
function get_version()
{
   return $mtime = filemtime('custom.js');
}
?> 
 -->


<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Manage</h3>
        </div>
        <div class="modal-body">
            <h1 id="code"></h1>
            <div id="container" >
                </div>
        </div>
        <div class="modal-footer">
            </div>
        </div>
    </div>
  </div>
</div>
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
    <script src="custom2.js?v=<?php echo get_version();?>"></script>
    <script src="custom.js?v=<?php echo get_version();?>"></script>
 
<script>
function getStyle(el, cssprop) {
    if (el.currentStyle)
        return el.currentStyle[cssprop];     // IE
    else if (document.defaultView && document.defaultView.getComputedStyle)
        return document.defaultView.getComputedStyle(el, "")[cssprop];  // Firefox
    else
        return el.style[cssprop]; //try and get inline style
}
//
function applyEdit(tabID, editables) {
    var tab = document.getElementById(tabID);
    if (tab) {
        var rows = tab.getElementsByTagName("tr");
        for(var r = 0; r < rows.length; r++) {
            var tds = rows[r].getElementsByTagName("td");
            for (var c = 0; c < tds.length; c++) 
            {
                if (editables.indexOf(c) > -1)
                    tds[c].onclick = function () { 
                        beginEdit(this); 
                    };
            }
        }
    }
}
var oldColor, oldText, padTop, padBottom = "";
function beginEdit(td) {
    if (td.firstChild && td.firstChild.tagName == "INPUT")
        return;

    oldText = td.innerHTML.trim();
    oldColor = getStyle(td, "backgroundColor");
    padTop = getStyle(td, "paddingTop");
    padBottom = getStyle(td, "paddingBottom");

    var input = document.createElement("input");
    input.value = oldText;
  
    //// ------- input style -------
    var left = getStyle(td, "paddingLeft").replace("px", "");
    var right = getStyle(td, "paddingRight").replace("px", "");
    input.style.width = td.offsetWidth - left - right - (td.clientLeft * 2) - 2 + "px";
    input.style.height = td.offsetHeight - (td.clientTop * 2) - 2 + "px";
    input.style.border = "0px";
    input.style.fontFamily = "inherit";
    input.style.fontSize = "inherit";
    input.style.textAlign = "inherit";
    input.style.backgroundColor = "LightGoldenRodYellow";

    input.onblur = function () { endEdit(this); };

    td.innerHTML = "";
    td.style.paddingTop = "0px";
    td.style.paddingBottom = "0px";
    td.style.backgroundColor = "LightGoldenRodYellow";
    td.insertBefore(input, td.firstChild);
    input.select();
}
function endEdit(input) {
    var td = input.parentNode;
      var b = $(td).closest('tr').find('td:first').text();
      var a =$(td).closest('table').find('th').eq($(td).index()).text();;

    td.removeChild(td.firstChild);  //remove input
    td.innerHTML = input.value;
    if (oldText != input.value.trim() ){
        var vall=input.value
        // td.style.color = "red";
        // alert(input.value);
        // alert(a);
        // alert(b);
        $.ajax({
              url:"http://103.206.115.37/ipe/public/api/edit_exam",
              data:{id:b,name:a,value:vall},
              type:"POST",
              success:function(data)
              {   
                // alert(data);
              }
        
          });
    }

    td.style.paddingTop = padTop;
    td.style.paddingBottom = padBottom;
    td.style.backgroundColor = oldColor;
}
applyEdit("tab1", [1, 2, 3, 4]);</script>

   
<script type="text/javascript">

$(document).ready(function(){
        $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
    show_group_list();  
});
    // $(document).ready(function(){

function fetchdata(ul){
    var year=$('#year_id').val();
    var group=$('#group_id').val();
    var stream=$('#stream_id').val();
    var program=$('#program_id').val();
    var status=$('#status').val();
    // alert(ul);
        $.ajax({
            type: 'GET',
            data:{
                  campus_id:<?php echo $_SESSION['campus_id']; ?>,
                  year:year,
                  group:group,
                  stream:stream,
                  program:program,
                  status:status,
              },
            url:ul,
            success:function(data){
              
         var output="";
              $.each(data.data, function(index, value) {     
      
        output += '<tr><td>'+ value.exam_id +'</td><td>'+ value.Exam_name +'</td><td>'+ value.Date_exam +'</td><td>'+ value.Test_type_id +'</td><td><div ><button data-toggle="modal" data-name="'+ value.exam_id +'"  onclick="call('+ value.exam_id +')";"  class="btn-lg" style="background: none;border: none" ><i class="fa fa-info-circle"></i></button><a href="#" class="btn-lg" onclick="call1('+value.exam_id+')" style="float:right; color:#23343a;"><i class="fa fa-pencil-square-o"></i></a></td><a href="#" class="btn-lg" onclick="call1('+value.exam_id+')" style="float:right;"><i class="fa fa-pencil-square-o"></i></a></td></div></tr>';
      
        }); 
            var paginate='';
            paginate+="<ul class='pagination'>";
                paginate+="<li><a href='#' onclick='fetchdata(\""+data.first_page_url+"\");'><<</a></li>";
                paginate+="<li ><a onclick='fetchdata(\""+data.prev_page_url+"\")'><</a></li>";

                // paginate+="<li ><a href='#'>"+data.last_page+"</a></li>";
                paginate+="<li ><a href='#'>"+data.from+"</a></li>";
                // paginate+="<li ><a href='#'>"+data.per_page+"</a></li>";
                // paginate+="<li ><a href='#'>"+data.to+"</a></li>";
                // paginate+="<li ><a href='#'>"+data.total+"</a></li>";

                paginate+="<li ><a onclick='fetchdata(\""+data.next_page_url+"\")'>></a></li>";
                paginate+="<li><a href='#' onclick='fetchdata(\""+data.last_page_url+"\")'>>></a></li>";
            paginate+="</ul>";
                  $('.page').html(paginate);
                 $('.list').html(output);
            }
        });
    return true;
}

//     function call1(exam_id){
//         // alert(exam_id);
//         document.getElementById('exam_id').value=exam_id;
//           var get_all_created_exam_list="yes"; 
//             var table="";
//     $.ajax({
//               url:"http://103.206.115.37/ipe/public/api/edit_exam_details",
//               data:{id:exam_id},
//               type:"GET",
//               success:function(data)
//               {
//               $('#display_merged_details').modal('show');

// table+='<div class="content table-responsive">';
// table+='<table  class="table table-striped table-bordered table-list"><thead>';
// table+='<th style="width: 2%;text-align:center;">Test_Code</th><th style="width: 2%;text-align:center;">GROUP_NAME</th><th>CLASS_NAME</th><th style="width: 12%;">STREAM_NAME</th><th>PROGRAM_NAME</th>';
// table+='<th>Action</th></thead><tbody>';   
//           $.each(data, function(index, value) {  

// table+='<tr><td>'+value.Exam_name+'</td><td>'+value.GROUP_NAME+'</td><td>'+value.CLASS_NAME+'</td><td>'+value.STREAM_NAME+'</td>';
// table+='<td>'+value.PROGRAM_NAME+'</td>';
// table+='<td><a href="#" onclick="deletes('+exam_id+',\''+value.action+'\')"><i class="fa fa-trash"></i></a></td></td><tr>';

//           });  
// table+='</tbody></table><br><hr style="border-top: 2px solid #52c7eb;">';
//           $('#display_contents_merged').html(table);     
//               }
        
//           });
//     }
 function call(exam_id){
    window.location.href = "campus.php?exam_id="+exam_id;
 }
</script>
<!-- <?php
$value = 100;
$value2="";
?>
<script type='text/javascript'>
var xyz = <?php echo $value; ?>;
var abc='123';
alert (xyz);
</script>
<script type="text/javascript">
    var myjavascript = "12345";
</script>

<?php 
   $phpVar =  '<script>document.write(myjavascript);</script>';

   echo $phpVar;
?> -->
<!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/js/mdtimepicker.js"></script>
    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>

        <script src="sumoselect/jquery.sumoselect.js"></script>
    <script src="sumoselect/sumoselect.js"></script>


    

    <!--  Charts Plugin -->
    <script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>
     <script src="../../js/jquery-ui.js"></script>
    <!--  Google Maps Plugin    -->
 

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="../assets/js/light-bootstrap-dashboard.js"></script>
    <script src="../assets/js/bootstrap-datepicker.min.js"></script>
    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="../assets/js/demo.js"></script>
      <script src="select_support/jquery.multi-select.js"></script>
  <script type="text/javascript">
  // run pre selected options
  $('#pre-selected-options').multiSelect();
  </script>

    <script src="custom2.js?v=<?php echo get_version();?>"></script>
    <script src="custom.js?v=<?php echo get_version();?>"></script>
    <script>
$('.modal').on("hidden.bs.modal", function (e) {
    if($('.modal:visible').length)
    {
        $('.modal-backdrop').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) - 10);
        $('body').addClass('modal-open');
    }
}).on("show.bs.modal", function (e) {
    if($('.modal:visible').length)
    {
        $('.modal-backdrop.in').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) + 10);
        $(this).css('z-index', parseInt($('.modal-backdrop.in').first().css('z-index')) + 10);
    }
});
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3, selectAll:true, captionFormatAllSelected: "Yeah, OK, so everything." });
            window.test = $('.testsel').SumoSelect({okCancelInMulti:true, captionFormatAllSelected: "Yeah, OK, so everything." });

            window.testSelAll = $('.testSelAll').SumoSelect({okCancelInMulti:true, selectAll:true });

            window.testSelAll2 = $('.testSelAll2').SumoSelect({selectAll:true});

            window.testSelAlld = $('.SlectBox-grp').SumoSelect({okCancelInMulti:true, selectAll:true, isClickAwayOk:true });

            window.Search = $('.search-box').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.' });
            window.sb = $('.SlectBox-grp-src').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.', selectAll:true });
            window.searchSelAll = $('.search-box-sel-all').SumoSelect({ csvDispCount: 3, selectAll:true, search: true, searchText:'Enter here.', okCancelInMulti:true });
            window.searchSelAll = $('.search-box-open-up').SumoSelect({ csvDispCount: 3, selectAll:true, search: false, searchText:'Enter here.', up:true });
            window.Search = $('.search-box-custom-fn').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.', searchFn: function(haystack, needle) {
              var re = RegExp('^' + needle.replace(/([^\w\d])/gi, '\\$1'), 'i');
              return !haystack.match(re);
            } });

            window.groups_eg_g = $('.groups_eg_g').SumoSelect({selectAll:true, search:true });


            $('.SlectBox').on('sumo:opened', function(o) {
              console.log("dropdown opened", o)
            });

        });
    </script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

</html>
</html>
