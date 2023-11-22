<?php if(!isset($besoinAchat)) $besoinAchat = array(); ?>
<!DOCTYPE html>
<html lang="en">
 
<body>

<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des besoins d'achat rejetés</h4>
                  <p class="card-description">
                    Liste <code>.rejetée</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Employe</th>
                          <th>Departement</th>
                          <th>Article</th>
                          <th>Quantité</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($besoinAchat as $besoin) { ?>
                        <tr>
                          <td><?php echo isset($besoin->employe_nom) ? $besoin->employe_nom : '';?></td>
                          <td><?php echo isset($besoin->departement_nom) ? $besoin->departement_nom : '';?></td>
                          <td><?php echo isset($besoin->article_nom) ? $besoin->article_nom : '';?></td>
                          <td><?php echo isset($besoin->quantite) ? $besoin->quantite : '';?></td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <!-- partial -->

