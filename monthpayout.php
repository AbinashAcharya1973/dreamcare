<?php
//header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
//header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
//header('Accept: application/json;charset=UTF-8');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');

include 'dbconfig.php';
include 'payoutcalculate.php';
$conn = new mysqli($hostname, $username, $pwd, $databasename) or die("Could not connect to mysql" . mysqli_error($con));
//session_start();
$_POST = json_decode(file_get_contents('php://input'), true);

/*$myObj = new stdClass();
$myObj->memcount = 0;
$myObj->direct = 0;
$myObj->temmem = 0;
$myObj->totalinvest = 0;
$myObj->totalypayout = 0;
$myObj->totalrepurchase = 0;*/
$month = $_POST['m'];
$year = $_POST['y'];
$firstdate = date("Y-m-d",  mktime(0, 0, 0, $month, 1, $year));
//$myObj->firstdate = $firstdate;
$tempdate = new DateTime($firstdate);
$month = $tempdate->format('m');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$result = $conn->query("select * from payouthead where formonth=" . $month." and foryear=" . $year);
if ($result->num_rows > 0) {
    if ($exrec = $result->fetch_assoc()) {
        $payoutid = $exrec['payoutid'];
        $conn->query("delete from payoutdetails where payoutid=" . $payoutid);
        $conn->query("delete from payouthead where payoutid=".$payoutid);
        $conn->query("delete from levelincome where pid=".$payoutid);
        $conn->query("delete from rewarddetails where pid=".$payoutid);
        $conn->query("delete from rewardledger where pid=".$payoutid);        
        $conn->query("delete from levelincomeledger where pid=".$payoutid);
        $conn->query("delete from ledger where vno=".$payoutid);
    }
}

$rquery = array();
$payout = true;
$conn->query("insert into payouthead (payoutdate,formonth,foryear) values(CURDATE(),'" . $month . "',".$year.")");
$lastid = $conn->insert_id;
/*LEVEL INCOM CALCULATION

*/

$result_m = $conn->query("select * from members where MONTH(joingindate)<=" . $month . " and YEAR(joingindate)<=" . $year . " order by memid");
if ($result_m->num_rows > 0) {
    while ($row = $result_m->fetch_assoc()) {
        $memid = $row['memid'];
        $tlevelincome = findLevelIncome($memid, $conn, 0, $lastid, $memid, $year, $month);
        $result1 = $conn->query("select sum(amount) as tamount from levelincome where memid=" . $memid . " and pid=" . $lastid);
        if ($result1->num_rows > 0) {
            if ($rec = $result1->fetch_assoc()) {
                $tlevelincome = $rec['tamount'];
            } else {
                $tlevelincome = 0;
            }
        } else {
            $tlevelincome = 0;
        }
        //$conn->query("insert into payoutdetails (memid,levelincome,payoutid) values(" . $memid . "," . $tlevelincome . "," . $lastid . ")");
        $conn->query("insert into payoutdetails (memid,payoutid) values(" . $memid . "," . $lastid . ")");
        $conn->query("update payoutdetails set levelincome=" . $tlevelincome . " where payoutid=" . $lastid . " and memid=" . $memid);
        $reslt_y=$conn->query("select level,count(submemid) as noc from levelincome where pid=" . $lastid . " and memid=" . $memid." group by level");
        if($reslt_y->num_rows>0){
            while($rec_l=$reslt_y->fetch_assoc()){
                if($rec_l['level']==1){
                    $conn->query("insert into levelincomeledger (tdate,memid,level,level_p,pid,amount,noids) values(CURRENT_DATE,".$memid.",".$rec_l['level'].",1,".$lastid.",10*".$rec_l['noc'].",".$rec_l['noc'].")");
                }
                if($rec_l['level']==2){
                    $conn->query("insert into levelincomeledger (tdate,memid,level,level_p,pid,amount,noids) values(CURRENT_DATE,".$memid.",".$rec_l['level'].",1,".$lastid.",5*".$rec_l['noc'].",".$rec_l['noc'].")");
                }
                if($rec_l['level']==3){
                    $conn->query("insert into levelincomeledger (tdate,memid,level,level_p,pid,amount,noids) values(CURRENT_DATE,".$memid.",".$rec_l['level'].",1,".$lastid.",3*".$rec_l['noc'].",".$rec_l['noc'].")");
                }
                if($rec_l['level']==4){
                    $conn->query("insert into levelincomeledger (tdate,memid,level,level_p,pid,amount,noids) values(CURRENT_DATE,".$memid.",".$rec_l['level'].",1,".$lastid.",2*".$rec_l['noc'].",".$rec_l['noc'].")");
                }
                if($rec_l['level']==4){
                    $conn->query("insert into levelincomeledger (tdate,memid,level,level_p,pid,amount,noids) values(CURRENT_DATE,".$memid.",".$rec_l['level'].",1,".$lastid.",1*".$rec_l['noc'].",".$rec_l['noc'].")");
                }
                if($rec_l['level']==5){
                    $conn->query("insert into levelincomeledger (tdate,memid,level,level_p,pid,amount,noids) values(CURRENT_DATE,".$memid.",".$rec_l['level'].",1,".$lastid.",1*".$rec_l['noc'].",".$rec_l['noc'].")");
                }
                if($rec_l['level']==6){
                    $conn->query("insert into levelincomeledger (tdate,memid,level,level_p,pid,amount,noids) values(CURRENT_DATE,".$memid.",".$rec_l['level'].",1,".$lastid.",.5*".$rec_l['noc'].",".$rec_l['noc'].")");
                }
                if($rec_l['level']==7){
                    $conn->query("insert into levelincomeledger (tdate,memid,level,level_p,pid,amount,noids) values(CURRENT_DATE,".$memid.",".$rec_l['level'].",1,".$lastid.",.25*".$rec_l['noc'].",".$rec_l['noc'].")");
                }
            }
        }
        $result_y=$conn->query("select * from levelincomeledger where memid=".$memid." and level_p between (2 and 23)");
        if($reslt_y->num_rows>0){
            while($row = $reslt_y->fetch_assoc()){
                $conn->query("update payoutdetails set levelincome=levelincome+" . $row['amount'] . " where payoutid=" . $lastid . " and memid=" . $memid);        
                $conn->query("update levelincomeledger set level_p=level_p+1 where memid=" . $memid . " and pid=" . $rec['pid']." and level=".$rec['level']);
            }
        }
        //END OF LEVEL INCOM CALCULATION
        $tmbonus = 0;
        $resultx = $conn->query("select * from payoutdetails where memid=" . $memid . " and MBonus>0");
        if ($resultx->num_rows < 48) {
            $tmbonus = 50;
        } else {
            $tmbonus = 0;
        }
        $conn->query("update payoutdetails set MBonus=" . $tmbonus . " where payoutid=" . $lastid . " and memid=" . $memid);
        $trefer = 0;
        $resultx = $conn->query("select * from members where sponsorid=" . $memid . " and MONTH(joingindate)<=" . $month . " and YEAR(joingindate)<=" . $year );
        if ($resultx->num_rows >0) {
            while($row=$resultx->fetch_assoc()){
            $trefer = $trefer+100;
            }
        } else {
            $trefer = 0;
        }
        $conn->query("update payoutdetails set referalin=" . $trefer . " where payoutid=" . $lastid . " and memid=" . $memid);
        //$treward=findReward50Sale($memid,$conn,$lastid,$memid,$month);
        /*REWARD CALCULATION*/
        $rewardcount = 0;
        $result5 = $conn->query("select * from members where MONTH(joingindate)=" . $month . " and sponsorid=" . $memid);
        if ($result5->num_rows > 0) {
            while ($rec1 = $result5->fetch_assoc()) {
                $rewardcount++;
                $conn->query("insert into rewarddetails values(" . $lastid . "," . $memid . "," . $rec1['memid'] . ",'" . $rec1['joingindate'] . "')");
            }
        }
        if ($rewardcount > 500) {                        
            $conn->query("insert into rewardledger (rewarddate,reward,memid,payoutid) values(CURRENT_DATE,'Diamond',".$memid.",".$lastid.")");
        }else if ($rewardcount >250){            
            $conn->query("insert into rewardledger (rewarddate,reward,memid,payoutid) values(CURRENT_DATE,'Platinum',".$memid.",".$lastid.")");
        }else if($rewardcount>100){            
            $conn->query("insert into rewardledger (rewarddate,reward,memid,payoutid) values(CURRENT_DATE,'Gold',".$memid.",".$lastid.")");
        } else if($rewardcount>50){        
            $conn->query("insert into rewardledger (rewarddate,reward,memid,payoutid) values(CURRENT_DATE,'Silver',".$memid.",".$lastid.")");
        }
        $result_r=$conn->query("select * from rewardledger where memid=".$memid);
        if($result_r->num_rows>0){
            while($row = $result_r->fetch_assoc()) {
                if($row['reward']=='Silver' && $row['reward_p']<24){
                    $conn->query("update payoutdetails set reward=reward+150 where payoutid=" . $lastid . " and memid=" . $memid);
                    $conn->query("update rewardledger set reward_p=reward_p+1 where id=" . $row['id'] . " and memid=" .$memid);
                    $conn->query("update members set sliver_p=sliver_p+150 where memid=" .$memid);
                }
                if($row['reward']=='Gold' && $row['reward_p']<24){
                    $conn->query("update payoutdetails set reward=reward+250 where payoutid=" . $lastid . " and memid=" . $memid);
                    $conn->query("update rewardledger set reward_p=reward_p+1 where id=" . $row['id'] . " and memid=" .$memid);
                    $conn->query("update members set gold_p=gold_p+250 where memid=" .$memid);
                }
                if($row['reward']=='Platinum' && $row['reward_p']<24){
                    $conn->query("update payoutdetails set reward=reward+350 where payoutid=" . $lastid . " and memid=" . $memid);
                    $conn->query("update rewardledger set reward_p=reward_p+1 where id=" . $row['id'] . " and memid=" .$memid);
                    $conn->query("update members set platinum_p=platinum_p+350 where memid=" .$memid);
                }
                if($row['reward']=='Diamond' && $row['reward_p']<24){
                    $conn->query("update payoutdetails set reward=reward+450 where payoutid=" . $lastid . " and memid=" . $memid);
                    $conn->query("update rewardledger set reward_p=reward_p+1 where id=" . $row['id'] . " and memid=" .$memid);
                    $conn->query("update members set diamond_p=diamond_p+450 where memid=" .$memid);
                }
            }
            /*END OF REWARD CALCULATION*/
        }
    }   
}
$conn->query("update payoutdetails set totalincome=referalin+mbonus+levelincome+reward where payoutid=" . $lastid);
//member ledger entry VNo
$rs12=$conn->query("select * from payoutdetails where payoutid=".$lastid);
if($rs12->num_rows>0){
    while($row=$rs12->fetch_assoc()){
        $conn->query("insert into ledger (tdate,particulars,income,remarks,memid,vno) values(CURDATE(),'Monthly Payout',".$row['totalincome'].",'".$month."-".$year."',".$row['memid'].",".$lastid.")");
        $sq="insert into ledger (tdate,particulars,income,remarks,memid,vno) values(CURDATE(),'Monthly Payout',".$row['totalincome'].",'".$month."-".$year."',".$row['memid'].",".$lastid.")";
    }
}
$result5 = $conn->query("select sum(referalin) as referaltotal,sum(totalincome) as tincome,sum(levelincome) as lincome,sum(reward) treward, sum(mbonus) as mbonus from payoutdetails where payoutid=" . $lastid);
$totalin = 0;

if ($result5->num_rows > 0) {
    if ($recx = $result5->fetch_assoc()) {
        $totalin = $recx['tincome'];
        $lin = $recx['lincome'];
        $rin = $recx['treward'];
        $bin = $recx['mbonus'];
        $referal=$recx['referaltotal'];
    }
}
$conn->query("update payouthead set totalreferal=".$referal.",totalbonus=" . $bin . ",totalrewards=" . $rin . ",totallevelincome=" . $lin . ",totalpayout=" . $totalin . " where payoutid=" . $lastid);
$tqeur = "update payouthead set totalbonus=" . $bin . ",totalrewards=" . $rin . ",totallevelincome=" . $lin . ",totalpayout=" . $totalin . " where payoutid=" . $lastid;
////////////////////////////////SP INCOME////////////////////////////////
//$conn->query("update payouthead set ")
//================================================================fetching data================================================================
$sql = "SELECT * FROM payoutdetails";
$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
    while ($rec = $result->fetch_assoc()) {
        $data[] = $rec;
    }
    //mysql_close($conn);
    //header("Access-Control-Allow-Origin: *");	
}
//array_push($data, $spleve);
header("Content-Type: application/json");
echo json_encode($sq, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
