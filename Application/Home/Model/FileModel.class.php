<?php

namespace Home\Model;


class FileModel extends CommonModel {
    public function ajaxUpload($files, $setting, $driver = 'Local', $config = null, $type) {
        $Upload = new \Think\Upload($setting, 'Local', $config);
        $info = $Upload->upload($files);

        /* 设置文件保存位置 */
        $this->_auto[] = array('location', 'ftp' === strtolower($driver) ? 1 : 0, self::MODEL_INSERT);

        if ($info) { //文件上传成功，记录文件信息
            foreach ($info as $key => &$value) {
                /* 已经存在文件记录 */
                if (isset($value['id']) && is_numeric($value['id'])) {
                    $value['path'] = substr($setting['rootPath'], 1) . $value['savepath'] . $value['savename']; //在模板里的url路径
                    continue;
                }

                $value['path'] = substr($setting['rootPath'], 1) . $value['savepath'] . $value['savename']; //在模板里的url路径
                /* 记录文件信息 */
                $value['id'] = rand();

                /* 是否生成缩略图 */

            }
            return $info; //文件上传成功
        } else {
            $this->error = $Upload->getError();
            return false;
        }
    }
}