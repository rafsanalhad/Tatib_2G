<?php

class Admin extends Controller{
    public function __construct(){
        if($_SESSION['level'] != 1){
            header('location: '. BASEURL .'/login');
        }
    }
    public function index(){
        $data['judul'] = 'Admin Page';
        $data['dosen'] = $this->model('Admin_model')->hitungDosen();  
        $data['mahasiswa'] = $this->model('Admin_model')->hitungMahasiswa();
        $data['pelanggaran'] = $this->model('Admin_model')->hitungPelanggaran();
        $data['prodi'] = $this->model('Admin_model')->hitungProdi();
        $data['laporanTerbaru'] = $this->model('Admin_model')->laporanTerbaru();
        
        $this->view('templates/admin/header');
        $this->view('admin/index', $data);
        $this->view('templates/admin/footer');
    }
    public function dosen(){
        $data['judul'] = 'Admin Page';
        $data['dosen'] = $this->model('Admin_model')->getDosen();
        $this->view('templates/admin/header');
        $this->view('admin/dosen', $data);
        $this->view('templates/admin/footer');
    }
    public function tambahDosen(){
        if ($this->model('Dosen_model')->tambahDataDosen($_POST) > 0) {
            // Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            // header('Location: ' . BASEURL . '/admin/dosen');
            // echo "dosen berhasil ditambah";
            // exit;
            echo "berhasil";
        }else{
            // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            // header('Location: ' . BASEURL . '/admin/dosen');
            // echo "dosen gagal ditambah";
            // exit;
            echo "gagal karena nip sudah ada";
        }
    }
    public function getDosenByNip($nip){
        $data['dosen'] = $this->model('Dosen_model')->getDosenByNip($nip);
        echo json_encode($data['dosen']);
    }
    public function editDosen(){
        if ($this->model('Dosen_model')->editDataDosen($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/admin/dosen');
            exit;
        }else{
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/admin/dosen');
            exit;
        }
    }
    public function hapusDosen($nip, $userId){
        if ($this->model('Dosen_model')->hapusDataDosen($nip) > 0) {
            if($this->model('User_model')->hapusDataUser($userId)>0){
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/admin/dosen');
            exit;
            }
        }else{
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/admin/dosen');
            exit;
        }
    }

    public function mahasiswa(){
        $data['judul'] = 'Admin Page';
        $data['prodi'] = $this->model('Prodi_model')->getAllProdi();
        $data['mahasiswa'] = $this->model('Admin_model')->getMahasiswa();
        $this->view('templates/admin/header', $data);
        $this->view('admin/mahasiswa', $data);
        $this->view('templates/admin/footer');
    }
    public function tambahMahasiswa(){
        if ($this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0) {
            echo "berhasil";
        }else{
            // Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            // header('Location: ' . BASEURL . '/admin/mahasiswa');
            echo "gagal karena nim sudah ada";
            exit;
        }
    }

    public function getMahasiswaByNim($nim){
        $data['mahasiswa'] = $this->model('Mahasiswa_model')->getMahasiswaByNim($nim);
        echo json_encode($data['mahasiswa']);
    }

    public function editMahasiswa(){
        if ($this->model('Mahasiswa_model')->editDataMahasiswa($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/admin/mahasiswa');
            exit;
        }else{
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/admin/mahasiswa');
            exit;
        }
    }
    public function hapusMahasiswa($id, $userID){
        if ($this->model('Mahasiswa_model')->hapusDataMahasiswa($id) > 0) {
            if($this->model('User_model')->hapusDataUser($userID) > 0){
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/mahasiswa');
            exit;
            }
        }else{
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/admin/mahasiswa');
            exit;
        }
    }
    public function laporanPelanggaran(){
        $data['judul'] = 'Admin Page';
        $data['Pelanggaran'] = $this->model('Admin_model')->getLaporanPelanggaran();
        $this->view('templates/admin/header', $data);
        $this->view('admin/laporanPelanggaran', $data);
        $this->view('templates/admin/footer');
    }
    public function getLaporanPelanggaranById($id){
        $data['Pelanggaran'] = $this->model('Admin_model')->getLaporanPelanggaranById($id);
        echo json_encode($data['Pelanggaran']);
    }
    public function getLaporanKompenById($id){
        $data['Kompen'] = $this->model('Admin_model')->getLaporanKompenById($id);
        echo json_encode($data['Kompen']);
    }
    public function hasilLaporanPelanggaran($param){
        if ($this->model('Admin_model')->hasilLaporanPelanggaran($param, $_POST) > 0) {
            echo json_encode('berhasil memvalidasi');
        }else{
           echo json_encode('gagal memvalidasi');
        }
    }
    public function hasilLaporanKompen($param){
        if ($this->model('Admin_model')->hasilLaporanKompen($param, $_POST) > 0) {
            echo json_encode('berhasil memvalidasi');
        }else{
           echo json_encode('gagal memvalidasi');
        }
    }
    public function laporanKompen(){
        $data['judul'] = 'Admin Page';
        $data['laporanKompen'] = $this->model('Admin_model')->getLaporanKompen();
        $this->view('templates/admin/header', $data);
        $this->view('admin/laporanKompen', $data);
        $this->view('templates/admin/footer');
    }
    public function logout(){
        $this->view('templates/admin/header');
        $this->view('admin/logout');
        $this->view('templates/admin/footer');
    }
    public function ubahPassword(){
        $this->view('templates/admin/header');
        $this->view('admin/ubahPassword');
        $this->view('templates/admin/footer');
    }
    public function ubahPwAksi(){
        if ($_POST['newPass'] == $_POST['confPass']){
            if ($this->model('Admin_model')->updatePassword($_POST) > 0) {
                Flasher::setFlash('diubah', 'ubah password berhasil', 'success');
                header('Location: ' . BASEURL . '/admin/ubahPassword');
                exit;
            }else{
                Flasher::setFlash('diubah', 'password gagal', 'danger');
                header('Location: ' . BASEURL . '/admin/ubahPassword');
                exit;
            }
        }else{
            Flasher::setFlash('Password dan Konfirmasi Pasword', 'tidak sesuai', 'danger');
            header('Location: ' . BASEURL . '/dosen/ubahPassword');
            exit;
        }
    }
}