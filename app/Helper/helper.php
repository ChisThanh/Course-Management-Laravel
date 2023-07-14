<?php


if (function_exists('CheckSupperAdmin')) {
    function CheckSupperAdmin(): bool
    {
        return session()->get('level') === 1;
    }
}
