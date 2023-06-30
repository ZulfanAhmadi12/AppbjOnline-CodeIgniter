<?php
// Controller Halaman Dashboard/Home

namespace App\Controllers;

use App\Models\TotalModel;
use App\Models\TabelModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class Home extends BaseController
{
    protected $totalModel;
    protected $tabelModel;
    protected $builder;
    protected $dataTabel;
    protected $db;
    protected $satkerYangTidakKosong = [];
    protected $satkerYangKosong = [];

    public function __construct()
    {
        $this->totalModel = new TotalModel();
        // helper('form');
        session();
        $this->db = \Config\Database::connect();



    }
    // Fungsi index sebagai route method default utama untuk bagian halaman home
    public function index()
    {
        if(in_groups('admin')){
            $this->tabelModel = new TabelModel();
            $db = $this->tabelModel->db;
            if($db->affectedRows() > 0) {
                $this->calculation();
            }else{
            }
        }

        if (in_groups('admin')){
            $this->dataTabel = $this->totalModel->getTotal();
            $this->tabelModel = new TabelModel();
            $userModel = new UserModel();
            $rows = $this->tabelModel->getTabel();
            $userRows = $userModel->getUserTabel();

            
            foreach ($userRows as $row) {
                $targetValue = $row['satker'];
            
                // Check if the target value exists in the 'satker' column
                $found = in_array($targetValue, array_column($rows, 'satker'));
                if($targetValue != null){
                    if ($found) {
                        $this->satkerYangTidakKosong[] = $targetValue;
                    } else {
                        $this->satkerYangKosong[] = $targetValue;
                    }
                }
            }
                        
        }
        // Judul dapat diakses lewat PHP dengan obj variabel $judul
        $data = [
            'total' => $this->dataTabel,
            'satkerYangKosong' => $this->satkerYangKosong,
            'satkerYangTidakKosong' => $this->satkerYangTidakKosong
        ];

                    

        return view('home/index', $data);
    }

    public function ubahPassword(){

    

        return view('home/ubahPassword');
    }

    public function updatePassword(){
        helper(['form']);
        $rules = [
            'password_lama' => "required",
            'password' => "required|strong_password",
            'konfirmasi_password' => "required|matches[password]"
        ];

        $messages = [
            'password_lama.required' => 'Kata Sandi Lama Harus Di-isi',
            'password.required' => 'Kata Sandi Baru Harus Di-isi',
            'password.strong_password' => 'Kata Sandi Baru Terlalu Lemah',
            'konfirmasi_password.required' => 'Konfirmasi Kata Sandi Baru Harus Di-isi',
            'konfirmasi_password.matches' => 'Konfirmasi Kata Sandri Baru berbeda dengan Kata Sandi Baru',
        ];
        if($this->validate($rules, $messages)){
            $user_id = user_id();
            $userModel = new UserModel();
    
            $userModel->save([
                'id' => $user_id,
                'password_hash' => Password::hash($this->request->getVar('password'))
            ]);
            session()->setFlashdata('password_diubah', 'Password berhasil diubah.');
            return redirect()->to('/home/index');

        }else{
            $data['validation'] = $this->validator;
            return view('home/ubahPassword', $data);
        }
    }

    public function calculation(){
        $this->tabelModel = new TabelModel();
        $barisTabelLaporan = $this->tabelModel->countAllResults();
        if($barisTabelLaporan > 0) {
            $querykonsultansi = $this->tabelModel->selectSum('nilaikontrak')->where('jenispengadaan', 'Konsultansi')->get();
            $querykonstruksi = $this->tabelModel->selectSum('nilaikontrak')->where('jenispengadaan', 'Konstruksi')->get();
            $querybarang = $this->tabelModel->selectSum('nilaikontrak')->where('jenispengadaan', 'Barang')->get();
            $queryjasalainnya = $this->tabelModel->selectSum('nilaikontrak')->where('jenispengadaan', 'Jasa Lainnya')->get();
            $querytotalpagu = $this->tabelModel->selectSum('pagu')->get();
            $totalpaket = $this->tabelModel->countAllResults();
            // $querytotalpengadaan = $this->tabelModel->selectSum('nilaikontrak')->get();
            // $querytotaljumin = $this->tabelModel->selectSum('jumin')->get();
            // $querytotaljusik = $this->tabelModel->selectSum('jusik')->get();
            // $querytotalsisaanggaran = $this->tabelModel->selectSum('sisaanggaran')->get();

            // Retrieve the result of query
            $konsultansi = $querykonsultansi->getRow()->nilaikontrak;
            $konstruksi = $querykonstruksi->getRow()->nilaikontrak;
            $barang = $querybarang->getRow()->nilaikontrak;
            $jasalainnya = $queryjasalainnya->getRow()->nilaikontrak;
            $totalpagu = $querytotalpagu->getRow()->pagu;
            // $totalpengadaan = $querytotalpengadaan->getRow()->nilaikontrak;
            // $totaljumin = $querytotaljumin->getRow()->jumin;
            // $totaljusik = $querytotaljusik->getRow()->jusik;
            // $totalsisaanggaran = $querytotalsisaanggaran->getRow()->sisaanggaran;
            $query = $this->tabelModel->select('nilaikontrak, jumin, jusik, sisaanggaran')->get();
            $results = $query->getResult();
            
            $totalpengadaan = 0;
            $totaljumin = 0;
            $totaljusik = 0;
            $totalsisaanggaran = 0;
            
            foreach ($results as $result) {
                $totalpengadaan += $result->nilaikontrak;
                $totaljumin += $result->jumin;
                $totaljusik += $result->jusik;
                $totalsisaanggaran += $result->sisaanggaran;
            }            

            // Kalkulasi
            $totalpenyerapan = ($totalpengadaan - $totalsisaanggaran) / $totalpengadaan * 100;
            $totalsisaanggaran = ($totalsisaanggaran / $totalpengadaan) * 100;
            $totaljumin = $totaljumin / $totalpaket;
            $totaljusik = $totaljusik / $totalpaket;
            $roundedtotaljumin = round($totaljumin, 2);
            $roundedtotaljusik = round($totaljusik, 2);
            $roundedtotalsisaanggaran = round($totalsisaanggaran, 2);
            $roundedtotalpenyerapan = round($totalpenyerapan, 2);

            $row_counts = $this->totalModel->countAllResults();
            if($row_counts < 1){
                $this->totalModel->save([
                    'jumlahpagu' => $totalpagu,
                    'totalpaket' => $totalpaket,
                    'totalpengadaan' => $totalpengadaan,
                    'konsultansi' => $konsultansi,
                    'konstruksi' => $konstruksi,
                    'barang' => $barang,
                    'jasalainnya' => $jasalainnya,
                    'administrasi' => $roundedtotaljumin,
                    'fisik' => $roundedtotaljusik,
                    'totalpenyerapan' => $roundedtotalpenyerapan,
                    'sisaanggaran' => $roundedtotalsisaanggaran,
                    'tahun' => date('Y')
        
                ]);
            }else{
                $this->totalModel->save([
                    'id' => 1,
                    'jumlahpagu' => $totalpagu,
                    'totalpaket' => $totalpaket,
                    'totalpengadaan' => $totalpengadaan,
                    'konsultansi' => $konsultansi,
                    'konstruksi' => $konstruksi,
                    'barang' => $barang,
                    'jasalainnya' => $jasalainnya,
                    'administrasi' => $roundedtotaljumin,
                    'fisik' => $roundedtotaljusik,
                    'totalpenyerapan' => $roundedtotalpenyerapan,
                    'sisaanggaran' => $roundedtotalsisaanggaran,
                    'tahun' => date('Y')
                ]);
            }

        }else {
            return "Data Laporan Masih Kosong";
        }
    }

    public function totalPerSatker(){
        $this->tabelModel = new TabelModel();
        $selectedSatker = $this->request->getPost('selectedSatker');
        switch ($selectedSatker) {
            case "0":
                $this->dataTabel = $this->totalModel->getTotal();
                // Judul dapat diakses lewat PHP dengan obj variabel $judul
                $data = [
                    'total' => $this->dataTabel
                ];
        
                return view('home/index', $data);
                break;
            case "1":
                $selectedSatker = 'RUMKIT BHAYANGKARA PONTIANAK';
                break;
            case "2":
                $selectedSatker = 'SPRIPIM';
                break;
            case "3":
                $selectedSatker = 'RO OPS';
                break;
            case "4":
                $selectedSatker = 'DIT INTELKAM';
                break;
            case "5":
                $selectedSatker = 'DIT RESKRIMUM';
                break;
            case "6":
                $selectedSatker = 'DIT SAMAPTA';
                break;
            case "7":
                $selectedSatker = 'DIT LANTAS';
                break;
            case "8":
                $selectedSatker = 'RO SDM';
                break;
            case "9":
                $selectedSatker = 'SPN';
                break;
            case "10":
                $selectedSatker = 'ROLOG';
                break;
            case "11":
                $selectedSatker = 'SAT BRIMOB';
                break;
            case "12":
                $selectedSatker = 'DIT POLAIR';
                break;
            case "13":
                $selectedSatker = 'BID KEU';
                break;
            case "14":
                $selectedSatker = 'BID DOKKES';
                break;
            case "15":
                $selectedSatker = 'BID PROPAM';
                break;
            case "16":
                $selectedSatker = 'BID TIK';
                break;
            case "17":
                $selectedSatker = 'BIDKUM';
                break;
            case "18":
                $selectedSatker = 'DIT RESNARKOBA';
                break;
            case "19":
                $selectedSatker = 'ITWASDA';
                break;
            case "20":
                $selectedSatker = 'RORENA';
                break;
            case "21":
                $selectedSatker = 'DIT BINMAS';
                break;
            case "22":
                $selectedSatker = 'DIT RESKRIMSUS';
                break;
            case "23":
                $selectedSatker = 'DITPAMOBVIT';
                break;
            case "24":
                $selectedSatker = 'POLRES LANDAK';
                break;
            case "25":
                $selectedSatker = 'POLRES BENGKAYANG';
                break;
            case "26":
                $selectedSatker = 'POLRES SINGKAWANG';
                break;
            case "27":
                $selectedSatker = 'POLRES SEKADAU';
                break;
            case "28":
                $selectedSatker = 'POLRES MELAWI';
                break;
            case "29":
                $selectedSatker = 'POLRESTA PONTIANAK KOTA';
                break;
            case "30":
                $selectedSatker = 'POLRES MEMPAWAH';
                break;
            case "31":
                $selectedSatker = 'POLRES SAMBAS';
                break;
            case "32":
                $selectedSatker = 'POLRES SANGGAU';
                break;
            case "33":
                $selectedSatker = 'POLRES SINTANG';
                break;
            case "34":
                $selectedSatker = 'POLRES KAPUAS HULU';
                break;
            case "35":
                $selectedSatker = 'POLRES KETAPANG';
                break;
            case "36":
                $selectedSatker = 'POLRES KAYONG UTARA';
                break;
            case "37":
                $selectedSatker = 'POLRES KUBU RAYA';
                break;
            case "38":
                $selectedSatker = 'BIDHUMAS';
                break;
        }

        $row_counts = $this->tabelModel->where('satker', $selectedSatker)->countAllResults();
        if($row_counts < 1){
            session()->setFlashdata('datasatkerkosong', 'Data Laporan Satker yang Terpilih Kosong');
            return redirect()->to('/Home/index');   
        }
        $querykonsultansi = $this->tabelModel->selectSum('nilaikontrak')
        ->where('jenispengadaan', 'Konsultansi')
        ->where('satker', $selectedSatker)
        ->get();
        $konsultansi = $querykonsultansi->getRow()->nilaikontrak;
        
        $querykonstruksi = $this->tabelModel->selectSum('nilaikontrak')
            ->where('jenispengadaan', 'Konstruksi')
            ->where('satker', $selectedSatker)
            ->get();
        $konstruksi = $querykonstruksi->getRow()->nilaikontrak;
        
        $querybarang = $this->tabelModel->selectSum('nilaikontrak')
            ->where('jenispengadaan', 'Barang')
            ->where('satker', $selectedSatker)
            ->get();
        $barang = $querybarang->getRow()->nilaikontrak;
        
        $queryjasalainnya = $this->tabelModel->selectSum('nilaikontrak')
            ->where('jenispengadaan', 'Jasa Lainnya')
            ->where('satker', $selectedSatker)
            ->get();
        $jasalainnya = $queryjasalainnya->getRow()->nilaikontrak;
        $totalpaket = $this->tabelModel->where('satker', $selectedSatker)->countAllResults();
        $querytotalpagu = $this->tabelModel->selectSum('pagu')
        ->where('satker', $selectedSatker)
        ->get();
        $totalpagu = $querytotalpagu->getRow()->pagu;

        $query = $this->tabelModel->select('nilaikontrak, jumin, jusik, sisaanggaran')
        ->where('satker', $selectedSatker)
        ->get();
        $results = $query->getResult();
        
        $totalpengadaan = 0;
        $totaljumin = 0;
        $totaljusik = 0;
        $totalsisaanggaran = 0;
        
        foreach ($results as $result) {
            $totalpengadaan += $result->nilaikontrak;
            $totaljumin += $result->jumin;
            $totaljusik += $result->jusik;
            $totalsisaanggaran += $result->sisaanggaran;
        }

            // Kalkulasi
        $totalpenyerapan = ($totalpengadaan - $totalsisaanggaran) / $totalpengadaan * 100;
        $totalsisaanggaran = ($totalsisaanggaran / $totalpengadaan) * 100;
        $totaljumin = $totaljumin / $totalpaket;
        $totaljusik = $totaljusik / $totalpaket;
        $roundedtotaljumin = round($totaljumin, 2);
        $roundedtotaljusik = round($totaljusik, 2);
        $roundedtotalsisaanggaran = round($totalsisaanggaran, 2);
        $roundedtotalpenyerapan = round($totalpenyerapan, 2);

        $data = [
            'totalpagu' => $totalpagu,
            'totalpaket' => $totalpaket,
            'totalpengadaan' => $totalpengadaan,
            'konsultansi' => $konsultansi,
            'konstruksi' => $konstruksi,
            'barang' => $barang,
            'jasalainnya' => $jasalainnya,
            'roundedtotaljumin' => $roundedtotaljumin,
            'roundedtotaljusik' => $roundedtotaljusik,
            'roundedtotalpenyerapan' => $roundedtotalpenyerapan,
            'roundedtotalsisaanggaran' => $roundedtotalsisaanggaran,
            'selectedSatker' => $selectedSatker
        ];
        
        return view('Home/index', $data);
    }

}
