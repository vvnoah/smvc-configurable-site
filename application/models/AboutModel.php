<?php

namespace app\models;

class AboutModel {
    public function get_name(){
        return "Noah Van Vaerenbergh";
    }
    
    public function get_class_group(){
        return "2ICT1";
    }
    
    public function get_students(){
        return [
            'Noah',
            'Nicky',
            'Martijn',
            'Killian',
            'Ward',
            'Luc',
            'David',
            'Koen',
            'Alex',
            'Jordy',
            'Kaj',
            'Calvin'
        ];
    }
}
