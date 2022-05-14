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
                                echo $data['surat']->num_rows();;
                                ?>
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


        <!--  STATISTIK TOTAL MASUK HARI INI  -->

        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total Surat Masuk </h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="stat"></canvas>
                    </div>
                    <script src="<?php echo base_url('assets/'); ?>vendor/chart.js/Chart.js"></script>
                    <script>
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#858796';

                        function number_format(number, decimals, dec_point, thousands_sep) {
                            // *     example: number_format(1234.56, 2, ',', ' ');
                            // *     return: '1 234,56'
                            number = (number + '').replace(',', '').replace(' ', '');
                            var n = !isFinite(+number) ? 0 : +number,
                                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                                s = '',
                                toFixedFix = function(n, prec) {
                                    var k = Math.pow(10, prec);
                                    return '' + Math.round(n * k) / k;
                                };
                            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                            if (s[0].length > 3) {
                                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                            }
                            if ((s[1] || '').length < prec) {
                                s[1] = s[1] || '';
                                s[1] += new Array(prec - s[1].length + 1).join('0');
                            }
                            return s.join(dec);
                        }


                        // STAT SURAT MASUK
                        var Jan = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 1, 31, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 1, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var Feb = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 2, 31, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 2, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var Mar = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 3, 31, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 3, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var Apr = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 4, 30, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 4, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var May = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 5, 31, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 5, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var Jun = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 6, 30, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 6, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var Jul = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 7, 31, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 7, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var Aug = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 8, 30, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 8, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var Sep = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 9, 30, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 9, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var Okt = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 10, 31, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 10, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var Nov = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 11, 30, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 11, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var Des = <?php
                                    $this->db->where('date_created <=', mktime(23, 59, 59, 12, 31, 2022));
                                    $this->db->where('date_created >=', mktime(0, 0, 0, 12, 1, 2022));
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;

                        var ctx = document.getElementById("stat");
                        var myLineChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                datasets: [{
                                    label: "Surat Masuk",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                    borderColor: "rgba(78, 115, 223, 1)",
                                    pointRadius: 3,
                                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHoverRadius: 3,
                                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    data: [Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Okt, Nov, Des],
                                }],
                            },
                            options: {
                                maintainAspectRatio: false,
                                layout: {
                                    padding: {
                                        left: 10,
                                        right: 25,
                                        top: 25,
                                        bottom: 0
                                    }
                                },
                                scales: {
                                    xAxes: [{
                                        time: {
                                            unit: 'date'
                                        },
                                        gridLines: {
                                            display: false,
                                            drawBorder: false
                                        },
                                        ticks: {
                                            maxTicksLimit: 7
                                        }
                                    }],
                                    yAxes: [{
                                        ticks: {
                                            maxTicksLimit: 5,
                                            padding: 10,
                                            // Include a dollar sign in the ticks
                                            callback: function(value, index, values) {
                                                return number_format(value);
                                            }
                                        },
                                        gridLines: {
                                            color: "rgb(234, 236, 244)",
                                            zeroLineColor: "rgb(234, 236, 244)",
                                            drawBorder: false,
                                            borderDash: [2],
                                            zeroLineBorderDash: [2]
                                        }
                                    }],
                                },
                                legend: {
                                    display: false
                                },
                                tooltips: {
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    titleMarginBottom: 10,
                                    titleFontColor: '#6e707e',
                                    titleFontSize: 14,
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    intersect: false,
                                    mode: 'index',
                                    caretPadding: 10,
                                    callbacks: {
                                        label: function(tooltipItem, chart) {
                                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                        }
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>

        <!-- STATISTI BAR CHART SURAT MASUK HARI INI -->

        <div class="col-xl-6 col-lg-6">
            <!-- Bar Chart -->
            <div class="card shadow mb-4 flex-column">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Surat Masuk Hari Ini</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <script src="<?php echo base_url('assets/'); ?>vendor/chart.js/Chart.js"></script>
                    <script>
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#858796';
                        Chart.defaults.global.datasets.bar.categoryPercentage = 0.95;

                        function number_format(number, decimals, dec_point, thousands_sep) {
                            // *     example: number_format(1234.56, 2, ',', ' ');
                            // *     return: '1 234,56'
                            number = (number + '').replace(',', '').replace(' ', '');
                            var n = !isFinite(+number) ? 0 : +number,
                                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                                s = '',
                                toFixedFix = function(n, prec) {
                                    var k = Math.pow(10, prec);
                                    return '' + Math.round(n * k) / k;
                                };
                            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                            if (s[0].length > 3) {
                                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                            }
                            if ((s[1] || '').length < prec) {
                                s[1] = s[1] || '';
                                s[1] += new Array(prec - s[1].length + 1).join('0');
                            }
                            return s.join(dec);
                        }

                        var SI = <?php
                                    $this->db->where('date_created >=', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
                                    $this->db->where('date_created <=', mktime(23, 59, 29, date('m'), date('d'), date('Y')));
                                    $this->db->where('jenis_id =', 1);
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var SD = <?php
                                    $this->db->where('date_created >=', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
                                    $this->db->where('date_created <=', mktime(23, 59, 29, date('m'), date('d'), date('Y')));
                                    $this->db->where('jenis_id =', 2);
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        var SS = <?php
                                    $this->db->where('date_created >=', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
                                    $this->db->where('date_created <=', mktime(23, 59, 29, date('m'), date('d'), date('Y')));
                                    $this->db->where('jenis_id =', 3);
                                    $data['surat'] = $this->db->get('surat');
                                    echo $data['surat']->num_rows();; ?>;
                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChart");
                        var myBarChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ["Surat Izin", "Surat Dispen", "Surat Sakit"],
                                datasets: [{
                                    maxBarThickness: 45,
                                    label: "Surat Masuk",
                                    backgroundColor: "#4e73df",
                                    hoverBackgroundColor: "#2e59d9",
                                    borderColor: "#4e73df",
                                    data: [SI, SD, SS],
                                }],
                            },
                            options: {
                                maintainAspectRatio: false,
                                layout: {
                                    padding: {
                                        left: 10,
                                        right: 25,
                                        top: 25,
                                        bottom: 0
                                    }
                                },
                                scales: {
                                    xAxes: [{
                                        time: {
                                            unit: 'surat'
                                        },
                                        gridLines: {
                                            display: false,
                                            drawBorder: false
                                        },
                                        ticks: {
                                            maxTicksLimit: 5
                                        },

                                    }],
                                    yAxes: [{
                                        ticks: {
                                            min: 0,
                                            maxTicksLimit: 5,
                                            padding: 10,
                                            // Include a dollar sign in the ticks
                                            callback: function(value, index, values) {
                                                return number_format(value);
                                            }
                                        },
                                        gridLines: {
                                            color: "rgb(234, 236, 244)",
                                            zeroLineColor: "rgb(234, 236, 244)",
                                            drawBorder: false,
                                            borderDash: [2],
                                            zeroLineBorderDash: [2]
                                        }
                                    }],
                                },
                                legend: {
                                    display: false
                                },
                                tooltips: {
                                    titleMarginBottom: 10,
                                    titleFontColor: '#6e707e',
                                    titleFontSize: 14,
                                    backgroundColor: "rgb(255,255,255)",
                                    bodyFontColor: "#858796",
                                    borderColor: '#dddfeb',
                                    borderWidth: 1,
                                    xPadding: 15,
                                    yPadding: 15,
                                    displayColors: false,
                                    caretPadding: 10,
                                    callbacks: {
                                        label: function(tooltipItem, chart) {
                                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                        }
                                    }
                                },
                            }
                        });
                    </script>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->