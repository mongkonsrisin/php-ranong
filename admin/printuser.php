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
// Logo
$this->Image('assets/img/appicon_color.png',10,6,25);
// Arial bold 15
$this->SetFont('Angsana','B',22);
// Move to the right
// $this->Cell(80);
// Title
$this->Cell(30,10,'',0,0,'L');
$this->Cell(0,10,'รายการผู้ดูแลระบบ',0,0,'L');
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
$sql = "SELECT * FROM tbl_admin WHERE admin_role != 'admin'";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$i = 1;
$x2=$pdf->GetX();
$y2=$pdf->GetY();
while($row = mysqli_fetch_assoc($result))
{
$admin_title = $row['admin_title'];
if ($row['admin_title'] == 0){
$admin_title = "นาย" ;
}else if ($row['admin_title'] == 1){
$admin_title = "นาง" ;
}else {
$admin_title = "นางสาว" ;
}
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
$pdf->Cell(110,10,'ชื่อผู้ใช้: '.$row['admin_user'],0,1,'L');
$pdf->SetFont('Angsana','',16);
$pdf->SetX($x);
$pdf->Cell(110,8,'ชื่อ-สกุล: '.$admin_title.$row['admin_name'].' '.$row['admin_lname'],0,1,'L');
$admin_id = $row['admin_id'];
$pic = '../assets/img/user/'.$admin_id.'.png';
if (file_exists($pic)) {
$pdf->Image($pic,$ximg,$y+2,40);
} else {
$pdf->Image('assets/img/no_image.png',$ximg,$y+2,40);
}	
$i ++ ;
}
$pdf->SetXY($x2,$y2);
$user = $_SESSION['user'];
$pdf->SetFont('Angsana','',16);
$pdf->Ln(10); 
$pdf->Cell(0,10,'พิมพ์โดย: '.$user,0,1,'R');
$pdf->Cell(0,1,'วันที่: '. date('d').'/'. date('m').'/'.(  date('Y')+543 ).' '. date('H:i:s') ,0,0,'R');
$pdf->Output();
?>