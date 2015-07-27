module.exports = (grunt) ->
  grunt.initConfig
    pkg: '<json:package.json>'
    clean: [
      "dist/theme/min"
      "dist/plugin/cars"
      'wordpress/wp-content/plugins/car'
      'wordpress/wp-content/themes/min'
    ]
    coffee:
      lib:
        files:
          'js_out/*.js': 'coffee/*.coffee'
    copy:
      plugin_dist:
        src: 'php'
        dest: 'dist/plugin/cars'
      plugin:
        src: 'dist/plugin/cars'
        dest: 'wordpress/wp-content/plugins/car'
      theme:
        src: 'dist/theme/min'
        dest: 'wordpress/wp-content/themes/min'
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
  grunt.loadNpmTasks 'grunt-contrib-copy'
  grunt.loadNpmTasks 'grunt-composer'

  grunt.registerTask 'default', [
    'clean'
    'coffee'
    'jade4php'
    'stylus'
    'copy'
  ]
