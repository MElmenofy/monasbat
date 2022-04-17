<?php

namespace App\Http\Controllers;

use App\Models\ProviderAddressMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use App\DataTables\ProviderDataTable;
use App\DataTables\ServiceDataTable;
use App\Http\Requests\UserRequest;
class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProviderDataTable $dataTable, Request $request)
    {
        $pageTitle = __('messages.list_form_title',['form' => __('messages.provider')] );
        $auth_user = authSession();
        $assets = ['datatable'];
        return $dataTable
            ->with('list_status',$request->status)
            ->render('provider.index', compact('pageTitle','auth_user','assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $auth_user = authSession();
        $user_h = User::where('user_type', 'handyman')->get();
        $providerdata = User::find($id);
        $pageTitle = __('messages.update_form_title',['form'=> __('messages.provider')]);

        if($providerdata == null){
            $pageTitle = __('messages.add_button_form',['form' => __('messages.provider')]);
            $providerdata = new User;
        }

        return view('provider.create', compact('pageTitle' ,'providerdata' ,'auth_user', 'user_h' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if(demoUserPermission()){
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }


        $data['handyman_id'] = $request->handyman_id;
        if ($request->user_type == 'provider'){
            $request['uid'] = $request->first_name . $request->last_name . $request->contact_number;
        }
        $data = $request->all();
//        return $data;
        $id = $data['id'];
        $data['user_type'] = $data['user_type'] ?? 'provider';
        $data['is_featured'] = 0;

        if($request->has('is_featured')){
            $data['is_featured'] = 1;
        }
        $data['display_name'] = $data['first_name']." ".$data['last_name'];
        // Save User data...
        if($id == null){


//            return $data;
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);


            $u = DB::table('users')->latest()->first();
            $last_id = $u->id;
            ProviderAddressMapping::insert([
                ['provider_id'=>$last_id, 'address'=> 'Cairo', 'latitude'=> '30.0561', 'longitude'=> '31.2394', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'Giza', 'latitude'=> '29.9870', 'longitude'=> '31.2118', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Shubra al Khaymah', 'latitude'=> '30.1286', 'longitude'=> '31.2422', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'al-Mansurah', 'latitude'=> '31.0500', 'longitude'=> '31.3833', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Halwan', 'latitude'=> '29.8419', 'longitude'=> '31.3342', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'al-Mahallah al-Kubra', 'latitude'=> '30.9667', 'longitude'=> '31.1667', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Port Said', 'latitude'=> '31.2500', 'longitude'=> '32.2833', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Suez', 'latitude'=> '29.9667', 'longitude'=> '32.5333', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'Tanta', 'latitude'=> '30.7833', 'longitude'=> '31.0000', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Al Fayyum', 'latitude'=> '29.3000', 'longitude'=> '30.8333', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'az-Zaqaziq', 'latitude'=> '30.5667', 'longitude'=> '31.5000', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Ismailia', 'latitude'=> '30.5833', 'longitude'=> '32.2667', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Aswan', 'latitude'=> '24.0889', 'longitude'=> '32.8997', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'Kafr-ad-Dawwar', 'latitude'=> '31.1417', 'longitude'=> '30.1272', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'Damanhur', 'latitude'=> '31.0500', 'longitude'=> '30.4667', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Al Minya', 'latitude'=> '28.0833', 'longitude'=> '30.7500', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'Damietta', 'latitude'=> '31.4167', 'longitude'=> '31.8214', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Luxor', 'latitude'=> '25.6969', 'longitude'=> '32.6422', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Qina', 'latitude'=> '26.1667', 'longitude'=> '32.7167', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Bani Suwayf', 'latitude'=> '29.0667', 'longitude'=> '31.0833', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'Shibin-al-Kawm', 'latitude'=> '30.5920', 'longitude'=> '30.9000', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Al Arish', 'latitude'=> '31.1249', 'longitude'=> '33.8006', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Al Ghardaqah', 'latitude'=> '27.2578', 'longitude'=> '33.8117', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'Banha', 'latitude'=> '30.4628', 'longitude'=> '31.1797', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'Kafr-ash-Shaykh', 'latitude'=> '31.1000', 'longitude'=> '30.9500', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'Disuq', 'latitude'=> '31.1308', 'longitude'=> '30.6479', 'status'=> 1],
                ['provider_id'=>$last_id, 'address'=> 'Bilbays', 'latitude'=> '30.4167', 'longitude'=> '31.5667', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Mit Ghamr', 'latitude'=> '30.7192', 'longitude'=> '31.2628', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Munuf', 'latitude'=> '30.4667', 'longitude'=> '30.9333', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Zifta', 'latitude'=> '30.7119', 'longitude'=> '31.2394', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Samalut', 'latitude'=> '28.3000', 'longitude'=> '30.7167', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Bani Mazar', 'latitude'=> '28.5000', 'longitude'=> '30.8000', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Samannud', 'latitude'=> '30.9622', 'longitude'=> '31.2425', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'san al Hajar al Qibliyah', 'latitude'=> '30.9769', 'longitude'=> '31.8800', 'status'=> 1],
//                ['provider_id'=>$last_id, 'address'=> 'Abu Qir', 'latitude'=> '31.3167', 'longitude'=> '30.0667', 'status'=> 1]
            ]);



        }else{
            $user = User::findOrFail($id);
            // User data...
            $user->removeRole($user->user_type);
            $user->fill($data)->update();
        }
        $user->assignRole($data['user_type']);
        storeMediaFile($user,$request->profile_image, 'profile_image');
        $message = __('messages.update_form',[ 'form' => __('messages.provider') ] );
        if($user->wasRecentlyCreated){
            $message = __('messages.save_form',[ 'form' => __('messages.provider') ] );
        }
        if($user->providerTaxMapping()->count() > 0)
        {
            $user->providerTaxMapping()->delete();
        }
        if($request->tax_id != null) {
            foreach($request->tax_id as $tax) {
                $provider_tax = [
                    'provider_id'   => $user->id,
                    'tax_id'   => $tax,
                ];
                $user->providerTaxMapping()->insert($provider_tax);
            }
        }

        if($request->is('api/*')) {
            return comman_message_response($message);
        }

        return redirect(route('provider.index'))->withSuccess($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceDataTable $dataTable,$id)
    {
        $auth_user = authSession();
        $providerdata = User::with('getServiceRating')->where('user_type','provider')->where('id',$id)->first();

        if(empty($providerdata))
        {
            $msg = __('messages.not_found_entry',['name' => __('messages.provider')] );
            return redirect(route('provider.index'))->withError($msg);
        }
        $pageTitle = __('messages.view_form_title',['form'=> __('messages.provider')]);
        return $dataTable
            ->with('provider_id',$id)
            ->render('provider.view', compact('pageTitle' ,'providerdata' ,'auth_user' ));
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
        if(demoUserPermission()){
            return  redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $provider = User::find($id);
        $msg= __('messages.msg_fail_to_delete',['name' => __('messages.provider')] );

        if($provider != '') {
            $provider->delete();
            $msg= __('messages.msg_deleted',['name' => __('messages.provider')] );
        }

        return redirect()->back()->withSuccess($msg);
    }
    public function action(Request $request){
        $id = $request->id;

        $provider  = User::withTrashed()->where('id',$id)->first();
        $msg = __('messages.not_found_entry',['name' => __('messages.provider')] );
        if($request->type == 'restore') {
            $provider->restore();
            $msg = __('messages.msg_restored',['name' => __('messages.provider')] );
        }

        if($request->type === 'forcedelete'){
            $provider->forceDelete();
            $msg = __('messages.msg_forcedelete',['name' => __('messages.provider')] );
        }

        return comman_custom_response(['message'=> $msg , 'status' => true]);
    }
}
