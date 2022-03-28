<?php

session_start();
ob_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo BASE_URL;?>">LigueCRM Website</a>
      <a style="color: white"><?php if($_SESSION){?> Welcome <?php echo ucfirst($_SESSION['NOM']); }?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
  <?php
  if($_SESSION['NOM']){?>
        
        <!--  <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL;?>pages/list-batiment.php">LIST BATIMENTS</a>
        </li> -->
          <li class="nav-item">

              <a href="<?php echo BASE_URL;?>services/logout.php?logout=true">Logout</a>
          </li>
 <?php  }?>
      </ul>
    </div>
  </div>
</nav>