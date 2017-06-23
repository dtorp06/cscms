<?php
/**
 * @Cscms 3.5 open source management system
 * @copyright 2009-2013 chshcms.com. All rights reserved.
 * @Author:Cheng Jie
 * @Dtime:2013-04-27
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

 class Csbackup extends CI_Model
 {
    function __construct (){
	       parent:: __construct ();
    }

    //导出数据表结构
    function repair($table){
            $output="";
		    $query = $this->db->query("SHOW CREATE TABLE `".$this->db->database.'`.`'.$table.'`');
		    $i = 0;
		    $result = $query->result_array();
		    foreach ($result[0] as $val){
			    if ($i++ % 2){
				      $output .= $val.';';
			    }
			}
			return $output;
	}

    //备份数据内容
    function backup($tables){
        $this->load->dbutil();
        $bkfile = FCPATH.'attachment'.FGF.'backup'.FGF.'Cscms_v4_'.date('Ymd');
        if(is_dir($bkfile)){
        	$bkfile.= '_'.time();
        }
        $bkfile.= FGF.md5(time().mt_rand(1000,5000)).'.sql';
		$prefs = array(
		    'tables'    => $tables,
		    'format'    => 'txt',
		    'newline'   => "[cscms_backup]\n"
		);
		$backup = $this->dbutil->backup($prefs);
        //写文件
        if (!write_file($bkfile, $backup)){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    //还原数据
    function restore($name)
    {
		$this->load->helper('file');
        $path="./attachment/backup/".$name."/";
        $strs = get_dir_file_info($path, $top_level_only = TRUE);
        foreach ($strs as $value) {
            if(!is_dir($path.$value['name'])){
			    $fullpath = $path.$value['name'];
			    $tabel_stru = file_get_contents($fullpath);
			    $tabelarr = explode("[cscms_backup]\n",$tabel_stru);
				for($i=0;$i<count($tabelarr)-1;$i++){	
				    if(!empty($tabelarr[$i]) && $tabelarr[$i]!='#'){
				    	$this->db->query($tabelarr[$i]);
				    }
				}
			}
		}
        return TRUE;
    }
}

