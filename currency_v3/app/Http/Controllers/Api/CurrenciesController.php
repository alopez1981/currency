<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    public function index()
    {
        // Ejemplo de datos simulados. Reemplazar con lógica real más adelante.
        $currencies = [
            ['code' => 'EUR', 'name' => 'Euro', 'rate_USD' => '1.06'],
            ['code' => 'USD', 'name' => 'Dollar', 'rate_USD' => '1.00'],
        ];

        return response()->json(['data' => $currencies]);
    }
}
