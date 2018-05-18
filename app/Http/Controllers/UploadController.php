<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class UploadController extends BaseController {

    public function uploadFile(Request $request) {
        if($request->isMethod('POST')) {
//            var_dump($_FILES);
            $time = $request->header('ApiToken');

            $file = $request->file('apk');
            // dd($file);

            //判断文件是否上传成功
            if($file->isValid()) {
                $origin_name = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $type = $file->getClientMimeType();
                $real_path = $file->getRealPath();
                $file_name = date("Y-m-d-H-i-s")."file.".$ext;
                $bool = Storage::disk('upload')->put($file_name, file_get_contents($real_path));
                $arr = array(
                    'code' => 1,
                    'ApiToken' => $time,
                );
                if ($bool) {
                    $arr['location'] = "app/upload/".$file_name;
                } else {
                    $arr['code'] = 0;
                }
                return json_encode($arr);
            }
            exit;
        }
        return "method error";
    }


    public function testUpload(Request $request) {

            if($request->isMethod('POST')) {
//            var_dump($_FILES);
                $file = $request->file('source');
                // dd($file);

                //判断文件是否上传成功
                if($file->isValid()) {
                    $origin_name = $file->getClientOriginalName();
                    $ext = $file->getClientOriginalExtension();
                    $type = $file->getClientMimeType();
                    $real_path = $file->getRealPath();
                    $file_name = date("Y-m-d-H-i-s")."file.".$ext;
                    $bool = Storage::disk('upload')->put($file_name, file_get_contents($real_path));


                    // FileException
//Unable to create the "/Applications/MAMP/tmp/php/phpFFigJw" directory

                    // storage 的使用
//                  $bool = Storage::disk('upload')->put($filename, file_get_contents($realPath));

                    var_dump($bool);
                }

                //dd($file);
                /**
                UploadedFile {#164 ▼
                -test: false
                -originalName: "填充文件.png"
                -mimeType: "image/png"
                -size: 10340
                -error: 0
                path: "D:\xampp\tmp"
                filename: "phpF0E0.tmp"
                basename: "phpF0E0.tmp"
                pathname: "D:\xampp\tmp\phpF0E0.tmp"
                extension: "tmp"
                realPath: "D:\xampp\tmp\phpF0E0.tmp"
                aTime: 2016-11-22 04:39:27
                mTime: 2016-11-22 04:39:27
                cTime: 2016-11-22 04:39:27
                inode: 0
                size: 10340
                perms: 0100666
                owner: 0
                group: 0
                type: "file"
                writable: true
                readable: true
                executable: false
                file: true
                dir: false
                link: false
                linkTarget: "D:\xampp\tmp\phpF0E0.tmp"
                }
                 */
                exit;
            }

            return view('upload');
        }

    public function testFileUpload()
    {
        $postUrl = '/request/fileUpload';
        $csrf_field = csrf_field();
        $html = "<form action=\"$postUrl\" method=\"POST\" enctype=\"multipart/form-data\">
$csrf_field
<input type=\"file\" name=\"file\"><br/><br/>
<input type=\"submit\" value=\"提交\"/>
</form>";
        return $html;
    }

//文件上传处理
    public function postFileUpload(Request $request){
        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('file')){
            exit('上传文件为空！');
        }
        $file = $request->file('file');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            exit('文件上传出错！');
        }
        $destPath = realpath(public_path('images'));
        if(!file_exists($destPath))
            mkdir($destPath,0755,true);
        $filename = $file->getClientOriginalName();
        if(!$file->move($destPath,$filename)){
            exit('保存文件失败！');
        }
        exit('文件上传成功！');
    }


    public function photo(Request $request) {

//        $file = Input::file("file");
//        $url = Input::get();

        $info = array(
            'code' => 0
        );
        if(!$request->isMethod('POST')){
            $info['msg'] = '非POST';
        }

        if ($request->hasFile('photo')) {
            // 验证文件是否存在
            $file = $request->file('photo'); //该方法返回的对象是Symfony\Component\HttpFoundation\File\UploadedFile类的一个实例

            //判断文件上传过程中是否出错
            if(!$file->isValid()){
                $info['msg'] = "文件上传出错！";
            } else {

                $ext = $file->getClientOriginalExtension();
                $newFileName = md5(time() . rand(0, 10000)) . '.' . $ext;
                $savePath = 'image/';
                //            $file->move($destinationPath);
                $file->move($savePath, $newFileName);
                $info['code'] = 1;
                $info['location'] = "./" . $savePath . $newFileName;
            }
        } else {
            $info['msg'] = '验证文件不存在';
        }
        $result = json_encode($info);
        return $result;
    }

}
