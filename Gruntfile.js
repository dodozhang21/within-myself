'use strict';

module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({

        // Metadata.
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',

      

        // Task configuration.
        clean: {
            options: {
                force: true
            },
            files: ['css/']
        },
        watch: {
          sassy: {
            files: ['sass/**/*.scss'],
            tasks: ['compass'],
            options: {
                spawn: false,
                livereload: true
            }
          }
        },
        compass: {
            dist: {
                options: {
                    sassDir: 'sass/styles',
                    cssDir: 'css',
                    //specify: '*.scss',
                    outputStyle: 'nested'
                }
            }
			,
            style: {
                options: {
                    //sassDir: 'sass',
                    cssDir: './',
                    specify: 'sass/style.scss',
                    outputStyle: 'nested'
                }
            }
        },
        browser_sync: {
            files: {
                src : ['style.css', 'css/*.css'],
            },
            options: {
                watchTask: true,
            },
        },
    });

    // These plugins provide necessary tasks.
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-browser-sync');

    // Default task.
    grunt.registerTask('local', ['browser_sync', 'watch']);
    grunt.registerTask('default', ['clean', 'compass']);


};
