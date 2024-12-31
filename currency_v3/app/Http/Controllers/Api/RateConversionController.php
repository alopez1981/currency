<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Src\Currency\Application\Buses\QueryBus;
use Src\Currency\Application\Queries\GetRateConversionQuery;
use Illuminate\Http\Request;

class RateConversionController extends Controller
{
    private QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function convert(Request $request): array
    {
        $validated = $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);
        $query = new GetRateConversionQuery(
            $validated['from'],
            $validated['to'],
            (float)$validated['amount']
        );
        return $this->queryBus->dispatch($query);
    }
}
