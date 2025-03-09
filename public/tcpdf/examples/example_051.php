<?php
//============================================================+
// File name   : example_051.php
// Begin       : 2009-04-16
// Last Update : 2013-05-14
//
// Description : Example 051 for TCPDF class
//               Full page background
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
 * @abstract TCPDF - Example: Full page background
 * @author Nicola Asuni
 * @since 2009-04-16
 * @group background
 * @group page
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('../../tcpdf/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	
	private $currentPage;

	public function setCurrentPage($currentPage) {
		$this->currentPage = $currentPage;
	}
	
	public function Header() {
		// get the current page break margin
		$bMargin = $this->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;
		// disable auto-page-break
		$pageNo = $this->getAliasNumPage();
		$this->setAutoPageBreak(false, 0);
$this->Image('../../users/user-img.png', null, 23, 33, 0, '', '', '', false, 0, 'C', false, false, 0);
$this->Image('../../users/A002.png', null, 0, 55, 85, '', '', '', false, 0, 'C', false, false, 0);

		//$this->setPageMark();
	}
}


$pdf = new MYPDF('P', 'mm', array(55, 85), true, 'UTF-8', false);


// set margins
$pdf->setMargins(0, 0, 0);
$pdf->setHeaderMargin(0);
$pdf->setFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// ---------------------------------------------------------

// set font
$pdf->setFont('skyb', '', 48);

// add a page
$pdf->AddPage();
//$pdf->setCurrentPage(1);
// Print a text
$pdf->SetY(53);

$html = '<p style="font-family:arialb;font-weight:bold;font-size:10pt;text-align: center;">رامى بن محمد بن صادق ابولبن</p>';
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->SetY(58);
$html = '<p style="font-family:arialb;font-weight:bold;font-size:10pt;text-align: center;">رئيس وحدة البوابة الإلكترونية والجوال</p>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetY(80);
$html = '<p style="font-family:arialb;font-weight:bold;font-size:13pt;text-align: center;">11734</p>';
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->AddPage();
$pdf->Image('../../users/card_back.png', null, 0, 55, 85, '', '', '', false, 0, 'C', false, false, 0);

//$pdf->setCurrentPage(2);
$pdf->SetY(58);
$html = '<p style="font-family:arialb;font-weight:bold;font-size:10pt;text-align: center;">xxxxx</p>';
$pdf->writeHTML($html, true, false, true, false, '');
// new style
$style = array(
	'border' => false,
	'padding' => 0,
	'fgcolor' => array(1,105,58),
	'bgcolor' => false
);

// QRCODE,H : QR-CODE Best error correction
$pdf->write2DBarcode('https://hmm.gov.sa/', 'QRCODE,H', 20,65, 14, 14, $style, 'N');
$pdf->Text(72, 22, 'QRCODE H - NO PADDING');

//Close and output PDF document
$pdf->Output('example_051.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
