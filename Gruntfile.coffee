module.exports = (grunt) ->
  grunt.initConfig
    pkg: '<json:package.json>'
    coffee:
      lib:
        files:
          'js_out/*.js': 'coffee/*.coffee'
    jade4php:
      compile:
        expand: true
        cwd: 'jade/'
        src: ['*.jade']
        dest: 'dist/theme/min'
        ext: '.php'
    stylus:
      compile:
        files:
          'dist/theme/min/styles.css': ['stylus/*.styl']
    clean: ["dist/theme/min"]
    watch:
      files: [
        'Gruntfile.coffee'
      ]
      tasks: 'default'

  grunt.loadNpmTasks 'grunt-contrib-coffee'
  grunt.loadNpmTasks 'grunt-contrib-watch'
  grunt.loadNpmTasks 'grunt-jade4php'
  grunt.loadNpmTasks 'grunt-contrib-stylus'
  grunt.loadNpmTasks 'grunt-contrib-clean'

  grunt.registerTask 'default', ['clean','coffee','jade4php','stylus']
