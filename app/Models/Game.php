<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Game extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'price'];
    
    /**
     * Checks equality
     * @param Game $x
     * @return boolean
     */
    public function equals(Game $x) {
        return
            ($this->name == $x->name) &&
            ($this->price == $x->price);            
    }
}
