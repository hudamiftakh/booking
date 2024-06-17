<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  Title -->
    <title>Studio Foto</title>
    <!--  Favicon -->
    <!-- <link rel="shortcut icon" type="image/png" href="../landing/dist/images/logos/favicon.ico"> -->
    <link rel="shortcut icon" type="image/png" href="<?php base_url() ?>assets/logo_min.png" />
    <!--  Aos -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/landing/aos.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/style.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/landing/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/landing/style.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function pengembangan() {
            Swal.fire({
                title: 'Maaf',
                text: 'Fitur dalam proses pengembangan !!!',
                icon: 'error',
                timer: 4000,
                showCancelButton: false,
                showConfirmButton: true
            }).then(function () {
                // $('#autofocus').focus();
            });
        }
    </script>
</head>

<body style="background-color: white;">
    <div class="page-wrapper p-0 overflow-hidden">
        <header class="header">
            <nav class="navbar navbar-expand-lg py-0" style="background-color: #364d39; width: 100%;">
                <div class="container">
                    <a class="navbar-brand me-0 py-0" href="<?php echo base_url() ?>">
                        <table style="padding-left: 0px" width="30%">
                            <tr>
                                <td width="5%" style="text-align: right;"><img
                                        src="<?php base_url() ?>assets/logo_app.jpg" class="dark-logo rounded-circle"
                                        width="70" alt="" /></td>
                                <td width="50%" style="text-align: left; line-height: 24px; padding-left: 2px"
                                    nowrap="">
                                    <label
                                        style="font-weight: bold; color: white; font-size: 26px; padding-top: 10px"><label
                                            style="color: #fdb73e; font-weight: bold;">Sini Self
                                            Studio</label></label><br>
                                    <label style="color: white; font-size: 15px;">Booking Online</label>
                                </td>
                            </tr>
                        </table>
                    </a>
                </div>
            </nav>
        </header>
        </section>
        <?php
        $showDataResult = $this->db->get_where('m_booking', array('kode_transaksi' => $_REQUEST['kode_transaksi']));
        $showData = $showDataResult->row_array();
        ?>
        <?php if($showDataResult->num_rows()<=0) : ?>
            <div class="p-2">
                <div class="alert alert-danger">
                    <label for="" style="font-weight: bold;">Mohon maaf !!</label> <br>
                    <label for="">Kode booking tidak ditemukan, pastikan kode booking anda benar</label>
                </div>
            </div>
        <?php exit; endif; ?>
        <section class="py-md-5 mb-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <br>
                        <br>
                        <center>
                            <img src="<?php echo base_url(); ?>assets/icons8-check-150.svg"
                                style="width : 100px; height: 100px;" alt="">
                            <h3>Booking Berhasil</h3>
                        </center>
                        <br>
                        <table class="table table-bordered">
                            <tr>
                                <td width="1px" nowrap="">Kode Booking</td>
                                <td>: <?php echo $showData['kode_transaksi']; ?></td>
                            </tr>
                            <tr>
                                <td width="1px" nowrap="">Nama</td>
                                <td>: <?php echo $showData['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>Whatsapp</td>
                                <td>: <?php echo $showData['hp']; ?></td>
                            </tr>
                            <tr>
                                <td nowrap>Tanggal / Jam</td>
                                <td>: <?php echo $showData['tanggal']; ?> Jam <?php echo $showData['jam']; ?></td>
                            </tr>
                            <tr>
                                <td>Pembayaran</td>
                                <td>:<?php echo $showData['metode']; ?> <?php if ($showData['metode'] == 'qris'): ?>
                                        <button onclick="showQris()" class="btn btn-sm btn-danger">Show Qris</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Jenis</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                        </tr>
                                        <?php
                                        $total_harga = 0; // Variabel untuk menampung total harga
                                        
                                        // Paket
                                        $paket = explode('|', $showData['paket']);
                                        $harga_paket = $this->db->get_where('m_paket', array('id' => $paket[1]))->row_array();
                                        $total_harga += $harga_paket['harga']; // Tambahkan harga paket ke total
                                        ?>
                                        <tr>
                                            <td>Paket</td>
                                            <td><?php echo $harga_paket['nm_paket']; ?></td>
                                            <td><?php echo number_format($harga_paket['harga']); ?></td>
                                        </tr>
                                        <?php

                                        // Addons
                                        foreach (explode('#', $showData['addon']) as $key => $value):
                                            $addon = explode('|', $value);
                                            $harga_addon = $this->db->get_where('m_paket', array('id' => $addon[1]))->row_array();
                                            $total_harga += $harga_addon['harga']; // Tambahkan harga addon ke total
                                            ?>
                                            <tr>
                                                <td>AddOn</td>
                                                <td><?php echo $harga_addon['nm_paket']; ?></td>
                                                <td><?php echo number_format($harga_addon['harga']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                        <!-- Jika ada paket tambahan untuk cetak -->
                                        <?php
                                        foreach (explode('#', $showData['paket']) as $key => $value):
                                            $paket = explode('|', $value);
                                            $harga_paket = $this->db->get_where('m_paket', array('id' => $paket[1]))->row_array();
                                            $total_harga += $harga_paket['harga']; // Tambahkan harga cetak ke total
                                            ?>
                                            <tr>
                                                <td>Cetak</td>
                                                <td><?php echo $harga_paket['nm_paket']; ?></td>
                                                <td><?php echo number_format($harga_paket['harga']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                        <!-- Tampilkan total harga -->
                                        <tr>
                                            <th colspan="2">Total</th>
                                            <th>
                                                <?php 
                                                echo number_format($total_harga); 
                                                $kode_transaksi = $_REQUEST['kode_transaksi'];
                                                $this->db->where(array('kode_transaksi'=>$kode_transaksi))->update('m_booking', array('total'=>$total_harga));
                                                // echo $this->db->last_query();
                                            ?></th>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrisModalLabel">QRIS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <center><img src="<?php echo base_url(); ?>assets/qris.jpeg" alt="QRIS" class="img-fluid"> <br>
                    <a href="<?php echo base_url(); ?>assets/qris.jpeg" download="<?php echo base_url(); ?>assets/qris.jpeg">Download Qris</a>
                </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>dist/landing/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>dist/landing/aos.js"></script>
    <script src="<?php echo base_url(); ?>dist/landing/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>dist/landing/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>dist/landing/custom.js"></script>
    <script>
        function showQris() {
            $('#qrisModal').modal('show');
        }
    </script>
</body>

</html>