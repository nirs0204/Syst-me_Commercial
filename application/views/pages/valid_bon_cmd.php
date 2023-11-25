<?php if(!isset($invalid)) $invalid = array(); ?>
<!DOCTYPE html>
<html lang="en">
 
<body>

<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Bon de Commande en attente</h4>
                  <p class="card-description">
                    Bon de commande <code>.A Valider</code>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between">
                      <h4 class="card-title mb-3">En attente</h4>
                      <p>Demande du <?php if(isset($invalid) && count($invalid) != 0){ echo $invalid[0]->date_actuel; } ?></p>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Fournisseur</th>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>PU</th>
                            <th>Total TTC</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($invalid as $valid) { ?>
                              <tr>
                                <td><?php echo $valid->nom_fournisseur; ?></div></td>
                                <td><div><?php echo $valid->nom_article; ?></td>
                                <td><?php echo $valid->qtt; ?></td>
                                <td><?php echo $valid->pu; ?></td>
                                <td><?php echo $valid->ttl_ttc; ?></td>
                                <td>  <a type="button" href="<?php echo site_url("CT_Valid_cmd/valid"); ?>?article=<?php echo $valid->id_article; ?>&&date=<?php echo $valid->date_actuel; ?>&&frns=<?php echo $valid->id_fournisseur; ?> " class="btn btn-success btn-rounded btn-fw">Valider</a></td>
                                <td><a type="button" href="<?php echo site_url("CT_Valid_cmd/invalid"); ?>?article=<?php echo $valid->id_article; ?>&&date=<?php echo $valid->date_actuel; ?>&&frns=<?php echo $valid->id_fournisseur; ?>" class="btn btn-primary btn-rounded btn-fw">Rejeter</a></td>
                              </tr>
                              <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
          </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <!-- partial -->

