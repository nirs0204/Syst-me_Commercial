<?php if(!isset($articleList)) $articleList = array(); 
if(!isset($fournisseurList)) $fournisseurList = array();?>
<!DOCTYPE html>
<html lang="en">
 
<body>
<div class="main-panel">        
    <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Demande Proforma</h4>
                  <p class="card-description">
                    Horizontal form layout
                  </p>
                  <form class="forms-sample" method="post" action="<?php echo site_url('CT_Proforma/proformaSubmit'); ?>">
                    <div class="form-group row">
                      <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Article</label>
                      <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="article">
                        <?php foreach ($articleList as $article) { ?>
                            <option value="<?php echo isset($article->id_article) ? $article->id_article : '';?>"><?php echo isset($article->nom) ? $article->nom : '';?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Fournisseur</label>
                      <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="fournisseur">
                        <?php foreach ($fournisseurList as $fournisseur) { ?>
                            <option value="<?php echo isset($fournisseur->id_fournisseur) ? $fournisseur->id_fournisseur : '';?>"><?php echo isset($fournisseur->nom) ? $fournisseur->nom : '';?></option>
                        <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Date de demande</label>
                      <div class="col-sm-9">
                        <input type="date" name="date" class="form-control" id="exampleInputMobile">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Prix unitaire</label>
                      <div class="col-sm-9">
                        <input type="number" name="pu" min="0" class="form-control" id="exampleInputMobile" placeholder="Prix Unitaire">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">% TVA</label>
                      <div class="col-sm-9">
                        <input type="number" name="tva" min="0" max="100" class="form-control" id="exampleInputMobile" placeholder="Taux de TVA">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Remise</label>
                      <div class="col-sm-9">
                        <input type="number" name="remise" min="0" max="100" class="form-control" id="exampleInputMobile" placeholder="% Remise">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Quantité au stock</label>
                      <div class="col-sm-9">
                        <input type="number" name="stock" min="0" class="form-control" id="exampleInputMobile" placeholder="Quantité dans le stock">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>