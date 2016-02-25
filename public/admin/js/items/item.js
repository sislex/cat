/**
 * Created by Рожнов on 15.11.2016.
 */

if(!myApp){
    var myApp = angular.module('myApp', ["checklist-model"]);

    myApp.filter('ceil', function() {
        return function(input) {
            return Math.ceil(input);
        };
    });
}

myApp.controller('myCtrl', ['$scope', '$http',
    function($scope, $http) {
        $scope.filter = {};
        $scope.func = (function(){
            $http.post('/filter/ajax').
                success(function(data, status, headers, config) {
                    $scope.filter = data;
                    if($scope.obj.objJson!=''){$scope.obj.obj = angular.fromJson($scope.obj.objJson);}
                    $scope.obj.obj.id = $scope.obj.id;
                    $scope.obj.obj.price = $scope.obj.price;

                    if(window.Cookie){
                        if(window.Cookie.get('wishList')){$scope.wishList = angular.fromJson(window.Cookie.get('wishList'));}
                        if(window.Cookie.get('viewedList')){$scope.viewedList = angular.fromJson(window.Cookie.get('viewedList'));}
                        $scope.obj.helpers.addToViewedList($scope.obj.obj);
                    }

                    angular.forEach($scope.obj.obj, function(value, key){
                        $scope.obj.helpers.objToModel(key, $scope.obj.obj[key], $scope.filter[key]);
                    });
                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправке объекта');
                });


            $http.post('/specifications/ajax').
                success(function(data, status, headers, config) {
                    $scope.specifications = data;
                    if($scope.obj.specificationsJson!=''){$scope.obj.specifications = angular.fromJson($scope.obj.specificationsJson);}
                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправке объекта');
                });
            //console.log($scope.obj.helpers.addToViewedList);
            //$scope.obj.helpers.addToViewedList(123);
        })();
        $scope.roles = [
            'guest',
            'user',
            'customer',
            'admin'
        ];
        $scope.user = {
            roles: ['user']
        };
        $scope.obj = {
            filter : {
                //type_auto:[],
                //'Тип кузова':[]
            },
            help : {
                //type_auto:[],
                //'Тип кузова':[]
            },
            objJson : '',
            obj : {
                //type_auto : [{"text":"Авто транспорт","children":[{"text":"Bmw","children":[{"text":"1","children":[]}]}]}],
                //img : [{"text":"Авто транспорт","children":[{"text":"Bmw","children":[{"text":"1","children":[]}]}]}]
            },
            specifications:{},
            helpers : {
                trigger : function(obj, key){
                    if(obj[key]){obj[key] = false;}
                    else{obj[key] = true;}
                },
                specificationsCheck : function(specificationGroup){
                    var rez = false;
                    if(!angular.isUndefined(specificationGroup.children) && (angular.isArray(specificationGroup.children) || angular.isObject(specificationGroup.children))){
                        angular.forEach(specificationGroup.children, function(child){
                            if(!angular.isUndefined($scope.obj.specifications[specificationGroup.name]) && $scope.obj.specifications[specificationGroup.name][child]){
                                rez = true;
                                return;
                            }
                        });
                    }

                    return rez;
                },
                jsonToObj : function(){

                },
                objToModel : function(key, arr, filter, i){//Разбор объекта из базы
                    if(angular.isString(arr) || angular.isNumber(arr)){
                        $scope.obj.help[key] = arr;

                        return;
                    }
                    if(!i){i = 0;}
                    if(!$scope.obj.help[key]){$scope.obj.help[key] = [];}
                    angular.forEach(arr, function(value){
                        angular.forEach(filter, function(val){
                            if(val.text == value.text){
                                $scope.obj.help[key][i] = val;
                                i++;
                                if(value.children && value.children.length){
                                    $scope.obj.helpers.objToModel(key, value.children, val.children, i);
                                }
                            }
                        });
                    });

                    if(i == 1){
                        $scope.obj.objJson = angular.toJson($scope.obj.obj); // Серриализуем объект, его будем в базу ложить
                    }
                },

                makeObj : function(parentKey, type){
                    $scope.obj.obj[parentKey] = [];
                    var children = $scope.obj.obj[parentKey]; //В этот массив будем вставлять объект


                    if(angular.isNumber($scope.obj.help[parentKey])){
                        $scope.obj.help[parentKey] = parseInt($scope.obj.help[parentKey]);
                        $scope.obj.obj[parentKey] = $scope.obj.help[parentKey];
                    }
                    else if(angular.isString($scope.obj.help[parentKey])){
                        $scope.obj.obj[parentKey] = $scope.obj.help[parentKey];
                    }else{
                        angular.forEach($scope.obj.help[parentKey], function(val, key){//Разворачиваем массив для того чтоб собрать модель
                            var obj = $scope.obj.helpers.pushChildren(val);//Клонируем модель
                            //debugger;
                            if(obj){
                                children.push(obj); //Добавляем модель в массив
                                if(type == 'sublist'){
                                    children = obj.children; //Меняем ссылку на массив куда будем вставлять данные при следующем проходе
                                }
                            }
                        });
                    }

                    $scope.obj.objJson = angular.toJson($scope.obj.obj); // Серриализуем объект, его будем в базу ложить
                },
                pushChildren : function(obj){
                    if(obj){
                        obj = angular.copy(obj);
                        obj.children = [];
                        return obj;
                    }
                    return;
                },
                makeSpecificationsObj : function(obj){
                    var newObj = {};
                    //console.log($scope.obj.specifications);
                    angular.forEach($scope.specifications, function(value, key){
                        if($scope.obj.helpers.checkSpecificationGroup($scope.obj.specifications, value.name)){
                            if(!angular.isUndefined(value.children)){
                                angular.forEach(value.children, function(v, k){
                                    if($scope.obj.helpers.checkSpecificationGroup($scope.obj.specifications[value.name], v)){
                                        //console.log($scope.obj.specifications[value.name][v]);
                                        if(angular.isUndefined(newObj[value.name])){
                                            newObj[value.name] = {};
                                        }
                                        newObj[value.name][v] = $scope.obj.specifications[value.name][v];
                                    }
                                });
                            }


                        }
                    });
                    $scope.obj.specifications = newObj;

                    $scope.obj.specificationsJson = angular.toJson($scope.obj.specifications);
                },
                checkSpecificationGroup : function(arr, name, level){
                    var rez = false;
                    if(angular.isUndefined(level)){
                        level = 0;
                    }

                    angular.forEach(arr, function(value, key){
                        if(level == 0){
                            if(key == name){
                                if(!angular.isUndefined(value) && value!=''){
                                    rez = true;
                                    //console.log(value);
                                }
                                return;
                            }
                        }
                    });

                    return rez;
                },

                addToWishList : function(obj){
                    if(!$scope.obj.helpers.checkId($scope.wishList, obj.id)){
                        var arr = $scope.wishList;
                        if(!angular.isArray(arr)){arr = [];}
                        var name = '';
                        if(obj.type_auto && obj.type_auto[0] && obj.type_auto[0].text){
                            if(obj.type_auto[0].children && obj.type_auto[0].children[0] && obj.type_auto[0].children[0].text){
                                name += ' ' + obj.type_auto[0].children[0].text;
                                if(obj.type_auto[0].children[0].children && obj.type_auto[0].children[0].children[0] && obj.type_auto[0].children[0].children[0].text){
                                    name += ' ' + obj.type_auto[0].children[0].children[0].text;
                                }
                            }
                        }
                        if(obj['God_vypuska'][0]['text']){name += ' ' + obj['God_vypuska'][0]['text'];}
                        var row = {
                            id: obj.id,
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
                        window.Cookie.set('wishList', angular.toJson(newArr));
                        //$cookies.put('wishList', angular.toJson(newArr));
                        $scope.wishList = newArr;
                    }else{
                        $scope.obj.helpers.deleteFromWishList(obj.id);
                    }
                },
                deleteFromWishList:function(id){
                    var newArr = [];
                    angular.forEach($scope.wishList, function(val, key){
                        if(id != val.id){
                            newArr.push(val);
                        }
                    });
                    window.Cookie.set('wishList', angular.toJson(newArr));
                    //$cookies.put('wishList', angular.toJson(newArr));
                    $scope.wishList = newArr;
                },
                addToViewedList : function(obj){
                    $scope.viewedList = $scope.obj.helpers.removeRowById($scope.viewedList, obj.id);
                    var arr = $scope.viewedList;
                    if(!angular.isArray(arr)){arr = [];}
                    var name = '';
                    if(obj.type_auto && obj.type_auto[0] && obj.type_auto[0].text){
                        if(obj.type_auto[0].children && obj.type_auto[0].children[0] && obj.type_auto[0].children[0].text){
                            name += ' ' + obj.type_auto[0].children[0].text;
                            if(obj.type_auto[0].children[0].children && obj.type_auto[0].children[0].children[0] && obj.type_auto[0].children[0].children[0].text){
                                name += ' ' + obj.type_auto[0].children[0].children[0].text;
                            }
                        }
                    }
                    if(obj['God_vypuska'][0]['text']){name += ' ' + obj['God_vypuska'][0]['text'];}
                    var row = {
                        id: obj.id,
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
                    window.Cookie.set('viewedList', angular.toJson(newArr));

                    $scope.viewedList = newArr;
                },
                removeRowById : function(arr, id){
                    var newArr = [];
                    angular.forEach(arr, function(val, key){
                        if(id != val.id){
                            newArr.push(val);
                        }
                    });

                    return newArr;
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