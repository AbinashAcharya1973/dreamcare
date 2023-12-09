<?php
function findTotalDownlineMembers($memid, $conn)
{
    // Initialize the count to 0
    $totalMembers = 0;

    // Query to get members sponsored by the current member
    $query = "SELECT memid FROM members WHERE sponsorid = $memid";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $totalMembers++;
        while ($row = mysqli_fetch_assoc($result)) {
            $downlineMemid = $row['memid'];

            // Recursively find the total downline members for each downline member
            $subTotal = findTotalDownlineMembers($downlineMemid, $conn);

            // Increment the total count by the count of downline members
            $totalMembers += $subTotal;
        }
    }

    // Add 1 to account for the current member
    //return $totalMembers + 1;
    return $totalMembers;
}


function findHighestDownlineLevel($memid, $conn)
{
    // Initialize the highest level to 0
    $highestLevel = 0;

    // Query to get members sponsored by the current member
    $query = "SELECT memid FROM members WHERE sponsorid = $memid";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $downlineMemid = $row['memid'];

            // Recursively find the highest downline level for each downline member
            $subLevel = findHighestDownlineLevel($downlineMemid, $conn);

            // Update the highest level if the current downline level is greater
            if ($subLevel > $highestLevel) {
                $highestLevel = $subLevel;
            }
        }
        $highestLevel = $highestLevel + 1;
    }

    // Add 1 to account for the current member's level
    return $highestLevel;
    //return $highestLevel;
}


function findLevelIncome($memid, $conn, $inputlevel, $pid, $mainid,$year,$month)
{
    // Initialize the count to 0
    $totalMembers = 0;
    $level = 0;
    $myObj1 = new stdClass();
    $investment = array();
    $spincome = 0;
    // Query to get members sponsored by the current member
    if ($inputlevel <= 7) {
        $query = "SELECT memid FROM members WHERE sponsorid =". $memid ." and YEAR(joingindate)=".$year." and MONTH(joingindate)=".$month;
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $totalMembers++;
            $level = $inputlevel + 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $downlineMemid = $row['memid'];
                if ($level >= 1) {
                    if ($level == 1) {
                        $conn->query("insert into levelincome values(" . $mainid . "," . $downlineMemid . ",1,10," . $pid . ")");                        
                    }
                    if ($level == 2) {
                        $conn->query("insert into levelincome values(" . $mainid . "," . $downlineMemid . ",2,5," . $pid . ")");
                    }
                    if ($level == 3) {
                        $conn->query("insert into levelincome values(" . $mainid . "," . $downlineMemid . ",3,3," . $pid . ")");
                    }
                    if ($level == 4) {
                        $conn->query("insert into levelincome values(" . $mainid . "," . $downlineMemid . ",4,2," . $pid . ")");
                    }
                    if ($level == 5) {
                        $conn->query("insert into levelincome values(" . $mainid . "," . $downlineMemid . ",5,1," . $pid . ")");
                    }
                    if ($level == 6) {
                        $conn->query("insert into levelincome values(" . $mainid . "," . $downlineMemid . ",6,.5," . $pid . ")");
                    }
                    if ($level == 7) {
                        $conn->query("insert into levelincome values(" . $mainid . "," . $downlineMemid . ",7,.25," . $pid . ")");
                    }
                    /*if ($level >= 6 and $level<=12) {
                        $conn->query("insert into levelincome values(" . $mainid . "," . $downlineMemid . ",".$level.",.5," . $pid . ")");
                    }
                    if ($level >=13 and $level<=15) {
                        $conn->query("insert into levelincome values(" . $mainid . "," . $downlineMemid . ",".$level.",.25," . $pid . ")");
                    }*/
                }

                $spincome += findLevelIncome($downlineMemid, $conn, $level, $pid, $mainid,$year,$month);
            }
        }
        return $spincome;
    } else {
        return 0;
    }
}
function findReward50Sale($memid, $conn, $pid, $mainid,$pmonth)
{
    // Initialize the count to 0
    $totalMembers = 0;        
    $spincome = 0;
    // Query to get members sponsored by the current member
    $query = "SELECT memid FROM members WHERE sponsorid = $memid";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $totalMembers++;
        //$level = $inputlevel + 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $tempjdate=new DateTime($row['joiningdate']);
            $jmonth=$tempjdate->format('m');
            if($jmonth==$pmonth){
                $conn->query("insert into rewarddetails (".$pid.",".$mainid.",".$row['memid'].",'".$row['joiningdate']."')");
            }
            $downlineMemid = $row['memid'];  

            $spincome += findReward50Sale($downlineMemid, $conn, $pid, $mainid,$pmonth);
        }
    }
    return $spincome;
}
