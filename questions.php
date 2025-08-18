<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php'; ?>

<form action="questionInput.php" method="get">
    <input type="submit" value="質問">
</form>

<?php

if(isset($_SESSION['user'])){ //ログアウトボタンの処理
    echo '<form action="index.php"><input type="submit" value="ログアウト"></form><br>';
}

$pdo=new PDO('mysql:host=localhost;dbname=ideastock;charset=utf8','root','pass');
foreach ($pdo->query('select name, question.id, userId, question, date from question left join user on user.id = question.userId where deleteFlg=0 order by date DESC') as $row) { //表示処理
    echo '<hr>';
    echo $row['name'];
    echo '<br>';
    echo $row['question'];
    echo '<br>';
    echo $row['date'];
    echo '<br>';

    echo '<form action="detail.php" method="get">'; //ここから詳細ページの表示
    echo '<input type="hidden" name="id" value="', $row['id'], '">';
    echo '<input type="submit" value="詳細">';
    echo '</form>';

    if(($_SESSION['user']['id'])==$row['userId']){ //ここから削除ボタンの表示
    echo '<form action="questions.php" method="get">'; 
    echo '<input type="hidden" name="questionId" value="', $row['id'], '">';
    echo '<input type="submit" name="delete" value="削除">';
    echo '</form>';
    //echo '<br>';
}
    //echo '<hr>';
}
    if(isset($_REQUEST['delete'])){  //ここから削除の処理
    deleteQuestion($_REQUEST['questionId']);
    //header('Location: questions.php'); //一応コメント化
}
?>
<?php require 'footer.php'?>

<!--foreach ($pdo->query('select qustion.id as questionid, name, question, date from question left join user on user.id = question.userId where deleteFlg=0 order by date DESC') as $row) { //表示処理元々１６行目にあったやつ