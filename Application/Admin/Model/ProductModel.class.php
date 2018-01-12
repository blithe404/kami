<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 15:20
 */

namespace Admin\Model;


class ProductModel extends CommonModel {
    protected $_validate = array(
        array('img', 'require', '请上传图片！'),
        array('name', '', '商品名称已存在！', 0, 'unique', 3),
    );

    protected $_auto = array(
        array('datetime', 'time', 1, 'function'),
        array('updatetime', 'time', 3, 'function'),
    );

    public function addData() {
        if(!$this->create()) {
            return $this->message(0, $this->getError());
        } else {
            $res = $this->add();
            if((int)$res == 0) return $this->message(0, '添加失败');
            return $this->message(1, '添加成功');
        }
    }

    public function saveData() {
        if(!$this->create()) {
            return $this->message(0, $this->getError());
        } else {
            $res = $this->save();
            if($res === false) return $this->message(0, '保存失败');
            return $this->message(1, '保存成功');
        }
    }

    public function deleteData($id) {
        if((int)$id == 0) return $this->message(0, '该记录不存在');
        $res = $this->delete($id);
        if((int)$res == 0) return $this->message(0, '删除失败');
        return $this->message(1, '删除成功');
    }
}