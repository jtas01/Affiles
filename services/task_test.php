<?php
include('../db_config.php');
include('../classes/GoogleCrmClient.php');
include('../googleconfig.php');
include "getselectlisting.php";
$crmObj = new GoogleCrmClient();
$code=$_GET["code"];
 
   echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="http://localhost/ligueCRM/services/logout.php">Logout</a></h3></div>';

require_once '../vendor/autoload.php';
require '../google-api/vendor/autoload.php';
 

// Get the API client and construct the service object.


// Print the next 10 events on the user's calendar.
$calendarId = 'primary';

 echo  $access_token = $_SESSION['access_token'];

require_once('../google-calendar-event/functions.php');
//$access_token = GetAccessToken(GOOGLE_CLIENT_ID, GOOGLE_REDIRECT_URI, GOOGLE_CLIENT_SECRET, $code);
//RefreshAccessToken(GOOGLE_CLIENT_ID, GOOGLE_REDIRECT_URI, GOOGLE_CLIENT_SECRET, $access_token);





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




?>
 <form method="post" action="" name="meet_form" id="meet_form">
                                        <div class="row">
                                            <!-- <h5>Meetings</h5> -->
                                            <input type="hidden" value="" name="meetids" id="meetids">
                                            <input type="hidden" value="<?php if (!empty($affilie_id)) {
                                                                            echo $affilie_id;
                                                                        } ?>" name="affilie_id" id="affilie_id">

                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="contact-list" class="col-form-label">Contacts</label>

                                                    <select class="form-control form-control-sm" name="contact-list1" id="contact-list1" placeholder="Select Contact List">
                                                        <?php
				                                          foreach ($datacon as $val) {
				                                               echo '<option class="dropdown-item" value="' . $val['N°']. '">'.$val['Prénom'].' '.$val['Email'].'</option>';
				                                          }
				                                          ?>

                                                    </select>

                                                </div>
                                                <!-- </div>
                                                <div class="col"> -->
                                                    <div class="form-group">
                                                        <label for="next_action1" class="col-form-label">Prochaine action</label>
                                                        <select class="form-control form-control-sm" name="next_action1" id="next_action1" placeholder="Next Action">
                                                            <option value="Rendez vous">Rendez vous</option>
                                                            <option value="Appel">Appel</option>
                                                            <option value="Tâche">Tâche</option>
                                                            <option value="Verge">Vierge</option>
                                                        </select>
                                                    </div>
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
                                                <input type="submit" class="btn btn-sm btn-primary mt-4" name="addmeet" id="addmeet" value="Add">
                                                <input type="submit" class="btn btn-sm btn-primary mt-4" name="updatemeet" id="updatemeet" value="Update" onclick="addMeet('edit');">
                                            </div>
                                         
                                        </div>
                                    </form>
<?php 
include '../footer.php';

?>
<script>
function addMeet(addt) {
        let cid = $("#contact-list1").val();
        let fromdate = $("#fromdate").val();
        let todate = $("#todate").val();
        let meeting_remarks = $("#meeting_remarks").val();
        let title = $("#event_title").val();
        let affilie_id = $("#affilie_id").val();
        let meetids = $("#meetids").val();
        let next_action = $("#next_action1").val();

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
                next_action: next_action
            },
            url: '<?php echo BASE_URL; ?>services/addmeetingdb.php', // backend URL to insert data into database
            success: function(data) {
                console.log(data);
                if (data == 'add') {
                    alert('Meeting has been added successfully');
                 
                } else if (data == 'update') {
                    alert('Meeting has been updated successfully');
                
                } else {
                    alert('There will be an error.Please try again lator');
                }
            }
        })
 }
</script>