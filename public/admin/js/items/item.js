/**
 * Created by Рожнов on 15.11.2015.
 */

var myApp = angular.module('myApp', []);

myApp.controller('myCtrl', ['$scope', '$http',
    function($scope, $http, Company) {
        $scope.filter = {};
        $scope.func = (function(){
            //$http.post('/filter/ajax', {name:'type_auto'}).
            $http.post('/filter/ajax').
                success(function(data, status, headers, config) {
                    $scope.filter = data;
                    if($scope.obj.objJson!=''){$scope.obj.obj = angular.fromJson($scope.obj.objJson);}
                    $scope.obj.helpers.objToModel('type_auto', $scope.obj.obj.type_auto, $scope.filter.type_auto);
                    $scope.obj.helpers.objToModel('Тип кузова', $scope.obj.obj['Тип кузова'], $scope.filter['Тип кузова']);
                                console.log($scope.obj.help);
                }).
                error(function(data, status, headers, config) {
                    console.log('Ошибка при отправке объекта');
                });
        })();

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
            helpers : {
                jsonToObj : function(){

                },
                objToModel : function(key, arr, filter, i){//Разбор объекта из базы
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

                makeObj : function(parentKey){
                    $scope.obj.obj[parentKey] = [];
                    var children = $scope.obj.obj[parentKey]; //В этот массив будем вставлять объект

                    angular.forEach($scope.obj.help[parentKey], function(val, key){//Разворачиваем массив для того чтоб собрать модель
                        var obj = $scope.obj.helpers.pushChildren(val);//Клонируем модель
                        //debugger;
                        if(obj){
                            children.push(obj); //Добавляем модель в массив
                            children = obj.children; //Меняем ссылку на массив куда будем вставлять данные при следующем проходе
                        }
                    });

                    $scope.obj.objJson = angular.toJson($scope.obj.obj); // Серриализуем объект, его будем в базу ложить
                },
                pushChildren : function(obj){
                    if(obj){
                        obj = angular.copy(obj);
                        obj.children = [];
                        return obj;
                    }
                    return;
                }
            }
        };
    }
]);