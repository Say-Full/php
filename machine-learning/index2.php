<?php

// Regression 2 : Support Vector Regressor

// !) Error

// Support Vector Regressor = Mencari garis atw bidang (line or plane) yg memisahkan grup-grup yg berbeda dan mencari grup yg terdekat (nearest match) dr data yg baru

require "vendor/autoload.php";


// 1. Loading data

$dataset = new \Phpml\Dataset\CsvDataset("./dataset/wine.csv", 13, true);



// 2. Preprocessing data

$data = new \Phpml\CrossValidation\StratifiedRandomSplit($dataset, 0.2, 156);

/**
 * $data->getTrainSamples();
 * $data->getTrainLabels();
 * 
 * $data->getTestSamples();
 * $data->getTestLabels();
 */



// 3. Training

$regressor = new \Phpml\Regression\SVR();
$regressor->train($data->getTrainSamples(), $data->getTrainLabels());
$predicted = $regressor->predict($data->getTestSamples());



// 4. Evaulation

// r2Score tdk terlalu presisi untuk kasus multilable
$score = \Phpml\Metric\Regression::r2Score($data->getTestLabels(), $predicted);
echo "r2Score = ". $score . PHP_EOL;

// Akurasi biasa digunakan untuk kasus klasifikasi, bkn regresi. Jd, bulatkan angka yg ditebak oleh model
// &$pred akan lngsng memodifikasi setiap isi dr $predicted
foreach( $predicted as &$pred ) {
    // Precision = 0 = gk ada desimal point
    $pred = round($pred, 0);
}
$accuracy = \Phpml\Metric\Accuracy::score($data->getTestLabels(), $predicted);
echo "Akurasi = " . $accuracy;



// 5. Prediction on New Data
