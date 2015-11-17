/**
 * Created by Рожнов on 15.11.2015.
 */

var myApp = angular.module('myApp', []);

myApp.controller('myCtrl', ['$scope', '$http',
    function($scope, $http, Company) {
        $scope.filter = {};
        $scope.init = (function(){
            $http.post('/filter/ajax', {name:'type_auto'}).
                success(function(data, status, headers, config) {
                    $scope.filter.type_auto = data;
//                                console.log($scope.obj.obj);
                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправки объекта');
                });
            $http.post('/admin/get/items', {name:'type_auto'}).
                success(function(data, status, headers, config) {
                    $scope.items = data;
                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправки объекта');
                });
        })();

        $scope.obj = {
            filter : {type_auto : []},
            help : {type_auto:[]},
            objJson : '',
            obj : {
//                        type_auto : [{"text":"Авто транспорт","children":[{"text":"Bmw","children":[{"text":"1","children":[]}]}]}],
//                        img : [{"text":"Авто транспорт","children":[{"text":"Bmw","children":[{"text":"1","children":[]}]}]}]
            },
            helpers : {
                jsonToObj : function(){

                },
                makeObj : function(parentKey){

                }
            }
        };
    }
]);