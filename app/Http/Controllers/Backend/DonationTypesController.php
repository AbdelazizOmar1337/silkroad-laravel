<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DonationType;
use Illuminate\Http\Request;

class DonationTypesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('backend.donationtypes.index', [
            'items' => DonationType::all()
        ]);

    }

    public function create(Request $request)
    {

        $data = $request->validate([
            'name_web' => 'required',
            'description' => 'required',
            'name_merchant' => 'required',
            'silk' => 'required',
            'price' => 'required'
        ]);

        DonationType::create($data);

        return redirect()->route('donation-types-index-datatables-backend')->with('success', __('backend/notification.form-submit.success'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addForm()
    {
        return view('backend.donationtypes.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $silkItem = DonationType::findOrFail($id);
        $silkItem->delete();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }
}
