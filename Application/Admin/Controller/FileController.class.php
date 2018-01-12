<?php

namespace Admin\Controller;


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

        if($type == 'NOTICE') {
            if($info){
                $return['code'] = 0;
                $return['data'] = array(
                    'src' => $info['file']['path']
                );
            } else {
                $return['code'] = -1;
                $return['msg'] = $File->getError();
            }
            /* 返回JSON数据 */
            $this->ajaxReturn($return);
        }

        /* 记录附件信息 */
        if($info){
            $return['status'] = 1;
            $return = array_merge($info['file'], $return);
        } else {
            $return['status'] = 0;
            $return['info']   = $File->getError();
        }

        /* 返回JSON数据 */
        $this->ajaxReturn($return);
    }
}