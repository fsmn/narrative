<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup_model extends CI_Model
{
	var $kNarrative;
	var $kStudent;
	var $kTeach;
	var $stuGrade;
	var $narrText;
	var $narrTerm;
	var $narrSubject;
	var $narrGrade;
	var $narrYear;
	var $recModified;
	var $recModifier;

	function __construct()
	{
		parent::__construct();
	}

	function prepare_variables()
	{
		$variables = array("kNarrative","kStudent","kTeach","stuGrade","narrText","narrTerm","narrSubject","narrGrade","narrYear");
		for($i = 0; $i < count($variables); $i++){
			$myVariable = $variables[$i];
			if($this->input->post($myVariable)){
				if($myVariable == "stuGrade" && $this->input->post($myVariable) == "") {
					$this->$myVariable = 0;
				}else{
					$this->$myVariable = $this->input->post($myVariable);
				}
			}
		}
		$this->recModified = mysql_timestamp();
		$this->recModifier = $this->session->userdata('userID');
	}

	/**
	 * Getter
	 */
	function get_backups($kNarrative)
	{
		$this->db->where('kNarrative', $kNarrative);
		$this->db->from('narrative');
		$query = $this->db->get();
		return $query->result();
	}

	function get_text($kBackup)
	{
		$output = false;
		$this->db->where('kBackup', $kBackup);
		$this->db->select('narrText');
		$this->db->from('backup');
		$result = $this->db->get()->result();
		if($result){
			$output = $result[0];
			$output = $output->narrText;
		}
		return $output;
	}

	function get_last_backup_value($kNarrative, $fieldName)
	{
		$output = false;
		$this->db->where('kNarrative', $kNarrative);
		$this->db->select($fieldName);
		$this->db->order_by('recModified', 'DESC');
		$this->db->from('backup');
		$result = $this->db->get()->result();
		if($result){
			$output = $result[0];
			$output = $output->$fieldName;
		}
		return $output;
	}

	function get_backup_difference($kNarrative, $narrText)
	{
		$backupText = $this->get_last_backup_value($kNarrative, 'narrText');
		similar_text($narrText, $backupText, $percent);
		return $percent;
	}

	/**
	 * Setter
	 */
	function insert($values)
	{
		$this->db->insert('backup', $values);
		return $this->db->insert_id();
	}



}