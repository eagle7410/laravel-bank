<?php

namespace App\Models\Tickets;

use App\Traits\Models\UpdatedBy;
use App\User;
use Illuminate\Database\Eloquent\Model;

class TicketsBase extends Model
{
    const TABLE_NAME = 'tickets';

    use UpdatedBy;
    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    protected $attributes = [
        'is_read_support' => 0
    ];

    /**
     **
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id',
        'is_read_support',
        'id',
    ];

    public function dialog()
    {
        return $this->hasMany(TicketDialogBase::class, 'ticket_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
