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

<body style="background-color: white">
  <div class="page-wrapper p-0 overflow-hidden">
    <header class="header">
      <nav class="navbar navbar-expand-lg py-0" style="background-color: #364d39; width: 100%;">
        <div class="container">
          <a class="navbar-brand me-0 py-0" href="#">
            <table style="padding-left: 0px" width="30%">
              <tr>
                <td width="5%" style="text-align: right;"><img src="<?php base_url() ?>assets/logo_app.jpg"
                    class="dark-logo rounded-circle" width="70" alt="" /></td>
                <td width="50%" style="text-align: left; line-height: 24px; padding-left: 2px" nowrap="">
                  <label style="font-weight: bold; color: white; font-size: 26px; padding-top: 10px"><label
                      style="color: #fdb73e; font-weight: bold;">Sini Self Studio</label></label><br>
                  <label style="color: #e8e5de;; font-size: 15px;">Booking Online</label>
                </td>
              </tr>
            </table>
          </a>
        </div>
      </nav>
    </header>
    </section>

    <?php
    function generateRandomString($length = 6)
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';

      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }

      return $randomString;
    }
    ?>
    <section class="py-md-5 mb-5">
      <div class="wrapper">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="card c2a-box" data-aos="fade-in" data-aos-delay="900" data-aos-duration="100">
              <div class="card-body" style="background-color: white;">
                <form class="mt-3 form-horizontal" action="" id="formSubmit" method="POST">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label class="fw-semibold" for="" style="float: left; font-size: 18px; padding-bottom: 8px;">Nama
                        <label for="" style="color:red">*</label></label>
                      <input type="hidden" name="kode_transaksi" value="<?php echo generateRandomString(8); ?>">
                      <input type="text" name="nama" style="height: 50px;" name="example-input-large"
                        class="form-control form-control-lg" placeholder="Nama" required>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label class="fw-semibold" for=""
                        style="float: left; font-size: 18px; padding-bottom: 8px;">Whatsapp <label for=""
                          style="color:red">*</label></label>
                      <input type="number" name="whatsapp" style="height: 50px;" name="example-input-large"
                        class="form-control form-control-lg" placeholder="Whatsapp" required>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label class="fw-semibold" for=""
                        style="float: left; font-size: 18px; padding-bottom: 8px;">Tanggal (Diperlukan) <label for=""
                          style="color:red">*</label></label>
                      <input type="date" style="height: 50px;" min="<?php echo date('Y-m-d') ?>" name="tanggal"
                        class="form-control form-control-lg tanggal" placeholder="Tanggal" required>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label class="fw-semibold" for="" style="float: left; font-size: 18px; padding-bottom: 8px;">Jam
                        <label for="" style="color:red">*</label></label>
                      <select class="form-control form-control-lg jam" style="height: 50px;" name="jam" disabled
                        required>
                        <option value="">Pilih Tanggal Terlebih Dahulu</option>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label class="fw-semibold" for="" style="float: left; font-size: 18px; padding-bottom: 8px;">Pilih
                        Paket</label>
                      <select class="form-control form-control-lg" style="height: 50px;" name="paket" required>
                        <option value="">Pilih Paket</option>
                        <?php
                        $paket = $this->db->get_where("m_paket", array('jenis' => 'paket'))->result_array();
                        foreach ($paket as $key => $data):
                          ?>
                          <option value="<?php echo $data['nm_paket'] . "|" . $data['id']; ?>">
                            <?php echo $data['nm_paket']; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label class="fw-semibold" for=""
                        style="float: left; font-size: 18px; padding-bottom: 8px;">Tambahan</label>
                      <br>
                      <br>
                      <table>
                        <?php
                        $add_on = $this->db->get_where("m_paket", array('jenis' => 'addon'))->result_array();
                        foreach ($add_on as $key => $data):
                          ?>
                          <tr>
                            <td nowrap="">
                              <input type="checkbox" name="addon[]" class="btn-check" id="btn-<?php echo $data['id']; ?>"
                                value="<?php echo $data['nm_paket'] . "|" . $data['id']; ?>" autocomplete="off">
                              <label class="btn btn-outline-primary btn-sm "
                                for="btn-<?php echo $data['id']; ?>">Pilih</label>
                            </td>
                            <td style="padding: 10px; text-align: left; font-weight: bold;">
                              <?php echo $data['nm_paket']; ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </table>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label class="fw-semibold" for=""
                        style="float: left; font-size: 18px; padding-bottom: 8px;">Tambahan Cetak</label>
                      <br>
                      <br>
                      <table>
                        <?php
                        $cetak = $this->db->get_where("m_paket", array('jenis' => 'cetak'))->result_array();
                        foreach ($cetak as $key => $data):
                          ?>
                          <tr>
                            <td nowrap="">
                              <input type="checkbox" class="btn-check" name="cetak[]"
                                value="<?php echo $data['nm_paket'] . "|" . $data['id']; ?>"
                                id="btn-<?php echo $data['id']; ?>" autocomplete="off">
                              <label class="btn btn-outline-primary btn-sm"
                                for="btn-<?php echo $data['id']; ?>">Pilih</label>
                            </td>
                            <td style="padding: 10px; text-align: left; font-weight: bold;">
                              <?php echo $data['nm_paket']; ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </table>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label class="fw-semibold" for=""
                        style="float: left; font-size: 15px; padding-bottom: 8px;">Diperbolehkan Post fotomu di akun
                        instagram kami?
                        *</label>
                      <br>
                      <br>
                      <div class="col-md-12">
                        <table>
                          <tr>
                            <td>
                              <div class="form-check form-check-inline" style="float: left;">
                                <input class="form-check-input success check-light-success" type="radio"
                                  name="upload_instagram" id="success-light-radio" value="ya" checked="">
                                <label class="form-check-label" for="success-light-radio">Ya</label>
                              </div>
                            </td>
                            <td>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input success check-light-success" type="radio"
                                  name="upload_instagram" id="success2-light-radio" value="tidak">
                                <label class="form-check-label" for="success2-light-radio">Tidak</label>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label class="fw-semibold" for=""
                        style="float: left; font-size: 18px; padding-bottom: 8px;">Metode Pembayaran</label>
                      <select class="form-control form-control-lg metode" style="height: 50px;" name="metode" required>
                        <option value="">Pilih Metode</option>
                        <option value="bayar_setelah_sesi">Bayar setelah sesi foto</option>
                        <option value="qris">Qris</option>
                      </select>
                    </div>
                  </div>
                  <!-- <div id="qris-image2">
                    <img src="<?php echo base_url(); ?>assets/qris.jpeg" alt="QRIS" class="img-fluid">
                  </div> -->
                  <br>
                  <br>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <button class="btn btn-lg btn-success w-100" type="submit"
                        style="background-color: #fdb73e; outline-border : #364d3e">Booking</button>
                    </div>
                  </div>
                  <br>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row" id="lightgallery">
          <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-4" data-src="<?php echo base_url('assets/Artboard 6.png'); ?>">
            <a href="<?php echo base_url('assets/Artboard 6.png'); ?>">
              <img src="<?php echo base_url('assets/Artboard 6.png'); ?>" class="img-fluid">
            </a>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-4" data-src="<?php echo base_url('assets/Artboard 7.png'); ?>">
            <a href="<?php echo base_url('assets/Artboard 7.png'); ?>">
              <img src="<?php echo base_url('assets/Artboard 7.png'); ?>" class="img-fluid">
            </a>
          </div>
          <!-- Tambahkan lebih banyak gambar sesuai kebutuhan -->
        </div>
      </div>

    </section>
  </div>
  <center><b>Sini Self Studo <?php echo date('Y') ?></b> <br> Kediri Jawa Timur</center>
  </div>
  </div>
  </div>
  </div>
  <script src="<?php echo base_url(); ?>dist/landing/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>dist/landing/aos.js"></script>
  <script src="<?php echo base_url(); ?>dist/landing/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>dist/landing/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>dist/landing/custom.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/lightgallery.js/dist/js/lightgallery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lg-thumbnail.js/dist/lg-thumbnail.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lg-fullscreen.js/dist/lg-fullscreen.min.js"></script>
  <script>
    $(document).ready(function () {
      // Inisialisasi LightGallery
      $("#lightgallery").lightGallery({
        selector: 'a'
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      $('.tanggal').on('change', function () {
        var selectedDate = $(this).val();
        if (selectedDate) {
          $.ajax({
            url: '<?php echo base_url('dashboard/getJam'); ?>',
            type: 'GET',
            data: { date: selectedDate },
            success: function (response) {
              $('.jam').html(response);
              $('.jam').removeAttr('disabled');
            }
          });
        } else {
          $('.jam').html('<option value="">Select a date first</option>');
        }
      })
    });

    $('#formSubmit').on('submit', function (e) {
      e.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
        url: '<?php echo base_url('dashboard/saveOrder'); ?>',
        type: 'POST',
        data: formData,
        dataType: "json",
        success: function (response) {
          if (response.status == 'success') {
            setTimeout(() => {
              window.location = "<?= base_url('transaksiDone'); ?>?kode_transaksi=" + response.kode_transaksi;
            }, 1500);
            Swal.fire({
              title: "Done!",
              text: "Selamat data anda berhasil disimpan.",
              icon: "success"
            });
          } else {
            setTimeout(() => {
              window.location = "<?= base_url(); ?>";
            }, 1500);

            Swal.fire({
              title: "Error!",
              text: "Server error",
              icon: "error"
            });
          }
        }
      });
    });
    $('#qris-image').hide();
    $('select[name="metode"]').on('change', function () {
      if ($(this).val() === 'qris') {
        $('#qris-image').show();
      } else {
        $('#qris-image').hide();
      }
    });
  </script>
</body>

</html>