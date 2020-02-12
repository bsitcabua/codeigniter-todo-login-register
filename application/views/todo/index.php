
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Todo</h1>
        <a href="{{ url('/contacts/create') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
    </div> -->

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 mb-4">
            <div class="card h-100 py-2">
                <div class="card-body table-responsive" style="min-height: 350px;">
                    <center><h2>TODO</h2></center>
                    <form class="form-inline mr-auto w-100 form-ajax" reload="reload_todos" action="<?php echo base_url('/todo/store') ?>" method="POST">
                        <div class="input-group w-100">
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control bg-light small"
                                placeholder="Add todo"
                                aria-label="Add todo"
                                aria-describedby="basic-addon2"
                                required
                            >
                            <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-plus fa-sm"></i>
                            </button>
                            </div>
                        </div>
                    </form>
                    <button id="checkAll" class="btn btn-success mt-2" reload="reload_todos">Mark all as done</button>
                    <hr>

                    <ul id="todo_list_not_done" class="list-unstyled">
                        <?php if($todos->num_rows() > 0): ?>
                            <?php foreach($todos->result() as $key => $row): ?>
                                <?php if($row->is_done == 0): ?>
                                    <li class="ui-state-default todo_status_not_done" reload="reload_todos" style="cursor:pointer" id="<?php echo $row->id ?>">
                                    <i class="fas fa-trash fa-sm float-right mt-2 mr-2 text-danger delete_todo" id="<?php echo $row->id ?>" reload="reload_todos" style="cursor:pointer"></i>
                                        <div class="checkbox">
                                            <input type="checkbox" value="<?php echo $row->id ?>">
                                            <label><?php echo $row->name ?></label>
                                        </div>
                                    </li>
                                    <hr class="m-2">
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 mb-4">
            <div class="card h-100 py-2">
                <div class="card-body table-responsive" style="min-height: 350px;">
                    <center><h2>ALREADY DONE</h2></center>

                    <ul id="todo_list_done" class="list-unstyled">
                        <?php if($todos->num_rows() > 0): ?>
                            <?php foreach($todos->result() as $key => $row): ?>
                                <?php if($row->is_done == 1): ?>
                                    <li class="ui-state-default todo_status_done" id="<?php echo $row->id ?>">
                                        <i class="fas fa-check fa-sm"></i> <?php echo $row->name ?>
                                        <i class="fas fa-trash fa-sm float-right mt-1 mr-2 text-danger delete_todo" id="<?php echo $row->id ?>" reload="reload_todos" style="cursor:pointer"></i>
                                        <i class="fas fa-undo fa-sm float-right mt-1 mr-2 undo_todo" id="<?php echo $row->id ?>" reload="reload_todos" style="cursor:pointer"></i>
                                    </li>
                                    <hr class="m-2">
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->
