<?php

namespace App\Models;

use CodeIgniter\Model;

class TotalModel extends Model
{
    protected $table      = 'total';
    protected $totalModel;
    protected $tabelModel;
    // Dates
    protected $db;

    //Property atau Field yang boleh diisi
    protected $allowedFields = ['jumlahpagu','totalpaket','totalpengadaan','konsultansi','konstruksi','barang','jasalainnya','administrasi','fisik','totalpenyerapan','sisaanggaran','tahun'];

    public function getTotal(){
        $this->totalModel = new TotalModel();
        // $this->db = \Config\Database::connect();

        return $this->totalModel->findAll();
        
    }

    public function getCountRow(){
        $row_count = $this->totalModel->countAll();
        return $row_count;
    }

    
}