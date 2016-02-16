/**
 * Created by sislex on 13.02.16.
 */
    if(!myApp){
        var myApp = angular.module('myApp', ["checklist-model"]);
    }

myApp.controller('lastCarsWidget', ['$scope', '$http',
    function($scope, $http) {
        $scope.filter = {};
        $scope.func = (function(){
            $http.post('/admin/get/items/8', {name:'type_auto', check:'published'}).
                success(function(data, status, headers, config) {
                    $scope.items = data;
                    console.log($scope.items);

                    //$scope.cloneItems = angular.copy($scope.items);

                    //setTimeout(function(){
                    //    if(window.AUTOSTARS){window.AUTOSTARS.OwlCarousel();}
                    //}, 500);

                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправке объекта');
                });
        })();
    }
]);

myApp.controller('lastNewsWidget', ['$scope', '$http',
    function($scope, $http) {
        $scope.func = (function(){
            $http.post('/news/last', {type:'news', limit:3}).
                success(function(data, status, headers, config) {
                    $scope.news = data;
                    console.log($scope.news);
                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправке объекта');
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
                console.log('Ошибка при отправке объекта');
            });
        })();
    }
]);