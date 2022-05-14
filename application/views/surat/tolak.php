<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- TAMPILIN TABEL SURAT -->
    <div class="row">
        <div class="col">

            <?= $this->session->flashdata('message'); ?>

            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"> Nama Lengkap</th>
                        <th scope="col">Jenis Surat</th>
                        <th scope="col">Status</th>
                        <th scope="col" width="300">Perihal</th>
                        <th scope="col">Dokumen</th>
                        <th scope="col" width="300">Keterangan</th>
                        <th scope="col">Date Create</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <!-- TAMPILAN DI PROSES BAGIAN MEMBER -->

                    <?php foreach ($status as $s) :
                        // CEK ROLE MEMBER
                        if ($user['role_id'] != 2) {
                            continue;
                        } else {
                            if ($s['status_id'] != 3 or $s['user_id'] != $user['id']) {
                                continue;
                            }
                        }
                    ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $s['nama_lengkap']; ?></td>
                            <?php foreach ($option as $o) :
                                if ($o['id'] != $s['jenis_id']) {
                                    continue;
                                } ?>
                                <td><?= $o['jenis']; ?></td>
                            <?php endforeach; ?>
                            <td><a class=" badge badge-danger"><?= $s['status']; ?> </a></td>
                            <td><?= $s['perihal']; ?></td>
                            <td><?= $s['dokumen']; ?></td>
                            <td><?= $s['keterangan']; ?></td>
                            <td> <?= date('d F Y', $s['date_created']) ?></td>
                            <td>
                                <form action="surat/editsurat/<?= $s['id'] ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="_method" value="EDIT">
                                    <button type="button" class="badge badge-success" data-toggle="modal" data-target="#editSuratModalMember<?= $s['id'] ?>">edit</button>
                                </form>

                                <button class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $s['id'] ?>">delete</button>

                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                    <!-- TAMPILAN DIPROSES BAGIAN ADMIN    -->

                    <?php foreach ($status as $s) :
                        // CEK ROLE MEMBER
                        if ($user['role_id'] != 1) {
                            continue;
                        } else {
                            if ($s['status_id'] != '3') {
                                continue;
                            }
                        }
                    ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $s['nama_lengkap']; ?></td>
                            <?php foreach ($option as $o) :
                                if ($o['id'] != $s['jenis_id']) {
                                    continue;
                                } ?>
                                <td><?= $o['jenis']; ?></td>
                            <?php endforeach; ?>
                            <td><a class=" badge badge-danger"><?= $s['status']; ?> </a></td>
                            <td><?= $s['perihal']; ?></td>
                            <td><?= $s['dokumen']; ?></td>
                            <td><?= $s['keterangan']; ?></td>
                            <td> <?= date('d F Y', $s['date_created']) ?></td>
                            <td>
                                <form action="surat/editsurat/<?= $s['id'] ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="_method" value="EDIT">
                                    <button type="button" class="badge badge-success" data-toggle="modal" data-target="#editSuratModalAdmin<?= $s['id'] ?>">edit</button>
                                </form>

                                <button class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $s['id'] ?>">delete</button>
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

<!-- MODAL EDIT SURAT ADMIN -->
<?php foreach ($surat as $s) : ?>
    <div class="modal fade" id="editSuratModalAdmin<?= $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSuratModalAdminLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSuratModalAdminLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="editsurat/<?= $s['id'] ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for='nama_lengkap'>Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $s['nama_lengkap'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="jenis" class=" font-weight-bolder">Jenis Surat</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="">Select Jenis Surat</option>
                                <?php foreach ($option as $o) :  ?>
                                    <option value="<?= $o['id']; ?>"> <?= $o['jenis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class=" font-weight-bolder">Status Surat</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Select Status</option>
                                <?php foreach ($optionstatus as $os) :  ?>
                                    <option value="<?= $os['id']; ?>"> <?= $os['status']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class=" font-weight-bolder" for='perihal'>Perihal</label>
                            <input type="text" class="form-control" id="perihal" name="perihal" value="<?= $s['perihal'] ?>">
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bolder" for='keterangan'>Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $s['keterangan'] ?>">
                        </div>
                        <label for="jenis" class=" font-weight-bolder">Pilih Dokumen</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="dokumen" name="dokumen">
                            <label class="custom-file-label" for="dokumen">Choose file</label>
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

<!-- MODAL EDIT SURAT MEMBER -->
<?php foreach ($surat as $s) : ?>
    <div class="modal fade" id="editSuratModalMember<?= $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSuratModalMemberLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSuratModalMemberLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="editsurat/<?= $s['id'] ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class=" font-weight-bolder" for='nama_lengkap'>Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $s['nama_lengkap'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="jenis" class=" font-weight-bolder">Jenis Surat</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="">Select Jenis Surat</option>
                                <?php foreach ($option as $o) :  ?>
                                    <option value="<?= $o['id']; ?>"> <?= $o['jenis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class=" font-weight-bolder">Status Surat</label>
                            <input type="text" class="form-control" id="status" name="status" value="2" hidden>
                            <input type="text" class="form-control" value="<?= $optionstatus[1]['status'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bolder" for='perihal'>Perihal</label>
                            <input type="text" class="form-control" id="perihal" name="perihal" value="<?= $s['perihal'] ?>">
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
<?php foreach ($surat as $s) : ?>
    <div class="modal fade" id="deleteModal<?= $s['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                    <a class="btn btn-danger" href="hapussurat/<?= $s['id'] ?>">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>