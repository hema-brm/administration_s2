<?php

namespace App\Service;

use Exception;
use GuzzleHttp\Client;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use App\Entity\Customer;

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
    public function sendTemplate(int $templateId, array $to, array $params = null): string
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
        try {
            return $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            throw new Exception('Exception when calling TransactionalEmailsApi->sendTransacEmail: ' . $e->getMessage());
        }
    }

    public function sendEmail(int $templateID ,Customer $customer): bool
    {
        if($customer){
            $email = $customer->getEmail();
            $lastname = $customer->getLastname();
            $firstname = $customer->getFirstname();
            $company = $customer->getCompany()->getName();
        }
        $sendEmail = $this->sendTemplate($templateID, [['email' => $email]], [
                                                                        'company' => $company,
                                                                        'lastname' => $lastname,
                                                                        'firstname' => $firstname                                                           
                                                                    ]); 
        return $sendEmail;                                                            
    }
}