<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\API\Balance\BalanceContract;

class BalanceController extends Controller
{
    /**
     * @var BalanceContract
     */
    private $repository;

    /**
     * BalanceController constructor.
     * @param BalanceContract $repository
     */
    public function __construct(BalanceContract $repository) {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paypalWithdraw(Request $request) 
    {
        $teste = $this->repository->paypalWithdraw($request);
        return response()->json($teste, 200);
        if($this->repository->paypalWithdraw($request)) {
            return response()->json([
                'message' => trans('alerts.balances.withdraw.success')
            ], 200);
        }
        return response()->json([
            'message' => trans('alerts.balances.withdraw.error')
        ], 422);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function agentWithdraw(Request $request) 
    {
        if($this->repository->agentWithdraw($request)) {
            return response()->json([
                'message' => trans('alerts.balances.withdraw.success')
            ], 200);
        }
        return response()->json([
            'message' => trans('alerts.balances.withdraw.error')
        ], 422);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
}
