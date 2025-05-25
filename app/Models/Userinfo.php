<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Userinfo extends Authenticatable
{
    protected $table = 'usersinfo'; // important if your table name is not "users"

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
// This model represents the usersinfo table in the database.
// It extends the Authenticatable class to provide authentication features.
// The $fillable property specifies which attributes can be mass assigned.
// The $hidden property specifies which attributes should be hidden when the model is converted to an array or JSON.
// This is useful for hiding sensitive information like passwords.
// The model can be used to interact with the usersinfo table, such as creating, updating, and retrieving user records.         