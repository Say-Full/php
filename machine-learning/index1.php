<?php

// Regresi -> outputnya berupa nilai kontinu
// Regression 1 : Simple Linear Regression

require "vendor/autoload.php";

// 1. Loading dataset

// filepath = "./dataset/insurance.csv"

// features = 1
// Klo punya 11 kolom dan kolom ke-11 adlh label, maka tulisnya 10

// headingRows = true
// true = Bagian pling atas di dataset adlh header dr kolom dataset yg mana gk mw dimasukin sbg input untuk melatih model
$dataset = new \Phpml\Dataset\CsvDataset("./dataset/insurance.csv", 1, true);



// 2. Preprocessing data

// testSize = 0.2 = 20%
// seed = 156
$data = new \Phpml\CrossValidation\RandomSplit($dataset, 0.2, 156);

/**
 * $data->getTrainSamples(); // Get fitur/input untuk melatih model model
 * $data->getTrainLabels(); // Output dr train set
 * 
 * $data->getTestSamples(); // Get fitur/input untuk tes model
 * $data->getTestLabels(); // Output dr test set
 */



// 3. Training

// Linear Regression = Hubungan antara sebuah variabel dependen dgn satu atw lbh variabel independen
$regressor = new \Phpml\Regression\LeastSquares();
$regressor->train($data->getTrainSamples(), $data->getTrainLabels());
$predicted = $regressor->predict($data->getTestSamples());



// 4. Evaulation

// Untuk metrik yg bs digunakan pd algoritma regresi dpt dilihat di vendor/php-ai/src/Metric/Regression.php yg semuanya method nya adlh method statik, jd gk perlu membuat instance (objek) dr class trsbt.
$score = \Phpml\Metric\Regression::r2Score($data->getTestLabels(), $predicted);
// echo "r2Score = ". $score;



// 5. Prediction on New Data

var_dump($regressor->predict([80]));