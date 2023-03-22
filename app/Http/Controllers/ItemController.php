<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Rules\importRule;
use App\Imports\itemsImport;
use App\Imports\FirstSheetImport;
use App\Exports\itemExport;
use App\Exports\export;
use Illuminate\Http\Request;
use View;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;
use MPDF;
use Yajra\Datatables\Datatables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $item = Item::all();
        // return View::make('item.index',compact('item'));
        // $item = Item::select('description','cost_price','sell_price')->get();
        // // return view('item.index',compact('items'));
        // return Datatables::of($item)->make(true);
        return view('item.index');  
    }

    public function getItem(){
        $items = Item::select('item_id','description','cost_price','sell_price');
        // ->orderBy('item_id','desc');
        // dd($items);
        return Datatables::of($items)->make();
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if($request->hasFile('img_path')) {
            $image = $request->file('img_path')->getClientOriginalName(); 
            // dd( $request->file('img_path')); 
            $request->file('img_path')->storeAs('public/images', $image); 
            $input['img_path'] = 'storage/images/' .$image;
            // dd($input);
        }
        $item = Item::create($input);
        return Redirect::to('item')->with('success','artist deleted!');
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
        $item = Item::find($id);
        return View::make('item.edit',compact('item'));
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
        $item = Item::find($id);
         $item->update($request->all());
         return Redirect::to('item')->with('success','item updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $item = Item::find($id);
         $item->delete();
         return Redirect::to('item')->with('success','item deleted!');
    }

    public function import(Request $request) {
        $request->validate([
                'item_upload' => ['required', new importRule($request->file('item_upload'))],
            ]);

            Excel::import(new itemsImport, request()->file('item_upload')->store('temp'));

            return redirect()->back()->with('success', 'Excel file Imported Successfully');
        }

        public function export() 
        {
            return Excel::download(new export, 'item.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        }
}
