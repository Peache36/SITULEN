<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">

        <!-- JUMLAH USER -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 20px;">
                                JUMLAH USER</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php $data['jumlah'] = $this->db->get('user');
                                echo $data['jumlah']->num_rows();; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-solid fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SURAT DIPROSES -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 20px;">
                                DIPROSES</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $this->db->where('status_id', 1);
                                $data['surat'] = $this->db->get('surat');
                                echo $data['surat']->num_rows();; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fad fa-spinner fa-2x "> </i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SURAT DITERIMA -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 20px;">
                                DITERIMA</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $this->db->where('status_id', 2);
                                $data['surat'] = $this->db->get('surat');
                                echo $data['surat']->num_rows();; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas far fa-check-circle fa-2x "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SURAT DITOLAK -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 20px;">
                                DITOLAK</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $this->db->where('status_id', 3);
                                $data['surat'] = $this->db->get('surat');
                                echo $data['surat']->num_rows();; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-times-circle fa-2x "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Surat Masuk</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->