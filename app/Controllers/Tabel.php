<?php
// Controller Halaman Tabel

namespace App\Controllers;

use App\Models\TabelModel;
use App\Models\TotalModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use Config\Services;


class Tabel extends BaseController
{
    // Objek
    protected $tabelModel;
    protected $totalModel;
    protected $builder;
    protected $dataTabel;

    // Variabel Global
    protected $satker = "";
    protected $outputfilename;
    protected $formatter;



    public function __construct()
    {
        // helper('form');
        $this->tabelModel = new TabelModel();
        session();
        $this->builder = $this->tabelModel->builder();
        $config = new \Config\App();
        $defaultLocale = $config->defaultLocale;
        $this->formatter = new \NumberFormatter($defaultLocale, \NumberFormatter::DECIMAL);


    }

    // Fungsi index sebagai route method default utama untuk bagian halaman tabel
    public function index()
    {
        if (in_groups('admin')){
            $this->dataTabel = $this->tabelModel->getTabel();
        }else {
            $this->dataTabel = $this->tabelModel->getSpecTabel(user()->satker);
        }

        $data = [
            'judul' => 'Sistem Pelaporan Proses Pengadaan Barang/Jasa Online (SIS PPBJ ON)',
            'laporan' => $this->dataTabel,
            'username' => user()->username
        ];
        return view('tabel/laporan', $data);
    }

    public function tambahdata(){
        // Fungsi controller untuk berpindah ke halaman tambah data
        $data = [
            'judul' => 'Sistem Pelaporan Proses Pengadaan Barang/Jasa Online (SIS PPBJ ON)',
            'validation' => \Config\Services::validation(),
            'username' => user()->username
        ];
        return view('tabel/tambahdata', $data);
    }

    public function save() {
        // Fungsi untuk menambah data
        $this->satker = user()->satker;

        if($this->validasiTambahData()){
            $validation = \Config\Services::validation();
            // withInput() dikirim ke session
            session()->setFlashdata('pesangagal', 'Data Gagal Ditambahkan, Periksa kembali data-data anda.');
            return redirect()->to('/tabel/tambahdata');
        }

        $pagu = str_replace('.', '', $this->request->getVar('pagu'));
        $pagu = str_replace(',', '.', $pagu);
        $angkapagu = $this->formatter->parse($pagu);
        // $angkapagu = floatval($pagu);

        // $nilaikontrak = str_replace(',','', $this->request->getVar('nilaikontrak'));
        // $nilaikontrak = str_replace('.','', $nilaikontrak);
        $nilaikontrak = str_replace('.', '', $this->request->getVar('nilaikontrak'));
        $nilaikontrak = str_replace(',', '.', $nilaikontrak);
        $angkanilaikontrak = $this->formatter->parse($nilaikontrak);
        // $angkanilaikontrak = floatval($nilaikontrak);

        // $uangmuka = str_replace(',','', $this->request->getVar('uangmuka'));
        // $uangmuka = str_replace('.','', $uangmuka);
        $uangmuka = str_replace('.', '', $this->request->getVar('uangmuka'));
        $uangmuka = str_replace(',', '.', $uangmuka);
        $uangmuka = $this->formatter->parse($uangmuka);
        (isset($uangmuka)) ? $angkauangmuka = $uangmuka : $angkauangmuka = 0;      

        // $tahap1 = str_replace(',','', $this->request->getVar('tahap1'));
        // $tahap1 = str_replace('.','', $tahap1);
        $tahap1 = str_replace('.', '', $this->request->getVar('tahap1'));
        $tahap1 = str_replace(',', '.', $tahap1);
        $tahap1 = $this->formatter->parse($tahap1);
        (isset($tahap1)) ? $angkatahap1 = $tahap1 : $angkatahap1 = 0;

        // $tahap2 = str_replace(',','', $this->request->getVar('tahap2'));
        // $tahap2 = str_replace('.','', $tahap2);
        $tahap2 = str_replace('.', '', $this->request->getVar('tahap2'));
        $tahap2 = str_replace(',', '.', $tahap2);
        $tahap2 = $this->formatter->parse($tahap2);
        (isset($tahap2)) ? $angkatahap2 = $tahap2 : $angkatahap2 = 0;

        // $pelunasan = str_replace(',','', $this->request->getVar('pelunasan'));
        // $pelunasan = str_replace('.','', $pelunasan);
        $pelunasan = str_replace('.', '', $this->request->getVar('pelunasan'));
        $pelunasan = str_replace(',', '.', $pelunasan);
        $pelunasan = $this->formatter->parse($pelunasan);
        (isset($pelunasan)) ? $angkapelunasan = $pelunasan : $angkapelunasan = 0;

        $jenispengadaan = $this->request->getVar('jenispengadaan');
        switch ($jenispengadaan) {
            case 1:
                $jenispengadaan = "Konsultansi";
                break;
            case 2:
                $jenispengadaan = "Konstruksi";
                break;
            case 3:
                $jenispengadaan = "Barang";
                break;
            case 4:
                $jenispengadaan = "Jasa Lainnya";
                break;
        }
        $sisaanggaran = $angkanilaikontrak - ($angkauangmuka + 
        $angkatahap1 + 
        $angkatahap2 + 
        $angkapelunasan);

        if($sisaanggaran < 0) {
            session()->setFlashdata('errorsisaanggaran', 'Gagal Menambahkan Data, Sisa Anggaran Tidak Bisa Bernilai Dibawah 0');
            return redirect()->to('/tabel/tambahdata');        
        }

        $this->tabelModel->save([
            'pengadaan' => $this->request->getVar('pengadaan'),
            'jenispengadaan' => $jenispengadaan,
            'ppk' => $this->request->getVar('ppk'),
            'penyedia' => $this->request->getVar('penyedia'),
            'nokontrak' => $this->request->getVar('nokontrak'),
            'tglkontrak' => $this->request->getVar('tglkontrak'),
            'akhirkontrak' => $this->request->getVar('akhirkontrak'),
            'pagu' => $angkapagu,
            'nilaikontrak' => $angkanilaikontrak,
            'sisapagu' => $angkapagu - $angkanilaikontrak,
            'uangmuka' => $angkauangmuka,
            'tahap1' => $angkatahap1,
            'tahap2' => $angkatahap2,
            'pelunasan' => $angkapelunasan,
            'sisaanggaran' => $sisaanggaran,
            'jumin' => $this->request->getVar('jumin'),
            'jusik' => $this->request->getVar('jumin'),
            'tkdn' => $this->request->getVar('tkdn'),
            'ket' => $this->request->getVar('ket'),
            'satker' => $this->satker,
            'tahun' => date('Y'),
        ]);

        // if($this->tabelModel->checkInsertedRow()){
        //     // Send email using the CodeIgniter Email library

        // }

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/tabel/tambahdata');
    }

    public function delete($id){
        $this->tabelModel->delete($id);

        session()->setFlashdata('pesanhapus', 'Data berhasil dihapus.');
        return redirect()->to('/tabel');

    }

    public function update() {
        // Fungsi untuk merubah data
        $this->satker = user()->satker;
        
        $laporanLama = $this->tabelModel->getTabel($this->request->getVar('id'));
        if($laporanLama['pengadaan'] == $this->request->getVar('pengadaan')) {
            $rule_pengadaan = 'required';
        }else {
            $rule_pengadaan = 'required';
        }
        if($this->validasiTambahData($rule_pengadaan)){
            $validation = \Config\Services::validation();
            // withInput() dikirim ke session
            return redirect()->to('/tabel')->withInput()->with('validation', $validation);
        }

        if(!isset($this->satker)) {
            $this->satker = $laporanLama['satker'];
        }

        // Spesifikasi Nilai Input
        $pagu = str_replace('.', '', $this->request->getVar('pagu'));
        $pagu = str_replace(',', '.', $pagu);
        $angkapagu = $this->formatter->parse($pagu);

        $nilaikontrak = str_replace('.', '', $this->request->getVar('nilaikontrak'));
        $nilaikontrak = str_replace(',', '.', $nilaikontrak);
        $angkanilaikontrak = $this->formatter->parse($nilaikontrak);

        $uangmuka = str_replace('.', '', $this->request->getVar('uangmuka'));
        $uangmuka = str_replace(',', '.', $uangmuka);
        $uangmuka = $this->formatter->parse($uangmuka);
        (isset($uangmuka)) ? $angkauangmuka = $uangmuka : $angkauangmuka = 0;

        $tahap1 = str_replace('.', '', $this->request->getVar('tahap1'));
        $tahap1 = str_replace(',', '.', $tahap1);
        $tahap1 = $this->formatter->parse($tahap1);
        (isset($tahap1)) ? $angkatahap1 = $tahap1 : $angkatahap1 = 0;

        $tahap2 = str_replace('.', '', $this->request->getVar('tahap2'));
        $tahap2 = str_replace(',', '.', $tahap2);
        $tahap2 = $this->formatter->parse($tahap2);
        (isset($tahap2)) ? $angkatahap2 = $tahap2 : $angkatahap2 = 0;

        $pelunasan = str_replace('.', '', $this->request->getVar('pelunasan'));
        $pelunasan = str_replace(',', '.', $pelunasan);
        $pelunasan = $this->formatter->parse($pelunasan);
        (isset($pelunasan)) ? $angkapelunasan = $pelunasan : $angkapelunasan = 0;

        $jenispengadaan = $this->request->getVar('jenispengadaan');
        switch ($jenispengadaan) {
            case 1:
                $jenispengadaan = "Konsultansi";
                break;
            case 2:
                $jenispengadaan = "Konstruksi";
                break;
            case 3:
                $jenispengadaan = "Barang";
                break;
            case 4:
                $jenispengadaan = "Jasa Lainnya";
                break;
        }
        $sisaanggaran = $angkanilaikontrak - ($angkauangmuka + 
        $angkatahap1 + 
        $angkatahap2 + 
        $angkapelunasan);

        if($sisaanggaran < 0) {
            session()->setFlashdata('errorsisaanggaranupdate', 'Gagal Update Data, Sisa Anggaran Tidak Bisa Bernilai Dibawah 0');
            return redirect()->to('/tabel');
        }

        $this->tabelModel->save([
            'id' => $this->request->getVar('id'),
            'pengadaan' => $this->request->getVar('pengadaan'),
            'jenispengadaan' => $jenispengadaan,
            'ppk' => $this->request->getVar('ppk'),
            'penyedia' => $this->request->getVar('penyedia'),
            'nokontrak' => $this->request->getVar('nokontrak'),
            'tglkontrak' => $this->request->getVar('tglkontrak'),
            'akhirkontrak' => $this->request->getVar('akhirkontrak'),
            'pagu' => $angkapagu,
            'nilaikontrak' => $angkanilaikontrak,
            'sisapagu' => $angkapagu - $angkanilaikontrak,
            'uangmuka' => $angkauangmuka,
            'tahap1' => $angkatahap1,
            'tahap2' => $angkatahap2,
            'pelunasan' => $angkapelunasan,
            'sisaanggaran' => $sisaanggaran,
            'jumin' => $this->request->getVar('jumin'),
            'jusik' => $this->request->getVar('jumin'),
            'tkdn' => $this->request->getVar('tkdn'),
            'ket' => $this->request->getVar('ket'),
            'satker' => $this->satker,
            'tahun' => date('Y'),
        ]);

        session()->setFlashdata('pesan_diubah', 'Data berhasil diubah.');
        return redirect()->to('/tabel');
    }

    public function export(){
        // Fungsi untuk Export Data Tabel ke Spreadsheet

        if (in_groups('admin')){
            $this->dataTabel = $this->tabelModel->getTabel();
        }else {
            $this->dataTabel = $this->tabelModel->getSpecTabel(user()->satker);
        }

        $laporan = $this->dataTabel;

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'NO')->mergeCells('A1:A4');
        $activeWorksheet->setCellValue('B1', 'NAMA PENGADAAN')->mergeCells('B1:B4');
        $activeWorksheet->setCellValue('C1', 'NAMA PPK')->mergeCells('C1:C4');
        $activeWorksheet->setCellValue('D1', 'NAMA PENYEDIA');
        $activeWorksheet->setCellValue('D2', 'NOMOR KONTRAK');
        $activeWorksheet->setCellValue('D3', 'TANGGAL KONTRAK');
        $activeWorksheet->setCellValue('D4', 'BATAS AKHIR KONTRAK');
        $activeWorksheet->setCellValue('E1', 'PAGU')->mergeCells('E1:E4');
        $activeWorksheet->setCellValue('F1', 'NILAI KONTRAK')->mergeCells('F1:F4');
        $activeWorksheet->setCellValue('G1', 'SISA PAGU')->mergeCells('G1:G4');
        $activeWorksheet->setCellValue('H1', 'PENARIKAN/REALISASI ANGGARAN')->mergeCells('H1:K1');
        $activeWorksheet->setCellValue('H2', 'UANG MUKA')->mergeCells('H2:H4');
        $activeWorksheet->setCellValue('I2', 'TAHAP I')->mergeCells('I2:I4');
        $activeWorksheet->setCellValue('J2', 'TAHAP II')->mergeCells('J2:J4');
        $activeWorksheet->setCellValue('K2', 'PELUNASAN')->mergeCells('K2:K4');
        $activeWorksheet->setCellValue('L1', 'SISA ANGGARAN')->mergeCells('L1:L4');
        $activeWorksheet->setCellValue('M1', 'JUMIN (%)')->mergeCells('M1:M4');
        $activeWorksheet->setCellValue('N1', 'JUSIK (%)')->mergeCells('N1:N4');
        $activeWorksheet->setCellValue('O1', 'TKDN (%)')->mergeCells('O1:O4');
        $activeWorksheet->setCellValue('P1', 'KET')->mergeCells('P1:P4');

        // Worksheet Page Layout Setup
        $activeWorksheet->getPageMargins()->setTop(0.354330708661417);
        $activeWorksheet->getPageMargins()->setRight(0.236220472440945);
        $activeWorksheet->getPageMargins()->setLeft(0.236220472440945);
        $activeWorksheet->getPageMargins()->setBottom(0.354330708661417);
        $activeWorksheet->getPageMargins()->setFooter(0.31496062992126);
        $activeWorksheet->getPageMargins()->setHeader(0.31496062992126);
        $activeWorksheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $activeWorksheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $activeWorksheet->getPageSetup()->setScale(55);


        $column = 5; // Mulai no Kolom
        $nomor = 1;
        foreach ($laporan as $lap){
            $activeWorksheet->setCellValue('A'.$column, $nomor)->mergeCells("A$column:A". $column+3);
            $activeWorksheet->setCellValue('B'.$column, $lap['pengadaan'])->mergeCells("B$column:B". $column+3);
            $activeWorksheet->setCellValue('C'.$column, $lap['ppk'])->mergeCells("C$column:C". $column+3);
            $activeWorksheet->setCellValue('D'.$column, $lap['penyedia']);
            $activeWorksheet->setCellValue('D'.$column + 1, $lap['nokontrak']);
            $activeWorksheet->setCellValue('D'.$column + 2, $lap['tglkontrak']);
            $activeWorksheet->setCellValue('D'.$column + 3, $lap['akhirkontrak']);
            $activeWorksheet->setCellValue('E'.$column, $lap['pagu'])->mergeCells("E$column:E". $column+3);
            $activeWorksheet->setCellValue('F'.$column, $lap['nilaikontrak'])->mergeCells("F$column:F". $column+3);
            $activeWorksheet->setCellValue('G'.$column, $lap['sisapagu'])->mergeCells("G$column:G". $column+3);
            $activeWorksheet->setCellValue('H'.$column, $lap['uangmuka'])->mergeCells("H$column:H". $column+3);
            $activeWorksheet->setCellValue('I'.$column, $lap['tahap1'])->mergeCells("I$column:I". $column+3);
            $activeWorksheet->setCellValue('J'.$column, $lap['tahap2'])->mergeCells("J$column:J". $column+3);
            $activeWorksheet->setCellValue('K'.$column, $lap['pelunasan'])->mergeCells("K$column:K". $column+3);
            $activeWorksheet->setCellValue('L'.$column, $lap['sisaanggaran'])->mergeCells("L$column:L". $column+3);
            $activeWorksheet->setCellValue('M'.$column, $lap['jumin'])->mergeCells("M$column:M". $column+3);
            $activeWorksheet->setCellValue('N'.$column, $lap['jusik'])->mergeCells("N$column:N". $column+3);
            $activeWorksheet->setCellValue('O'.$column, $lap['tkdn'])->mergeCells("O$column:O". $column+3);
            $activeWorksheet->setCellValue('P'.$column, $lap['ket'])->mergeCells("P$column:P". $column+3);

            // Set Thousand Comma Separator
            $activeWorksheet->getStyle("E$column:L". $column)->getNumberFormat()->setFormatCode('#,##0');

            // Wrap Text
            $activeWorksheet->getStyle("A$column:P". $column)->getAlignment()->setWrapText(true);
            $activeWorksheet->getStyle('D'.$column+1)->getAlignment()->setWrapText(true);
            $activeWorksheet->getStyle('D'.$column+2)->getAlignment()->setWrapText(true);
            $activeWorksheet->getStyle('D'.$column+3)->getAlignment()->setWrapText(true);
            
            // Horizontal
            $activeWorksheet->getStyle("A$column:P". $column)->getAlignment()->setHorizontal('general');
            $activeWorksheet->getStyle('D'.$column+1)->getAlignment()->setHorizontal('general');
            $activeWorksheet->getStyle('D'.$column+2)->getAlignment()->setHorizontal('general');
            $activeWorksheet->getStyle('D'.$column+3)->getAlignment()->setHorizontal('general');
            // Vertical
            $activeWorksheet->getStyle("A$column:P". $column)->getAlignment()->setVertical('top');
            $activeWorksheet->getStyle('D'.$column+1)->getAlignment()->setVertical('top');
            $activeWorksheet->getStyle('D'.$column+2)->getAlignment()->setVertical('top');
            $activeWorksheet->getStyle('D'.$column+3)->getAlignment()->setVertical('top');

            $nomor++;
            $column = $column + 4;
        }

        $activeWorksheet->getStyle('A1:A3')->getNumberFormat()->setFormatCode('#,##0.00');

        // $activeWorksheet->getStyle('A1:P1')->getFont()->setBold(true);
        // $activeWorksheet->getStyle('D2')->getFont()->setBold(true);
        // $activeWorksheet->getStyle('D3')->getFont()->setBold(true);
        // $activeWorksheet->getStyle('D4')->getFont()->setBold(true);

        // Horizontal
        $activeWorksheet->getStyle('A1:P4')->getAlignment()->setHorizontal('center');

        // Wrap Text
        $activeWorksheet->getStyle('A1:P4')->getAlignment()->setWrapText(true);

        // Vertical
        $activeWorksheet->getStyle('A1:P4')->getAlignment()->setVertical('center');

        // Color
        $activeWorksheet->getStyle('A1:P4')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('A9A9A9');

        //Border Style
        $activeWorksheet->getStyle('A5:P'.$column - 1)->getBorders()
        ->getAllBorders()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('H1:K1')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('A1:A4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('B1:B4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('C1:C4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('D1:D4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('E1:E4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('F1:F4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('G1:G4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('H2:H4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('I2:I4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('J2:J4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('K2:K4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('L1:L4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('M1:M4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('N1:N4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('O1:O4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));
        $activeWorksheet->getStyle('P1:P4')->getBorders()
        ->getOutline()
        ->setBorderStyle(Border::BORDER_DOTTED)
        ->setColor(new Color('000000'));


        $activeWorksheet->getColumnDimension('A')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('B')->setWidth(30);
        $activeWorksheet->getColumnDimension('C')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('D')->setWidth(27);
        $activeWorksheet->getColumnDimension('E')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('F')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('G')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('H')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('I')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('J')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('K')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('L')->setAutoSize(true);
        $activeWorksheet->getColumnDimension('M')->setWidth(8);
        $activeWorksheet->getColumnDimension('N')->setWidth(8);
        $activeWorksheet->getColumnDimension('O')->setWidth(8);
        $activeWorksheet->getColumnDimension('P')->setAutoSize(true);
        
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=laporan.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        $excelFilePath = 'C:\excel_files\excel_file.xlsx';
        $writer->save($excelFilePath);

        exit();
    }
    public function pdfsave(){
        if (isset($_FILES['excel_file']) && file_exists($_FILES['excel_file']['tmp_name'])) {
            $excelFile = $_FILES['excel_file']['tmp_name'];

            $pdfsheet = IOFactory::load($excelFile);
            $pdfWriter = new Mpdf($pdfsheet);
            $this->outputfilename = $this->request->getVar('output_filename');
            if($this->outputfilename == ''){
                $this->outputfilename = 'laporan';
            }
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename=' . $this->outputfilename . '.pdf');
            header('Cache-Control: max-age=0');
            $pdfWriter->save('php://output');
            exit();
        }else {
                // File doesn't exist, display an error message or notification
            session()->setFlashdata('file_notfound', 'File Excel Tidak Dapat Ditemukan');
            return redirect()->to('/tabel');
        }
        // $excelFilePath = 'C:\excel_files\excel_file.xlsx';
        // if (file_exists($excelFilePath)) {
        //     // File exists, proceed with the conversion
        
        //     // Load the Excel file
        //     $pdfsheet = IOFactory::load($excelFilePath);
        
        //     // Create the PDF writer
        //     $pdfWriter = new Mpdf($pdfsheet);
        
        //     // Set the response headers for download
        //     header('Content-Type: application/pdf');
        //     header('Content-Disposition: attachment; filename="output_file.pdf"');
        //     header('Cache-Control: max-age=0');
        
        //     // Output the PDF file directly to the browser
        //     $pdfWriter->save('php://output');
        //     exit();
        // } else {
        //     // File doesn't exist, display an error message or notification
        //     session()->setFlashdata('file_notfound', 'File Excel Tidak Dapat Ditemukan');
        //     return redirect()->to('/tabel');
        // }
    }


}