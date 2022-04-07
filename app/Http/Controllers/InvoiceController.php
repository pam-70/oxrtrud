<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    //
    public function download()
    {
        $products = [
            ['title' => 'Продукт1', 'price' => 10.99, 'quantity' => 1, 'totals' => 10.99],
            ['title' => 'Продукт 2', 'price' => 14.99, 'quantity' => 2, 'totals' => 29.98],
            ['title' => 'Продукт 3', 'price' => 500.00, 'quantity' => 1, 'totals' => 500.00],
            ['title' => 'Продукт 4', 'price' => 6.99, 'quantity' => 3, 'totals' => 20.97],
        ];

        $total = collect($products)->sum('totals');

        $pdf = PDF::loadView('invoice', compact('products', 'total'));
      //  $data=[
           // 'fio'=>$id_user->surname,
           // 'sh'=>$id_user->sh,
          //  'dt'=>date("Y")."  год",
           // 'pr'=>$rez*10,
           // 'n_sert'=>$id_user->id,
           
      //  ];
      //  $pdf = PDF::loadView('invoice',['data'=>$data])->setPaper('a4', 'landscape');//, $data); 
       //$pdf = PDF::loadView('invoice');    
       //return $pdf->download('invoice.pdf');
       return $pdf->stream(); // показ в окне

       // dd("iiiii");
        //return $pdf->download('invoice.pdf');
    }
}
