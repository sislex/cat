/**
 * Created by sislex on 13.02.16.
 */

if(!myApp){
    var myApp = angular.module('myApp', ["checklist-model"]);
}

myApp.controller('lastCarsWidget', ['$scope', '$http',
    function($scope, $http) {
        $scope.filter = {};
        (function(){
            $http.post('/admin/get/items/8', {name:'type_auto', check:'published'}).
                success(function(data, status, headers, config) {
                    $scope.items = data;

                    //$scope.cloneItems = angular.copy($scope.items);

                    setTimeout(function(){
                        if(window.AUTOSTARS){window.AUTOSTARS.OwlCarousel($('#vehicle-slider'));}
                    }, 500);

                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправке объекта');
                });
        })();
    }
]);

myApp.controller('lastNewsWidget', ['$scope', '$http',
    function($scope, $http) {
        (function(){
            $http.post('/news/last', {type:'news', limit:6}).
                success(function(data, status, headers, config) {
                    $scope.news = data;
                    setTimeout(function(){
                        if(window.AUTOSTARS){window.AUTOSTARS.OwlCarousel($('#news-slider'));}
                    }, 500);
                }).
                error(function(data, status, headers, config) {
                    console.log('ошибка при отправке объекта');
                });
        })();
    }
]);

myApp.controller('lastBlogPostsWidget', ['$scope', '$http',
    function($scope, $http) {
        $scope.func = (function(){
            $http.post('/blog/last', {type:'blog', limit:5}).
            success(function(data, status, headers, config) {
                $scope.blog = data;
                console.log($scope.blog);
            }).
            error(function(data, status, headers, config) {
                console.log('ошибка при отправке объекта');
            });
        })();
    }
]);



if(!mailApp){
    var mailApp = angular.module('mailApp', []);
}

mailApp.controller('MailWidget', ['$scope', '$http',
    function($scope, $http) {
        $scope.func = (function(){
            $http.post('/mail/index', {}).
            success(function(data, status, headers, config) {
                $scope.result = data;
                console.log($scope.result);
            }).
            error(function(data, status, headers, config) {
                console.log('ошибка при отправке объекта.');
            });
        })();

        $scope.qwe = 123;
    }
]);

var divMyApp = document.getElementById('divMyApp');
var divMailApp = document.getElementById('divMailApp');

angular.element(document).ready(function(){
    angular.bootstrap(divMyApp, ['myApp']);
    angular.bootstrap(divMailApp, ['mailApp']);
});