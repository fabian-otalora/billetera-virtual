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
use App\Http\Requests\PayRequest;
use App\Http\Requests\ConfirmPaymentRequest;

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
                $response = [
                    "success" => false,
                    "cod_error" => 500,
                    "message_error" => "El usuario ya se encuentra registrado en el sistema."
                ];
                return response()->json($response, 500);
            }

            $response = [
                "success" => true,
                "cod_error" => 00,
                "message_error" => "",
                "msg" => "Cliente registrado con exito",
                "data" => new CustomerResource($newCustomer)
            ];
            return response()->json($response, 201);

        } catch (\Throwable $e) {
            DB::rollBack(); 
            $response = [
                "success" => false,
                "cod_error" => 500,
                "message_error" => $e->getMessage()
            ];
            return response()->json($response, 500); 
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
                $response = [
                    "success" => false,
                    "cod_error" => 500,
                    "message_error" => "El cliente no existe."
                ];
                return response()->json($response, 500);
            }

            $response = [
                "success" => true,
                "cod_error" => 00,
                "message_error" => "",
                "msg" => "Recarga realizada con exito",
                "data" => new WalletResource($recharge)
            ];
            return response()->json($response, 201);

        } catch (\Throwable $e) {
            DB::rollBack();  
            $response = [
                "success" => false,
                "cod_error" => 500,
                "message_error" => $e->getMessage()
            ];
            return response()->json($response, 500);
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
                $response = [
                    "success" => false,
                    "cod_error" => 500,
                    "message_error" => "El cliente no existe."
                ];
                return response()->json($response, 500);
            }

            $response = [
                "success" => true,
                "cod_error" => 00,
                "message_error" => "",
                "msg" => "Saldo en la billetera virtual",
                "data" => new WalletResource($balance)
            ];
            return response()->json($response, 201);

        } catch (\Throwable $e) {
            DB::rollBack();  
            $response = [
                "success" => false,
                "cod_error" => 500,
                "message_error" => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Pagar
     */
    public function pay(PayRequest $request){
        try {
            DB::beginTransaction();
            $pay = $this->walletService->pay($request->all());
            DB::commit();

            if ($pay === false) {
                DB::rollBack();  
                $response = [
                    "success" => false,
                    "cod_error" => 500,
                    "message_error" => "El cliente no existe."
                ];
                return response()->json($response, 500);
            }

            $response = [
                "success" => true,
                "cod_error" => 00,
                "message_error" => "",
                "msg" => "Token generado, usar este token para confirmar la compra.",
                "data" => new WalletResource($pay)
            ];
            return response()->json($response, 201);

        } catch (\Throwable $e) {
            DB::rollBack();  
            $response = [
                "success" => false,
                "cod_error" => 500,
                "message_error" => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Confirmar pago
     */
    public function confirmPayment(PayRequest $request){
        try {

            DB::beginTransaction();
            $purchase = $this->walletService->purchase($request->all());
            DB::commit();

            if ($purchase === false) {
                DB::rollBack();  
                $response = [
                    "success" => false,
                    "cod_error" => 500,
                    "message_error" => "El cliente no existe o no tiene saldo suficiente en la cuenta."
                ];
                return response()->json($response, 500);
            }

            $response = [
                "success" => true,
                "cod_error" => 00,
                "message_error" => "",
                "msg" => "Compra realizada con exito."
            ];
            return response()->json($response, 201);

        } catch (\Throwable $e) {
            DB::rollBack();  
            $response = [
                "success" => false,
                "cod_error" => 500,
                "message_error" => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }


}
