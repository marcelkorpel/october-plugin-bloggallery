<?php

    namespace MarcelKorpel\BlogGallery;

    use System\Classes\PluginBase;
    use RainLab\Blog\Controllers\Posts as PostsController;
    use RainLab\Blog\Models\Post as PostModel;

    class Plugin extends PluginBase {

        public $require = ['RainLab.Blog', 'Rjchauhan.LightGallery'];

        public function pluginDetails() {
            return [
                'name'        => 'marcelkorpel.bloggallery::lang.plugin.name',
                'description' => 'marcelkorpel.bloggallery::lang.plugin.description',
                'author'      => 'Marcel Korpel',
                'icon'        => 'icon-image'
            ];
        }

        public function boot(){

            PostModel::extend(function ($model) {
                $model->belongsTo['lightgallery'] = ['Rjchauhan\LightGallery\Models\ImageGallery'];
            });

            PostsController::extendFormFields(function ($form, $model) {
                if (!$model instanceof PostModel) return;
                $form->addSecondaryTabFields([
                    'lightgallery' => [
                        'label'       => 'marcelkorpel.bloggallery::lang.form.label',
                        'tab'         => 'rainlab.blog::lang.post.tab_manage',
                        'type'        => 'relation',
                        'emptyOption' => 'marcelkorpel.bloggallery::lang.form.empty'
                    ]
                ]);
            });

        }

    }

?>