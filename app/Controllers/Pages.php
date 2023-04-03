<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [];

        $data['title'] = 'Home | WebPemrogaman';
        
        return view("pages/home", $data);
                
    }

    public function about()
    {
        $data = [];

        $data['title'] = 'About me | WebPemrogaman';
        
        return view("pages/about", $data);
    }

    public function contact()
    {
        $data = [];

        $data['title'] = 'Contact us | WebPemrogaman';
        $data['alamat'] = [
            [
                'tipe' => 'Rumah',
                'alamat' => 'Jl. abc no. 123',
                'kota' => 'Bandung',
            ],
            [
                'tipe' => 'Kantor',
                'alamat' => 'Jl. setiabudi no. 23',
                'kota' => 'Bandung',
            ],
        ];

        return view("pages/contact", $data);
    }
}
