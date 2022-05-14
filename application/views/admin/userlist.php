<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <a href="" class=" btn btn-primary mb-3" data-toggle="modal" data-target="#newUserModal">Add New User</a>
            <?= $this->session->flashdata('message'); ?>
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['name']; ?></td>
                            <td><?= $m['role']; ?></td>
                            <td>
                                <button class="badge badge-info" data-toggle="modal" data-target="#resetModal<?= $m['id'] ?>">reset password</button>
                                <form action="edituser/<?= $m['id'] ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="_method" value="EDIT">
                                    <button type="button" class="badge badge-success" data-toggle="modal" data-target="#editUserModal<?= $m['id'] ?>">edit</button>
                                </form>
                                <button class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $m['id'] ?>">delete</button>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<!-- MODAL ADD USER -->

<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/adduser'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for=name>Username :</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukan username">
                    </div>
                    <div class="form-group">
                        <label for=email>Email :</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukan email">
                    </div>
                    <div class="form-group">
                        <label for=password>Password :</label>
                        <input type="password" class="form-control" id="password" name="password" value="default123" placeholder="Masukan password">
                    </div>
                    <div class="form-group">
                        <label for=role_id>Pilih role :</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">Select Role</option>
                            <?php foreach ($roles as $rl) :  ?>
                                <option value="<?= $rl['id']; ?>"> <?= $rl['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT USER -->
<?php foreach ($menu as $m) : ?>
    <div class="modal fade" id="editUserModal<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="edituser/<?= $m['id'] ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for='username'>Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $m['name'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="roles" class=" font-weight-bolder">Role</label>
                            <select name="roles" id="roles" class="form-control">
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $rl) :  ?>
                                    <option value="<?= $rl['id']; ?>"> <?= $rl['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- MODAL DELETE -->
<?php foreach ($menu as $m) : ?>
    <div class="modal fade" id="deleteModal<?= $m['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are you sure to delete ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" below if you are ready to delete your current surat</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="surat/hapussurat/<?= $m['id'] ?>">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- MODAL RESET -->
<?php foreach ($menu as $m) : ?>
    <div class="modal fade" id="resetModal<?= $m['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetModalLabel">Are you sure to delete ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Reset" below if you are ready to reset password your current password</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="resetpassword/<?= $m['id'] ?>">Reset</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>