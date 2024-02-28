<?php

namespace App\Service;

use Exception;
use GuzzleHttp\Client;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use App\Entity\Customer;
use App\Service\PdfService;

class Mailer
{
    private string $sendinblueApiKey; 

    public function __construct()
    {
        $this->sendinblueApiKey = $_ENV['SENDINBLUE_API_KEY'];
    }
    /**
     * @throws Exception
     */
    public function sendTemplate(int $templateId, array $to, array $params = null, string $pathPDF = null): string
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->sendinblueApiKey);
        $apiInstance = new TransactionalEmailsApi(
            new Client(),
            $config
        );
        $sendSmtpEmail = new SendSmtpEmail();
        if (count($to) === 1) {
            $sendSmtpEmail['to'] = $to;
        } else {
            $sendSmtpEmail['to'] = [['email' => 'no-reply@test.fr', 'name' => 'Module Test']];
            $sendSmtpEmail['bcc'] = $to;
        }
        $sendSmtpEmail['templateId'] = $templateId;
        $sendSmtpEmail['params'] = $params;
    
        if($pathPDF !== null){
            //prendre le chemin du pdf afin de le découper en fonction du separateur 
            $tab = explode("/", $pathPDF);
            $filename = $tab[count($tab)-1];
            $name = explode("_",$filename)[0];
            $sendSmtpEmail['attachment'] = [
                                                [
                                                    'content' => base64_encode(file_get_contents($pathPDF)), // Convertir le contenu en base64
                                                    'name' => $name.'.pdf', // Nom du fichier PDF
                                                    'type' => 'application/pdf', // Type MIME du fichier PDF
                                                ]
                                            ];
        }

        try {
            return $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            throw new Exception('Exception when calling TransactionalEmailsApi->sendTransacEmail: ' . $e->getMessage());
        }
    }

    public function sendEmail(int $templateID ,Customer $customer, string $filenamePDF = null): bool
    {
        if($customer){
            $email = $customer->getEmail();
            $lastname = $customer->getLastname();
            $firstname = $customer->getFirstname();
            $company = $customer->getCompany()->getName();
        }

        $pathPDF = null;

        if($filenamePDF){
            $pathPDF = __DIR__.'/../../tmp_pdf/'.$filenamePDF;
        }
        
        if($pathPDF !== null && !file_exists($pathPDF)){
            throw new \Exception("Le chemin spécifié n'existe pas : ".$pathPDF);
        }
        $sendEmail = $this->sendTemplate($templateID, [['email' => $email]], [
                                                                        'company' => $company,
                                                                        'lastname' => $lastname,
                                                                        'firstname' => $firstname                                                           
                                                                    ], $pathPDF); 
        
                                                                    
        //supprimer le fichier temporaire (fonctionne pas)
        if($pathPDF !== null){
           unlink($pathPDF); 
        }
        
        return $sendEmail;                                                            
    }
}