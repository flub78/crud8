<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/*
 * A layer between application models and the eloquent Abstract model class to
 * log actions modifying the database.
 * 
 * As there is a big number of public methods, this class will be competed along
 * the way of the development
 */
class ModelWithLogs extends Model
{
    /** 
     * Log a message with user information
     */
    protected function logit(string $msg = '') {
        $user = Auth::user();
        if ($user) {
            $user_str = ' by ' . $user->name;
        } else {
            $user_str = ' by guest';
        }
        
        $bt = debug_backtrace(0 , 2);
        
        $funct = ' ' . $bt[1]['function'] . ' ';
        
        Log::Debug($msg . $funct . $user_str);
    }
    
    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @param  array  $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        $this->logit();
        return parent::update($attributes, $options);
    }
    
    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $this->logit();     
        return parent::save($options);
    }
    
    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \LogicException
     */
    public function delete()
    {
        $this->logit();
        return parent::delete();
    }
}
