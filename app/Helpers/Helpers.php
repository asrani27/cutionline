<?php

use App\Models\Skpd;
use App\Models\Pegawai;

function countSkpd()
{
    return Skpd::get()->count();
}

function countPegawai()
{
    return Pegawai::get()->count();
}

function pegawai()
{
    return Pegawai::paginate(10);
}


function countUser()
{
    return Pegawai::where('user_id', '!=', null)->get()->count();
}

function countUserYet()
{
   return Pegawai::where('user_id', null)->get()->count();
}


function skpd()
{
    return Skpd::get();
}