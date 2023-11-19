<?php if(!isset($fpa)) $fpa=array(); ?>
<!DOCTYPE html>
<html lang="en">

<body>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

        
                <div class="row">
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Detail Demande envoyées: </h4>
                        <p class="card-description">
                          Liste des <code>.détails d'article + fournisseur</code>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <?php foreach ($fpa as $article_id => $article_info) { ?>
                <div class="row">
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title"><?php echo $article_info['nom']; ?> :<?php echo $article_info['quantite']; ?></h4>
                        <?php  foreach ($article_info['fournisseurs'] as $fournisseur) { ?>
                            <ul class="sidebar-legend">
                                <li class="nav-item"><?php echo $fournisseur->nom; ?> : <?php echo $fournisseur->email; ?></li>
                            </ul>
                         <?php  } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php  } ?>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
