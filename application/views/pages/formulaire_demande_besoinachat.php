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
                                    <form class="forms-sample">
                                        
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Employé</label>
                                            <select class="form-control form-control-lg" id="employe" name="employe">
                                                <option value="<?= $user; ?>"><?= $user; ?> </option>
                                                
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Département</label>
                                            <select class="form-control form-control-lg" id="departement" name="departement">
                                                <option> </option>
                                                
                                                <?php foreach ($departement as $departements) { ?>

                                                    <option value="<?php echo $departements->id_departement; ?>"><?php echo $departements->nom; ?></option>
                                                
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Article</label>
                                            <select class="form-control form-control-lg" id="article" name="article">
                                                <option> </option>
                                                
                                                <?php foreach ($article as $articles) { ?>

                                                    <option value="<?php echo $articles->id_article; ?>"><?php echo $articles->nom; ?></option>
                                                
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Quantité</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="quantite" placeholder="quantite" name="quantite">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Raison</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="raison" placeholder="raison" name="raison">
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Etat</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="etat" placeholder="etat" name="etat">
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