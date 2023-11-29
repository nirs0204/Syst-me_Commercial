<?php if(!isset($demande)) $demande = array(); ?>
<!DOCTYPE html>
<html lang="en">
 
<body>
<div class="main-panel">        
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Inverse table</h4>
                  <p class="card-description">
                    Add class <code>.table-dark</code>
                  </p>
                  <div class="table-responsive pt-3">
                    <table class="table table-dark">
                      <thead>
                        <tr>
                          <th>#id_Article</th>
                          <th>Article</th>
                          <th>Quantité</th>
                          <th>date_demande</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($demande as $val) { ?>
                            <tr>
                                <td><?php echo $val->id_article; ?></td>
                                <td><?php echo $val->nom; ?></td>
                                <td><?php echo $val->quantite; ?></td>
                                <td><?php echo $val->date_actuel; ?></td>
                            </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>