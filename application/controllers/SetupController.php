<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SetupController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel");
    }

    #ข้อมูลตั้งต้นของระบบ
    public function setupdata()
    {
        echo "<hr/><p style='color:blue;'>setupdata</p><hr/>";

        #ข้อมูลตั้งต้น และข้อมูลโรงเรียน
        $this->create_school_type();
        $this->create_school_class();
        echo "<p style='color:green;'>School Success</p>";

        #ข้อมูลหลักสูตร
        $this->create_group_learning();
        $this->create_education_plan();
        echo "<p style='color:green;'>Syllabus Success</p>";

        #ข้อมูลที่ใช้ตั้งค่าให้ user   
        $this->create_user_admin();
        echo "<p style='color:green;'>User success</p>";

        #ข้อมูลบุคลากร
        $this->create_personnel_type();
        echo "<p style='color:green;'>Personnel success</p>";

        #ข้อมูลอาคาร
        $this->create_building_type();
        echo "<p style='color:green;'>Building success</p>";

        #mock up data ถ้าติดตั้งโปรเจคใหม่โล่งๆ ให้ comment ไว้
        $this->mockupdata();
    }

    function create_school_type()
    {
        $data = array(
            array(
                'name' => 'อปท.',
                'education_type' => 'ordinary',
                'fullname' => 'กรมส่งเสริมการปกครองท้องถิ่น',
                'description' => 'โรงเรียนในสังกัดท้องถิ่น ตั้งแต่อนุบาลถึงมัธยม'
            ),
            array(
                'name' => 'สพฐ.',
                'education_type' => 'ordinary',
                'fullname' => 'สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน',
                'description' => 'โรงเรียนในสังกัดสพฐ. ตั้งแต่อนุบาลถึงมัธยม'
            ),
            array(
                'name' => 'สช.',
                'education_type' => 'ordinary',
                'fullname' => 'สำนักงานคณะกรรมการส่งเสริมการศึกษาเอกชน',
                'description' => 'โรงเรียนในสังกัดสช. ตั้งแต่อนุบาลถึงมัธยม'
            ),
            array(
                'name' => 'ศพด.',
                'education_type' => 'ordinary',
                'fullname' => 'ศูนย์พัฒนาเด็กเล็ก',
                'description' => 'สถานศึกษาในระบบชั้นเตรียมก่อนเข้าอนุบาล'
            ),
            array(
                'name' => 'สอศ.',
                'education_type' => 'profession',
                'fullname' => 'สำนักงานคณะกรรมการการอาชีวศึกษา',
                'description' => 'สถานศึกษาในระดับชั้น ปวช. ถึง ปวส.'
            )
        );
        $this->db->insert_batch('tb_school_type', $data);
    }

    function create_school_class()
    {
        //อนุบาล อปท.
        $data1 = array(
            array(
                'education_type' => 'ordinary',
                'type' => 'ปฐมวัย',
                'name' => 'เตรียมอนุบาล',
                'abbreviation' => 'ตอ',
                'level' => '0',
                'sequence' => '0'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ปฐมวัย',
                'name' => 'อนุบาล',
                'abbreviation' => 'อ',
                'level' => '1',
                'sequence' => '1',
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ปฐมวัย',
                'name' => 'อนุบาล',
                'abbreviation' => 'อ',
                'level' => '2',
                'sequence' => '2'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ปฐมวัย',
                'name' => 'อนุบาล',
                'abbreviation' => 'อ',
                'level' => '3',
                'sequence' => '3'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนต้น',
                'name' => 'ประถมศึกษา',
                'abbreviation' => 'ป',
                'level' => '1',
                'sequence' => '4'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนต้น',
                'name' => 'ประถมศึกษา',
                'abbreviation' => 'ป',
                'level' => '2',
                'sequence' => '5'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนต้น',
                'name' => 'ประถมศึกษา',
                'abbreviation' => 'ป',
                'level' => '3',
                'sequence' => '6'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนปลาย',
                'name' => 'ประถมศึกษา',
                'abbreviation' => 'ป',
                'level' => '4',
                'sequence' => '7'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนปลาย',
                'name' => 'ประถมศึกษา',
                'abbreviation' => 'ป',
                'level' => '5',
                'sequence' => '8'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนปลาย',
                'name' => 'ประถมศึกษา',
                'abbreviation' => 'ป',
                'level' => '6',
                'sequence' => '9'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนต้น',
                'name' => 'มัธยมศึกษา',
                'abbreviation' => 'ม',
                'level' => '1',
                'sequence' => '10'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนต้น',
                'name' => 'มัธยมศึกษา',
                'abbreviation' => 'ม',
                'level' => '2',
                'sequence' => '11'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนต้น',
                'name' => 'มัธยมศึกษา',
                'abbreviation' => 'ม',
                'level' => '3',
                'sequence' => '12'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนปลาย',
                'name' => 'มัธยมศึกษา',
                'abbreviation' => 'ม',
                'level' => '4',
                'sequence' => '13'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนปลาย',
                'name' => 'มัธยมศึกษา',
                'abbreviation' => 'ม',
                'level' => '5',
                'sequence' => '14'
            ),
            array(
                'education_type' => 'ordinary',
                'type' => 'ประถมศึกษาตอนปลาย',
                'name' => 'มัธยมศึกษา',
                'abbreviation' => 'ม',
                'level' => '6',
                'sequence' => '15'
            ),
            array(
                'education_type' => 'profession',
                'type' => 'ประกาศนียบัตรวิชาชีพ',
                'name' => 'ประกาศนียบัตรวิชาชีพ',
                'abbreviation' => 'ปวช',
                'level' => '1',
                'sequence' => '13'
            ),
            array(
                'education_type' => 'profession',
                'type' => 'ประกาศนียบัตรวิชาชีพ',
                'name' => 'ประกาศนียบัตรวิชาชีพ',
                'abbreviation' => 'ปวช',
                'level' => '2',
                'sequence' => '14'
            ),
            array(
                'education_type' => 'profession',
                'type' => 'ประกาศนียบัตรวิชาชีพ',
                'name' => 'ประกาศนียบัตรวิชาชีพ',
                'abbreviation' => 'ปวช',
                'level' => '3',
                'sequence' => '15'
            ),
            array(
                'education_type' => 'profession',
                'type' => 'ประกาศนียบัตรวิชาชีพชั้นสูง',
                'name' => 'ประกาศนียบัตรวิชาชีพชั้นสูง',
                'abbreviation' => 'ปวส',
                'level' => '1',
                'sequence' => '16'
            ),
            array(
                'education_type' => 'profession',
                'type' => 'ประกาศนียบัตรวิชาชีพชั้นสูง',
                'name' => 'ประกาศนียบัตรวิชาชีพชั้นสูง',
                'abbreviation' => 'ปวส',
                'level' => '2',
                'sequence' => '17'
            ),
        );
        $this->db->insert_batch('tb_school_class', $data1);
    }

    function create_personnel_type()
    {
        $data = array(
            array(
                'level' => 6,
                'name' => 'บุคคลภายนอก',
                'group' => 'อื่นๆ'
            ),
            array(
                'level' => 1,
                'name' => 'ผู้อำนวยการสถานศึกษา',
                'group' => 'ผู้บริหาร'
            ),
            array(
                'level' => 2,
                'name' => 'รองผู้อำนวยการสถานศึกษา',
                'group' => 'ผู้บริหาร'
            ),
            array(
                'level' => 4,
                'name' => 'ครูผู้ช่วย',
                'group' => 'ครู'
            ),
            array(
                'level' => 3,
                'name' => 'ครูผู้สอน/ครูประจำชั้น',
                'group' => 'ครู'
            ),
            array(
                'level' => 5,
                'name' => 'พนักงานบัญชี',
                'group' => 'บุคลากรทางการศึกษา'
            ),
        );
        $this->db->insert_batch('tb_personnel_type', $data);
    }

    function create_education_plan()
    {
        $data = array(
            array(
                'name' => 'ทั่วไป',
                'name_th' => ' ',
                'name_eng' => ' '
            ),
            array(
                'name' => 'MEP',
                'name_th' => 'ห้องเรียน MEP',
                'name_eng' => 'MEP'
            ),
            array(
                'name' => 'วิทย์-คณิต',
                'name_th' => 'ห้องเรียน วิทย์-คณิต',
                'name_eng' => 'Sci-Math'
            ),
            array(
                'name' => 'PMP',
                'name_th' => 'ห้องเรียน PMP',
                'name_eng' => 'PMP'
            ),
            array(
                'name' => 'SME',
                'name_th' => 'ห้องเรียน SME',
                'name_eng' => 'SME'
            ),
            array(
                'name' => 'เทคโนโลยีดิจิทัล',
                'name_th' => 'ห้องเรียน เทคโนโลยีดิจิทัล',
                'name_eng' => 'Technology'
            ),
            array(
                'name' => 'การตลาด',
                'name_th' => 'ห้องเรียน การตลาด',
                'name_eng' => 'Marketing'
            ),
            array(
                'name' => 'บัญชี',
                'name_th' => 'ห้องเรียน บัญชี',
                'name_eng' => 'Accounting'
            ),
            array(
                'name' => 'ไฟฟ้ากำลัง',
                'name_th' => 'ห้องเรียน ไฟฟ้ากำลังต',
                'name_eng' => 'Electical'
            ),
            array(
                'name' => 'เทคนิคยานยนต์',
                'name_th' => 'ห้องเรียน เทคนิคยานยนต์',
                'name_eng' => 'Mechanical'
            ),
        );
        $this->db->insert_batch('tb_education_plan', $data);
    }

    function create_user_admin()
    {
        $array = array(
            'username' => 'admin',
            'type' => 'admin',
            'email' => 'acad@email.com',
            'password' => password_hash("acad@pnw2024", PASSWORD_DEFAULT),
            'remember_token' => 'acad_token',
            'created_at' => strtotime(date('Y-m-d h:i:s')),
            'updated_at' => strtotime(date('Y-m-d h:i:s'))
        );

        $this->db->set($array);
        $this->db->insert('tb_users');
    }

    function link_user_personnel()
    {
        $array = array(
            'user_id' => 1,
            'personnel_id' => 1,
            'created_at' => strtotime(date('Y-m-d h:i:s')),
            'updated_at' => strtotime(date('Y-m-d h:i:s'))
        );

        $this->db->set($array);
        $this->db->insert('tb_user_personnel');
    }

    function create_link_user_personnel()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');

        $this->db->select('*')->from('tb_personnel');
        $query = $this->db->get();
        $rs = $query->result_array();

        if (!empty($rs)) {
            foreach ($rs as $r) {
                $this->db->select('*')->from('tb_user_personnel')->where(array("personnel_id" => $r["id"]));
                $query = $this->db->get();
                $row = $query->row_array();
                if (empty($row)) {
                    $array1 = array(
                        'username' => $r["idcard"],
                        'type' => 'user',
                        'email' => 'acad' . $r["id"] . '@email.com',
                        'password' => password_hash($r["idcard"] . "@ttk1", PASSWORD_DEFAULT),
                        'remember_token' => 'acad_token',
                        'created_at' => strtotime(date('Y-m-d h:i:s')),
                        'updated_at' => strtotime(date('Y-m-d h:i:s'))
                    );

                    $this->db->set($array1);
                    $this->db->insert('tb_users');
                    $user_id = $this->db->insert_id();
                    if (!empty($user_id)) {
                        $array = array(
                            'user_id' => $user_id,
                            'personnel_id' => $r["id"],
                            'created_at' => strtotime(date('Y-m-d h:i:s')),
                            'updated_at' => strtotime(date('Y-m-d h:i:s'))
                        );

                        $this->db->set($array);
                        $this->db->insert('tb_user_personnel');

                        $data = array(
                            array(
                                'school_id' => 1,
                                'personnel_id' => $r["id"],
                                'personnel_type_id' => 4,
                                'date' => date("Y-m-d"),
                                'status' => 1,
                                'comment' => 'ใช้สำหรับตั้งค่าระบบ สามารถลบออกได้ภายหลัง'
                            )
                        );
                        $this->db->insert_batch('tb_personnel_register', $data);
                    }
                }
            }
        }
    }

    function create_group_learning()
    {
        $data = array(
            array(
                'sequence' => '1',
                'name' => 'ภาษาไทย',
                'year' => '2551',
                'displaystatus' => '1'
            ),
            array(
                'sequence' => '2',
                'name' => 'คณิตศาสตร์',
                'year' => '2551',
                'displaystatus' => '0'
            ),
            array(
                'sequence' => '2',
                'name' => 'คณิตศาสตร์',
                'year' => '2560',
                'displaystatus' => '1'
            ),
            array(
                'sequence' => '3',
                'name' => 'วิทยาศาสตร์',
                'year' => '2551',
                'displaystatus' => '0'
            ),
            array(
                'sequence' => '3',
                'name' => 'วิทยาศาสตร์และเทคโนโลยี',
                'year' => '2560',
                'displaystatus' => '1'
            ),
            array(
                'sequence' => '4',
                'name' => 'สังคมศึกษาศาสนาและวัฒนธรรม',
                'year' => '2560',
                'displaystatus' => '1'
            ),
            array(
                'sequence' => '5',
                'name' => 'สุขศึกษาและพลศึกษา',
                'year' => '2560',
                'displaystatus' => '1'
            ),
            array(
                'sequence' => '6',
                'name' => 'ศิลปะ',
                'year' => '2551',
                'displaystatus' => '1'
            ),
            array(
                'sequence' => '7',
                'name' => 'การงานอาชีพและเทคโนโลยี',
                'year' => '2551',
                'displaystatus' => '0'
            ),
            array(
                'sequence' => '7',
                'name' => 'การงานอาชีพ',
                'year' => '2560',
                'displaystatus' => '1'
            ),
            array(
                'sequence' => '8',
                'name' => 'ภาษาต่างประเทศ',
                'year' => '2551',
                'displaystatus' => '1'
            ),
            array(
                'sequence' => '9',
                'name' => 'กิจกรรมพัฒนาผู้เรียน',
                'year' => '2560',
                'displaystatus' => '0'
            ),
            array(
                'sequence' => '10',
                'name' => 'ปฐมวัย',
                'year' => '2560',
                'displaystatus' => '1'
            ),
        );
        $this->db->insert_batch('tb_group_learning', $data);
    }

    function create_building_type()
    {
        $data = array(
            array(
                'name' => 'อาคารเรียน',
                'code' => '001'
            ),
            array(
                'name' => 'อาคารอเนกประสงค์',
                'code' => '002'
            ),
        );
        $this->db->insert_batch('tb_building_type', $data);
    }


    #ข้อมูลตั้งต้นของโรงเรียนสำหรับทำข้อมูล#
    public function mockupdata()
    {
        echo "<hr/><p style='color:blue;'>mockupdata</p><hr/>";

        #ข้อมูลโรงเรียน 
        $this->create_school();
        echo "<p style='color:green;'>school detail success</p>";
        $this->create_school_cls();
        echo "<p style='color:green;'>school class success</p>";

        #ข้อมูลบุคลากร
        $this->create_personnel();
        echo "<p style='color:green;'>personnel detail success</p>";
        $this->create_personnel_register();
        echo "<p style='color:green;'>personnel register detail success</p>";

        #Link ข้อมูล 2 table
        $this->link_user_personnel();
        echo "<p style='color:green;'>personnel link to user success</p>";

        #ข้อมูลวิชา
        $this->create_course();
        echo "<p style='color:green;'>course create success</p>";

        #ข้อมูลอาคาร
        $this->create_building();
        echo "<p style='color:green;'>building create success</p>";
    }
    function create_school()
    {
        $array = array(
            'school_type_id' => 1,
            'name' => 'โรงเรียนเทศบาลท่าโขลง ๑',
            'maximum_semester' => 2
        );

        $this->db->set($array);
        $this->db->insert('tb_school');
    }

    function create_school_cls()
    {
        $array = array(
            'school_id' => 1,
            'school_class_id' => 5,
            'register_sequence' => 4,
            'register_graduation' => 0,
            'created_at' => strtotime(date("Y-m-d h:i:s")),
            'updated_at' => strtotime(date("Y-m-d h:i:s")),
        );

        $this->db->set($array);
        $this->db->insert('tb_school_class_register');
    }

    function create_personnel()
    {
        $data = array(
            array(
                'titlename' => 'นาย',
                'firstname' => 'ผู้ตั้งค่าระบบ',
                'lastname' => 'เอแคด',
                'created_at' => strtotime(date('Y-m-d h:i:s')),
                'updated_at' => strtotime(date('Y-m-d h:i:s'))
                // 'profile_image' => file_get_contents(base_url('resource/profile.jpg'))
            )
        );
        $this->db->insert_batch('tb_personnel', $data);
    }

    function create_personnel_register()
    {
        $data = array(
            array(
                'school_id' => 1,
                'personnel_id' => 1,
                'personnel_type_id' => 1,
                'date' => date("Y-m-d"),
                'status' => 1,
                'comment' => 'ใช้สำหรับตั้งค่าระบบ สามารถลบออกได้ภายหลัง'
            )
        );
        $this->db->insert_batch('tb_personnel_register', $data);
    }

    function create_course()
    {
        $data = array(
            array(
                'school_class_register_id' => 1,
                'group_learning_id ' => 1,
                'name' => 'ภาษาไทย 1',
                'code' => 'ท11101',
                'hours_per_week' => 5,
                'descriptions' => 'วิชาตัวอย่างสำหรับภาษาไทย ป.1',
                'created_at' => strtotime(date('Y-m-d h:i:s')),
                'updated_at' => strtotime(date('Y-m-d h:i:s'))
            )
        );
        $this->db->insert_batch('tb_course', $data);
    }

    function create_building()
    {
        $data = array(
            array(
                'school_id' => 1,
                'building_type_id ' => 1,
                'name' => 'อาคารเฉลิมพระเกียรติ 1',
                'status' => 'ปกติ',
                'descriptions' => 'อาคารเฉลิมพระเกียรติ สร้างในปี 2545 มีห้องเรียน 30 ห้อง เป็นอาคารไม้',
                'created_at' => strtotime(date('Y-m-d h:i:s')),
                'updated_at' => strtotime(date('Y-m-d h:i:s'))
            )
        );
        $this->db->insert_batch('tb_building', $data);
    }
}
