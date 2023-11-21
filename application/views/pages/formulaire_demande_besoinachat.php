<?php if(!isset($article)) $article=array(); ?>
<?php if(!isset($departement)) $departement=array(); ?>

<!DOCTYPE html>
    <html lang="en">

        <body>

            <div class="main-panel">        
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Formulaire de demande de besoin</h4>
                                    <form class="forms-sample" action="<?php echo base_url('CT_BesoinAchat/storeDemandeBesoin') ?>" method="post" >
                                    <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Article</label>
                                            <div class="col-sm-9">
                                            <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="article">
                                                    <option> </option>
                                                    
                                                    <?php foreach ($article as $articles) { ?>

                                                        <option value="<?php echo $articles->id_article; ?>"><?php echo $articles->nom; ?></option>
                                                    
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Quantité</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="quantite" placeholder="quantite" name="quantite" min="1" max="10000">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Raison</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="raison" placeholder="raison" name="raison">
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Date d'expiration</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="date" placeholder="date" name="date">
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Priorité</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="priorite" placeholder="priorite" name="priorite">
                                        </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">Envoyer</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>    

        </body>
    </html>