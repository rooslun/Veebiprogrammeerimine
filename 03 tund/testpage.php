<?php
  $userName = "Roos L Marie";
  
  $photoDir = "../photos/";
  $photoTypes = ["image/jpeg", "image/png"];
  
  $fullTimeNow = date("d.m.Y. H:i:s");
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  
  if($hourNow < 8) {
	$partOfDay = "hommik";
  } else if($hourNow > 8 && $hourNow < 10) {
    $partOfDay = "pärastlõuna";
  } else if($hourNow > 10) {
    $partOfDay = "öö";
  }
  
  //info semestri kulgemise kohta
    $semesterStart = new DateTime("2019-9-2");
	$semesterEnd = new DateTime("2019-12-13");
	$semesterDuration = $semesterStart -> diff($semesterEnd);
	$today = new DateTime("now");
	$semesterElapsed = $semesterStart -> diff($today);
	//echo $semesterDuration;
	//var_dump($semesterDuration);
	//<p>Semester on täies hoos:
	//<meter="0" max="112" value="16">13%</meter>
	//</p>
	$semesterInfoHTML = null;
	if($semesterElapsed -> format("%r%a") >= 0){
	   $semesterInfoHTML = "<p>Semester on täies hoos:";
       $semesterInfoHTML .= '<meter min="0" max="' .$semesterDuration -> format("%r%a") .'" ';
       $semesterInfoHTML .= 'value="'.$semesterElapsed -> format("%r%a") .'">';
       $semesterInfoHTML .= round($semesterElapsed -> format("%r%a") / $semesterDuration -> format("%r%a") * 100, 1) . "%";
	   $semesterInfoHTML .= "</meter> </p>";
	}
	
	//foto näitamine lehel
	$fileList = array_slice(scandir($photoDir), 2);
	//var_dump($fileList);
	$photolist = [];
	foreach ($fileList as $file){
		$fileInfo = getImagesize($photoDir .$file);
		//var_dump($fileInfo)
		if (in_array($fileInfo["mime"], $photoTypes)){
			array_push($photolist, $file);
		}
	}
	
	//$photolist = ["tlu_terra_600x400_1.jpg", "tlu_terra_600x400_2.jpg", "tlu_terra_600x400_3.jpg"];//array ehk massiiv
	$photoCount = count ($photolist);
	//var_dump($photolist);
	$photoNum = mt_rand(0, $photoCount -1);
	//echo $photolist[$photoNum];
	//<img src="..photos/tlu_terra_600x400_1.jpg" alt="TLÜ Terra Õppehoone">
	$randomImgHTML = '<img src="' .$photoDir .$photolist[$photoNum] .'" alt="Juhuslik foto">';
	
	require("header.php");
	
    echo "<h1>" .$userName .", veebiprogrammeerimine</h1>";
  ?>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavad sisu.</p>
  <?php
    echo $semesterInfoHTML;
	?>
  <hr>
  <?php
    echo "<p>Lehe avamise hetkel oli aeg: " .$fullTimeNow .", " .$partOfDay .".</p>";
	echo $randomImgHTML;
	?>
</body>
</html>