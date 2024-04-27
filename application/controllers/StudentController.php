<?php

defined('BASEPATH') or exit('No direct script access allowed');

class StudentController extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (empty($this->session->userdata("userStatus"))) {
            redirect(site_url(), 'refresh');
        }
        $this->load->model("StudentModel");
    }

    public function studentIndex() {
        $data["student"] = $this->StudentModel->get_student();

        $this->load->view("layout/header");
        $this->load->view("student/studentIndex", $data);
        $this->load->view("layout/footer");
    }

    public function studentPromoteIndex() {
        $data["student"] = $this->StudentModel->get_student();

        $this->load->view("layout/header");
        $this->load->view("student/studentpromoteIndex", $data);
        $this->load->view("layout/footer");
    }

    public function studentReportIndex() {
        $data["student"] = $this->StudentModel->get_student();

        $this->load->view("layout/header");
        $this->load->view("student/studentreportIndex", $data);
        $this->load->view("layout/footer");
    }

    public function studentInsertForm() {
        $this->load->view("layout/header");
        $this->load->view("student/studentInsertForm");
        $this->load->view("layout/footer");
    }

    public function insert_student() {
        $arr = array(
            "school_id" => $this->session->userdata("userSchoolId"),
            "profileimage" => $this->input->post("inStudentLogo64"),
            "titlename" => $this->input->post("inTitleName"),
            "firstname" => $this->input->post("inFirstName"),
            "lastname" => $this->input->post("inLastName"),
            "nickname" => $this->input->post("inNickName"),
            "idcard" => $this->input->post("inIdCard"),
            "birthdate" => $this->input->post("inBirthDate"),
            "gender" => $this->input->post("inGenDer"),
            "bloodtype" => $this->input->post("inBloodType"),
            "phonenumber" => $this->input->post("inPhoneNumber"),
            "religion" => $this->input->post("inReligion"),
            "ethnicity" => $this->input->post("inEthnicity"),
            "nationality" => $this->input->post("inNationality"),
            "c_no" => $this->input->post("inC_No"),
            "c_moo" => $this->input->post("inC_Moo"),
            "c_tambol" => $this->input->post("inC_Tambol"),
            "c_amphur" => $this->input->post("inC_AmPhur"),
            "c_province" => $this->input->post("inC_Province"),
            "c_zipcode" => $this->input->post("inC_ZipCode"),
            "r_no" => $this->input->post("inR_No"),
            "r_moo" => $this->input->post("inR_Moo"),
            "r_tambol" => $this->input->post("inR_Tambol"),
            "r_amphur" => $this->input->post("inR_AmPhur"),
            "r_province" => $this->input->post("inR_Province"),
            "r_zipcode" => $this->input->post("inR_ZipCode"),
            "f_titlename" => $this->input->post("inF_TitleName"),
            "f_firstname" => $this->input->post("inF_FirstName"),
            "f_lastname" => $this->input->post("inF_LastName"),
            "f_profile_image" => $this->input->post("inParentLogo64"),
            "f_phonenumber" => $this->input->post("inF_PhoneNumber"),
            "m_titlename" => $this->input->post("inM_TitleName"),
            "m_firstname" => $this->input->post("inM_FirstName"),
            "m_lastname" => $this->input->post("inM_LastName"),
            "m_profile_image" => $this->input->post("inParentLogo64"),
            "m_phonenumber" => $this->input->post("inM_PhoneNumber")
        );
        $this->StudentModel->update_student($arr);
    }

    public function studentEditForm($std_id) {
        $data["row"] = $this->StudentModel->get_student_by_stdid($std_id);
        $this->load->view("layout/header");
        $this->load->view("student/studentInsertForm", $data);
        $this->load->view("layout/footer");
    }

    public function update_student() {
        #ข้อมูลนักเรียน
        $arr = array(
            "school_id" => $this->session->userdata("userSchoolId"),
            "profileimage" => $this->input->post("inStudentLogo64"),
            "titlename" => $this->input->post("inTitleName"),
            "firstname" => $this->input->post("inFirstName"),
            "lastname" => $this->input->post("inLastName"),
            "nickname" => $this->input->post("inNickName"),
            "idcard" => $this->input->post("inIdCard"),
            "birthdate" => $this->input->post("inBirthDate"),
            "gender" => $this->input->post("inGenDer"),
            "bloodtype" => $this->input->post("inBloodType"),
            "phonenumber" => $this->input->post("inPhoneNumber"),
            "religion" => $this->input->post("inReligion"),
            "ethnicity" => $this->input->post("inEthnicity"),
            "nationality" => $this->input->post("inNationality"),
            #ข้อมูลที่อยู่ปัจจุบัน
            "c_no" => $this->input->post("inC_No"),
            "c_moo" => $this->input->post("inC_Moo"),
            "c_tambol" => $this->input->post("inC_Tambol"),
            "c_amphur" => $this->input->post("inC_AmPhur"),
            "c_province" => $this->input->post("inC_Province"),
            "c_zipcode" => $this->input->post("inC_ZipCode"),
            #ข้อมูลที่อยู่ตามทะเบียนบ้าน
            "r_no" => $this->input->post("inR_No"),
            "r_moo" => $this->input->post("inR_Moo"),
            "r_tambol" => $this->input->post("inR_Tambol"),
            "r_amphur" => $this->input->post("inR_AmPhur"),
            "r_province" => $this->input->post("inR_Province"),
            "r_zipcode" => $this->input->post("inR_ZipCode"),
            #ข้อมูลพื้นฐานพ่อ
            "f_titlename" => $this->input->post("inF_TitleName"),
            "f_firstname" => $this->input->post("inF_FirstName"),
            "f_lastname" => $this->input->post("inF_LastName"),
            "f_profile_image" => $this->input->post("inParentLogo64"),
            "f_phonenumber" => $this->input->post("inF_PhoneNumber"),
            #ข้อมูลพื้นฐานแม่
            "m_titlename" => $this->input->post("inM_TitleName"),
            "m_firstname" => $this->input->post("inM_FirstName"),
            "m_lastname" => $this->input->post("inM_LastName"),
            "m_profile_image" => $this->input->post("inParentLogo64"),
            "m_phonenumber" => $this->input->post("inM_PhoneNumber")
        );
        $this->StudentModel->update_student($arr, $this->input->post("inStdId"));
    }

    public function delete_student() {
        $std_id = $this->input->post("inStdId");
        $school_id = $this->session->userdata("userSchoolId");

        $status = $this->StudentModel->delete_student($std_id, $school_id);
        if ($status == "success") {
            echo "ลบข้อมูลสำเร็จ !";
        }
    }

    public function studentPP2Report($std_id) {
        $data["row"] = $this->StudentModel->get_student_by_stdid($std_id);

        //MPDF
        $data["title"] = "Title";
        $content1 = "Test part1 <hr>";
        $content2 = "<p>Test part2 </p>";
        $data["myContent"] = array($content1, $content2);
        $this->load->view("layout/header");
        $this->load->view("student/studentreportPP2", $data);
        $this->load->view("layout/footer");
    }

    public function inportStudent() {
        require_once APPPATH . '../vendor/PHPExcel.php';
        $this->excel = new PHPExcel();
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');

        if ($_FILES['inImpExcel']['name'] != "") {
            $config = array(
                "upload_path" => "tmp/",
                "allowed_types" => "xlsx|xls",
                "max_size" => 0,
            );
            $this->upload->initialize($config);
            $this->upload->do_upload("inImpExcel");
            $data = $this->upload->data();
            $filename = $data['file_name'];
            $path = 'tmp/';
        }

        $inFilename = $path . $filename;
        $room_id = $this->input->post("inRoomId");

        try {
            $inFileType = PHPExcel_IOFactory::identify($inFilename);
            $objReader = PHPExcel_IOFactory::createReader($inFileType);
            $objPHPExcel = $objReader->load($inFilename);
            $objPHPExcel->setActiveSheetIndex(0);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $flag = true;
            $i = 0;
            $this->db->trans_begin();

            foreach ($allDataInSheet as $arr) {

                if ($i == 0) {
                    $cols_name = $arr;
                }
                if ($i != 0) {
                    $arry = array();
                    $stdcode = "";
                    $stdidcard = "";
                    $stdnumber = 1;
                    $dad = array();
                    $mom = array();
                    $parent = array();
                    $relation="";
                    $reg_add = array();
                    $cur_add = array();
                    $cn = 0;
                    foreach (array_keys($arr) as $key => $value) {
                        $col_name = $cols_name[$value];
                        if (!empty($col_name) && !empty($arr[$value]) && trim($arr[$value]) != "") {
                            switch ($col_name) {
                                case "รหัสนักเรียน" : $stdcode = trim($arr[$value]);
                                    break;
                                case "คำนำหน้าชื่อนักเรียน" : $ar = array("titlename" => trim($arr[$value]));
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "ชื่อนักเรียน" : $ar = array("firstname" => trim($arr[$value]));
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "นามสกุลนักเรียน" : $ar = array("lastname" => trim($arr[$value]));
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "รหัสบัตรประชาชน" :
                                    $stdidcard = trim($arr[$value]);
                                    $stdidcard = str_replace("-", "", $stdidcard);
                                    $stdidcard = str_replace(" ", "", $stdidcard);
                                    $ar = array("idcard" => $stdidcard);
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "วันเดือนปีเกิด": $str = $arr[$value];
                                    if (!empty($str)) {
                                        if (count(explode('/', $str)) == 3) {
                                            $tmp = explode('/', $str);
                                            if ($tmp[0] > 35) {
                                                $dateArray = $tmp[0] . '-' . thaimoth_to_month_db($tmp[1]) . '-' .  insert_zero_f_position($tmp[2],2);
                                            } else {
                                                $dateArray = $tmp[2] . '-' . thaimoth_to_month_db($tmp[1]) . '-' .  insert_zero_f_position($tmp[0],2);
                                            }
                                           $bdate = $dateArray;
                                        } elseif (count(explode('-', $str)) == 3) {
                                            $tmp = explode('-', $str);
                                            if ($tmp[0] > 35 && $tmp[0] < 1000) {
                                                    $dateArray = date_parse_from_format('Y-m-d', $str);
                                            } else {
                                                $dateArray = date_parse_from_format('d-m-Y', $str);
                                            }
                                            $bdate = $dateArray['year'] . "-" . insert_zero_f_position($dateArray['month'], 2) . "-" . insert_zero_f_position($dateArray['day'], 2);
                                        } elseif (count(explode(' ', $str)) == 3) {
                                            $tmp = explode(' ', $str);
                                            if ($tmp[0] > 35) {
                                                $dateArray = $tmp[0] . '-' . thaimoth_to_month_db($tmp[1]) . '-' .  insert_zero_f_position($tmp[2],2);
                                            } else {
                                                $dateArray = $tmp[2] . '-' . thaimoth_to_month_db($tmp[1]) . '-' .  insert_zero_f_position($tmp[0],2);
                                            }
                                            $bdate = $dateArray;
                                        }
                                        if(empty($bdate)){
                                            $bdate = $str;
                                        }
                                        $ar = array("birthdate" => $bdate);
                                        $arry = array_merge($arry, $ar);
                                    }
                                    break;
                                case "ชื่อเล่น" : $ar = array("nickname" => trim($arr[$value]));
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "เพศ" : $ar = array("gender" => trim($arr[$value]));
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "กลุ่มเลือด" : $ar = array("bloodtype" => trim($arr[$value]));
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "เบอร์โทรนักเรียน" : $ar = array("phonenumber" => trim($arr[$value]));
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "ศาสนา" : $ar = array("religion" => trim($arr[$value]));
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "เชื้อชาติ" : $ar = array("ethnicity" => trim($arr[$value]));
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "สัญชาติ" : $ar = array("nationality" => trim($arr[$value]));
                                    $arry = array_merge($arry, $ar);
                                    break;
                                case "คำนำหน้าชื่อพ่อ" : $ar = array("titlename" => trim($arr[$value]));
                                    $dad = array_merge($dad, $ar);
                                    break;
                                case "ชื่อพ่อ" : $ar = array("firstname" => trim($arr[$value]));
                                    $dad = array_merge($dad, $ar);
                                    break;
                                case "นามสกุลพ่อ" : $ar = array("lastname" => trim($arr[$value]));
                                    $dad = array_merge($dad, $ar);
                                    break;
                                case "เบอร์โทรพ่อ" : $ar = array("phonenumber" => trim($arr[$value]));
                                    $dad = array_merge($dad, $ar);
                                    break;
                                case "คำนำหน้าชื่อแม่" : $ar = array("titlename" => trim($arr[$value]));
                                    $mom = array_merge($mom, $ar);
                                    break;
                                case "ชื่อแม่" : $ar = array("firstname" => trim($arr[$value]));
                                    $mom = array_merge($mom, $ar);
                                    break;
                                case "นามสกุลแม่" : $ar = array("lastname" => trim($arr[$value]));
                                    $mom = array_merge($mom, $ar);
                                    break;
                                case "เบอร์โทรแม่" : $ar = array("phonenumber" => trim($arr[$value]));
                                    $mom = array_merge($mom, $ar);
                                    break;
                                case "คำนำหน้าชื่อผู้ปกครอง" : $ar = array("titlename" => trim($arr[$value]));
                                    $parent = array_merge($parent, $ar);
                                    break;
                                case "ชื่อผู้ปกครอง" : $ar = array("firstname" => trim($arr[$value]));
                                    $parent = array_merge($parent, $ar);
                                    break;
                                case "นามสกุลผู้ปกครอง" : $ar = array("lastname" => trim($arr[$value]));
                                    $parent = array_merge($parent, $ar);
                                    break;
                                case "เบอร์โทรผู้ปกครอง" : $ar = array("phonenumber" => trim($arr[$value]));
                                    $parent = array_merge($parent, $ar);
                                    break;
                                case "ความสัมพันธ์" : $relation =  trim($arr[$value]);
                                    break;
                                case "ที่อยู่ตามทะเบียนบ้าน" : $ar = array("no" => trim($arr[$value]));
                                    $reg_add = array_merge($reg_add, $ar);
                                    break;
                                case "หมู่ตามทะเบียนบ้าน" : $ar = array("moo" => trim($arr[$value]));
                                    $reg_add = array_merge($reg_add, $ar);
                                    break;
                                case "ตำบลตามทะบียนบ้าน" : $ar = array("tambol" => trim($arr[$value]));
                                    $reg_add = array_merge($reg_add, $ar);
                                    break;
                                case "อำเภอตามทะเบียนบ้าน" : $ar = array("amphur" => trim($arr[$value]));
                                    $reg_add = array_merge($reg_add, $ar);
                                    break;
                                case "จังหวัดตามทะเบียนบ้าน" : $ar = array("province" => trim($arr[$value]));
                                    $reg_add = array_merge($reg_add, $ar);
                                    break;
                                case "รหัสตามทะเบียนบ้าน" : $ar = array("zipcode" => trim($arr[$value]));
                                    $reg_add = array_merge($reg_add, $ar);
                                    break;
                                case "ที่อยู่ปัจจุบัน" : $ar = array("no" => trim($arr[$value]));
                                    $cur_add = array_merge($cur_add, $ar);
                                    break;
                                case "หมู่ปัจจุบัน" : $ar = array("moo" => trim($arr[$value]));
                                    $cur_add = array_merge($cur_add, $ar);
                                    break;
                                case "ตำบลปัจจุบัน" : $ar = array("tambol" => trim($arr[$value]));
                                    $cur_add = array_merge($cur_add, $ar);
                                    break;
                                case "อำเภอปัจจุบัน" : $ar = array("amphur" => trim($arr[$value]));
                                    $cur_add = array_merge($cur_add, $ar);
                                    break;
                                case "จังหวัดปัจจุบัน" : $ar = array("province" => trim($arr[$value]));
                                    $cur_add = array_merge($cur_add, $ar);
                                    break;
                                case "รหัสปัจจุบัน" : $ar = array("zipcode" => trim($arr[$value]));
                                    $cur_add = array_merge($cur_add, $ar);
                                    break;
                            }
                        }
                        $cn++;
                    }
                    //-------------------------start insert and update tb_student---------------------------------------
                    $stdrow = $this->MainModel->get_where_row('tb_student', array('idcard' => trim($stdidcard)));
                    $student_id = null;
                    $ar = array("updated_at" => strtotime(date("Y-m-d")));
                    $arry = array_merge($arry, $ar);
                    if (!empty($stdrow)) {
                        $student_id = $stdrow['id'];
                        $this->db->where(array('id' => $id))->update('tb_student', $arry);
                    } else {
                        $ar = array("created_at" => strtotime(date("Y-m-d")));
                        $arry = array_merge($arry, $ar);
                        $student_id = $this->MainModel->insert_data('tb_student', $arry);
                    }

                    //-----------------------------end insert and update tb_student---------------------------------------
                    if (!empty($student_id)) {
                        //-------------------------start insert tb_student_registert---------------------------------------
                        $arry = array(
                            "school_id" => $this->session->userdata("userSchoolId"),
                            "student_id" => $student_id,
                            "code" => $stdcode,
                            "status" => "กำลังศึกษา",
                            "date" => strtotime(date("Y-m-d"))
                        );
                        $this->MainModel->insert_data('tb_student_register', $arry);
                        //-------------------------start insert tb_room_members---------------------------------------
                        $arry = array(
                            "room_id" => $room_id,
                            "student_id" => $student_id,
                            "number" => $stdnumber
                        );
                        $this->MainModel->insert_data('tb_room_members', $arry);
                        //-------------------------start insert tb_parent [DAD]---------------------------------------
                        if (!empty($dad)) {
                            $dad_id = $this->MainModel->insert_data('tb_parent', $dad);
                            if (!empty($dad_id)) {
                                $main = false;
                                if ($dad == $parent) {
                                    $main = true;
                                }
                                $arry = array(
                                    "student_id" => $student_id,
                                    "parent_id" => $dad_id,
                                    "relation" => "พ่อ",
                                    "main" => $main
                                );
                                $this->MainModel->insert_data('tb_student_parent', $arry);
                            }
                        }
                        //-------------------------start insert tb_parent [MOM]---------------------------------------
                        if (!empty($mom)) {
                            $mom_id = $this->MainModel->insert_data('tb_parent', $mom);
                            if (!empty($mom_id)) {
                                $main = false;
                                if ($mom == $parent) {
                                    $main = true;
                                }
                                $arry = array(
                                    "student_id" => $student_id,
                                    "parent_id" => $mom_id,
                                    "relation" => "แม่",
                                    "main" => $main
                                );
                                $this->MainModel->insert_data('tb_student_parent', $arry);
                            }
                        }
                        //-------------------------start insert tb_parent [parent]---------------------------------------
                        if (!empty($parent)) {
                            if ($dad != $parent && $mom != $parent) {
                                $par_id = $this->MainModel->insert_data('tb_parent', $parent);
                                if (!empty($par_id)) {
                                    $arry = array(
                                        "student_id" => $student_id,
                                        "parent_id" => $par_id,
                                        "relation" => $relation,
                                        "main" => true
                                    );
                                    $this->MainModel->insert_data('tb_student_parent', $arry);
                                }
                            }
                        }
                        //-------------------------start insert tb_student_registered_address---------------------------------------
                        if (!empty($reg_add)) {
                            $reg_add["student_id "] = $student_id;
                            $reg_add["created_at"] = strtotime(date("Y-m-d"));
                            $reg_add["updated_at"] = strtotime(date("Y-m-d"));
                            $this->MainModel->insert_data('tb_student_registered_address', $reg_add);
                        }
                        //-------------------------start insert tb_student_current_address---------------------------------------
                        if (!empty($cur_add)) {
                            $cur_add["student_id "] = $student_id;
                            $cur_add["created_at"] = strtotime(date("Y-m-d"));
                            $cur_add["updated_at"] = strtotime(date("Y-m-d"));
                            $this->MainModel->insert_data('tb_student_current_address', $cur_add);
                        }
                    }

                    $stdnumber++;
                }
                $i++;
            }
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inFilename, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
        } finally {
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            @unlink($inFilename);
        }
    }

}
