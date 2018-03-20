<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/20
 * Time: 14:03
 */

namespace app\api\controller;


use think\Controller;
use think\Session;
use app\common\model\SiteFile;

class Upload extends Controller
{
    protected $site_file_model;

    protected function _initialize()
    {
        parent::_initialize();
        if (!Session::has('admin_id')) {
            $result = [
                'error'   => 1,
                'message' => '未登录'
            ];

            return json($result);
        }
        $this->site_file_model = new SiteFile();
    }

    /**
     * 通用图片上传接口
     * @return \think\response\Json
     */
    public function upload()
    {
        $config = [
            'size' => 2097152,
            'ext'  => 'jpg,gif,png,bmp'
        ];

        $file = $this->request->file('file');

        $upload_path = str_replace('\\', '/', ROOT_PATH . 'public/uploads/images');
        $save_path   = '/uploads/images/';
        $info        = $file->validate($config)->move($upload_path);

        if ($info) {
            $fileinfo = $info->getInfo();
            $data = [
                'filename' => $fileinfo['name'],
                'filesize' => $fileinfo['size'],
                'path' => str_replace('\\', '/', $save_path . $info->getSaveName()),
                'type' => 1,
                'adduser' => Session::get('admin_id')
            ];
            if( $this->site_file_model->save($data)){
                $result = [
                    'error' => 0,
                    'url'   => str_replace('\\', '/', $save_path . $info->getSaveName()),
                    'fileid' =>  $this->site_file_model->id

                ];
            }else{
                $result = [
                    'error' => 2,
                    'message' => '写入出错,请重新尝试'
                ];
            }

        } else {
            $result = [
                'error'   => 1,
                'message' => $file->getError()
            ];
        }

        return json($result);
    }

}