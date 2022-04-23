<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Shipping::insert([
            [ 'city'=> 'القاهرة', 'lat'=> '30.0561', 'long'=> '31.2394', 'status'=> 1],
            [ 'city'=> 'الجيزة', 'lat'=> '29.9870', 'long'=> '31.2118', 'status'=> 1],
            [ 'city'=> 'شبرا الخيمة', 'lat'=> '30.1286', 'long'=> '31.2422', 'status'=> 1],
            [ 'city'=> 'المنصورة', 'lat'=> '31.0500', 'long'=> '31.3833', 'status'=> 1],
            [ 'city'=> 'حلوان', 'lat'=> '29.8419', 'long'=> '31.3342', 'status'=> 1],
            [ 'city'=> 'المحلة الكبري', 'lat'=> '30.9667', 'long'=> '31.1667', 'status'=> 1],
            [ 'city'=> 'بور سعيد', 'lat'=> '31.2500', 'long'=> '32.2833', 'status'=> 1],
            [ 'city'=> 'السويس', 'lat'=> '29.9667', 'long'=> '32.5333', 'status'=> 1],
            [ 'city'=> 'طنطا', 'lat'=> '30.7833', 'long'=> '31.0000', 'status'=> 1],
            [ 'city'=> 'الفيوم', 'lat'=> '29.3000', 'long'=> '30.8333', 'status'=> 1],
            [ 'city'=> 'الزقازيق', 'lat'=> '30.5667', 'long'=> '31.5000', 'status'=> 1],
            [ 'city'=> 'الاسماعيلية', 'lat'=> '30.5833', 'long'=> '32.2667', 'status'=> 1],
            [ 'city'=> 'اسوان', 'lat'=> '24.0889', 'long'=> '32.8997', 'status'=> 1],
            [ 'city'=> 'كفر الدوار', 'lat'=> '31.1417', 'long'=> '30.1272', 'status'=> 1],
            [ 'city'=> 'دمنهور', 'lat'=> '31.0500', 'long'=> '30.4667', 'status'=> 1],
            [ 'city'=> 'الاسكندرية', 'lat'=> '31.2000', 'long'=> '29.9167', 'status'=> 1],
            [ 'city'=> 'المنيا', 'lat'=> '28.0833', 'long'=> '30.7500', 'status'=> 1],
            [ 'city'=> 'دمياط', 'lat'=> '31.4167', 'long'=> '31.8214', 'status'=> 1],
            [ 'city'=> 'الاقصر', 'lat'=> '25.6969', 'long'=> '32.6422', 'status'=> 1],
            [ 'city'=> 'قنا', 'lat'=> '26.1667', 'long'=> '32.7167', 'status'=> 1],
            [ 'city'=> 'بني سويف', 'lat'=> '29.0667', 'long'=> '31.0833', 'status'=> 1],
            [ 'city'=> 'شبين الكوم', 'lat'=> '30.5920', 'long'=> '30.9000', 'status'=> 1],
            [ 'city'=> 'العريش', 'lat'=> '31.1249', 'long'=> '33.8006', 'status'=> 1],
            [ 'city'=> 'الغردقة', 'lat'=> '27.2578', 'long'=> '33.8117', 'status'=> 1],
            [ 'city'=> 'بنها', 'lat'=> '30.4628', 'long'=> '31.1797', 'status'=> 1],
            [ 'city'=> 'كفر الشيخ', 'lat'=> '31.1000', 'long'=> '30.9500', 'status'=> 1],
            [ 'city'=> 'دسوق', 'lat'=> '31.1308', 'long'=> '30.6479', 'status'=> 1],
        ]);

    }
}
