let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copyDirectory('resources/assets/images', 'public/images')
   .copyDirectory('resources/assets/fonts', 'public/fonts')
   .copyDirectory('resources/assets/icons', 'public/icons')
   .copyDirectory('resources/assets/js', 'public/js')
   .copyDirectory('resources/assets/css', 'public/css')
   .copyDirectory('resources/assets/layui', 'public/layui');

	// 生产环境添加版本号
  if (mix.inProduction()) {
		mix.version();
  }
