<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MYPDF;

class Order extends Model
{
    use HasFactory;

    const STATUS_OPEN = 'open';
    const STATUS_PROCESSING = 'processing';
    const STATUS_FAILED = 'failed';
    const STATUS_COMPLETE = 'complete';

    public $delivery_type = [
        'Desconocido','Hoy','Siguiente Laborable Mañana','Siguiente Laborable Tarde','Dia determinado Mañana','Dia Determinado Tarde'
    ];

    protected $fillable = [
        'reference',
        'user_id',
        'email',
        'status',
        'courier',
        'sender',
        'addressee',
        'invoice',
        'transaction',
        'items',
        'meta',
        'total'
    ];

    protected $casts = [
        'sender' => 'array',
        'addressee' => 'array',
        'invoice' => 'array',
        'meta' => 'array',
    ];
    // ATTRIBUTES
	public function getStatusColorAttribute() {
		return [
			'open' => 'primary',
			'processing' => 'primary',
		][$this->status] ?? 'success';
	}
    public function getCourierPhoneAttribute() {
        return '666852210';
    }
    public function getTrackingNoAttribute() {
        return $this->meta['trackingNo'] ?? '';
    }
    public function setTrackingNoAttribute( $value ) {
        $d = $this->meta;
        $d['trackingNo'] = $value;
        $this->meta = $d;
    }
    public function getSenderNameAttribute() {
        return $this->sender['name'] ?? '';
    }
    public function setSenderNameAttribute( $value ) {
        $sender = $this->sender;
        $sender['name'] = $value;
        $this->sender = $sender;
    }
    public function getSenderPhoneAttribute() {
        return $this->sender['phone'] ?? '';
    }
    public function setSenderPhoneAttribute( $value ) {
        $sender = $this->sender;
        $sender['phone'] = $value;
        $this->sender = $sender;
    }
    public function getSenderNewsletterAttribute() {
        return $this->sender['newsletter'] ?? false;
    }
    public function setSenderNewsletterAttribute( $value ) {
        $sender = $this->sender;
        $sender['newsletter'] = $value ? true : false;
        $this->sender = $sender;
    }
    public function getSenderInvoiceAttribute() {
        return $this->sender['invoice'] ?? false;
    }
    public function setSenderInvoiceAttribute( $value ) {
        $sender = $this->sender;
        $sender['invoice'] = $value;
        $this->sender = $sender;
    }
    public function getInvoiceNameAttribute() {
        return $this->invoice['name'] ?? '';
    }
    public function setInvoiceNameAttribute( $value ) {
        $invoice = $this->invoice;
        $invoice['name'] = $value;
        $this->invoice = $invoice;
    }
    public function getInvoiceNifAttribute() {
        return $this->invoice['nif'] ?? '';
    }
    public function setInvoiceNifAttribute( $value ) {
        $invoice = $this->invoice;
        $invoice['nif'] = $value;
        $this->invoice = $invoice;
    }
    public function getInvoiceAddressAttribute() {
        return $this->invoice['address'] ?? '';
    }
    public function setInvoiceAddressAttribute( $value ) {
        $invoice = $this->invoice;
        $invoice['address'] = $value;
        $this->invoice = $invoice;
    }
    public function getInvoiceCityAttribute() {
        return $this->invoice['city'] ?? '';
    }
    public function setInvoiceCityAttribute( $value ) {
        $invoice = $this->invoice;
        $invoice['city'] = $value;
        $this->invoice = $invoice;
    }
    public function getInvoiceZipAttribute() {
        return $this->invoice['zip'] ?? '';
    }
    public function setInvoiceZipAttribute( $value ) {
        $invoice = $this->invoice;
        $invoice['zip'] = $value;
        $this->invoice = $invoice;
    }
    public function getAddresseeNameAttribute() {
        return $this->addressee['name'] ?? '';
    }
    public function setAddresseeNameAttribute( $value ) {
        $addressee = $this->addressee;
        $addressee['name'] = $value;
        $this->addressee = $addressee;
    }
    public function getAddresseePhoneAttribute() {
        return $this->addressee['phone'] ?? '';
    }
    public function setAddresseePhoneAttribute( $value ) {
        $addressee = $this->addressee;
        $addressee['phone'] = $value;
        $this->addressee = $addressee;
    }
    public function getAddresseeAddressAttribute() {
        return $this->addressee['address'] ?? '';
    }
    public function setAddresseeAddressAttribute( $value ) {
        $addressee = $this->addressee;
        $addressee['address'] = $value;
        $this->addressee = $addressee;
    }
    public function getAddresseeCityAttribute() {
        return $this->addressee['city'] ?? '';
    }
    public function setAddresseeCityAttribute( $value ) {
        $addressee = $this->addressee;
        $addressee['city'] = $value;
        $this->addressee = $addressee;
    }
    public function getAddresseeZipAttribute() {
        return $this->addressee['zip'] ?? '';
    }
    public function setAddresseeZipAttribute( $value ) {
        $addressee = $this->addressee;
        $addressee['zip'] = $value;
        $this->addressee = $addressee;
    }
    public function getAddresseeInfoAttribute() {
        return $this->addressee['info'] ?? '';
    }
    public function setAddresseeInfoAttribute( $value ) {
        $addressee = $this->addressee;
        $addressee['info'] = $value;
        $this->addressee = $addressee;
    }
    public function getAddresseeDeliveryTypeAttribute() {
        return $this->addressee['delivery_type'] ?? '';
    }
    public function setAddresseeDeliveryTypeAttribute( $value ) {
        $addressee = $this->addressee;
        $addressee['delivery_type'] = $value;
        $this->addressee = $addressee;
    }
    public function getAddresseeDeliveryDateAttribute() {
        return $this->addressee['delivery_date'] ?? '';
    }
    public function setAddresseeDeliveryDateAttribute( $value ) {
        $addressee = $this->addressee;
        $addressee['delivery_date'] = $value;
        $this->addressee = $addressee;
    }
    public function getAddresseeDeliveryTimeAttribute() {
        return $this->addressee['delivery_time'] ?? '';
    }
    public function setAddresseeDeliveryTimeAttribute( $value ) {
        $addressee = $this->addressee;
        $addressee['delivery_time'] = $value;
        $this->addressee = $addressee;
    }
    public function getAddresseeDedicationAttribute() {
        return $this->addressee['dedication'] ?? '';
    }
    public function setAddresseeDedicationAttribute( $value ) {
        $addressee = $this->addressee;
        $addressee['dedication'] = $value;
        $this->addressee = $addressee;
    }
    public function getPaymentMethodAttribute() {
        return $this->meta['payment_method'] ?? 'card';
    }
    public function setPaymentMethodAttribute( $value ) {
        $meta = $this->meta;
        $meta['payment_method'] = $value;
        $this->meta = $meta;
    }
    public function getNotificationAttribute() {
        return $this->meta['notification'] ?? false;
    }
    public function setNotificationAttribute( $value ) {
        $meta = $this->meta;
        $meta['notification'] = $value;
        $this->meta = $meta;
    }
    public function getShippingAttribute() {
        return $this->meta['shipping'] ?? false;
    }
    public function setShippingAttribute( $value ) {
        $meta = $this->meta;
        $meta['shipping'] = $value;
        $this->meta = $meta;
    }
    public function getAuthorizationCodeAttribute() {
        if( $this->transaction != '' ) {
            $transaction = json_decode($this->transaction,true);
            if( isset($transaction['AUTHCODE']) ) {
                $code = base64_decode($transaction['AUTHCODE']);
                return $code;
            }
        }
        return '';
    }
    public function getCouponAttribute() {
        return $this->meta['coupon'] ?? '';
    }
    public function setCouponAttribute( $value ) {
        $meta = $this->meta;
        $meta['coupon'] = $value;
        $this->meta = $meta;
    }
    public function getCouponValueAttribute() {
        return $this->meta['coupon_value'] ?? 0;
    }
    public function setCouponValueAttribute( $value ) {
        $meta = $this->meta;
        $meta['coupon_value'] = $value;
        $this->meta = $meta;
    }

    // METHODS
    public static function getTotalAmount( $date = null ) {
        if( $date == null )
            $date = today();
        $orders = Order::whereDate('created_at',$date)->get();
        return array('count'=>$orders->count(),'total'=>$orders->sum('total'));
    }
    public static function exportCSV() {
        $orders = Order::whereIn('status',['processing','ready','picked'])->get();
        file_put_contents( storage_path().'/orders.csv', "Pedido;Fecha de entrega;Nombre;Teléfono;Dirección;Código Postal;Población;Articulos"."\n" );
        foreach( $orders as $order ) {
            $line = '"'.$order->reference.'";';
            $line.= '"'.$order->addressee_delivery_date.'";';
            $line.= '"'.$order->addressee_name.'";';
            $line.= '"'.$order->addressee_phone.'";';
            $line.= '"'.$order->addressee_address.'";';
            $line.= '"'.$order->addressee_zip.'";';
            $line.= '"'.$order->addressee_city.'";';
            $items = $order->getItems();
            $array = [];
            foreach( $items as $item ) {
                $array[] = $item->qty.' x '.$item->name;
            }
            $line.= '"'.implode('|',$array).'"';
            file_put_contents( storage_path().'/orders.csv', $line."\n", FILE_APPEND );
        }
        return response()->download(storage_path().'/orders.csv', 'orders.csv', ['Content-Type' => 'text/csv']);
    }
    public function getItems() {
        $items = [];
        foreach( json_decode($this->items,true) as $item ) {
            if( $item['id'] ) {
                $product = Product::find($item['id']);
                $name = $product->getLocalizedName('es');
            } else {
                $name = "DEDICATORIA";
            }
            $items[] = ['qty'=>$item['qty'],'price'=>$item['price'],'id'=>$item['id'],'name'=>$name];
        }
        return json_decode(json_encode($items), FALSE);
    }

    public function getDocument( $dest='D') {
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator('rosistirem.com');
        $pdf->SetAuthor('Rosistirem S.L.');
        $pdf->SetTitle('ALBARÁN');
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

        // ADDRESSEE
        $pdf->SetXY(15,40);
        $pdf->Cell(110, 8, 'DESTINATARIO', '', 0, 'L');
        $pdf->SetFont('','',10);
        $pdf->SetXY(15,45);
        $pdf->Cell(110, 8, $this->addressee_name, '', 0, 'L');
        $pdf->SetXY(15,50);
        $pdf->Cell(110, 8, $this->addressee_address, '', 0, 'L');
        $pdf->SetXY(15,55);
        $pdf->Cell(10, 8, $this->addressee_zip, '', 0, 'L');
        $pdf->Cell(100, 8, $this->addressee_city, '', 0, 'L');
        $pdf->SetXY(15,60);
        $pdf->Cell(110, 8, 'Tel.: '.$this->addressee_phone, '', 0, 'L');              

        // ORDER INFO
        $pdf->SetXY(122,40);
        $pdf->Cell(30, 8, 'PEDIDO Nº:', '', 0, 'L');
        $pdf->Cell(30, 8, $this->reference, '', 0, 'L');
        $pdf->SetXY(122,45);
        $pdf->Cell(30, 8, 'FECHA PEDIDO:', '', 0, 'L');
        $pdf->Cell(30, 8, $this->created_at->format('d-m-Y'), '', 0, 'L');
        $pdf->SetXY(122,50);
        $pdf->Cell(30, 8, '', '', 0, 'L');
        $pdf->Cell(30, 8, $this->created_at->format('G:i:s'), '', 0, 'L');
        /*
        $pdf->SetXY(122,52);
        $pdf->Cell(30, 8, 'MÉTODO DE ENVÍO:', '', 0, 'L');
        $pdf->Cell(30, 8, $this->delivery_type[$this->addressee_delivery_type], '', 0, 'L');
        */
        $pdf->SetXY(122,57);
        $pdf->Cell(30, 8, 'TRANSPORTISTA:', '', 0, 'L');
        $pdf->Cell(30, 8, $this->courier ?? 'No Asignado', '', 0, 'L');
        $pdf->SetXY(122,65);
        $pdf->Cell(30, 8, 'FECHA DE ENTREGA:', '', 0, 'L');
        $pdf->Cell(30, 8, $this->addressee_delivery_date, '', 0, 'L');

        // ORDER DETAIL
        $pdf->SetXY(15,90);
        $pdf->Cell(10, 6, 'LN', 'B', 0, 'R');
        $pdf->Cell(150, 6, 'PRODUCTO', 'B', 0, 'L');
        $pdf->Cell(20, 6, 'CANTIDAD', 'B', 0, 'C');
        $y = 95;
        $n = 1;
        $items = json_decode($this->items,true);
        foreach( $items as $item  ) {
            $name = $item['id'] ? Product::find($item['id'])->getLocalizedName('es') : 'Dedicatoria';
            $pdf->SetXY(15,$y);
            $pdf->Cell(10, 8, $n++, '', 0, 'R');
            $pdf->Cell(150, 8, strtoupper($name), '', 0, 'L');
            $pdf->Cell(20, 8, $item['qty'], '', 0, 'C');
            $y+=5;
            if( $item['id'] == 0 && $this->addressee_dedication != '' ) {
                $pdf->SetXY(30,$y+1);
                $pdf->SetTextColor(80,80,80);
                $pdf->MultiCell(145, 0, $this->addressee_dedication, 0, '', 0, 1, '', '', true);        
                $pdf->SetTextColor(0,0,0);
                $y = $pdf->getY()+5;
            }
        }
        // COMMENTS
        $pdf->SetXY(15,240);
        $pdf->Cell(180, 6, 'OBSERVACIONES', 'B', 0, 'L');
        $pdf->SetXY(15,247);
        $pdf->MultiCell(180, 40, $this->addressee_info, 0, '', 0, 1, '', '', true);

        return $pdf->Output($this->reference.'.pdf', $dest);
    }


}
