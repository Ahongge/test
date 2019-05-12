<?php
namespace app\index\controller;

use \Payment\Common\PayException;
use \Payment\src\Client\Transfer;
use \Payment\src\Config;


class Index
{
//    public function index()
//    {
//        $a = $this->hello();
//        return json($a);
//    }
//
//    public function hello($name = 'ThinkPHP5')
//    {
//        return 'hello,' . $name;
//    }


    public function index ()
    {
        date_default_timezone_set('Asia/Shanghai');
        $aliConfig = require_once __DIR__ . '/../../../extend/payment/examples/aliconfig.php';
        $data = [
            'trans_no' => time(),
            'payee_type' => 'ALIPAY_LOGONID',
            'payee_account' => 'aaqlmq0729@sandbox.com',// ALIPAY_USERID: 2088102169940354      ALIPAY_LOGONID：aaqlmq0729@sandbox.com
            'amount' => '1000',
            'remark' => '转账拉，有钱了',
            'payer_show_name' => '一个未来的富豪',
        ];

        try {
            $ret = Transfer::run(Config::ALI_TRANSFER, $aliConfig, $data);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }

        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    }




}
