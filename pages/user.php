<?php
require_once "../config/db_config.php";
require_once "../header.php";
include "../services/getselectlisting.php";
?>






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
                                          <table id="users" class="display select expandable-table">
                                              <thead>
                                                  <tr>                                                  
                                                    <th width="10%">Login</th>
                                                      <!-- <th width="20%">Mot de passes</th> -->
                                                      <th width="20%">Name</th>
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
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

                 <!-- Modal body -->
                <div class="modal-body">
                     <form method="post" action="" name="frmadd" id="frmadd">
                         <div class="row">
                           <div class="col-md-6">
                            <!-- <h5>Meetings</h5> -->
                            <input type="hidden" value="" name="id" id="id">                                         
                                <div class="justify-content-between d-flex">
                                  <div class="field-group p-3 bg-white">
                                      
                                      <div class="field-select-value mr-2 mb-2">
                                           <label for="login">Login</label><br>
                                       
                                             <input type="text" class="form-control form-control-sm" id="login" name="login" value="">
                                      
                                      </div>
                                      <div class="field-select mr-2 mb-2">
                                     
                                             <label for="password">Mot de passe</label><br>
                                         <input type="password" class="form-control form-control-sm" id="password" name="password" value="">
                                        
                                      </div>
                                       <div class="field-select mr-2 mb-2">
                                          <label for="uname">Name</label><br>
                                            <input type="text" class="form-control form-control-sm" id="uname" name="uname" value="">
                                       </div>  
                                       <div class="col">
                                  
                                      
                                      <button type="button" class="btn btn-info btn-sm"  name="add" id="add" onclick="addusers('add')">Add </button>
                                      <button type="button" class="btn btn-info btn-sm"  name="update" id="update" onclick="addusers('edit')">Update</button> 
                                      
                                     </div>                
                                   </div>   
                                </div>
                            </div></div>
                        </form>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
          window.location=anchor.attr("href");
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

});
function addusers(action) { 
  var login = $('#login').val();
  var password = $('#password').val();
  var name = $('#uname').val();
  var id = $('#id').val();
   $.ajax({
              url: '<?php echo BASE_URL;?>services/adduser.php',
              type: 'post',
              data : {
                login : login,
                password : password,
                uname : name,
                id : id
            },
             success: function(data) {
               console.log(data);
                if (data == 'added') {
                    alert('User has been added successfully');
                     
                   

                } else if (data == 'updated') {
                    alert('User has been updated successfully');
             
                  
                } else {
                    alert('There will be an error.Please try again lator');
                }
               }
      });
}

</script>