<?php
  
  namespace App\Models;
  
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  
  class Users_info extends Model
  {
      use HasFactory;
      protected $table = 'users_infos';
      protected $fillable = 
      [
          'ui_id',
          'ui_name',
          'ui_user',
          'ui_mobile',
          'ui_type',
          'ui_para',
          'ui_log',
      ];
  }

