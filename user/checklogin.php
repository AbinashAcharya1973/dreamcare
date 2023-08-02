<?php

include 'dbconfig.php';
include 'app.php';
$conn= new mysqli($hostname,$username,$pwd,$databasename) or die("Could not connect to mysql".mysqli_error($con));

$uid=$_POST['userid'];
$pwd1=$_POST['password'];
$rip=$_SERVER['REMOTE_ADDR'];
$myObj=new stdClass();
$sql="select * from members where membercode='".$uid."' and Pwd='".$pwd1."' and mactive='Y'";
$res=$conn->query("select * from members where membercode='".$uid."' and Pwd='".$pwd1."' and mactive='Y'");
$sql="select * from members where membercode='".$uid."' and Pwd='".$pwd1."' and mactive='Y'";
if($res->num_rows>0){
	if($rec=$res->fetch_assoc()){
		//echo $rec['UserType'];
		/*$branchid=$rec['BranchID'];
		$qr=$conn->query("select * from branch where BranchID=".$branchid);
		if($qr->num_rows>0){
			if($rs=$qr->fetch_assoc()){
				$bname=$rs['Branch'];
			}
		}else{
			$bname="HO";
		}*/
		$bname="HO";
		$result1=$conn->query("select * from userlog where UserID=".$rec['memid']);
		if($result1->num_rows>0){
			if($row=$result1->fetch_assoc()){
				$lastip=$row['IPAdd'];
			}

			if($rip==$lastip){
				$myObj->UT="";
				$myObj->Status=0;
				$myObj->msg="Already Logged In";				
				$myObj->origin=1;
				$myObj->BID=$branchid;
				$myObj->BName=$bname;
				if($rec['UserType']=='k')
				$myObj->ptx="karigar_h.html";
				if($rec['UserType']=='s' && $branchid==0)
				$myObj->ptx=$rtpath;
				else
				$myObj->ptx="index.php";
				if($rec['UserType']=='a')
				$myObj->ptx=$rtpath;
				if($rec['UserType']=='r')
				$myObj->ptx="retail_h.html";
			}else{
				$conn->query("delete from userlog where UserID=".$rec['memid']);
				$conn->query("insert into userlog (UserID,LoginID,IPAdd) values(".$rec['memid'].",'".$rec['membercode']."','".$rip."')");
				$conn->query("insert into userlogbk (UserID,LoginID,IPAdd) values(".$rec['memid'].",'".$rec['membercode']."','".$rip."')");
				$_SESSION["uid"] = $uid;
				$_SESSION["Password"] = $pwd;
				$myObj->UT=$rec['UserType'];
				$myObj->msg="true";
				$myObj->Status=1;
				$myObj->BID=$branchid;
				$myObj->BName=$bname;
				if($rec['UserType']=='k')
				$myObj->ptx="karigar_h.html";
				if($rec['UserType']=='s' && $branchid==0)
				$myObj->ptx=$rtpath;
				else
				$myObj->ptx="index.php";
				if($rec['UserType']=='a')
				$myObj->ptx=$rtpath;
				if($rec['UserType']=='r')
				$myObj->ptx="retail_h.html";
				$myObj->origin=0;
			}
		}else{
			$conn->query("insert into userlog (UserID,LoginID,IPAdd) values(".$rec['memid'].",'".$rec['membercode']."','".$rip."')");
			$conn->query("insert into userlogbk (UserID,LoginID,IPAdd) values(".$rec['memid'].",'".$rec['membercode']."','".$rip."')");
			$_SESSION["uid"] = $uid;
			$_SESSION["Password"] = $pwd;
			$myObj->UT=$rec['UserType'];
			$myObj->msg="true";
			$myObj->Status=1;
			$myObj->BID=$branchid;
			$myObj->BName=$bname;
			if($rec['UserType']=='k')
			$myObj->ptx="karigar_h.html";
			if($rec['UserType']=='s' && $branchid==0)
			$myObj->ptx=$rtpath;
			else
			$myObj->ptx="index.php";
			if($rec['UserType']=='a')
			$myObj->ptx=$rtpath;
			if($rec['UserType']=='r')
			$myObj->ptx="retail_h.html";
			$myObj->origin=0;

		}

	}
}else{
	$myObj->UT="";
	$myObj->msg="User ID or Password was Incorrect".$sql;
	$conn->query("insert into userlogbk (LoginID,IPAdd) values('".$uid."','".$rip."')");
}
//$myJson=json_encode($myObj,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
header("Content-Type: application/json");
echo json_encode($myObj,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
//echo $myJson
?>
