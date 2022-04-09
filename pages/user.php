<?php
require_once "../config/db_config.php";
require_once "../header.php";
include "../services/getselectlisting.php";
?>
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User List</h3>
               
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Utilisateur</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liste des Utilisateur</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
              <a  class="info-meet-add btn btn-info btn-sm  my-3"  style="text-align: right; float: right;" href="javascript:void(0);"  data-toggle="modal" data-target="#affModal">Ajouter un Utilisateur</a>
            </div>
            <div class="card-body">
                <table class="table"  id="users">
                    <thead>
                        <tr>
                            <th width="10%">Login</th>
                            <th width="20%">Nom</th>
                            <th width="20%">Role</th>
                             <th width="20%">Default Email</th>
                              <th width="20%">Gmail</th>
                            <th width="20%">Statut</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
</div>


 <!-- Meetings Modal -->
<div class="modal" id="affModal">
    <div class="modal-dialog modal-xl">
        <div class="row">
        <div class="col-sm-12">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Utilisateur</h4>
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
                                          <label for="uname">Nom</label><br>
                                            <input type="text" class="form-control form-control-sm" id="uname" name="uname" value="">
                                       </div>
                                         <div class="form-group">
                                          <label for="default_email">Default Email</label><br>
                                            <input type="text" class="form-control form-control-sm" id="default_email" name="default_email" value="">
                                       </div>
                                            <div class="form-group">
                                          <label for="gmail">Gmail</label><br>
                                            <input type="text" class="form-control form-control-sm" id="gmail" name="gmail" value="">
                                       </div>
                                        
                                        <div class="form-group">
                                             <label for="role" class="col-form-label">Role</label>
                                            <select class="form-control form-control-sm" name="role" id="role">          
                                                <option value="">Choisir un role</option>
                                                <option value="admin">Admin</option>
                                                <option value="volenteer">Volontaire</option>
                                                <option value="user">Utilisateur</option>
                                            </select>
                                        </div>
                                    <div class="form-group pt-3">  
                                          <button type="button" class="btn btn-info btn-sm"  name="submit" id="add" onclick="addusers('add')">Ajouter un Utilisateur</button>
                                          <button type="button" class="btn btn-info btn-sm"  name="update" id="update" onclick="addusers('edit')">Mise à jour</button> 
                                  </div>
                          
                    </form> 
                </div>    
                <!-- Modal footer -->
<!--                 <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div> -->
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
                    "language": {
                        "emptyTable":     "No data available in table",
                        "info":           "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                        "infoEmpty":      "Affichage de 0 à 0 sur 0 entrées",
                        "infoFiltered":   "(filtré à partir de _MAX_ entrées au total)",
                        "thousands":      ",",
                        "lengthMenu":     "Afficher _MENU_ entrées",
                        "loadingRecords": "Chargement...",
                        "processing":     "Traitement...",
                        "search":         "Rechercher:",
                        "zeroRecords":    "Aucun enregistrements correspondants trouvés",
                        "paginate": {
                            "first":      "Premier",
                            "last":       "Dernier",
                            "next":       "Suivant",
                            "previous":   "Précédent"
                        },
                        "aria": {
                            "sortAscending":  ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                      },
                    "data":data,
                    "searching": true,
                    "paging": true,
                    "info": true,
                    "scrollCollapse": true,
                     columns: [{
                          "data": "Login"
                      },
                      {
                          "data": "Name"
                      },
                      {
                          "data": "role"
                      },
                       {
                          "data": "default_email"
                      },
                       {
                          "data": "gmail"
                      },
                      {

                              "mRender": function(data, type, row) {

                                 if(row.status=='1'){
                                     return '<span class="badge bg-success">Active</span>';
                                   
                                }else{
                                     return ' <span class="badge bg-danger">Inactive</span>';
                                   
                                }
                            }   
                      },
                      { 
                           "data": "id",
                            "orderable": false,

                              "mRender": function(data, type, row) {
                               
                                   return '<a class="info-user" href="javascript:void(0);"  data-toggle="modal" data-target="#affModal"><img src="<?php echo BASE_URL?>img/view.png" width="30" height="30" ></a> <a onclick="javascript:confirmationDelete($(this));return false;" href="<?php echo BASE_URL?>services/deleteUser.php?id='+row.id+'"><img src="<?php echo BASE_URL?>img/delete.png" width="30" height="30" ></a>';
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
         $("#password").val(data.password);
        $("#login").val(data.Login);    
        $("#uname").val(data.Name);
        $("#role").val(data.role);
         $("#gmail").val(data.gmail);
        $("#default_email").val(data.default_email);

});
function addusers(action) { 
  var login = $('#login').val();
  var password = $('#password').val();
  var name = $('#uname').val();
  var role = $('#role').val();
  var id = $('#id').val();
  var default_email = $('#default_email').val();
  var gmail = $('#gmail').val();
   $.ajax({
              url: '<?php echo BASE_URL;?>services/adduser.php',
              type: 'post',
              data : {
                login : login,
                password : password,
                uname : name,
                role : role,
                id : id,
                gmail : gmail,
                default_email : default_email
                },
                success: function(data) {
                console.log(data);
                if (data == 'added') {
                    alert('User has been added successfully');                  

                } else if (data == 'updated') {
                    alert('User has been updated successfully');
                  
                  
                } else if (data == 'User Already Exist Error') {
                    alert(' User Already Exist Error');
                  
                  
                }else {
                    alert('There will be an error.Please try again later');
                }
               }
      });
}

</script>