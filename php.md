PHP Basics
-----
#### Build-in web server
> php -S localhost:8000 file_name.php

#### Get the corrent php version 
```php
<?php
phpinfo();
```
或者在命令行下执行PHP：
```php
> php -i
```

### Code Style of PHP
* [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
* [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md), [中文](https://segmentfault.com/a/1190000002521577)
* [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md), [中文](https://segmentfault.com/a/1190000002521620)
* [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md), [中文](https://segmentfault.com/a/1190000002521658)   
* [Read about PEAR Coding Standards](http://pear.php.net/manual/en/standards.php)\
* [Read about Symfony Coding Standards](http://symfony.com/doc/current/contributing/code/standards.html)

And [php codesniffer](http://pear.php.net/package/PHP_CodeSniffer/) can be use for against any one of these recommendations.   
也可以手动运行**phpcs**命令,它会显示出相应的错误以及如何修正的方法:
> phpcs -sw --standard=PSR2 file.php  
 

### Language Highlights
#### Command Line interface
```php
<?php
// $argc: 是一个整数，表示参数个数。最小值为 1, 包含一个脚本名称。
if ($argc != 2) {
    echo "Usage: php hello.php [name]. \n";
    // 命令运行失败时，可以通过 exit() 表达式返回一个非 0 整数来通知 shell
    exit(1);
}
// $argv: 是一个数组变量，包含每个参数的值，它的第一个元素($argv[0])一直是 PHP 脚本的名称，如本例中为 hello.php
$name = $argv[1];
echo "Hello $name\n";
```
然后在命令行输入：
```php
$ php hello.php
Usage: php hello.php [name].

$ php hello.php world
Hello world

$ php hello.php hello world
Usage: php hello.php [name].
```

#### Xdebug
Xdebug 是一个 php 的调试器。 它可以被用来在很多 IDE(集成开发环境) 中做断点调试以及堆栈检查。它还可以像 PHPUnit 和 KCacheGrind 一样，做代码覆盖检查或者程序性能跟踪。调错的其他方式包括`var_dump()`/`print_r`。


### The Basics
#### Data types
Variable has to be started with '$' and ended with ';'
```php
<?php
$bool = true;  # boolean不区分大小写
$int = 12;
$float = 7E-10;
$str = "hey";  //转义字符有效, 而且变量可以被解析
$str2 = 'hey'; //单引号里只有\'和\\会被转义. 其他如\n只是字符
$juice = "apple";
// key(integer, string) => value(any data type)
$juice_of_many = [
    "apple",
    "orange",
    "koolaid1" => "purple",
];
$array = [
    "a",
    "b",
    6 => "c",
    "d",
];
$var = NULL;

echo gettype($bool);  // type: boolean
var_dump((bool) array());

var_dump((int) (25/7));  // (int)将float进行类型转换
var_dump($int); // value type: string(3) "hey"
echo 25/7; // 没有整除运算符. 不可以返回3. 跟python不一样
echo (int) (25/7) == intval(25/7); // 1

echo $float;  // 7.0E-10
var_dump($float);  // float(7.0E-10)

// .PHP_EOL == '\r', 换行符. 以提高代码的源代码级可移植性。因为每个平台的换行符不一样
echo "He drank some $juice juice.".PHP_EOL;
echo "He drank some juice made of {$juice}s.".PHP_EOL;
echo "He drank some juice made of ${juice}s.".PHP_EOL;
echo "He drank some juice made of $juice_of_many[0]s.".PHP_EOL;
echo "He drank some $juice_of_many[koolaid1] juice.".PHP_EOL;
var_dump($juice_of_many);
/*
 array(3) {
  [0]=>
  string(5) "apple"
  [1]=>
  string(6) "orange"
  ["koolaid1"]=>
  string(6) "purple"
}
 */

echo $array[2];  // Notice: Undefined offset: 2
echo $array[6];  // c
var_dump($array);
/*
  carray(4) {
  [0]=>
  string(1) "a"
  [1]=>
  string(1) "b"
  [6]=>
  string(1) "c"
  [7]=>
  string(1) "d"
}
*/
?>
```

#### Variables and Constant
##### 变量的命名规则
一个有效的变量名由`字母`或者`下划线`开头，后面跟上任意数量的字母，数字，或者下划线：
```php
$4site = 'not yet';     // 非法变量名；以数字开头
$_4site = 'not yet';    // 合法变量名；以下划线开头
$i站点is = 'mansikka';  // 合法变量名；可以用中文
```

##### 传值赋值和引用赋值
变量默认`传值赋值`， 另外也有`引用赋值`(给的是变量的地址)。使用引用赋值，将一个`&`符号加到将要赋值的变量前（源变量）。  

引用赋值使用的两个地方：  
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
另外，只有有名字的变量才可以引用赋值。
```php
$bar = &$foo;      // 合法的赋值
$bar = &(24 * 7);  // 非法; 引用没有名字的表达式
```

##### 变量范围
PHP中**全局变量**在函数中使用时必须声明为 global
```php
<?php
$a = 1;
$b = 2;

function Sum()
{
    global $a, $b;
    $b = $a + $b;
}
Sum();
echo $b;  // 3
?>

// vs

<?php
$a = 1;
$b = 2;

function Sum()
{
    $GLOBALS['b'] = $GLOBALS['a'] + $GLOBALS['b'];
}

Sum();
echo $b;
?>
```

静态变量(static variable)仅在局部函数域中存在，但当程序执行离开此作用域时，其值并不丢失。
```php
<?php
function test()
{
    static $a = 0;  // 变量 $a 仅在第一次调用test()函数时被初始化，之后每次调用test()函数都会输出 $a 的值并加一。
    echo $a;
    $a++;
}
?>
```
静态变量的声明不可为表达式
```php
<?php
function foo(){
    static $int = 0;          // correct
    static $int = 1+2;        // wrong  (as it is an expression)
    static $int = sqrt(121);  // wrong  (as it is an expression too)

    $int++;
    echo $int;
}
?>
```
##### 可变变量
一个可变变量可以获取普通变量的值作为这个可变变量的变量名
```php
<?php
$a = 'hello';
$$a = 'world';

echo "$a ${$a}".PHP_EOL;  // hello world
echo "$a $hello";         // hello world
?>
```

类的属性也可以通过可变属性名来访问
```php
<?php
class foo {
    var $bar = 'I am bar.';
    var $arr = array('I am A.', 'I am B.', 'I am C.');
    var $r   = 'I am r.';
}

$foo = new foo();
$bar = 'bar';
$baz = array('foo', 'bar', 'baz', 'quux');
echo $foo->$bar . "\n";
echo $foo->$baz[1] . "\n";

$start = 'b';
$end   = 'ar';
echo $foo->{$start . $end} . "\n";

$arr = 'arr';
echo $foo->$arr[1] . "\n";
echo $foo->{$arr}[1] . "\n";

?>
```

#### Comparison operators
![](https://github.com/shirleyChou/php-notes/blob/master/picts/compare-operators.JPG?raw=true)

PHP默认行为是，如果一个字符串和一个数字比较的时候，默认好像会使用intval()将字符串转为数值类型再进行比较。

```php
<?php
$a = 5;   // 5 as an integer

var_dump($a == 5);       // compare value; return true
var_dump($a == '5');     // compare value (ignore type); return true
var_dump($a === 5);      // compare type/value (integer vs. integer); return true
var_dump($a === '5');    // compare type/value (integer vs. string); return false

/**
 * Strict comparisons
 */
if (strpos('testing', 'test')) {    // 'test' is found at position 0, which is interpreted as the boolean 'false'
    // code...
}

// vs

if (strpos('testing', 'test') !== false) {    // true, as strict comparison was made (0 !== false)
    // code...
}
```

#### Conditional statements
##### If statements
```php
<?php
function test($a)
{
    if ($a) {
        return true;
    } else {
        return false;
    }
}

// vs

function test($a)
{
    if ($a) {
        return true;
    }
    return false;    // else is not necessary
}
```
#### Global namespace(命名空间)
在PHP中，**命名空间**用来解决在编写类库或应用程序时创建可重用的代码如类或函数时碰到的两类问题： 

1. 用户编写的代码与PHP内部的类/函数/常量或第三方类/函数/常量之间的名字冲突。  
2. 为很长的标识符名称(通常是为了缓解第一类问题而定义的)创建一个别名（或简短）的名称，提高源代码的可读性。



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
