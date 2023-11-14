<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ContactService;

class ContactController extends BaseController
{
    private static $instance;
    private ContactService $contactService;

    private function __construct(string $ajaxMode)
    {
        $this->contactService = ContactService::getInstance();
        parent::__construct($ajaxMode);
    }

    public static function getInstance(string $ajaxMode): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($ajaxMode);
        }
        return self::$instance;
    }

    public function displayContact(int $id): void
    {
        $datas['contactId'] = $id;
        $datas['contact'] = $this->contactService->getContact($id);
        $this->renderHtml($datas, 'contact');
    }

    public function displayContacts(): void
    {
        $datas['contacts'] = $this->contactService->getContacts(20);
        $this->renderHtml($datas, 'contacts');
    }

    public function newContact(): void
    {
        $this->renderHtml([], 'formcontact');
    }

    public function contactSave(array $requests): void
    {
        $uid = $requests['name'];
        $name = $requests['name'];
        $mail = $requests['mail'];
        $message = $requests['message'];

        $error = match (true) {
            !$name => 'Indiquez votre nom',
            !$mail => 'Indiquez votre mail',
            !filter_var($mail, FILTER_VALIDATE_EMAIL) => 'Votre e-mail est incorrect',
            !$message => 'Sans contenu, point de salut',
            default => ''
        };

        $datas =
            [
                'name' => $name,
                'mail' => $mail,
                'message' => $message,
                'error' => $error
            ];

        if ($error) {
            $this->renderHtml($datas, 'formcontact');
            return;
        }
        $datas['contactId'] = $this->contactService->contactSave($name, $mail, $message);
        $this->renderHtml($datas, 'publishedcontact');
    }
}
