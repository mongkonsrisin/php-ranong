<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./assets/fonts/font.css">
<link rel="stylesheet" href="assets/css/gallery_style.css">
<link rel="stylesheet" href="assets/css/font-awesome.css">

  
<?php require_once('db_config.php') ?>

<body>

<?php
    $sql = "SELECT * FROM tbl_poi WHERE poi_id=".$_GET['id'];
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
?>

<div align="center">
<h2 class="borderhead" style="text-align:center"><?=$row['poi_name'] ?></h2>
</div>

<?php 
$directory = "assets/img/photo/".$_GET['id']."/"; // dir location
$allpics = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
if ($allpics != false)
{
    $filecount = count($allpics);
    echo '<div class="row">';
    for($i=0;$i<$filecount;$i++)
	{
        echo '<div class="column"><img src="'.$allpics[$i].'?v='.date('Ymdhis').'" style="width:100%" onclick="openModal();currentSlide('.($i+1).')" class="hover-shadow cursor"></div>';
    }
    echo '</div>';
    echo '<div id="myModal" class="modal"><span class="close cursor" onclick="closeModal()">&times;</span><div class="modal-content">';
    for($i=0;$i<$filecount;$i++)
	{
        echo '<div class="mySlides"><div class="numbertext">'.($i+1).' / '.$filecount.'</div><img src="'.$allpics[$i].'" style="width:100%"></div>';
    }
?> 
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    <div class="caption-container"><p id="caption"></p></div>
    <?php 
    for($i=0;$i<$filecount;$i++)
    {
        echo '<div class="column"><img class="demo cursor" src="'.$allpics[$i].'" style="width:100%" onclick="currentSlide('.($i+1).')" alt="'.$row['poi_name'].'"></div>';
    }
    ?>
  </div>
</div>

<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
<?php } ?>


<div align="center">
    <p>
        <button class="btn btn-5 btn-5b icon-cart" onclick="window.location.href='<?=$_GET['back']?>.php?id=<?=$_GET['id']?>'"><span>Back</span></button>
    </p>

</div>

</body>
</html>