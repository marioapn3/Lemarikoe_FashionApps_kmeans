<?php

namespace App\Http\Controllers;

use Phpml\Clustering\KMeans;

class ClusteringController extends Controller
{
    public function ClusteringData($arrayTambahan)
    {
        // Data yang telah diberikan
        $samples = [
            [1, 1, 1],
            [3, 1, 4],
            [4, 2, 2],
            [2, 2, 5],
            [5, 1, 1],
            [3, 3, 3],
            [2, 1, 2],
            [1, 4, 4],
            [5, 3, 5],
            [4, 2, 1],
            [3, 4, 2],
            [1, 3, 3],
            [2, 2, 4],
            [5, 4, 3],
            [4, 1, 5],
            [3, 1, 1],
            [2, 3, 2],
            [1, 2, 4],
            [4, 3, 5],
            [5, 1, 2],
            [3, 4, 4],
            [2, 2, 1],
            [1, 3, 5],
            [5, 4, 2],
            [4, 1, 3],
            [3, 2, 4],
            [2, 3, 1],
            [1, 1, 2],
            [5, 2, 5],
            [4, 3, 1],
            [3, 1, 5],
            [2, 4, 2],
            [1, 2, 3],
            [5, 3, 4],
            [4, 2, 5],
            [3, 4, 1],
            [2, 1, 3],
            [1, 4, 2],
            [5, 1, 4],
            [4, 3, 3],
            [3, 2, 1],
            [2, 3, 4],
            [1, 2, 5],
            [5, 4, 1],
            [4, 1, 2],
            [3, 3, 5],
            [2, 2, 3],
            [1, 3, 4],
            [5, 2, 1],
            [4, 4, 2],
            [3, 1, 2],
            [2, 4, 3],
            [1, 1, 3],
            [5, 3, 2],
            [4, 2, 4],
            [3, 4, 5],
            [2, 1, 5],
            [1, 4, 3],
            [5, 1, 5],
            [4, 3, 2],
            [3, 2, 3],
            [2, 3, 5],
            [1, 2, 1],
            [5, 4, 4],
            [4, 1, 1],
            [3, 3, 2],
            [2, 2, 5],
            [1, 3, 3],
            [5, 2, 2],
            [4, 4, 5],
            [3, 1, 3],
            [2, 4, 1],
            [1, 1, 4],
            [5, 3, 1],
            [4, 2, 3],
            [3, 4, 2],
            [2, 1, 1],
            [1, 4, 5],
            [5, 1, 3],
            [4, 3, 4],
            [3, 2, 2],
            [2, 3, 3],
            [1, 2, 4],
            [5, 4, 1],
            [4, 1, 5],
            [3, 3, 1],
            [2, 2, 4],
            [1, 3, 2],
            [5, 2, 5],
            [4, 4, 3],
            [3, 1, 4],
            [2, 4, 5],
            [1, 1, 5],
            [5, 3, 3],
            [4, 2, 1],
            [3, 4, 4],
            [2, 1, 2],
            [1, 4, 4],
            [5, 1, 1],
            [4, 3, 5],
        ];

        $clusters = new KMeans(6);

        $result =     $clusters->cluster($samples);
        foreach ($result as $clusterId => $cluster) {
            echo "Cluster $clusterId id: ";
            foreach ($cluster as $sampleId => $sample) {
                echo "$sampleId, ";
            }
            echo "\n";
        }
        echo "<br>";

        // Data yang akan diprediksi
        $dataToPredict = $arrayTambahan;
        //push ke array $samples
        $samples[] = $dataToPredict;

        $clusterBaru = null;
        $result = $clusters->cluster($samples);
        // foreach ($result as $clusterId => $cluster) {
        //     echo "Cluster $clusterId id: ";
        //     foreach ($cluster as $sampleId => $sample) {
        //         echo "$sampleId, ";
        //     }
        //     echo "\n";
        // }
        // echo "<br>";
        //cari data yang baru berada di cluster mana menggunakan foreach dan if
        foreach ($result as $clusterId => $cluster) {
            foreach ($cluster as $sampleId => $sample) {
                if ($sampleId == count($samples) - 1) {
                    // echo "Data yang baru berada di cluster $clusterId";
                    $clusterBaru = $clusterId;
                }
            }
        }
        // dd($clusterBaru);
        return $clusterBaru;
    }
}
