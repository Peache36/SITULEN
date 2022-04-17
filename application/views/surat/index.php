<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- TAMPILIN TABEL SURAT -->
    <div class="row">
        <div class="col">
            <a href="" class=" btn btn-primary mb-3" data-toggle="modal" data-target="#newSuratModal">Add New Surat</a>
            <?= $this->session->flashdata('message'); ?>

            <table class="table table-hover">
                <thead>
                    <tr class=" text-center">
                        <th scope="col">#</th>
                        <th scope="col"> Menu</th>
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
                    <?php foreach ($status as $s) :
                        if ($user['role_id'] != 1) {
                            if ($s['status_id'] != 1 or $s['user_id'] != $user['id']) {
                                continue;
                            }
                        }
                    ?>
                        <tr class=" text-center">
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $s['nama_lengkap']; ?></td>
                            <td><?= $s['jenis_id']; ?></td>
                            <td><a class=" badge badge-warning"><?= $s['status']; ?> </a></td>
                            <td><?= $s['perihal']; ?></td>
                            <td><?= $s['dokumen']; ?></td>
                            <td><?= $s['keterangan']; ?></td>
                            <td> <?= date('d F Y', $s['date_created']) ?></td>
                            <td>
                                <form action="surat/<?= $s['id'] ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="_method" value="EDIT">
                                    <button type="button" class="badge badge-success" data-toggle="modal" data-target="#editMenuModal<?= $s['id'] ?>">edit</button>
                                </form>

                                <form action="surat/<?= $s['id'] ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="badge badge-danger">delete</button>
                                </form>
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

<!-- MODAL SURAT -->
<div class="modal fade" id="newSuratModal" tabindex="-1" role="dialog" aria-labelledby="newSuratModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSuratModalLabel">Add New Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('surat'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="menu" class=" font-weight-bolder">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="jenis" class=" font-weight-bolder">Jenis Surat</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($option as $o) :  ?>
                                <option value="<?= $o['id']; ?>"> <?= $o['jenis']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="perihal" class=" font-weight-bolder">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal">
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