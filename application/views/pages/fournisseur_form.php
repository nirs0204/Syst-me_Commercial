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
                  <h4 class="card-title">Envoi proforma</h4>
                  <p class="card-description">
                    Email de <code>.proforma</code>
                  </p>

                  <?php if(isset($success)){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> <?php echo $success ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <?php } ?>

              
                  <?php echo form_open_multipart('CT_Fournisseur/upload_fichier'); ?>
                  
                  <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Objet</label>
                      <div class="col-sm-9">
                        <input type="text" name="objet" class="form-control" id="exampleInputUsername2" placeholder="Objet de l'email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Titre</label>
                      <div class="col-sm-9">
                        <input type="text" name="titre" class="form-control" id="exampleInputUsername2" placeholder="titre de l'email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Date de demande</label>
                      <div class="col-sm-9">
                        <input type="file" name="fichier" class="form-control" id="exampleInputMobile">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-outline-danger btn-icon-text"><i class="typcn typcn-upload btn-icon-prepend"></i>Upload</button>
                 
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>