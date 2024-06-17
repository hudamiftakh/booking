<?php $Auth = $this->session->userdata['username']; ?>
<style>
    table.dataTable thead>tr>th.sorting,
    table.dataTable thead>tr>th.sorting_asc,
    table.dataTable thead>tr>th.sorting_desc,
    table.dataTable thead>tr>th.sorting_asc_disabled,
    table.dataTable thead>tr>th.sorting_desc_disabled,
    table.dataTable thead>tr>td.sorting,
    table.dataTable thead>tr>td.sorting_asc,
    table.dataTable thead>tr>td.sorting_desc,
    table.dataTable thead>tr>td.sorting_asc_disabled,
    table.dataTable thead>tr>td.sorting_desc_disabled {
        cursor: pointer;
        position: relative;
        /* padding-right: 26px; */
        padding: 30px;
    }
</style>
<div class="card w-100 bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Report Keterisian Donasi Kecamatan</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="./">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                        <li class="breadcrumb-item" aria-current="page">Dashboard Donasi Kecamatan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <img src="<?php echo base_url(); ?>dist/images/backgrounds/welcome-bg.svg" alt=""
                        class="img-fluid mb-n4" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="collapsible-section mb-4">
    <div class="accordion accordion-flush position-relative overflow-hidden" id="accordionFlushExample">
        <div class="accordion-item mb-3 shadow-none border rounded-top">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed fs-4 fw-semibold px-3 py-6 lh-base border-0 rounded-top"
                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                    aria-controls="flush-collapseOne"> Filter Data</button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body px-3 fw-normal">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label fw-semibold col-sm-3 col-form-label text-end">Kecamatan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="kelas">
                                            <option value="semua">Semua</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label for="exampleInputPassword1"
                                        class="form-label fw-semibold col-sm-3 col-form-label text-end">Kelurahan</label>
                                    <div class="col-sm-9">
                                        <div class="input-group border rounded-1">
                                            <select class="form-control" name="status">
                                                <option value="semua">Semua</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label for="exampleInputPassword1"
                                        class="form-label fw-semibold col-sm-3 col-form-label text-end"></label>
                                    <div class="col-sm-9">
                                        <button class="btn btn-primary btn-lg" type="submit"
                                            name="filter">Filter</button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="card w-100 position-relative overflow-hidden">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>KECAMATAN</th>
                        <th>KELURAHAN</th>
                        <th>KK SEJAHTERA</th>
                        <th>TOTAL KK DONASI</th>
                        <th>TOTAL DONASI</th>
                        <th>PERSENTASE (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $q = $this->db->query("SELECT
                        bb.*,
                        ROUND( ( total_kk_donasi::INT * 100.0 / sejahtera_kk :: INT ), 2 ) AS persentase_sudah_survey 
                    FROM
                        (
                        SELECT ID
                            ,
                            kecamatan,
                            kelurahan,
                            sejahtera_kk,
                            SUM ( total_kk_donasi_wilayah :: INT + total_kk_donasi_wilayah_luar :: INT ) AS total_kk_donasi,
                            SUM ( total_zakat_donasi_wilayah :: INT + total_zakat_donasi_wilayah_luar :: INT ) AS total_zakat_donasi 
                        FROM
                            dash_kampung_madani
                        WHERE rw is null
                        GROUP BY
                            ID,
                            kecamatan,
                            kelurahan,
                            sejahtera_kk,
                            total_kk_donasi_wilayah,
                            total_kk_donasi_wilayah_luar 
                        ORDER BY
                            ID 
                        ) bb
                    WHERE bb.kelurahan is not null;  
                    "
                    )->result_array();
                    foreach ($q as $key => $value) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $value['kecamatan']; ?></td>
                            <td><?php echo $value['kelurahan']; ?></td>
                            <td><?php echo $value['sejahtera_kk']; ?></td>
                            <td><?php echo $value['total_kk_donasi']; ?></td>
                            <td><?php echo number_format($value['total_zakat_donasi']); ?></td>
                            <td><?php echo $value['persentase_sudah_survey']; ?> %</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>