<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\MasukModel;
use App\Models\KeluarModel;

class Home extends BaseController
{
    protected $ProdukModel;
    protected $MasukModel;
    protected $KeluarModel;
    public function __construct()
    {
        $this->ProdukModel = new ProdukModel();
        $this->MasukModel = new MasukModel();
        $this->KeluarModel = new KeluarModel();
    }
    public function index()
    {
        $data['produk'] = $this->ProdukModel->getAll();
        $data['stok'] = $this->ProdukModel->getCount();
        $data['masuk'] = $this->MasukModel->getCount();
        $data['keluar'] = $this->KeluarModel->getCount();
        return view('dashboard',$data);
    }
}
