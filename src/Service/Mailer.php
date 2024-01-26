<?php

namespace App\Service;

use Exception;
use GuzzleHttp\Client;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;

class Mailer
{
    /**
     * @throws Exception
     */
    public function sendTemplate(int $templateId, array $to, array $params = null): string
    {
        $KEY = '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';

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $KEY);

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
}