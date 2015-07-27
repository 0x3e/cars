module.exports = (grunt) ->
  grunt.initConfig
    pkg: '<json:package.json>'
    clean: [
      'dist'
      'wordpress/wp-content/plugins/hello.php'
      'wordpress/wp-content/plugins/car'
      'wordpress/wp-content/themes'
      'wordpress/wp-config.php'
    ]
    coffee:
      glob_to_multiple:
        expand: true
        flatten: true
        cwd: 'coffee'
        src: ['*.coffee']
        dest: 'dist/js'
        ext: '.js'
    jade4php:
      compile:
        expand: true
        cwd: 'jade/'
        src: ['*.jade','!layout*']
        dest: 'dist/theme/min'
        ext: '.php'
    stylus:
      compile:
        files:
          'dist/theme/min/style.css': ['stylus/*.styl']
    copy:
      plugin_dist:
        expand: true
        cwd: 'php'
        src: ['**']
        dest: 'dist/plugin/cars'
      plugin:
        expand: true
        cwd: 'dist/plugin/cars'
        src: ['**']
        dest: 'wordpress/wp-content/plugins/cars'
      theme:
        expand: true
        cwd: 'dist/theme/min'
        src: ['**']
        dest: 'wordpress/wp-content/themes/min'
      wp_config:
        src: 'local/wp-config.php'
        dest: 'wordpress/wp-config.php'
      htaccess:
        src: 'local/.htaccess'
        dest: 'wordpress/.htaccess'
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
    'composer:install'
    'clean'
    'coffee'
    'jade4php'
    'stylus'
    'copy'
  ]
