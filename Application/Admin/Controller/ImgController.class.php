<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/13
 * Time: 00:52
 */

namespace Admin\Controller;


class ImgController extends CommonController {
    public function index() {
        $img = M('Img')->getField('name,pid,path', true);
        $this->assign('img', $img);
        $this->ajaxReturn($this->fetch());
    }

    public function logo() {
        $name = I('get.name', '', 'trim');
        $data = M('Img')->where(array('name'=>$name))->find();

        if(IS_POST) {
            $id = I('post.id', 0, 'intval');
            $path = I('post.path', '', 'trim');
            $Img = D('Img');
            $res = $Img->saveLogo($id, $path);
            $this->ajaxReturn($res);
        }

        $this->assign('data', $data);
        $this->ajaxReturn($this->fetch());
    }

    public function img() {
        $name = I('get.name', '', 'trim');
        $data = M('Img')->where(array('name'=>$name))->find();
        $product = M('Product')->order('sale desc')->select();

        if(IS_POST) {
            $id = I('post.id', 0, 'intval');
            $pid = I('post.pid', 0, 'intval');
            $path = I('post.path', '', 'trim');
            $Img = D('Img');
            $res = $Img->saveImg($id, $pid, $path);
            $this->ajaxReturn($res);
        }

        $this->assign('product', $product);
        $this->assign('data', $data);
        $this->ajaxReturn($this->fetch());
    }
}