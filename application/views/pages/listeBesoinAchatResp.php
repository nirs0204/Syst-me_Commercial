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
                    Add class <code>.table</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Employe</th>
                          <th>Article</th>
                          <th>Quantité</th>
                          <th>Raison</th>
                          <th>Date limite</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Jacob</td>
                          <td>53275531</td>
                          <td>12 May 2017</td>
                          <td>payement payement payement payement</td>
                          <td></td>
                          <td><a href="<?php echo site_url('CT_BesoinAchatFinal/approuvedBesoinAchat'); ?>?idbesoinachat=" class="btn btn-inverse-success btn-sm">Approuvé</a></td>
                          <td><a href="<?php echo site_url('CT_BesoinAchatFinal/rejectedBesoinAchat'); ?>?idbesoinachat=" class="btn btn-inverse-primary btn-sm">Rejeté</a></td>
                        </tr>
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

</body>
</html>