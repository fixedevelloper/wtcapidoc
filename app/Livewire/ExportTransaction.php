<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Transaction;
use App\Services\Pdf\PDFListing;
use App\Services\pdf\PDFTransfert;
use Livewire\Component;

class ExportTransaction extends Component
{
    public $isOpen = false;
    public $file_type;
    public $end_date;
    public $start_date;
    public $isPeriodic;
    // Fonction pour ouvrir le modal
    public function openModal()
    {
        $this->isOpen = true;
    }
    function updateIsPeriodic(){
        logger($this->isPeriodic);
    }
    // Fonction pour fermer le modal
    public function closeModal()
    {
        $this->isOpen = false;
    }
    public function export(){


        $pdf = new PDFTransfert('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->Myheader();
        if ($this->isPeriodic){
            logger($this->start_date);
            $transactions=Transaction::query()->where('type',Helper::TYPESECURE)->whereBetween('created_at', [$this->start_date, $this->end_date])->get();
            $pdf->bodyListePeriodic($transactions,$this->start_date,$this->end_date);
        }else{
            $transactions=Transaction::query()->where('type',Helper::TYPESECURE)->get();
            $pdf->bodyListeAll($transactions);
        }

        $pdf->filgramme("WTC");
        $pdf->AddTotalPage();
        // Sauvegarder dans le système de fichiers
        //$filePath = storage_path('app/public/test.pdf');
       // $pdf->Output($filePath, 'F');
        $this->closeModal();
        // Ou forcer le téléchargement
        return response()->streamDownload(function () use ($pdf) {
            $pdf->Output();
        }, 'transaction.pdf');
    }
    public function render()
    {
        return view('livewire.export-transaction');
    }
}
