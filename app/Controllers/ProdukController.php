<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisModel;
use App\Models\KategoriModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdukModel;
use App\Models\MasukModel;
use App\Models\KeluarModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProdukController extends BaseController
{
    protected $ProdukModel;
    protected $KategoriModel;
    protected $JenisModel;
    protected $MasukModel;
    protected $KeluarModel;
    public function __construct()
    {
        $this->ProdukModel = new ProdukModel();
        $this->KategoriModel = new KategoriModel();
        $this->JenisModel = new JenisModel();
        $this->MasukModel = new MasukModel();
        $this->KeluarModel = new KeluarModel();
    }

    public function index()
    {
        $data['produk'] = $this->ProdukModel->getAll();
        return view('produk/index', $data);
    }

    public function create()
    {
        $kategori = $this->KategoriModel->findAll();
        $jenis = $this->JenisModel->findAll();
        $data = [
            'kategori' => $kategori,
            'jenis' => $jenis,
        ];

        return view('produk/create', $data);
    }


    public function add()
    {
        $data = [
            'id_user' => session()->get('id_user'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_jenis' => $this->request->getPost('id_jenis'),
            'stock' => $this->request->getPost('stock'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga')
        ];

        $this->ProdukModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        return redirect()->to('/produk');
    }

    public function edit($id)
    {
        $produk = $this->ProdukModel->find($id);
        $kategori = $this->KategoriModel->findAll();
        $jenis = $this->JenisModel->findAll();
        $data = [
            'produk' => $produk,
            'kategori' => $kategori,
            'jenis' => $jenis,
        ];

        return view('produk/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'id_user' => session()->get('id_user'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_jenis' => $this->request->getPost('id_jenis'),
            'stock' => $this->request->getPost('stock'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga')
        ];

        $this->ProdukModel->update($id, $data);
        session()->setFlashdata('update', 'Data berhasil diperbarui!');
        return redirect()->to('/produk');
    }

    public function delete($id)
    {
        $this->ProdukModel->delete($id);
        session()->setFlashdata('error', 'Data berhasil dihapus!');
        return redirect()->to('/produk');
    }

    public function cekstok()
    {
        $id_produk = $this->request->getPost('id_produk');
        $produk = $this->ProdukModel->find($id_produk);
        if ($produk) {
            return $this->response->setJSON(['stock' => $produk['stock']]);
        }
        return $this->response->setJSON(['stock' => 0], 404);
    }

    public function rekap()
    {
        return view('produk/rekap');
    }

    public function cetakRekap()
    {
        // Ambil input tanggal awal dan tanggal akhir dari form
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');

        // Ambil semua produk dari database
        $produkData = $this->ProdukModel->getAll();

        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();

        // Mengatur nama sheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Rekap Data Produk');

        // Merge cell A1 sampai G1 untuk judul Rekapitulasi Stok Barang
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'Rekapitulasi Stok Barang');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Tulis informasi tanggal di A2, A3, B2, C2, B3, C3
        $sheet->setCellValue('A2', 'Mulai:');
        $sheet->setCellValue('B2', $tgl_awal);
        $sheet->setCellValue('A3', 'Sampai:');
        $sheet->setCellValue('B3', $tgl_akhir);

        // Header kolom
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama Produk');
        $sheet->setCellValue('C4', 'Kategori');
        $sheet->setCellValue('D4', 'Jenis');
        $sheet->setCellValue('E4', 'Barang Masuk');
        $sheet->setCellValue('F4', 'Barang Keluar');
        $sheet->setCellValue('G4', 'Total Stok Terknini');

        // Mengatur teks header menjadi bold dan center-aligned serta all border
        $headerStyle = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ];
        $sheet->getStyle('A4:G4')->applyFromArray($headerStyle);

        // Menulis data produk ke Excel
        $row = 5;
        $no = 1;

        foreach ($produkData as $produk) {
            // Ambil jumlah stok masuk berdasarkan id_produk
            $totalMasuk = $this->MasukModel->getTotal($produk['id_produk'], $tgl_awal, $tgl_akhir);

            // Ambil jumlah stok keluar berdasarkan id_produk
            $totalKeluar = $this->KeluarModel->getTotal($produk['id_produk'], $tgl_awal, $tgl_akhir);

            // Tulis data ke Excel
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $produk['nama_produk']);
            $sheet->setCellValue('C' . $row, $produk['nama_kategori']);
            $sheet->setCellValue('D' . $row, $produk['nama_jenis']);
            $sheet->setCellValue('E' . $row, $totalMasuk);
            $sheet->setCellValue('F' . $row, $totalKeluar);
            $sheet->setCellValue('G' . $row, $produk['stock']);

            $row++;
            $no++;
        }

        // Set lebar kolom otomatis berdasarkan konten
        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Mengubah semua border menjadi all border
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $range = 'A4:' . $highestColumn . $highestRow;
        $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Membuat file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'rekapitulasi stok barang' . str_replace('/', '_', $tgl_awal) . '_-_' . str_replace('/', '_', $tgl_akhir) . '.xlsx';

        // Simpan file Excel ke folder tertentu atau langsung unduh
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}
