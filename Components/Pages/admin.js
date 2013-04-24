'use strict';

define([
    'tinymce/module',
    'angular-nestedtree/module',
    'angular-ui/angular-ui.min',
    '/App/Admin/assets/js/bootstrapSwitch.js',
    'angular-ckeditor/module',
    'bootstrap-tree/bootstrap-tree'
], function() {

    angular.module('Component.News.Admin', ['ui']).
        config(['$routeProvider', function($routeProvider, $locationProvider) {
            $routeProvider
                .when('/news', {
                    controller: 'NewsCtrl',
                    templateUrl: '/Components/News/views/admin/list.html',
                    reloadOnSearch: false
                })
                .when('/news/edit:id', {
                    controller: 'NewsArticleCtrl',
                    templateUrl: '/Components/News/views/admin/edit.html'
                })
                .when('/news/create', {
                    controller: 'NewsArticleCtrl',
                    templateUrl: '/Components/News/views/admin/edit.html'
                });
        }]).value('ui.config', {
           tinymce: {
                theme : "advanced",
                skin : "bootstrap",
                plugins : "spellchecker,safari,pagebreak,table,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,print,contextmenu,paste,directionality,fullscreen,visualchars,nonbreaking,xhtmlxtras,template",
                theme_advanced_buttons1 : "bold,italic,strikethrough,underline,|,bullist,numlist,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,anchor,|,spellchecker,fullscreen",
                theme_advanced_buttons2 : "formatselect,forecolor,|,pastetext,pasteword,cleanup,|,image,charmap,|,outdent,indent,|,undo,redo,|,pagebreak,typograf,code",
                theme_advanced_buttons3 : "",
                theme_advanced_buttons4 : "",
                theme_advanced_resizing : true,

                relative_urls : false,
                remove_script_host : true,
                spellchecker_languages : "English=en,+Ukrainian=uk,Russian=ru",
                spellchecker_rpc_url : "/assets/packages/tiny_mce/plugins/spellchecker/post-handler.php",
                spellchecker_word_separator_chars : '\\s!"#$%&()*+,./:;<=>?@[\]^_|\xa7{ }\xa9\xab\xae\xb1\xb6\xb7\xb8\xbb\xbc\xbd\xbe\u00bf\xd7\xf7\xa4\u201d\u201c',
                theme_advanced_resize_horizontal:"",
                theme_advanced_blockformats: 'p,pre,h2,h3,h4,h5,h6'
           }
        }).directive('dateRange', function() {
            return {
                link: function(scope, element, attrs, ngModel) {
                    var el = $(element);
                    el.daterangepicker({
                        ranges: {
                            'Today': ['today', 'today'],
                            'Yesterday': ['yesterday', 'yesterday'],
                            'Last 7 Days': [Date.today().add({ days: -6 }), 'today'],
                            'Last 30 Days': [Date.today().add({ days: -29 }), 'today'],
                            'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
                            'Last Month': [Date.today().moveToFirstDayOfMonth().add({ months: -1 }), Date.today().moveToFirstDayOfMonth().add({ days: -1 })]
                        },
                        opens: 'left',
                        format: 'MM/dd/yy',
                        startDate: Date.today().add({ days: -29 }),
                        endDate: Date.today(),
                        minDate: '01/01/2012',
                        maxDate: '12/31/2013',
                        locale: {
                            applyLabel: 'Submit',
                            fromLabel: 'From',
                            toLabel: 'To',
                            customRangeLabel: 'Custom Range',
                            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                            firstDay: 1
                        }
                    },
                    function(start, end) {
                        //$('#reportrange span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
                    });
                }
            };
        })
    .factory('NewsService', function($resource) {
            return $resource('/rest.php/news/:id/', { 'id': '@id' }, {
                updateOrder: { method: 'PUT', data: { 'orders': '@orders' }, isArray: true }
            });
    })
    .factory('LanguageService', function($resource) {
            return $resource('/rest.php/app/language');
    })
    .factory('AuthorsService', function($resource) {
            return $resource('/rest.php/news/authors/');
    })
    .factory('CategoriesService', function($resource) {
            return $resource('/rest.php/news/categories/');
    })
    .controller('NewsCtrl', function($scope, $location, $routeParams, $q, NewsService, AuthorsService, CategoriesService) {
        $scope.activeCategory = null;
        $scope.params = {};
        $scope.filterByCategory = function(category) {
            $scope.activeCategory = category;
            $scope.params.category_id = category.id;
            $scope.update($scope.params);
        }
        $scope.news = NewsService.get($routeParams);
        $scope.category = CategoriesService.get();

        $scope.update = function(params) {
            $scope.params = params;
            $scope.loading = true;
            $location.search(params);
            NewsService.get(params, function(result) {
                $scope.loading = false;
                $scope.news = result;
            });
        }
        $scope.checked = function() {
            var checked = [];
            angular.forEach($scope.news, function(item) {
                if (item.checked) {
                    checked.push(item.id);
                }
            });
            return checked;
        }
        $scope.delete = function() {
            console.info('delete');
        }

        $scope.users = function() {
            var q = $q.defer();
            AuthorsService.query(function(authors) {
                var result = [];
                angular.forEach(authors, function(author) {
                    result.push({
                        'id': author.id,
                        'title': author.login
                    });
                });
                q.resolve(result);
            });
            return q.promise;
        }
    })
    .controller('NewsArticleCtrl', function($scope, $routeParams, NewsService, LanguageService) {
        $scope.languages = LanguageService.query();
        $scope.article = NewsService.get({ id: $routeParams.id });
    });

});