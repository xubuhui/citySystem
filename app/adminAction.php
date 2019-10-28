<?php
include 'database.php';
if ($conn) {
    $pageNo = $_GET['pageNo'];
    $pageSize = $_GET['pageSize'];
    switch ($_GET['action']) {
        case 'adminList';
            $sql = "select * from house limit $pageNo,$pageSize";
            $Query = 'Select count(*) as AllNum from house';
            $a     = mysqli_query( $conn, $Query );
            $b     = mysqli_fetch_assoc( $a );
            $cs = mysqli_query($conn,$sql);
            $result = mysqli_fetch_all($cs,MYSQLI_ASSOC);
            $row = array_merge(array($b['AllNum'], $result));
            if ($cs>0){
            }else{
                echo '查询失败';
                exit();
            }
            print_r(json_encode($row,JSON_UNESCAPED_UNICODE));
            break;
        case 'adminAdd':
//            $cityId=$_POST['cityId'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $district = $_POST['district'];
            $nick_name = $_POST['nick_name'];
            $lng= $_POST['lng'];
            $lat = $_POST['lat'];
            $price = $_POST['price'];
            $sql="insert into house(`province`,city,district,nick_name,lng,lat,price) VALUES ('$province','$city','$district','$nick_name','$lng','$lat','$price')";
//            echo $sql;
//            exit();
            $rw = mysqli_query($conn,$sql);
            if ($rw == true) {
//                echo '添加成功';
            } else {
                echo '添加失败！';
                exit();
            }
            break;
        case 'adminDel':
            $id = $_GET['id'];
            $sql="delete from house where Id ='$id'";
            $rw=mysqli_query($conn,$sql);
            if ($rw>0){
            }else{
                echo '删除失败';
                exit();
            }
            break;
        case 'adminEdit':
            $cityId=$_POST['cityId'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $district = $_POST['district'];
            $nick_name = $_POST['nick_name'];
            $lng= $_POST['lng'];
            $lat = $_POST['lat'];
            $price = $_POST['price'];
            $sql="update house set `province` ='$province',city='$city',district='$district',nick_name='$nick_name',lng='$lng',lat='$lat',price='$price' where Id='$cityId'";

            $rw=mysqli_query($conn,$sql);
            if ($rw >0){
            }else{
                echo '修改失败';
                exit();
            }
            break;
        case 'adminEditId':
            $id = $_GET['id'];
            $sql="select * from house where Id ='$id'";
            $rw=mysqli_query($conn,$sql);
            $result = mysqli_fetch_all($rw,MYSQLI_ASSOC);
            if ($rw>0){
            }else{
                echo '操作失败';
                exit();
            }
            print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
            break;
        case 'adminWhile':
            $nick_name = $_GET['nick_name'];
            $sql="select * from house where nick_name like '%$nick_name%' limit $pageNo,$pageSize";
            $rw=mysqli_query($conn,$sql);
            $result = mysqli_fetch_all($rw,MYSQLI_ASSOC);
            $Query = "Select count(*) as AllNum from house where nick_name like '%$nick_name%'";
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
        case 'adminEChart':
            $sql = "select * from house where province = '黑龙江省' limit 40";
            $cs = mysqli_query($conn,$sql);
            $result = mysqli_fetch_all($cs,MYSQLI_ASSOC);
            if ($result>0){
            }else{
                echo '查询失败';
                exit();
            }
            print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
            break;
    }
}
