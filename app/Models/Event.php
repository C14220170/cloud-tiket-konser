<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    use HasFactory;


    protected $fillable = [
        'title','description','start_at','venue','image','min_price','max_price'
    ];

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }
}