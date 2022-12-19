<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;
use DateTime;

class CategoriesController extends Controller
{
   public function getRulesStore()
    {
        return [
            'name' => 'required|string|min:5|max:255|regex:/^[0-9a-zA-Zа-яА-ЯЫыУуШшЩщХхРрТтЬьЪъЮюҐґЭэЄєІіЇїЁё ]+$/',
        ];
    }
    public function getRulesEdit()
    {
        return [
            'name' => 'required|string|min:5|max:255|regex:/^[0-9a-zA-Zа-яА-ЯЫыУуШшЩщХхРрТтЬьЪъЮюҐґЭэЄєІіЇїЁё ]+$/',
        ];
    }
    public function getMessages()
    {
        return [
            'name.min' => 'Minimum 5 character!',
            'name.max' => 'Maximum 255 characters!',
            'required' => 'This field must be filled!',
            'string' => 'You need to enter a string!',
            'regex' => 'There are illegal characters!'
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
            $categories = DB::table('categories')->
                where('categories.name','LIKE','%'.$request['name'].'%')->orderBy('id')->get();
            return view('categories.index', compact('categories'));
        }
        else{
            $categories = Categories::orderBy('id')->get();
            return view('categories.index', compact('categories'));     
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Categories();
        $validator = Validator::make($request->all(), $this->getRulesStore(), $this->getMessages());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $category->name = $request->get('name');
        $category->created_at = new DateTime();
        $category->updated_at = new DateTime();

        $category->save();

        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Не уверен что этот метод нужен, но я его добавил
    public function show($id)
    {
        $category = Categories::find($id);
        
        if(!isset($category))
        {
            return redirect('/categories');
        }

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::find($id);
        
        if(!isset($category))
        {
            return redirect('/categories');
        }

        return view('categories.edit', compact('category'));
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
        $category = Categories::find($id);
        
        if(!isset($category))
        {
            return redirect('/categories');
        }

        $validator = Validator::make($request->all(), $this->getRulesEdit(), $this->getMessages());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $category->name = $request->get('name');
        $category->updated_at = new DateTime();

        $category->save();

        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::find($id);

        if(!isset($category))
        {
            return redirect('/categories');
        }

        //Вылезет ошибка если айди категории указан в другой таблице
        $category->delete();

        return redirect('/categories');
    }
}
