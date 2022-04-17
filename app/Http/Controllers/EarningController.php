<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\ProviderPayout;

use Yajra\DataTables\DataTables;
class EarningController extends Controller
{
    public function index(){
        $pageTitle = "test";
        return view('earning.index',compact('pageTitle'));
    }
    public function setEarningData(Request $request){
        $auth_user = authSession();
        $providers = User::with('providertype')->where('user_type','provider')->get();
        $earningData = array();
        foreach ($providers as $provider) {
            $provider_commission = optional($provider->providertype)->commission;
            $provider_type = optional($provider->providertype)->type;

            $bookings = Booking::where('provider_id',$provider->id)->whereNotNull('payment_id')->get();

            $booking_data = get_provider_commission($bookings);

            $providerEarning = ProviderPayout::where('provider_id',$provider->id)->sum('amount') ?? 0;

            $provider_earning = calculate_commission($booking_data['total_amount'],$provider_commission,$provider_type,'provider', $providerEarning,$bookings->count());

            $admin_earning  = calculate_commission($booking_data['total_amount'],$provider_commission,$provider_type, '', $providerEarning,$bookings->count());

            $earningData[] = [
                'provider_id' => $provider->id,
                'provider_name' => $provider->display_name,
                'commission' => format_commission($provider),
                'total_bookings' => $bookings->count(),
                'total_earning' => format_number_field($booking_data['total_amount']),
                'taxes' => format_number_field($booking_data['tax']),
                'admin_earning' => $admin_earning['value'],
                'provider_earning' => $provider_earning['number_format'] <= 0 ? getPriceFormat($providerEarning) : $provider_earning['value'],
                'provider_earning_formate' => $provider_earning['number_format'],
            ];

        }
        if ($request->ajax()) {
            return Datatables::of($earningData)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '-';
                $provider_id = $row['provider_id'];
                if($row['provider_earning_formate'] > 0){
                    $btn = "<a href=". route('providerpayout.create',$provider_id) ."><i class='fas fa-money-bill-alt'></i></a>";
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
