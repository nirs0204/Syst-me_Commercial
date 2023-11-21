<?php if(!isset($listmd)) $listmd = array(); ?>
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
          <?php foreach ($listmd as $fournisseurNom => $articles) { ?>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $fournisseurNom; ?></h4>
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
                      <?php foreach ($articles as $article) { ?>
                        <tr>
                          <td><?php echo isset($article['nom_article']) ? $article['nom_article'] : ''; ?></td>
                          <td><?php echo isset($article['pu']) ? $article['pu'] : ''; ?></td>
                          <td><?php echo isset($article['tva']) ? $article['tva'] : ''; ?></td>
                          <td><?php echo isset($article['remise']) ? $article['remise'] : ''; ?></td>
                          <td><?php echo isset($article['qtt']) ? $article['qtt'] : ''; ?></td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <!-- partial -->

