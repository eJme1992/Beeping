<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Repository\Executed\IExecutedRepository;

class ExecutedController extends Controller
{
    
    private $executedRepository;

    public function __construct(IExecutedRepository $executedRepository)
    {
        $this->executedRepository = $executedRepository;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'total_orders' => 'required|numeric',
            'total_cost'   => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $filds = $request->all();
        $this->executedRepository->create(['total_cost' => $filds['total_cost'], 'total_orders' => $filds['total_orders']]);
        return response()->json(['message' => 'Executed created successfully'], 201); 
    }
   
}
