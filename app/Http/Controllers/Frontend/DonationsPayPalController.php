<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\DonationType;
use App\Model\SRO\Account\SkSilk;
use App\Model\SRO\Account\SkSilkBuyList;
use App\Model\SRO\Account\SkSilkChangeByWeb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use Throwable;

class DonationsPayPalController extends Controller
{


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPaypal(Request $request)
    {

        $id = $request->input('id');

        $donationType = DonationType::find($id);

        $response = $this->gateway()->purchase([
            'currency' => 'USD',
            'amount' => $donationType->price,
            'description' => $donationType->name_merchant,
            'returnUrl' => url('account/donations/donate-paypal-complete'),
            'cancelUrl' => url('account/donations/donate-paypal-error'),
        ])->send();

        Invoice::create([
            'user_id' => Auth::id(),
            'doty_id' => $donationType->id,
            'total' => $donationType->price,
            'payment_id' => $response->getData()['id'],
            'description' => $donationType->name_merchant
        ]);

        if ($response->isRedirect()) {
            $response->redirect();
        } elseif ($response->isSuccessful()) {
            // payment was successful: update database: IDK How to test this ???
        } else {
            // payment failed: update database: IDK How to test this ???
        }

    }

    public function complete(Request $request)
    {

        $response = $this->gateway()->completePurchase(
            [
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ]
        )->send();

        $data = $response->getData();

        $invoice = Invoice::where('payment_id', $data['id'])->first();

        if ($invoice->closed === 1) {
            return redirect()->route('donate-paypal-invoice-closed');
        }

        if ($data['state'] === 'approved') {

            try {

                $donationType = $invoice->donationType;
                $user = Auth::user();

                $skSilk = SkSilk::where('JID', $user->jid)->first();

                $currentSilk = $skSilk->silk_own;
                $silkToAdd = $donationType->silk;

                $skSilk->increment('silk_own', $silkToAdd);

                SkSilkBuyList::create([
                    'UserJID' => $user->jid,
                    'Silk_Type' => SkSilkBuyList::SilkTypeVoucher,
                    'Silk_Reason' => SkSilkBuyList::SilkReasonWeb,
                    'Silk_Offset' => $currentSilk,
                    'Silk_Remain' => $currentSilk + $silkToAdd,
                    'ID' => $user->jid,
                    'BuyQuantity' => $silkToAdd,
                    'OrderNumber' => $invoice->id,
                    'AuthDate' => Carbon::now()->format('Y-m-d H:i:s'),
                    'SlipPaper' => 'PayPal: ' . $data['id'],
                    'IP' => $request->ip(),
                    'RegDate' => Carbon::now()->format('Y-m-d H:i:s')
                ]);

                SkSilkChangeByWeb::create([
                    'JID' => $user->jid,
                    'silk_remain' => $currentSilk + $silkToAdd,
                    'silk_offset' => $silkToAdd,
                    'silk_type' => SkSilkChangeByWeb::SilkTypeSilk,
                    'reason' => SkSilkChangeByWeb::SilkReasonBuy,
                ]);

                $invoice->paid = 1;
                $invoice->closed = 1;
                $invoice->save();

                return redirect()->route('donate-paypal-success');

            } catch (Throwable $e) {
                report($e); // TODO: Test this
                return redirect()->route('donate-paypal-error');
            }

        } else { // TODO: Test this
            return redirect()->route('donate-paypal-error');
        }

    }

    private function gateway()
    {
        $gateway = Omnipay::create('PayPal_Rest');

        $mode = config('paypal.mode');

        if ($mode === 'live') {
            $gateway->setClientId(config('paypal.live.clientId'));
            $gateway->setSecret(config('paypal.live.secret'));
        } else {
            $gateway->setClientId(config('paypal.sandbox.clientId'));
            $gateway->setSecret(config('paypal.sandbox.secret'));
            $gateway->setTestMode(true);
        }

        return $gateway;

    }

    public function success()
    {
        return view('frontend.account.donations.success');
    }

    public function error()
    {
        return view('frontend.account.donations.error');
    }

    public function invoiceClosed()
    {
        return view('frontend.account.donations.invoiceclosed');
    }

}
