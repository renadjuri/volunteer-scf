<?php
//============================================================+
// File name   : example_028.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 028 for TCPDF class
//               Changing page formats
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: changing page formats
 * @author Nicola Asuni
 * @since 2008-03-04
 */

//session_start();
// step 1: connect to database

include($_SERVER['DOCUMENT_ROOT']."/volunteer-scf/includes/connection.php"); //connecting to the database

//  set sql encoding
//mysqli_query($con, "SET NAMES 'utf-8'");  
//$SqlEncoding=mysqli_client_encoding($con);
//$SqlEncoding = mysqli_character_set_name($con);
 
$event_id = $_GET['event_id']; //$selectEvent
$volunteer_id = $_GET['volunteer_id'];
//echo "event_id".$event_id;
//echo "volunteer_id". $volunteer_id;
//query to retrieve volunteer name 
$query = "SELECT FirstName ,MiddleName ,LastName FROM volunteer WHERE VolunteerID= $volunteer_id";

//$result = mysqli_query($con, $query);
if ( !$result = mysqli_query($con, $query)){
	die ("Error While Execute Query 1 ". mysqli_error($con));}

$row = mysqli_fetch_row ($result);


//query to retrieve event name
$query2 = "SELECT EventName FROM event WHERE EventID = $event_id";

if ( !$result2 = mysqli_query($con, $query2)){
	die ("Error While Execute Query 2 ".mysql_error($con));}

$row2 = mysqli_fetch_row ($result2);


// Attended_hours//00000
$query3 = "SELECT (SUM(EndingHour - StartingHour)DIV 10000) FROM volunteerparticipateonevent WHERE Volunteer_ID= '$volunteer_id' and Event_ID= '$event_id'";

if ( !$result3 = mysqli_query($con, $query3)){
	die ("Error While Execute Query 3 ".mysql_error($con));}

$row3 = mysqli_fetch_row ($result3);	
$AttendedHours = $row3[0];
$AttendedHours = number_format($AttendedHours,0);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Certificate');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetTopMargin(0);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(0, 0, 0);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');

// set font
$pdf->SetFont('times', '', 20);

//$mm="UOD Logo";
//landscape - A4
$pdf->AddPage('L', 'A4');

// --- test backward editing ---

$pdf->setPage(1, true);
$pdf->SetY(13);


$html1 = <<<EOD
<table border="0">
<tr>
<td><img src="images\CertF2.png" height="21cm"></td>
</tr>
</table>
EOD;
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$pdf->writeHTMLCell(200, 0, '', '0',$html1, 0, 0, 0, true, '', true);

$html2 = <<<EOD
<table border="0">
<tr>
<td width="700"></td>
<td width="200"><img src="images\CertificateLogo.png"></td>
</tr>
</table>
EOD;
		
	$pdf->writeHTMLCell(50, 0, '20', '10',$html2, 0, 1, 0, true, '', true);

$html3 = <<<EOD
<table border="0">
<tr>
<td width="230"></td>
<td width="600" style="text-align:center;"><p style="color:#b7a900; font-size:35px;"><strong> Volunteer Certificate </strong></p>
The Saudi Cancer Foundation certifies that
<p style="color:#b7a900;"><strong> $row[0] $row[1] $row[2] </strong></p>
<p> had contributed in the organization of $row2[0] event for $AttendedHours hours </p>
</td>
</tr>
</table>
<br><br><br><br><br>
EOD;

	$pdf->writeHTMLCell(5, 0, '0', '75',$html3, 0, 1, 0, true, '', true);
	
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

	$pdf->writeHTMLCell(50, 0, '140', '170',$html4, 0, 1, 0, true, 'C', true);
	
$pdf->lastPage();

// ---------------------------------------------------------
$filename='Certificate.pdf';
//Close and output PDF document
$pdf->Output($filename, 'I');

//============================================================+
// END OF FILE
//============================================================+
