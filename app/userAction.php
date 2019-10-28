<?php
include 'database.php';
if ($conn) {
    $pageNo = $_GET['pageNo'];
    $pageSize = $_GET['pageSize'];
    switch ($_GET['action']) {
        case 'userList';
            $sql="select * from house_backups limit $pageNo,$pageSize";
            $Query = 'Select count(*) as AllNum from house_backups';
            $a     = mysqli_query( $conn, $Query );
            $b     = mysqli_fetch_assoc( $a );
            $cs = mysqli_query($conn,$sql);
            $result = mysqli_fetch_all($cs,MYSQLI_ASSOC);
            $row = array_merge(array($b['AllNum'], $result));
            if ($cs>0){
            }else{
                echo "连接失败";
                exit();
            }
            print_r(json_encode($row,JSON_UNESCAPED_UNICODE));
            break;
        case 'userEdit':
            $cityId=$_POST['cityId'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $district = $_POST['district'];
            $nick_name = $_POST['nick_name'];
            $lng= $_POST['lng'];
            $lat = $_POST['lat'];
            $price = $_POST['price'];
            $sql="update house_backups set `province` ='$province',city='$city',district='$district',nick_name='$nick_name',lng='$lng',lat='$lat',price='$price' where id='$cityId'";

            $rw=mysqli_query($conn,$sql);
            if ($rw >0){

            }else{
                echo '修改失败';
                exit();
            }
            break;
        case 'userEditId':
            $id = $_GET['id'];
            $sql="select * from house_backups where id ='$id'";
            $rw=mysqli_query($conn,$sql);
            $result = mysqli_fetch_all($rw,MYSQLI_ASSOC);
            if ($rw>0){
            }else{
                echo '操作失败';
                exit();
            }
            print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
            break;

        case 'userDel':
            $id = $_GET['id'];
            $sql="delete from house_backups where id ='$id'";
            $rw=mysqli_query($conn,$sql);
            if ($rw>0){
            }else{
                echo '删除失败';
                exit();
            }
            break;
        case 'userWhile';
            $while =$_GET['nick_name'];
            $sql="select * from house_backups where nick_name like '%$while%' limit $pageNo,$pageSize";
            $rw=mysqli_query($conn,$sql);
            $result = mysqli_fetch_all($rw,MYSQLI_ASSOC);
            $Query = "Select count(*) as AllNum from house_backups where nick_name like '%$while%'";
            $a     = mysqli_query( $conn, $Query );
            $b     = mysqli_fetch_assoc( $a );
            $row = array_merge(array($b['AllNum'], $result));
            if ($rw>0){
            }else{
                echo '操作失败';
                exit();
            }
            print_r(json_encode($row,JSON_UNESCAPED_UNICODE));
            break;
        case 'userAboutCid':
            $cid = $_GET['cid'];
            $sql="select * from house_backups where  id ='$cid'";
            $rw=mysqli_query($conn,$sql);
//            $city = mysqli_fetch_array($rw);
//            $sql2="select * from house where nick_name ='$city'";
//            $rw2=mysqli_query($conn,$sql2);
            $result = mysqli_fetch_all($rw,MYSQLI_ASSOC);
            if ($rw>0){
            }else{
                echo '操作失败';
                exit();
            }
            print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
            break;
        case 'userAboutNick':
            $nick_name = $_GET['nick_name'];
            $sql="select * from house where nick_name like '$nick_name%'";
            $rw=mysqli_query($conn,$sql);
            $result = mysqli_fetch_all($rw,MYSQLI_ASSOC);
            if ($rw>0){
            }else{
                echo '操作失败';
                exit();
            }
            print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
            break;
        case 'userUp':
            $id = $_POST['id'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $district = $_POST['district'];
            $nick_name = $_POST['nick_name'];
            $lng= $_POST['lng'];
            $lat = $_POST['lat'];
            $price = $_POST['price'];
            $sql="insert into house(`province`,city,district,nick_name,lng,lat,price) VALUES ('$province','$city','$district','$nick_name','$lng','$lat','$price')";
            $sql2="delete from house_backups where id ='$id'";
            mysqli_query($conn,$sql2);
            $rw = mysqli_query($conn,$sql);
            if ($rw == true) {
            } else {
                echo '添加失败！';
                exit();
            }
            break;
    }
}