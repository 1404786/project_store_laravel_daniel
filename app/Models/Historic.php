<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;

class Historic extends Model
{
    protected $fillable = ['type', 'amount', 'total_before', 'total_after', 'user_id_transaction', 'date'];

    public function getDateAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
        //aqui é usado para formatar a data;
    }

    public function type ($type = null) {
        $types = [
            'I' => 'Entrada',
            'O' => 'Saque',
            'T' => 'Transferência',
        ];

        if (!$type)
            return $types;

        //$this é o proprio histórico em si.
        if ($this->user_id_transaction != null && $type == 'I')
            return 'Recebido';

        return $types[$type];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function userSender () {
        return $this->belongsTo(User::class, 'user_id_transaction');
    }

}
