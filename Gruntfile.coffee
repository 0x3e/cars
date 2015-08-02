module.exports = (grunt) ->
  grunt.initConfig
    pkg: '<json:package.json>'
    clean:
      dist: 'dist'
      plugin: 'dist/plugins/cars'
      theme: 'dist/themes/min'
      hello: 'wordpress/wp-content/plugins/hello.php'
      wp_plugin: 'wordpress/wp-content/plugins/car'
      wp_theme: 'wordpress/wp-content/themes/min'
      wp_config: 'wordpress/wp-config.php'
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
        cwd: 'jade4php'
        src: ['*.jade','!layout*']
        dest: 'dist/themes/min'
        ext: '.php'
    jade:
      compile:
        options:
          client: false
          pretty: true
        files: [
          expand: true
          cwd: 'jade'
          src: ['*.jade','!layout*']
          dest: 'dist/themes/min'
          ext: '.html'
        ]
    stylus:
      compile:
        files:
          'dist/themes/min/style.css': ['stylus/*.styl']
    phpunit:
      options:
        stderr: true
      plugin:
        dir: 'test/cars_Test.php'
      taxonomy:
        dir: 'test/taxonomy-car_Test.php'
      all:
        dir: 'test'
    copy:
      plugin:
        expand: true
        cwd: 'php'
        src: ['**']
        dest: 'dist/plugins/cars'
      wp_plugin:
        expand: true
        cwd: 'dist/plugins/cars'
        src: ['**']
        dest: 'wordpress/wp-content/plugins/cars'
      wp_theme:
        expand: true
        cwd: 'dist/themes/min'
        src: ['**']
        dest: 'wordpress/wp-content/themes/min'
      wp_config:
        src: 'local/wp-config.php'
        dest: 'wordpress/wp-config.php'
      htaccess:
        src: 'local/.htaccess'
        dest: 'wordpress/.htaccess'
    wp_plugins:
      blog:
        options:
          wordpress_path: 'wordpress'
          wp_cli_path: 'vendor/bin/'
    bower:
      dev:
        dest: 'dist/js'

    watch:
      grunt:
        files: 'Gruntfile.coffee'
        tasks: 'default'
      plugin:
        files: ['php/cars.php','php/Øx3e/car*.php','test/car*Test.php']
        tasks: ['clean:plugin','copy:plugin','phpunit']
      wp_plugin:
        files: ['php/Øx3e/*']
        tasks: ['default']

  grunt.loadNpmTasks 'grunt-contrib-coffee'
  grunt.loadNpmTasks 'grunt-contrib-watch'
  grunt.loadNpmTasks 'grunt-contrib-jade'
  grunt.loadNpmTasks 'grunt-jade4php'
  grunt.loadNpmTasks 'grunt-contrib-stylus'
  grunt.loadNpmTasks 'grunt-contrib-clean'
  grunt.loadNpmTasks 'grunt-contrib-copy'
  grunt.loadNpmTasks 'grunt-composer'
  grunt.loadNpmTasks 'grunt-phpunit'
  grunt.loadNpmTasks 'grunt-wp-plugins'
  grunt.loadNpmTasks 'grunt-bower'

  grunt.registerTask 'default', [
    'composer:install'
    'clean'
    'coffee'
    'jade4php'
    'jade'
    'stylus'
    'copy'
    'phpunit:all'
  ]
  grunt.registerTask 'plugin', [
    'clean:plugin'
    'copy:plugin'
    'phpunit:plugin'
  ]
