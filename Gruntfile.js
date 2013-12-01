(function() {

  'use strict';

  module.exports = function (grunt) {

    // load all grunt tasks matching the `grunt-*` pattern
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({

      // watch for changes and trigger compass, jshint, uglify and livereload
      //
      // if it takes too long for livereload, just remove the js files from the watch process ...
      //
      // to use LiveReload, make sure to install the browser extension for Firefox or Chrome
      //
      watch: {
        compass: {
          files: ['assets/scss/**/*.{scss,sass}'],
          tasks: ['compass']
        },
        js: {
          files: '<%= jshint.all %>',
          tasks: ['jshint', 'uglify']
        },
        livereload: {
          options: { livereload: true },
          files: ['assets/css/style.css', 'assets/js/source/*.js', '**/*.php', 'assets/images/**/*.{png,jpg,jpeg,gif,webp,svg}']
        }
      },

      // compass and scss
      compass: {
        dist: {
          options: {
            config: 'config.rb',
            force: true
          }
        }
      },

      // javascript linting with jshint
      jshint: {
        options: {
          jshintrc: '.jshintrc',
          "force": true
        },
        all: [
          'Gruntfile.js',
          'assets/js/source/global.js',
          'assets/js/source/selectMenus.js'
        ]
      },

      // uglify to concat, minify, and make source maps
      uglify: {

        // jQuery is built separately here to
        // provide a fallback if the CDN fails
        jquery: {
          files: {
            'assets/js/build/jquery.min.js': [
              'assets/js/source/jquery/jquery.js'
            ]
          }
        },

        global: {
          files: {
            'assets/js/build/global.min.js': [
              'assets/js/source/jquery.debouncedresize.js',
              'assets/js/source/supportsSelector.js',
              'assets/js/source/global.js',
              'assets/js/source/resizeSite.js',
              'assets/js/source/selectMenus.js'
            ]
          }
        },

        respond: {
          files: {
            'assets/js/build/respond.min.js': [
              'assets/js/source/respond/dest/respond.matchmedia.addListener.src.js',
              'assets/js/source/respond/dest/respond.src.js'
            ]
          }
        }

      },

      modernizr: {

        // [REQUIRED] Path to the build you're using for development.
        "devFile" : "remote",

        // [REQUIRED] Path to save out the built file.
        "outputFile" : "assets/js/build/modernizr.custom.min.js",

        // Based on default settings on http://modernizr.com/download/
        "extra" : {
          "shiv" : true,
          "printshiv" : false,
          "load" : true,
          "mq" : true,
          "cssclasses" : true
        },

        // Based on default settings on http://modernizr.com/download/
        "extensibility" : {
          "addtest" : false,
          "prefixed" : false,
          "teststyles" : false,
          "testprops" : false,
          "testallprops" : false,
          "hasevents" : false,
          "prefixes" : false,
          "domprefixes" : false
        },
        "uglify" : true,
        "parseFiles" : false,
        "matchCommunityTests" : false
      },

      // image optimization
      imagemin: {
        dist: {
          options: {
            optimizationLevel: 7,
            progressive: true
          },
          files: [
            {
              expand: true,
              cwd: 'assets/images/',
              src: '**/*',
              dest: 'assets/images/'
            }
          ]
        }
      }

    });

    // register default task
    grunt.registerTask('default', ['watch']);


  };

})();
