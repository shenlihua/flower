<?php
return array(
	//'配置项'=>'配置值'
// 开启路由
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES'=>array(
        'test'        =>         function(){             echo 'just test';        },
        'hello/:name' =>          function($name){         echo 'Hello,'.$name.'<br/>';        $_SERVER['PATH_INFO'] = 'Index/index/name/'.$name;        return false;    },
        'blog/:year/:month' =>     function($year,$month){         echo 'year='.$year.'&month='.$month;    },

        '/^new\/(\d{4})\/(\d{2})$/' =>     function($year,$month){         echo 'year='.$year.'&month='.$month;    },


        'details/:id'               => 'Goods/details',
//        'details/goods_id/:id'       => '/goods_id/:1',
    ),
);