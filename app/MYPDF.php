<?php

namespace App;

use TCPDF;
use Illuminate\Support\Str;

class MYPDF extends TCPDF {
    protected $document = 'ALBARÁN';

    public function setDocument( $name ) {
        $this->document = $name;
    }

    public function Header() {
        $this->Image(storage_path('logo.png'), 10, 10, 60, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetXY(10,10);
        $this->SetFont('SegoeCondensed','B',18);
        $this->Cell(185, 17, $this->document, '', 0, 'R');

        $this->SetFont('helvetica', '', 6);
		$this->StartTransform();
		$this->Rotate(90, 7, 258);
		$this->Text(7, 258, 'ROSISTIREM S.L Inscrita en el Registro Mercantíl de Barcelona, Tomo 47310, Folio 53, Hoja 489628 - Carrer Rull, 3 08002 Barcelona - NIF: B67622241');
		$this->StopTransform();

    }

    public function Footer() {
        $style = array(
            'border' => 0,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
        //$this->write2DBarcode('rosistirem.com/shipping/'.Str::uuid(), 'QRCODE,H', 150, 243, 50, 50, $style, 'N');
    }
}