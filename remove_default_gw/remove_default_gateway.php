<?php

include_once("types_macro.inc");

if (isset($ipm_argv['is_ipm_register']) && $ipm_argv['is_ipm_register'])
{
 ipm_register_rule("rule_cron_exec",'Efficient IP','rule-555',"f","cron_time","Cron Time",IPM_TYPE_CRON);

 $q = "rule_add add_flag=new_only&name=Enable_BGP_default_gw&php_name=dialog_remove_default_gateway2.php";
 $q .= "&filter=".urlencode("&cron_time=.*:.*:.*:.*:.*:.*:.*");
 ipm_call_service($q);

 return;
}

exec('netstat -rn -f inet | grep default | awk \'{print $3}\'', $status4);
exec('netstat -rn -f inet6 | grep default | awk \'{print $3}\'', $status6);

if ($status4 == 'UGS') {
	exec('route -q delete default');
	exec('logger "reseting IPv4 gw"');
	sleep (5);
	exec('service quagga restart');
	sleep (5);
	exec('service ipmdns.sh restart');
}

if ($status6 == 'UGS') {
	exec('route -q6 delete default');
	exec('logger "reseting IPv6 gw"');
	sleep (5);
	exec('service quagga restart');
	sleep (5);
	exec('service ipmdns.sh restart');
}

?>