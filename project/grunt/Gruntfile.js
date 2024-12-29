module.exports = function(grunt) {
   
    // Project configuration.
    grunt.initConfig({
        concat: {
        options: {
            // it means, how to separate the concat files
            separator: '\n',
            //it is a sourcemap, that is a file that maps from the generated code back to the original source code
            //and it is a good practice to use it in production
            souecemap: true,
        },
        css: {
            // src: ['../css/1.css', '../css/2.css', '../css/3.css'], 
            //this syntax will automatically detect changes inside the css folder for all the files, even it inside another forlder
            src: ['../css/**/*.css'],

            //this is the destination file
            dest: 'dist/style.css',
        },
        js:{
            //this syntax will automatically detect changes inside the js folder for all the files, even it inside another forlder
            src: ['../js/**/*.js','bower_components/jquery/dist/jquery.js'],

            //this is the destination file
            dest: '../../htdocs/js/script.js',
        }
        },
        watch: {
            //write a watch for css files
            css: {
                //this syntax will automatically detect changes inside the css folder for all the files, even it inside another forlder
              files: ['../css/**/*.css'],
                //this is the task that will run when the watch detect a change
              tasks: ['concat:css'],
              options: {
                spawn: false,
              },
            },
            js: {
                //this syntax will automatically detect changes inside the css folder for all the files, even it inside another forlder
              files: ['../js/**/*.js'],
              //this is the task that will run when the watch detect a change
              tasks: ['concat:js'],
              options: {
                spawn: false,
              },
            },
          },
        cssmin: {
            options: {
              mergeIntoShorthands: false,
              roundingPrecision: -1
            },
            target: {
              files: {
                '../../htdocs/css/style.css': ['dist/style.css']
              }
            }
          }
          
        
    });
    // Load the plugin that provides the "concat" task.
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');

    //this is a default task, that run when you just call 'grunt' in terminal
    grunt.registerTask('default', ['concat','cssmin','watch']);
    
}; 

