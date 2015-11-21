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
                makeCloneItems : function(){
                    var items = angular.copy($scope.items);
                    var filterObj = $scope.obj.obj;
                    var newArr = [];

                    angular.forEach(items, function(value, key){
                        angular.forEach(filterObj, function($val, $key){
                            if(value[$key]){
                                var itemFilter = value[$key];
                                var filter = $val;
                                var compare = $scope.obj.helpers.compareFilters(itemFilter, filter); //сравнение фильтров
                                if(compare){
                                    newArr.push(value);
                                }
                            }
                        });
                    });
                    $scope.cloneItems = newArr;
                    //console.log(newArr);
                    //console.log($scope.obj.obj);
                },
                compareFilters : function(itemFilter, filter){
                    var rez = false;
                    angular.forEach(itemFilter, function(itemValue, itemKey){
                        angular.forEach(filter, function(filterValue, filterKey){
                            if(itemValue.text == filterValue.text){
                                if(filterValue.children && filterValue.children.length){
                                    rez = $scope.obj.helpers.compareFilters(itemValue.children, filterValue.children);
                                }
                                else{
                                    rez = true;
                                }
                            }
                        });
                    });

                    return rez;
                }
            }
        };
    }
]);