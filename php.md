PHP Basics
-----
#### Build-in web server
> php -S localhost:8000 file_name.php

#### Get the corrent php version 
```php
<?php
phpinfo();
```

#### [When should I use require vs. include?](http://stackoverflow.com/questions/2418473/when-should-i-use-require-once-vs-include)    
The require() function is identical to include(), except that it handles errors differently. If an error occurs, the include() function generates a warning, but the script will continue execution. The require() generates a fatal error, and the script will stop.

#### [When should I use require_once vs. require?](http://stackoverflow.com/questions/2418473/when-should-i-use-require-once-vs-include)
The require_once() statement is identical to require() except PHP will check if the file has already been included, and if so, not include (require) it again.

#### [What is the difference between single-quoted and double-quoted strings in PHP?](http://stackoverflow.com/questions/3446216/what-is-the-difference-between-single-quoted-and-double-quoted-strings-in-php)
  * **single-quote**: Single quoted strings will display things almost completely "as is." ，除了可用`\\`表示`\`, 以及用`\'`表示单引号`'`
  * **double-quote**: 识别变量名

#### [PHP: Public, Private, Protected](http://stackoverflow.com/questions/4361553/php-public-private-protected) 
  * **public**: scope to make that variable/function available from anywhere, other classes and instances of the object.       
  * **protected**： scope when you want to make your variable/function visible in all classes that extend current class including the parent class. 
  * **private**: scope when you want your variable/function to be visible in its own class only 

  ![](https://github.com/shirleyChou/php-notes/blob/master/picts/SFysv.jpg?raw=true)     

#### [What is the function __construct used for](http://stackoverflow.com/questions/455910/what-is-the-function-construct-used-for)
  * Not required. Use as '__init__' in Python.

#### What is the function __destruct used for
  * PHP将在对象被销毁前（即从内存中清除前）调用这个方法。 默认情况下，PHP仅仅释放对象属性所占用的内存并销毁对象相关的资源。析构函数允许你在使用一个对象之后执行任意代码来清除内存。

#### &
  1. **变量引用**：允许你用两个变量指向同一个内容
  2. **函数的传址引用**
```PHP
<?php
function test(&$a) {
    $a = $a + 100;
}
$b = 1;
echo $b;
test($b);  // 把变量$b的内存地址给了函数test
echo $b;
test(1);   // Fatal error: Only variables can be passed by reference
```

#### array 数组
  * **索引数组**
```PHP
<?php
$array = array("foo", "bar", "hallo", "world");  // $array[0] == "foo"
```
  * **关联数组**
```php
$age = array("Bill"=>"60","Steve"=>"56","Mark"=>"31");
echo $age["Bill"];   // "60"
```
