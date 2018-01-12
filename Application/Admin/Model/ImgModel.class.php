<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/13
 * Time: 02:15
 */

namespace Admin\Model;


class ImgModel extends CommonModel {
    public function saveImg($id, $pid, $path) {
        if((int)$id == 0)
            return $this->message(0, '该记录不存在');
        if((int)$pid == 0)
            return $this->message(0, '该商品不存在');
        if(empty($path))
            return $this->message(0, '请上传图片');

        $map['id'] = $id;
        $data = array(
            'pid' => $pid,
            'path' => $path,
        );
        $res = $this->where($map)->save($data);
        if($res === false)
            return $this->message(0, '保存失败');
        if((int)$res == 0)
            return $this->message(0, '未做修改');
        return $this->message(1, '保存成功');
    }

    public function saveLogo($id, $path) {
        if((int)$id == 0)
            return $this->message(0, '该记录不存在');
        if(empty($path))
            return $this->message(0, '请上传图片');

        $map['id'] = $id;
        $data = array(
            'path' => $path,
        );
        $res = $this->where($map)->save($data);
        if($res === false)
            return $this->message(0, '保存失败');
        if((int)$res == 0)
            return $this->message(0, '未做修改');
        return $this->message(1, '保存成功');
    }
}