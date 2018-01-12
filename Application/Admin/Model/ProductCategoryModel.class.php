<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/12
 * Time: 14:12
 */

namespace Admin\Model;


class ProductCategoryModel extends CommonModel {
    protected $_validate = array(
        array('username', 'require', '请输入名称！'),
        array('username', '', '名称已存在', 0, 'unique', 3),
    );

    public function addData() {
        if(!$this->create()) {
            return $this->message(0, $this->getError());
        } else {
            $res = $this->add();
            if((int)$res == 0)
                return $this->message(0, '添加失败');
            return $this->message(1, '添加成功');
        }
    }
    public function deleteData($id) {
        if((int)$id == 0)
            return $this->message(0, '该记录不存在');
        $res = $this->delete($id);
        if((int)$res == 0)
            return $this->message(0, '删除失败');
        return $this->message(1, '删除成功');
    }
    public function sort($id, $sort) {
        if((int)$id == 0)
            return $this->message(0, '该记录不存在');
        if((int)$sort == 0)
            $sort = 1;
        $map['id'] = $id;
        $res = $this->where($map)->setField('sort', $sort);
        if($res === false)
            return $this->message(0, '排序失败');
        return $this->message(1, '排序成功');
    }
}