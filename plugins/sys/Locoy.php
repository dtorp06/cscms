<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Locoy extends CI_Controller {

	function __construct(){
		parent::__construct();

        //免登入接口密码,默认为1234，请自行修改
        $this->pass='1234';
	}

    //分类列表
	public function lists(){

	    $sid=intval($this->input->get_post('sid',TRUE)); //版块类型,1为歌曲，2为文章，3为视频，4为歌手
        if($sid==0) $sid=1;

        echo "<select name='list'>";
        if($sid==1){
            $sqlstr="select id,name from ".CS_SqlPrefix."dance_list order by xid asc";
        }elseif($sid==2){
            $sqlstr="select id,name from ".CS_SqlPrefix."news_list order by xid asc";
        }elseif($sid==3){
            $sqlstr="select id,name from ".CS_SqlPrefix."vod_list order by xid asc";
        }else{
            $sqlstr="select id,name from ".CS_SqlPrefix."singer_list order by xid asc";
        }
		$result=$this->Csdb->db->query($sqlstr);
		$recount=$result->num_rows();
        if($recount>0){
			foreach ($result->result() as $row) {
                echo "<option value='".$row->id."'>".$row->name."</option>\n";
            }
        }
        echo '</select>';
	}

    //入库
	public function ruku(){
        //判断密码
		$pass=$this->input->get_post('pass',TRUE);
        if($this->pass=='1234' || $pass!=$this->pass){
            exit('密码错误');
        }

        //--------------------以下代码非专业人员不要修改----------------------

		$sid=intval($this->input->get_post('sid',TRUE)); //版块类型,1为歌曲，2为文章，3为视频，4为歌手
        if($sid==0) $sid=1;

        //-------------------歌曲------------------------//
        if($sid==1){

            //必填字段
            $music['name']=$this->input->get_post('name', TRUE, TRUE);
            $music['cid']=intval($this->input->get_post('cid'));
            $music['purl']=$this->input->get_post('purl', TRUE, TRUE);
            //选填字段
            $music['tid']=intval($this->input->get_post('tid'));
            $music['cion']=intval($this->input->get_post('cion'));
            $music['text']=remove_xss($this->input->get_post('text'));
            $music['lrc']=$this->input->get_post('lrc', TRUE, TRUE);
            $music['pic']=$this->input->get_post('pic', TRUE, TRUE);
            $music['tags']=$this->input->get_post('tags', TRUE, TRUE);
            $music['zc']=$this->input->get_post('zc', TRUE, TRUE);
            $music['zq']=$this->input->get_post('zq', TRUE, TRUE);
            $music['bq']=$this->input->get_post('bq', TRUE, TRUE);
            $music['hy']=$this->input->get_post('hy', TRUE, TRUE);
            $music['durl']=$this->input->get_post('hy', TRUE, TRUE);
            $music['uid']=intval($this->input->get_post('uid', TRUE));
            $music['dx']=$this->input->get_post('dx', TRUE, TRUE);
            $music['yz']=$this->input->get_post('yz', TRUE, TRUE);
            $music['sc']=$this->input->get_post('sc', TRUE, TRUE);
	        $music['title']=$this->input->get_post('title',true,true);
	        $music['keywords']=$this->input->get_post('keywords',true,true);
	        $music['description']=$this->input->get_post('description',true,true);
            $music['addtime']=time();

            $singer=$this->input->get_post('singer', TRUE, TRUE);
            //判断歌手是否存在
            if(!empty($singer)){
                $row=$this->Csdb->get_row('singer','id',$singer,'name');
            	if($row){
                    $music['singerid']=$row->id;
            	}
            }

            if($music['cid']==0 || empty($music['name']) || empty($music['purl'])){
            	echo "数据不完整";						
			}else{
				$row=$this->db->query("select id from ".CS_SqlPrefix."dance where name='".$music['name']."'")->row();
				if($row){
					echo "数据已存在,跳过";
				}else{
					$did=$this->Csdb->get_insert('dance',$music);
					if($did>0){
						echo "增加信息成功";
					}else{
						echo "增加信息失败";
					}
				}
			}

        //-------------------文章------------------------//

		}elseif($sid==2){

			$news['cion']=intval($this->input->get_post('cion'));
			$news['pic']=$this->input->get_post('pic', TRUE, TRUE);
			$news['tags']=$this->input->get_post('tags', TRUE, TRUE);
			$news['info']=$this->input->get_post('info', TRUE, TRUE);
			$news['uid']=intval($this->input->get_post('uid'));
	        $news['title']=$this->input->get_post('title',true,true);
	        $news['keywords']=$this->input->get_post('keywords',true,true);
	        $news['description']=$this->input->get_post('description',true,true);
			$news['addtime']=time();
    		//必填字段
			$news['name']=$this->input->get_post('name', TRUE, TRUE);
			$news['cid']=intval($this->input->get_post('cid'));
			$news['content']=remove_xss($this->input->get_post('content'));
   		    //截取概述
			$news['info'] = sub_str(str_checkhtml($news['content']),120);

    		//检测必须字段
			if($news['cid']==0 || empty($news['name']) || empty($news['content'])){
            		  echo "数据不完整";						
			}else{
				$row=$this->db->query("select id from ".CS_SqlPrefix."news where name='".$news['name']."'")->row();
				if($row){
					echo "数据已存在,跳过";
				}else{
					$did=$this->Csdb->get_insert('news',$news);
					if($did>0){
				    	echo "增加信息成功";
					}else{
				    	echo "增加信息失败";
					}
				}
			}

        //-------------------视频------------------------//
		}elseif($sid==3){

			$vod['cion']=intval($this->input->get_post('cion'));
			$vod['dcion']=intval($this->input->get_post('dcion'));
			$vod['text']=remove_xss($this->input->get_post('text'));
			$vod['pic']=$this->input->get_post('pic', TRUE, TRUE);
			$vod['tags']=$this->input->get_post('tags', TRUE, TRUE);
			$vod['daoyan']=$this->input->get_post('daoyan', TRUE, TRUE);
			$vod['zhuyan']=$this->input->get_post('zhuyan', TRUE, TRUE);
			$vod['yuyan']=$this->input->get_post('yuyan', TRUE, TRUE);
			$vod['diqu']=$this->input->get_post('diqu', TRUE, TRUE);
			$vod['year']=$this->input->get_post('year', TRUE, TRUE);
			$vod['info']=$this->input->get_post('info', TRUE, TRUE);
			$vod['uid']=intval($this->input->get_post('uid'));
	        $vod['title']=$this->input->get_post('title',true,true);
	        $vod['keywords']=$this->input->get_post('keywords',true,true);
	        $vod['description']=$this->input->get_post('description',true,true);
			$vod['addtime']=time();
            //必填字段
			$vod['name']=$this->input->get_post('name', TRUE, TRUE);//视频名称
			$vod['cid']=intval($this->input->get_post('cid'));//视频分类ID
	        $play=$this->input->get_post('play', TRUE);//播放来源
	        $purl=$this->input->get_post('purl', TRUE);//播放地址
	        $down=$this->input->get_post('down', TRUE, TRUE);//下载来源
	        $durl=$this->input->get_post('durl', TRUE, TRUE);//下载地址
	        //播放地址组合
			if(!empty($purl) && !empty($play)){
				$purl = explode("\n",str_replace("\r","",$purl));
				$playurl='';
				for($j=0;$j<count($purl);$j++){
                    $playurl.=(strpos($purl[$j],'$') === FALSE) ? '第'.($j+1).'集$'.$purl[$j].'$'.$play : $purl[$j];
                    $playurl.="\n";
				}
				$playurl.="\n=cscms=";
	            $vod['purl']=str_replace("\n=cscms=","",$playurl);
			}
			if(!empty($durl) && !empty($down)){
				$durl = explode("\n",str_replace("\r","",$durl));
				$downurl='';
				for($j=0;$j<count($durl);$j++){
                    $downurl.=(strpos($durl[$j],'$') === FALSE) ? '第'.($j+1).'集$'.$durl[$j].'$'.$down : $durl[$j];
                    $downurl.="\n";
				}
				$downurl.="\n=cscms=";
	            $vod['durl']=str_replace("\n=cscms=","",$downurl);
			}
	        $singer=$this->input->get_post('singer', TRUE, TRUE);
	        //判断歌手是否存在
	        if(!empty($singer)){
				$row=$this->Csdb->get_row('singer','id',$singer,'name');
				if($row){
					$vod['singerid']=$row->id;
				}
	        }
            //检测必须字段
	        if($vod['cid']==0 || empty($vod['name'])){
            	echo "数据不完整";						
			}else{
				$row=$this->db->query("select id,purl,durl from ".CS_SqlPrefix."vod where name='".$vod['name']."'")->row();
				if($row){
					$s=0;
					if(!empty($vod['purl'])){
						if(strpos($row->purl,'$'.$play) === FALSE){
						    $vod2['purl'] = $row->purl.'#cscms#'.$vod['purl'];
						    echo "数据存在，新增一组播放";
						    $s++;
						}else{
							$parr = explode('#cscms#', $row->purl);
							foreach ($parr as $k => $v) {
								$jiarr = explode("\n", $v);
								$laiy = end(explode('$', $jiarr[0]));
								if($laiy == $play){
									$parr[$k] = $vod['purl'];
								}
							}
						    $vod2['purl'] = implode("#cscms#",$parr);
						    echo "数据存在，数据已更新";
						    $s++;
						}
					}
					if(!empty($down)){
						if(strpos($row->durl,'$'.$down) === FALSE){
						    $vod2['durl']=$row->durl.'#cscms#'.$vod['durl'];
							echo "数据存在，新增一组下载";
							$s++;
						}else{
							$darr = explode('#cscms#', $row->durl);
							foreach ($darr as $k => $v) {
								$jiarr = explode("\n", $v);
								$laiy = end(explode('$', $jiarr[0]));
								if($laiy == $down){
									$darr[$k] = $vod['durl'];
								}
							}
						    $vod2['durl'] = implode("#cscms#",$darr);
						    echo "数据存在，数据已更新";
						    $s++;
						}
					}
					if($s>0){
						$this->Csdb->get_update('vod',$row->id,$vod2);
					}else{
						echo "数据已存在,跳过";
					}
				}else{
				    $did=$this->Csdb->get_insert('vod',$vod);
				    if($did>0){
				    	echo "增加信息成功";
				    }else{
				    	echo "增加信息失败";
				    }
				}
	        }

        //-------------------歌手------------------------//
		}elseif($sid==4){

	        $singer['name']=$this->input->get_post('name',true,true);
	        $singer['tags']=$this->input->get_post('tags',true,true);
	        $singer['pic']=$this->input->get_post('pic',true,true);
	        $singer['color']=$this->input->get_post('color',true,true);
	        $singer['bname']=$this->input->get_post('bname',true,true);
	        $singer['cid']=intval($this->input->get_post('cid'));
	        $singer['nichen']=$this->input->get_post('nichen',true,true);
	        $singer['sex']=$this->input->get_post('sex',true,true);
	        $singer['nat']=$this->input->get_post('nat',true,true);
	        $singer['yuyan']=$this->input->get_post('yuyan',true,true);
	        $singer['city']=$this->input->get_post('city',true,true);
	        $singer['sr']=$this->input->get_post('sr',true,true);
	        $singer['xingzuo']=$this->input->get_post('xingzuo',true,true);
	        $singer['height']=$this->input->get_post('height',true,true);
	        $singer['weight']=$this->input->get_post('weight',true,true);
	        $singer['content']=remove_xss($this->input->get_post('content'));
	        $singer['title']=$this->input->get_post('title',true,true);
	        $singer['keywords']=$this->input->get_post('keywords',true,true);
	        $singer['description']=$this->input->get_post('description',true,true);
			$singer['addtime']=time();

            //开始处理数据
            if(empty($singer['name']) || $singer['cid']==0){
            	echo "数据不完整";
            }else{
				//判断数据是否相同
				$row=$this->db->query("select id from ".CS_SqlPrefix."singer where name='".$singer['name']."'")->row();
				if($row){
					$this->Csdb->get_update('singer',$row->id,$singer);
					echo "数据存在，资料修改成功";
				}else{
					$did=$this->Csdb->get_insert('singer',$singer);
					if($did>0){
						echo "增加信息成功";
					}else{
						echo "增加信息失败";
					}
				}
			}
		}
	}
}

