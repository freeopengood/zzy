<?php
    namespace admin;
    use models\BaseDao;

    class Index extends Admin {
        function __construct(){
            //$this->assign('menumark','category');
            parent::__construct();
        }

        function index(){
            $db = new BaseDao();
            $this->assign('title','后台首页');
            $count = [];//统计变量

            //商品统计
            $count['product_up'] = $db->count('product',['state'=>1]);//上架
            $count['product_down'] = $db->count('product',['state'=>0]);//下架
            $count['product_empty'] = $db->count('product',['state'=>1,'num[<]'=>1]);//缺货
            $count['product_reco'] = $db->count('product',['state'=>1,'istuijian'=>1]);//推荐

            //访客统计
            $today = strtotime(date('Y-m-d'));//今天的时间
            $last = strtotime(date('Y-m-d',strtotime('-1 day')));//昨天的时间
            $count['iplog_today'] = $db->count('iplog',['atime[>=]'=>$today]);//今日访客
            $count['iplog_last'] = $db->count('iplog',['atime[>=]'=>$last,'atime[<]'=>$today]);//昨日访客
            $count['iplog_all'] = $db->count('iplog');//累计访客
            $count['iplog_user'] = $db->count('user');//注册用户

            //交易数据
            //今日订单总数
            $count['order_today'] = $db->count('order',['atime[>=]'=>$today]);
            //今日订单金额
            $money_today = $db->sum('order','productmoney',['atime[>=]'=>$today]);
            $count['money_today'] = number_format($money_today,2);
            //今日订单总数
            $count['order_last'] = $db->count('order',['atime[>=]'=>$last,'atime[<]'=>$today]);
            //今日订单金额
            $money_last = $db->sum('order','productmoney',['atime[>=]'=>$last,'atime[<]'=>$today]);
            $count['money_last'] = number_format($money_last,2);
            //今日订单总数
            $count['order_all'] = $db->count('order');
            //今日订单金额
            $money_all = $db->sum('order','productmoney');
            $count['money_all'] = number_format($money_all,2);

            $this->assign($count);
            $this->display('index/index');
        }
    }