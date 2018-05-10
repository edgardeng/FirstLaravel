##Problem


### laravel中TokenMismatchException异常处理

在使用post或者put等方法请求时，有时会报TokenMismatchException in VerifyCsrfToken.php line 67错误。原因是laravel默认开启了防CSRF。
要解决该问题有两种方式，一种是在请求时将token值也提交过去，另一种是在防CSRF时排除所请求的路由

方法一：将token值传递过去
表单提交时：

<form action="photo/12" method="post">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <input type="submit" name="提交" />
    </form>
使用AJAX请求时：

<meta name="csrf-token" content="{{ csrf_token() }}">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
复制代码

方法二：从 CSRF 保护中排除指定 URL
比如所访问的URL为http://laravel.com/photo/12，现在想排除关于photo资源的路由，则在App\Http\Middleware\VerifyCsrfToken::class中添加路由如下：

protected $except = [
        'photo',
        'photo/*',
    ];

注意，方法二将无法对photo相关路由进行CSRF防护，所以请根据实际情况选择

