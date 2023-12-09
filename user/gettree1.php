<?php
//header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
//header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
//header('Accept: application/json;charset=UTF-8');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Accept: application/json;charset=UTF-8');

include 'dbconfig.php';
$conn = new mysqli($hostname, $username, $pwd, $databasename) or die("Could not connect to mysql" . mysqli_error($con));
//session_start();
$_POST = json_decode(file_get_contents('php://input'), true);
$returnarray=array();
$nodes = [];
$links = [];

// Function to retrieve data in the format suitable for GoJS
function getGoJSData($conn, $startMemid, &$nodes, &$links) {
    $sql = "SELECT memid, mname, sponsorid FROM members WHERE sponsorid = $startMemid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $node = [
                'id' => $row['memid'],
                'name' => $row['mname'],
            ];
            
            // Check if the node has a parent
            if ($startMemid !== 0) {
                $node['pid'] = $startMemid;
            }
            
            // Add the node to the nodes array
            $nodes[] = $node;

            // Add a link between the parent and child node
            if ($startMemid !== 0) {
                $link = [
                    'from' => $startMemid,
                    'to' => $row['memid'],
                ];
                $links[] = $link;
            }

            // Recursively retrieve children
            getGoJSData($conn, $row['memid'], $nodes, $links);
        }
    }
}

// Retrieve data in GoJS format

function fetchMembers($conn, $parentID = 0,$inputput) {
    $sql = "SELECT memid as `key`, mname as name,sponsorid as parent FROM members WHERE sponsorid = $parentID";
    $result = $conn->query($sql);
    $members = array();

    while ($row = $result->fetch_assoc()) {
        $rec=array('key'=>$row['key'], 'name'=>$row['name'],'parent'=>$row['parent']);
        array_push($inputput, $rec);
        $row1=fetchMembers($conn, $row['key'],$inputput);
        array_push($inputput, $row1);
    }
    return $inputput;
}
$tempmemcode=$_POST['id'];
$result=$conn->query("select * from members where membercode='".$tempmemcode."'");
if($result->num_rows > 0) {
    if($rec=$result->fetch_assoc()){
        $tempid=$rec['memid'];
        $tempname=$rec['mname'];
    }
}
//$tree = fetchMembers($conn,$tempid,$returnarray);
$node = [
    'id' => $tempid,
    'name' => $tempname,    
];
$nodes[]=$node;
getGoJSData($conn, $tempid, $nodes, $links);

$conn->close();

header("Content-Type: application/json");
//echo json_encode($tree);
echo json_encode(['nodes' => $nodes, 'links' => $links]);
?>
