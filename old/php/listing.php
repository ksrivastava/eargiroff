<?php

function addToImagesArray($path, & $images) {
        if ($handle = opendir('../'.$path)) {
                while (false !== ($entry = readdir($handle))) {
                           if ($entry != "." && $entry != "..") {
                                   $images[] = $path . $entry;
                           }
                }
        }
}

$IMG_DIR = "images/";
$IMG_DIRS = array("commissions", 
                  "portfolio",
                  "illustrations",
                  "paintings",
                  "printmaking",
                  );


$files = array();
$files["images"] = array();
foreach ($IMG_DIRS as $path) {
        addToImagesArray($IMG_DIR . $path . "/thumbs/", $files["images"]);
}

$files["images"][] = "images/about.jpg";

echo json_encode($files);

?>