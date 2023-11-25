<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CelestialUI Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href=<?php echo base_url("assets/vendors/typicons.font/font/typicons.css"); ?>>
  <link rel="stylesheet" href=<?php echo base_url("assets/vendors/css/vendor.bundle.base.css"); ?>>
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href=<?php echo base_url("assets/css/vertical-layout-light/style.css"); ?>>
  <!-- endinject -->
  <link rel="shortcut icon" href=<?php echo base_url("assets/images/favicon.png"); ?> />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src=<?php echo base_url("assets/images/logo.svg"); ?> alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>

              <?php if(isset($error)){ ?>
                  <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                    <strong>Error!</strong> <?php echo $error ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
              <?php } ?>

              <form class="pt-3" action="<?php echo site_url("CT_Fournisseur/tosignIn"); ?>" method="POST">
                <div class="form-group">
                  <input type="text" name="pseudo" class="form-control form-control-lg" id="exampleInputEmail1" value="FRNS A" placeholder="Nom">
                </div>
                <div class="form-group">
                  <input type="password" name="mdp" class="form-control form-control-lg" id="exampleInputPassword1" value="123" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="typcn typcn-social-facebook-circular mr-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src=<?php echo base_url("assets/vendors/js/vendor.bundle.base.js"); ?>></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src=<?php echo base_url("assets/js/off-canvas.js"); ?>></script>
  <script src=<?php echo base_url("assets/js/hoverable-collapse.js"); ?>></script>
  <script src=<?php echo base_url("assets/js/template.js"); ?>></script>
  <script src=<?php echo base_url("assets/js/settings.js"); ?>></script>
  <script src=<?php echo base_url("assets/js/todolist.js"); ?>></script>
  <!-- endinject -->
</body>

</html>
