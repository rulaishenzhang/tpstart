<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19
 * Time: 11:14
 */

namespace app\common\model;


use think\Db;
use think\Model;

class SiteFile extends Model
{

    protected $createTime = 'filetime';
    protected $autoWriteTimestamp = 'datetime';
    protected $updateTime = false;

    public function getTypeAttr($value)
    {
        $type = [1=>'图片',2=>'flash',3=>'视频',4=>'音频',5=>'压缩包'];
        return $type[$value];
    }

    public function getAdduserAttr($value){
        $user = Db::name('admin_user')->where('id', $value)->find();
        return $user['username'];
    }


}