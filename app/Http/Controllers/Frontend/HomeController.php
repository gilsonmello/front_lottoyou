<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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
