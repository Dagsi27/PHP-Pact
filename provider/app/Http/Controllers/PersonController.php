<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Laravel\Lumen\Routing\Controller as BaseController;

class PersonController extends BaseController
{
    public function __construct(protected Person $person) {}

    public function get()
    {
        $result = $this->person->get();

        return [
            [
                "first_name" => $result[0]->name,
                "last_name" => $result[0]->lastName,
                "alias" => $result[0]->alias,
            ]
        ];
    }
}
