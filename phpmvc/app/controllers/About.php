<?php

class About
{
    public function index($nama = 'Rivan', $pekerjaan = 'Mahasiswa')
    {
        echo "Halo, nama saya $nama, saya adalah seorang $pekerjaan.";
    }
    public function Page()
    {
        echo 'About/page';
    }
}
