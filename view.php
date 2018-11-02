<?php
include_once '../../secure_login/includes/functions.php';
sec_session_start();
if(($_SESSION['is_exam_admin']==false) && (!isset($_SESSION['is_exam_admin'])))
{
    Header('Location:../../secure_login/'); 
}
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


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>
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
              url:"http://175.101.3.68/ipe/public/api/edit_exam",
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


</head>
<body>
<!-- info modal -->
 <!-- Modal -->
  <div class="modal fade" id="info" role="dialog" style="z-index:10000;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="left: -139%;width: 184%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Info File</h4>
        </div>
        <div class="modal-body" style="height: 90px;">
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
                <li >
                    <a href="../2_create_exam/">
                        <i class="fa fa-pencil-square-o" title="Create Exam"></i>
                        <p>Create Exam</p>
                    </a>
                </li>
                <li class="active">
                    <a href="../3_view_created_exam/">
                        <i class="pe-7s-note2 " title="View Exam" ></i>
                        <p>View Created Exam</p>
                    </a>
                </li>
                <li> 
                    <a href="../5_merge_exams/">
                        <i class="fa fa-code-fork" title="Merge Exams"></i>
                        <p>Merge Exams</p>
                    </a>
                </li>
                <li>
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
                    <a href="../6_Reports/">
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

    <div class="main-panel main-panel-width" id="main-panel-id" >
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


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="width: 100%;padding:0px">
                        <div class="card" >
                            <div class="header">
                                <h4 class="title">Created Exam List</h4>
                             
                            </div>

							<div id="display_all_created_exam_list"></div>
                            <center>
							<div class="pagination">
 
                            </div>
                            </center>
                        </div>
                    </div>


                 


                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    
                </nav>
                <p class="copyright pull-right">
                   &copy; 2018 <a href="http://srichaitanya.net/">Sri Chaitanya Educational Institutions</a>
                </p>
            </div>
        </footer>


    </div>
</div>
<?php
require("../000_main_includes/common_page.php");
?>

<div id="opacity_divv" class="hidden" style="position: fixed;top: 0%;z-index: 9998;opacity: 0.7;background-color: grey;width: 100%;min-height: 100%;border: 2px solid grey;"></div>

<div id="upload_divv" class="hidden" style="position: fixed;top: 3%;z-index: 9999;left: 4%;background-color: #F0F0F0;width: 92%;min-height: 92%;border: 2px solid grey;">

       </div>

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
        <div id="display_contents_merged" ></div>
         <div class="row" style="">
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
                    <button class="btn btn-info" id="add">ADD</button>
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



  <div class="modal fade" id="approval_status" role="dialog">

  </div>



    <div class="modal fade" id="recompute" role="dialog">

  </div>





<?php
       function get_version()
{
   
   return $mtime = filemtime('custom2.js');



}
   ?>

</body>
   
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
