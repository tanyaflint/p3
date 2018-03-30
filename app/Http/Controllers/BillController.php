<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Splitter;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $numberOfWays = $request->input('numberOfWays');
        $total = $request->input('total');
        $service = $request->input('service');
        $roundUp = $request->has('roundUp');

        $resultTotal = '';

        if ($total) {
            $this->validate($request, [
                'numberOfWays' => 'required',
                'total' => 'required'
            ]);

            #Initiate a Splitter object
            $splitter = new Splitter($total, $service);

            $resultTotal = $splitter->splitBill($numberOfWays);
            $resultTotal = $splitter->roundAmount($resultTotal, $roundUp);
            $resultTotal = $splitter->displayAsCurrency($resultTotal);
        };

        return view('bill.show')->with([
            'numberOfWays' => $numberOfWays,
            'total' => $total,
            'service' => $service,
            'roundUp' => $roundUp,
            'resultTotal' => $resultTotal]);
    }

}
