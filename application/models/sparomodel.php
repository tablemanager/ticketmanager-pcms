<?php 
class Sparomodel extends CI_Model {

	var $title   = '';
	var $content = '';
	var $date    = '';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->sparo = $this->load->database('sparo', TRUE); //9스파로 DB
	}
	 
	function get_last_ten_entries()
	{
		$this->cms = $this->load->database('cms', TRUE);
		$query = $this->cms->get('entries', 10);
		return $query->result();
	}

	//CMS업체 사용,미사용
	function sellinfo_useyn($id= '',$useyn= ''){
		$data = array(
				'useyn' => $useyn
		);
		$this->sparo->where('id', $id);
		if($this->sparo->update('ebay_pcmsmts', $data)){
			return "ok";
		}else{
			return "err";
		}
	}

    function old_sellinfo_stop($sellcode= ''){
        if($sellcode != ''){
            $data = array(
                'useyn' => 'N'
            );
            $this->sparo->where('sellcode', $sellcode);
            if($this->sparo->update('ebay_pcmsmts', $data)){
                return "ok";
            }else{
                return "err";
            }
        }else{
            return "err";
        }
    }
	
	function itemcode_useCount($sellcode=''){		
		$query = $this->sparo->query("select * from ebay_pcmsmts where useyn='Y' and sellcode ='$sellcode'");
		$total = $query -> num_rows();
		return $total;
	}
	
	
}
?>