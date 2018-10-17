<?php
include($_SERVER['DOCUMENT_ROOT']."/volunteer-scf/includes/connection.php"); //connecting to the database
mysqli_query($con, "SET NAMES 'utf-8'");
$SqlEncoding = mysqli_character_set_name($con);
if (isset($_POST['CertificateSelection'])) {
    $volunteer_id = $_POST['VolunteerID'];
    $event_id = $_POST['EventID'];
}
else{
$Name = $_GET['name'];
$EventName = $_GET['EventName'];
$AttendedHours = $_GET['hours'];
}
//if (!class_exists('TCPDF')) {
  //  require_once ($_SERVER['DOCUMENT_ROOT'] . '/volunteer-scf/tcpdf/tcpdf.php');
//}

if (!class_exists('TCPDF')) {
  //  echo "inside tcpdf";
include($_SERVER['DOCUMENT_ROOT']."/volunteer-scf/tcpdf/tcpdf.php");
}

//require_once('tcpdf_include.php');
//require_once (dirname(__FILE__) . '/tcpdf_include.php');
// create new PDF document
//if(!class_exists('TCPDF')){die('TCPDF could not be loaded. Abort!');}
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Certificate');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetTopMargin(0);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(0, 0, 0);
$pdf->SetAutoPageBreak(TRUE, 0);
//if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//    require_once(dirname(__FILE__) . '/lang/eng.php');
//    $pdf->setLanguageArray($l);
//}
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->SetFont('times', '', 20);
$pdf->AddPage('L', 'A4');
$pdf->setPage(1, true);
$pdf->SetY(13);
$html1 = <<<EOD
<table border="0">
<tr>
<td></td>
</tr>
</table>
EOD;
$pdf->writeHTMLCell(200, 0, '', '0', $html1, 0, 0, 0, true, '', true);
$html2 = <<<EOD
<table border="0">
<tr>
<td width="700"></td>
<td width="200"></td>
</tr>
</table>
EOD;
$pdf->writeHTMLCell(50, 0, '20', '10', $html2, 0, 1, 0, true, '', true);
//$Name = $_SESSION['name'];
//$EventName = $_SESSION['event_name'];
//$AttendedHours = $_SESSION['AttendedHours'];
$html3 = <<<EOD
<table border="0">
<tr>
<td width="230"></td>
<td width="600" style="text-align:center;"><p style="color:#b7a900; font-size:35px;"><strong> Volunteer Certificate </strong></p>
The Saudi Cancer Foundation certifies that
<p style="color:#b7a900;"><strong> $Name </strong></p>
<p> had contributed in the organization of $EventName event for $AttendedHours hours </p>
</td>
</tr>
</table>
<br><br><br><br><br>
EOD;
$pdf->writeHTMLCell(5, 0, '0', '75', $html3, 0, 1, 0, true, '', true);
$html4 = <<<EOD
<table border="0">
<tr>
<td width="100"></td>
<td width="400">
	<hr style="text-align:center;" width="170">
	<span style="font-size:22px; color:#b7a900;"> Dr. Name Family </span>
	<br style="font-size:18px; color:#b7a900;"> Dean - Deanship of Volunteer Department
</td>
</tr>
</table>
<br><br>
EOD;
$pdf->writeHTMLCell(50, 0, '140', '170', $html4, 0, 1, 0, true, 'C', true);
$pdf->lastPage();
$filename = 'Certificate11.pdf';
$pdf->Output($filename, 'I');
