<?php
include_once "db.php";
if (isset($_POST['subject'])) {
    $Que->save([
        'text' => $_POST['subject'],
        'vote' => 0,
        'subject_id' => 0,
        'sh' => 1
    ]);
    $subject_id = $Que->find(['text' => $_POST['subject']])['id'];
}
if (isset($_POST['option'])) {
    foreach ($_POST['option'] as $option)
        $Que->save([
            'text' => $option,
            'vote' => 0,
            'subject_id' => $subject_id,
        ]);
}
to("../back.php?do=que");
