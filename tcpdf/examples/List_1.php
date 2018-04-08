<?php
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
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
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

session_start();
// step 1: connect to database
if (! ( $database = mysql_connect ("localhost","root","")) )
die ("Cann't connect to database");

// setcharset to utf-8
if(mysql_set_charset('utf8',$database))  

// step 2: open database
if ( ! ( mysql_select_db ( "ara" ,$database )))
die ("Cann't open database ");

//  set sql encoding
mysql_query("SET NAMES 'utf-8'");  
$SqlEncoding=mysql_client_encoding($database);  

$AID = $_GET['AID'];

//step 3: send query to Database
$query2 = "SELECT Name FROM faculty WHERE username IN (SELECT username FROM registration WHERE AID=".$AID.")";
		if ( ! ( $result2 = mysql_query ( $query2 , $database)))
			die ("Error while execute query, The Error is: ".mysql_error ());

$query3 = "SELECT Name FROM activity WHERE AID=".$AID."";
		if ( ! ( $result3 = mysql_query ( $query3 , $database)))
			die ("Error while execute query, The Error is: ".mysql_error ());

$row = mysql_fetch_row ($result3);					
		

			
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($row[0]);
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$row3 = mysql_fetch_array($result3);

$ActName [] = $row3[0];

//query to get activity name and place
$query1 = "SELECT Name FROM activity WHERE AID=".$AID."";

			// execute query 1		
		if ( ! ( $result1 = mysql_query ( $query1 , $database)))
					die ("Error while execute query, The Error is: ".mysql_error ());
		
			//store query1 result (activity name)
		$row1 = mysql_fetch_row ($result1);

		
		
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins

$pdf->SetMargins(20, 10, 20);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();

	if ( ! ( $result2 = mysql_query ( $query2 , $database)))
			die ("Error while execute query, The Error is: ".mysql_error ());

		
$i=1;		
	while ($row2 = mysql_fetch_row ($result2))
{
			$Name[$i] = "&nbsp;&nbsp;&nbsp;&nbsp;".$i.".&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row2[0]."";	
	$i++;		
}

$html1 = <<<EOD
<table border="0">
	<tr style="font-size:12px;">
		<td><br>Kingdom of Saudi Arabia<br>University of Dammam <br>Deanship of Education Development</td>
		<td><br><br><br style="text-align:center; color:#026a8e; font-size:16px;"> Participants </td>
		<td style="text-align:right;"><br><img src="images\UOD_Logo_CertificatePAge.png" width="100"></td>
	</tr>
</table>
<br><hr>
<p style="text-align:center; font-size:18px;"><strong>$row[0]</strong></p>
EOD;
		
	$pdf->writeHTMLCell(0, 0, '', '',$html1, 0, 1, 0, true, '', true);

	
$html2 = <<<EOD
<br>
EOD;
	$pdf->writeHTMLCell(0, 0, '', '',$html2, 0, 1, 0, true, '', true);

$m=1;


	$pdf->writeHTMLCell(0, 0, '', '', "<br style='font-size:18px;'><strong>List of Participants:</strong><br>", 0, 1, 0, true, '', true);
	
// Print text using writeHTMLCell()
for ($m=1 ; $m<=mysql_num_rows($result2) ; $m++)
{

	$pdf->writeHTMLCell(0, 0, '', '',$Name[$m] , 0, 1, 0, true, '', true);
	$pdf->writeHTMLCell(0, 0, '', '',"<br>" , 0, 1, 0, true, '', true);
}


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output(''.$row[0].' List of Participats.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
