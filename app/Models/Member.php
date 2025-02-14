<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id','username','mem_code', 'email', 'password','address', 'company', 'full_name', 'gender', 'birthday','provider','provider_id','avatar','phone','Tencongty','Masothue','Diachicongty', 'Sdtcongty',
        'emailcty', 'MaKH','status','m_status','ward','district','city_province','password_token'
    ];
}
