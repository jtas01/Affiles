<?php
require_once "../config/db_config.php";
require_once "../header.php";
include "../services/getselectlisting.php";
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="<?php echo BASE_URL; ?>js/moment.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>



<!-- 
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script> -->
<style>
datalist {
  display: none;
}
</style>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include('../sidebar.php');?>

<div class="content">
   <div class="main-panel">
 <a  class="info-meet-add btn btn-info btn-sm  my-3"  style="text-align: right; float: right;" href="javascript:void(0);"  data-toggle="modal" data-target="#affModal">Add New User</a><br>
        <div class="content-wrapper">
        
           <h3 class="font-weight-bold">User List</h3> 
                                  <div class="col-12 my-3">

                                      <div class="table-responsive">
                                          <table id="users" class="display select expandable-table" style="width:100%">
                                              <thead>
                                                  <tr>                                                   
                                                 
                                                      <th width="10%">Login</th>
                                                      <!-- <th width="20%">Mot de passes</th> -->
                                                      <th width="20%">Name</th>
                                                      <th width="20%">Role</th>
                                                     <th width="20%">Action</th>                                                     
                                                  </tr>
                                              </thead>
                                              <tbody></tbody>
                                          </table>
                                      </div>                                    
                                   </div>
  
</div>

 <!-- Meetings Modal -->
<div class="modal" id="affModal">
    <div class="modal-dialog modal-xl">
        <div class="row">
        <div class="col-sm-12">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="" name="frmadd" id="frmadd">
                                    <!-- <h5>Meetings</h5> -->
                                    <input type="hidden" value="" name="id" id="id">
                                      <div class="form-group">
                                           <label for="login">Login</label><br>
                                         <!--  <input type="date" class="form-control form-control-sm" id="date_end" name="date_end" value="<?php echo date('Y-m-d'); ?>"> -->
                                             <input type="text" class="form-control form-control-sm" id="login" name="login" value="">                                      
                                      </div>
                                      <div class="form-group">                                     
                                             <label for="password">Mot de passe</label><br>
                                         <input type="password" class="form-control form-control-sm" id="password" name="password" value="">
                                        
                                      </div>
                                       <div class="form-group">
                                          <label for="uname">Name</label><br>
                                            <input type="text" class="form-control form-control-sm" id="uname" name="uname" value="">
                                       </div>  
                                        <div class="form-group">
                                             <label for="role" class="col-form-label">Role</label>
                                            <select class="form-control form-control-sm" name="role" id="role">          
                                                <option value="">Choose a role</option>
                                                <option value="admin">Admin</option>
                                                <option value="volenteer">Volunteer</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    <div class="form-group pt-3">  
                                          <button type="button" class="btn btn-info btn-sm"  name="submit" id="add" onclick="addusers('add')">Add User</button>
                                          <button type="button" class="btn btn-info btn-sm"  name="update" id="update" onclick="addusers('edit')">Update</button> 
                                  </div>
                          
                    </form> 
                </div>    
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
           </div>                
        </div>  
      </div>
    </div>
</div>
<?php include '../footer.php'; ?>
<script>
$( document ).ready(function() {

    $.ajax({
        url: '<?php echo BASE_URL;?>services/fetchuser.php',
        type: 'post',
        success: function(data) {
         console.log(data);
        data = JSON.parse(data);
        var affTable =  $('#users').DataTable({
                    "destroy": true,
                    "data":data,
                    "searching": true,
                    "paging": true,
                    "info": true,
                    "scrollCollapse": true,
                     columns: [{
                          "data": "Login"
                      },
                    //   {
                    //       "data": "Password"
                    //   },
                      {
                          "data": "Name"
                      },
                      {
                          "data": "role"
                      },
                      { 
                          
                            "orderable": false,

                              "mRender": function(data, type, row) {
                               
                                   return '<a class="info-user" href="javascript:void(0);"  data-toggle="modal" data-target="#affModal"><img src="<?php echo BASE_URL?>img/view.png" width="30" height="30" ></a> <a onclick="javascript:confirmationDelete($(this));return false;" href="<?php echo BASE_URL?>services/delete.php?id='+data+'"><img src="<?php echo BASE_URL?>img/delete.png" width="30" height="30" ></a>';
                              }
                          }
                     
                     
                  ],
                });
            } 
    });
 });
function confirmationDelete(anchor){
       var conf = confirm('Are you sure want to delete this record?');
       if(conf)
       window.location.href="<?php echo BASE_URL?>affilie.php";
}
$("#add").show();
$("#update").hide();
$('#users tbody').on('click', '.info-user', function() {
       var affTable= $("#users").DataTable();
        $("#add").hide();
        $("#update").show();
        let row = $(this).parents('tr');
        let data = affTable.row(row).data();
        $("#id").val(data.id);  
        $("#login").val(data.Login);    
        $("#uname").val(data.Name);
        $("#role").val(data.role);

});
function addusers(action) { 
  var login = $('#login').val();
  var password = $('#password').val();
  var name = $('#uname').val();
  var role = $('#role').val();
  var id = $('#id').val();
   $.ajax({
              url: '<?php echo BASE_URL;?>services/adduser.php',
              type: 'post',
              data : {
                login : login,
                password : password,
                uname : name,
                role : role,
                id : id
            },
             success: function(data) {
               console.log(data);
                if (data == 'added') {
                    alert('User has been added successfully');
                          //$('#affiliecontact').DataTable().rows().add(data).draw();
                   

                } else if (data == 'updated') {
                    alert('User has been updated successfully');
                  
                  
                } else {
                    alert('There will be an error.Please try again lator');
                }
               }
      });
}

</script>