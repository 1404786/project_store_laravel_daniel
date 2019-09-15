<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;

class Historic extends Model
{
    protected $fillable = ['type', 'amount', 'total_before', 'total_after', 'user_id_transaction', 'date'];

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
        //aqui é usado para formatar a data;
    }

    public function type ($type = null)
    {
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userSender()
    {
        return $this->belongsTo(User::class, 'user_id_transaction');
    }

    public function scopeUserAuth ($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function search(Array $data, $totalPage)
    {  
        return $this->where(function ($query) use ($data) {
            if (isset($data['id'])){
                $query->where('id', $data['id']);
            }

            if (isset($data['date'])){
                $query->where('date', $data['date']);
            }

            if (isset($data['type'])){
                $query->where('type', $data['type']);
            }


        })//->toSql();dd($historics);
        //->where('user_id', auth()->user()->id) escopo global
        ->userAuth() //Escopo local
        ->with(['userSender'])
        //economizar consultas
        ->paginate($totalPage);
    }

}
