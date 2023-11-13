<?php

// Pengklusteran -> Model menempatkan data dlm grup/kluster yg berbeda-beda.
// Clustering : k-means = Membagi dataset menjadi sejmlh kluster berdasarkan kesamaan (similarity) dr fitur-fiturnya.

require "vendor/autoload.php";


// 1. Loading data

// Kita lakukan unsupervised learning menggunakan dataset Iris dgn mengabaikan labelnya.
$dataset = new \Phpml\Dataset\CsvDataset("./dataset/iris.csv", 4, true);



// 2. Preprocessing data
// Semua data kita gunakan sbg sample pelatihan model (training data).



// 3. Training

// KMeans membutuhkan parameter brp bnyk kluster/grup yg kita inginkan.
// Cara mengetahuinya bs dgn kita sudah duluan tw brp bnyk klusternya atw gunakan algoritma untuk memperkirakan jmlh kluster yg paling cocok, seperti algoritma elbow method
$clustering = new \Phpml\Clustering\KMeans(3);
$clusters = $clustering->cluster($dataset->getSamples());

$file = fopen('clustered_data.csv','w');
foreach( $clusters as $key => $cluster ){
    foreach( $cluster as $data ) {
        $dataToWrite = [...$data, $key]; // ...$data = $data[0], $data[1], ..., $data[n]
        fputcsv($file, $dataToWrite);
    }
}

fclose($file);