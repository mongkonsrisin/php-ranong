<?php
// ������ Sessions 
/*
-- Database: sessiondb
DROP TABLE tbl_sessions;
CREATE TABLE IF NOT EXISTS tbl_sessions (
  session_id varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  session_expires int(10) unsigned NOT NULL DEFAULT '0',
  session_data text,
  username varchar(100) DEFAULT NULL,
  client_ip varchar(15) DEFAULT NULL,
  create_datetime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE tbl_sessions  ADD PRIMARY KEY (session_id);
*/
?>
<?php
class session { 
    var $lifeTime; 
    var $dbHandle; 
    function open($savePath, $sessName) { 
	   $this->lifeTime=900;  // in second  ��䢺�÷Ѵ��� 50 ��� 94 ����
//	   $dbHandle = @mysql_connect("192.168.1.31","ranong","ranong#2018db"); 
	   $dbHandle = @mysql_connect("localhost","root",""); 
       $dbSel = @mysql_select_db("ranongweb_db",$dbHandle); 
       if(!$dbHandle || !$dbSel) 
           return false; 
       $this->dbHandle = $dbHandle; 
       return true; 
    } 
    function close() { 
        $this->gc(ini_get('session.gc_maxlifetime')); 
        return @mysql_close($this->dbHandle); 
    } 
    function read($sessID) { 
        $res = mysql_query("SELECT session_data AS d FROM tbl_sessions WHERE session_id = '$sessID' AND session_expires > ".time(),$this->dbHandle); 
        if($row = mysql_fetch_assoc($res)) 
            return $row['d']; 
        return ""; 
    } 
    function write($sessID,$sessData) { 
		if(isset($_SESSION["user"]))
			$userid=$_SESSION["user"];
		else
			$userid='';
		if(isset($_SERVER["REMOTE_ADDR"]))
			$client_ip=$_SERVER["REMOTE_ADDR"];
		else
			$client_ip='';
		$this->lifeTime=900;  // in second
        $newExp = time() + $this->lifeTime; 
		$newCreateDateTime=date('Y-m-d').' '.date('H:i:s');
        // is a session with this id in the database? 
        $res = mysql_query("SELECT * FROM tbl_sessions WHERE session_id = '$sessID'",$this->dbHandle); 
        // if yes, 
        if(mysql_num_rows($res)) { 
            // ...update session-data 
            mysql_query("UPDATE tbl_sessions SET session_expires = '$newExp', session_data = '$sessData' , username='$userid', create_datetime='$newCreateDateTime' WHERE session_id = '$sessID'",$this->dbHandle); 
            // if something happened, return true 
            if(mysql_affected_rows($this->dbHandle)) 
                return true; 
        } 
        // if no session-data was found, 
        else { 
            // create a new row 
            mysql_query("INSERT INTO tbl_sessions ( session_id, session_expires, session_data, username, client_ip) VALUES( '$sessID', '$newExp', '$sessData','$userid','$client_ip')",$this->dbHandle); 
            // if row was created, return true 
            if(mysql_affected_rows($this->dbHandle)) 
                return true; 
        } 
        // an unknown error occured 
        return false; 
    } 
    function destroy($sessID) { 
        // delete session-data 
        mysql_query("DELETE FROM tbl_sessions WHERE session_id = '$sessID'",$this->dbHandle); 
        // if session was deleted, return true, 
        if(mysql_affected_rows($this->dbHandle)) 
            return true; 
        // ...else return false 
        return false; 
    } 
    function gc($sessMaxLifeTime) { 
        // delete old sessions 
        mysql_query("DELETE FROM tbl_sessions WHERE session_expires < ".time(),$this->dbHandle); 
        // return affected rows 
        return mysql_affected_rows($this->dbHandle); 
    } 
} 
$session = new session(); 
session_set_save_handler(array(&$session,"open"), array(&$session,"close"), array(&$session,"read"), array(&$session,"write"), array(&$session,"destroy"), array(&$session,"gc")); 
@session_start();
?>