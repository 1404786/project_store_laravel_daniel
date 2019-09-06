<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Balance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MonayValidationFormRequest;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balance = auth()->user()->balance; 
        $amount = $balance ? $balance->amount : 0;
        return view('admin.balance.index', compact('amount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deposit () {
        return view('admin.balance.deposit');
    }

    //Aqui é injetado o request para receber e processar a requisição
    public function depositStore (MonayValidationFormRequest $request) {
    //    $balance->deposit($request->value);

        //Se passasse 'amount=>0' iria verificar se existe um registro para esse usuário para esse id logado cujo o amount seja igual a 0 
        // Se existe retornaria, caso contrário retornaria, se já existisse um valor qualquer ele criaria, mas isso não é o que queremos por isso estou passando o array vazio
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);

        if ($response['success']) {
            return redirect()->route('admin.balance')
            ->with('success', $response['message']);
        }else {
            return redirect()
                    ->back()
                    ->with('error', $response['message']);
        }
    }

    public function withdraw () {
        return view('admin.balance.withdraw');
    }

    public function transfer ()
    {
        return view('admin.balance.transfer');
    }

    public function confirmTransfer (Request $request, User $user)
    {      
        $sender = $user->getSender ($request->sender); 
        

        if (!$sender = $user->getSender($request->sender)) 
            return redirect()
                    ->back()
                    ->with('error', 'Usuário informado não foi encontrado!');
        if ($sender->id === auth()->user()->id)
            return redirect()
                    ->back()
                    ->with('error', 'Não pode transferir para você mesmo!');

$balance = auth()->user()->balance;
        return view('admin.balance.transfer-confirm', compact('sender', "balance"));
//       $dan = auth()->user()->id;
//        var_dump($dan, $sender->id);
    }


    //Aqui é injetado o request para receber e processar a requisição
    public function withdrawStore (MonayValidationFormRequest $request) {
        //    $balance->deposit($request->value);
    
            //Se passasse 'amount=>0' iria verificar se existe um registro para esse usuário para esse id logado cujo o amount seja igual a 0 
            // Se existe retornaria, caso contrário retornaria, se já existisse um valor qualquer ele criaria, mas isso não é o que queremos por isso estou passando o array vazio
            $balance = auth()->user()->balance()->firstOrCreate([]);
            $response = $balance->withdraw($request->value);
    
            if ($response['success']) {
                return redirect()->route('admin.balance')
                ->with('success', $response['message']);
            }else {
                return redirect()
                        ->back()
                        ->with('error', $response['message']);
            }
        }

        public function transferStore(MonayValidationFormRequest $request, User $user) {
            //dd($user->find($request->sender_id));
            //sender_id é o campo hidden do form

            if (!$sender = $user->find($request->sender_id))
            {
                return redirect()
                        ->route('balance.transfer')
                        ->with('success', "Recebedor não encontrado!");
            }
            
            $sender = $user->find($request->sender_id);
            $balance = auth()->user()->balance()->firstOrCreate([]);
            $response = $balance->transfer($request->value, $sender);

            if ($response['success']) {
                return redirect()->route('admin.balance')
                ->with('success', $response['message']);

            }else {
                return redirect()->route('admin.balance')
                ->with('error', $response['message']);
            }
        }

        public function historic () {
            $historics = auth()->user()->historics()->get();



            return view('admin.balance.historic', compact('historics'));
        }
    
}
