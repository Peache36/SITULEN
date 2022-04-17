<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <a href="" class=" btn btn-primary mb-3" data-toggle="modal" data-target="#newUserModal">Add New User</a>
            <?= $this->session->flashdata('message'); ?>
            <table class="table table-hover">
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
                            <option value="Administrator">Administrator</option>
                            <option value="Member">Member</option>

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