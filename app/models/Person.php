<?php

namespace App\Models;

use App\Traits\CRUDTrait;

class Person
{
    use CRUDTrait;

    const FULL_NAME = "full_name";
    const EMAIL = "email";
    const PHONE_NUM = "phone_num";
    const REGISTRATION_DATE = "registration_date";
    const COLUMNS_TO_SHOW = [
        "id",
        "full_name",
        "email",
        "phone_num",
        "registration_date"
    ];
}