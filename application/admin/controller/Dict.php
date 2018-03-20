<?php
/**
 * User: lichenchen
 * Date: 2017-10-18
 * Time: 14:36
 */
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Cache;
use app\common\model\Dict as DictModel;
use think\Db;

/**
 * Class DictCategory
 * @package app\admin\controller
 * 字典分类
 */
class Dict extends AdminBase
{
    public function _initialize()
    {
        parent::_initialize();
        $dict_category = Db::name('dict_category')->where('status','eq',1)->order('id desc')->select();
        $this->assign('dict_category', $dict_category);
        $this->dict_model = new DictModel();

    }

    /**
     * 字典列表
     */
    public function index($page=1)
    {

        $dict_list = Db::name('dict')->where('status','eq','1')->order("id DESC")->paginate(10, false,['page'=>$page]);;
        return $this->fetch('index',['dict_list'=>$dict_list]);
    }

    /**
     * 添加字典
     */
    public function add()
    {

        return $this->fetch('add');
    }

    /**
     * 编辑字典
     */
    public function edit()
    {
        $id = $this->request->param('id', 0, 'intval');
        $result = $this->dict_model->find($id);
        return $this->fetch('edit',['result'=>$result]);
    }

    /**
     * 保存字典
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            if (Db::name('dict')->insert($data)) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
    }

    /**
     * 更新字典
     */
    public function update()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            if ($this->dict_model->allowField(true)->isUpdate(true)->update($data)) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
        //Db::table('think_user')->delete(1);
    }

    /**
     * 删除字典
     */
    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        DictModel::destroy($id);
        $this->success("删除成功！");
    }



}