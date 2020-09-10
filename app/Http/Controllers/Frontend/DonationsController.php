<?php

namespace App\Http\Controllers\Frontend;

use App\Model\SRO\Account\SkSilk;
use App\Model\SRO\Account\SkSilkBuyList;
use App\Http\Controllers\Controller;
use App\Item;
use App\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Srmklive\PayPal\Services\ExpressCheckout;

class DonationsController extends Controller
{
     /**
     * @var ExpressCheckout
     */
    protected $provider;

    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = Item::where('created_at', '<=', Carbon::Now())
            ->orderBy('created_at', 'DESC')->take(3)->get();
        return view('frontend.donations.index', [
            'items' => $items
        ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPaypal(Request $request)
    {

        $data = [];
        $id =  $request->input('id');

        $item = Item::find($id);


        $data['items'] = [
            [
                'name' => $item->item_name,
                'price' => $item->item_price,
                'qty' => 1
            ]
        ];

        $invoice = Invoice::create([
            'user_id' =>  Auth::id(),
            'item_id' => $item->id,
            'total'   => $item->item_price,
            'description' => $item->item_desc
        ]);


        $data['invoice_id'] = $invoice->id;
        $data['invoice_description'] = $invoice->description;
        $data['total'] = $item->item_price;
        $data['return_url'] = url('donations/success');
        $data['cancel_url'] = url('donations/error');

        try{
            $response = $this->provider->setExpressCheckout($data);
            return redirect($response['paypal_link']);
        }catch (Throwable $e) {
            return redirect()->route('donations-index')->with('error', __('donations.notification.buy.error'));
        }


    }

    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function error()
    {
        return redirect()->route('donations-index')->with('error', __('donations.notification.buy.error'));
    }



    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */

    public function success(Request $request)

    {
        $token = $request->get('token');
        $response = $this->provider->getExpressCheckoutDetails($token);
        $ip=  $request->ip();


        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            try{

                $invoice =  Invoice::find($response['INVNUM']);
                $item = $invoice->item;
                $getTbUser = Auth::user();

                $silk = SkSilkBuyList::create([
                    'UserJID' => $getTbUser->jid,
                    'Silk_Type' => SkSilkBuyList::SilkTypeVoucher,
                    'Silk_Reason' => SkSilkBuyList::SilkReasonWeb,
                    'Silk_Offset' => SkSilk::where('JID', $getTbUser->jid)->pluck('silk_own')->first(),
                    'Silk_Remain' => SkSilk::where('JID', $getTbUser->jid)->pluck('silk_own')->first() + $item->item_silk,
                    'ID' => $getTbUser->jid,
                    'BuyQuantity' => $item->item_silk,
                    'OrderNumber' => 0,
                    'AuthDate' => Carbon::now()->format('Y-m-d H:i:s'),
                    'SlipPaper' => 'dunno',
                    'IP' => $ip,
                    'RegDate' => Carbon::now()->format('Y-m-d H:i:s')
                ]);

                SkSilk::where('JID', $getTbUser->jid)
                    ->increment(
                        'silk_own', $item->item_silk
                    );

                return redirect()->route('home')->with('success', __('donations.notification.buy.successfully'));

            }catch (Throwable $e) {
                report($e);
                return redirect()->route('donations-index')->with('error', __('donations.notification.buy.error'));

            }

        }
        return redirect()->route('donations-index')->with('error', __('donations.notification.buy.error'));

    }


}
