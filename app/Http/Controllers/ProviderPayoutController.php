<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderPayout;
use App\Models\Booking;
use App\Models\User;
use App\DataTables\PayoutHistoryDataTable;
use App\Http\Requests\ProviderPayout as ProviderPayoutRequest;

class ProviderPayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PayoutHistoryDataTable $dataTable)
    {
        $pageTitle = trans('messages.payout_history' );
        $auth_user = authSession();
        $assets = ['datatable'];
        return $dataTable->render('providerpayout.index', compact('pageTitle','auth_user','assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $auth_user = authSession();
        $pageTitle = trans('messages.add_button_form',['form' => trans('messages.provider_payout')]);
        $payoutdata = new ProviderPayout;

        $provider = User::with('providertype')->find($id);

        $bookings = Booking::where('provider_id',$id)->whereNotNull('payment_id')->get();

        $providerEarning = ProviderPayout::where('provider_id',$id)->sum('amount');

        $provider_commission = optional($provider->providertype)->commission;

        $provider_type = optional($provider->providertype)->type;

        $booking_data = get_provider_commission($bookings);

        $provider_earning = calculate_commission($booking_data['total_amount'],$provider_commission,$provider_type,'provider', $providerEarning);

        if($provider_earning['number_format'] <= 0){
            if (request()->wantsJson()) {
                return response()->json(['messages' => __('messages.provider_earning_error'), 'status' => false]);
            } else {
                return redirect()->route('home')->with('error', __('messages.provider_earning_error'));
            }
        }

        $payoutdata->amount_formate = $provider_earning['value'];

        $payoutdata->amount = number_format($provider_earning['number_format']);

        $payoutdata->provider_id = $id;

        return view('providerpayout.create', compact('pageTitle' ,'payoutdata' ,'auth_user' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderPayoutRequest $request)
    {
        if(demoUserPermission()){
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $data = $request->except('_token');

        ProviderPayout::create($data);

        return redirect()->route('earning')->with('success', __('messages.created_success',['form' => 'Provider Payout']));

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
