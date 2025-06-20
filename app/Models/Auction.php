<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item',
        'image',
        'category',
        'description',
        'starting_bid',
        'current_bid',
        'winner_id',
        'ends_at',
    ];

    protected $casts = [
        'ends_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
    
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
