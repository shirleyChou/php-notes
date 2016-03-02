<p>This is going to be ignored by PHP and displayed by the browser.</p>
<?php
//echo "if u want to serve XHTML or XML documents, do it like this\n";
//echo "Recommended to use <?php?>\n"
?>
<script language="php">
    // echo "some editors (like FrontPage) don\'t like processing instructions";
</script>

<?php
//echo "This is a test";
//echo "test2"
?> // 结尾一行要么用';'要么用结尾符号
<p>This will also be ignored by PHP and displayed by the browser.</p>
*/

<?php # data types. Variable has to be started with '$' and ended with ';'
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
$var = NULL
//echo $array[2];
//echo $array[6];
//var_dump($array);

//echo "He drank some $juice juice.".PHP_EOL; // .PHP_EOL == '\r'
//echo "He drank some juice made of {$juice}s.";
//echo "He drank some juice made of ${juice}s.";
//echo "He drank some juice made of $juice_of_many[0]s.".PHP_EOL; // Won't work
//echo "He drank some $juice_of_many[koolaid1] juice.".PHP_EOL;
//var_dump($juice_of_many)

//var_dump((bool) array());
//echo gettype($bool); // type: boolean

//var_dump((int) (25/7));  # (int)将float进行类型转换
//var_dump($int); // value type: string(3) "hey"
//echo 25/7; # 没有整除运算符. 不可以返回3.
//echo (int) (25/7) == intval(25/7); // return 1

//echo $float;
//var_dump($float)
?>

<?php # if statement
# "0" == False
//if (is_string($str)) {
//    echo "String: $bool";  // the echo statement in if statement should end with ';'
//}
?>

<?php # class
class people {
    public $john = "John Smith";
    public $jane = "Jane Smith";
    public $robert = "Robert Paulsen";

    public $smith = "Smith";
}

$people = new people();
$juice_of_many = array("apple", "orange", "koolaid1" => "purple");

//echo "$people->john drank some $juice_of_many[koolaid1] juice.".PHP_EOL;
?>

<?php # function
function getArray() {
    return array(1, 2, 3);
}
//echo $secondElement = getArray()[1];
?>

<?php
$foo = 'Bob';              // 将 'Bob' 赋给 $foo
$bar = &$foo;              // $bar拿到了$foo的地址. 只能是有名字的变量!
$bar = "My name is $bar";  // 修改 $bar 变量
echo $bar;
echo $foo;                 // $foo 的值也被修改
?>

