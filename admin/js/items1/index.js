/**
 * Created by Рожнов on 15.11.2015.
 */


var myApp = angular.module('myApp', ["checklist-model"]);

myApp.controller('myCtrl', ['$scope', '$http',
    function($scope, $http, Company) {
        $scope.filter = {};
        $scope.init = (function(){
            $http.post('/filter/ajax').
                success(function(data, status, headers, config) {
                    $scope.filter = data;
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
                makeObj : function(parentKey, type){
                    $scope.obj.obj[parentKey] = [];
                    var children = $scope.obj.obj[parentKey]; //В этот массив будем вставлять объект

                    angular.forEach($scope.obj.help[parentKey], function(val, key){//Разворачиваем массив для того чтоб собрать модель
                        var obj = $scope.obj.helpers.pushChildren(val);//Клонируем модель
                        if(obj){
                            children.push(obj); //Добавляем модель в массив
                            if(type == 'sublist'){
                                children = obj.children; //Меняем ссылку на массив куда будем вставлять данные при следующем проходе
                            }
                        }
                    });

                    if(!$scope.obj.obj[parentKey].length){
                        delete $scope.obj.obj[parentKey];
                    }

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
                        var i = 0;
                        angular.forEach(filterObj, function($val, $key){
                            i++;
                        });

                        if(!i){newArr.push(value);}

                        var j = 0;
                        var compare = true;
                        angular.forEach(filterObj, function($val, $key){
                            var item = value[$key];
                            if(compare){
                                if(item != undefined){
                                    var itemFilter = value[$key];
                                    var filter = $val;
                                    compare = $scope.obj.helpers.compareFilters(itemFilter, filter); //сравнение фильтров
                                }
                                else{
                                    compare = false;
                                }
                            }
                            j++;
                            if(i == j){
                                if(compare){
                                    newArr.push(value);
                                }
                            }
                        });
                    });
                    $scope.cloneItems = newArr;
                },
                compareFilters : function(itemFilter, filter){
                    var rez = false;
                    if(filter.length>itemFilter.length){return rez;}

                    angular.forEach(filter, function(filterValue, filterKey){
                        rez = false;
                        angular.forEach(itemFilter, function(itemValue, itemKey){
                            if(itemValue.text == filterValue.text){
                                if(filterValue.children && filterValue.children.length){
                                    rez = $scope.obj.helpers.compareFilters(itemValue.children, filterValue.children);
                                }
                                else{
                                    rez = true;
                                }
                            }

                            if(itemFilter.length==(itemKey+1)){
                                if(!rez){return rez;}
                            }
                        });
                    });

                    return rez;
                }
            }
        };
    }
]);