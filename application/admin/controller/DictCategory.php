<?php
/**
 * User: lichenchen
 * Date: 2017-10-18
 * Time: 14:36
 */
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Cache;
use think\Db;

/**
 * Class DictCategory
 * @package app\admin\controller
 * 字典分类
 */
class DictCategory extends AdminBase
{
    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 分类列表
     */
    public function index()
    {
        $category_list = Db::name('dict_category')->where('status','eq','1')->order("id DESC")->paginate(10);;
        return $this->fetch('index',['category_list'=>$category_list]);
    }

    /**
     * 添加分类
     */
    public function add()
    {
        return $this->fetch('add');
    }

    /**
     * 保存分类
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            if (Db::name('dict_category')->insert($data)) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
    }

}