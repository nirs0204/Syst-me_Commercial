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
            <a class="nav-link" href="<?php echo site_url("CT_BesoinAchatFinal/listAllBesoinAchatParResp"); ?>">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title" >Validation Besoin achat</span>
            </a>
          </li>
          <?php if($_SESSION['user']['id_employe'] == 3) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("CT_Valid_cmd/"); ?>">
              <i class="typcn typcn-th-small-outline menu-icon"></i>
              <span class="menu-title">Validation bon de commande</span>
            </a>
          </li>
          <?php } ?>
        </ul>
      </nav>