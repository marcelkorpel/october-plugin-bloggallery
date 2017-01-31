<?php

    namespace MarcelKorpel\BlogGallery\Updates;

    use Schema;
    use October\Rain\Database\Updates\Migration;

    class CreateBlogGalleryField extends Migration {

        public function up() {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->integer('lightgallery_id')->unsigned()->nullable();
                $table->foreign('lightgallery_id')->references('id')->on('rjchauhan_lightgallery_image_galleries')->onDelete('set null');
            });
        }

        public function down() {
            if(Schema::hasColumn('rainlab_blog_posts', 'lightgallery_id')) {
                Schema::table('rainlab_blog_posts', function ($table) {
                    $table->dropForeign('rainlab_blog_posts_lightgallery_id_foreign');
                    $table->dropColumn('lightgallery_id');
                });
            }
        }

    }

?>