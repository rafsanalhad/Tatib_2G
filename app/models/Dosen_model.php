<?php

class Dosen_model
{
    private $table = 'dosen';
    private $table2 = 'user';
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllDosen()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
    public function getDosenById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function getDosenBySessionLogin($username)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip');
        $this->db->bind('nip', $username);
        return $this->db->single();
    }
    public function tambahDataDosen($data)
    {
        $query1 = "INSERT INTO " . $this->table2 . "
                    VALUES
                    ('', :username, :password, :level)";
        $pass = (md5($data["nip"]));
        $this->db->query($query1);
        $this->db->bind('username', $data['nip']);
        $this->db->bind('password', $pass);
        $this->db->bind('level', 2);
        $this->db->execute();

        $query2 = "SELECT * FROM " . $this->table2 . " WHERE username=:username";
        $this->db->query($query2);
        $this->db->bind('username', $data['nip']);
        $res = $this->db->single();

        $queryCheck = "SELECT * FROM " . $this->table . " WHERE nip=:nip";
        $this->db->query($queryCheck);
        $this->db->bind('nip', $data['nip']);
        $queryCheckNip = $this->db->single();

        if ($queryCheckNip != null) {
            return 0;
        }

        $query3 = "INSERT INTO " . $this->table . "
                VALUES
                (:nip, :nama, :TTL, :jenis_kelamin, :jabatan, :email, :no_phone, :alamat, :dosen_img, :user_id)";
        $this->db->query($query3);
        $this->db->bind('nip', $data['nip']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('TTL', $data['ttl']);
        $this->db->bind('jenis_kelamin', $data['jenkel']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('no_phone', $data['no_phone']);
        $this->db->bind('alamat', $data['alamat']);

        // Handling file upload
        $uploadedFileName = $this->handleFileUpload();


        //Bind the uploaded file name to the query
        $this->db->bind('dosen_img', $uploadedFileName);
        $this->db->bind('user_id', $res['user_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    private function handleFileUpload()
    {
        $targetDir = str_replace('/public', '', $_SERVER['DOCUMENT_ROOT']) . '/tatib_2g/public/img/profil/';
        $uploadedFile = $_FILES['imgDosen']; // Nama input file pada formulir

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

    public function getDosenByNip($nip)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip');
        $this->db->bind('nip', $nip);
        return $this->db->single();
    }
    public function editDataDosen($data)
    {
        $checkData = $this->getDosenByNip($data['nip']);
        $dataUploaded = $_FILES['imgDosen']['name'];
        $uploadedFileNameEdit = $this->handleFileUploadEdit($dataUploaded, $checkData['dosen_img']);
        $query = "UPDATE dosen SET nama = :nama, TTL = :TTL, jenis_kelamin = :jenis_kelamin, jabatan = :jabatan, email = :email, no_phone = :no_phone, alamat = :alamat, dosen_img= :dosen_img WHERE nip = :nip";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('TTL', $data['ttl']);
        $this->db->bind('jenis_kelamin', $data['jenkel']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('no_phone', $data['no_phone']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('dosen_img', $uploadedFileNameEdit);
        $this->db->bind('nip', $data['nip']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    private function handleFileUploadEdit($dataOld, $dataTemp)
    {
        $targetDir = str_replace('/public', '', $_SERVER['DOCUMENT_ROOT']) . '/tatib_2g/public/img/profil/';

        // Memeriksa apakah parameter $dataOld sudah diatur dan tidak kosong
        if ($dataOld != null) {

            // Menghapus file lama sebelum menyimpan file baru
            $oldFilePath = $targetDir . $dataOld;

            // Periksa apakah file lama ada sebelum menghapusnya

            $uploadedFile = $_FILES['imgDosen']; // Nama input file pada formulir

            // Menggunakan timestamp detik UNIX untuk membuat nama file unik
            $uniqueFileName = time() . '_' . substr(pathinfo($uploadedFile['name'], PATHINFO_FILENAME), 0, 3) . '.' . pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
            $targetFilePath = $targetDir . $uniqueFileName;
            $fileType = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);

            // Memeriksa apakah file tersebut adalah file gambar
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array(strtolower($fileType), $allowedTypes)) {
                if (move_uploaded_file($uploadedFile['tmp_name'], $targetFilePath)) {
                    // if (file_exists($oldFilePath) && $dataTemp != null) {
                    //     unlink($oldFilePath);
                    // }
                    return $uniqueFileName;
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah file.";
                }
            } else {
                echo "File yang diunggah bukan gambar atau format file tidak diizinkan.";
            }
        } else {
            return $dataTemp;
        }
    }


    // Metode untuk mendapatkan nama file lama (gantilah dengan metode yang sesuai)
    private function getOldFileName()
    {
        // Implementasikan logika untuk mendapatkan nama file lama
        // Misalnya, dapatkan nama file lama dari basis data atau dari variabel lain
        return "nama_file_lama.jpg"; // Gantilah dengan nama file lama yang sebenarnya
    }




    public function hapusDataDosen($nip)
    {
        $querySelect = "SELECT * FROM dosen WHERE nip = :nip";
        $this->db->query($querySelect);
        $this->db->bind('nip', $nip);
        $res = $this->db->single();
        $targetDir = str_replace('/public', '', $_SERVER['DOCUMENT_ROOT']) . '/tatib_2g/public/img/profil/' . $res['dosen_img'];
        unlink($targetDir);
        $queryUser = "DELETE FROM user WHERE user_id = :user_id";
        $this->db->query($queryUser);
        $this->db->bind('user_id', $res['user_id']);
        $this->db->execute();
        $query = "DELETE FROM dosen WHERE nip = :nip";
        $this->db->query($query);
        $this->db->bind('nip', $nip);
        $this->db->execute();
        return $this->db->rowCount();
    }
    // public function ubahDataDosen($data){
    //     $query = "UPDATE tb_dosen SET nama = :nama, nrp = :nrp, email = :email, jurusan = :jurusan WHERE id = :id";
    //     $this->db->query($query);
    //     $this->db->bind('nama',$data['nama']);
    //     $this->db->bind('nrp',$data['nrp']);
    //     $this->db->bind('email',$data['email']);
    //     $this->db->bind('jurusan',$data['jurusan']);
    //     $this->db->bind('id',$data['id']);
    //     $this->db->execute();
    //     return $this->db->rowCount();
    // }
}
