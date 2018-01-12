<?php

namespace Home\Controller;


class FileController extends CommonController {
    public function ajaxUpload(){
        $return  = array('status' => 1, 'info' => '上传成功', 'data' => '');
        /* 调用文件上传组件上传文件 */
        $File = D('File');
        $type = I('get.type');
        $info = $File->ajaxUpload(
            $_FILES,
            C(strtoupper($type) .'_UPLOAD'),
            C(strtoupper($type) .'_UPLOAD_DRIVER'),
            null,
            $type
        );

        /* 记录附件信息 */
        if($info){
            $return['status'] = 1;
            $return = array_merge($info['filedata'], $return);
        } else {
            $return['status'] = 0;
            $return['info']   = $File->getError();
        }

        /* 返回JSON数据 */
        $this->ajaxReturn($return);
    }
}