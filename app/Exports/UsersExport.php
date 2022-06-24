<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select("id", "username", "first_name", "last_name", "full_name", "phone", "email", "status", "last_login_at", "last_login_ip")->get();
    }
}
