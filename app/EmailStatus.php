<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class EmailStatus extends Model
{
    protected $table = 'email_status';
    protected $fillable = [
        'transaction_hash', 'send_status'
    ];
}