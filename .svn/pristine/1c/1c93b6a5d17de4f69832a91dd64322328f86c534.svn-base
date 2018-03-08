<?php
use League\Flysystem\Util\MimeType;
use Illuminate\Support\Facades\DB;
use \App\Modules\User\Model\AttachmentModel;
use \App\Modules\Manage\Model\ConfigModel;
use Gregwar\Image\Image;
use Illuminate\Support\Facades\Storage;

class FileClass
{
    /**
     * 上传文件
     *
     * @param object $file
     * @param string $path
     * @param array $allowExtension
     * @return string
     *
     */
    static function uploadFile($file, $path = 'default', $allowExtension = null)
    {
        $fileTypeArr = ['task', 'sys', 'user', 'default'];
        if (!in_array($path, $fileTypeArr)) {
            return CommonClass::formatResponse('未定义的文件上传目录', 1001);
        }
        $attachmentPath = 'attachment';
        switch ($path) {
            case 'task':
                $disk = 'public';
                $filePath = $attachmentPath . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . date('Y/m/d') . DIRECTORY_SEPARATOR;
                break;
            case 'sys':
                $disk = 'public';
                $filePath = $attachmentPath . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR;
                break;
            case 'user':
                $disk = 'public';
                $filePath = $attachmentPath . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . date('Y/m/d') . DIRECTORY_SEPARATOR;
                break;
            default:
                $disk = 'local';
                $filePath = $attachmentPath . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . date('Y/m/d') . DIRECTORY_SEPARATOR;
                break;
        }

        $fileSize = $file->getClientSize();

        $attachmentConfig = ConfigModel::getConfigByType('attachment');

        if ($fileSize > $file->getMaxFilesize() || $fileSize > $attachmentConfig['attachment']['size'] * 1024 * 1024) {
            return CommonClass::formatResponse('上传文件超出服务器大小限制', 1002);
        }

        //判断文件上传过程中是否出错
        if ($file->isValid()) {
            $mimeType = MimeType::getExtensionToMimeTypeMap();

            $configExtension = explode('|', $attachmentConfig['attachment']['extension']);
            if (!empty($configExtension)) {
                if (!in_array($file->getClientOriginalExtension(), $configExtension)) {
                    return CommonClass::formatResponse('文件类型不允许上传', 1003);
                }
            }
            if (isset($allowExtension)) {
                foreach ($allowExtension as $item) {
                    if (!in_array(FileClass::getMimeTypeByExtension($item), $mimeType)) {
                        return CommonClass::formatResponse('文件类型不允许上传', 1003);
                    }
                }
            }
            if (!in_array($file->getMimeType(), $mimeType)) {
                return CommonClass::formatResponse('未知文件类型', 1004);
            }
            $clientName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $realName = md5((substr($clientName, 0, (strlen($clientName) - strlen($extension) - 1))) . time()) . '.' . $extension;
            $status = Storage::disk($disk)->put($filePath . $realName, file_get_contents($file->getRealPath()));

            if ($status) {
                $data = array();
                $data['url'] = $filePath . $realName;
                $data['name'] = $clientName;
                $data['type'] = $extension;
                $data['size'] = $fileSize / 1024;
                $data['user_id'] = Auth::user()['id'];
                $data['disk'] = $disk;
                return CommonClass::formatResponse('上传成功', 200, $data);
            }
        }
        return CommonClass::formatResponse('文件上传失败', 1005);

    }

    /**
     *头像生成方法
     * 同时生成三张不同分辨率的图片
     */
    static function headUpload($file, $uid)
    {
        //图片保存的路径
        $filePath = 'attachment' . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR . date('Y/m/d') . DIRECTORY_SEPARATOR;

        $fileSize = $file->getClientSize();
        if ($file->getClientSize() >= $file->getMaxFilesize()) {
            return CommonClass::formatResponse('上传文件超出服务器大小限制');
        }
        //判断文件上传过程中是否出错
        if ($file->isValid()) {
            $mimeType = MimeType::getExtensionToMimeTypeMap();
            if (!in_array($file->getMimeType(), $mimeType)) {
                return CommonClass::formatResponse('文件类型不允许上传');
            }
            $clientName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $realName = md5($uid . 'large') . '.' . $extension;
            if ($file->move($filePath, $realName)) {
                $data = array();
                $data['url'] = $filePath . $realName;
                $data['path'] = \CommonClass::getDomain() . '\\' . $filePath . $realName;
                $data['name'] = $clientName;
                $data['type'] = $extension;
                $data['size'] = $fileSize / 1024;
                $data['avatar'] = $filePath;
                $data['status'] = 1;

                //处理生成三张图片
                $result = self::headHandle($data, $uid);
                if (!$result) {
                    return CommonClass::formatResponse('文件上传失败');
                }
                return CommonClass::formatResponse('上传成功', 200, $data);
            };
        }
        return CommonClass::formatResponse('文件上传失败');
    }

    /**
     * 根据后缀获取MimeType
     *
     * @param array|string $extension
     * @return string | array
     */
    static function getMimeTypeByExtension($extension)
    {
        $mimeType = MimeType::getExtensionToMimeTypeMap();
        if (is_array($extension)) {
            foreach ($extension as $item) {
                $arrMimeType[] = $mimeType[$item];
            }
            return $arrMimeType;
        }
        return $mimeType[$extension];
    }

    /**
     * 利用图片处理生成三张默认分辨率的图片
     */
    static function headHandle($data, $uid, $size = array('large' => array(150, 150), 'middle' => array(100, 100), 'small' => array(50, 50)))
    {
        $file = 'attachment' . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR . date('Y/m/d') . DIRECTORY_SEPARATOR;
        foreach ($size as $k => $v) {
            $img = Image::open($data['url']);
            is_dir($file) || mkdir($file);  //如果不存在则创建目录
            $filePath = $file . md5($uid . $k) . '.' . 'jpg';
            $img->cropResize($v[0], $v[1], '#ffffff');
            $result = $img->save($filePath);
            $data['url'] = $filePath;
            AttachmentModel::create($data);
            if (!$result) {
                return false;
            }
        }

        return true;
    }
}