<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdukModel;
use App\Models\DetailProdukModel;

class DetailProdukController extends BaseController
{
    protected $ProdukModel;
    protected $DetailProduk;
    public function __construct()
    {
        $this->ProdukModel = new ProdukModel();
        $this->DetailProduk = new DetailProdukModel();
    }

    public function show($id)
    {
        $data['produk'] = $this->ProdukModel->getById($id);
        $data['detail'] = $this->DetailProduk->where('id_produk',$id)->findAll();
        return view('detailproduk/index', $data);
    }


    public function add($id)
    {
        $validationRules = [
            'file' => 'uploaded[file]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/gif,image/png]'
        ];

        if (!$this->validate($validationRules)) {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $filePath = ROOTPATH . 'public/uploads/' . $newName;
            $file->move(ROOTPATH . 'public/uploads/', $newName);

            // Call the function to center crop the image
            $this->centerCropSquare($filePath);

            // Store the file information in the database
            $this->DetailProduk->insert([
                'id_produk' => $id,
                'nama_file' => $newName,
            ]);

            return redirect()->to('/detailproduk/show/' . $id)->with('success', 'File uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload the file.');
    }

    private function centerCropSquare($filePath)
    {
        // Load the image manipulation library
        $image = \Config\Services::image()
            ->withFile($filePath)
            ->fit(200, 200, 'center')
            ->save($filePath);
    }

    public function delete($id)
    {
        $detailProduk = $this->DetailProduk->find($id);
        if ($detailProduk) {
            $filePath = ROOTPATH . 'public/uploads/' . $detailProduk['nama_file'];

            // Delete the file from the directory
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the record from the database
            $this->DetailProduk->delete($id);

            return redirect()->to('/detailproduk/show/' . $detailProduk['id_produk'])->with('success', 'File deleted successfully.');
        }

        return redirect()->back()->with('error', 'File not found.');
    }
}
