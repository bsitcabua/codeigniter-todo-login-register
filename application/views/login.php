<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="apple-touch-icon" sizes="180x180" href="https://codeigniter.com/assets/images/ci-logo-big.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://codeigniter.com/assets/images/ci-logo-big.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://codeigniter.com/assets/images/ci-logo-big.png">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

</head>

<body class="bg-gradient-light">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

        <!-- {{-- <div class="col-xl-12 col-lg-12 col-md-9"> --}} -->
        <div class="col-lg-6 col-md-6 col-sm-12">

            <div class="card o-hidden border-0 shadow-lg" style="margin-top: 20%">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --}} -->
                        <div class="col-lg-12">
                            <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login your account</h1>
                            </div>

                            <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $this->session->flashdata('err_msg'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <?php if(!empty($this->session->flashdata('msg'))): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $this->session->flashdata('msg'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif ?>

                            <?php $validator = $this->form_validation->error_array() ?>

                            <form class="user" method="POST" action="<?php echo base_url('/auth/login') ?>">
                                <!-- @csrf -->
                                <div class="form-group">
                                    <input 
                                        type="text" 
                                        class="form-control form-control-user <?php echo (isset($validator['email'])) ? 'is-invalid' : '' ?>"
                                        name="email"
                                        id="email"
                                        value="<?php echo $this->session->flashdata('email') ?>"
                                        placeholder="Email"
                                    >
                                    <div class="invalid-feedback">
                                       <?php echo (isset($validator['email'])) ? $validator['email'] : '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input 
                                        type="password"
                                        class="form-control form-control-user <?php echo (isset($validator['password'])) ? 'is-invalid' : '' ?>"
                                        name="password"
                                        id="password"
                                        placeholder="Password"
                                    >
                                    <div class="invalid-feedback">
                                        <?php echo (isset($validator['password'])) ? $validator['password'] : '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?php echo base_url('auth/register') ?>">Create an Account!</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js') ?>"></script>

</body>

</html>
