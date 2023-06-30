<?php

namespace App\Http\Controllers;

use App\Services\Quote\QuoteService;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return (new QuoteService($request->vin))->minimalQuoteData();
    }
}
