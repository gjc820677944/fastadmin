<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use app\admin\model\Test as t;
/**
 * 测试管理
 *
 * @icon fa fa-circle-o
 */
class Test extends Backend
{
    
    /**
     * Test模型对象
     * @var \app\admin\model\Test
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Test;
        $this->view->assign("weekList", $this->model->getWeekList());
        $this->view->assign("flagList", $this->model->getFlagList());
        $this->view->assign("genderdataList", $this->model->getGenderdataList());
        $this->view->assign("hobbydataList", $this->model->getHobbydataList());
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->view->assign("stateList", $this->model->getStateList());
    }

    public function edit($ids = NULL)
    {
        $ipInfos = $this->getCityByIp('122.4.0.0'); //baidu.com IP地址
        var_dump($ipInfos);exit;
    }
    function getCityByIp($ip = '')
    {
        $city=['山东','河北','辽宁','山西','黑龙江','吉林'];
        if($ip == ''){
            return 3;
        }else{
            $url="http://ip.taobao.com/service/getIpInfo.php?ip=39.95.255.255";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $ip = @curl_exec($ch);
            curl_close($ch);
            $data=json_decode($ip,true);
            if($data['code']!='0'){
                return 3;
            }
            $data=$data['data'];
            if(isset($data['region']) && in_array($data['region'],$city)){
                return 3;
            }else{
                return 5;
            }
        }
    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

}
