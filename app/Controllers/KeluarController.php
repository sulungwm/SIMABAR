<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KeluarModel;
use App\Models\ProdukModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KeluarController extends BaseController
{

    protected $KeluarModel;
    protected $ProdukModel;

    public function __construct()
    {
        $this->KeluarModel = new KeluarModel();
        $this->ProdukModel = new ProdukModel();
    }

    public function index()
    {
        $data['keluar'] = $this->KeluarModel->getAll();
        return view('keluar/index', $data);
    }

    public function create()
    {
        $produk = $this->ProdukModel->findAll();
        $data = [
            'produk' => $produk,
        ];

        return view('keluar/create', $data);
    }

    public function add()
    {
        $id_produk = $this->request->getPost('id_produk');
        $jumlah_barang = $this->request->getPost('jumlah_barang');
        $tanggal_keluar = $this->request->getPost('tanggal_keluar');

        // cari produk berdasarkan id_produk kemudian kurangkan total stock dengan jumlah_barang keluar
        $produk = $this->ProdukModel->find($id_produk);
        if (!empty($produk)) {
            $jumlah_baru = $produk['stock'] - $jumlah_barang;
            // perbarui total stock produk dari hasil penjumlahan
            $dataProduk['stock'] = $jumlah_baru;
            $this->ProdukModel->update($id_produk, $dataProduk);
        }

        $data = [
            'id_produk' =>  $id_produk,
            'jumlah_barang' => $jumlah_barang,
            'tanggal_keluar' => $tanggal_keluar
        ];

        $this->KeluarModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        return redirect()->to('/keluar');
    }

    public function delete($id)
    {
        $barang_keluar = $this->KeluarModel->find($id);
        //cari produk berdasarkan id_produk kemudian kembalikan total stok semula
        $produk = $this->ProdukModel->find($barang_keluar['id_produk']);
        if (!empty($produk)) {
            $jumlah_baru = $produk['stock'] + $barang_keluar['jumlah_barang'];
            // perbarui total stock produk dari hasil penjumlahan
            $dataProduk['stock'] = $jumlah_baru;
            $this->ProdukModel->update($barang_keluar['id_produk'], $dataProduk);
        }

        $this->KeluarModel->delete($id);
        session()->setFlashdata('error', 'Data berhasil dihapus!');
        return redirect()->to('/keluar');
    }


    public function edit($id)
    {
        $barangkeluar = $this->KeluarModel->find($id);
        $produk = $this->ProdukModel->findAll();
        $stok_produk = null;

        if ($barangkeluar && isset($barangkeluar['id_produk'])) {
            $produk_selected = $this->ProdukModel->find($barangkeluar['id_produk']);
            $stok_produk = $produk_selected ? $produk_selected['stock'] : null;
        }

        $data = [
            'barangkeluar' => $barangkeluar,
            'produk' => $produk,
            'stok_produk' => $stok_produk
        ];

        return view('keluar/edit', $data);
    }

    public function update($id)
    {
        $id_produk = $this->request->getPost('id_produk');
        $jumlah_barang = $this->request->getPost('jumlah_barang');
        $tanggal_keluar = $this->request->getPost('tanggal_keluar');

        // cari produk dan kembalikan jumlah stok semula
        $keluar_old = $this->KeluarModel->find($id);
        $produk_old = $this->ProdukModel->find($keluar_old['id_produk']);

        if (!empty($produk_old)) {
            $jumlah_old = $produk_old['stock'] + $keluar_old['jumlah_barang'];
            $produk_old['stock'] = $jumlah_old;
            $this->ProdukModel->update($keluar_old['id_produk'], $produk_old);
        }


        // cari ulang produk berdasarkan inputan $id_produk dan kurangkan stocknya dari inputan jumlah_barang keluar
        // Hal ini akan lebih efektif ketika user mengubah produk yang dipilih ketika mengedit data barang keluar
        $produk_new = $this->ProdukModel->find($id_produk);
        if (!empty($produk_new)) {
            $jumlah_new = $produk_new['stock'] - $jumlah_barang;
            $produk_new['stock'] = $jumlah_new;
            $this->ProdukModel->update($id_produk, $produk_new);
        }


        // perbarui data barangkeluar yang diedit
        $data = [
            'id_produk' =>  $id_produk,
            'jumlah_barang' => $jumlah_barang,
            'tanggal_keluar' => $tanggal_keluar
        ];
        $this->KeluarModel->update($id, $data);
        session()->setFlashdata('update', 'Data berhasil diperbarui!');
        return redirect()->to('/keluar');
    }

    public function cetak()
    {
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $data = $this->KeluarModel->getDataCetak($tgl_awal, $tgl_akhir);

        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();

        // Mengatur nama sheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Barang Keluar');


        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Produk');
        $sheet->setCellValue('C1', 'Jumlah Barang');
        $sheet->setCellValue('D1', 'Tanggal Keluar');

        // Mengatur teks header menjadi bold
        $headerStyle = [
            'font' => [
                'bold' => true,
            ],
        ];
        $sheet->getStyle('A1:D1')->applyFromArray($headerStyle);

        // Menulis data dari database ke Excel
        $row = 2;
        $no = 1; // Nomor urut awal

        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no); // Set nilai kolom A dengan nomor urut
            $sheet->setCellValue('B' . $row, $item['nama_produk']);
            $sheet->setCellValue('C' . $row, $item['jumlah_barang']);

            // Mengatur format tanggal_masuk menjadi dd mm yy
            $tanggal_keluar = date_create($item['tanggal_keluar'])->format('d-m-Y');
            $sheet->setCellValueExplicit('D' . $row, $tanggal_keluar, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

            $row++;
            $no++; // Increment nomor urut
        }

        // Set lebar kolom otomatis berdasarkan konten
        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Mengatur border untuk seluruh data
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:D' . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Membuat file Excel
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'data_pengeluaran_barang_' . $tgl_awal . '_-_' . $tgl_akhir . '.xlsx';

        // Simpan file Excel ke folder tertentu atau langsung unduh
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}
