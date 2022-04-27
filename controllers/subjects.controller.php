<?php

function writeExcel()
{
    $excelData = $_POST['data'];
    $arrayLength = count($excelData);
    $i = 0;
    foreach ($excelData as $key => $value) {
        // $value['ระดับการศึกษา'] = mapData($value['ระดับการศึกษา']);   
        $sql = "INSERT INTO subjects (subject_type_id, level_id, course_id, course, rec_order, status, subject_id) ";
        $sql .= "VALUES ('" . $value['subject_type_id'] . "',' " . $value['level_id'] . "','" . $value['course_id'] . "','" . $value['course'] . "','" . $value['rec_order'] . "','" . $value['status'] . "','" . $value['subject_id'] . "')";
        try {
            $conn = new query();
            $conn->execute($sql);
            $conn->closeConnection();
            $i++;
            if ($i == $arrayLength) {
                echo json_encode(['message' => 'success']);
            }
        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}

function mapData($subject)
{
    switch ($subject) {
        case 'สาระทักษะการเรียนรู้':
            return '1';
            break;
        case 'สาระความรู้พื้นฐาน':
            return '2';
            break;
        case 'สาระการประกอบอาชีพ':
            return '3';
            break;
        case 'สาระทักษะการดำเนินชีวิต':
            return '4';
            break;
        case 'สาระการพัฒนาสังคม':
            return '5';
            break;
        case 'ประถมศึกษา':
            return '1';
            break;
        case 'มัธยมศึกษาตอนต้น':
            return '2';
            break;
        case 'มัธยมศึกษาตอนปลาย':
            return '3';
            break;
        case 'รายวิชาบังคับ':
            return '1';
            break;
        case 'รายเลือกบังคับ':
            return '2';
            break;
        default:
            break;
    }
}
