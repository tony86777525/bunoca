<?php

namespace App\Services;

use Doctrine\Common\Collections\Collection;

use Excel;
use DB;

// Repository
use App\Repositories\OrderRepository;
use App\Repositories\OrderDetailRepository;

class CsvService
{

    protected $order;
    protected $order_detail;
    /**
     * Index interface.
     *
     * @return Content
     */

    public function __construct(OrderRepository $order, OrderDetailRepository $order_detail)
    {
        $this->order = $order;
        $this->order_detail = $order_detail;
    }

    public function export($data = array(), $title, $param)
    {
        $file = $title . "-" . date('YmdHis');


        Excel::create($file, function($excel) use ($data, $title, $param) {
            $excel->sheet($title, function($sheet) use ($data, $title, $param) {
                $sheet->setAutoFilter('A1:P1');
                $headings = $param;
                $sheet->row(1, $headings);
                $sheet->setBorder('A1:P1', 'thin');

                $last_order_no = '';
                $step = 2;
                foreach($data as $k){
                    foreach($k as $k1){ 
                        foreach($k1 as $v){ 
                        $orders = $v['order'];

                        $order_details = $v;
                        array_pop($order_details);
                        array_shift($order_details);
                        if($last_order_no != $orders['order_no']){
                            $last_order_no = $orders['order_no'];
                            $orders = array_merge(array_values(array_slice($orders, 0, 4)), array_values($order_details), array_values(array_slice($orders, 4, 7)));
                            $sheet->row($step, $orders);
                            
                            $sheet->cells('A' . $step.':P'. $step, function($cells) {
                                $cells->setBorder('thin','none','none','none');
                            });
                            
                            
                        }else{
                            array_unshift($order_details, '', '', '', '') ;
                            $sheet->row($step, $order_details);
                        }

                        if(intval($order_details['num']) > 1){
                            $sheet->cells('H' . $step, function($cells) {
                                $cells->setBackground('#0aee85');
                            });
                        }
                        $sheet->cells('Q'. $step, function($cells) {
                            $cells->setBorder('none','none','none','thin');
                        });
                        $step++;
                        }
                    }
                }
                // $sheet->fromArray($data, null, 'A1', false, false);
                
            });
        })->download('xlsx');
    }
    public function import($file = array(), $type, $orders, $gifts)
    {
        $extension = $file->getClientOriginalExtension();

        $file_name = strval(time()) . str_random(5) . '.' . $extension;

        $destination_path = public_path() . '/uploads/';

        $file->move($destination_path, $file_name);
        $filePath = 'public/uploads/' . $file_name;
        //$files = base_path($filePath);
        $files = "D:\/laragon\/www\/excel\/public\/uploads\/" . $file_name;
        $data = Excel::load($filePath, function($reader){
            $reader->toArray();
            //$data = $reader->all();
        })->get();

        $insert_array = array();
        $insert_detail_array = array();
        $order_table_name = $this->order->table_name;
        $detail_table_name = $this->order->detail;
        $message_update = array();
        foreach($data as $k0 =>$v0){
            if(!isset($orders[$v0[0]])){

                foreach($v0 as $k => $v){
                    $insert_array[$k0][$order_table_name[$k]] = $v;
                    $insert_array[$k0][$this->order->new_no] = $this->order->new_no_array[$type] . ($k0+1);
                }
                $gift = '';
                foreach($gifts as $g){
                    if(intval($g->fee) > intval($insert_array[$k0]['pay_fee'])){
                        break;
                    }
                    $gift = $g->name;
                }
                $insert_array[$k0]['gift'] = $gift;

                //csv
                $insert_array[$k0]['csv_new_no'] = $insert_array[$k0]['new_no'];
                $insert_array[$k0]['csv_order_no'] = $insert_array[$k0]['order_no'];
                $insert_array[$k0]['csv_username'] = $insert_array[$k0]['username'];
                $insert_array[$k0]['csv_new_no_type'] = $this->order->new_no_array[$type];
                $insert_array[$k0]['csv_total_fee'] = $insert_array[$k0]['total_fee'];
                $insert_array[$k0]['csv_credit_card_num'] = ($insert_array[$k0]['credit_card_num'] ? "信用卡末四碼:" . $insert_array[$k0]['credit_card_num'] : '');
                $insert_array[$k0]['csv_sigal_fee'] = $insert_array[$k0]['total_fee'];

                $str0 = explode("\n", $insert_array[$k0][$detail_table_name]);
                $str1 = array();
                $str1_t = array();
                foreach($str0 as $v){
                    $str1_t = explode("; ", $v);
                    array_pop($str1_t);
                    $str1[] = $str1_t;
                }

                $str2array = array();
                $str2 = array();
                foreach($str1 as $t0 => $s0){
                    $str2array[$t0] = $this->order_detail->import_table_name;
                    foreach($s0 as $t => $s){
                        $str2 = explode(":", $s);
                        if($search_table_name = array_search($str2[0], $this->order_detail->table_chinese_name)){
                            if($str2[0] == '價格'){
                                $str2 = explode("$ ", $str2[1]);
                            }
                            if($str2[0] == '數量'){
                                $str2[1] = trim($str2[1]);
                            }
                            $str2array[$t0][$search_table_name] = $str2[1];
                        }elseif(strpos($str2[0], $this->order_detail->table_chinese_name[$this->order_detail->name])){
                            if($search_table_name = array_search(explode(' ', $str2[0])[1], $this->order_detail->table_chinese_name)){
                                $str2array[$t0][$search_table_name] = explode(" ", $str2[0])[0] . $str2[1];
                            }
                        }
                    }
                    $str2array[$t0][$this->order_detail->order_no] = $insert_array[$k0][$this->order->no];

                    $insert_detail_array[] = $str2array[$t0];
                }
            }elseif($orders[$v0[0]] != "已出貨"){
                foreach($v0 as $k => $v){

                    $insert_array[$k0][$order_table_name[$k]] = $v;
                    $insert_array[$k0][$this->order->new_no] = $this->order->new_no_array[$type] . ($k0+1);
                }

                $str0 = explode("\n", $insert_array[$k0][$detail_table_name]);
                $str1 = array();
                $str1_t = array();
                foreach($str0 as $v){
                    $str1_t = explode("; ", $v);
                    array_pop($str1_t);
                    $str1[] = $str1_t;
                }

                $str2array = array();
                $str2 = array();
                foreach($str1 as $t0 => $s0){
                    $str2array[$t0] = $this->order_detail->import_table_name;
                    foreach($s0 as $t => $s){
                        $str2 = explode(":", $s);
                        if($search_table_name = array_search($str2[0], $this->order_detail->table_chinese_name)){
                            if($str2[0] == '價格'){
                                $str2 = explode("$ ", $str2[1]);
                            }
                            if($str2[0] == '數量'){
                                $str2[1] = trim($str2[1]);
                            }
                            $str2array[$t0][$search_table_name] = $str2[1];
                        }elseif(strpos($str2[0], $this->order_detail->table_chinese_name[$this->order_detail->name])){
                            if($search_table_name = array_search(explode(' ', $str2[0])[1], $this->order_detail->table_chinese_name)){
                                $str2array[$t0][$search_table_name] = explode(" ", $str2[0])[0] . $str2[1];
                            }
                        }
                    }
                    $str2array[$t0][$this->order_detail->order_no] = $insert_array[$k0][$this->order->no];
                    $insert_detail_array[] = $str2array[$t0];
                }
                if($insert_array[$k0]['username_message'] != ''){
                    $message_update[$insert_array[$k0]['order_no']]['username_message'] = $insert_array[$k0]['username_message'];
                }elseif($insert_array[$k0]['message'] != ''){
                    $message_update[$insert_array[$k0]['order_no']]['message'] = $insert_array[$k0]['message'];
                }
                array_pop($insert_array);
            }
        }
        $this->order_detail->insertArray($insert_detail_array);
        $this->order->insertArray($insert_array);
        
        return $message_update;
    }
    public function exportCSV($data = array(), $title, $param)
    {
        $file = $title . "-" . date('YmdHis');


        Excel::create($file, function($excel) use ($data, $title, $param) {
            $excel->sheet($title, function($sheet) use ($data, $title, $param) {
                $headings = $param;
                $sheet->row(1, $headings);

                $step = 2;
                foreach($data as $v){
                    $sheet->row($step, $v);
                    $step++;
                }
                // $sheet->fromArray($data, null, 'A1', false, false);
                
            });
        })->download('csv');
    }
    // public function import($file = array())
    // {
    //     $extension = $file->getClientOriginalExtension();

    //     $file_name = strval(time()) . str_random(5) . '.' . $extension;

    //     $destination_path = public_path() . '/uploads/';

    //     $file->move($destination_path, $file_name);
    //     $filePath = 'public/uploads/' . $file_name;
    //     //$files = base_path($filePath);
    //     $files = "D:\/laragon\/www\/excel\/public\/uploads\/".$file_name;

    //     $query = "LOAD DATA LOCAL INFILE '".$files."'
    //     INTO TABLE orders FIELDS TERMINATED BY ',' 
    //     LINES TERMINATED BY '\n' IGNORE 1 LINES(
    //         no,
    //         status,
    //         refund,
    //         username,
    //         created_date,
    //         pay_date,
    //         pay_fee,
    //         shipping_fee,
    //         total_fee,
    //         order_message,
    //         address,
    //         country,
    //         city,
    //         area,
    //         zip,
    //         name,
    //         phone,
    //         get_type,
    //         out_type,
    //         credit_card_num,
    //         order_type,
    //         pay_type,
    //         last_out_date,
    //         package_no,
    //         real_out_date,
    //         finish_date,
    //         username_message,
    //         message,
    //         @created_at,
    //         @updated_at)
    //     SET created_at=NOW(),updated_at=null";
    //     DB::connection()->getpdo()->exec($query);
    // }
}
