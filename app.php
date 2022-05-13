<?php
//1.设计数据库

//2.链接数据库
$conn = new mysqli("localhost","root","","phpcrud");
if ($conn->connect_error){
    die("Could not connect to database!");
}
//3.构建接口
$action = "read";
//返回的数据对象
$res = array('error'=>false);
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
//获取接口
if($action == "read"){
    $conn->query("set names utf8");//设置编码
    $result = $conn->query("SELECT * FROM `user`"); //SQL查询
    //var_dump($result);
    $user = array();
    while($row=$result->fetch_assoc()){
     array_push($user,$row);
    }
    //var_dump($user);
    $res['user'] = $user;
}
//增加数据
if($action == "create"){
$USERNAME = $_POST['USERNAME'];
$email = $_POST['email'];
$wechat = $_POST['wechat'];
$phone = $_POST['phone'];
$conn->query("set name uf8");
//执行SQL语句
$result = $conn->query("INSERT INTO `user`(`USERNAME`,`email`,`wechat`,`phone`)
 VALUES ('$USERNAME','$email','$wechat','$phone')");
//测试
 if($result){
     $res["message"]="添加成功";
 } else{
    $res['error']=ture;
    $res["message"]="添加失败";
 }
}
//更新数据
if($action == "update"){
    $id = $_POST['id'];
    $USERNAME = $_POST['USERNAME'];
    $email = $_POST['email'];
    $wechat = $_POST['wechat'];
    $phone = $_POST['phone'];
    $conn->query("set name uf8");
    //执行SQL语句
$result = $conn->query("UPDATE `user`SET`USERNAME`='$USERNAME',`email`='$email',`wechat`='$wechat',`phone`='$phone' 
WHERE `id`='$id'");
//测试
if($result){
    $res["message"]="更新成功";
} else{
   $res['error']=ture;
   $res["message"]="更新失败";
}
}
//删除数据
if($action == "delete"){
    $id = $_POST['id'];
    //执行SQL语句
$result = $conn->query("DELETE FROM `user`WHERE `id`='$id'");
//测试
if($result){
    $res["message"]="删除成功";
} else{
   $res['error']=ture;
   $res["message"]="删除失败";
}
}

$conn->close();
header("Content-type:application/json");
 //返回数据
echo json_encode($res);
die();
?>