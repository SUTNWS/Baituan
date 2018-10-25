<?php
header("Content-Type:text/html;charset=utf-8");
$connect = new MongoDB\Driver\Manager("mongodb://localhost:27017");

for($i = 0;$i < 10;$i++){
    $a = mt_rand(1,100);
    $filter = ['id' => $a];
    $options = [];
    $query = new MongoDB\Driver\Query($filter,$options);
    $cursor = $connect->executeQuery('test.question',$query);
    foreach($cursor as $document){
        $final = (array)$document;
        $arr[$i]['id'] = $final['id'];
        $arr[$i]['content'] = $final['content'];
    }
}

print_r(json_encode($arr));

/*未添加正规restfulAPI*/
