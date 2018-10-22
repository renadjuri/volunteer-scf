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

//include($_SERVER['DOCUMENT_ROOT']."/volunteer-scf/tcpdf/examples/lang/ara.php");
//  set sql encoding
mysqli_query($con, "SET NAMES 'utf-8'");  
//$SqlEncoding=mysqli_client_encoding($con);
$SqlEncoding = mysqli_character_set_name($con);
 
if (isset($_POST['CertificateSelection'])) {
        $volunteer_id = $_POST['VolunteerID'];
        $event_id = $_POST['EventID'];
}else{
$event_id = $_GET['event_id'];
$volunteer_id = $_GET['volunteer_id'];
}

//query to retrieve volunteer name 
$query = "SELECT FirstName, MiddleName, LastName FROM volunteer WHERE VolunteerID = $volunteer_id";

if ( ! $result = mysqli_query($con, $query))
	die ("Error While Execute Query ".mysqli_error($con));

$row = mysqli_fetch_row ($result);

//query to retrieve event name
$query2 = "SELECT EventName FROM event WHERE EventID = $event_id";

if ( ! $result2 = mysqli_query($con, $query2))
	die ("Error While Execute Query ".mysql_error($con));

$row2 = mysqli_fetch_row ($result2);


// Attended_hours//00000
$query3 = "SELECT (SUM(EndingHour - StartingHour)DIV 10000) FROM volunteerparticipateonevent WHERE Volunteer_ID=$volunteer_id and Event_ID=$event_id";

if ( ! $result3 = mysqli_query($con, $query3))
	die ("Error While Execute Query ".mysql_error($con));

$row3 = mysqli_fetch_row ($result3);	
$AttendedHours = $row3[0];
$AttendedHours = number_format($AttendedHours,0);

// Include the main TCPDF library (search for installation path).
if (!class_exists('TCPDF')) {
    //echo "inside tcpdf";
require_once ($_SERVER['DOCUMENT_ROOT'].'/volunteer-scf/tcpdf/tcpdf.php');
}
//require_once('tcpdf_include.php');
//require_once (dirname(__FILE__) . '/tcpdf_include.php');
// create new PDF document
if(!class_exists('TCPDF')){die('TCPDF could not be loaded. Abort!');}
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

$img_path=preg_replace('#/+#','/',"images/CertF2.png");
$html1 = <<<EOD
<table border="0">
<tr>
<td><img src="$img_path" height="21cm"></td>
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
//$pdf->SetFont('times', '', 20);
//To show names in Arabic
$pdf->SetFont('aealarabiya', '', 20);

$html3 = <<<EOD
<table border="0">
<tr>
<td width="230"></td>
<td width="600" style="text-align:center;"><p style="color:#b7a900; font-size:35px;"><strong> Volunteer Certificate </strong></p>
The Saudi Cancer Foundation certifies that
<p style="color:#b7a900;"><strong> $row[0] $row[1] $row[2] </strong></p>
<p> had contributed in the organization of <span>$row2[0]</span> event for $AttendedHours hours </p>
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
//Try sending the certificate to email
//sendMail();

//============================================================+
// END OF FILE
//============================================================
//function sendMail() {
// 
// 
// 
// 
// 
// // if (!isset ($_POST['to_email'])) { //Oops, forgot your email addy!
// //   die ("<p>Oops!  You forgot to fill out the email address! Click on the back arrow to go back</p>");
// // }
// // else {
//    //$to_name = "Incident Control ";
//    
//    //*******  VARIABLE SETUP  *******//
//    //$from_name = stripslashes($_POST['from_name']);
//    //$subject = stripslashes($_POST['subject']);
//    $filecount = 0;
//    
//    
//    
//    
//    //$body = stripslashes($_POST['body']);
//     
//  $to_email = ""; 
//    $attachment = $_FILES['attachment']['tmp_name'];
//    $attachment_name = $_FILES['attachment']['name']; 
//    $email = stripslashes($_POST['email']);
//    $subject = "Certificate";
//    //if ($impact != "3-Medium")
//    //    $to_email = "yyy@yyyy.com";
//    //else
//    //    $to_email = "xxxx@xxxx.com";
//    //*****  END VARIABLE SETUP  *****//
//    
//    foreach($_FILES as $file => $value) {
//      $attachment[(int)$filecount] = $_FILES[$file]['tmp_name'];
//      $attachment_name[(int)$filecount] = $_FILES[$file]['name']; 
//      if (is_uploaded_file($attachment[(int)$filecount])) { //Do we have a file uploaded?
//        $fp = fopen($attachment[(int)$filecount], "rb"); //Open it
//        $data[(int)$filecount] = fread($fp, filesize($attachment[(int)$filecount])); //Read it
//        $data[(int)$filecount] = chunk_split(base64_encode($data[(int)$filecount])); //Chunk it up and encode it as base64 so it can emailed
//        fclose($fp);
//        $filecount++;
//      } 
//    
// 
//    }
//    //Let's start our headers
// //   $headers = "From: $lanid<" . $_POST['email'] . ">\n";
//   // $headers .= "Reply-To: <" . $_POST['email'] . ">\n"; 
//    $headers = "MIME-Version: 1.0\n";
//    $headers .= "Content-Type: multipart/related; type=\"multipart/alternative\"; boundary=\"----=MIME_BOUNDRY_main_message\"\n"; 
//    $headers .= "X-Sender: $lanid<" . $_POST['email'] . ">\n";
//    $headers .= "X-Mailer: PHP4\n";
//    $headers .= "X-Priority: 3\n"; //1 = Urgent, 3 = Normal
//    $headers .= "Return-Path: <" . $_POST['email'] . ">\n"; 
//    $headers .= "This is a multi-part message in MIME format.\n";
//    $headers .= "------=MIME_BOUNDRY_main_message \n"; 
//    $headers .= "Content-Type: multipart/alternative; boundary=\"----=MIME_BOUNDRY_message_parts\"\n"; 
//    
//    $message = "------=MIME_BOUNDRY_message_parts\n";
//    $message .= "Content-Type: text/html; charset=\"iso-8859-1\"\n"; 
//    $message .= "Content-Transfer-Encoding: quoted-printable\n"; 
//    $message .= "\n"; 
//    /* Add our message, in this case it's plain text.  You could also add HTML by changing the Content-Type to text/html */
//    //$message .= "$body\n";
//    $message .= "<b><u>Contact Details</u></b>";
//    $message .= "<b>Requestor E-mail:</b>  " . $email  . "";
//
//    $message .= "<b><u>Impact Information</u></b>";        
//    $message .= "\n"; 
//    $message .= "------=MIME_BOUNDRY_message_parts--\n"; 
//    $message .= "\n"; 
//    for ($i = 0, $filecount = (int) count($data); $i < $filecount; $i++) {
//    $message .= "------=MIME_BOUNDRY_main_message\n"; 
//    $message .= "Content-Type: application/octet-stream;\n\tname=\"" . $attachment_name . "\"\n";
//    $message .= "Content-Transfer-Encoding: base64\n";
//    $message .= "Content-Disposition: attachment;\n\tfilename=\"" . $attachment_name . "\"\n\n";
//    $message .= (isset($data)); //The base64 encoded message
//    $message .= "\n"; 
//    }
//    $message .= "------=MIME_BOUNDRY_main_message--\n"; 
// 
//    // send the message
//    mail("$to_email", $subject, $message, $headers); 
//    print "Ticket Request Sent.  Thank you.";
//    
//}