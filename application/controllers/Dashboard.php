<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard extends CI_Controller
{
    public function __construct()
    {
        error_reporting(0);
        parent::__construct();
        $this->load->library('session');
        // $this->load->model('M_Datatables');
    }

    public function index()
    {
        if (!empty($this->session->userdata['username'])) {
            $this->dashboard();
        } else {
            redirect('./login');
        }
    }
    public function dashboard()
    {
        $this->checkSession();
        $data['halaman'] = 'dashboard/index';
        $this->load->view('modul', $data);
    }
    public function booking()
    {
        $this->checkSession();
        if (isset($_REQUEST['selesai'])) {
            $result = $this->db->where(array('kode_transaksi' => $_REQUEST['kode_transaksi']))->update("m_booking", array('status' => 'selesai'));
            if ($result) {
                $this->alert('Data Berhasil diupdate');
            } else {
                $this->alert('Data Gagal diupdate');
            }
            redirect('dashboard/booking', 'refresh');
        }
        if (isset($_REQUEST['hapus'])) {
            $result = $this->db->where(array('kode_transaksi' => $_REQUEST['kode_transaksi']))->delete("m_booking");
            if ($result) {
                $this->alert('Data Berhasil Dihapus');
            } else {
                $this->alert('Data Gagal Dihapus');
            }
            redirect('dashboard/booking', 'refresh');
        }

        if (isset($_REQUEST['filter'])) {
            if (!empty($_REQUEST['mulai']) and !empty($_REQUEST['sampai'])) {
                $filter_tanggal = "(tanggal>='" . $_REQUEST['mulai'] . "' AND tanggal<='" . $_REQUEST['sampai'] . "') OR";
            }
            $total = $this->db->query("SELECT * FROM m_booking WHERE $filter_tanggal kode_transaksi='" . $_REQUEST['kode_transaksi'] . "'")->num_rows();
        } else {
            $total = $this->db->count_all('m_booking');
        }

        // Konfigurasi Pagination
        $config['base_url'] = base_url('dashboard/booking');
        $config['total_rows'] = $total; // Menghitung total baris di tabel m_booking
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;

        // Bootstrap 3 Pagination Styling
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // Fetch data from database with limit and offset
        $this->db->limit($config['per_page'], $page);
        if (isset($_REQUEST['filter'])) {
            if (!empty($_REQUEST['mulai']) and !empty($_REQUEST['sampai'])) {
                $filter_tanggal = "(tanggal>='" . $_REQUEST['mulai'] . "' AND tanggal<='" . $_REQUEST['sampai'] . "') OR";
            }
            $data['result'] = $this->db->query("SELECT * FROM m_booking WHERE $filter_tanggal kode_transaksi='" . $_REQUEST['kode_transaksi'] . "'")->result_array();
        } else {
            $data['result'] = $this->db->get('m_booking')->result_array();
        }

        $data['pagination'] = $this->pagination->create_links();
        $data['halaman'] = 'dashboard/booking';
        $data['start'] = $page;

        // Load view
        $this->load->view('modul', $data);
    }
    public function report_donasi()
    {
        $this->checkSession();
        $data['halaman'] = 'dashboard/report_donasi';
        $this->load->view('modul', $data);
    }
    public function transaksiDone()
    {
        $this->load->view('transaksi_done');
    }
    public function getJam()
    {
        if (isset($_GET['date'])) {
            // Ambil tanggal dari request
            $selectedDate = $_GET['date'];
            // Awal waktu
            $start = strtotime('08:00');
            // Akhir waktu
            $end = strtotime('20:30');
            $options = '';
            while ($start <= $end) {
                $time = date('H:i', $start);
                $chek_booking = $this->db->get_where('m_booking', array('jam' => $time, 'tanggal' => $_GET['date']))->num_rows();
                if ($chek_booking >= 1) {
                    $options .= "<option value=\"$time\" disabled>$time Booked</option>";
                } else {
                    $options .= "<option value=\"$time\">$time</option>";
                }
                // Tambah 30 menit
                $start = strtotime('+30 minutes', $start);
            }
            echo $options;
        } else {
            echo '<option value="">Invalid date</option>';
        }
    }

    public function saveOrder()
    {
        $addon = "";
        foreach ($_REQUEST['addon'] as $key => $value) {
            $addon .= $value . "#";
        }
        $cetak = "";
        foreach ($_REQUEST['cetak'] as $key => $value) {
            $cetak .= $value . "#";
        }
        $kode_transaksi = $_REQUEST['kode_transaksi'];
        $nama = $_REQUEST['nama'];
        $whatsapp = $_REQUEST['whatsapp'];
        $tanggal = $_REQUEST['tanggal'];
        $jam = $_REQUEST['jam'];
        $paket = $_REQUEST['paket'];
        $add_on = rtrim($addon, '#');
        $cetak = rtrim($cetak, '#');
        $upload_instagram = $_REQUEST['upload_instagram'];
        $metode = $_REQUEST['metode'];
        $data = array(
            'kode_transaksi' => $kode_transaksi,
            'nama' => $nama,
            'hp' => $whatsapp,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'paket' => $paket,
            'addon' => $add_on,
            'cetak' => $cetak,
            'instagram' => $upload_instagram,
            'metode' => $metode,
            'status' => 'baru'
        );
        $result = $this->db->insert('m_booking', $data);
        if ($result) {
            echo json_encode(array('status' => 'success', 'msg' => 'Berhasil Disimpan', 'kode_transaksi' => $kode_transaksi));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'Gagal save'));
        }
    }
    public function alert($text)
    {
        echo "<script>alert('" . $text . "')</script>";
    }
    public function logout()
    {
        $this->checkSession();
        session_destroy();
        redirect('/login');
    }

    public function checkSession()
    {
        if (empty($this->session->userdata['username'])) {
            redirect('./');
        }
    }
}