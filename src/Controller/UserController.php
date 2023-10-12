<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepository;
use App\Controller\TemplateController;

class UserController extends UserRepository
{

    public function user(int $id = 1): void
    {
        $datas = $this->findUserFromId($id);
        $array['name'] = $datas[0]->name;
        $template = new TemplateController('user');
        $template->call($array);
    }

}
