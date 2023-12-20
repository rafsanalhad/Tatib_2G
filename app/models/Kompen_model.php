<?php

class Kompen_model
{
    private $table1 = 'dosen';
    private $table2 = 'mahasiswa';
    private $table3 = 'pengaduan';
    private $table4 = 'pelanggaran';
    private $table5 = 'prodi';
    private $table6 = 'riwayat';
    private $table7 = 'sanksi_pelanggaran';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getKompenByNim($nim)
    {
        $this->db->query('SELECT * FROM ' . $this->table6 . ' a INNER JOIN ' . $this->table2 . ' b ON a.nim = b.nim INNER JOIN 
                        ' . $this->table3 . ' c ON a.pengaduan_id = c.pengaduan_id INNER JOIN ' . $this->table4 . ' d 
                        ON c.pelanggaran_id = d.pelanggaran_id INNER JOIN ' . $this->table7 . ' e ON d.sanksi_id = e.sanksi_id WHERE a.nim = :nim');
        $this->db->bind('nim', $nim);
        return $this->db->resultSet();
    }
    public function getKompenById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table6 . ' a INNER JOIN ' . $this->table2 . ' b ON a.nim = b.nim INNER JOIN 
                        ' . $this->table3 . ' c ON a.pengaduan_id = c.pengaduan_id INNER JOIN ' . $this->table4 . ' d 
                        ON c.pelanggaran_id = d.pelanggaran_id WHERE a.riwayat_id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function updateKompen($data)
    {
        $aksi = $data['aksi'];
        $status = '';
        if($aksi == 'kerjakan'){
            $status = 'sedang dikerjakan';
        }elseif ($aksi == 'upload') {
            $status = 'proses';
        }elseif ($aksi == 'ditolak') {
            $status = 'ditolak';
        }elseif ($aksi == 'selesai') {
            $status = 'selesai';
        }
        if (isset($_FILES['buktiKompen'])) {
            $this->db->query('UPDATE ' . $this->table6 . ' SET status_kompen = :status_kompen, bukti_kompen = :bukti WHERE riwayat_id = :id');

            // Handling file upload
            $uploadedFileName = $this->handleFileUpload();
            echo $uploadedFileName;

            $this->db->bind('status_kompen', $status);
            $this->db->bind('bukti', $uploadedFileName);
            $this->db->bind('id', $data['id']);
            $this->db->execute();
        }else {
            $this->db->query('UPDATE ' . $this->table6 . ' SET status_kompen = :status_kompen WHERE riwayat_id = :id');
            $this->db->bind('status_kompen', $status);
            $this->db->bind('id', $data['id']);
            $this->db->execute();
        }
        return $this->db->rowCount();
    }

    private function handleFileUpload()
    {
        $targetDir = str_replace('/public', '', $_SERVER['DOCUMENT_ROOT']) . '/tatib_2g/public/img/bukti_kompen/';
        $uploadedFile = $_FILES['buktiKompen']; // Nama input file pada formulir

        // Menggunakan timestamp detik UNIX untuk membuat nama file unik
        $uniqueFileName = time() . '_' . substr(pathinfo($uploadedFile['name'], PATHINFO_FILENAME), 0, 3) . '.' . pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
        $targetFilePath = $targetDir . $uniqueFileName;
        $fileType = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);

        // Memeriksa apakah file tersebut adalah file gambar
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array(strtolower($fileType), $allowedTypes)) {
            if (move_uploaded_file($uploadedFile['tmp_name'], $targetFilePath)) {
                return $uniqueFileName;
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        } else {
            echo "File yang diunggah bukan gambar atau format file tidak diizinkan.";
        }
    }
}
