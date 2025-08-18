<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'function.php'; ?>
<?php
if(isset($_SESSION['user'])){
    echo '<form action="index.php"><input type="submit" value="ログアウト"></form><br>';
}
?>
<?php
echo '<p>質問を投稿する。</p><br>';
echo '<form action="questionInput.php">';
echo '<input type="hidden" name="id" value="', $_SESSION['user']['id'], '">';
echo '<input type="textarea" name="question"><br>';
echo '<input type="submit" value="登録"><br>';
echo '</form>';
?>

<?php
Connect();
//if(isset($_REQUEST['loginId'],$_REQUEST['password'])){
if(isset($_REQUEST['question'])){
    if($_SESSION['user']){
        addQuestion($_REQUEST['id'],$_REQUEST['question']); 
    }else{
        echo 'エラー';
    }
}
?>
<form action="questions.php" method="get">
    <input type="submit" value="戻る">
</form>
<?php require 'footer.php'?>