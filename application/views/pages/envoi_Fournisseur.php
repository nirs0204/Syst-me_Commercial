<?php if(!isset($article)) $article=array(); ?>
<?php if(!isset($fournisseur)) $fournisseur=array(); ?>
<!DOCTYPE html>
<html lang="en">

<body>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">


        <div class="row">
              <div class="col-lg-12 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between">
                      <h4 class="card-title mb-3">Envoi détail article:</h4>
                    </div>
                    <p><strong>Nom:</strong> <?php echo $article['nom']; ?></p>
                    <p><strong>Categorie:</strong> <?php echo $article['categorie']; ?></p>
                    <p><strong>Quantité : </strong><?php echo $article['sum']; ?></p>
                  
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-description">Cocher <code>.fournisseur(s)</code> pour votre article (max 3)</p>
                            <form action="<?php echo site_url("CT_Demande/index"); ?>"  method="POST">
                                <input type="hidden" name="article" value="<?php echo $article['id_article']; ?>">
                                <input type="hidden" name="qtt" value="<?php echo $article['sum']; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                        <?php foreach ($fournisseur as $val) { ?>
                                            <div class="form-check form-check-info">
                                                <label class="form-check-label">
                                                    <input  name="frns[]" type="checkbox" class="form-check-input" name="ExampleCheckbox1" id="ExampleCheckbox1" value= <?php echo $val->id_fournisseur; ?>>
                                                    <?php echo $val->email; ?> ( <?php echo $val->nom; ?>)
                                                </label>
                                            </div>
                                        <?php } ?>
                                    
                                           
                                        </div>
                                        <button type="submit" class="btn btn-info">Envoyer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <h3> <a href="<?php echo site_url("CT_BesoinAchatFinal/get_Achat"); ?>"><<=Return</a></h3>
            </div>
            

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
