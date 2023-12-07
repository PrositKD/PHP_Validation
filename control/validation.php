<?php
$n="";
$pn="";
$em="";
$passs="";
$mpass="";
$gn="";
$date1="";
$s="";
$stt="";
$ad="";
$up="";
if(isset($_REQUEST["Submit"]))
{

$name=$_REQUEST["n"];

if(empty($name))
{
    $n=" *Name is required";
    $haserror=1;
}
else if(!preg_match('/^[A-Za-z_ ]+$/', $name))
{
    $n= " *please enter a valid name";
    $haserror=1;
}
else{
    $haserror=0;
echo "Your name is ". $name;
}
$phone=$_REQUEST["p"];
if(empty($phone))
{
    $pn= " *Phone number is required";
    $haserror=1;
}
else if(!preg_match('/^[0-9]{11}+$/', $phone))
{
    $pn= " *please enter a valid Phone number ";

    $haserror=1;

}
else{
echo "<br>Your number is ". $phone;
}
$email=$_REQUEST["e"];

if(empty($email))
{
    $em=" *Email is required";
    $haserror=1;
}
else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$_REQUEST["e"]))
{
    $em= " *please enter a valid email address";
    $haserror=1;
}
else{
echo "<br>Your email is ". $email;
}
$pass=$_REQUEST["pa"];

if(empty($pass))
{
    $passs =" *Password is required";
    $haserror=1;
}
else if(!preg_match('/^(?=.*[0-9])(?=.*[A-Z]).{6}$/', $_REQUEST["pa"]))
{
    $passs = " *please enter a password of 6 which contain a upper class letter and number";
    $haserror=1;
}
$cpass=$_REQUEST["cpa"];

if($_REQUEST["cpa"]==$_REQUEST["pa"] && $_REQUEST["cpa"]!="" &&$_REQUEST["pa"]!="")
{
    echo "<br>Password matched";
    echo "<br>Password :".$pass;
}
else if($_REQUEST["cpa"]=="")
{
    $mpass=" *Confirm password is required";
}
else{
$mpass=" *Password not matched";
$haserror=1;
}

if(empty($_REQUEST["G"]))
{
    
    $gn=" *Gender is required";
    $haserror=1;
}
else{
    $gender=$_REQUEST["G"];
echo "<br>Your gender is ". $gender;
}
$date = date('Y-m-d', strtotime($_REQUEST['date']));
if($date=="1970-01-01")
{
$date1=" *Select Date";
}
else if(isset($_REQUEST["date"]))
{
    echo "<br>Your date of birth is ".$date;
}
else{
    $date1=" *Select Date";
    $haserror=1;
}
$ame=$_REQUEST["sn"];

if(empty($ame))
{
    $s= " *Shop name is required";
    $haserror=1;
}
else{
echo "<br>Your shop name is ". $ame;
}
$ne=$_REQUEST["st"];

if($ne=="----Select Option----")
{
    $stt=" *Select shop type";
    $haserror=1;
}
else{
echo "<br>Shop type is ". $ne;
}
if(empty($_FILES["image"]["name"]))
{
    $up="*Upload a shop photo";
    $haserror=1;
}
else 
{
    echo "<br> Your file name :".$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/".$_REQUEST["e"].".jpg");
}

if(empty($_REQUEST["ad"]))
{
    $ad=" *Address is required";
    $haserror=1;
}
else{
    $me=$_REQUEST["ad"];
echo "<br>Your address name is ". $me;
}
if($haserror==0)
{
$existingdata=file_get_contents("../data/jsondata.json");
$phpdata=json_decode($existingdata);
    $formdata=array(
        "Name"=>$_REQUEST["n"],
        "Phone number"=>$_REQUEST["p"],
        "Gender"=>$_REQUEST["G"],
        "Email"=>$_REQUEST["e"],
        "Password"=>$_REQUEST["pa"],
        "Date"=>$_REQUEST["date"],
        "Shop Name"=>$_REQUEST["sn"],
        "Shop Type"=>$_REQUEST["st"],
        "Address"=>$_REQUEST["ad"],
        "file"=>"../uploads/".$_REQUEST["e"].".jpg",
    );
    $phpdata[]=$formdata;

    $jsondata=json_encode($phpdata,JSON_PRETTY_PRINT);

if(file_put_contents("../data/jsondata.json",$jsondata))
{
    echo "<br>file written successfully";
}
else{
    echo "<br>file written failed";
}

}
}
?>