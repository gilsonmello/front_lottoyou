<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */                     
    public function index(Request $request)         
    {
        /* $vet = [
            0 => 1, 
            1 => 2, 
            2 => 3, 
            3 => 4, 
            4 => 5,
            5 => 6,
            6 => 7,
            7 => 8,
            8 => 9, 
            9 => 10
        ];
        
        $aux = '';

        echo '<pre>';
        for($i = 0; $i < count($vet); $i++) {
            if($vet[$i] == 6) {
                for($j = $i; $j < count($vet); $j++) {
                    if(($j + 1) < count($vet)) {
                        $vet[$j] = $vet[$j + 1];
                    } else if($j == count($vet) - 1) {
                        $vet[$j] = null;
                    }
                    //$vet[$j] = $aux;
                }
            }
        }

        die(var_dump($vet));*/

        $loc = $request->session()->get('locale');

        if(is_null($loc)){
            \Session::put('locale', 'en');
        }

        if((isset($_GET['locale']) && !empty($_GET['locale']))){
            \Session::put('locale', $_GET['locale']);
        }
        
        return view('layouts.frontend.app');
    }

    public function getTranslations($locale = null) {
        // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
        switch ($locale) {
            case 'br':
                $locale = 'pt_BR';
                break;
            case 'es': {
                $locale = 'es_ES';
            }
            default:
                $locale = 'en';
                break;
        }
        $lang_files = File::files(resource_path() . '/lang/' . $locale);
        $trans = [];
        foreach ($lang_files as $f) {
            $filename = pathinfo($f)['filename'];
            $trans[$filename] = trans($filename);
        }


        $loc = request()->session()->get('locale');

        if(is_null($loc)){
            \Session::put('locale', 'en');
        }

        if(isset($locale) && !empty($locale)){
            \Session::put('locale', $locale);
        }

        //dd(request()->session()->all());

        return response()->json($trans, 200);
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
