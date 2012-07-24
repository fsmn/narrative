<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student_report_model extends CI_Model
{
	var $kStudent;
	var $kTeach;
	var $kAdvisor;
	var $category;
	var $assignment;
	var $report_date;
	var $comment;
	var $parent_contact;
	var $contact_date;
	var $contact_method;

	function prepare_variables()
	{
		$variables = array("kStudent","kTeach","kAdvisor","category","assignment","report_date","comment","parent_contact","contact_date","contact_method");
		for($i = 0; $i < count($variables); $i++){
			$myVariable = $variables[$i];
			if($this->input->post($myVariable)){
				$post = $this->input->post($myVariable);
				if($myVariable == "report_date" || $myVariable == "contact_date"){
					$this->$myVariable = format_date($post,"mysql");
				}else{
					$this->$myVariable = $post;
				}
			}
		}
	}


	function insert()
	{
		$this->prepare_variables();
		$this->db->insert("student_report",$this);
		$kReport = $this->db->insert_id();
		return $kReport;
	}

	function update($kReport)
	{
		$this->db->where("kReport",$kReport);
		$this->prepare_variables();
		$this->db->update("student_report",$this);
	}

	function delete($kReport)
	{
		$array = array("kReport"=>$kReport);
		$this->db->delete("student_report",$array);
	}

	function get($kReport)
	{
		$this->db->where("kReport",$kReport);
		$this->db->from("student_report");
		$this->db->join("student","student.kStudent=student_report.kStudent", "LEFT");
		$this->db->join("teacher","teacher.kTeach=student_report.kTeach","LEFT");
		$this->db->join("teacher as advisor","student_report.kAdvisor = advisor.kTeach","LEFT");
		$this->db->select("student_report.*,student.stuFirst,student.stuLast,student.stuNickname,teacher.teachFirst,teacher.teachLast,advisor.teachFirst as advisorFirst,advisor.teachLast as advisorLast");
		$output = $this->db->get()->row();
		return $output;
	}

	function get_for_student($kStudent, $options = array())
	{
		$this->db->where("student_report.kStudent", $kStudent);
		if(array_key_exists("date_range",$options)){
			if(array_key_exists("date_start",$options["date_range"]) && array_key_exists("date_end",$options["date_range"])){
				$date_start = $options["date_range"]["date_start"];
				$date_end = $optins["date_range"]["date_end"];
				$this->db->where("report_date BETWEEN $date_start AND $date_end");
			}
		}
		$this->db->join("student","student.kStudent=student_report.kStudent");
		$this->db->join("teacher","teacher.kTeach=student_report.kTeach");
		$this->db->join("teacher as advisor","student_report.kAdvisor = advisor.kTeach");
		$this->db->select("student_report.*,student.stuFirst,student.stuLast,student.stuNickname,teacher.teachFirst,teacher.teachLast,advisor.teachFirst as advisorFirst,teacher.teachLast as advisorLast");
		$this->db->from("student_report");
		$result = $this->db->get()->result();
		return $result;
	}

	function get_for_advisor($kAdvisor, $options = array())
	{
		$this->db->where("advisor.kAdvisor",$kAdvisor);
		if(array_key_exists("date_range",$options)){
			if(array_key_exists("date_start",$options["date_range"]) && array_key_exists("date_end",$options["date_range"])){
				$date_start = $options["date_range"]["date_start"];
				$date_end = $optins["date_range"]["date_end"];
				$this->db->where("report_date BETWEEN $date_start AND $date_end");
			}
		}
		$this->db->join("teacher as advisor","student_report.kAdvisor=advisor.kTeach");
		$this->db->join("teacher","teacher.kTeach=student_report.kTeach");
		$this->db->join("student","student.kStudent=student_report.kStudent");
		$this->db->select("student_report.*,student.stuFirst,student.stuLast,student.stuNickname,teacher.teachFirst,teacher.teachLast,advisor.teachFirst as advisorFirst,advisor.advisorLast");
		$this->db->from("student_report");
		$result = $this->db->get()->result();
		return $result;

	}

	function get_for_teacher($kTeach, $options = array())
	{
		$this->db->where("student_report.kTeach",$kTeach);
		if(array_key_exists("date_range",$options)){
			if(array_key_exists("date_start",$options["date_range"]) && array_key_exists("date_end",$options["date_range"])){
				$date_start = $options["date_range"]["date_start"];
				$date_end = $optins["date_range"]["date_end"];
				$this->db->where("report_date BETWEEN $date_start AND $date_end");
			}
		}
		$this->db->join("teacher","teacher.kTeach=student_report.kTeach");
		$this->db->join("teacher as advisor","student_report.kAdvisor=advisor.kTeach");
		$this->db->join("student","student.kStudent=student_report.kStudent");
		$this->db->select("student_report.*,student.stuFirst,student.stuLast,student.stuNickname,teacher.teachFirst,teacher.teachLast,advisor.teachFirst as advisorFirst,advisor.teachLast as advisorLast");
		$this->db->from("student_report");
		$result = $this->db->get()->result();
		return $result;
	}
	
	function get_list($type, $key, $options = array())
	{
		switch($type){
			case "student":
				$this->db->where("student_report.kStudent",$key);
				break;
			case "teacher":
				$this->db->where("student_report.kTeach",$key);
				break;
			case "advisor":
				$this->db->where("student_report.kAdvisor",$key);
				break;
		}

		if(array_key_exists("date_range",$options)){
			if(array_key_exists("date_start",$options["date_range"]) && array_key_exists("date_end",$options["date_range"])){
				$date_start = $options["date_range"]["date_start"];
				$date_end = $options["date_range"]["date_end"];
				$this->db->where("report_date BETWEEN $date_start AND $date_end");
			}
		}
		$this->db->join("teacher","teacher.kTeach=student_report.kTeach");
		$this->db->join("teacher as advisor","student_report.kAdvisor=advisor.kTeach");
		$this->db->join("student","student.kStudent=student_report.kStudent");
		$this->db->select("student_report.*,student.stuFirst,student.stuLast,student.stuNickname,teacher.teachFirst,teacher.teachLast,advisor.teachFirst as advisorFirst,advisor.teachLast as advisorLast");
		$this->db->from("student_report");
		$result = $this->db->get()->result();
		return $result;
	}
}