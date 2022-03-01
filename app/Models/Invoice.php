<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MYPDF;

class Invoice extends Model
{
    use HasFactory;

    protected $casts = [
        'meta' => 'array',
        'items' => 'array',
        'date' => 'datetime'
    ];

    // ATTRIBUTES
    public function getBaseAttribute() {
        return $this->meta['base'] ?? 0;
    }
    public function setBaseAttribute( $value ) {
        $meta = $this->meta;
        $meta['base'] = $value;
        $this->meta = $meta;
    }
    public function getIvasAttribute() {
        return $this->meta['ivas'] ?? null;
    }
    public function setIvasAttribute( $value ) {
        $meta = $this->meta;
        $meta['ivas'] = $value;
        $this->meta = $meta;
    }
    public function getShippingAttribute() {
        return $this->meta['shipping'] ?? 0;
    }
    public function setShippingAttribute( $value ) {
        $meta = $this->meta;
        $meta['shipping'] = $value;
        $this->meta = $meta;
    }

    // METHODS
    public static function createOrderInvoice( Order $order ) {
        $invoice = Invoice::latest()->first();
        $new_id = $invoice ? $invoice->id+1 : 1;
        $invoice = new Invoice();
        $invoice->reference = 'W-'.date('Y').sprintf('%04d', $new_id);
        $invoice->date = today();
        $invoice->order_id = $order->id;
        $invoice->user_id = $order->user_id;
        $invoice->name = $order->invoice_name;
        $invoice->nif = $order->invoice_nif;
        $invoice->address = $order->invoice_address;
        $invoice->city = $order->invoice_city;
        $invoice->zip = $order->invoice_zip;
        $items = [];
        foreach( json_decode($order->items,true) as $item ) {
            if( $item['id'] ) {
                $product = Product::find($item['id']);
                $item['tax'] = $product->tax_type;
            } else {
                $item['tax'] = '10';
            }
            $items[] = $item;
        }
        $invoice->items = json_encode($items);
        $invoice->meta = $order->meta;
        $invoice->total = $order->total;
        $invoice->save();
        $invoice->reference = 'W-'.date('Y').sprintf('%04d', $invoice->id);
        $invoice->save();
        return $invoice;
    }

    public static function createWebInvoice( $month=null, $year=null ) {
        $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        if( $month == null ) {
            $m = now()->format('m')+1-1;
            $month = ( $m == 1 ) ? 12 : $m-1;
        }
        if( $year == null ) {
            $year = now()->format('Y');
            if( $month == 12 )
                $year--;
        }
        $invoice_name = 'Ventas Web '.$months[$month-1].' '.$year;
        $invoice = Invoice::where('name',$invoice_name)->get()->first();
        if( $invoice )
            return $invoice;
        /*
        Agrupar por producto, cantidad total y precio total
        */
//$month = 2;
        $orders = Order::where('status','complete')->whereMonth('created_at',$month)->whereYear('created_at',$year)->where('invoice',null)->get();
        //print "$month - $year \n";
        $shipping = 0;
        $lines = array();
        foreach( $orders as $order ) {
            //echo $order->created_at.' '.$order->reference.' '.$order->shipping.' '.$order->coupon_value.' '.$order->total."\n";
            $shipping += $order->shipping;
            $items = json_decode($order->items,true);
            foreach( $items as $item ) {
                $amount = $item['price']*$item['qty']*(100-$order->coupon_value)/100;
                $name = $item['id'] ? Product::find($item['id'])->getLocalizedName('es') : 'Dedicatoria';
                $tax_type = ($item['id'] ? Product::find($item['id'])->tax_type : 21) ?: 21;
                //echo '    '.$item['id'].' '.strtoupper($name).' '.$item['qty'].' '.$tax_type.'% '.number_format($amount,2)."€\n";
                if( isset($lines[$item['id']]) ) {
                    $lines[$item['id']] = array('name'=>$name, 'qty'=>$lines[$item['id']]['qty']+$item['qty'], 'tax'=>$tax_type, 'total'=>$lines[$item['id']]['total']+$amount);
                } else {
                    $lines[$item['id']] = array( 'name'=>$name, 'qty'=>$item['qty'], 'tax'=>$tax_type, 'total'=>$amount );
                }
            }
        }
        $base = $total = 0;
        $ivas = array();
        foreach( $lines as $line ) {
            $amount = $line['total']*(100-$line['tax'])/100;
            $base += $amount;
            $total += $line['total'];
            if( isset( $ivas[$line['tax']]) ) {
                $ivas[$line['tax']] += $line['total']-$amount;
            } else {
                $ivas[$line['tax']] = $line['total']-$amount;
            }
            //printf( "%-100s %3d %2d%% %3.2f€ %3.2f€ %3.2f€\n",$line['name'],$line['qty'],$line['tax'],$line['total']-$amount,$amount,$line['total']);
        }
        //printf("Base imponible %3.2f€\n",$base);
        //printf("Gastos envío %3.2f€\n",$shipping*0.79);
        if( isset( $ivas[21]) ) {
            $ivas[21] += $shipping*0.21;
        } else {
            $ivas[21] = $shipping*0.21;
        }
        foreach($ivas as $key => $value ) {
            //printf("IVA %d%% %3.2f€\n", $key, $value );
        }
        //printf("Total %3.2f€\n",$total+$shipping);

        // Proceed to creation
        $invoice = Invoice::latest()->first();
        $new_id = $invoice ? $invoice->id+1 : 1;
        $invoice = new Invoice();
        $invoice->ivas = $ivas;
        $invoice->base = $base;
        $invoice->shipping = $shipping;
        $invoice->reference = 'W-'.date('Y').sprintf('%04d', $new_id);
        $invoice->date = today();
        $invoice->order_id = 0;
        $invoice->user_id = 0;
        $invoice->name = $invoice_name;
        $invoice->nif = '';
        $invoice->address = '';
        $invoice->city = '';
        $invoice->zip = '';
        $invoice->items = json_encode($lines);
        $invoice->total = $total+$shipping;
        $invoice->save();
        $invoice->reference = 'W-'.date('Y').sprintf('%04d', $invoice->id);
        $invoice->save();
        return $invoice;
    }


    public function getDocument() {
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setDocument('FACTURA');
        $pdf->SetCreator('rosistirem.com');
        $pdf->SetAuthor('ROSISTIREM S.L.');
        $pdf->SetTitle('FACTURA');
        $pdf->SetSubject($this->reference);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(0);
        $pdf->SetAutoPageBreak(FALSE, 0);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->AddPage();
        $pdf->SetFont('SegoeCondensed','',8);
        // WATERMARK
        $pdf->SetAlpha(0.1);
        $pdf->Image(storage_path('imagotipo_bw.png'), 10, 40, 200, 200, '', '', 'C', true, 300);
        $pdf->SetAlpha(1);

        $order = Order::find($this->order_id);

        // ADDRESSEE
        $pdf->SetFont('','',10);
        $pdf->SetXY(15,40);
        $pdf->Cell(110, 8, $this->name, '', 0, 'L');
        $pdf->SetXY(15,45);
        $pdf->Cell(110, 8, $this->nif, '', 0, 'L');
        $pdf->SetXY(15,50);
        $pdf->Cell(110, 8, $this->address, '', 0, 'L');
        $pdf->SetXY(15,55);
        $pdf->Cell(110, 8, $this->zip.' - '.$this->city, '', 0, 'L');
        
        
        // ORDER INFO
        $pdf->SetXY(122,40);
        $pdf->SetFont('','',8);
        $pdf->Cell(30, 8, 'FACTURA Nº:', '', 0, 'L');
        $pdf->SetFont('','',10);
        $pdf->Cell(30, 8, $this->reference, '', 0, 'L');
        $pdf->SetXY(122,45);
        $pdf->SetFont('','',8);
        $pdf->Cell(30, 8, 'FECHA FACTURA:', '', 0, 'L');
        $pdf->SetFont('','',10);
        $pdf->Cell(30, 8, $this->date->format('d-m-Y'), '', 0, 'L');
        if( $order ) {
            $pdf->SetXY(122,52);
            $pdf->SetFont('','',8);
            $pdf->Cell(30, 8, 'PEDIDO Nº:', '', 0, 'L');
            $pdf->SetFont('','',10);
            $pdf->Cell(30, 8, $order->reference, '', 0, 'L');
            $pdf->SetXY(122,57);
            $pdf->SetFont('','',8);
            $pdf->Cell(30, 8, 'FECHA PEDIDO:', '', 0, 'L');
            $pdf->SetFont('','',10);
            $pdf->Cell(30, 8, $order->created_at->format('d-m-Y'), '', 0, 'L');
            $pdf->SetXY(122,62);
            $pdf->SetFont('','',8);
            $pdf->Cell(30, 8, 'FORMA DE PAGO:', '', 0, 'L');
            $pdf->SetFont('','',10);
            $pdf->Cell(30, 8, 'TARJETA', '', 0, 'L');
        }

        // INVOICE DETAIL
        $pdf->SetFont('','',8);
        $pdf->SetXY(15,90);
        $pdf->Cell(120, 6, 'PRODUCTO', 'B', 0, 'L');
        $pdf->Cell(20, 6, 'CANTIDAD', 'B', 0, 'C');
        $pdf->Cell(20, 6, 'I.V.A.', 'B', 0, 'C');
        $pdf->Cell(20, 6, 'TOTAL', 'B', 0, 'R');
        $y = 95;
        $items = json_decode($this->items,true);
        $total = 0;
        foreach( $items as $item  ) {
            $name = $item['name'];
            $pdf->SetXY(15,$y);
            $pdf->Cell(120, 8, strtoupper($name), '', 0, 'L');
            $pdf->Cell(20, 8, $item['qty'], '', 0, 'C');
            $pdf->Cell(20, 8, $item['tax'].'%', '', 0, 'C');
            $pdf->Cell(20, 8, number_format($item['total'],2).' €', '', 0, 'R');
            $y+=5;
        }
        // TOTALS
        $y+=2;
        $pdf->SetXY(15,$y);
        $pdf->Cell(140, 6, '', 'T', 0, 'L');
        $pdf->SetFont('SegoeCondensed','B',8);
        $pdf->Cell(20, 6, 'BASE IMPONIBLE:', 'T', 0, 'L');
        $pdf->Cell(20, 6, number_format($this->base,2).' €', 'T', 0, 'R');
        $y+=5;
        $pdf->SetXY(155,$y);
        $pdf->SetFont('SegoeCondensed','',8);
        $pdf->Cell(20, 6, 'ENVÍO:', '', 0, 'L');
        $pdf->Cell(20, 6, number_format($this->shipping,2).' €', '', 0, 'R');
        $y+=5;
        $ivas = $this->ivas;
        foreach($ivas as $key => $value ) {
            $pdf->SetXY(155,$y);
            $pdf->Cell(20, 6, 'I.V.A. '.$key.'%:', '', 0, 'L');
            $pdf->Cell(20, 6, number_format($value,2).' €', '', 0, 'R');
            $y+=4;
        }
        $y+=1;

/*        $pdf->SetXY(155,$y);
        $pdf->Cell(20, 6, 'I.V.A. 10%:', '', 0, 'L');
        $pdf->Cell(20, 6, '2,63 €', '', 0, 'R');
        $y+=4;
        $pdf->SetXY(155,$y);
        $pdf->Cell(20, 6, 'I.V.A. 21%:', '', 0, 'L');
        $pdf->Cell(20, 6, '0,00 €', '', 0, 'R');
        $y+=5;*/
        $pdf->SetXY(155,$y);
        $pdf->SetFont('SegoeCondensed','B',8);
        $pdf->Cell(20, 6, 'TOTAL:', 'T', 0, 'L');
        $pdf->Cell(20, 6, number_format($this->total,2).' €', 'T', 0, 'R');


        $pdf->Output($this->reference, 'D');
    }
}
