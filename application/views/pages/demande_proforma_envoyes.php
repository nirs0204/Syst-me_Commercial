
<?php if(!isset($demande)) $demande=array(); ?>
<?php if(!isset($date_actuel)) $date_actuel=array(); ?>

<!DOCTYPE html>
<html lang="en">

<body>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

        <?php foreach ($demande as $val) { ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Demande de Proforma du : <?php echo $val->date_actuel; ?></h4>
                    <p class="card-description">
                      Liste des <a href="<?php echo site_url("CT_Demande/request_detail/{$val->date_actuel}"); ?>" style="color:red">.détails d'article</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
