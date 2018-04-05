<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Splitter;

class BillController extends Controller
{

    /*
     *  GET
     *  '/' route
     */

    public function index(Request $request)
    {
        $resultTotal = $request->session()->get('resultTotal');
        $roundUp = $request->session()->get('roundUp');
        $total = $request->session()->get('total');
        $service = $request->session()->get('service');
        $numberOfWays = $request->session()->get('numberOfWays');

        return view('bill.show')->with([
            'resultTotal' => $resultTotal,
            'roundUp' => $roundUp,
            'total' => $total,
            'service' => $service,
            'numberOfWays' => $numberOfWays
            ]);
    }

    /*
     *  POST
     *  '/bill/create' route
     */

    public function show(Request $request)
    {
        $this->validate($request, [
            'numberOfWays' => 'required|numeric|integer|min:1',
            'total' => 'required|numeric|min:0.01'
        ]);

        $numberOfWays = $request->input('numberOfWays');
        $total = $request->input('total');
        $service = $request->input('service');
        $roundUp = $request->has('roundUp');

        $resultTotal = '';

        if ($total) {
            #Initiate a Splitter object
            $splitter = new Splitter($total, $service);

            $resultTotal = $splitter->splitBill($numberOfWays);
            $resultTotal = $splitter->roundAmount($resultTotal, $roundUp);
            $resultTotal = $splitter->displayAsCurrency($resultTotal);
        };

        return redirect('/index.php')->with([
            'resultTotal' => $resultTotal,
            'roundUp' => $roundUp,
            'total' => $total,
            'service' => $service,
            'numberOfWays' => $numberOfWays
        ]);
    }

}
