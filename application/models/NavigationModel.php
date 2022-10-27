<?php

namespace app\models;

class NavigationModel {
    public function get_nav(){
        return <<<HTML
                <li class="nav-item">
                    <a class="nav-link" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>
                HTML;
    }
}
