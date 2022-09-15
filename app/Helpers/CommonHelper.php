<?php

function dateTimeFormat($date)
{
    return  date('Y-m-d h:i a', strtotime($date));
}

function getPageName()
{
    if (request()->is('tasks')) {
        return "<i class='fa fa-users'></i>&nbsp;&nbsp;Tasks";
    }
}

