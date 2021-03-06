<?php

class Student_benchmark extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("student_benchmark_model", "student_benchmark");
        $this->load->model("student_model", "student");
    }

    function select()
    {
        if ($this->input->get("search")) {
            $this->load->model("subject_model", "subject");
            $this->load->model("menu_model");
            $kStudent = $this->input->get("kStudent");
            $student = $this->student->get($kStudent);
            $data ['student'] = $student;
            $data ['action'] = "update";
            $subjects = $this->subject->get_all(array(
                "has_benchmarks" => TRUE,
            ));
            $data ['subjects'] = get_keyed_pairs($subjects, array(
                "subject",
                "subject"
            ), TRUE);
            if ($this->input->get("student_grade")) {
                $data ['student_grade'] = $this->input->get("student_grade");
            } else {
                $data ['student_grade'] = get_current_grade($student->baseGrade, $student->baseYear);
            }
            $data ['target'] = "student_benchmark/select";
            $data ['title'] = "Search for Student Benchmarks";
            $data['refine'] = $this->input->get("refine");
            if ($this->input->get("ajax") == 1) {
                $this->load->view($data ['target'], $data);
            } else {
                $this->load->view("page/index", $data);
            }
        } else {
            $this->report();
        }
    }

    function report()
    {
        $this->load->model("benchmark_model", "benchmarks");

        $student_grade = $this->input->get("student_grade");
        bake_cookie("benchmark_grade", $student_grade);
        $data['student_grade'] = $student_grade;
        $year = $this->input->get("year");
        bake_cookie("benchmark_year", $year);
        $data['year'] = $year;
        $kStudent = $this->input->get("kStudent");
        bake_cookie("benchmark_student", $kStudent);
        $data ['kStudent'] = $kStudent;
        $term = $this->input->get("term");
        bake_cookie("benchmark_term", $term);
        $data ['term'] = $term;
        $quarter = $this->input->get("quarter");
        bake_cookie("benchmark_quarter", $quarter);
        $data ['quarter'] = $quarter;
        $options = array(
            "grade_range" => array(
                "gradeStart" => $student_grade,
                "gradeEnd" => $student_grade
            )
        );
        if ($term == "Mid-Year") {
            $quarters = 2;
        } else {
            $quarters = 4;
        }
        $data['quarters'] = $quarters;
        $student = $this->student->get($kStudent);
        $data ['student'] = $student;

        $subject = $this->input->get("subject");
        bake_cookie("benchmark_subject", $subject);
        $data['subject'] = $subject;
        if ($subject == "" || $subject === NULL) {
            $subjects = $this->benchmarks->get_subjects($student_grade, $year);
        } else {
            $subjects = array((object)array("subject" => $subject));
        }
        foreach ($subjects as $subject) {
            $subject->benchmarks = $this->benchmarks->get_list($year, $subject->subject, $options);
            foreach ($subject->benchmarks as $benchmark) {
                $benchmark->quarters = array();
                for ($i = 1; $i <= $quarters; $i++) {
                    $benchmark->quarters [] = array(
                        "quarter" => $i,
                        "grade" => $this->student_benchmark->get_one($kStudent, $benchmark->kBenchmark, $i)
                    );
                }
            }
        }
        $data['subjects'] = $subjects;
        if ($this->input->get("edit")) {
            $data ['target'] = "student_benchmark/edit";
        } else {
            $data ['target'] = "student_benchmark/chart";
        }
        $data ['title'] = sprintf("Benchmarks for %s, Grade %s, Quarter %s, %s", format_name($student->stuFirst, $student->stuLast, $student->stuNickname), $student_grade, $quarter, format_schoolyear($year));
        $this->load->view("page/index", $data);

    }

    function list_by_benchmark($kBenchmark)
    {
        $this->load->model("benchmark_model", "benchmarks");
        $benchmark = $this->benchmarks->get($kBenchmark);
        $options = array();
        if($benchmark->subject == "Humanities"){
            $options['custom_order'] = 'humanitiesTeacher.teachFirst';
        }
        $data['benchmark'] = $benchmark;
        $quarter = $this->input->get('quarter');
        $data['quarter'] = $quarter;
        $options['grades'] = $benchmark->gradeStart . ",". $benchmark->gradeEnd;

        $students = $this->student->get_all($benchmark->year, $options);
        foreach ($students as $student) {
            $student->benchmark = $this->student_benchmark->get_one($student->kStudent, $kBenchmark, $quarter);

        }
        $data['students'] = $students;
        $data['title'] = "Benchmark Entries";
        $data['target'] = "student_benchmark/benchmark_list";
        $this->load->view("page/index", $data);

    }

    function edit_one($kBenchmark, $kStudent, $quarter)
    {
        $this->load->model("benchmark_model", "benchmarks");
        $benchmark = $this->benchmarks->get($kBenchmark);
        $student_benchmark = $this->student_benchmark->get_one($kStudent, $kBenchmark, $quarter);
        $student = $this->student->get($kStudent);
        $student_name = format_name($student->stuFirst, $student->stuLast, $student->stuNickname);
        $data['benchmark'] = $student_benchmark;
        $data['kBenchmark'] = $kBenchmark;
        $data['kStudent'] = $kStudent;
        $data['quarter'] = $quarter;
        $data['year'] = $benchmark->year;
        $data['target'] = "student_benchmark/edit_one";
        $data['title'] = "Editing Benchmark for $student_name";
        if ($this->input->get("ajax")) {
            $this->load->view($data['target'], $data);
        } else {
            $this->load->view("page/index", $data);
        }

    }

    function update()
    {
        $kStudent = $this->input->post("kStudent");
        $kBenchmark = $this->input->post("kBenchmark");
        $grade = $this->input->post("grade");
        $comment = $this->input->post("comment");
        $quarter = $this->input->post("quarter");



        $output = $this->student_benchmark->update($kStudent, $kBenchmark, $quarter, $grade, $comment);

        if ($output) {
            echo OK;
        }
        if ($this->input->get("edit_one")) {
            redirect("student_benchmark/list_by_benchmark/$kBenchmark?quarter=$quarter");
        }
    }
}