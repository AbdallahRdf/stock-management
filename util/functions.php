<?php

function view($view_name)
{
    header("location: resources/views/{$view_name}.php");
}
