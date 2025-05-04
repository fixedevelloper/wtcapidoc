<?php


namespace App\Services\pdf;


use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PDFTransfert extends FPDF
{
// variables privées
    var $colonnes;
    var $format;
    var $angle=0;
    var $total_send=0.0;
    var $total_charge=0.0;
// fonctions privées
    function RoundedRect($x, $y, $w, $h, $r, $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

    function Rotate($angle, $x=-1, $y=-1)
    {
        if($x==-1)
            $x=$this->x;
        if($y==-1)
            $y=$this->y;
        if($this->angle!=0)
            $this->_out('Q');
        $this->angle=$angle;
        if($angle!=0)
        {
            $angle*=M_PI/180;
            $c=cos($angle);
            $s=sin($angle);
            $cx=$x*$this->k;
            $cy=($this->h-$y)*$this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
        }
    }
    function filgramme( $texte )
    {
        $this->SetFont('Arial','B',50);
        $this->SetTextColor(203,203,203);
        $this->Rotate(30,55,100);
        $this->Text(100,140,utf8_decode($texte));
        $this->Rotate(0);
        $this->SetTextColor(0,0,0);
    }
    function Myheader()
    {
        $this->SetFont('Times', '', 10);
        $logo=public_path('assets/img/Logo.png');
        logger($logo);
        $path =$logo;
        $this->Image($path, 10, 10,25,25);
        $this->SetXY(250, 25);
        $date = Carbon::parse('now');
        $this->SetFont('Times', 'B', 18);
        $this->Cell(10, 6, $date->translatedFormat('l, d M Y'), 0, 0, 'C');
        $this->Ln(2);

    }
    function bodyListeAll($rows)
    {
        $this->Line(12, $this->GetY() + 25, 288, $this->GetY() + 25);
        $this->SetXY(10, $this->GetY() + 30);
        $this->SetFont('Times', 'B', 14);
        $this->Cell(300, 10, utf8_decode("Transactions"), 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times', 'B', 10);
        $this->Cell(10, 8, utf8_decode('N°'), 1, 0, 'C');
        $this->Cell(80, 8, utf8_decode('Customers'), 1, 0, 'C');
        $this->Cell(50, 8, utf8_decode('Country'), 1, 0, 'C');
        $this->Cell(30, 8, utf8_decode('Amount send'), 1, 0, 'C');
        $this->Cell(30, 8, utf8_decode('Amount receive'), 1, 0, 'C');
        $this->Cell(30, 8, utf8_decode('T.Fees & Charges'), 1, 0, 'C');
        $this->Cell(35, 8, utf8_decode('DATE'), 1, 0, 'C');
        $this->Ln();
        $i = 1;
        foreach ($rows as $row) {
            $this->SetFont('Times', 'B', 10);
            $this->Cell(10, 8, $i, 1, 0, 'L');
            $this->Cell(80, 8, utf8_decode(strtoupper($row->customer->user->name)), 1, 0, 'L');
            $this->Cell(50, 8, utf8_decode(strtoupper($row->gatewayItem->country->name)), 1, 0, 'L');
            $this->Cell(30, 8, number_format($row->amount,2).' XAF', 1, 0, 'L');
            $this->Cell(30, 8, number_format($row->amount_total,2).' '.$row->gatewayItem->country->currency, 1, 0, 'L');
            $this->Cell(30, 8, number_format($row->rate,2).' XAF', 1, 0, 'L');
            $this->Cell(35, 8, Carbon::parse($row->created_at)->format('d/m/Y'), 1, 0, 'L');
            $this->Ln();
            $this->total_send+=$row->amount;
            $this->total_charge+=$row->rate;
            $i = $i + 1;
        }
    }
    function bodyListePeriodic($rows,$start,$end)
    {
        $this->Line(12, $this->GetY() + 25, 288, $this->GetY() + 25);
        $this->SetXY(10, $this->GetY() + 30);
        $this->SetFont('Times', 'B', 14);
        $this->Cell(100, 10, utf8_decode("Transactions"), 0, 0, 'R');
        $this->Cell(40, 10, utf8_decode("from ").$start, 0, 0, 'L');
        $this->Cell(40, 10, utf8_decode(" to ").$end, 0, 0, 'L');
        $this->Ln();
        $this->SetFont('Times', 'B', 10);
        $this->Cell(10, 8, utf8_decode('N°'), 1, 0, 'C');
        $this->Cell(80, 8, utf8_decode('Customers'), 1, 0, 'C');
        $this->Cell(50, 8, utf8_decode('Country'), 1, 0, 'C');
        $this->Cell(30, 8, utf8_decode('Amount send'), 1, 0, 'C');
        $this->Cell(30, 8, utf8_decode('Amount receive'), 1, 0, 'C');
        $this->Cell(30, 8, utf8_decode('T.Fees & Charges'), 1, 0, 'C');
        $this->Cell(35, 8, utf8_decode('DATE'), 1, 0, 'C');
        $this->Ln();
        $i = 1;
        foreach ($rows as $row) {
            $this->SetFont('Times', 'B', 10);
            $this->Cell(10, 8, $i, 1, 0, 'L');
            $this->Cell(80, 8, utf8_decode(strtoupper($row->customer->user->name)), 1, 0, 'L');
            $this->Cell(50, 8, utf8_decode(strtoupper($row->gatewayItem->country->name)), 1, 0, 'L');
            $this->Cell(30, 8, number_format($row->amount,2).' XAF', 1, 0, 'L');
            $this->Cell(30, 8, number_format($row->amount_total,2).' '.$row->gatewayItem->country->currency, 1, 0, 'L');
            $this->Cell(30, 8, number_format($row->rate,2).' XAF', 1, 0, 'L');
            $this->Cell(35, 8, Carbon::parse($row->created_at)->format('d/m/Y'), 1, 0, 'L');
            $this->Ln();
            $this->total_send+=$row->amount;
            $this->total_charge+=$row->rate;
            $i = $i + 1;
        }
    }
    function AddTotalPage()
    {
        // Positionner en bas de page ou au centre
        $this->SetY($this->GetY()+30);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Total Send: ' . number_format($this->total_send, 2).' FCFA', 0, 1, 'L');
        $this->Ln(1);
        $this->Cell(0, 10, 'Total Charges: ' . number_format($this->total_charge, 2).' FCFA', 0, 1, 'L');
        $this->Ln();
    }
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial', 'B', 12);
        // Numéro et nombre de pages
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}
