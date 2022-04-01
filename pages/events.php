<?php
require_once "../config/db_config.php";
require_once "../header.php";
include('../classes/GoogleCrmClient.php');
include "../services/getselectlisting.php";
$crmObj = new GoogleCrmClient();
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="<?php echo BASE_URL; ?>js/moment.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>

<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include('../sidebar.php');?>
<div class="content">
   <div class="main-panel">
        <div class="content-wrapper">
         <h3 class="font-weight-bold pt-3">Events</h3>
      
    <?php
    $calenderid="primary";
    if(isset($_GET['eventid'])){
      $eventid=$_GET['eventid']; 
    }   
   // $data=$crmObj->CalendarEventList($calenderid, $eventid);
   // print_r($data);
    ?>
   <?php
if(isset($_GET['code'])){
  $code=$_GET["code"];
 
   echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="http://localhost/ligueCRM/services/logout.php">Logout</a></h3></div>';
}
require_once '../vendor/autoload.php';
require '../google-api/vendor/autoload.php';
 

// Get the API client and construct the service object.


// Print the next 10 events on the user's calendar.
$calendarId = 'primary';

 //echo  $access_token = $_SESSION['access_token'];

require_once('../google-calendar-event/functions.php');
//$access_token = GetAccessToken(GOOGLE_CLIENT_ID, GOOGLE_REDIRECT_URI, GOOGLE_CLIENT_SECRET, $code);
//RefreshAccessToken(GOOGLE_CLIENT_ID, GOOGLE_REDIRECT_URI, GOOGLE_CLIENT_SECRET, $access_token);




/*
if(isset($_POST['event_title'])){
   echo $access_token = $_SESSION['access_token'];
    $user_timezone = $crmObj->GetUserCalendarTimezone();
    $calendar_id = 'primary';
    $event_title = $_POST['event_title'];

      $meeting_remarks = $_POST['meeting_remarks'];
      $email = "cpathak205@gmail.com";
      echo   $fromdate = $_POST['fromdate'];
       echo  $todate = $_POST['todate'];
    // Event starting & finishing at a specific time
    $full_day_event = 0; 
    $event_time = [ 'start_time' =>$fromdate.':00', 'end_time' => $todate.':00', 'description'=>$meeting_remarks, 'email'=>$email ];
 
    // Full day event
    //$full_day_event = 1; 
   // $event_time = [ 'start_time' => date('Y-m-d', strtotime($fromdate)) ,'end_time' => date('Y-m-d', strtotime($todate)) ];

    $data = $crmObj->CreateCalendarEvent($calendar_id, $event_title, $full_day_event, $event_time, $user_timezone);
    


    if($data != ''){
     header('Location:'.BASE_URL.'pages/events.php?eventid='.$data); 
        exit;
    }
}
*/



?>
<div class="row">
            <div class="col-md-6">
                <form method="post" action="" name="meet_form" id="meet_form">
                                        <div class="row">
                                         <h5 class="pt-3">Add Meetings</h5> 
                                            <input type="hidden" value="" name="meetids" id="meetids">
                                            <input type="hidden" value="" name="affilie_id" id="affilie_id">
                                                                                                                <div class="col-5">
                                                
                                                <div class="form-group">
                                                    <label for="contact-list" class="col-form-label">Contacts</label>

                                                    <select class="form-control form-control-sm" name="contact-list1" id="contact-list1" placeholder="Select Contact List" onchange="showemail(this.value);">
                                                        <?php
                                                  foreach ($datacon as $val) {
                                                       echo '<option class="dropdown-item" value="' . $val['N°']. '">'.$val['Prénom'].' '.$val['Email'].'</option>';
                                                  }
                                                  ?>

                                                    </select>
                                                </div>
                                                <!-- </div>
                                                <div class="col"> -->
                                                  
                                                 <!-- </div> 
                                                    <div class="col"> -->
                                                    <div class="form-group">
                                                        <label for="event_title" class="col-form-label">Title</label>
                                                        <input type="text" class="form-control form-control-sm" name="event_title" id="event_title" placeholder="New Meeting">
                                                    </div>
                                                    <!-- </div>
                                                    <div class="col"> -->
                                                    <!-- <div class="form-group">
                                                    <label for="location" class="col-form-label">Location</label>
                                                    <input type="text" class="form-control form-control-sm" name="location" id="location" placeholder="Location">
                                                </div> -->
                                                <!-- </div>
                                                <div class="col"> -->
                                                <div class="form-group">
                                                    <label for="date" class="col-form-label">From Date</label>

                                                    <input type="datetime-local" class="form-control form-control-sm" name="fromdate" id="fromdate" placeholder="Date">
                                                </div>
                                                <!-- </div>
                                                <div class="col"> -->
                                                <div class="form-group">
                                                    <label for="todate" class="col-form-label">To Date</label>
                                                    <input type="datetime-local" class="form-control form-control-sm " name="todate" id="todate" placeholder="Date">
                                                </div>
                                                <!-- </div>
                                                <div class="col"> -->
                                                <div class="form-group">
                                                    <label for="meeting_remarks" class="col-form-label">Description</label>
                                                    <textarea class="form-control form-control-sm" name="meeting_remarks" id="meeting_remarks" placeholder="Description"></textarea>
                                                </div>
                                                <!-- </div>
                                                <div class="col"> -->
                                                <input type="button" class="btn btn-sm btn-primary mt-4" name="addmeet" id="addmeet" value="Add" onclick="addMeet('add');">
                                                <input type="button" class="btn btn-sm btn-primary mt-4" name="updatemeet" id="updatemeet" value="Update" onclick="addMeet('edit');">
                                            </div>
                                         
                                        </div>
                </form>
            </div>
            <div class="col-md-6">
                        <h5 class="pt-3">Event List</h5>
                 <div class="table-responsive">
                      <table id="meets" class="table table-hover"  width="100%">
                                <thead class="table-primary" >
                                    <tr>
                                      
                                        <th  width="20%">Start Date</th>
                                        <th  width="20%">End Date</th>
                                        <th  width="20%">Subject</th>
                                        <th  width="20%">Remarks</th>
                                        <th  width="20%">Action</th>
                                    </tr>
                                </thead>
                            </table> 
                  </div>
            </div>
 </div>
<?php 
include '../footer.php';

?>
<script>
 // function showemail(email){
      //let email = $(this).val();
     // $("#email").val(email);
 // }
 $("#updatemeet").hide();
 $.ajax({
        url: '<?php echo BASE_URL;?>services/getmeetings.php',
        type: 'post',
        
        success: function(response) {
         //console.log(response);
            data = JSON.parse(response);
           
           if (data != '') {
        var meetTable = $('#meets').DataTable({
            "bLengthChange": false,
            "bFilter": true,
        
            "bAutoWidth": false,
            "data": data,
            "scrollY": "300px",
            "scrollCollapse": true,
            "columns": [
               
                {
                    "orderable": true,
                    "data": 'start_date',
                    render: function(data, type, row) {
                        return moment(row.start_date, 'YYYY-MM-DD H:m:s').format('DD-MM-YYYY hh:mm A');
                    }
                },
                {
                    "orderable": true,
                    "data": 'end_date',
                    render: function(data, type, row) {
                        return moment(row.end_date, 'YYYY-MM-DD H:m:s').format('DD-MM-YYYY hh:mm A');
                    }
                },
                 {
                    "data": "object"
                },
                 {
                    "data": "remarks"
                },
                {
                    "orderable": false,

                    "mRender": function(data, type, row) {
                       // return '<a class="info-meet" href="javascript:void(0);" ><img src="<?php echo BASE_URL?>img/edit.jpg" width="30" height="30"  data-toggle="modal" data-target="#meetModal"></a>'
                         return '<a class="info-meet" href="javascript:void(0);" ><img src="<?php echo BASE_URL?>img/edit.jpg" width="30" height="30" ></a>'
                    }
                },

            ],

        });
      }
    }
  });
$('#meets tbody').on('click', '.info-meet', function() {
     //  var meetTable= $("#meets").DataTable();
        $("#addmeet").hide();
        $("#updatemeet").show();
        let row = $(this).parents('tr');
        let data = meetTable.row(row).data();
        alert('hi');
        $("#contact-list1").val(data.affilie_contact_id).change();
        let startd = moment(data.start_date, 'YYYY-MM-DD H:mm:ss').format('YYYY-MM-DD HH:mm');
        let endd = moment(data.end_date, 'YYYY-MM-DD H:mm:ss').format('YYYY-MM-DD HH:mm');
        $("#fromdate").val(startd);       
        $("#todate").val(endd);
        $("#event_title").val(data.object);
        $("#meeting_remarks").val(data.remarks);
       $("#meetids").val(data.id);
});
function addMeet(addt) {
        let cid = $("#contact-list1").val();
        let fromdate = $("#fromdate").val();
        let todate = $("#todate").val();
        let meeting_remarks = $("#meeting_remarks").val();
        let title = $("#event_title").val();
        let affilie_id = $("#affilie_id").val();
        let meetids = $("#meetids").val();
       // let next_action = $("#next_action1").val();
        let email = $("#email").val();
        $.ajax({
            type: "POST", // type POST
            // all form data
            data: {
                id: meetids,
                type: addt,
                cid: cid,
                fromdate: fromdate,
                todate: todate,
                meeting_remarks: meeting_remarks,
                title: title,
                affilie_id: affilie_id,
             //   next_action: next_action,
                email: email
            },
            url: '<?php echo BASE_URL; ?>services/addmeetingdb.php', // backend URL to insert data into database
            success: function(data) {
                console.log(data);
                if (data == 'add') {
                    alert('Meeting has been added successfully');
                    window.location.href="<?php echo BASE_URL?>pages/events.php";
                 
                } else if (data == 'update') {
                    alert('Meeting has been updated successfully');
                    window.location.href="<?php echo BASE_URL?>pages/events.php";
                
                } else {
                    alert('There will be an error.Please try again lator');
                }
            }
        })
 }
</script>




