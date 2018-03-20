<?php
namespace app\common\model;

use think\Model;
use think\Session;

class ArticleContent extends Model
{


    /**
     * 反转义HTML实体标签
     * @param $value
     * @return string
     */
    protected function setContentAttr($value)
    {
        return htmlspecialchars_decode($value);
    }

}