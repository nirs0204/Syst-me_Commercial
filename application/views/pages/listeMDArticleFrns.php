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
                  <h4 class="card-title">Liste des moins disant</h4>
                  <p class="card-description">
                    Bon de commande <code>.A Envoyé</code>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <?php ?>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des moins disant</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Article</th>
                          <th>PU (HT)</th>
                          <th>Taux de TVA</th>
                          <th>Remise (%)</th>
                          <th>Quantité</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($besoinAchat as $besoin) { ?>
                        <tr>
                          <td><?php echo isset($besoin->nom_employe) ? $besoin->nom_employe : '';?></td>
                          <td><?php echo isset($besoin->nom_article) ? $besoin->nom_article : '';?></td>
                          <td><?php echo isset($besoin->quantite) ? $besoin->quantite : '';?></td>
                          <td><?php echo isset($besoin->raison) ? $besoin->raison : '';?></td>
                          <td><?php echo isset($besoin->date_limite) ? $besoin->date_limite : '';?></td>
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

