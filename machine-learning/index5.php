<?php

// Persistency -> Agar gk dilatih ulang modelnya krn bs memakan wkt yg lama

require "vendor/autoload.php";


// 1. Loading data

$dataset = new \Phpml\Dataset\CsvDataset("./dataset/iris.csv", 4, true);



// 2. Preprocessing data

$data = new \Phpml\CrossValidation\StratifiedRandomSplit($dataset, 0.2, 156);


// 3. Training

// $classifier = new \Phpml\Classification\KNearestNeighbors(3);
// $classifier->train($data->getTrainSamples(), $data->getTrainLabels());

// $model_manager = new \Phpml\ModelManager();
// $model_manager->saveToFile($classifier, './models/knn_classifier');

// $predicted = $classifier->predict($data->getTestSamples());


$model_manager = new \Phpml\ModelManager();
$classifier_model = $model_manager->restoreFromFile('./models/knn_classifier');
$predicted = $classifier_model->predict($data->getTestSamples());




// 4. Evaulation

$accuracy = \Phpml\Metric\Accuracy::score($data->getTestLabels(), $predicted);
echo "Akurasi = " . $accuracy;



// 5. Prediction on New Data
