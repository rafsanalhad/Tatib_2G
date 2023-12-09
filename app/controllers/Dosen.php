<?php

class Dosen extends Controller{
    public function __construct(){
        if($_SESSION['level'] != 2){
            header('location: '. BASEURL .'/login');
        }
    }
    public function index(){
        $data['biodata'] = $this->model('Dosen_model')->getDosenBySessionLogin($_SESSION['username']);
        $data['pengaduan'] = $this->model('Pengaduan_model')->getPengaduanByNip($_SESSION['username']);
        $this->view('templates/dosen/header');
        $this->view('dosen/index', $data);
        $this->view('templates/dosen/footer');
    }
    public function riwayatPengaduan(){
        $data['pengaduan'] = $this->model('Pengaduan_model')->getPengaduan();
        $this->view('templates/dosen/header');
        $this->view('dosen/riwayatPengaduan', $data);
        $this->view('templates/dosen/footer');
    }
    public function formPengaduan(){
        $data['mahasiswa'] = $this->model('Mahasiswa_model')->getAllMahasiswa();
        $data['pelanggaran'] = $this->model('Pelanggaran_model')->getAllPelanggaran();
        $data['prodi'] = $this->model('Prodi_model')->getAllProdi();
        $this->view('templates/dosen/header');
        $this->view('dosen/formPengaduan', $data);
        $this->view('templates/dosen/footer');
    }
    public function getMahasiswaByNim($nim){
        $data['mahasiswa'] = $this->model('Mahasiswa_model')->getMahasiswaByNim($nim);
        $data['prodi'] = $this->model('Prodi_model')->getAllProdi();
        echo json_encode($data['mahasiswa']);
    }
    public function ajukanPengaduan(){
        if ($this->model('Pengaduan_model')->setPengaduan($_POST) > 0) {
            Flasher::setFlash('Pengaduan berhasil', 'dilakukan', 'success');
            header('Location: ' . BASEURL . '/dosen/riwayatPengaduan');
            exit;
        }else{
            Flasher::setFlash('Pengaduan gagal', 'dilakukan', 'danger');
            header('Location: ' . BASEURL . '/dosen/formPengaduan');
            exit;
        }
    }
    public function ubahPassword(){
        $this->view('templates/dosen/header');
        $this->view('dosen/ubahPassword');
        $this->view('templates/dosen/footer');
    }
    public function ubahPw(){
        if ($_POST['newPass'] == $_POST['confPass']){
            if ($this->model('User_model')->updatePassword($_POST) > 0) {
                Flasher::setFlash('dosen berupa password berhasil', 'diubah', 'success');
                header('Location: ' . BASEURL . '/dosen/ubahPassword');
                exit;
            }else{
                Flasher::setFlash('password gagal', 'diubah', 'danger');
                header('Location: ' . BASEURL . '/dosen/ubahPassword');
                exit;
            }
        }else{
            Flasher::setFlash('Password dan Konfirmasi Pasword', 'tidak sesuai', 'danger');
            header('Location: ' . BASEURL . '/dosen/ubahPassword');
            exit;
        }
    }
}