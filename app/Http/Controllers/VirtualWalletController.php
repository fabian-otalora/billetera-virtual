<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Services\CustomerService;
use App\Http\Resources\CustomerResource;
use DB;
use App\Http\Requests\WalletRequest;
use App\Services\WalletService;
use App\Http\Resources\WalletResource;
use App\Http\Requests\CheckBalanceRequest;

class VirtualWalletController extends Controller
{

    protected $customerService;
    protected $walletService;
    public function __construct(CustomerService $customerService, WalletService $walletService)
    {
        $this->customerService = $customerService;
        $this->walletService = $walletService;
    }

    /**
     * Registo de Clientes
     */
    public function customerRegistration(CustomerRequest $request){
        try {
            DB::beginTransaction();
            $newCustomer = $this->customerService->save($request->all());
            DB::commit();

            if ($newCustomer === false) {
                DB::rollBack();  
                return $this->sendError('El usuario ya se encuentra registrado en el sistema.', [], 500);
            }

            return $this->sendResponse(
                [
                    'success' => true,
                    'cod_error' => 00,
                    'message_error' => '',
                    'msg' => 'Usuario registrado con exito',
                    new CustomerResource($newCustomer),
                    201,
                ]
            );

        } catch (\Throwable $th) {
            DB::rollBack();  
            return $this->sendError(
                [
                    'success' => false,
                    'cod_error' => 500,
                    'message_error' => $e->getMessage(),
                ],
                500
            );
        }
    }

    /**
     * Recarga de billetera
     */
    public function rechargeWallet(WalletRequest $request){
        try {
            DB::beginTransaction();
            $recharge = $this->walletService->recharge($request->all());
            DB::commit();

            if ($recharge === false) {
                DB::rollBack();  
                return $this->sendError(
                    [
                        'success' => false,
                        'cod_error' => 500,
                        'message_error' => 'El cliente no existe',
                    ],
                    500
                );
            }

            return $this->sendResponse(
                [
                    'success' => true,
                    'cod_error' => 00,
                    'message_error' => '',
                    'msg' => 'Recarga realizada con exito',
                    new WalletResource($recharge),
                    201,
                ]
            );

        } catch (\Throwable $th) {
            DB::rollBack();  
            return $this->sendError(
                [
                    'success' => false,
                    'cod_error' => 500,
                    'message_error' => $e->getMessage(),
                ],
                500
            );
        }
    }

    /**
     * Consultar saldo
     */
    public function checkBalance(CheckBalanceRequest $request){
        try {
            DB::beginTransaction();
            $balance = $this->walletService->checkBalance($request->all());
            DB::commit();

            if ($balance === false) {
                DB::rollBack();  
                return $this->sendError(
                    [
                        'success' => false,
                        'cod_error' => 500,
                        'message_error' => 'El cliente no existe',
                    ],
                    500
                );
            }

            return $this->sendResponse(
                [
                    'success' => true,
                    'cod_error' => 00,
                    'message_error' => '',
                    'msg' => 'Saldo en la billetera virtual',
                    new WalletResource($balance),
                    201,
                ]
            );

        } catch (\Throwable $th) {
            DB::rollBack();  
            return $this->sendError(
                [
                    'success' => false,
                    'cod_error' => 500,
                    'message_error' => $e->getMessage(),
                ],
                500
            );
        }
    }


    

}
