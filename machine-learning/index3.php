<?php

// Klasifikasi -> Ketika outputnya berupa nilai diskrit (kategorikal).
// Classification : k-Nearest Neighbors (kNN) = Memprediksi label dr suatu titik data berdasarkan label dr tetangga terdekatnya.

require "vendor/autoload.php";


// 1. Loading data

$dataset = new \Phpml\Dataset\CsvDataset("./dataset/iris.csv", 4, true);
// $dataset = new \Phpml\Dataset\CsvDataset("./dataset/wine.csv", 13, true);



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

$classifier = new \Phpml\Classification\KNearestNeighbors(3);
$classifier->train($data->getTrainSamples(), $data->getTrainLabels());
$predicted = $classifier->predict($data->getTestSamples());



// 4. Evaulation

$accuracy = \Phpml\Metric\Accuracy::score($data->getTestLabels(), $predicted);
echo "Akurasi = " . $accuracy;



// 5. Prediction on New Data
