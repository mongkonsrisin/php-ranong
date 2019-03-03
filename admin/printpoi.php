<?php
require("config/session_ansi.php");
require('lib/fpdf.php');
require("config/dbconfig_ansi.php");
define('FPDF_FONTPATH','lib/font');
?>
<?php
if(!isset($_SESSION['user'])) {
echo '<meta http-equiv="refresh" content="0;url=login.php">';
exit();
}
?>
<?php
if(isset($_GET['cat'])) {
$sql = "SELECT * FROM tbl_poi poi LEFT JOIN tbl_category c ON poi.poi_cat=c.cat_id LEFT JOIN tbl_pin pin ON poi.poi_pin=pin.pin_id WHERE poi_cat=".$_GET['cat'];
} else {
$sql = "SELECT * FROM tbl_poi poi LEFT JOIN tbl_category c ON poi.poi_cat=c.cat_id LEFT JOIN tbl_pin pin ON poi.poi_pin=pin.pin_id";
}
class PDF extends FPDF
{
// Page header
function Header()
{
switch($_GET['cat']) {
case 1: $title = "รายการที่พัก"; break;
case 2: $title = "รายการสถานที่ท่องเที่ยว"; break;
case 3: $title = "รายการร้านอาหาร"; break;
case 4: $title = "รายการร้านสินค้าชุมชน"; break;
default: $title = ""; break;
}
// Logo
$this->Image('assets/img/appicon_color.png',10,6,25);
// Arial bold 15
$this->SetFont('Angsana','B',22);
// Move to the right
// $this->Cell(80);
// Title
$this->Cell(30,10,'',0,0,'L');
$this->Cell(0,10,$title,0,0,'L');
$this->Cell(0,10,$result->num_rows,0,0,'C');
// Line break
$this->Ln(25);  //preprint
$this->Cell(10,10,'#',1,0,'C');
$this->Cell(50,10,'รูปภาพ',1,0,'C');
$this->Cell(130,10,'รายละเอียด',1,1,'C');
}
// Page footer
function Footer()
{
// Position at 1.5 cm from bottom
$this->SetY(-15);
// Arial italic 8
$this->SetFont('Angsana','',15);
// Page number
$this->Cell(0,10,'หน้า '.$this->PageNo().'/{nb}',0,0,'C');
}
}
// Instanciation of inherited class
$pdf = new PDF('P');
$pdf->AddFont('Angsana','','angsa.php');
$pdf->AddFont('Angsana','B','angsab.php');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Angsana','',16);
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$i = 1;
$x2=$pdf->GetX();
$y2=$pdf->GetY();
while($row = mysqli_fetch_assoc($result))
{
$pdf->SetXY($x2,$y2);
$pdf->SetFont('Angsana','B',18);
$pdf->Cell(10,50,$i,1,0,'C');
$pdf->Cell(50,50,'',1,0,'L');
$x=$pdf->GetX();
$ximg=$x-45;
$y=$pdf->GetY();
$pdf->Cell(130,50,'',1,1,'L');
$x2=$pdf->GetX();
$y2=$pdf->GetY();
$pdf->SetXY($x,$y);
$pdf->Cell(110,10,$row['poi_name'],0,1,'L');
$pdf->SetFont('Angsana','',16);
$pdf->SetX($x);
$pdf->Cell(110,8,'หมวดหมู่: '.$row['cat_name'],0,1,'L');
$poi_type = $row['poi_type'];
switch ($poi_type) {
case 0 : $poi_type = '-'; break;
case 1 : $poi_type = 'เชิงนิเวศน์'; break;
case 2 : $poi_type = 'เชิงสุขภาพ'; break;
default : $poi_type = '-'; break;
}
$pdf->SetX($x);
$pdf->MultiCell(110,8,'ประเภท: '.$poi_type,0,'L',false);
$poi_lat = $row['poi_lat'];
$poi_lng = $row['poi_lng'];
if(empty($poi_lat) || empty($poi_lng)) {
$latlng = "ไม่มีพิกัด";
} else {
$latlng = "$poi_lat,$poi_lng";
}
$pdf->SetX($x);
$pdf->MultiCell(110,8,'พิกัด: '.$latlng,0,'L',false);
$poi_id = $row['poi_id'];
$pic = '../assets/img/poi/s/'.$poi_id.'.png';
if (file_exists($pic)) {
$pdf->Image($pic,$ximg,$y+2,40);
} else {
$pdf->Image('assets/img/no_image.png',$ximg,$y+2,40);
}	
$i++;
}
$pdf->SetXY($x2,$y2);
$user = $_SESSION['user'];
$pdf->SetFont('Angsana','',16);
$pdf->Ln(10); 
$pdf->Cell(0,10,'พิมพ์โดย: '.$user,0,1,'R');
$pdf->Cell(0,1,'วันที่: '. date('d').'/'. date('m').'/'.(  date('Y')+543 ).' '. date('H:i:s') ,0,0,'R');
$pdf->Output();
?>