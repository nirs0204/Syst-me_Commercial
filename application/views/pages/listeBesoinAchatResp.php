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
                  <h4 class="card-title">Liste des besoins d'achat</h4>
                  <p class="card-description">
                    Validation <code>.Responsable</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Employe</th>
                          <th>Article</th>
                          <th>Quantité</th>
                          <th>Date_limite</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($besoinAchat as $besoin) { ?>
                        <tr>
                          <td><?php echo isset($besoin->nom_employe) ? $besoin->nom_employe : '';?></td>
                          <td><?php echo isset($besoin->nom_article) ? $besoin->nom_article : '';?></td>
                          <td><?php echo isset($besoin->quantite) ? $besoin->quantite : '';?></td>
                          <td><?php echo isset($besoin->date_limite) ? $besoin->date_limite : '';?></td>
                          <td><a href="<?php echo site_url('CT_BesoinAchatFinal/approuvedBesoinAchat'); ?>?idbesoinachat=<?php echo isset($besoin->idbesoin_achat) ? $besoin->idbesoin_achat : '';?>" class="btn btn-inverse-success btn-sm">Approuvé</a></td>
                          <td><a href="<?php echo site_url('CT_BesoinAchatFinal/rejectedBesoinAchat'); ?>?idbesoinachat=<?php echo isset($besoin->idbesoin_achat) ? $besoin->idbesoin_achat : '';?>" class="btn btn-inverse-primary btn-sm">Rejeté</a></td>
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

