<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Currency\Application\Buses\QueryBus;
use Src\Currency\Application\Queries\GetCurrenciesQuery;

class CurrenciesController extends Controller
{
   private QueryBus $queryBus;

   public function __construct(QueryBus $queryBus)
   {
       $this->queryBus = $queryBus;
   }

   public function index(): JsonResponse
   {
       $currencies = $this->queryBus->dispatch(new GetCurrenciesQuery());

       return response()->json([
           'data' => $currencies,
       ], 200);

   }
}
