
 <?php
  
  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;
  
  return new class extends Migration
  {
    public function up(): void
    {
        Schema::create('myfrinds', function (Blueprint $table) {
          $table->id();
  
          $table->date("my_f_add_date")->nullable()->comment("تاريخ الاضافة");
        
            $table->string("my_f_name")->comment("الاسم");
            
              $table->bigInteger("my_f_mobile")->comment("الجوال");
          
            $table->text("my_f_address")->nullable()->comment("العنوان");
          
            $table->string("my_f_email")->nullable()->comment("البريد الالكتروني");
            
            $table->string("my_f_social")->comment("الحالة الاجتماعية");
            
        $table->text("myfrind_log")->comment("سجل العمليات");
      
        $table->string("myfrind_del")->nullable()->comment("هل محذوف");
        $table->timestamps();
      
 });
    }

    public function down(): void
    {
        Schema::dropIfExists('myfrinds');
    }
};

