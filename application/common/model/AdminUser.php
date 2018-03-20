<?php
namespace app\common\model;

use think\Model;

/**
 * 管理员模型
 * Class AdminUser
 * @package app\common\model
 */
class AdminUser extends Model
{
    protected $insert = ['create_time'];

    /**
     * 创建时间
     * @return bool|string
     */
    protected function setCreateTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }
}