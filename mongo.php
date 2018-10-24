<?php
$connect = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$bulk = new MongoDB\Driver\BulkWrite;
$document = ['x' => 1,'name' => 'CareXuan'];
$bulk->insert($document);
$connect->executeBulkWrite('test.xuan',$bulk);

/*在使用php7进行mongodb的insert操作时，必须先实例化一个MongoDB\Driver\BulkWrite对象（最后不加括号）
在实例化之后，使用此实例化的变量执行insert函数(括号中要写入方括号包含的类似数组的模式)即可完成插入操作
最后对于最开始实例化的mongodb对象执行executeBulkWrite（固定），参数共有两个，第一个参数指的是这条数据写入哪个数据库的哪个集合，第二条数据指的是实例化的插入对象($bulk)*/

$filter = [];
$options = [];

$query = new MongoDB\Driver\Query($filter,$options);

$cursor = $connect->executeQuery('test.xuan',$query);

foreach ($cursor as $document) {
    print_r($document);
}
/*执行查询操作时要实例化一个MongoDB\Driver\Query对象，并且这个对象要有两个参数，一个为filter，一个为options，可以为空但必须设置，写的是查询条件，全为空则查出所有数据米相当于find()
之后使用最开始实例化的mongodb对象执行executeQuery对象（固定），两个参数为什么数据库的什么集合，第二个为实例化的Query对象
最后查询出来的是一个StdClass Object,使用(array)$result对结果集对象进行强制转换，即可变为一个可操作的数组*/

$bulk = new MongoDB\Driver\BulkWrite;
$bulk->delete(['x'=>1],['limit'=>0]);
$connect->executeBulkWrite('test.xuan',$bulk);
/*更新操作因为和插入操作类似所以不写例子，删除操作差距也不大，值得一提的是在删除时，delete方法内部写的第一个方括号中相当于mysql中的where，第二个方括号中是limit参数，当limit为1时，则删除查出的第一条数据，当limit为0时则会全表删除*/
