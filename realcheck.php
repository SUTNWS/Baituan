<?php

$answer_json = '{
    "answer_data":{
        "1":{
            "questionId":13,
            "answer":"A"
        },
        "2":{
            "questionId":26,
            "answer":"B"
        },
        "3":{
            "questionId":35,
            "answer":"C"
        },
        "4":{
            "questionId":48,
            "answer":"D"
        }
    }
}';

$grade = 0;
$arr = json_decode($answer_json,true);
$check_arr = $arr['answer_data'];

$connect = new MongoDB\Driver\Manager("mongodb://localhost:27017");

for($i = 1;$i <=4;$i++){
    $filter = ['id' => $check_arr[$i]['questionId']];
    $options = [];
    $query = new MongoDB\Driver\Query($filter,$options);
    $cursor = $connect->executeQuery('test.answer',$query);
    foreach($cursor as $document){
        $final = (array)$document;
        $answer_arr[$i]['id'] = $final['id'];
        $answer_arr[$i]['answer'] = $final['answer'];
    }
    if($answer_arr[$i]['answer'] == $check_arr[$i]['answer']){
        $grade++;
    }
}
    echo "本次得分为".$grade;
