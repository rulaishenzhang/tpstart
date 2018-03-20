<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19
 * Time: 10:54
 */

namespace app\admin\controller;


use app\common\controller\AdminBase;
use app\common\model\SiteFile as SiteFileModel;

class SiteFile extends AdminBase
{
    protected $site_file_model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->site_file_model = new SiteFileModel();
    }

    public function index($page = 1)
    {
        $file_list = $this->site_file_model->paginate(15,false,[
            'page'=> $page
        ]);
        return $this->fetch('index', [
            'file_list' => $file_list
        ]);
    }


    /**
     * 通用选择图片
     * @return mixed
     */
    public function images($page = 1)
    {
        $result = $this->site_file_model->paginate(2,false,['page'=>$page]);
        return $this->fetch('images', [
            'result' => $result
        ]);

    }

    /**
     * 通用上传图片
     */
    public function imagesup()
    {
        return $this->fetch('imagesup');
    }

}