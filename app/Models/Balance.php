<?php

namespace App\Models;

use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false;
    

    public function deposit (float $value) : Array
    {   
        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value, 2, '.', '');
        $deposit = $this->save();

        //Para que eu consiga inserir campos em massa devo ir em historic e definir o fillable
        //Isso é questão de segurança do laravel
        $historic = auth()->user()->historics()->create([
            'type'           => 'I', 
            'amount'         => $value,
            'total_before'   =>  $totalBefore,
            'total_after'    => $this->amount,
            'date'           => date('Ymd')
        ]);
        
        if ($deposit && $historic) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar',
            ];
        } else {
            DB::rollback(); 
            return [
                'sucess' => false,
                'message' => 'Falha ao carregar',
            ];
    
        }
    }

    public function withdraw (float $value) : Array
    {
        if ($this->amount < $value)
        {
            return [
                'success' => false,
                'message' => 'Saldo insuficiente',
            ];
        }

        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $withdraw = $this->save();

        //Para que eu consiga inserir campos em massa devo ir em historic e definir o fillable
        //Isso é questão de segurança do laravel
        $historic = auth()->user()->historics()->create([
            'type'           => 'O', 
            'amount'         => $value,
            'total_before'   =>  $totalBefore,
            'total_after'    => $this->amount,
            'date'           => date('Ymd')
        ]);
        
        if ($withdraw && $historic) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Saque realizado',
            ];
        } else {
            DB::rollback(); 
            return [
                'sucess' => false,
                'message' => 'Falha ao sacar',
            ];
        //Se por acaso não entra no if ira dar erro, pois deve retornar algo para o usuário
        }
    }

    public function transfer (float $value, User $sender) : Array {
        $vTotal = $this->amount+$value;

        if ($this->amount < $value or  $vTotal > $this->amount)
        {
            return [
                'success' => false,
                'message' => 'Saldo insuficiente',
            ];
        }

        DB::beginTransaction();

        /**
         * Atualiza o próprio saldo
         */

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $transfer = $this->save();

        $historic = auth()->user()->historics()->create([
            'type'                => 'T', 
            'amount'              => $value,
            'total_before'        =>  $totalBefore,
            'total_after'         => $this->amount,
            'date'                => date('Ymd'),
            'user_id_transaction' => $sender->id,
        ]);
        

        /**
         * Atualiza o  saldo do recebedor
         */
        
        $senderBalance = $sender->balance()->firstOrCreate([]);
        $totalBeforeSender = $senderBalance->amount ? $senderBalance->amount : 0;
        $senderBalance->amount += number_format($value, 2, '.', '');
        $transferSender = $senderBalance->save();

        $historicSender = $sender->historics()->create([
            'type'                => 'I', 
            'amount'              => $value,
            'total_before'        =>  $totalBeforeSender,
            'total_after'         => $senderBalance->amount,
            'date'                => date('Ymd'),
            'user_id_transaction' => auth()->user()->id,
        ]);




        if ($transfer && $historic && $transferSender && $historicSender) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Trasferencia realizada',
            ];
        } else {
            DB::rollback(); 
            return [
                'sucess' => false,
                'message' => 'Falha ao sacar',
            ];
        }


        
    }
} 
