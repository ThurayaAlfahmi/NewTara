
  <?php
  
  
  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;
  use Illuminate\Support\Facades\DB;
  
  return new class extends Migration
  {
  
  
      public function up(): void
      {
        Schema::create("users_infos", function (Blueprint $table) {
          $table->id();
          $table->string("ui_id")->unique()->comment("رقم المستخدم");
          $table->string("ui_user")->comment("اسم المستخدم");
          $table->string("ui_name")->comment("الاسم كاملا");
          $table->string("ui_mobile")->comment("رقم الجوال");
          $table->string("ui_type")->comment("نوع المستخدم");
          $table->text("ui_para")->nullable()->comment("الصلاحيات");
          $table->text("ui_log")->comment("سجل العمليات");
          $table->string("ui_del")->nullable()->comment("هل محذوف");
          $table->timestamps();


      });
  
          DB::table("users_infos")->insert([
              "ui_id" => "1",
              "ui_user" => "msme@msmesoft.com",
              "ui_name" => "Administrator",
              "ui_mobile" => "966565709000",
              "ui_type" => "1",
              "ui_para" => "",
             "ui_log" => "New"              
          ]);

         
        
      }

      
  
      /**
       * Reverse the migrations.
       */
      public function down(): void
      {
          Schema::dropIfExists("users_infos");
      }
  };
