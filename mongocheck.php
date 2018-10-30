<?php

<?php

$answer_json = '{
    "answer_data":{
        "1":{
            "questionId":13,
            "answer":"A"
        },
        "2":{
            "questionId":24,
            "answer":"B"
        },
        "3":{
            "questionId":36,
            "answer":"C"
        },
        "4":{
            "questionId":74,
            "answer":"D"
        }
    }
}';

$arr = json_decode($answer_json,true);
$check_arr = $arr['answer_data'];

$connect = new MongoDB\Driver\Manager("mongodb://localhost:27017");

for($i = 1;$i <=4;$i++){
    $filter = ['id' => $check_arr[$i]['questionId']];
    $options = [];
    $query = new MongoDB\Driver\Query($filter,$options);
    $cursor = $connect->executeQuery('test.question',$query);
    foreach($cursor as $document){
        $final = (array)$document;
        $arr[$i]['id'] = $final['id'];
        $arr[$i]['content'] = $final['content'];
    }
    print_r($arr[$i]);
    echo "<br />";
    print_r($check_arr[$i]);
    echo "<br />";
}
