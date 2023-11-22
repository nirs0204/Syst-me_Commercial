<!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <div class="d-flex sidebar-profile">
              <div class="sidebar-profile-image">
                <img src=<?php echo base_url("assets/images/faces/face29.png"); ?> alt="image">
                <span class="sidebar-status-indicator"></span>
              </div>
              <div class="sidebar-profile-name">
                <p class="sidebar-name">
                  Kenneth Osborne
                </p>
                <p class="sidebar-designation">
                  Welcome
                </p>
              </div>
            </div>
            <div class="nav-search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
                <div class="input-group-append">
                  <span class="input-group-text" id="search">
                    <i class="typcn typcn-zoom"></i>
                  </span>
                </div>
              </div>
            </div>
            <p class="sidebar-menu-title">Dash menu</p>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="typcn typcn-briefcase menu-icon"></i>
              <span class="menu-title">Besoin achat</span>
              <i class="typcn typcn-chevron-right menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo site_url("CT_BesoinAchat/create"); ?>">Création BA</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo site_url("CT_BesoinAchat/listeEnAttente"); ?>">Demande en attente</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo site_url("CT_BesoinAchat/listeApprouve"); ?>">Demande approuvée</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo site_url("CT_BesoinAchat/listRejete"); ?>">Demande rejetée</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("CT_BesoinAchatFinal/listAllBesoinAchatParServiceAchat"); ?>">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title" >Validation Besoin achat</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("CT_Demande/request_progress"); ?>">
              <i class="typcn typcn-document-text menu-icon"></i>
              <span class="menu-title">Demande Proforma</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("CT_BesoinAchat/request"); ?>">
              <i class="typcn typcn-document-text menu-icon"></i>
              <span class="menu-title">Detail Besoin Achat</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="typcn typcn-chart-pie-outline menu-icon"></i>
              <span class="menu-title">Proforma  Fournisseur</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo site_url("CT_Proforma/proformaForm"); ?>">Insertion PF</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo site_url("CT_Proforma/listProforma"); ?>">Proforma existante</a></li>
              </ul>
            </div>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("CT_ProformaFinal/listBonCommande2"); ?>">
              <i class="typcn typcn-document-text menu-icon"></i>
              <span class="menu-title">Bon de commande</span>
            </a>
          </li>
          </ul>
      </nav>