<?php
require_once "../db_config.php";
require_once "../header.php";
include "../services/getselectlisting.php";
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
        <div class="content-wrapper">
           <h3 class="font-weight-bold">LigueCRM</h3>
        <form name="addAffilie" id="addAffilie" method="POST">
              <div class="col-md-12 grid-margin">
                  <div class="row">                  
                      <div class="col-12 mb-4">
                          <div class="justify-content-between d-flex">
                              <div class="field-group p-3 bg-white">
                                  <div class="operator-select mr-2 mb-2">
                                       <label for="cli_id">Cle Affilie</label><br>
                                      <input type="text" class="form-control form-control-sm" id="cle_id" readonly="readonly" name="cle_id">
                                  </div>
                                  
                                  <div class="field-select-value mr-2 mb-2">
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
                                  <div class="field-select mr-2 mb-2">
                                      <label for="address_affilie">Adresse Affilié</label><br>
                                        <input type="text" class="form-control form-control-sm" id="address_affilie" name="address_affilie">
                                  </div>
                                   <div class="field-select mr-2 mb-2">
                                      <label for="address_envoi">Adresse Envoi</label><br>
                                        <input type="text" class="form-control form-control-sm" id="address_envoi" name="address_envoi">
                                  </div>
                                  
                                
                              </div>
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
                                  <div class="field-select mr-2 mb-2">
                                      <label for="nom_affilie">Nom Affilie</label><br>
                                     <input type="text" class="form-control form-control-sm" id="nom_affilie" name="nom_affilie">
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
                                  <div class="date-start mr-2 mb-2">
                                      <label for="search_affilie">Search Affilie</label><br>
                                      <input list="search_affilie1" id="search_affilie" name="search_affilie" value="" />
                                     

                                        <datalist id="search_affilie1">
                                          <option selected disabled hidden></option>
                                          <?php
                                          foreach ($affilie as $val){
                                            echo '<option class="dropdown-item" value="' . $val['Clé Affilié'] . '">' . $val['Nom Affilié'] . ' ' . $val['Prénom Affilié'] . '</option>';
                                          }
                                          ?>
                                      </datalist>

                                  </div>
                                  <div class="date-end mr-2 mb-2">
                                      <label for="prenom_affilie">Prenom Affilie</label><br>
                                     <!--  <input type="date" class="form-control form-control-sm" id="date_end" name="date_end" value="<?php echo date('Y-m-d'); ?>"> -->
                                         <input type="text" class="form-control form-control-sm" id="prenom_affilie" name="prenom_affilie">
                                  </div>
                                  <div class="field-select mr-2 mb-2">
                                      <label for="insti_affilie">Institution Affilie</label><br>
                                     <input type="text" class="form-control form-control-sm" id="insti_affilie" name="insti_affilie">
                                  </div>
                                  <div class="field-select mr-2 mb-2">
                                      <label for="conjoint_affilie">Conjoint Affilie</label><br>
                                     <input type="text" class="form-control form-control-sm" id="conjoint_affilie" name="conjoint_affilie">
                                  </div>
                                                             
                              </div>                      
                             
                               <div class="field-group p-3 bg-white">
                                  <div class="field-select mr-2 mb-2">
                                      <label for="gsm_ou_autre_tel">Gsm ou autre tel</label><br>
                                     <input type="gsm_ou_autre_tel" class="form-control form-control-sm" id="gsm_ou_autre_tel" name="gsm_ou_autre_tel" value="">
                                  </div>
                                  <div class="date-end mr-2 mb-2">
                                      <label for="courriel">Courriel</label><br>
                                         <input type="text" class="form-control form-control-sm" id="courriel" name="courriel">
                                  </div>
                                  <div class="field-select mr-2 mb-2">
                                      <label for="insti_affilie_envoi">Institution Affilie Envoi</label><br>
                                     <input type="text" class="form-control form-control-sm" id="insti_affilie_envoi" name="insti_affilie_envoi">
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
                      </div>

                  </div>
              </div>

            
              <!-- Coda upload and basic data display -->
              <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                           <h5> Add Affiliation</h5>
                          <form name="AffilieSubmit" method="post" id="AffilieSubmit">

                                  <input type="hidden" value="" name="affids" id="affids">
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
                                                   echo '<option class="dropdown-item" value="' . $val['Clé type affiliation']. '">' . $val['Clé type affiliation']. ' '.$val['Libellé type affiliation'].'</option>';
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
                            </form>
                                  <div class="col-12 my-3">
                                      <div class="table-responsive">
                                          <table id="affilie" class="display select expandable-table" style="width:100%">
                                              <thead>
                                                  <tr>                                                   
                                                     
                                                      <th width="10%">Clé Affiliation</th>
                                                      <th width="20%">Clé Affilié</th>
                                                      <th width="20%">Date Affiliation</th>
                                                      <th width="20%">Année Affiliation</th>
                                                      <th width="20%">Montant</th>
                                                      <th width="10%">Payé par</th>
                                                      <th width="20%">Mode de paiement</th>
                                                      <th width="10%">Clé type affiliation</th>
                                                  </tr>
                                              </thead>
                                              <tbody></tbody>
                                          </table>
                                      </div>                                    
                                   </div>
                              <div class="hidden-items p-3">
                                 <!--  <button class="btn btn-success" id="download_csv">Télécharger en CSV</button>
                                  <button class="btn btn-success" id="download_xls">Télécharger en XLS</button>
                                  <button class="btn btn-warning float-right" id="save_query">Sauvegarder ce rapport</button> -->
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-12 grid-margin">
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
                                       <input type="text" class="form-control form-control-sm" id="nbre_enfants" name="nbre_enfants">
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
                                       <input type="date" class="form-control form-control-sm" id="naissance_affilie" name="naissance_affilie" value="<?php echo date('Y-m-d'); ?>">
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
                                     <label class="form-check-label" for="IM">Prob Adresse</label>        
                                     </div>                             
                                </div>
                                <div class="field-group p-3 bg-white">
                           
                                     <div class="field-select mr-2 mb-2">
                                        <label for="date_of_deces">Date de décès</label><br>
                                       <input type="date" class="form-control form-control-sm" id="date_of_deces" name="date_of_deces" value="<?php echo date('Y-m-d'); ?>">
                                    </div>

                                    <div class="field-select mr-2 mb-2">
                                        <label for="date_du_diagnostic"> Date du diagnostic</label><br>
                                       <input type="date" class="form-control form-control-sm" id="date_du_diagnostic" name="date_du_diagnostic" value="<?php echo date('Y-m-d'); ?>">
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
                                </div>                      
                               
                                 <div class="field-group p-3 bg-white">
                            
                                    <div class="field-select mr-2 mb-2">
                                        <label for="code_handicaped">Code Handicaped</label><br>
                                       <input type="text" class="form-control form-control-sm" id="code_handicaped" name="code_handicaped">
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
                                    <div class="submit mt-4">
                                        <button type="button" class="btn btn-info p-4" id="add" onclick="addActionAffilie()">Add Affilie</button>
                                           <button type="button" class="btn btn-info p-4" id="update"  onclick="addActionAffilie()">Update Affilie</button>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
              </div>


                <div class="row pt-5">
                  <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                            <form name="contactSubmit" method="post" id="contactSubmit">

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
                            </form>
                                  <div class="col-12 my-3">
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
                          
                              <div class="hidden-items p-3">
                                 <!--  <button class="btn btn-success" id="download_csv">Télécharger en CSV</button>
                                  <button class="btn btn-success" id="download_xls">Télécharger en XLS</button>
                                  <button class="btn btn-warning float-right" id="save_query">Sauvegarder ce rapport</button> -->
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
        </form>     
</div>

</body>
</html>

<?php include '../footer.php'; ?>
<script>
 // $('#contactSubmit').hide();
 $('#update').hide();
  $('#updateAffilieAction').hide();
 
  $('#addContact').hide();
  $('#addAffiliationAction').hide();
  $('#updateAffiliationAction').hide();
  $('#updateContactAction').hide();  
  $('#addContactAction').hide();
// Select affilie record id
 $("#search_affilie").on('change', function(){
  $('#add').hide();
  $('#update').show();
    $('#addContactAction').show();
  $('#addAffiliationAction').show();
  $('#updateAffiliationAction').hide();
  

    var id = $(this).val();
    var affilie_response = '';
    if(id){
      $.ajax({
          url:'<?php echo BASE_URL;?>services/getAffilie.php',
          type:'POST',
          data: {
              id: id
          },
          success: function(data){
           //console.log(data);

           affilie_response = data;
            printAffilieBasic(affilie_response); 
            printAffilieTable(id);
            showAffileContact(id);
          },
      })
    }
});
$('#affiliecontact tbody').on('click', '.info-contact', function() {
        $("#addContactAction").hide();
        $("#updateContactAction").show();
        let row = $(this).parents('tr');
        let data = meetTable1.row(row).data();
        $("#type").val(data.Type).change();      
        $("#email").val(data.Email);
        $("#gsm").val(data.Gsm);
        $("#telephone").val(data.Tél);
        $("#nom").val(data. Nom);
        $("#prenom").val(data.Prénom);
       // $("#cids").val(data.N°);
    });
function printAffilieBasic(affilie_response){
 var obj = JSON.parse(affilie_response);
  
  if(obj != '' && obj.message == "Success"){  
    // Company Fields to show in default fields section
    let fields = ['cle_id', 'nom_affilie', 'prenom_affilie', 'address_affilie', 'insti_affilie', 'insti_affilie_envoi', 'conjoint_affilie', 'cp', 'conjoint_affilie', 'address_envoi', 'cp_envoi', 'naissance_affilie', 'tele_affilie', 'gsm_ou_autre_tel', 'courriel', 'cle_etat_civil', 'cle_sit_familiale', 'nbre_enfants', 'date_du_diagnostic', 'code_handicaped', 'province', 'cle_assistante_sociale', 'date_de_deces','zone_libre','certi_medical','rentrees_mensuelles','rentrees_mensuelles','motif','Etiquettes_Lgt','memo','Sylvie','date_du_diagnostic', 'pas_de_courriers', 'plus_de_contact', 'Gratuit_Aff', 'Nouveau', 'Date_Nouveau', 'Nom_Modifi', 'Inactif_Obselete', 'Date_Nouveau', 'Nom_Modifi', 'BIM', 'Pas_Invitation', 'benevole_assign2', 'Etiquettes', 'Selections_Temporaire', 'LaClef', 'RGPD', 'VOLONTAIRE', 'benevole_assign', 'Prob_adresse'];
      for (var i = 0; i < fields.length; i++) {
           $('#' + fields[i]).val(obj[fields[i]]);
      }
      $('#cp').val(obj.cp).change();
      $('#province').val(obj.province).change();
       $('#status').val(obj.status).change();
      $('#social_status').val(obj.social_status).change();
      $('#cp_envoi').val(obj.cp_envoi).change();
      $('#cle_situation_familiale').val(obj.cle_sit_familiale).change();
      $('#assistantes').val(obj.cle_assistante_sociale).change();
      $('#cle_etat_civil').val(obj.cle_etat_civil).change();
      $('#affids').val(obj.cle_id);
  }
}
function printAffilieTable(id){
  $.ajax({
        url: '<?php echo BASE_URL;?>services/getAffiliation.php',
        type: 'post',
        data: {
            id: id
        },
        success: function(response) {
          // console.log(response);
            data = JSON.parse(response);
           
           if (data != '') {
                $('#affilie').DataTable({
                    "destroy": true,
                    "data": data,
                    "searching": false,
                    "paging": false,
                    "info": false,
                    "scrollY": "300px",
                    "scrollCollapse": true,
                     columns: [{
                          "data": "Clé Affiliation"
                      },
                      {
                          "data": "Nom Affilié"
                      },
                      { "data": "Date Affiliation",
                          render: function(data) {
                                  if(data!='0000-00-00 00:00:00'){
                                   return moment(data, 'YYYY-MM-DD').format('DD-MM-YYYY');
                                   } else return 'N/A';
                          }
                      },
                      {
                          "data": "Année Affiliation"
                      },
                      {
                          "data": "Montant"
                      },
                      {
                          "data": "Payé par" 
                      },
                     
                      {
                          "data": "Mode de paiement"
                      },
                      {
                          "data": "Clé type affiliation"
                      }
                     
                  ],
                });
            } else $('#affilie').DataTable().destroy(); 
          }
        });
}    
function showAffileContact(id){
  $.ajax({
            url: '<?php echo BASE_URL;?>services/getContacts.php',
            type: 'post',
            data: {
                id: id
            },
            success: function(response) {
              // console.log(response);
                data = JSON.parse(response);
               
               if (response != 'No data found') {
                var meetTable1 = $('#affiliecontact').DataTable({
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
                              "data": "Nom"
                          },
                          {
                              "data": "Prénom"
                          },
                          {
                              "data": "Tél"
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
                               
                                   return '<a class="info-contact" href="javascript:void(0);" ><img src="<?php echo BASE_URL?>img/edit.jpg" width="30" height="30" ></a>'
                              }
                          }
                         
                      ],
                    });
                } else $('#affiliecontact').DataTable().destroy(); 
              }

            });      
}


function addActionAffilie(){
  $.ajax({
      url: '<?php echo BASE_URL;?>services/addAffilie.php',
      type: 'post',
      data : $('#addAffilie').serialize(),
      success: function(data) {
       console.log(data);
        if (data == 'added') {
            alert('Affile has been added successfully');
           
        } else if (data == 'update') {
            alert('Affile has been updated successfully');
          
        } else {
            alert('There will be an error.Please try again lator');
        }
      }
  });
}
function addAffiliation(){
  $.ajax({
          url: '<?php echo BASE_URL;?>services/addAffiliation.php',
          type: 'post',
          data : $('#AffilieSubmit').serialize(),
          success: function(data) {
           console.log(data);
            if (data == 'added') {
                alert('Affiliation has been added successfully');
               
            }else if (data == 'update') {
                alert('Affiliation has been updated successfully');
              
            } else {
                alert('There will be an error.Please try again lator');
            }
          }
  });
}
function showform(){
  $('#contactSubmit').show();
  $('#addContact').show();
  $('#addContactAction').show();
  $('#updateContactAction').hide();
}
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
                tel : telephone,
                nom : nom,
                prenom : prenom
            },
             success: function(data) {
               console.log(data);
                if (data == 'added') {
                    alert('Contact has been added successfully');
                   
                } else if (data == 'update') {
                    alert('Contact has been updated successfully');
                  
                } else {
                    alert('There will be an error.Please try again lator');
                }
               }
      });
}

</script>

