/**
 * Created by Рожнов on 15.11.2015.
 */



var myApp = angular.module('myApp', ["checklist-model"]);


myApp.controller('widgets', ['$scope', '$http',
    function($scope, $http) {
        $scope.filter = {};
        $scope.func = (function(){
            $http.post('/admin/get/items/8', {name:'type_auto', check:'published'}).
                success(function(data, status, headers, config) {
                    $scope.items = data;
                    console.log($scope.items);

                    //$scope.cloneItems = angular.copy($scope.items);

                    setTimeout(function(){
                        if(window.AUTOSTARS){window.AUTOSTARS.OwlCarousel();}
                    }, 500);

                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправки объекта');
                });
        })();
        $scope.obj = {

        };
    }
]);

myApp.controller('myCtrl', ['$scope', '$http',
    function($scope, $http) {
        $scope.filter = {};
        $scope.func = (function(){
            //$http.post('/filter/ajax', {name:'type_auto'}).
            $http.post('/filter/ajax').
                success(function(data, status, headers, config) {
                    $scope.filter = data;
                    if($scope.obj.objJson!=''){$scope.obj.obj = angular.fromJson($scope.obj.objJson);}

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
                }
            }
        };
    }
]);