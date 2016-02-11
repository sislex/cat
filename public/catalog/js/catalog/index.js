/**
 * Created by Рожнов on 15.11.2015.
 */

var myApp = angular.module('myApp', ["checklist-model", 'ngCookies']);

myApp.controller('myCtrl', ['$scope', '$http', '$cookies',
    function($scope, $http, $cookies) {
        $scope.filter = {};
        $scope.init = (function(){
            $http.post('/filter/ajax').
                success(function(data, status, headers, config) {
                    $scope.filter = data;
                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправки объекта');
                });
            $http.post('/admin/get/items', {name:'type_auto', check:'published'}).
                success(function(data, status, headers, config) {
                    $scope.items = data;
                    $scope.cloneItems = angular.copy($scope.items);
                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправки объекта');
                });

            if($cookies.get('wishList')){$scope.wishList = angular.fromJson($cookies.get('wishList'));}

            if($cookies.get('viewedList')){$scope.viewedList = angular.fromJson($cookies.get('viewedList'));}
            console.log($cookies.get('viewedList'));

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
                changeOrderValue : function(str){
                    $scope.order = str;
                },
                makeObj : function(parentKey, type){
                    $scope.obj.obj[parentKey] = [];

                    if(type == 'value'){
                        $scope.obj.obj[parentKey] = $scope.obj.help[parentKey];
                    }else{
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
                            if(angular.isArray($val)){
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

                            }else{
                                var newValue = 0;
                                if(angular.isObject(value[$key])){
                                    newValue = value[$key][0]['text'];
                                }
                                else{
                                    newValue = value[$key];
                                }
                                if($val['min']!=null && $val['min'] > newValue){
                                    compare = false;
                                }
                                if($val['max']!=null && $val['max'] < newValue){
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
                },

                addToWishList : function(obj){
                    if(!$scope.obj.helpers.checkId($scope.wishList, obj.item.id)){
                        var arr = $scope.wishList;
                        if(!angular.isArray(arr)){arr = [];}
                        var name = '';
                        if(obj.type_auto && obj.type_auto[0] && obj.type_auto[0].text){
                            name += obj.type_auto[0].text;
                            if(obj.type_auto[0].children && obj.type_auto[0].children[0] && obj.type_auto[0].children[0].text){
                                name += ' ' + obj.type_auto[0].children[0].text;
                                if(obj.type_auto[0].children[0].children && obj.type_auto[0].children[0].children[0] && obj.type_auto[0].children[0].children[0].text){
                                    name += ' ' + obj.type_auto[0].children[0].children[0].text;
                                }
                            }
                        }
                        var row = {
                            id: obj.item.id,
                            name: name,
                            price: obj.price,
                            image: obj.images[0]
                        };
                        arr.unshift(row);
                        var i = 0;
                        var newArr = [];
                        angular.forEach(arr, function(val, key){
                            i++;
                            if(i<=5){
                                newArr.push(val);
                            }
                        });

                        obj['wishList'] = true;
                        $cookies.put('wishList', angular.toJson(newArr));
                        $scope.wishList = newArr;
                    }else{
                        $scope.obj.helpers.deleteFromWishList(obj.item.id);
                    }
                },
                addToViewedList : function(obj){
                    if(!$scope.obj.helpers.checkId($scope.viewedList, obj.item.id)){
                        var arr = $scope.viewedList;
                        if(!angular.isArray(arr)){arr = [];}
                        var name = '';
                        if(obj.type_auto && obj.type_auto[0] && obj.type_auto[0].text){
                            name += obj.type_auto[0].text;
                            if(obj.type_auto[0].children && obj.type_auto[0].children[0] && obj.type_auto[0].children[0].text){
                                name += ' ' + obj.type_auto[0].children[0].text;
                                if(obj.type_auto[0].children[0].children && obj.type_auto[0].children[0].children[0] && obj.type_auto[0].children[0].children[0].text){
                                    name += ' ' + obj.type_auto[0].children[0].children[0].text;
                                }
                            }
                        }
                        var row = {
                            id: obj.item.id,
                            name: name,
                            price: obj.price,
                            image: obj.images[0]
                        };
                        arr.unshift(row);
                        var i = 0;
                        var newArr = [];
                        angular.forEach(arr, function(val, key){
                            i++;
                            if(i<=5){
                                newArr.push(val);
                            }
                        });

                        obj['viewedList'] = true;
                        $cookies.put('viewedList', angular.toJson(newArr));
                        $scope.viewedList = newArr;
                    }
                },
                deleteFromWishList:function(id){
                    var newArr = [];
                    angular.forEach($scope.wishList, function(val, key){
                        if(id != val.id){
                            newArr.push(val);
                        }
                    });
                    $cookies.put('wishList', angular.toJson(newArr));
                    $scope.wishList = newArr;
                },
                checkId : function(arr, id){
                    var result = false;
                    angular.forEach(arr, function(val, key){
                        if(id == val.id){
                            result = true;
                        }
                    });


                    return result;
                }
            }
        };
    }
]);