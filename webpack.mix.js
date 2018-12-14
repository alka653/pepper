const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
	.scripts('resources/js/jquery.min.js', 'public/js/jquery.min.js')
	.scripts('resources/js/jquery-migrate.min.js', 'public/js/jquery-migrate.min.js')
	.scripts('resources/js/bootstrap.min.js', 'public/js/bootstrap.min.js')
	.scripts('resources/js/theme.js', 'public/js/theme.js')
	.scripts('resources/js/sticky.js', 'public/js/sticky.js')

	.styles('resources/css/bootstrap.min.css', 'public/css/bootstrap.min.css')
	.styles('resources/css/font-awesome/css/font-awesome.min.css', 'public/css/font-awesome/font-awesome.min.css')
	.styles('resources/css/animate/animate.min.css', 'public/css/animate/animate.min.css')
	.styles('resources/css/ionicons/css/ionicons.min.css', 'public/css/ionicons/ionicons.min.css')
	.styles('resources/css/theme.css', 'public/css/theme.css')
   	
   	.stylus('resources/stylus/app.min.styl', 'public/css')