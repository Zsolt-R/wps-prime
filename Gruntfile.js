module.exports = function(grunt) {
	const sass = require('node-sass');
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dist: {
				options: {     
					implementation: sass,                  // Target options
					outputStyle: 'compressed',
					sourcemap: 'none'
				},
				files: {
					'inc/integrations/visual-composer/css/wps-vc-style.css' : 'scss/wps-vc-style.scss',
					'css/wps-swiper.min.css' : 'scss/wps-swiper.scss',
					'style.css' : 'scss/style.scss',
				}
			}
		},
		uglify: {
			my_target: {
				options: {
					sourceMap: false
				},
			  	files: {
					'js/min/site.min.js': 'js/site.js',
					'js/min/navigation.min.js': 'js/navigation.js',
					'js/min/wps-video-bg.min.js': 'js/wps-video-bg.js'
			  	}
			}
		},
		watch: {
			sass: {
				files: ['**/*.scss'],
				tasks: ['sass']
			},
			css: {
			files: ['**/*.css'],
			task: []
			},
			js: {
				files: [
					'js/site.js',
					'js/navigation.js',
					'js/wps-video-bg.js'
				],
				tasks: ['uglify']
			}
		}
	});
	
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-sass');
	grunt.registerTask('default',['sass','watch']);
}