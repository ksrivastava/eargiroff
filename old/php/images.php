<?php
ini_set('display_errors', 'On');

function addImagesToGallery($page) {
	$IMG_DIR = "images/$page/images/";
	//$IMG_DIR = "images/$page/full/";
	$THUMBS_DIR = "images/$page/thumbs/";
	$IMG_FILE = "../images/listing.json";

	$json = json_decode(file_get_contents($IMG_FILE), true);

	if (array_key_exists($page, $json)) {
		for ($i = 0; $i < sizeof($json[$page]); $i++) { 
			$title = $json[$page][$i]["title"];
			$file = $json[$page][$i]["file"];

			echo '<a target="_blank" class="image_link" href=' . $IMG_DIR . $file . '>';
	        echo '<div class="image-div"><img class="image" src=' . $THUMBS_DIR . $file . '>';
	        echo '<div class="img-title hidden">'.$title.'</div>';
	        echo '</div></a>';
		}
	}
}

function addAboutPic() {
	echo '<img id="aboutpic" src=images/about.jpg>';
}

if (isset($_GET["page"])) {
	$page = $_GET["page"];
	if (!empty($page)) {
		if ($page == "about") {
			addAboutPic();
		}
		else {
			addImagesToGallery($page);
		}
	}
}

?>
