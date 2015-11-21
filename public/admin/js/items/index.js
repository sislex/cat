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
                    $scope.cloneItems = angular.copy($scope.items);
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
                        //type_auto : [{"text":"Авто транспорт"}],
//                        img : [{"text":"Авто транспорт","children":[{"text":"Bmw","children":[{"text":"1","children":[]}]}]}]
            },
            helpers : {
                jsonToObj : function(){

                },
                makeObj : function(parentKey){
                    $scope.obj.obj[parentKey] = [];
                    var children = $scope.obj.obj[parentKey]; //В этот массив будем вставлять объект

                    angular.forEach($scope.obj.help[parentKey], function(val, key){//Разворачиваем массив для того чтоб собрать модель
                        var obj = $scope.obj.helpers.pushChildren(val);//Клонируем модель
                        if(obj){
                            children.push(obj); //Добавляем модель в массив
                            children = obj.children; //Меняем ссылку на массив куда будем вставлять данные при следующем проходе
                        }
                    });

                    $scope.obj.helpers.makeCloneItems();
                    //$scope.obj.objJson = angular.toJson($scope.obj.obj); // Серриализуем объект, его будем в базу ложить
                },
                pushChildren : function(obj){
                    if(obj){
                        obj = angular.copy(obj);
                        obj.children = [];
                        return obj;
                    }
                    return;
                },
                makeCloneItems : function(arr, dataArr){
                    var items = angular.copy($scope.items);
                    var dataArr = $scope.obj.obj;
                    var newArr = [];

                    angular.forEach(arr, function(value, key){
                        angular.forEach(dataArr, function(val){
                            if(val[key]){
                                //console.log(val);
                                newArr.push(val);
                            }
                        });
                    });
                    console.log(newArr);
                    //console.log($scope.obj.obj);
                },
                makeCloneItems1 : function(newArr, dataArr){

                }
            }
        };
    }
]);