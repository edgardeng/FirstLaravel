## laravel 基础学习

### 配置

### Problem

Laravel 5.4默认使用utf8mb4字符编码，而不是之前的utf8编码。因此运行php artisan migrate 会出现如下错误：

[Illuminate\Database\QueryException]
SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes (SQL: alter table users add unique users_email_unique(email))

[PDOException]
SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
问题根源

MySql支持的utf8编码最大字符长度为3字节，如果遇到4字节的宽字符就会出现插入异常。三个字节UTF-8最大能编码的Unicode字符是0xffff，即Unicode中的基本多文种平面（BMP）。因而包括Emoji表情（Emoji是一种特殊的Unicode编码）在内的非基本多文种平面的Unicode字符都无法使用MySql的utf8字符集存储。

这也应该就是Laravel 5.4改用4字节长度的utf8mb4字符编码的原因之一。不过要注意的是，只有MySql 5.5.3版本以后才开始支持utf8mb4字符编码（查看版本：selection version();）。如果MySql版本过低，需要进行版本更新。

注：如果是从Laravel 5.3升级到Laravel 5.4，不需要对字符编码做切换。

解决问题

升级MySql版本到5.5.3以上。
手动配置迁移命令migrate生成的默认字符串长度，在AppServiceProvider中调用Schema::defaultStringLength方法来实现配置：
    use Illuminate\Support\Facades\Schema;

    /**
* Bootstrap any application services.
*
* @return void
*/
public function boot()
{
   Schema::defaultStringLength(191);
}

## 数据库操作


Laravel 中提供了DB facade(原始查找)、查询构造器 和 Eloquent ORM三种操作数据库方式

### 数据库连接：

config/database.php 修改数据库
  
  'default' => env('DB_CONNECTION', 'mysql') 是否正确
  

.env 修改默认数据库地址和数据库密码

### 插入数据表
```
CREATE TABLE IF NOT EXISTS student(

	`id` INT AUTO_INCREMENT PRIMARY KEY,

    `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '姓名',

    `age` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '年龄',

    `sex` TINYINT UNSIGNED NOT NULL DEFAULT 10 COMMENT '性别',
    
     `created_at` INT NOT NULL DEFAULT 0 COMMENT '新增时间',
    
       `updated_at` INT NOT NULL DEFAULT 0 COMMENT '修改时间'
    
    )ENGINE=INNODB DEFAULT CHARSET = UTF8 AUTO_INCREMENT=1001 COMMENT='学生表';
    
```
### DB facade 实现CURD
  创建studentController
    // 最原始的 查询
    //        $student = DB::select('select * from student');
    //        dump($student);
    
            // 最原始的插入
    //        $bool = DB::insert('insert into student(name, age) VALUES (?, ?)',['imooc',18]);
    //        dump($bool);
            // 最原始的更新
    //        $num = DB::update('update student set age = ? where name = ?', [19,'edgar']);
    //        dump($num);
    
            // 选择
    //        $student = DB::select('select * from student WHERE age > ?',[18]);
    //        dump($student);
    
            // 选择
            $num = DB::delete('delete from student WHERE age > ?',[18]);
            dump($num); //返回行数 或0
### 查询构造器
  1 laravel  方便流畅的接口
  2 PDO 参数绑定        
  3 几乎所以的数据库 满足
            
```php

  $bool = DB::table('student')->insert (
            ['name' => 'imooc',
              'age' => 18  ]
        );
        dump($bool); // 返回true

        $id = DB::table('student')->insertGetId (
            ['name' => 'imoob',
                'age' => 18  ]
       );
        dump($id); // 返回id
        // 多条数据

        $bool = DB::table('student')->insert (
            [
                ['name' => 'imood', 'age' => 18  ],
                ['name' => 'imooe', 'age' => 18  ]
            ]

        );
        dump($bool); // 返回true
        
```
#### 更新数据
    
    