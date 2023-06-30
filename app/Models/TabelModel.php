<?php

namespace App\Models;

use CodeIgniter\Model;

class TabelModel extends Model
{
    protected $table      = 'laporan';
    protected $tabelModel;
    // Dates
    protected $useTimestamps = true;
    protected $db;

    //Property atau Field yang boleh diisi
    protected $allowedFields = ['id','pengadaan','jenispengadaan', 'ppk' ,'penyedia','nokontrak' ,'tglkontrak','akhirkontrak'
,'pagu','nilaikontrak','sisapagu','uangmuka','tahap1','tahap2','pelunasan','sisaanggaran','jumin','jusik','tkdn','ket','satker','tahun','created_at','updated_at'];

    public function getTabel($id = false){
        $this->db = \Config\Database::connect();

        if($id == false){
            $query = $this->db->table($this->table)->select('*')->orderBy('satker','asc')->get();
            $result = $query->getResultArray();
            return $result;
        }
        return $this->where(['id' => $id])->first();
        
    }

    public function getSpecTabel($satker = 'BIDHUMAS'){
        $this->tabelModel = new TabelModel();
        $builder = $this->tabelModel->builder();
        $builder->where('satker', $satker);
        return $builder->getWhere()->getResultArray();
    }

    // public function checkInsertedRow(){
    //     if($this->db->affected_rows() > 0) {
    //         return true;
    //     }else {
    //         return false;
    //     }
    // }




    
}