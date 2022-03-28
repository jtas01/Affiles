<?php 
$query = "SELECT * FROM affilie";
$result =  $pdo->query($query);
$count=$result->rowCount();
if($count>0) {
  while ($row = $result->fetch()) {   
    $affilie[] = $row;                                  
  }
} 
$status[]=array(
"N"=>"New",
"X"=>'Incomplete',
"E"=>'Salaried',
"P"=>'Sick',
"Y"=>'Sympathiser',
"V"=>'Volunteer'
);
$LaClef[]=array(
"Papier"=>"Papier",
"Numérique"=>'Numérique',
"Numérique et papier"=>'Numérique et papier',
"Ne pas envoyer"=>'Ne pas envoyer'
);
$query = "SELECT * FROM `type_contacts`";
$result =  $pdo->query($query);
$count=$result->rowCount();
if($count>0) {
  while ($row = $result->fetch()) {   
    $type_contacts[] = $row;                                  
  }
}
$query = "SELECT * FROM `provinces`";
$result =  $pdo->query($query);
$count=$result->rowCount();
if($count>0) {
  while ($row = $result->fetch()) {   
    $province[] = $row;                                  
  }
}
$query = "SELECT * FROM `situation familiale`";
$result =  $pdo->query($query);
$count=$result->rowCount();
if($count>0) {
  while ($row = $result->fetch()) {   
    $situation_familiale[] = $row;                                  
  }
}
$query = "SELECT * FROM `etat civil`";
$result =  $pdo->query($query);
$count=$result->rowCount();
if($count>0) {
  while ($row = $result->fetch()) {   
    $etat_civil[] = $row;                                  
  }
}                                      
$query = "SELECT * FROM `codes postaux`";
$result =  $pdo->query($query);
$count=$result->rowCount();
if($count>0) {
    while ($row = $result->fetch()) {
      $cp[] = $row;        
    }
}
$query = "SELECT * FROM `codes postaux`";
$result =  $pdo->query($query);
$count=$result->rowCount();
if($count>0) {
    while ($row = $result->fetch()) {
      $cp_tables[] = $row;        
    }
}
$query = "SELECT * FROM `assistantes sociales`";
$result =  $pdo->query($query);
$count=$result->rowCount();
if($count>0) {
    while ($row = $result->fetch()) {
      $assistantes[] = $row;
        
    }
}
$query = "SELECT * FROM `statut social`";
$result =  $pdo->query($query);
$count=$result->rowCount();
if($count>0) {
    while ($row = $result->fetch()) {
      $social_status[] = $row;
        
    }
} 
$query = "SELECT * FROM `affiliés_contacts`";
$result =  $pdo->query($query);
$contact_count=$result->rowCount();
if($contact_count>0) {
    while ($row = $result->fetch()) {
      $datacon[] = $row;
        
    }
} 
$query = "SELECT * FROM `type affiliation`";
$result =  $pdo->query($query);
$contact_count=$result->rowCount();
if($contact_count>0) {
    while ($row = $result->fetch()) {
      $type_affilie[] = $row;
        
    }
} 


?>