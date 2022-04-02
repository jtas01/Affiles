<?php
require_once "../config/db_config.php";
require_once "../header.php";
include('../classes/GoogleCrmClient.php');
include "../services/getselectlisting.php";
$crmObj = new GoogleCrmClient();
?>




<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Event List</h3>
               
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Events</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Event List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
          
            </div>
            <div class="card-body">
              
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="" name="meet_form" id="meet_form">
                                        <div class="row">
                                         <h5>Add Meetings</h5> 
                                            <input type="hidden" value="" name="meetids" id="meetids">
                                            <input type="hidden" value="" name="eventid" id="eventid">
                                            <input type="hidden" value="" name="affilie_id" id="affilie_id">
                                                                                                                <div class="col-5">
                                                
                                                <div class="form-group">
                                                    <label for="contact-list" class="col-form-label">Contacts</label>

                                                    <select class="form-control form-control-sm" name="contact-list1" id="contact-list1" placeholder="Select Contact List" >
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
                <h5>Event List</h5>
                    
                      
                            <table class="table"  id="meets">
                                <thead >
                                    <tr>                                      
                                        <th >Start Date</th>
                                        <th >End Date</th>
                                        <th >Subject</th>
                                        <th >Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                      <tbody></tbody>
                                </thead>
                            </table> 
                  
                        </div> 
                    
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->


     
<?php 
include '../footer.php';

?>
<script>
 $("#updatemeet").hide();
 $.ajax({
        url: '<?php echo BASE_URL;?>services/getmeetings.php',
        type: 'post',        
        success: function(response) {
         console.log(response);
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
                     
                         return '<a class="info-meet" href="javascript:void(0);" ><img src="<?php echo BASE_URL?>img/edit.jpg" width="30" height="30" ></a> <a onclick="javascript:confirmationDelete($(this));return false;" href="<?php echo BASE_URL?>services/deleteEvent.php?id='+row.id+'&eventid='+row.affilie_meeting_id+'"><img src="<?php echo BASE_URL?>img/delete.png" width="30" height="30" ></a>'
                    }
                },

            ],

        });
      }
    }
});
$('#meets tbody').on('click', '.info-meet', function() {
    var meetTable= $("#meets").DataTable();
    $("#addmeet").hide();
    $("#updatemeet").show();
    let row = $(this).parents('tr');
    let data = meetTable.row(row).data();      
    $("#contact-list1").val(data.affilie_contact_id).change();
  //  let startd = moment(data.start_date, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD hh:mm A');
   // let endd = moment(data.end_date, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD hh:mm A');
    let startd = moment(data.start_date, 'YYYY-MM-DD H:mm:ss-8:00').format('YYYY-MM-DDTHH:mm');
    let endd = moment(data.end_date, 'YYYY-MM-DD H:mm:ss-8:00').format('YYYY-MM-DDTHH:mm');
    $("#fromdate").val(startd);       
    $("#todate").val(endd);
    $("#event_title").val(data.object);
    $("#meeting_remarks").val(data.remarks);
     $("#eventid").val(data.affilie_meeting_id);
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
        let eventid = $("#eventid").val();
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
                eventid: eventid,
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
 function confirmationDelete(anchor){
       var conf = confirm('Are you sure want to delete this record?');
       if(conf)
          window.location=anchor.attr("href");
}
</script>




