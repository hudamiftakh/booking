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
<style>
    .table-custom tr {
        line-height: 1;
        /* Atur line-height agar lebih rapat */
    }

    .table-custom td,
    .table-custom th {
        padding: 8px;
        /* Kurangi padding agar lebih rapat */
    }

    .badge-sm {
        font-size: 0.75em;
        padding: 0.25em 0.4em;
    }
</style>
<!-- <div class="card w-100 bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">List Booking</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="./">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                        <li class="breadcrumb-item" aria-current="page">Dashboard Booking</li>
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
</div> -->
<?php

function ribuan_ke_k($number)
{
    if ($number >= 1000) {
        $formatted = number_format($number / 1000, 0, '', '.') . 'K';
        return $formatted;
    } else {
        return number_format($number);
    }
}
?>
<?php $total_sd_ini = $this->db->get('m_booking'); ?>
<?php $total_total_sd_ini = $this->db->select('sum(total) as total')->get_where('m_booking')->row_array(); ?>
<style>
    .fs-7 {
        font-weight: bold;
    }
</style>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card border-bottom border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="fs-7"><?php echo $total_sd_ini->num_rows(); ?></h2>
                        <h6 class="fw-medium text-info mb-0">Pesanan Sampai Dengan Hari Ini</h6>
                    </div>
                    <div class="ms-auto">
                        <span class="text-info display-6"><i class="ti ti-calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card border-bottom border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="fs-7"><?php echo ribuan_ke_k($total_total_sd_ini['total']); ?></h2>
                        <h6 class="fw-medium text-info mb-0">Pendapatan Sampai Dengan Hari Ini</h6>
                    </div>
                    <div class="ms-auto">
                        <span class="text-info display-6"><i class="ti ti-calendar-dollar"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $total_hari_ini = $this->db->get_where('m_booking', array('tanggal' => date('Y-m-d'))); ?>
    <?php $total_total_hari_ini = $this->db->select('sum(total) as total')->get_where('m_booking', array('tanggal' => date('Y-m-d')))->row_array(); ?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card border-bottom border-danger">
            <div class="card-body">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h2 class="fs-7">
                            <?php echo $total_hari_ini->num_rows(); ?>
                        </h2>
                        <h6 class="fw-medium text-danger mb-0">Pesanan Hari ini <div><br></div>
                        </h6>
                    </div>
                    <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-calendar-check"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card border-bottom border-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="fs-7">
                            <?php echo ribuan_ke_k($total_total_hari_ini['total']); ?>
                        </h2>
                        <h6 class="fw-medium text-danger mb-0">Total Pendapatan Hari Ini
                            <div><br></div>
                        </h6>
                    </div>
                    <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-calendar-dollar"></i></span>
                    </div>
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
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body px-3 fw-normal">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label fw-semibold col-sm-3 col-form-label text-end">Mulai</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="mulai" value="<?php echo $_REQUEST['mulai']; ?>"
                                            class="form-control form-input-lg">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label
                                        class="form-label fw-semibold col-sm-3 col-form-label text-end">Sampai</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="sampai" value="<?php echo $_REQUEST['sampai']; ?>"
                                            class="form-control form-input-lg">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label fw-semibold col-sm-3 col-form-label text-end">Kode
                                        Booking</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="kode_transaksi" class="form-control form-input-lg">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label for="exampleInputPassword1"
                                        class="form-label fw-semibold col-sm-3 col-form-label text-end"></label>
                                    <div class="col-sm-9">
                                        <button class="btn btn-primary" type="submit"
                                            name="filter">Filter</button>
                                        <a href="<?php echo base_url('dashboard/booking'); ?>" class="btn btn-danger">Reset</a>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card w-100 position-relative overflow-hidden">
    <div class="card-body p-4">
        <div><?php echo $pagination; ?></div>
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead style="background-color: grey; color : white;">
                    <tr>
                        <th width="1px">#</th>
                        <th width="1px" nowrap>Kode-Payment</th>
                        <th width="1px" nowrap>Tanggal-Jam</th>
                        <th>Nama</th>
                        <th width="300px" nowrap>Order</th>
                        <th>Status</th>
                        <th width="1px" nowrap>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($result)) {
                        echo "<tr><td colspan='7'><center>Data booking kosong</center></td></tr>";
                        // exit;
                    }
                    $nomor = $start + 1;
                    foreach ($result as $key => $vData) {
                        ?>
                        <tr style="line-height: 1;">
                            <td><?php echo $nomor++; ?></td>
                            <td><b><?php echo $vData['kode_transaksi']; ?></b>
                                <br>
                                <?php if ($vData['metode'] == 'qris'): ?>
                                    <span class="badge bg-danger badge-sm">QRIS</span>
                                <?php else: ?>
                                    <span class="badge bg-warning badge-sm">Setelah sesi</span>
                                <?php endif; ?>
                            </td>
                            <td nowrap>
                                <?php
                                // Array nama hari dalam bahasa Indonesia
                                $nama_hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

                                // Tanggal dari database
                                $tanggal_database = $vData['tanggal'];

                                // Konversi tanggal ke format waktu dan format ke dalam format Indonesia
                                $tanggal_waktu = strtotime($tanggal_database);
                                $tanggal_indonesia = date('d F Y', $tanggal_waktu);

                                // Ambil nama hari berdasarkan indeks hari dalam format waktu
                                $nama_hari_indonesia = $nama_hari[date('w', $tanggal_waktu)];
                                ?>
                                <b><?php echo $nama_hari_indonesia . ", " . $tanggal_indonesia; ?></b>
                                <br>
                                <b style="padding-top: 100px; !important">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $vData['jam']; ?>
                                </b>

                            </td>
                            <td nowrap>
                                <b><?php echo $vData['nama']; ?></b><br>
                                <i class="fa fa-whatsapp" style="color: green; padding-top : 9px"></i>
                                <?php echo $vData['hp']; ?>
                            </td>
                            <td nowrap style="line-height: 16px;">
                                <ul style="font-size: 12px; font-family: arial;">
                                    <?php $no = 1;
                                    $paket = explode('|', $vData['paket']);
                                    echo "<li>" . $no++ . ". " . $paket[0] . "</li>";
                                    foreach (explode('#', $vData['addon']) as $key => $value):
                                        $addon = explode('|', $value);
                                        if (!empty($addon[0 ])):
                                            echo "<li>" . $no++ . "." . $addon[0] . "</li>";
                                        endif;
                                    endforeach;
                                    foreach (explode('#', $vData['cetak']) as $key => $value):
                                        $cetak = explode('|', $value);
                                        if (!empty($cetak[0])):
                                        echo "<li>" . $no++ . ". Cetak " . $cetak[0] . "</li>";
                                        endif; 
                                    endforeach;
                                    ?>
                                </ul>
                                <u>Total Rp. <?php echo number_format($vData['total']); ?></u>
                            </td>
                            <td><span
                                    class="<?php echo ($vData['status'] == 'baru') ? 'badge bg-warning' : 'badge bg-success'; ?>"><small><?php echo ucfirst($vData['status']); ?></small></span>
                            </td>
                            <td nowrap>
                                <form action="" method="POST">
                                    <input type="hidden" name="kode_transaksi"
                                        value="<?php echo $vData['kode_transaksi']; ?>">
                                    <button onclick="return confirm('Apakah anda yakin ?');" class="btn btn-success btn-sm"
                                        name="selesai" title="selesai"><i class="fa fa-check"></i></button>
                                    <button onclick="return confirm('Apakah anda yakin ?');" class="btn btn-danger btn-sm"
                                        name="hapus" title="Batalkan / Hapus"><i class="fa fa-refresh"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php echo $pagination; ?>
    </div>
</div>