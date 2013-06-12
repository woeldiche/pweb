/*global module*/
module.exports = function (grunt) {
  'use strict';
 
  var gruntConfig = {};
  grunt.loadNpmTasks('grunt-contrib-jshint');
  gruntConfig.jshint = {
      options: { bitwise: true, camelcase: false, curly: true, eqeqeq: true, forin: true, immed: true,
          latedef: true, newcap: true, noarg: true, noempty: true, nonew: true, plusplus: true,
          quotmark: true, regexp: true, undef: true, unused: true, strict: true, trailing: true,
          maxparams: 3, maxdepth: 2, maxstatements: 50, browser: true, jquery: true},
      all: [
          'Gruntfile.js',
          '**/*.js',
          '!**/libs/*',
          '!node_modules/**'
      ]
  };
  grunt.initConfig(gruntConfig);
  grunt.registerTask('travis', 'jshint');
};