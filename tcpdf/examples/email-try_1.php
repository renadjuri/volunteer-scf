<?php
//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2008-05-28
// 
// Description : Example 011 for TCPDF class
//               Colored Table
// 
// Author: Nicola Asuni
// 
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+
 
/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @copyright 2004-2008 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2008-03-04
 */
 
//require_once('../config/lang/eng.php');
//require_once('../tcpdf.php');
 
// extend TCPF with custom functions
//class MYPDF extends TCPDF {
	
	//Load table data from file
	function LoadData($file) {
		//Read file lines
		$lines=file($file);
		$data=array();
		foreach($lines as $line)
		$data[]=explode(';',chop($line));
		return $data;
	}
	
	//Colored table
	function ColoredTable($header,$data) {
		//Colors, line width and bold font
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		//Header
		$w=array(50,35/*,40,45*/);
		for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
		$this->Ln();
		//Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		//Data
		$fill=0;
		foreach($data as $row) {
			$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
//			$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
//			$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w),0,'','T');
	}
//}------------------------------------------------------------------------------------------------
require_once('tcpdf_include.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true); 
 
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("Jeremy");
$pdf->SetTitle("Testing Job App");
$pdf->SetSubject("Job App");
$pdf->SetKeywords("Job App, PDF, example, test, guide");
 
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
 
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
 
//set some language-dependent strings
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
//$pdf->setLanguageArray($l); 
 
//initialize document
$pdf->AliasNbPages();
 
// add a page
$pdf->AddPage();
 
// ---------------------------------------------------------
 
// set font
$pdf->SetFont("vera", "", 12);
 
//Column titles
$header=array($_POST["message"],'Capital'/*,'Area (sq km)','Pop. (thousands)'*/);
 
//Data loading
$data=$pdf->LoadData('../cache/table_data_demo2.txt');
 
// print colored table
$pdf->ColoredTable($header,$data);
 
// ---------------------------------------------------------
 
//Close and output PDF document
$pdf->Output("example_011.pdf", "I");
sendMail();
 
//$sendTo = "abass3@roadrunner.com";
//$subject = "My Flash site reply";
//
//// variables are sent to this PHP page through
//// the POST method.  $_POST is a global associative array
//// of variables passed through this method.  From that, we
//// can get the values sent to this page from Flash and
//// assign them to appropriate variables which can be used
//// in the PHP mail() function.
//
//
//// header information not including sendTo and Subject
//// these all go in one variable.  First, include From:
//$headers = "From: " . $_POST["firstName"] ." ". $_POST["lastname"] . "<" . $_POST["email"] .">\r\n";
//// next include a replyto
//$headers .= "Reply-To: " . $_POST["email"] . "\r\n";
//// often email servers won't allow emails to be sent to
//// domains other than their own.  The return path here will
//// often lift that restriction so, for instance, you could send
//// email to a hotmail account. (hosting provider settings may vary)
//// technically bounced email is supposed to go to the return-path email
//$headers .= "Return-path: " . $_POST["email"];
//
//// now we can add the content of the message to a body variable
//$message = Output("example_011.pdf", "I");
//
//
//// once the variables have been defined, they can be included
//// in the mail function call which will send you an email
//mail($sendTo, $subject, $message, $headers);
////============================================================+
//// END OF FILE                                                 
////============================================================+
function sendMail() {
 
 
 
 
 
 // if (!isset ($_POST['to_email'])) { //Oops, forgot your email addy!
 //   die ("<p>Oops!  You forgot to fill out the email address! Click on the back arrow to go back</p>");
 // }
 // else {
    //$to_name = "Incident Control ";
    
    //*******  VARIABLE SETUP  *******//
    //$from_name = stripslashes($_POST['from_name']);
    //$subject = stripslashes($_POST['subject']);
    $filecount = 0;
    
    
    
    
    //$body = stripslashes($_POST['body']);
     
  $to_email = "abass3@roadrunner.com"; 
    $attachment = $_FILES['attachment']['tmp_name'];
    $attachment_name = $_FILES['attachment']['name']; 
    $lanid = stripslashes($_POST['lanid']);
    $email = stripslashes($_POST['email']);
    $contact = stripslashes($_POST['contact']);
    $contactphone = stripslashes($_POST['contactphone']);
    $lan1 = stripslashes($_POST['lan1']);
    $lan2 = stripslashes($_POST['lan2']);
    $lan3 = stripslashes($_POST['lan3']);
    $lan4 = stripslashes($_POST['lan4']);
    $workstation1 = stripslashes($_POST['workstation1']);
    $workstation2 = stripslashes($_POST['workstation2']);
    $workstation3 = stripslashes($_POST['workstation3']);
    $workstation4 = stripslashes($_POST['workstation4']);
    $appid1 = stripslashes($_POST['appid1']);
    $appid2 = stripslashes($_POST['appid2']);
    $appid3 = stripslashes($_POST['appid3']);
    $appid4 = stripslashes($_POST['appid4']);
    $account1 = stripslashes($_POST['account1']);
    $account2 = stripslashes($_POST['account2']);
    $account3 = stripslashes($_POST['account3']);
    $account4 = stripslashes($_POST['account4']);
    $appname = stripslashes($_POST['appname']);
    $numusers = stripslashes($_POST['numusers']);
    $location = stripslashes($_POST['location']);
    $dept = stripslashes($_POST['dept']);
    $error = stripslashes($_POST['error']);
    $occurs = stripslashes($_POST['occurs']);
    $impact = $_POST['impact'];
    $impactdesc = stripslashes($_POST['impactdesc']);
    $workaround = stripslashes($_POST['workaround']);
    $subject = $impact . " Impact Ticket Request.";
    //if ($impact != "3-Medium")
    //    $to_email = "yyy@yyyy.com";
    //else
    //    $to_email = "xxxx@xxxx.com";
    //*****  END VARIABLE SETUP  *****//
    
    foreach($_FILES as $file => $value) {
      $attachment[(int)$filecount] = $_FILES[$file]['tmp_name'];
      $attachment_name[(int)$filecount] = $_FILES[$file]['name']; 
      if (is_uploaded_file($attachment[(int)$filecount])) { //Do we have a file uploaded?
        $fp = fopen($attachment[(int)$filecount], "rb"); //Open it
        $data[(int)$filecount] = fread($fp, filesize($attachment[(int)$filecount])); //Read it
        $data[(int)$filecount] = chunk_split(base64_encode($data[(int)$filecount])); //Chunk it up and encode it as base64 so it can emailed
        fclose($fp);
        $filecount++;
      } 
    
 
    }
    //Let's start our headers
    $headers = "From: $lanid<" . $_POST['email'] . ">\n";
    $headers .= "Reply-To: <" . $_POST['email'] . ">\n"; 
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/related; type=\"multipart/alternative\"; boundary=\"----=MIME_BOUNDRY_main_message\"\n"; 
    $headers .= "X-Sender: $lanid<" . $_POST['email'] . ">\n";
    $headers .= "X-Mailer: PHP4\n";
    $headers .= "X-Priority: 3\n"; //1 = Urgent, 3 = Normal
    $headers .= "Return-Path: <" . $_POST['email'] . ">\n"; 
    $headers .= "This is a multi-part message in MIME format.\n";
    $headers .= "------=MIME_BOUNDRY_main_message \n"; 
    $headers .= "Content-Type: multipart/alternative; boundary=\"----=MIME_BOUNDRY_message_parts\"\n"; 
    
    $message = "------=MIME_BOUNDRY_message_parts\n";
    $message .= "Content-Type: text/html; charset=\"iso-8859-1\"\n"; 
    $message .= "Content-Transfer-Encoding: quoted-printable\n"; 
    $message .= "\n"; 
    /* Add our message, in this case it's plain text.  You could also add HTML by changing the Content-Type to text/html */
    //$message .= "$body\n";
    $message .= "<b><u>Contact Details</u></b>";
    $message .= "<b>Requestor:</b>  " . $lanid . "";
    $message .= "<b>Requestor E-mail:</b>  " . $email  . "";
    $message .= "<b>Contact Person:</b>  " . $contact .  "";
    $message .= "<b>Must Answer #:</b>  " . $contactphone . "";
    $message .= "<b><u>Incident Information</u></b>";
    $message .= "<b>Application:</b>  " . $appname . "";
    $message .= "<b># of Users Impacted:</b>  " . $numusers . "";
    $message .= "<b>Location of Users:</b>  " . $location . "";
    $message .= "<b>Department:</b>  " . $dept . "";
    $message .= "<b>Error Message:</b>  " . $error . "";
    $message .= "<b>Error Occurs When:</b>  " . $occurs . "";
    $message .= "<b><u>Example ID's</u></b>";
    $message .= "<table border='0' cellpadding='5' cellspacing='0'>";
    $message .= "<tr valign='top'><td>LAN ID</td><td>Workstation</td><td>Application ID</td><td>Account Example</td></tr>";
    $message .= "<tr valign='top'><td>" . $lan1 . "</td><td>" . $workstation1 . "</td><td>" . $appid1 . "</td><td>" . $account1 . "</td></tr>";
    $message .= "<tr valign='top'><td>" . $lan2 . "</td><td>" . $workstation2 . "</td><td>" . $appid2 . "</td><td>" . $account2 . "</td></tr>";
    $message .= "<tr valign='top'><td>" . $lan3 . "</td><td>" . $workstation3 . "</td><td>" . $appid3 . "</td><td>" . $account3 . "</td></tr>";
    $message .= "<tr valign='top'><td>" . $lan4 . "</td><td>" . $workstation4 . "</td><td>" . $appid4 . "</td><td>" . $account4 . "</td></tr>";        
    $message .= "</table>";
    $message .= "<b><u>Impact Information</u></b>";    
    $message .= "<b>WTS Requested Impact:</b>  " . $impact . "";
    $message .= "<b>Impact Description:</b>  " . $impactdesc . "";
    $message .= "<b>Workaround:</b>  " . $workaround . "";
    
    
    
    $message .= "\n"; 
    $message .= "------=MIME_BOUNDRY_message_parts--\n"; 
    $message .= "\n"; 
    for ($i = 0, $filecount = (int) count($data); $i < $filecount; $i++) {
    $message .= "------=MIME_BOUNDRY_main_message\n"; 
    $message .= "Content-Type: application/octet-stream;\n\tname=\"" . $attachment_name . "\"\n";
    $message .= "Content-Transfer-Encoding: base64\n";
    $message .= "Content-Disposition: attachment;\n\tfilename=\"" . $attachment_name . "\"\n\n";
    $message .= (isset($data)); //The base64 encoded message
    $message .= "\n";
    }
    $message .= "------=MIME_BOUNDRY_main_message--\n"; 
 
    // send the message
    mail("$to_email", $subject, $message, $headers); 
    print "Ticket Request Sent.  Thank you.";
    
    
    
    
    
  }
 
?>