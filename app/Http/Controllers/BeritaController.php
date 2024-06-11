<?php

namespace App\Http\Controllers;

// untuk mengakses http
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // untuk tes response dari API
    public function index()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines?country=gb&category=business&apiKey=9f26f876a4294e7a8c9ab73b0041575c');
        $hasil = json_decode($response);
        // var_dump($hasil);

        if($hasil->status=="ok"){
            echo "Jumlah Status     : ".$hasil->status."<br>";
            echo "Jumlah Results    : ".$hasil->totalResults."<br>";
            echo "Sumber Artikel-1  : ".$hasil->articles[0]->source->name."<br>";
            echo "Nama Artikel-2    : ".$hasil->articles[1]->title."<br>";
            echo "URL Gambar        : ".$hasil->articles[1]->urlToImage."<br>";

            // dapatkan jumlah datanya
            echo "<hr>";
            foreach ($hasil->articles as $row){
                echo $row->source->name."-".$row->author."-".$row->title."-".$row->url."-".$row->description."-".$row->urlToImage;
                echo "<br>"; 
            } 
               
        }
    }

    // untuk galeri berita
    public function getNews(){
        // akses API
        $url = 'https://newsapi.org/v2/top-headlines?country=gb&category=business&apiKey=9f26f876a4294e7a8c9ab73b0041575c';
        $response = Http::get($url);
        $hasil = json_decode($response);
        // var_dump($hasil);
        return view(
            'berita.berita',
            [
                'hasil' => $hasil
            ]
        );
    }
    public function coba() {
        $url = 'https://opendata.majalengkakab.go.id/api/bigdata/bpbd/jmlh-kwsn-rwn-bncn-cc-ktrm-brdsrkn-kcmtn-d-kbptn-mjlngk/openapi.json';
        $response = Http::get($url);
        $hasil = json_decode($response, true);
    
        $parameters = $hasil['paths']['/jmlh-kwsn-rwn-bncn-cc-ktrm-brdsrkn-kcmtn-d-kbptn-mjlngk']['get']['parameters'];
    
        return view('berita.coba', ['parameters' => $parameters]);
    }
    
    public function coba2(){
        $url = 'https://opendata.majalengkakab.go.id/api/bigdata/bpbd/29-jmlh-kjdn-bncn-cc-kstrm-brdsrkn-kcmtn-d-kbptn-mjlngk/openapi.json';
        $response = Http::get($url);
        $hasil = json_decode($response->body(), true);
    
        $parameters = $hasil['info'];
    
        return view('berita.coba2', ['parameters' => $parameters]);
    }

    public function coba3()
    {
        $url = 'https://eodhd.com/api/sentiments?s=btc-usd.cc,aapl.us&from=2022-01-01&to=2022-04-22&api_token=6662b3007ee127.18770180&fmt=json';
        $response = Http::get($url);
        $hasil = json_decode($response->body(), true); // Decode as associative array

        // Check if the response contains 'data_row'
        $dataRows = $hasil['BTC-USD.CC'] ?? [];

        return view('berita.coba3', ['dataRows' => $dataRows]);
    }
}