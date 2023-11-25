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
                    Horizontal form layout
                  </p>
                  <form class="forms-sample" method="post" action="<?php echo site_url('CT_Founisseur/'); ?>">
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Date de demande</label>
                      <div class="col-sm-9">
                        <input type="file" name="fichier" class="form-control" id="exampleInputMobile">
                      </div>
                    </div>
                    <button type="button" class="btn btn-outline-danger btn-icon-text">
                          <i class="typcn typcn-upload btn-icon-prepend"></i>                                                    
                          Upload
                        </button>
                  </form>
                </div>
              </div>
            </div>