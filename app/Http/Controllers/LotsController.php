<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lots;
use App\Models\Categories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DateTime;

class LotsController extends Controller
{
   public function getRulesStore(){
    return[
        'name' => 'required|string|min:3|max:255|regex:/^[0-9a-zA-Zа-яА-ЯЫыУуШшЩщХхРрТтЬьЪъЮюҐґЭэЄєІіЇїЁё ]+$/',
        'description' => 'required|string|min:1|max:5000|regex:/^[0-9a-zA-Zа-яА-ЯЫыУуШшЩщХхРрТтЬьЪъЮюҐґЭэЄєІіЇїЁё.?:!,#)(@%&-=+ ]+$/',
        'categoryid' => 'required|numeric'
    ];
   }
   public function getRulesEdit(){
    return[
        'name' => 'required|string|min:3|max:255|regex:/^[0-9a-zA-Zа-яА-ЯЫыУуШшЩщХхРрТтЬьЪъЮюҐґЭэЄєІіЇїЁё ]+$/',
        'description' => 'required|string|min:25|max:5000|regex:/^[0-9a-zA-Zа-яА-ЯЫыУуШшЩщХхРрТтЬьЪъЮюҐґЭэЄєІіЇїЁё.?:!,#)(@%&-=+ ]+$/',
        'categoryid' => 'required|numeric'
    ];
   }
   public function getMessages(){
    return [
            'name.min' => 'Minimum 3 character!',
            'name.max' => 'Maximum 255 characters!',
            'description.min' => 'Minimum 25 character!',
            'description.max' => 'Maximum 5000 characters!',
            'regex' => 'There are illegal characters!',
            'numeric' => 'You need to enter a number!'
        ];
   }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Categories::all();
        if(isset($request['name'])){
            $lots = DB::table('lots')->
                join('categories','categoryid','=','categories.id')->orderBy('id')->
                where('lots.name','LIKE','%'.$request['name'].'%')->
                get(['lots.id as id','lots.name as name','lots.description as description','categories.name as category_name']);
            return view('lots.index', compact('lots'));  
        }elseif (isset($request['categoryName'])){
             $lots = DB::table('lots')->
                join('categories','categoryid','=','categories.id')->orderBy('id')->
                where('categories.name','LIKE','%'.$request['categoryName'].'%')->
                get(['lots.id as id','lots.name as name','lots.description as description','categories.name as category_name']);
            return view('lots.index', compact('lots'));
        }
        else{
            $lots = DB::table('lots')->
                join('categories','categoryid','=','categories.id')->orderBy('id')->
                get(['lots.id as id','lots.name as name','lots.description as description','categories.name as category_name']);
        return view('lots.index', compact('lots'));      
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::orderBy('id')->get();
        return view('lots.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lot = new Lots();
        $validator = Validator::make($request->all(), $this->getRulesStore(), $this->getMessages());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $lot->name = $request->get('name');
        $lot->description = $request->get('description');
        $lot->categoryid = $request->get('categoryid');
        $lot->created_at = new DateTime();
        $lot->updated_at = new DateTime();

        $lot->save();

        return redirect('/lots');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $lot = Lots::find($id);
        $category = Categories::find($lot->categoryid);
        
        if(!isset($lot))
        {
            return redirect('/lots');
        }

        return view('lots.show', compact('lot','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lot = Lots::find($id);
        $categories = Categories::all();
        
        if(!isset($lot))
        {
            return redirect('/lots');
        }

        return view('lots.edit', compact('lot','categories'));
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
        $lot = Lots::find($id);
        
        if(!isset($lot))
        {
            return redirect('/lots');
        }

        $validator = Validator::make($request->all(), $this->getRulesEdit(), $this->getMessages());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $lot->name = $request->get('name');
        $lot->description = $request->get('description');
        $lot->categoryid = $request->get('categoryid');
        $lot->updated_at = new DateTime();
        
        $lot->save();

        return redirect('/lots');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lot = Lots::find($id);

        if(!isset($lot))
        {
            return redirect('/lots');
        }

        $lot->delete();

        return redirect('/lots');
    }

    
}
