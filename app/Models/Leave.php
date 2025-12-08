<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model
{
    use HasFactory;
    protected $table = 'leave';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'start_date',
            'end_date',
            'leave_type',
            'reason',
            'status',
            'user_id',
    
    
    ]; 

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
