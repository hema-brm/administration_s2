<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;


class PdfService
{
    private $domPdf;

    public function __construct() {
        $this->domPdf = new DomPdf();

        $pdfOptions = new Options();

        $pdfOptions->set('defaultFont', 'Garamond');

        $this->domPdf->setOptions($pdfOptions);
    }

    public function showPdfFile($html) {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->stream("facture.pdf", [
            'Attachment' => true
        ]);
    }

    public function savePdf(string $html, string $filename = 'devis.pdf')
    {
        $pdfContent = $this->generatePdfContent($html);
        $response = new Response($pdfContent);

        // Ajouter les en-têtes pour forcer le téléchargement
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
    
        // Enregistrer le PDF dans le dossier tmp_pdf
        $filePath = __DIR__ . '/../../tmp_pdf/' . $filename;
        file_put_contents($filePath, $pdfContent);

        // Retourner la réponse et le chemin du fichier enregistré
        return [$response, $filePath];
       
    }


    public function generatePdfContent(string $html): string
    {
        // Créer une nouvelle instance de Dompdf
        $dompdf = new Dompdf();

        // Charger le contenu HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Rendre le contenu HTML en PDF
        $dompdf->render();

        // Renvoyer le contenu du PDF
        return $dompdf->output();
    }

    public function generateBinaryPDF($html) {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->output();
    }
}