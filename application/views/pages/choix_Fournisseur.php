<?php if(!isset($achat)) $achat=array(); ?>
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
                  <h4 class="card-title">Table de détail d'achat</h4>
                  <p class="card-description">
                    Liste des <code>.détails d'article</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Article</th>
                          <th>Categorie</th>
                          <th>Quantité</th>
                          <th>date limite MIN </th>
                          <th>date limite MAX </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php foreach ($achat as $val) { ?>
                        <tr>
                          <td ><?php echo $val->nom; ?></td>
                          <td><?php echo $val->categorie; ?></td>
                          <td><?php echo $val->qtt; ?></td>
                          <td><?php echo $val->min_date; ?></td>
                          <td><?php echo $val->max_date; ?></td>
                          <td><a href="<?php echo site_url("CT_BesoinAchatFinal/send_Achat"); ?>?article=<?php echo $val->id_article; ?>"><label class="badge badge-info">list fournisseurs</label></a></td>
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
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
