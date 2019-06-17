<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;
class Balance extends Model
{
    //
    public $timestamps = false;

    public function deposit(float $value) : Array
    {
        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
    	$this->amount += number_format($value, 2, '.', '');
    	$deposit = $this->save();

        $historic = auth()->user()->historics()->create([ 
            'type'         => 'I',
            'amount'       => $value,
            'total_before' => $totalBefore,
            'total_after'  => $this->amount,
            'date'         => date('Ymd'),
        ]);

    	if ($deposit && $historic) {

            DB::commit();
    		return [
    			'success' => true,
    			'message' => 'Depoisito realizado com sucesso!'
    		];
    	}else{

            DB::rollback();
            return [
            'success' => false,
            'message' => 'Deposito nao realizado, verifique se as informasções estao corretas!'
        ];
        }    	
    }

    public function withdraw(float $value) : Array
    {
        if ($this->amount < $value) {
            return [
                'seccess' => false,
                'message' => 'Saldo insuficiênte!',
            ];
        }
        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $withdraw = $this->save();

        $historic = auth()->user()->historics()->create([ 
            'type'         => 'O',
            'amount'       => $value,
            'total_before' => $totalBefore,
            'total_after'  => $this->amount,
            'date'         => date('Ymd'),
        ]);

        if ($withdraw && $historic) {

            DB::commit();
            return [
                'success' => true,
                'message' => 'Saque realizado com sucesso!'
            ];
        }else{

            DB::rollback();
            return [
            'success' => false,
            'message' => 'Saqua indisponivel, verifique seu saldo!'
        ];
        } 
    }

    public function transfer(float $value, User $sender) : Array
    {
        if ($this->amount < $value) {
            return [
                'seccess' => false,
                'message' => 'Saldo insuficiênte!',
            ];
        }
        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $transfer = $this->save();
        //dd($sender->id);
        $historic = auth()->user()->historics()->create([ 
            'type'                => 'T',
            'amount'              => $value,
            'total_before'        => $totalBefore,
            'total_after'         => $this->amount,            
            'date'                => date('Ymd'),
            'user_id_transaction' => $sender->id,
        ]);
        //dd($historic);
        $senderBalance = $sender->balance()->firstOrCreate([]);
        $totalBeforeSender = $senderBalance->amount ? $senderBalance->amount : 0;
        $senderBalance->amount += number_format($value, 2, '.', '');
        $transferSender = $senderBalance->save();

        $historicSender = $sender->historics()->create([ 
            'type'                => 'I',
            'amount'              => $value,
            'total_before'        => $totalBeforeSender,
            'total_after'         => $senderBalance->amount,            
            'user_id_transaction' => auth()->user()->id,
            'date'                => date('Ymd'),
        ]);
        //dd($historicSender);
        if ($transfer && $historic && $transferSender && $historicSender) {

            DB::commit();
            return [
                'success' => true,
                'message' => 'Transferencia realizado com sucesso!'
            ];
        }else{

            DB::rollback();
            return [
            'success' => false,
            'message' => 'Falha ao transferir, verifique os dados!'
        ];
        } 
    }
}
