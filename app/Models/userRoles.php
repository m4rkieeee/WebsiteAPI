<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userRoles extends Model
{
    protected $table = 'user_roles';
    public CONST user = 1;
    public CONST moderator = 2;
    public CONST administrator = 3;

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public static function getRole($role)
    {
        if($role == self::user) $returnRole = "User";
        elseif ($role == self::moderator) $returnRole = "Moderator";
        elseif ($role == self::administrator) $returnRole = "Administrator";
        else $returnRole = "Unknown";

        return $returnRole;
    }
}
