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
class PDF extends FPDF
{
// Page header
function Header()
{
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
// Logo
$pdf->Image('assets/img/appicon_color.png',10,6,25);
// Arial bold 15
$pdf->SetFont('Angsana','B',22);
// Move to the right
// $this->Cell(80);
// Title
$pdf->Cell(30,10,'',0,0,'L');
$pdf->Cell(0,10,'รายการโปรแกรมท่องเที่ยว',0,0,'L');
$pdf->Cell(0,10,$result->num_rows,0,0,'C');
// Line break
$pdf->Ln(25);  //preprint
$pdf->Cell(190,0,'',1,1,'C');
$pdf->Ln(10);
$pdf->SetFont('Angsana','',16);
$sql = "SELECT * FROM tbl_package";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$page = 1;
while($row = mysqli_fetch_assoc($result))
{
if($page>1)
$pdf->AddPage();
$pois = array();
$pdf->SetFont('Angsana','B',18);
$pdf->Cell(0,10,$row['pk_id'].'.'.$row['pk_title'],0,1,'L');
$pdf->Cell(0,10,'ราคา: '.number_format($row['pk_budget']),0,1,'L');
//$pdf->SetXY($x,$y);
//$pdf->Cell(0,10,'',0,1,'L');
//$x=$pdf->GetX();
//$y=$pdf->GetY();
$pois = array();
$pois = explode("|",$row['pk_route']);
$total = count($pois);
$j = 0;
$pdf->SetFont('Angsana','',18);
foreach ($pois as $poi) {
if($j>0){
$sql2 = 'SELECT * FROM tbl_poi WHERE poi_id=?';
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("i",$poi);
$stmt2->execute();
$result2 = $stmt2->get_result();
$row2 = $result2->fetch_assoc();
$poi_name = $row2['poi_name'];
$pdf->Cell(0,8,'               จุดที่ '.$j.' '.$poi_name,0,1,'L');
}
$j++;
}
//$pk_id = $row['pk_id'];
//	$pic = '../assets/img/package/'.$pk_id.'/preview'.$pk_id.'.png';
//if (file_exists($pic)) {
//	$pdf->Image($pic,$x,$y,40);
//	} else {
//$pdf->Image('assets/img/no_image.png',$x,$y,40);
//	}
$pk_id = $row['pk_id'];
$pic = '../assets/img/package/'.$pk_id.'/preview'.$pk_id.'.png';
$pdf->Image($pic,$x+30,$y,150);
$pdf->Ln(10);
$pdf->Cell(190,0,'',1,1,'C');
$pdf->Ln(10);
$page++;
}
$user = $_SESSION['user'];
$pdf->Cell(0,10,'พิมพ์โดย: '.$user,0,1,'R');
$pdf->Cell(0,10,'วันที่: '. date('d').'/'. date('m').'/'.(  date('Y')+543 ).' '. date('H:i:s') ,0,0,'R');
$pdf->Output();
?>