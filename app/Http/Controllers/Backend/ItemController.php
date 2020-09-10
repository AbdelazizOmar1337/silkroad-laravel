<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = Item::all();        
        return view('backend.item.index', [
            'items' => $items 
        ]);
    
    }

    public function create(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'item_name' => 'required',
            'item_silk' => 'required',
            'item_desc' => 'required',
            'item_price' => 'required'            
        ]);

        Item::create($data);

        return redirect()->back()->with('success', __('backend/notification.form-submit.success'));
    }
 
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addForm()
    {
        return view('backend.item.create');
    }
   /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $news = Item::findOrFail($id);
        $news->delete();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }
}
