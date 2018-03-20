<?php
namespace app\common\model;

use think\Db;
use think\Model;
use think\Session;
use traits\model\SoftDelete;

class Article extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $insert = ['create_time'];

    //文章内容关联
    public function articleContent()
    {
        return $this->hasOne('ArticleContent','article_id','id');
    }
    /**
     * 文章作者
     * @param $value
     * @return mixed
     */
    protected function setAuthorAttr($value)
    {
        return $value ? $value : Session::get('admin_id');
    }

    /**
     * 获取作者
     * @param $value
     * @return mixed
     */
    protected function getAuthorAttr($value)
    {
        $author = Db::name('admin_user')->where('id',$value)->find();
        return $author ? $author['username'] : $value;
    }

    /**
     * 反转义HTML实体标签
     * @param $value
     * @return string
     */
    protected function setContentAttr($value)
    {
        return htmlspecialchars_decode($value);
    }

    /**
     * 序列化photo图集
     * @param $value
     * @return string
     */
    protected function setPhotoAttr($value)
    {
        return serialize($value);
    }

    /**
     * 反序列化photo图集
     * @param $value
     * @return mixed
     */
    protected function getPhotoAttr($value)
    {
        return unserialize($value);
    }

    /**
     * 创建时间
     * @return bool|string
     */
    protected function setCreateTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }
    /**
     * 删除时间
     * @return bool|string
     */
    protected function setDeleteTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }

}