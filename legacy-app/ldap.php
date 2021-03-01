<?php
$username = $_POST['username'];
$password = $_POST['password'];


$ldapconfig['host'] = '192.168.1.21';//CHANGE THIS TO THE CORRECT LDAP SERVER
$ldapconfig['port'] = '389';
$ldapconfig['basedn'] = 'dc=xtrlabs,dc=eu';//CHANGE THIS TO THE CORRECT BASE DN
$ldapconfig['usersdn'] = 'cn=x_users';//CHANGE THIS TO THE CORRECT USER OU/CN
$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);

ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);

$dn="uid=".$username.",".$ldapconfig['usersdn'].",".$ldapconfig['basedn'];
if(isset($_POST['username'])){
    if ($bind=ldap_bind($ds, $dn, $password)) {
        echo("Login correct");//REPLACE THIS WITH THE CORRECT FUNCTION LIKE A REDIRECT;

        echo '<h4>REQUEST VARS</h4><pre>'.print_r($_REQUEST,true).'</pre>'."\n\n";
        echo '<h4>SERVER VARS</h4><pre>'.print_r($_SERVER,true).'</pre>'."\n\n";

    } else {

        echo '<h4 style="color: red;">Login Failed: Please check your username or password</h4>';
    }
}
?>