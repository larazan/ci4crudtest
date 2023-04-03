<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;

    function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_komik') ? $this->request->getVar('page_komik') : 1;
        
        // $keyword = $this->request->getVar('keyword');
        // if ($keyword) {
        //     $komik = $this->komikModel->search($keyword); 
        // } else {
        //     $komik = $this->komikModel;
        // }
        
        $data = [];
        $komik = $this->komikModel->getKomik();
        // dd($komik);
        $data['title'] = 'Komik';
        $data['komiks'] = $komik->paginate(10, 'komik');
        $data['pager'] = $this->komikModel->pager;
        $data['currentPage'] = $currentPage;

        return view("komik/index", $data);
    //    echo "komik page";
    }

    public function about()
    {
         // cara konek tanpa db
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM komik");
        // var_dump($komik);
        // foreach ($komik->getResultArray() as $row) {
        //     dd($row);
        // }

        echo "this is about";
    }

    public function detail($slug)
    {
        $data = [];
        $komik = $this->komikModel->getKomik($slug);
        $data['title'] = 'Komik';
        $data['komik'] = $komik;

        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan.');
        }

        return view("komik/detail", $data);
    }

    public function create()
    {
        session();
        $data = [];
        $data['validation'] = \Config\Services::validation(); 
        $data['title'] = 'Komik';

        return view("komik/create", $data);
    }

    public function save()
    {
        // validasi
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'error' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation(); 
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/komik/create')->withInput();
        }

        // anbil gambar
        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            // ambil nama file
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        $komik = $this->komikModel->find($id);
        unlink('img/' . $komik['sampul']);

        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $komik = $this->komikModel->getKomik($slug);

        $data = [];
        $data['validation'] = \Config\Services::validation(); 
        $data['title'] = 'Komik';
        $data['komik'] = $komik;

        return view("komik/edit", $data);
    }

    public function update($id)
    {
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }
        
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'error' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation(); 
            return redirect()->to('/komik/edit' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $namaSampul = $fileSampul->getRandomName();

            $fileSampul->move('img', $namaSampul);

            unlink('img' . $this->request->getVar('sampulLama'));
        }
        

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/komik');
    }
}
