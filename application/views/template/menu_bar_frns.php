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
            <p class="sidebar-menu-title">Menu Fournisseur</p>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url("CT_Fournisseur/demande"); ?>">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title" >Demande de la societe</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="<?php echo site_url("CT_Fournisseur/welcome"); ?>" >
              <i class="typcn typcn-briefcase menu-icon"></i>
              <span class="menu-title">envoi de Proforma</span>
            </a>
          </li>
        </ul>
      </nav>