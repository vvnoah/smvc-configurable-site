<?php

namespace app\models;

use core\Model;

class StudentModel extends Model {
    public function get_student_data() {
        $file = fopen('C:\Users\VVNoa\OneDrive\Bureaublad\laragon\www\smvc-configurable-site\application\data\studentdata.csv', 'r');

        while(!feof($file)){
            $lines[] = fgetcsv($file, 1000, ';');
        }
        fclose($file);
        return $lines;
    }
}