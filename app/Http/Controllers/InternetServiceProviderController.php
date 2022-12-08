<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use App\Services\InternetServiceProvider\WifiInvoiceCaculator;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller
{

    public function getMptInvoiceAmount(Request $request, WifiInvoiceCaculator $wifiInvoiceCaculator)
    {
        $wifiInvoiceCaculator->setMonth($request->get('month', 1));
        $amount = $wifiInvoiceCaculator->calculateTotalAmount(new Mpt());

        return response()->json([
            'data' => $amount
        ]);
    }

    public function getOoredooInvoiceAmount(Request $request, WifiInvoiceCaculator $wifiInvoiceCaculator)
    {
        $wifiInvoiceCaculator->setMonth($request->get('month', 1));
        $amount = $wifiInvoiceCaculator->calculateTotalAmount(new Ooredoo());

        return response()->json([
            'data' => $amount
        ]);
    }
}
