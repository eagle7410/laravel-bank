<?php

namespace App\Models\Tickets;

use App\Traits\Models\Created;
use App\User;
use Illuminate\Database\Eloquent\Model;

class TicketDialogBase extends Model
{
    const TABLE_NAME = 'ticket_dialog';
    /*
    * @var bool
    */
    public $timestamps = false;

    use Created;

    protected $attributes = [
        'is_support' => 0
    ];

    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'ticket_id',
        'is_support',
        'text',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
