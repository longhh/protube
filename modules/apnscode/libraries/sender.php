<?php

$start = microtime(true);

include 'dbconnect.php';
include 'applepushns.php';

$pid = pcntl_fork();

switch ($pid) {
    case -1:
        break;
    case 0:
        echo 'STARTING RUNNING SCRIPT ....' . PHP_EOL;
        echo 'Begin creating messages' . PHP_EOL;
        $param = json_decode($argv[1], true);
        $pDB = DbConnect::getInstance();

        $filePemDis = '../' . $param['pemdis'] . '.pem';
        $filePemDev = '../' . $param['pemdev'] . '.pem';

        $apns = new ApplePushNS($pDB, NULL, $filePemDis, $filePemDev);

        $selected2 = $param['select'];

        // add message to queue
        foreach ($selected2 as $appname) {
            $sql = 'SELECT pid, clientid FROM apns_devices WHERE appname = "' . $appname . '" ORDER BY pid desc';

            $result = $pDB->query($sql);

            if ($result->num_rows) {
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $apns->newMessage($pDB->prepare($row['pid']));
                    $apns->addMessageAlert($param['alert'], $param['btntext']);

                    if ($param['sound']) {
                        $apns->addMessageSound($param['sound']);
                    } else {
                        $apns->addMessageSound('default');
                    }

                    $apns->addMessageBadge($param['badge']);
                    $apns->addMessageCustom('url', $param['url']);
                    $apns->addMessageCustom('title', $param['title']);
                    $apns->addMessageCustom('description', $param['description']);
                    $apns->queueMessage();
                }
            }
        }
        echo 'End creating messages' . PHP_EOL;
        echo 'Begin push messages' . PHP_EOL;
        // SEND ALL MESSAGES NOW
        $list_process_id = $apns->processQueue();

        while (true) {
            $i = 0;
            foreach ($list_process_id as $pid) {
                if (file_exists("/proc/{$pid}")) {
                    $i++;
                }
            }
            if ($i == 0) {
                break;
            }
        }

        echo 'End push messages' . PHP_EOL;
        $time = microtime(true) - $start;
        echo 'Execution time: ' . $time . PHP_EOL;
        break;
    default:
        break;
}
?>
