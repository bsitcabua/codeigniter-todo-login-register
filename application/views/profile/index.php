
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>
    
    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card h-100 py-2 m-auto w-50" style="min-width: 350px">
                <div class="card-body" style="min-height: 350px;">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Profile Details</h1>
                        </div>
                        <!-- <div class="float-right">
                            <a href="{{ url("/profile/".auth()->user()->id."/edit") }}"><i class="fa fa-pen text-sm text-danger"></i></a>
                        </div> -->
                        <p title="Firstname">
                            <?php echo ucwords(strtolower($this->session->userdata('first_name'))) ?>
                        </p>

                        <p title="Lastname">
                        <?php echo ucwords(strtolower($this->session->userdata('last_name'))) ?>
                        </p>

                        <p title="Email">
                            <?php echo$this->session->userdata('email') ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
