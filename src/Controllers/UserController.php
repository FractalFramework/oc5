<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\UserService;
use App\Controllers\TemplateController;

class UserController extends UserService
{

    public function user(int $id = 1): void
    {
        $datas = $this->findUserFromId($id);
        $array['name'] = $datas[0]->name;
        $template = new TemplateController('user');
        $template->call($array);
    }

}
