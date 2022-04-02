<?php
require_once "../config/db_config.php";
require_once "../header.php";
include "../services/getselectlisting.php";
?>

            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Affilie List</h3>
               
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Affilie List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
              <a  class="info-meet-add btn btn-info btn-sm  my-3"  style="text-align: right; float: right;" href="javascript:void(0);"  data-toggle="modal" id ="addaff" data-target="#affModal">Add New Affilie</a>
            </div>
            <div class="card-body">
                <table class="table"  id="affilie">
                    <thead>
                        <tr>
                          <th width="10%">Nom Affilie</th>
                          <th width="20%">Prenom Affilie</th>
                          <th width="20%">Date de décès</th>
                          <th width="20%">Date du diagnostic</th>                                         
                          <th width="20%">Courriel</th>                                                 
                          <th width="10%">Naissance Affilié</th>
                          <th width="20%">Téléphone Affilié</th>
                          <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
       
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
</div>
 <!-- Meetings Modal -->
<div class="modal" id="affModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Affilie</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

                 <!-- Modal body -->
                <div class="modal-body">
        <form method="post" action="" name="addAffilie" id="addAffilie">
                        <div class="row">
                            <!-- <h5>Meetings</h5> -->
                            <input type="hidden" value="" name="cle_id" id="cle_id">                                         
                                <div class="justify-content-between d-flex">
                                  <div class="field-group p-3 bg-white">
                                     <div class="operator-select mr-2 mb-2">
                                         <label for="status">Status</label><br>
                                          <select id="status" class="form-control form-control-sm" name="status">
                                             <option selected disabled hidden>select</option>
                                              <?php
                                              foreach ($status[0] as $key=>$val) {
                                                  echo '<option  value="' . $key . '">' . $key . ' ' . $val . '</option>';
                                              }
                                              ?>
                                          </select>
                                      </div>
                                      
                                      <div class="field-select-value mr-2 mb-2">
                                           <label for="prenom_affilie">Prenom Affilie</label><br>
                                         <!--  <input type="date" class="form-control form-control-sm" id="date_end" name="date_end" value="<?php echo date('Y-m-d'); ?>"> -->
                                             <input type="text" class="form-control form-control-sm" id="prenom_affilie" name="prenom_affilie" value="">
                                      
                                      </div>
                                      <div class="field-select mr-2 mb-2">
                                     
                                             <label for="nom_affilie">Nom Affilie</label><br>
                                         <input type="text" class="form-control form-control-sm" id="nom_affilie" name="nom_affilie" value="">
                                        
                                      </div>
                                       <div class="field-select mr-2 mb-2">
                                          <label for="address_envoi">Adresse Envoi</label><br>
                                            <input type="text" class="form-control form-control-sm" id="address_envoi" name="address_envoi" value="">
                                      </div>
                                      
                                    
                                  </div>
                                  <div class="field-group p-3 bg-white">
                                      <div class="operator-select mr-2 mb-2">
                                       
                                      </div>
                                      <div class="field-select mr-2 mb-2">
                                           <label for="social_status">Status Social</label><br>
                                           <select id="social_status" class="form-control form-control-sm" name="social_status">
                                              <option selected disabled hidden>select</option>
                                              <?php
                                              foreach ($social_status as $val) {
                                                  echo '<option class="dropdown-item" value="' . $val['Clé']. '">'.$val['Abréviation Statut Social'].'</option>';
                                              }
                                              ?>
                                          </select>
                                      </div>
                                      <div class="operator-select mr-2 mb-2">
                                         <label for="cp">Code Postal</label><br>
                                          <select id="cp" class="form-control form-control-sm" name="cp">
                                            <option selected disabled hidden>select</option>
                                              <?php
                                              foreach ($cp as $val) {
                                                  echo '<option class="dropdown-item" value="' . $val['Clé Code Postal'] . '">' . $val['Code Postal'] . '</option>';
                                              }
                                              ?>
                                          </select>
                                      </div>
                                       <div class="operator-select mr-2 mb-2">
                                         <label for="cp">CP Envoi</label><br>
                                          <select id="cp_envoi" class="form-control form-control-sm" name="cp_envoi">
                                              <option selected disabled hidden></option>
                                              <?php
                                              foreach ($cp as $val) {
                                                  echo '<option class="dropdown-item" value="' . $val['Clé Code Postal'] . '">' . $val['Code Postal'] . '</option>';
                                              }
                                              ?>
                                          </select>
                                      </div>
                                                               
                                  </div>
                                  <div class="field-group p-3 bg-white">
                                  
                                      <div class="date-end mr-2 mb-2">
                                              <label for="address_affilie">Adresse Affilié</label><br>
                                            <input type="text" class="form-control form-control-sm" id="address_affilie" name="address_affilie" value="">
                                      </div>
                                      <div class="field-select mr-2 mb-2">
                                          <label for="insti_affilie">Institution Affilie</label><br>
                                         <input type="text" class="form-control form-control-sm" id="insti_affilie" name="insti_affilie" value="">
                                      </div>
                                      <div class="field-select mr-2 mb-2">
                                          <label for="conjoint_affilie">Conjoint Affilie</label><br>
                                         <input type="text" class="form-control form-control-sm" id="conjoint_affilie" name="conjoint_affilie"  value="">
                                      </div>
                                                                 
                                  </div>                      
                                 
                                   <div class="field-group p-3 bg-white">
                                      <div class="field-select mr-2 mb-2">
                                          <label for="gsm_ou_autre_tel">Gsm ou autre tel</label><br>
                                         <input type="gsm_ou_autre_tel" class="form-control form-control-sm" id="gsm_ou_autre_tel" name="gsm_ou_autre_tel"  value="">
                                      </div>                                  
                                      <div class="date-end mr-2 mb-2">
                                          <label for="courriel">Courriel</label><br>
                                             <input type="text" class="form-control form-control-sm" id="courriel" name="courriel" value="">
                                      </div>
                                      <div class="field-select mr-2 mb-2">
                                          <label for="insti_affilie_envoi">Institution Affilie Envoi</label><br>
                                         <input type="text" class="form-control form-control-sm" id="insti_affilie_envoi" name="insti_affilie_envoi" value="">
                                      </div>
                                       <div class="operator-select mr-2 mb-2">
                                         <label for="assistantes">Cle Assistant</label><br>
                                          <select id="assistantes" class="form-control form-control-sm" name="assistantes">
                                              <option selected disabled hidden>Select</option>
                                              <?php
                                              foreach ($assistantes as $val){
                                                  echo '<option class="dropdown-item" value="' . $val['Clé Assistante Sociale'] . '">' . $val['Abréviation'] . ' ' . $val['Nom Assistante Sociale'] . '</option>';
                                              }
                                              ?>
                                          </select>
                                      </div>
                                   
                                  </div>    
                              </div>
                                 <div class="row">
                            <div class="col-12 mb-4">
                                <div class="justify-content-between d-flex">

                                    <div class="field-group p-3 bg-white">  
                                      <div class="field-select mr-2 mb-2">
                                            <label for="memo">memo</label><br>
                                           <textarea class="form-control form-control-sm" id="memo" name="memo"></textarea>
                                        </div>                             
                                         <div class="field-select mr-2 mb-2">
                                            <label for="nbre_enfants">Nbre_enfants</label><br>
                                           <input type="text" class="form-control form-control-sm" id="nbre_enfants" value="" name="nbre_enfants">
                                        </div>
                                       
                                        <div class="field-select mr-2 mb-2">
                                         <input class="form-check-input" type="checkbox" name="Inactif_Obselete" id="Inactif_Obselete" value="TRUE">
                                         <label class="form-check-label" for="Inactif_Obselete">Inactif-Obselete</label>
                                         <input class="form-check-input" type="checkbox" name="BIM" id="BIM" value="TRUE">
                                         <label class="form-check-label" for="BIM">BIM</label>
                                          <input class="form-check-input" type="checkbox" name="RGPD" id="RGPD" value="TRUE">
                                         <label class="form-check-label" for="RGPD">RGPD</label><br>
                                          <input class="form-check-input" type="checkbox" name="VOLONTAIRE" id="VOLONTAIRE" value="TRUE">
                                         <label class="form-check-label" for="VOLONTAIRE">VOLONTAIRE</label>
                                         <input class="form-check-input" type="checkbox" name="Pas_Invitation" id="Pas_Invitation" value="TRUE">
                                         <label class="form-check-label" for="Pas_Invitation">Pas Invitation</label>
                                           <input class="form-check-input" type="checkbox" name="pas_de_courriers" id="pas_de_courriers" value="TRUE">
                                         <label class="form-check-label" for="pas_de_courriers">Pas de courriers</label><br>
                                                                    
                                       </div>
                                    </div>
                                    <div class="field-group p-3 bg-white">                             
                                          
                                       
                                         <div class="field-select mr-2 mb-2">
                                            <label for="naissance_affilie"> Naissance Affilie</label><br>
                                           <input type="date" class="form-control form-control-sm" id="naissance_affilie" name="naissance_affilie" value="">
                                        </div>
                                         <div class="field-select mr-2 mb-2">
                                            <label for="tele_affilie"> Telephone Affilie</label><br>
                                           <input type="text" class="form-control form-control-sm" id="tele_affilie" name="tele_affilie" value="">
                                        </div> 
                                         <div class="field-select-value mr-2 mb-2">
                                          <label for="province">Province</label><br>
                                           <select id="province" class="form-control form-control-sm" name="province">
                                              <option selected disabled hidden>select</option>
                                              <?php
                                              foreach ($province as $val) {
                                                   echo '<option class="dropdown-item" value="' . $val['Clé Province']. '">'.$val['Libellé Province'].'</option>';
                                              }
                                              ?>
                                          </select>
                                      </div> 
                                           <div class="field-select mr-2 mb-2">
                                         <input class="form-check-input" type="checkbox" name="plus_de_contact" id="plus_de_contact" value="TRUE">
                                         <label class="form-check-label" for="plus_de_contact">Plus de contact</label>
                                         <input class="form-check-input" type="checkbox" name="Gratuit_Aff" id="Gratuit_Aff" value="TRUE">
                                         <label class="form-check-label" for="Gratuit_Aff">Gratuit Aff</label><br>
                                          <input class="form-check-input" type="checkbox" name="IM" id="IM" value="TRUE">
                                         <label class="form-check-label" for="IM">IM</label>  
                                            <input class="form-check-input" type="checkbox" name="Prob_adresse" id="Prob_adresse" value="TRUE">
                                         <label class="form-check-label" for="Prob_adresse">Prob Adresse</label>     
                                           <input class="form-check-input" type="checkbox" name="Nouveau" id="Nouveau" value="TRUE">
                                         <label class="form-check-label" for="Nouveau">Nouveau</label>   
                                          <input class="form-check-input" type="checkbox" name="Etiquettes" id="Etiquettes" value="TRUE">
                                         <label class="form-check-label" for="Etiquettes">Etiquettes</label>      
                                         </div>                             
                                    </div>
                                    <div class="field-group p-3 bg-white">                           
                                         <div class="field-select mr-2 mb-2">
                                            <label for="date_of_deces">Date de décès</label><br>
                                           <input type="date" class="form-control form-control-sm" id="date_of_deces" name="date_of_deces" value="">
                                        </div>

                                        <div class="field-select mr-2 mb-2">
                                            <label for="date_du_diagnostic">Date du diagnostic</label><br>
                                           <input type="date" class="form-control form-control-sm" id="date_du_diagnostic" name="date_du_diagnostic" value="">
                                        </div>  
                                         <div class="field-select-value mr-2 mb-2">
                                          <label for="cle_situation_familiale">situation familiale</label><br>
                                           <select id="cle_situation_familiale" class="form-control form-control-sm" name="cle_situation_familiale">
                                              <option selected disabled hidden>select</option>
                                              <?php
                                              foreach ($situation_familiale as $val) {
                                                  echo '<option class="dropdown-item" value="' . $val['Clé situation familiale']. '">'.$val['Situation familiale'].'</option>';
                                              }
                                              ?>
                                          </select>
                                      </div>   
                                      <div class="field-select-value mr-2 mb-2">
                                          <label for="LaClef">LaClef</label><br>
                                           <select id="LaClef" class="form-control form-control-sm" name="LaClef">
                                              <option selected disabled hidden>select</option>
                                              <?php
                                              foreach ($LaClef[0] as $val) {
                                                   echo '<option class="dropdown-item" value="' . $val. '">'.$val.'</option>';
                                              }
                                              ?>
                                          </select>
                                      </div>                          
                                    </div>                      
                                   
                                     <div class="field-group p-3 bg-white">
                                
                                        <div class="field-select mr-2 mb-2">
                                            <label for="code_handicaped">Code Handicaped</label><br>
                                           <input type="text" class="form-control form-control-sm" id="code_handicaped" name="code_handicaped" value="">
                                        </div>
                                       

                                        <div class="field-select mr-2 mb-2">
                                            <label for="Sylvie"> Sylvie</label><br>
                                           <input type="text" class="form-control form-control-sm" id="Sylvie" name="Sylvie" value="">
                                        </div>
                                       <div class="field-select-value mr-2 mb-2">
                                          <label for="cle_etat_civil">Etat Civil</label><br>
                                           <select id="cle_etat_civil" class="form-control form-control-sm" name="cle_etat_civil">
                                              <option selected disabled hidden>select</option>
                                              <?php
                                              foreach ($etat_civil as $val) {
                                                   echo '<option class="dropdown-item" value="' . $val['Clé Etat Civil']. '">'.$val['Libellé Etat Civil'].'</option>';
                                              }
                                              ?>
                                          </select>
                                      </div>
                                       
                                     
                                    </div>    
                                </div>
                            </div>
                        </div>  
                             <div class="submit mt-4">
                                                <button type="button" class="btn btn-info p-4" style="float: right;" id="add" onclick="addActionAffilie()">Add Affilie</button><br><br><br>
                                               <button type="button" class="btn btn-info p-4" style="float: right;" id="update"  onclick="addActionAffilie()">Update Affilie</button>
                                        </div>
      
                                                    </div>
                                                  
                                                   
                                                 
                                                </div>
              <div class="card">
                  <div class="card-body">                            
                    <h5> Add Affiliation</h5>                    
                     <div class="col-md-12 grid-margin">
                            <form name="AffilieSubmit" method="post" id="AffilieSubmit">
                                     <input type="hidden" value="" name="cleids" id="cleids" value="<?php echo  $affilie_id;?>">
                                  <input type="hidden" value="" name="affids" id="affids" value="<?php echo  $affilie_id;?>">
                                <div class="row">
                                     <div class="col">
                                        <div class="form-group">
                                             <label for="anne_year" class="col-form-label">Année Affiliation</label>



                                                <select class="form-control form-control-sm" name="anne_year" id="anne_year" placeholder="Select Année Affiliation">
                                               <?php
                                      
                                            for ($x = 1998; $x <= 2040; $x++) {?>
                                                <option class="dropdown-item" value="<?php echo $x;?>"><?php echo $x ;?></option>
                                           <?php   } ?>
                                           
                                             
                                            
                                                </select>
                                        </div>
                                    </div>
                                   

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="date_affilie" class="col-form-label">Date Affiliation</label>
                                      <input type="date" class="form-control form-control-sm" id="date_affilie" name="date_affilie" value="">
                                        </div>
                                    </div>
                                   
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="montant" class="col-form-label">Montant</label>
                                            <input type="text" class="form-control form-control-sm" name="montant" id="montant" placeholder="Montant">
                                        </div>
                                    </div>
                                   <div class="col">
                                        <div class="form-group">
                                             <label for="type_affiliation" class="col-form-label">Type Affiliation</label>

                                                <select class="form-control form-control-sm" name="type_affiliation" id="type_affiliation" placeholder="Select Type Affiliation">
                                               <?php

                                              foreach ($type_affilie as $val) {
                                                   echo '<option class="dropdown-item" value="' . $val['Clé type affiliation']. '" >' . $val['Clé type affiliation']. ' '.$val['Libellé type affiliation'].'</option>';
                                              }
                                              ?>
                                                </select>
                                        </div>
                                    </div>

                                     <div class="col">
                                        <div class="form-group">
                                             <label for="mode_payment" class="col-form-label">Mode of Payment</label>

                                            <select class="form-control form-control-sm" name="mode_payment" id="mode_payment" placeholder="Select Mode of Payment">
                                                  <option class="dropdown-item" value="CA">CA(Caisse)</option>
                                                   <option class="dropdown-item" value="CB">CB(Compte baincre)</option>
                                                   <option class="dropdown-item" value="AU">AU(Autre)</option>                                              
                                             
                                                </select>
                                        </div>
                                    </div>
                                     <div class="col">
                                        <div class="form-group">
                                             <label for="paid_by" class="col-form-label">Payé par</label>

                                            <select class="form-control form-control-sm" name="paid_by" id="paid_by" placeholder="Select Paid By">
                                             <option class="dropdown-item" value="A">A(Affilie)</option>
                                                   <option class="dropdown-item" value="C">C(Commite)</option>
                                                   <option class="dropdown-item" value="G">G(Graituit)</option>                                              
                                             
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                  
                                      
                                  <button type="button" class="btn btn-info btn-sm"  name="addAffiliationAction" id="addAffiliationAction" onclick="addAffiliation()">Add Affiliation</button> 
                                  <button type="button" class="btn btn-info btn-sm"  name="updateAffiliationAction" id="updateAffiliationAction" onclick="addAffiliation()">Update Affiliation</button> 
                                </div>
                                </div>
                           <br>
                            <div class="table-responsive">
                                          <table id="affiliation" class="display select expandable-table" style="width:100%">
                                              <thead>
                                                  <tr>                                                 
                                                    
                                                      <th width="20%">Date Affiliation</th>
                                                      <th width="20%">Année Affiliation</th>
                                                      <th width="20%">Montant</th>
                                                      <th width="10%">Payé par</th>
                                                      <th width="20%">Mode de paiement</th>
                                                      <th width="10%">Clé type affiliation</th>
                                                       <th width="10%">Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody></tbody>
                                          </table>
                            </div>
                        </div>
                        <hr>
                          <h5> Add Contact</h5>    
                           <div class="col-md-12 grid-margin">                      
                               <form name="contactSubmit" method="post" id="contactSubmit">
                                    <input type="hidden" value="" name="affid" id="affid" value="">
                                      <input type="hidden" value="" name="cids" id="cids">
                                    <div class="row">
                                         <div class="col">
                                            <div class="form-group">
                                                 <label for="type" class="col-form-label">Type</label>

                                                    <select class="form-control form-control-sm" name="type" id="type" placeholder="Select Type">
                                                   <?php
                                                  foreach ($type_contacts as $val) {
                                                       echo '<option class="dropdown-item" value="' . $val['N°']. '">'.$val['TYPE_CONTACTS'].'</option>';
                                                  }
                                                  ?>
                                                    </select>
                                            </div>
                                        </div>
                                       

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="nom" class="col-form-label">Nom</label>
                                                 <input type="text" class="form-control form-control-sm" name="nom" id="nom" placeholder="Nom">
                                            </div>
                                        </div>
                                       
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="prenom" class="col-form-label">Prenom</label>
                                                <input type="text" class="form-control form-control-sm" name="prenom" id="prenom" placeholder="Prenom">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="todatelephonete3" class="col-form-label">Telephone</label>
                                               <input type="text" class="form-control form-control-sm " name="telephone" id="telephone" placeholder="Telephone">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="gsm" class="col-form-label">Gsm</label>
                                                <input type="text" name="gsm" id="gsm" placeholder="Gsm">  
                                            </div>
                                        </div>
                                          <div class="col">
                                            <div class="form-group">
                                                <label for="gsm" class="col-form-label">Email</label>
                                                <input type="text" name="email" id="email" placeholder="Email">  
                                            </div>
                                        </div>
                                        <div class="col">
                                          <input type="button" class="btn btn-sm btn-primary mt-4" name="addContactAction" id="addContactAction" value="Add" onclick="addContactToAffilie('add');">
                                             <input type="button" class="btn btn-sm btn-primary mt-4" name="updateContactAction" id="updateContactAction" value="Update" onclick="addContactToAffilie('edit');">
                                        </div>

                                    </div>                          
                               <br>
                                <div class="table-responsive">
                                      <table id="affiliecontact" class="display select expandable-table" style="width:100%">
                                          <thead>
                                              <tr>                                                
                                                 <th width="10%">Type</th>
                                                  <th width="20%">Prenom</th>
                                                  <th width="20%">Nom</th>
                                                  <th width="20%">Telephone</th>
                                                  <th width="20%">Gsm</th>
                                                  <th width="10%">Email</th>
                                                   <th width="10%">Action</th>
                                              </tr>
                                          </thead>
                                          <tbody></tbody>
                                      </table>
                                </div>

                                  
                            </div>    
                     </div>
                </div>
            </form>
            </div>
        </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

        </div>
    </div>
 </div>
<?php require_once "../footer.php";?>      
<script>
$( document ).ready(function() {

    $.ajax({
        url: '<?php echo BASE_URL;?>services/getAffilie.php',
        type: 'post',
        success: function(data) {
         console.log(data);
        data = JSON.parse(data);
        var affTable =  $('#affilie').DataTable({
                    "destroy": true,
                    "data":data,
                    "searching": true,
                    "paging": true,
                    "info": true,
                    "scrollCollapse": true,
                     columns: [{
                          "data": "nom_affilie"
                      },
                      {
                          "data": "prenom_affilie"
                      },
                      { "data": "date_de_deces",
                          render: function(data) {
                                  if(data!='0000-00-00'){
                                   return moment(data, 'YYYY-MM-DD').format('DD-MM-YYYY');
                                   } else return 'N/A';
                          }
                      },
                       { "data": "date_du_diagnostic",
                          render: function(data) {
                                  if(data!='0000-00-00'){
                                   return moment(data, 'YYYY-MM-DD').format('DD-MM-YYYY');
                                   } else return 'N/A';
                          }
                      },
                      
                      {
                          "data": "courriel"
                      },
                      { "data": "naissance_affilie",
                          render: function(data) {
                                  if(data!='0000-00-00'){
                                   return moment(data, 'YYYY-MM-DD').format('DD-MM-YYYY');
                                   } else return 'N/A';
                          }
                      },
                     
                      {
                          "data": "tele_affilie"
                      },
                      { 
                          "data": "cle_id",
                            "orderable": false,

                              "mRender": function(data, type, row) {
                               
                                   return '<a class="info-meet" href="javascript:void(0);"  data-toggle="modal" data-target="#affModal"><img src="<?php echo BASE_URL?>img/view.png" width="30" height="30" ></a> <a onclick="javascript:confirmationDelete($(this));return false;" href="<?php echo BASE_URL?>services/delete.php?id='+data+'"><img src="<?php echo BASE_URL?>img/delete.png" width="30" height="30" ></a>';
                              }
                          }
                     
                     
                  ],
                });
            } 
    });
$("#updateAffiliationAction").hide();   
$("#addAffiliationAction").hide();
$("#addContactAction").hide();
$("#updateContactAction").hide();
$("#update").hide();
$("#affiliation").hide();
$("#affiliecontact").hide();
$('#affilie tbody').on('click', '.info-meet', function() {
     var affTable= $("#affilie").DataTable();
         $("#addAffiliationAction").show();
         $("#addContactAction").show();
         $("#affiliation").show();
        $("#affiliecontact").show();
        $("#add").hide();
        $("#update").show();
        let row = $(this).parents('tr');
        let data = affTable.row(row).data();
        $("#cle_id").val(data.cle_id );
        $("#status").val(data.status).change();
        $("#social_status").val(data.social_status).change();
        let date_of_deces = moment(data.date_de_deces, 'YYYY-MM-DD').format('YYYY-MM-DD');
        let date_du_diagnostic = moment(data.date_du_diagnostic, 'YYYY-MM-DD').format('YYYY-MM-DD');
        let naissance_affilie = moment(data.naissance_affilie, 'YYYY-MM-DD').format('YYYY-MM-DD');
        $("#date_du_diagnostic").val(date_du_diagnostic);
        $("#date_of_deces").val(date_of_deces);
        $("#nom_affilie").val(data.nom_affilie);
        $("#prenom_affilie").val(data.prenom_affilie);
        $("#address_envoi").val(data.address_envoi);
        $("#courriel").val(data.courriel);
        $("#naissance_affilie").val(naissance_affilie);
         $("#tele_affilie").val(data.tele_affilie);
        $("#address_affilie").val(data.address_affilie);
        $("#conjoint_affilie").val(data.conjoint_affilie);
         $("#cp").val(data.cp).change();
        $("#cp_envoi").val(data.cp_envoi).change();
        $("#Sylvie").val(data.Sylvie);
        $("#code_handicaped").val(data.code_handicaped);
        $("#cle_situation_familiale").val(data.cle_situation_familiale).change();
        $("#assistantes").val(data.cle_assistante_sociale).change();
        $("#insti_affilie").val(data.insti_affilie);
         $("#gsm_ou_autre_tel").val(data.gsm_ou_autre_tel);
         $("#insti_affilie_envoi").val(data.insti_affilie_envoi);
        $("#province").val(data.province).change();
        $("#cle_etat_civil").val(data.cle_etat_civil).change();
        $("#nbre_enfants").val(data.nbre_enfants);
         $("#memo").val(data.memo);
        $("#LaClef").val(data.LaClef).change(); 
        if(data.Inactif_Obselete=="TRUE"){
            $("#Inactif_Obselete").val(data.Inactif_Obselete).attr("checked",true)
        }else{
            $("#Inactif_Obselete").val(data.Inactif_Obselete).attr("checked",false)
        }
        if(data.BIM=="TRUE"){
            $("#BIM").val(data.BIM).attr("checked",true)
        }else{
            $("#BIM").val(data.BIM).attr("checked",false)
        }
        if(data.IM=="TRUE"){
            $("#IM").val(data.IM).attr("checked",true)
        }else{
            $("#IM").val(data.IM).attr("checked",false)
        }
        if(data.VOLONTAIRE=="TRUE"){
            $("#VOLONTAIRE").val(data.VOLONTAIRE).attr("checked",true)
        }else{
            $("#VOLONTAIRE").val(data.VOLONTAIRE).attr("checked",false)
        }
        if(data.Prob_adresse=="TRUE"){
            $("#Prob_adresse").val(data.Prob_adresse).attr("checked",true)
        }else{
            $("#Prob_adresse").val(data.Prob_adresse).attr("checked",false)
        }
        if(data.RGPD=="TRUE"){
            $("#RGPD").val(data.RGPD).attr("checked",true)
        }else{
            $("#RGPD").val(data.RGPD).attr("checked",false)
        }
        if(data.pas_de_courriers=="TRUE"){
            $("#pas_de_courriers").val(data.pas_de_courriers).attr("checked",true)
        }else{
            $("#pas_de_courriers").val(data.pas_de_courriers).attr("checked",false)
        }
        if(data.plus_de_contact=="TRUE"){
            $("#plus_de_contact").val(data.plus_de_contact).attr("checked",true)
        }else{
            $("#plus_de_contact").val(data.plus_de_contact).attr("checked",false)
        }
        if(data.Pas_Invitation=="TRUE"){
            $("#Pas_Invitation").val(data.Pas_Invitation).attr("checked",true)
        }else{
            $("#Pas_Invitation").val(data.Pas_Invitation).attr("checked",false)
        }
        if(data.Gratuit_Aff=="TRUE"){
            $("#Gratuit_Aff").val(data.Gratuit_Aff).attr("checked",true)
        }else{
            $("#Gratuit_Aff").val(data.Gratuit_Aff).attr("checked",false)
        }
        if(data.Nouveau=="TRUE"){
            $("#Nouveau").val(data.Nouveau).attr("checked",true)
        }else{
            $("#Nouveau").val(data.Nouveau).attr("checked",false)
        }
         if(data.Etiquettes=="TRUE"){
            $("#Etiquettes").val(data.Etiquettes).attr("checked",true)
        }else{
            $("#Etiquettes").val(data.Etiquettes).attr("checked",false)
        }
      
     
        showAffileContact(data.cle_id);
        printAffilieTable(data.cle_id);
      
    });




 
 });

function showAffileContact(id){
  $.ajax({
            url: '<?php echo BASE_URL;?>services/getContacts.php',
            type: 'post',
            data: {
                id: id
            },
            success: function(response) {
            console.log(response);
                data = JSON.parse(response);
               
               if (response != 'No data found') {
                var contactTable = $('#affiliecontact').DataTable({
                        "destroy": true,
                        "data": data,
                        "searching": true,
                        "paging": true,
                        "info": false,
                        "scrollY": "300px",
                        "scrollCollapse": true,
                         columns: [{
                              "data": "Type"
                          },
                          {
                              "data": "nom"
                          },
                          {
                              "data": "prenom"
                          },
                          {
                              "data": "tele"
                          },
                          {
                              "data": "Gsm"
                          },
                          {
                              "data": "Email" 
                          },
                          {
                              "orderable": false,

                              "mRender": function(data, type, row) {
                               
                                   return '<a class="info-contact" href="javascript:void(0);" ><img src="<?php echo BASE_URL?>img/edit.jpg" width="30" height="30" ></a> <a onclick="javascript:confirmationDelete($(this));return false;" href="<?php echo BASE_URL?>services/deleteContacts.php?id='+row.cids+'"><img src="<?php echo BASE_URL?>img/delete.png" width="30" height="30" ></a>'
                              }
                          }
                         
                      ],
                    });
                } else $('#affiliecontact').DataTable().destroy(); 
              }

            });      
}
function printAffilieTable(id){
  $.ajax({
        url: '<?php echo BASE_URL;?>services/getAffiliation.php',
        type: 'post',
        data: {
            id: id
        },
        success: function(response) {
       console.log(response);
            data = JSON.parse(response);
           
           if (data != '') {
                $('#affiliation').DataTable({
                    "destroy": true,
                    "data": data,
                    "searching": false,
                    "paging": false,
                    "info": false,
                    "scrollY": "300px",
                    "scrollCollapse": true,
                     columns: [
                      
                      { "data": "date_affilie",
                          render: function(data) {
                                  if(data!='0000-00-00 00:00:00'){
                                   return moment(data, 'YYYY-MM-DD').format('DD-MM-YYYY');
                                   } else return 'N/A';
                          }
                      },
                      {
                          "data": "anne_year"
                      },
                      {
                          "data": "montant"
                      },
                      {
                          "data": "paid_by" 
                      },
                     
                      {
                          "data": "mode_payment"
                      },
                      {
                          "data": "type_affiliation"
                      },
                      {
                              "orderable": false,

                              "mRender": function(data, type, row) {
                               
                                   return '<a class="info-affilie" href="javascript:void(0);" ><img src="<?php echo BASE_URL?>img/edit.jpg" width="30" height="30" ></a>  <a onclick="javascript:confirmationDelete($(this));return false;" href="<?php echo BASE_URL?>services/deleteAffiliation.php?id='+row.affid+'"><img src="<?php echo BASE_URL?>img/delete.png" width="30" height="30" ></a>'
                              }
                       }
                  ],
                });
            } else $('#affilie').DataTable().destroy(); 
          }
        });
} 
function confirmationDelete(anchor){
       var conf = confirm('Are you sure want to delete this record?');
       if(conf)
          window.location=anchor.attr("href");
}
function addActionAffilie(){
var affTable= $("#affilie").DataTable();
  $.ajax({
      url: '<?php echo BASE_URL;?>services/addAffilie.php',
      type: 'post',
      data : $('#addAffilie').serialize(),
      success: function(data) {
       console.log(data);
        if (data == 'added') {
            alert('Affile has been added successfully');
            window.location.href="<?php echo BASE_URL?>pages/affilie.php";
            
           
        } else if (data == 'updated') {
            alert('Affile has been updated successfully');
            window.location.href="<?php echo BASE_URL?>pages/affilie.php";
          
        }else if (data == 'Email Already Exist Error') {
            alert('Email Already Exist!!!');
          
          
        }else {
            alert('There will be an error.Please try again lator');
        }
      }
  });
}
$('#affiliecontact tbody').on('click', '.info-contact', function() {
       var contactTable= $("#affiliecontact").DataTable();
        $("#addContactAction").hide();
        $("#updateContactAction").show();
        let row = $(this).parents('tr');
        let data = contactTable.row(row).data();
        $("#type").val(data.Type).change();      
        $("#email").val(data.Email);
        $("#gsm").val(data.Gsm);
        $("#telephone").val(data.tele);
        $("#nom").val(data.nom);
        $("#prenom").val(data.prenom);
       $("#cids").val(data.cids);
        $("#affid").val(data.affid);
});
$('#affiliation tbody').on('click', '.info-affilie', function() {
       var affilieTable= $("#affiliation").DataTable();
        $("#addAffiliationAction").hide();
        $("#updateAffiliationAction").show();
        let row = $(this).parents('tr');
        let data = affilieTable.row(row).data();
        $("#affids").val(data.affid); 
        $("#cle_id").val(data.cle_id);  
        $("#anne_year").val(data.anne_year).change(); 
        let date_affilie = moment(data.date_affilie, 'YYYY-MM-DD').format('YYYY-MM-DD');
        $("#date_affilie").val(date_affilie);    
        $("#montant").val(data.montant);
        $("#paid_by").val(data.paid_by).change();
        $("#mode_payment").val(data.mode_payment).change();
       $("#type_affiliation").val(data.type_affiliation).change();
});
function addContactToAffilie(action) { 
  var affid = $('#cle_id').val();
  var cids = $('#cids').val();
  var type = $('#type').val();
  var email = $('#email').val();
  var gsm = $('#gsm').val();
  var telephone = $('#telephone').val();
  var nom = $('#nom').val();
  var prenom = $('#prenom').val();
   $.ajax({
              url: '<?php echo BASE_URL;?>services/addContact.php',
              type: 'post',
              data : {
                affid : affid,
                cids : cids,
                type : type,
                email : email,
                gsm : gsm,
                telephone : telephone,
                nom : nom,
                prenom : prenom
            },
             success: function(data) {
               console.log(data);
                if (data == 'added') {
                    alert('Contact has been added successfully');
                          //$('#affiliecontact').DataTable().rows().add(data).draw();
                   showAffileContact(affid);

                } else if (data == 'updated') {
                    alert('Contact has been updated successfully');
                  showAffileContact(affid);
                  
                } else {
                    alert('There will be an error.Please try again lator');
                }
               }
      });
}
function addAffiliation(){
  var cle_id = $('#cle_id').val();
 var affid = $('#affids').val();
  var anne_year = $('#anne_year').val();
  var date_affilie = $('#date_affilie').val();
  var montant = $('#montant').val();
  var paid_by = $('#paid_by').val();
  var mode_payment = $('#mode_payment').val();
  var type_affiliation = $('#type_affiliation').val();
  $.ajax({
          url: '<?php echo BASE_URL;?>services/addAffiliation.php',
          type: 'post',
          data : {
                affid : affid,
                cle_id : cle_id,
                anne_year : anne_year,
                date_affilie : date_affilie,
                montant : montant,
                paid_by : paid_by,
                mode_payment : mode_payment,
                type_affiliation : type_affiliation
            },
          success: function(data) {
           console.log(data);
            if (data == 'added') {
                alert('Affiliation has been added successfully');
                  printAffilieTable(cle_id);                      
               
            }else if (data == 'updated') {
                alert('Affiliation has been updated successfully');
                    printAffilieTable(cle_id);
            } else {
                alert('There will be an error.Please try again lator');
            }
          }
  });
}
$('#addaff').click(function(){
  $('#addAffilie')[0].reset();
  var atable = $('#affiliation').DataTable();
  var ctable = $('#affiliecontact').DataTable();   
  var rows = atable.rows().remove().draw();
  var rows = ctable.rows().remove().draw();        
})
</script>