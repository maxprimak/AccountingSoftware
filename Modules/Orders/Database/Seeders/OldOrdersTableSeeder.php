<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\RepairOrder;

class OldOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $orders = (array) json_decode($this->getOrdersTableInJSON());
        $repairOrders = (array) json_decode($this->getRepairOrdersTableInJSON());

        foreach($orders as $eachOrder){
            $eachOrder = (array) $eachOrder;

            $order = new Order();
            $order->id = $eachOrder['id'];
            $order->accept_date = $eachOrder['accept_date'];
            $order->price = $eachOrder['price'];
            $order->branch_id = $eachOrder['branch_id'];
            $order->created_at = $eachOrder['created_at'];
            $order->updated_at = $eachOrder['updated_at'];
            $order->created_by = $eachOrder['created_by'];

            $order->save();
        }


        foreach($repairOrders as $eachRepairOrder){
            $eachRepairOrder = (array) $eachRepairOrder;

            $repairOrder = new RepairOrder();
            $repairOrder->id = $eachRepairOrder['id'];
            $repairOrder->order_id = $eachRepairOrder['order_id'];
            $repairOrder->order_nr = $eachRepairOrder['order_nr'];
            $repairOrder->customer_id = $eachRepairOrder['customer_id'];
            $repairOrder->comment = "Defect Description: " . $eachRepairOrder['defect_description']
                                    . " / Comment: " . $eachRepairOrder['comment'];
            $repairOrder->status_id = ($eachRepairOrder['status_id'] == 9) ? 2 : $eachRepairOrder['status_id'];
            $repairOrder->prepay_sum = $eachRepairOrder['prepay_sum'];
            $repairOrder->deadline = null;
            $repairOrder->is_completed = 0;
            $repairOrder->payment_status_id = 1;
            $repairOrder->warranty_id = 1;
            $repairOrder->discount_code_id = 1;
            $repairOrder->order_type_id = ($eachRepairOrder['status_id'] == 9) ? 3 : 1;
            $repairOrder->created_at = $eachRepairOrder['created_at'];
            $repairOrder->updated_at = $eachRepairOrder['updated_at'];

            $repairOrder->save();
        }

    }

    public function getRepairOrdersTableInJSON(){
        $result = '[
            {
              "id": 20,
              "order_id": 29,
              "order_nr": "1200",
              "customer_id": 20,
              "defect_description": "iPhone 7+ LCD / iPhone 7+ Vibere / iPhone X LCD",
              "comment": "Abgeholt am 10.12.2019",
              "status_id": 5,
              "prepay_sum": 0,
              "located_in": 4,
              "created_at": "2019-10-30 10:29:35",
              "updated_at": "2019-12-10 17:23:51"
            },
            {
              "id": 21,
              "order_id": 30,
              "order_nr": "1159",
              "customer_id": 21,
              "defect_description": "Handy lässt sich nicht benutzen ( geht nicht zu reparieren )",
              "comment": "KD hat bei uns seinen Display tauschen lassen, Face ID hat daraufhin nicht funtioniert und KD hat das Geld zurückbekommen. Nicht reparabel, mit Musti abklären",
              "status_id": 6,
              "prepay_sum": 0,
              "located_in": 4,
              "created_at": "2019-10-30 10:36:16",
              "updated_at": "2019-10-30 11:08:10"
            },
            {
              "id": 25,
              "order_id": 34,
              "order_nr": "1062",
              "customer_id": 25,
              "defect_description": "samsung s7e schaltet nicht ein",
              "comment": "kd hat am 13.11 abgeholt",
              "status_id": 6,
              "prepay_sum": 0,
              "located_in": 4,
              "created_at": "2019-10-30 11:18:02",
              "updated_at": "2019-11-13 15:09:59"
            },
            {
              "id": 35,
              "order_id": 64,
              "order_nr": "1075",
              "customer_id": 35,
              "defect_description": "bleibt bei Apple logo",
              "comment": "kd abgeholt",
              "status_id": 6,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-11-04 09:22:53",
              "updated_at": "2019-11-22 16:31:18"
            },
            {
              "id": 36,
              "order_id": 65,
              "order_nr": "1076",
              "customer_id": 36,
              "defect_description": "ip 7 touch funktionert nicht wlan chip problem",
              "comment": "fertig",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-11-04 09:55:48",
              "updated_at": "2019-12-06 08:13:50"
            },
            {
              "id": 39,
              "order_id": 68,
              "order_nr": "1086",
              "customer_id": 39,
              "defect_description": "ip 6 touch funktioniert nicht",
              "comment": "Sahyan ruft den KD an",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-11-06 13:37:32",
              "updated_at": "2019-11-11 09:49:50"
            },
            {
              "id": 43,
              "order_id": 72,
              "order_nr": "1088",
              "customer_id": 43,
              "defect_description": "Samsung A7 Reklamation",
              "comment": "kd hat am 13.11 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-11-07 15:06:35",
              "updated_at": "2019-11-13 17:31:43"
            },
            {
              "id": 48,
              "order_id": 77,
              "order_nr": "1090",
              "customer_id": 48,
              "defect_description": "Datenübertragen",
              "comment": "wir haben es in huma 3 über itunes ein backup gemacht es sagt backup ist beschedigt schicken es ins dz alles ist schon bezahlt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-11-09 12:02:04",
              "updated_at": "2019-11-11 15:27:46"
            },
            {
              "id": 50,
              "order_id": 79,
              "order_nr": "1098",
              "customer_id": 50,
              "defect_description": "P30 lite google konto löschen",
              "comment": "am 18.11.2019  abgeholt",
              "status_id": 6,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-11-09 13:26:42",
              "updated_at": "2019-11-18 14:11:03"
            },
            {
              "id": 51,
              "order_id": 80,
              "order_nr": "1105",
              "customer_id": 51,
              "defect_description": "Mate 10 Pro Ladeconnector",
              "comment": "am 18.11.19 abgeholt",
              "status_id": 5,
              "prepay_sum": 30,
              "located_in": 4,
              "created_at": "2019-11-09 16:12:00",
              "updated_at": "2019-11-18 17:56:32"
            },
            {
              "id": 55,
              "order_id": 84,
              "order_nr": "1",
              "customer_id": 55,
              "defect_description": "iPhone 7 Display",
              "comment": "Repair in 2 days",
              "status_id": 9,
              "prepay_sum": 10,
              "located_in": 5,
              "created_at": "2019-11-11 07:34:38",
              "updated_at": "2020-01-08 13:56:14"
            },
            {
              "id": 59,
              "order_id": 88,
              "order_nr": "1110",
              "customer_id": 59,
              "defect_description": "i5s lcd i6 analyse",
              "comment": "kd am 14.11 angeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-11-12 12:11:16",
              "updated_at": "2019-11-14 13:41:15"
            },
            {
              "id": 61,
              "order_id": 90,
              "order_nr": "1115",
              "customer_id": 61,
              "defect_description": "Mate 10 pro Ohrlautsprecher",
              "comment": "am 18.11.19 abgeholt",
              "status_id": 5,
              "prepay_sum": 30,
              "located_in": 4,
              "created_at": "2019-11-12 16:19:05",
              "updated_at": "2019-11-18 17:56:21"
            },
            {
              "id": 71,
              "order_id": 100,
              "order_nr": "1119",
              "customer_id": 71,
              "defect_description": "Samsung S2 entsperren",
              "comment": "fertig am 22.11 abgeholt",
              "status_id": 5,
              "prepay_sum": 0,
              "located_in": 4,
              "created_at": "2019-11-16 09:58:27",
              "updated_at": "2019-11-22 16:27:00"
            },
            {
              "id": 75,
              "order_id": 104,
              "order_nr": "1120",
              "customer_id": 75,
              "defect_description": "Huawei-P30lite Custom Case",
              "comment": "kd am 19.11.2019 abgeholt",
              "status_id": 5,
              "prepay_sum": 29,
              "located_in": 4,
              "created_at": "2019-11-16 15:08:07",
              "updated_at": "2019-11-19 11:39:42"
            },
            {
              "id": 77,
              "order_id": 106,
              "order_nr": "179",
              "customer_id": 77,
              "defect_description": "Display bruch - glas und display muss erneuert werden",
              "comment": "Express reparatur (max. 1 tag)",
              "status_id": 1,
              "prepay_sum": 19.9,
              "located_in": 6,
              "created_at": "2019-11-17 12:36:17",
              "updated_at": "2019-11-17 12:36:17"
            },
            {
              "id": 91,
              "order_id": 120,
              "order_nr": "1127",
              "customer_id": 91,
              "defect_description": "Samsung S10e entsperren",
              "comment": "kd am 22.11.19 abgeholt",
              "status_id": 5,
              "prepay_sum": 59,
              "located_in": 4,
              "created_at": "2019-11-21 14:18:58",
              "updated_at": "2019-11-22 16:27:23"
            },
            {
              "id": 92,
              "order_id": 121,
              "order_nr": "001",
              "customer_id": 92,
              "defect_description": "i7 Display",
              "comment": null,
              "status_id": 3,
              "prepay_sum": 10,
              "located_in": 5,
              "created_at": "2019-11-21 18:39:40",
              "updated_at": "2020-01-08 13:56:03"
            },
            {
              "id": 98,
              "order_id": 127,
              "order_nr": "1255",
              "customer_id": 98,
              "defect_description": "A7 Display rep.",
              "comment": "kd am 28.11.2019 abgeholt",
              "status_id": 5,
              "prepay_sum": 20,
              "located_in": 4,
              "created_at": "2019-11-23 15:27:58",
              "updated_at": "2019-11-29 08:26:11"
            },
            {
              "id": 99,
              "order_id": 128,
              "order_nr": "001",
              "customer_id": 99,
              "defect_description": "iPhone 7 Display",
              "comment": "Hallo",
              "status_id": 1,
              "prepay_sum": 20,
              "located_in": 5,
              "created_at": "2019-11-24 19:55:24",
              "updated_at": "2020-01-08 13:57:59"
            },
            {
              "id": 109,
              "order_id": 139,
              "order_nr": "1257",
              "customer_id": 109,
              "defect_description": "Note8 Display + Rahmen",
              "comment": "am 04.12 abgeholt",
              "status_id": 5,
              "prepay_sum": 50,
              "located_in": 4,
              "created_at": "2019-11-27 12:19:54",
              "updated_at": "2019-12-04 12:21:12"
            },
            {
              "id": 115,
              "order_id": 145,
              "order_nr": "1260",
              "customer_id": 115,
              "defect_description": "Ip7 Service / Audio-Chip",
              "comment": "am 03.12 abgeholt",
              "status_id": 6,
              "prepay_sum": 0,
              "located_in": 4,
              "created_at": "2019-11-28 16:39:13",
              "updated_at": "2019-12-04 08:04:37"
            },
            {
              "id": 118,
              "order_id": 148,
              "order_nr": "1261",
              "customer_id": 118,
              "defect_description": "s7 edge backcover + akku rep",
              "comment": "kd am selbe tag abgeholt",
              "status_id": 5,
              "prepay_sum": 0,
              "located_in": 4,
              "created_at": "2019-11-29 11:20:54",
              "updated_at": "2019-12-02 08:37:47"
            },
            {
              "id": 124,
              "order_id": 154,
              "order_nr": "1269",
              "customer_id": 124,
              "defect_description": "IpXsMax Display Rep.",
              "comment": "am 04.12 abgeholt",
              "status_id": 5,
              "prepay_sum": 20,
              "located_in": 4,
              "created_at": "2019-12-02 10:34:23",
              "updated_at": "2019-12-04 12:43:18"
            },
            {
              "id": 125,
              "order_id": 155,
              "order_nr": "1271",
              "customer_id": 125,
              "defect_description": "A7 2018 Display Rep.",
              "comment": "kd 02.12.2019 abgeholt",
              "status_id": 5,
              "prepay_sum": 20,
              "located_in": 4,
              "created_at": "2019-12-02 10:36:08",
              "updated_at": "2019-12-03 08:04:21"
            },
            {
              "id": 126,
              "order_id": 156,
              "order_nr": "1273",
              "customer_id": 126,
              "defect_description": "Macbook Air Wasserschaden",
              "comment": "10.01.2020",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-12-02 10:37:46",
              "updated_at": "2020-01-10 15:02:28"
            },
            {
              "id": 129,
              "order_id": 159,
              "order_nr": "1275",
              "customer_id": 129,
              "defect_description": "Hp Notebook Windows + Daten überspielen",
              "comment": "am 03.12 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-12-02 12:40:17",
              "updated_at": "2019-12-04 08:04:07"
            },
            {
              "id": 133,
              "order_id": 163,
              "order_nr": "1277",
              "customer_id": 133,
              "defect_description": "hp neu windows aufsetzen",
              "comment": "am 03.12 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-12-03 08:07:00",
              "updated_at": "2019-12-04 08:04:17"
            },
            {
              "id": 135,
              "order_id": 165,
              "order_nr": "2459",
              "customer_id": 135,
              "defect_description": "Macbook Wasserschaden",
              "comment": "Daten Rettung oder Rep 250-300 € , kD kommt es morgen holen",
              "status_id": 6,
              "prepay_sum": null,
              "located_in": 1,
              "created_at": "2019-12-03 09:50:42",
              "updated_at": "2019-12-04 15:29:12"
            },
            {
              "id": 141,
              "order_id": 171,
              "order_nr": "1276",
              "customer_id": 141,
              "defect_description": "a5 2017 lade stecke + akkudeckel",
              "comment": null,
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-12-04 08:00:38",
              "updated_at": "2019-12-06 10:28:22"
            },
            {
              "id": 146,
              "order_id": 176,
              "order_nr": "1284",
              "customer_id": 146,
              "defect_description": "I6 wassserschaden anayse",
              "comment": "am 18.12 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-12-05 13:32:36",
              "updated_at": "2019-12-18 17:44:31"
            },
            {
              "id": 149,
              "order_id": 179,
              "order_nr": "1287",
              "customer_id": 149,
              "defect_description": "P30 Backcover Reparatur",
              "comment": "am 23.12 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-12-06 13:06:17",
              "updated_at": "2019-12-23 13:36:37"
            },
            {
              "id": 150,
              "order_id": 180,
              "order_nr": "1290",
              "customer_id": 150,
              "defect_description": "iPhone 7 Kamera",
              "comment": "am 10.12.2019 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-12-07 13:50:52",
              "updated_at": "2019-12-10 15:11:08"
            },
            {
              "id": 157,
              "order_id": 190,
              "order_nr": "1306",
              "customer_id": 157,
              "defect_description": "Samsung S10 Lcd + Nano open folie + tasche",
              "comment": "kd am 13.12.2019 abgeholt",
              "status_id": 5,
              "prepay_sum": 0,
              "located_in": 4,
              "created_at": "2019-12-11 11:11:35",
              "updated_at": "2019-12-13 08:21:41"
            },
            {
              "id": 159,
              "order_id": 192,
              "order_nr": "1312",
              "customer_id": 159,
              "defect_description": "Samsung S10 entsperren",
              "comment": "fertig am 12.12 2019",
              "status_id": 5,
              "prepay_sum": 59,
              "located_in": 4,
              "created_at": "2019-12-11 17:31:57",
              "updated_at": "2019-12-12 16:25:07"
            },
            {
              "id": 163,
              "order_id": 196,
              "order_nr": "1315",
              "customer_id": 163,
              "defect_description": "Samsung S8 Display - Blau Rep.",
              "comment": "4 tage wir wollen mit kd kontaktieren aber kd nicht errreicht",
              "status_id": 4,
              "prepay_sum": 20,
              "located_in": 4,
              "created_at": "2019-12-13 13:47:23",
              "updated_at": "2019-12-18 10:11:41"
            },
            {
              "id": 170,
              "order_id": 204,
              "order_nr": "1304",
              "customer_id": 170,
              "defect_description": "ipad mini 2 home button",
              "comment": "am 21.12 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-12-18 10:10:26",
              "updated_at": "2019-12-21 15:46:05"
            },
            {
              "id": 181,
              "order_id": 215,
              "order_nr": "4430",
              "customer_id": 181,
              "defect_description": "A10 Lcd Rep.",
              "comment": "Ersatzteil muss bestellt werden. Gerät bei KD",
              "status_id": 4,
              "prepay_sum": 0,
              "located_in": 4,
              "created_at": "2019-12-27 16:28:13",
              "updated_at": "2019-12-27 16:28:21"
            },
            {
              "id": 186,
              "order_id": 220,
              "order_nr": "4432",
              "customer_id": 186,
              "defect_description": "P20 lite LCD Rep.",
              "comment": "09.01 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2019-12-28 15:27:27",
              "updated_at": "2020-01-09 12:17:19"
            },
            {
              "id": 187,
              "order_id": 221,
              "order_nr": "4425",
              "customer_id": 187,
              "defect_description": "Samsung S9+ LCD Rep.",
              "comment": "am 30.12 abgeholt",
              "status_id": 5,
              "prepay_sum": 0,
              "located_in": 4,
              "created_at": "2019-12-28 15:29:53",
              "updated_at": "2019-12-30 08:21:45"
            },
            {
              "id": 197,
              "order_id": 231,
              "order_nr": "4417",
              "customer_id": 197,
              "defect_description": "psmart 19 google acc",
              "comment": "kd am 02.01 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-02 13:09:07",
              "updated_at": "2020-01-02 13:32:18"
            },
            {
              "id": 198,
              "order_id": 232,
              "order_nr": "4419",
              "customer_id": 198,
              "defect_description": "huawei mate 9 lcd",
              "comment": "03.01 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-02 13:28:41",
              "updated_at": "2020-01-03 16:49:14"
            },
            {
              "id": 199,
              "order_id": 233,
              "order_nr": "4411",
              "customer_id": 199,
              "defect_description": "i6s Platine Fehler",
              "comment": "09.01",
              "status_id": 6,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-02 16:25:21",
              "updated_at": "2020-01-09 16:44:56"
            },
            {
              "id": 202,
              "order_id": 236,
              "order_nr": "4410",
              "customer_id": 202,
              "defect_description": "ip 6s lcd",
              "comment": "03.01 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-03 13:24:25",
              "updated_at": "2020-01-03 16:48:49"
            },
            {
              "id": 203,
              "order_id": 237,
              "order_nr": "4413",
              "customer_id": 203,
              "defect_description": "a5 2016 akku",
              "comment": "04.01 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-03 13:33:03",
              "updated_at": "2020-01-04 13:25:46"
            },
            {
              "id": 209,
              "order_id": 243,
              "order_nr": "4407",
              "customer_id": 209,
              "defect_description": "p20lite ladeconnector",
              "comment": "shayan bestellen",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-07 17:32:41",
              "updated_at": "2020-01-27 10:38:19"
            },
            {
              "id": 210,
              "order_id": 248,
              "order_nr": "001",
              "customer_id": 210,
              "defect_description": "iPhone 7 Display kaputt",
              "comment": "KD kommt in 2 Tagen",
              "status_id": 4,
              "prepay_sum": 20,
              "located_in": 5,
              "created_at": "2020-01-08 08:05:08",
              "updated_at": "2020-01-08 13:57:49"
            },
            {
              "id": 214,
              "order_id": 252,
              "order_nr": "4403",
              "customer_id": 214,
              "defect_description": "LCD - wechsel j 2017",
              "comment": "kd am 13.01.2020 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-08 14:39:54",
              "updated_at": "2020-01-13 16:46:53"
            },
            {
              "id": 218,
              "order_id": 256,
              "order_nr": "4397",
              "customer_id": 218,
              "defect_description": "a7 akkudeckel schwarz",
              "comment": "17.01 kd abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-10 09:37:03",
              "updated_at": "2020-01-21 14:44:00"
            },
            {
              "id": 219,
              "order_id": 257,
              "order_nr": "4392",
              "customer_id": 219,
              "defect_description": "nokia 5 ta-1024 lcd",
              "comment": "am 24.01 kd abgeholt / kd am 28.01 nochmal gekommen gps funktioniert nicht + sam s4mini leihhandy / am 31.01 kd handy abgeholt zu Garatine schicken / wir warten auf kd",
              "status_id": 2,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-10 11:29:42",
              "updated_at": "2020-01-31 12:21:54"
            },
            {
              "id": 220,
              "order_id": 258,
              "order_nr": "4394",
              "customer_id": 220,
              "defect_description": "iPhone X Display Rep.",
              "comment": "13.01.2020 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-10 14:57:18",
              "updated_at": "2020-01-13 16:45:06"
            },
            {
              "id": 227,
              "order_id": 269,
              "order_nr": "4388",
              "customer_id": 227,
              "defect_description": "s5 neo lcd",
              "comment": "wurde am 15.01.20",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-14 12:01:59",
              "updated_at": "2020-01-27 10:38:09"
            },
            {
              "id": 233,
              "order_id": 275,
              "order_nr": "4391",
              "customer_id": 233,
              "defect_description": "P9 lite akku",
              "comment": "20.01 kd abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-15 18:00:51",
              "updated_at": "2020-01-21 14:43:31"
            },
            {
              "id": 236,
              "order_id": 278,
              "order_nr": "----",
              "customer_id": 236,
              "defect_description": "iPhone Xs Ohrlautsprecher defekt - On Off Reparatur ( Kulanz)",
              "comment": "On/Off Flex repariert - KD weiss nicht ob es vorher funktioniert hat der Ohrlautsprecher - Ersatzteil da muss aber gelötet werden. Zeus 1-2 Werktage Rep Zeit dauern KD weiss Bescheid",
              "status_id": 1,
              "prepay_sum": null,
              "located_in": 1,
              "created_at": "2020-01-21 10:55:47",
              "updated_at": "2020-01-21 10:55:47"
            },
            {
              "id": 238,
              "order_id": 280,
              "order_nr": "2624",
              "customer_id": 238,
              "defect_description": "S10+ Power Key neumontage",
              "comment": "24.01.20 lagernd, KD NE",
              "status_id": 1,
              "prepay_sum": 10,
              "located_in": 2,
              "created_at": "2020-01-21 11:54:19",
              "updated_at": "2020-01-24 08:14:42"
            },
            {
              "id": 246,
              "order_id": 288,
              "order_nr": "2671",
              "customer_id": 246,
              "defect_description": "IPhone 6s nach >Akku Tausch ohne Funktion ? IC Chip über Zeus reparieren 30-40 € Differenz / oder 39€ retour  , kd wollte das handy repreiren lasen bitte zum zeus scheken 28.01",
              "comment": "Techniker Analyse ist IC Ladechip defekt  , Chef nach Lösung fragen",
              "status_id": 1,
              "prepay_sum": null,
              "located_in": 1,
              "created_at": "2020-01-24 08:26:59",
              "updated_at": "2020-01-28 17:58:21"
            },
            {
              "id": 248,
              "order_id": 290,
              "order_nr": "3809",
              "customer_id": 248,
              "defect_description": "I6+ lCD",
              "comment": "fertig, die hintere kamera funktioniert nicht Kd wollte am Mo kommen bitte in anrufen",
              "status_id": 1,
              "prepay_sum": null,
              "located_in": 3,
              "created_at": "2020-01-24 10:46:39",
              "updated_at": "2020-01-24 10:46:39"
            },
            {
              "id": 253,
              "order_id": 295,
              "order_nr": "4983",
              "customer_id": 253,
              "defect_description": "iPad mini 2 Display Glas Rep.",
              "comment": "kd am 30.01 ipad hab geholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-27 10:34:34",
              "updated_at": "2020-01-30 13:41:38"
            },
            {
              "id": 257,
              "order_id": 299,
              "order_nr": "4977",
              "customer_id": 257,
              "defect_description": "p20lite akku deckel pink",
              "comment": "kd am 01.02.20 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-01-28 13:57:22",
              "updated_at": "2020-02-05 10:15:34"
            },
            {
              "id": 261,
              "order_id": 303,
              "order_nr": "1096",
              "customer_id": 261,
              "defect_description": "Sony ladet nicht mehr/ Analyse Akku  platine tot",
              "comment": "kd weiß beschied 03.02",
              "status_id": 6,
              "prepay_sum": null,
              "located_in": 2,
              "created_at": "2020-02-01 13:17:43",
              "updated_at": "2020-02-04 11:35:16"
            },
            {
              "id": 265,
              "order_id": 307,
              "order_nr": "1099",
              "customer_id": 265,
              "defect_description": "iphone 7 display tausch",
              "comment": "1-2 werktage",
              "status_id": 1,
              "prepay_sum": null,
              "located_in": 2,
              "created_at": "2020-02-03 18:24:27",
              "updated_at": "2020-02-05 08:17:51"
            },
            {
              "id": 268,
              "order_id": 310,
              "order_nr": "4968",
              "customer_id": 268,
              "defect_description": "p20lite lcd",
              "comment": "am 07.02 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-02-05 10:17:11",
              "updated_at": "2020-02-07 17:14:09"
            },
            {
              "id": 269,
              "order_id": 311,
              "order_nr": "4961",
              "customer_id": 269,
              "defect_description": "iphone x oder xs back cover mit rahmen",
              "comment": "am 07.02 abgeholt",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-02-05 10:18:10",
              "updated_at": "2020-02-07 17:14:23"
            },
            {
              "id": 270,
              "order_id": 312,
              "order_nr": "1209",
              "customer_id": 270,
              "defect_description": "iphone x backcover+ rahmen",
              "comment": "fertig",
              "status_id": 5,
              "prepay_sum": null,
              "located_in": 1,
              "created_at": "2020-02-05 12:32:40",
              "updated_at": "2020-02-08 08:15:08"
            },
            {
              "id": 271,
              "order_id": 313,
              "order_nr": "2252",
              "customer_id": 271,
              "defect_description": "Huawei P10 Lite kein Ton",
              "comment": "Kunde möchte icht  merh als 60€ zahlen bitte Chef Sasa KD kontaktieren",
              "status_id": 5,
              "prepay_sum": 30,
              "located_in": 3,
              "created_at": "2020-02-05 15:27:54",
              "updated_at": "2020-02-05 15:37:01"
            },
            {
              "id": 272,
              "order_id": 316,
              "order_nr": "1234",
              "customer_id": 272,
              "defect_description": "iPhone 6 Display",
              "comment": null,
              "status_id": 1,
              "prepay_sum": null,
              "located_in": 3,
              "created_at": "2020-02-05 15:38:02",
              "updated_at": "2020-02-05 15:38:02"
            },
            {
              "id": 273,
              "order_id": 317,
              "order_nr": "13046",
              "customer_id": 273,
              "defect_description": "A7 LCD Defekt",
              "comment": "Ferhat bestellt",
              "status_id": 1,
              "prepay_sum": null,
              "located_in": 1,
              "created_at": "2020-02-06 08:10:01",
              "updated_at": "2020-02-08 08:14:47"
            },
            {
              "id": 275,
              "order_id": 319,
              "order_nr": "0009",
              "customer_id": 275,
              "defect_description": "iPhone 7 Audio Chip analyse",
              "comment": "1W",
              "status_id": 1,
              "prepay_sum": null,
              "located_in": 4,
              "created_at": "2020-02-07 15:28:00",
              "updated_at": "2020-02-07 15:28:00"
            },
            {
              "id": 276,
              "order_id": 320,
              "order_nr": "1212",
              "customer_id": 276,
              "defect_description": "samsung s7 analyse",
              "comment": "1-3wt",
              "status_id": 1,
              "prepay_sum": null,
              "located_in": 1,
              "created_at": "2020-02-08 14:11:15",
              "updated_at": "2020-02-08 14:11:15"
            }
          ]';
        return $result;
    }

    public function getOrdersTableInJSON(){
        $result = '[
            {
              "id": 12,
              "accept_date": "2019-10-29",
              "price": 14.9,
              "branch_id": 3,
              "created_at": "2019-10-29 14:03:20",
              "updated_at": "2019-10-29 14:03:20",
              "created_by": 1
            },
            {
              "id": 13,
              "accept_date": "2019-10-29",
              "price": 34.9,
              "branch_id": 3,
              "created_at": "2019-10-29 14:04:03",
              "updated_at": "2019-10-29 14:04:03",
              "created_by": 1
            },
            {
              "id": 14,
              "accept_date": "2019-10-29",
              "price": 29,
              "branch_id": 3,
              "created_at": "2019-10-29 14:04:43",
              "updated_at": "2019-10-29 14:04:43",
              "created_by": 1
            },
            {
              "id": 16,
              "accept_date": "2019-10-29",
              "price": 24.9,
              "branch_id": 3,
              "created_at": "2019-10-29 16:00:10",
              "updated_at": "2019-10-29 16:00:10",
              "created_by": 1
            },
            {
              "id": 17,
              "accept_date": "2019-10-29",
              "price": 14.9,
              "branch_id": 3,
              "created_at": "2019-10-29 16:00:29",
              "updated_at": "2019-10-29 16:00:29",
              "created_by": 1
            },
            {
              "id": 18,
              "accept_date": "2019-10-29",
              "price": 24.9,
              "branch_id": 3,
              "created_at": "2019-10-29 16:18:33",
              "updated_at": "2019-10-29 16:18:33",
              "created_by": 1
            },
            {
              "id": 19,
              "accept_date": "2019-10-29",
              "price": 14.9,
              "branch_id": 3,
              "created_at": "2019-10-29 16:19:03",
              "updated_at": "2019-10-29 16:19:03",
              "created_by": 1
            },
            {
              "id": 26,
              "accept_date": "2019-10-29",
              "price": 279,
              "branch_id": 3,
              "created_at": "2019-10-29 17:02:43",
              "updated_at": "2019-10-29 17:02:43",
              "created_by": 1
            },
            {
              "id": 27,
              "accept_date": "2019-10-29",
              "price": 79,
              "branch_id": 3,
              "created_at": "2019-10-29 17:03:20",
              "updated_at": "2019-10-29 17:03:20",
              "created_by": 1
            },
            {
              "id": 29,
              "accept_date": "2019-06-03",
              "price": 530,
              "branch_id": 4,
              "created_at": "2019-10-30 10:29:35",
              "updated_at": "2019-10-30 10:29:35",
              "created_by": 1
            },
            {
              "id": 30,
              "accept_date": "2019-07-02",
              "price": 0,
              "branch_id": 4,
              "created_at": "2019-10-30 10:36:16",
              "updated_at": "2019-10-30 10:36:16",
              "created_by": 1
            },
            {
              "id": 34,
              "accept_date": "2019-10-28",
              "price": 29,
              "branch_id": 4,
              "created_at": "2019-10-30 11:18:02",
              "updated_at": "2019-11-13 15:02:26",
              "created_by": 1
            },
            {
              "id": 39,
              "accept_date": "2019-10-30",
              "price": 19,
              "branch_id": 3,
              "created_at": "2019-10-30 12:52:47",
              "updated_at": "2019-10-30 12:52:47",
              "created_by": 1
            },
            {
              "id": 40,
              "accept_date": "2019-10-30",
              "price": 4.9,
              "branch_id": 3,
              "created_at": "2019-10-30 12:55:06",
              "updated_at": "2019-10-30 12:55:06",
              "created_by": 1
            },
            {
              "id": 41,
              "accept_date": "2019-10-30",
              "price": 14.9,
              "branch_id": 3,
              "created_at": "2019-10-30 13:48:52",
              "updated_at": "2019-10-30 13:48:52",
              "created_by": 1
            },
            {
              "id": 42,
              "accept_date": "2019-10-30",
              "price": 19.9,
              "branch_id": 3,
              "created_at": "2019-10-30 13:49:04",
              "updated_at": "2019-10-30 13:49:04",
              "created_by": 1
            },
            {
              "id": 44,
              "accept_date": "2019-10-30",
              "price": 89,
              "branch_id": 3,
              "created_at": "2019-10-30 14:53:00",
              "updated_at": "2019-10-30 14:53:00",
              "created_by": 1
            },
            {
              "id": 47,
              "accept_date": "2019-10-30",
              "price": 12.9,
              "branch_id": 3,
              "created_at": "2019-10-30 17:32:48",
              "updated_at": "2019-10-30 17:32:48",
              "created_by": 1
            },
            {
              "id": 60,
              "accept_date": "2019-10-31",
              "price": 9.9,
              "branch_id": 1,
              "created_at": "2019-10-31 14:17:58",
              "updated_at": "2019-10-31 14:18:26",
              "created_by": 1
            },
            {
              "id": 61,
              "accept_date": "2019-10-31",
              "price": 12.9,
              "branch_id": 1,
              "created_at": "2019-10-31 14:18:46",
              "updated_at": "2019-10-31 14:18:56",
              "created_by": 1
            },
            {
              "id": 64,
              "accept_date": "2019-11-02",
              "price": 29,
              "branch_id": 4,
              "created_at": "2019-11-04 09:22:53",
              "updated_at": "2019-11-13 12:58:53",
              "created_by": 1
            },
            {
              "id": 65,
              "accept_date": "2019-11-02",
              "price": 179,
              "branch_id": 4,
              "created_at": "2019-11-04 09:55:48",
              "updated_at": "2019-12-06 08:13:46",
              "created_by": 1
            },
            {
              "id": 68,
              "accept_date": "2019-11-06",
              "price": 89,
              "branch_id": 4,
              "created_at": "2019-11-06 13:37:32",
              "updated_at": "2019-11-11 09:49:50",
              "created_by": 1
            },
            {
              "id": 72,
              "accept_date": "2019-11-07",
              "price": 39,
              "branch_id": 4,
              "created_at": "2019-11-07 15:06:35",
              "updated_at": "2019-11-07 15:06:35",
              "created_by": 1
            },
            {
              "id": 77,
              "accept_date": "2019-11-09",
              "price": 29,
              "branch_id": 4,
              "created_at": "2019-11-09 12:02:04",
              "updated_at": "2019-11-09 12:02:04",
              "created_by": 1
            },
            {
              "id": 79,
              "accept_date": "2019-11-09",
              "price": 39,
              "branch_id": 4,
              "created_at": "2019-11-09 13:26:42",
              "updated_at": "2019-11-09 13:26:42",
              "created_by": 1
            },
            {
              "id": 80,
              "accept_date": "2019-11-09",
              "price": 99,
              "branch_id": 4,
              "created_at": "2019-11-09 16:12:00",
              "updated_at": "2019-11-09 16:12:00",
              "created_by": 1
            },
            {
              "id": 84,
              "accept_date": "2019-11-11",
              "price": 10,
              "branch_id": 5,
              "created_at": "2019-11-11 07:34:38",
              "updated_at": "2019-11-11 07:34:38",
              "created_by": 6
            },
            {
              "id": 88,
              "accept_date": "2019-11-12",
              "price": 98,
              "branch_id": 4,
              "created_at": "2019-11-12 12:11:16",
              "updated_at": "2019-11-13 14:52:45",
              "created_by": 1
            },
            {
              "id": 90,
              "accept_date": "2019-11-12",
              "price": 59,
              "branch_id": 4,
              "created_at": "2019-11-12 16:19:05",
              "updated_at": "2019-11-12 16:19:05",
              "created_by": 1
            },
            {
              "id": 100,
              "accept_date": "2019-11-16",
              "price": 29,
              "branch_id": 4,
              "created_at": "2019-11-16 09:58:27",
              "updated_at": "2019-11-16 09:58:27",
              "created_by": 1
            },
            {
              "id": 104,
              "accept_date": "2019-11-16",
              "price": 29,
              "branch_id": 4,
              "created_at": "2019-11-16 15:08:07",
              "updated_at": "2019-11-16 15:08:07",
              "created_by": 1
            },
            {
              "id": 106,
              "accept_date": "2019-11-15",
              "price": 77.9,
              "branch_id": 6,
              "created_at": "2019-11-17 12:36:17",
              "updated_at": "2019-11-17 12:36:17",
              "created_by": 6
            },
            {
              "id": 120,
              "accept_date": "2019-11-21",
              "price": 59,
              "branch_id": 4,
              "created_at": "2019-11-21 14:18:58",
              "updated_at": "2019-11-21 14:18:58",
              "created_by": 1
            },
            {
              "id": 121,
              "accept_date": "2019-11-21",
              "price": 120,
              "branch_id": 5,
              "created_at": "2019-11-21 18:39:40",
              "updated_at": "2019-11-21 18:39:40",
              "created_by": 6
            },
            {
              "id": 127,
              "accept_date": "2019-11-23",
              "price": 119,
              "branch_id": 4,
              "created_at": "2019-11-23 15:27:58",
              "updated_at": "2019-11-23 15:27:58",
              "created_by": 1
            },
            {
              "id": 128,
              "accept_date": "2019-11-24",
              "price": 200,
              "branch_id": 5,
              "created_at": "2019-11-24 19:55:24",
              "updated_at": "2019-11-24 19:55:24",
              "created_by": 6
            },
            {
              "id": 129,
              "accept_date": "2019-11-25",
              "price": 12.3,
              "branch_id": 5,
              "created_at": "2019-11-25 16:03:20",
              "updated_at": "2019-11-25 16:03:20",
              "created_by": 6
            },
            {
              "id": 139,
              "accept_date": "2019-11-27",
              "price": 269,
              "branch_id": 4,
              "created_at": "2019-11-27 12:19:54",
              "updated_at": "2019-11-27 12:19:54",
              "created_by": 1
            },
            {
              "id": 145,
              "accept_date": "2019-11-28",
              "price": 20,
              "branch_id": 4,
              "created_at": "2019-11-28 16:39:13",
              "updated_at": "2019-12-03 08:43:45",
              "created_by": 1
            },
            {
              "id": 148,
              "accept_date": "2019-11-29",
              "price": 150,
              "branch_id": 4,
              "created_at": "2019-11-29 11:20:54",
              "updated_at": "2019-11-29 11:20:54",
              "created_by": 1
            },
            {
              "id": 154,
              "accept_date": "2019-11-30",
              "price": 409,
              "branch_id": 4,
              "created_at": "2019-12-02 10:34:23",
              "updated_at": "2019-12-02 10:40:35",
              "created_by": 1
            },
            {
              "id": 155,
              "accept_date": "2019-11-30",
              "price": 119,
              "branch_id": 4,
              "created_at": "2019-12-02 10:36:08",
              "updated_at": "2019-12-02 10:40:57",
              "created_by": 1
            },
            {
              "id": 156,
              "accept_date": "2019-11-30",
              "price": 200,
              "branch_id": 4,
              "created_at": "2019-12-02 10:37:46",
              "updated_at": "2020-01-10 15:03:34",
              "created_by": 1
            },
            {
              "id": 159,
              "accept_date": "2019-12-02",
              "price": 78,
              "branch_id": 4,
              "created_at": "2019-12-02 12:40:17",
              "updated_at": "2019-12-02 12:40:17",
              "created_by": 1
            },
            {
              "id": 163,
              "accept_date": "2019-12-02",
              "price": 49,
              "branch_id": 4,
              "created_at": "2019-12-03 08:07:00",
              "updated_at": "2019-12-03 08:07:00",
              "created_by": 1
            },
            {
              "id": 165,
              "accept_date": "2019-12-03",
              "price": 49,
              "branch_id": 3,
              "created_at": "2019-12-03 09:50:42",
              "updated_at": "2019-12-03 09:50:42",
              "created_by": 1
            },
            {
              "id": 171,
              "accept_date": "2019-12-02",
              "price": 130,
              "branch_id": 4,
              "created_at": "2019-12-04 08:00:38",
              "updated_at": "2019-12-04 08:00:46",
              "created_by": 1
            },
            {
              "id": 176,
              "accept_date": "2019-12-05",
              "price": 100,
              "branch_id": 4,
              "created_at": "2019-12-05 13:32:36",
              "updated_at": "2019-12-12 08:14:59",
              "created_by": 1
            },
            {
              "id": 179,
              "accept_date": "2019-12-06",
              "price": 99,
              "branch_id": 4,
              "created_at": "2019-12-06 13:06:17",
              "updated_at": "2019-12-06 13:06:17",
              "created_by": 1
            },
            {
              "id": 180,
              "accept_date": "2019-12-07",
              "price": 99,
              "branch_id": 4,
              "created_at": "2019-12-07 13:50:52",
              "updated_at": "2019-12-07 13:50:52",
              "created_by": 1
            },
            {
              "id": 182,
              "accept_date": "2019-12-07",
              "price": 12,
              "branch_id": 5,
              "created_at": "2019-12-07 21:59:27",
              "updated_at": "2019-12-07 21:59:27",
              "created_by": 6
            },
            {
              "id": 183,
              "accept_date": "2019-12-07",
              "price": 14.9,
              "branch_id": 5,
              "created_at": "2019-12-07 21:59:46",
              "updated_at": "2019-12-07 21:59:46",
              "created_by": 6
            },
            {
              "id": 184,
              "accept_date": "2019-12-07",
              "price": 29.9,
              "branch_id": 5,
              "created_at": "2019-12-07 21:59:54",
              "updated_at": "2019-12-07 21:59:54",
              "created_by": 6
            },
            {
              "id": 190,
              "accept_date": "2019-12-11",
              "price": 348,
              "branch_id": 4,
              "created_at": "2019-12-11 11:11:35",
              "updated_at": "2019-12-13 08:21:41",
              "created_by": 1
            },
            {
              "id": 192,
              "accept_date": "2019-12-11",
              "price": 59,
              "branch_id": 4,
              "created_at": "2019-12-11 17:31:57",
              "updated_at": "2019-12-11 17:31:57",
              "created_by": 1
            },
            {
              "id": 196,
              "accept_date": "2019-12-13",
              "price": 239,
              "branch_id": 4,
              "created_at": "2019-12-13 13:47:23",
              "updated_at": "2019-12-13 13:47:23",
              "created_by": 1
            },
            {
              "id": 198,
              "accept_date": "2019-12-14",
              "price": 14,
              "branch_id": 5,
              "created_at": "2019-12-14 13:07:24",
              "updated_at": "2019-12-14 13:07:24",
              "created_by": 6
            },
            {
              "id": 204,
              "accept_date": "2019-12-10",
              "price": 69,
              "branch_id": 4,
              "created_at": "2019-12-18 10:10:26",
              "updated_at": "2019-12-18 10:10:26",
              "created_by": 1
            },
            {
              "id": 215,
              "accept_date": "2019-12-27",
              "price": 128,
              "branch_id": 4,
              "created_at": "2019-12-27 16:28:13",
              "updated_at": "2019-12-27 16:28:13",
              "created_by": 1
            },
            {
              "id": 220,
              "accept_date": "2019-12-28",
              "price": 119,
              "branch_id": 4,
              "created_at": "2019-12-28 15:27:27",
              "updated_at": "2019-12-28 15:27:27",
              "created_by": 1
            },
            {
              "id": 221,
              "accept_date": "2019-12-28",
              "price": 279,
              "branch_id": 4,
              "created_at": "2019-12-28 15:29:53",
              "updated_at": "2019-12-28 15:29:53",
              "created_by": 1
            },
            {
              "id": 231,
              "accept_date": "2020-01-02",
              "price": 49,
              "branch_id": 4,
              "created_at": "2020-01-02 13:09:07",
              "updated_at": "2020-01-02 13:09:07",
              "created_by": 1
            },
            {
              "id": 232,
              "accept_date": "2020-01-02",
              "price": 179,
              "branch_id": 4,
              "created_at": "2020-01-02 13:28:41",
              "updated_at": "2020-01-02 13:28:41",
              "created_by": 1
            },
            {
              "id": 233,
              "accept_date": "2020-01-02",
              "price": 29,
              "branch_id": 4,
              "created_at": "2020-01-02 16:25:21",
              "updated_at": "2020-01-02 16:25:21",
              "created_by": 1
            },
            {
              "id": 236,
              "accept_date": "2020-01-02",
              "price": 89,
              "branch_id": 4,
              "created_at": "2020-01-03 13:24:25",
              "updated_at": "2020-01-03 13:24:25",
              "created_by": 1
            },
            {
              "id": 237,
              "accept_date": "2020-01-03",
              "price": 59,
              "branch_id": 4,
              "created_at": "2020-01-03 13:33:03",
              "updated_at": "2020-01-03 13:33:03",
              "created_by": 1
            },
            {
              "id": 243,
              "accept_date": "2020-01-07",
              "price": 59,
              "branch_id": 4,
              "created_at": "2020-01-07 17:32:41",
              "updated_at": "2020-01-07 17:32:41",
              "created_by": 1
            },
            {
              "id": 244,
              "accept_date": "2020-01-08",
              "price": 14.9,
              "branch_id": 5,
              "created_at": "2020-01-08 08:00:39",
              "updated_at": "2020-01-08 08:00:39",
              "created_by": 6
            },
            {
              "id": 245,
              "accept_date": "2020-01-08",
              "price": 24.9,
              "branch_id": 5,
              "created_at": "2020-01-08 08:00:54",
              "updated_at": "2020-01-08 08:00:54",
              "created_by": 6
            },
            {
              "id": 246,
              "accept_date": "2020-01-08",
              "price": 19.9,
              "branch_id": 5,
              "created_at": "2020-01-08 08:01:13",
              "updated_at": "2020-01-08 08:01:13",
              "created_by": 6
            },
            {
              "id": 247,
              "accept_date": "2020-01-08",
              "price": 24.9,
              "branch_id": 5,
              "created_at": "2020-01-08 08:01:34",
              "updated_at": "2020-01-08 08:01:34",
              "created_by": 6
            },
            {
              "id": 248,
              "accept_date": "2020-01-08",
              "price": 120,
              "branch_id": 5,
              "created_at": "2020-01-08 08:05:07",
              "updated_at": "2020-01-08 08:05:07",
              "created_by": 6
            },
            {
              "id": 252,
              "accept_date": "2020-01-08",
              "price": 139,
              "branch_id": 4,
              "created_at": "2020-01-08 14:39:54",
              "updated_at": "2020-01-08 14:39:54",
              "created_by": 1
            },
            {
              "id": 256,
              "accept_date": "2020-01-10",
              "price": 89,
              "branch_id": 4,
              "created_at": "2020-01-10 09:37:03",
              "updated_at": "2020-01-10 09:37:03",
              "created_by": 1
            },
            {
              "id": 257,
              "accept_date": "2020-01-10",
              "price": 109,
              "branch_id": 4,
              "created_at": "2020-01-10 11:29:42",
              "updated_at": "2020-01-10 11:29:42",
              "created_by": 1
            },
            {
              "id": 258,
              "accept_date": "2020-01-10",
              "price": 199,
              "branch_id": 4,
              "created_at": "2020-01-10 14:57:17",
              "updated_at": "2020-01-10 14:57:17",
              "created_by": 1
            },
            {
              "id": 259,
              "accept_date": "2020-01-11",
              "price": 14.9,
              "branch_id": 5,
              "created_at": "2020-01-11 16:42:18",
              "updated_at": "2020-01-11 16:42:18",
              "created_by": 6
            },
            {
              "id": 260,
              "accept_date": "2020-01-11",
              "price": 24.9,
              "branch_id": 5,
              "created_at": "2020-01-11 16:42:28",
              "updated_at": "2020-01-11 16:42:28",
              "created_by": 6
            },
            {
              "id": 261,
              "accept_date": "2020-01-11",
              "price": 14.9,
              "branch_id": 5,
              "created_at": "2020-01-11 16:42:39",
              "updated_at": "2020-01-11 16:42:39",
              "created_by": 6
            },
            {
              "id": 262,
              "accept_date": "2020-01-11",
              "price": 19.9,
              "branch_id": 5,
              "created_at": "2020-01-11 16:43:07",
              "updated_at": "2020-01-11 16:43:07",
              "created_by": 6
            },
            {
              "id": 269,
              "accept_date": "2020-01-14",
              "price": 149,
              "branch_id": 4,
              "created_at": "2020-01-14 12:01:59",
              "updated_at": "2020-01-14 12:01:59",
              "created_by": 1
            },
            {
              "id": 275,
              "accept_date": "2020-01-15",
              "price": 79,
              "branch_id": 4,
              "created_at": "2020-01-15 18:00:51",
              "updated_at": "2020-01-15 18:00:51",
              "created_by": 1
            },
            {
              "id": 278,
              "accept_date": "2020-01-21",
              "price": 0,
              "branch_id": 1,
              "created_at": "2020-01-21 10:55:47",
              "updated_at": "2020-01-21 10:55:47",
              "created_by": 1
            },
            {
              "id": 280,
              "accept_date": "2020-01-21",
              "price": 30,
              "branch_id": 2,
              "created_at": "2020-01-21 11:54:19",
              "updated_at": "2020-01-21 11:54:19",
              "created_by": 1
            },
            {
              "id": 288,
              "accept_date": "2020-01-24",
              "price": 0,
              "branch_id": 1,
              "created_at": "2020-01-24 08:26:59",
              "updated_at": "2020-01-24 08:26:59",
              "created_by": 1
            },
            {
              "id": 290,
              "accept_date": "2020-01-24",
              "price": 0,
              "branch_id": 3,
              "created_at": "2020-01-24 10:46:39",
              "updated_at": "2020-01-24 10:46:39",
              "created_by": 1
            },
            {
              "id": 295,
              "accept_date": "2020-01-27",
              "price": 119,
              "branch_id": 4,
              "created_at": "2020-01-27 10:34:34",
              "updated_at": "2020-01-27 10:34:34",
              "created_by": 1
            },
            {
              "id": 299,
              "accept_date": "2020-01-28",
              "price": 69,
              "branch_id": 4,
              "created_at": "2020-01-28 13:57:22",
              "updated_at": "2020-01-28 13:57:22",
              "created_by": 1
            },
            {
              "id": 303,
              "accept_date": "2020-02-01",
              "price": 29,
              "branch_id": 2,
              "created_at": "2020-02-01 13:17:43",
              "updated_at": "2020-02-01 13:17:43",
              "created_by": 1
            },
            {
              "id": 307,
              "accept_date": "2020-02-03",
              "price": 100,
              "branch_id": 2,
              "created_at": "2020-02-03 18:24:27",
              "updated_at": "2020-02-03 18:24:27",
              "created_by": 1
            },
            {
              "id": 310,
              "accept_date": "2020-02-01",
              "price": 119,
              "branch_id": 4,
              "created_at": "2020-02-05 10:17:11",
              "updated_at": "2020-02-05 10:17:11",
              "created_by": 1
            },
            {
              "id": 311,
              "accept_date": "2020-02-01",
              "price": 249,
              "branch_id": 4,
              "created_at": "2020-02-05 10:18:10",
              "updated_at": "2020-02-05 10:18:10",
              "created_by": 1
            },
            {
              "id": 312,
              "accept_date": "2020-02-05",
              "price": 299,
              "branch_id": 1,
              "created_at": "2020-02-05 12:32:40",
              "updated_at": "2020-02-05 12:32:40",
              "created_by": 1
            },
            {
              "id": 313,
              "accept_date": "2020-02-05",
              "price": 79,
              "branch_id": 3,
              "created_at": "2020-02-05 15:27:54",
              "updated_at": "2020-02-05 15:27:54",
              "created_by": 1
            },
            {
              "id": 314,
              "accept_date": "2020-02-05",
              "price": 14.9,
              "branch_id": 3,
              "created_at": "2020-02-05 15:31:26",
              "updated_at": "2020-02-05 15:31:26",
              "created_by": 1
            },
            {
              "id": 315,
              "accept_date": "2020-02-05",
              "price": 70,
              "branch_id": 3,
              "created_at": "2020-02-05 15:31:38",
              "updated_at": "2020-02-05 15:31:38",
              "created_by": 1
            },
            {
              "id": 316,
              "accept_date": "2020-02-05",
              "price": 119,
              "branch_id": 3,
              "created_at": "2020-02-05 15:38:02",
              "updated_at": "2020-02-05 15:38:02",
              "created_by": 1
            },
            {
              "id": 317,
              "accept_date": "2020-02-06",
              "price": 129,
              "branch_id": 1,
              "created_at": "2020-02-06 08:10:01",
              "updated_at": "2020-02-06 08:10:01",
              "created_by": 1
            },
            {
              "id": 319,
              "accept_date": "2020-02-07",
              "price": 80,
              "branch_id": 4,
              "created_at": "2020-02-07 15:28:00",
              "updated_at": "2020-02-07 15:28:00",
              "created_by": 1
            },
            {
              "id": 320,
              "accept_date": "2020-02-08",
              "price": 65,
              "branch_id": 1,
              "created_at": "2020-02-08 14:11:15",
              "updated_at": "2020-02-08 14:11:15",
              "created_by": 1
            }
          ]';

          return $result;
    }
}
