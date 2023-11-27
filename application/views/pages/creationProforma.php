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
                  <h4 class="card-title">Création proforma</h4>
                  <p class="card-description">
                    Horizontal form layout
                  </p>
                  <form class="forms-sample" method="post" action="<?php echo site_url('CT_FormCsv/pass'); ?>">
                    <div class="form-group row">
                      <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Fournisseur</label>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nom Société</label>
                      <div class="col-sm-9">
                        <input type="text" name="nom_societe" class="form-control" id="exampleInputMobile">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Adresse de la société</label>
                      <div class="col-sm-9">
                        <input type="text" name="adresse_societe" class="form-control" id="exampleInputMobile" placeholder="Adresse de la société">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Téléphone</label>
                      <div class="col-sm-9">
                        <input type="number" name="telephone" class="form-control" id="exampleInputMobile" placeholder="tel">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mail</label>
                      <div class="col-sm-9">
                        <input type="text" name="mail" class="form-control" id="exampleInputMobile" placeholder="mail">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Référence Proforma</label>
                      <div class="col-sm-9">
                        <input type="text" name="ref_proforma" class="form-control" id="exampleInputMobile" placeholder="numéro">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Date du proforma</label>
                      <div class="col-sm-9">
                        <input type="date" name="date_proforma" class="form-control" id="exampleInputMobile" placeholder="date">
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nom Société</label>
                      <div class="col-sm-9">
                        <input type="text" name="nom_societe_demandeur" class="form-control" id="exampleInputMobile">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Adresse de la société</label>
                      <div class="col-sm-9">
                        <input type="text" name="adresse_sd" class="form-control" id="exampleInputMobile" placeholder="Adresse de la société">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Téléphone</label>
                      <div class="col-sm-9">
                        <input type="number" name="telephone_sd" class="form-control" id="exampleInputMobile" placeholder="tel">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mail</label>
                      <div class="col-sm-9">
                        <input type="text" name="email_sd" class="form-control" id="exampleInputMobile" placeholder="mail">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Description</label>
                      <div class="col-sm-9">
                        <input type="text" name="description" class="form-control" id="exampleInputMobile" placeholder="description">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Quantite</label>
                      <div class="col-sm-9">
                        <input type="number" name="quantite" class="form-control" id="exampleInputMobile" placeholder="quantite">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Prix umitaire</label>
                      <div class="col-sm-9">
                        <input type="number" name="prix_unitaire" class="form-control" id="exampleInputMobile" placeholder="prix_unitaire">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>