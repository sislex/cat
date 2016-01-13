/**
 * Created by Рожнов on 15.11.2015.
 */


angular.module('checklist-model', [])
    .directive('checklistModel', ['$parse', '$compile', function($parse, $compile) {
        // contains
        function contains(arr, item, comparator) {
            if (angular.isArray(arr)) {
                for (var i = arr.length; i--;) {
                    if (comparator(arr[i], item)) {
                        return true;
                    }
                }
            }
            return false;
        }

        // add
        function add(arr, item, comparator) {
            arr = angular.isArray(arr) ? arr : [];
            if(!contains(arr, item, comparator)) {
                arr.push(item);
            }
            return arr;
        }

        // remove
        function remove(arr, item, comparator) {
            if (angular.isArray(arr)) {
                for (var i = arr.length; i--;) {
                    if (comparator(arr[i], item)) {
                        arr.splice(i, 1);
                        break;
                    }
                }
            }
            return arr;
        }

        // http://stackoverflow.com/a/19228302/1458162
        function postLinkFn(scope, elem, attrs) {
            // exclude recursion, but still keep the model
            var checklistModel = attrs.checklistModel;
            attrs.$set("checklistModel", null);
            // compile with `ng-model` pointing to `checked`
            $compile(elem)(scope);
            attrs.$set("checklistModel", checklistModel);

            // getter / setter for original model
            var getter = $parse(checklistModel);
            var setter = getter.assign;
            var checklistChange = $parse(attrs.checklistChange);
            var checklistBeforeChange = $parse(attrs.checklistBeforeChange);

            // value added to list
            var value = attrs.checklistValue ? $parse(attrs.checklistValue)(scope.$parent) : attrs.value;


            var comparator = angular.equals;

            if (attrs.hasOwnProperty('checklistComparator')){
                if (attrs.checklistComparator[0] == '.') {
                    var comparatorExpression = attrs.checklistComparator.substring(1);
                    comparator = function (a, b) {
                        return a[comparatorExpression] === b[comparatorExpression];
                    };

                } else {
                    comparator = $parse(attrs.checklistComparator)(scope.$parent);
                }
            }

            // watch UI checked change
            scope.$watch(attrs.ngModel, function(newValue, oldValue) {
                if (newValue === oldValue) {
                    return;
                }

                if (checklistBeforeChange && (checklistBeforeChange(scope) === false)) {
                    scope[attrs.ngModel] = contains(getter(scope.$parent), value, comparator);
                    return;
                }

                setValueInChecklistModel(value, newValue);

                if (checklistChange) {
                    checklistChange(scope);
                }
            });

            function setValueInChecklistModel(value, checked) {
                var current = getter(scope.$parent);
                if (angular.isFunction(setter)) {
                    if (checked === true) {
                        setter(scope.$parent, add(current, value, comparator));
                    } else {
                        setter(scope.$parent, remove(current, value, comparator));
                    }
                }

            }

            // declare one function to be used for both $watch functions
            function setChecked(newArr, oldArr) {
                if (checklistBeforeChange && (checklistBeforeChange(scope) === false)) {
                    setValueInChecklistModel(value, scope[attrs.ngModel]);
                    return;
                }
                scope[attrs.ngModel] = contains(newArr, value, comparator);
            }

            // watch original model change
            // use the faster $watchCollection method if it's available
            if (angular.isFunction(scope.$parent.$watchCollection)) {
                scope.$parent.$watchCollection(checklistModel, setChecked);
            } else {
                scope.$parent.$watch(checklistModel, setChecked, true);
            }
        }

        return {
            restrict: 'A',
            priority: 1000,
            terminal: true,
            scope: true,
            compile: function(tElement, tAttrs) {
                if ((tElement[0].tagName !== 'INPUT' || tAttrs.type !== 'checkbox') && (tElement[0].tagName !== 'MD-CHECKBOX') && (!tAttrs.btnCheckbox)) {
                    throw 'checklist-model should be applied to `input[type="checkbox"]` or `md-checkbox`.';
                }

                if (!tAttrs.checklistValue && !tAttrs.value) {
                    throw 'You should provide `value` or `checklist-value`.';
                }

                // by default ngModel is 'checked', so we set it if not specified
                if (!tAttrs.ngModel) {
                    // local scope var storing individual checkbox model
                    tAttrs.$set("ngModel", "checked");
                }

                return postLinkFn;
            }
        };
    }]);

var myApp = angular.module('myApp', ["checklist-model"]);

myApp.controller('myCtrl', ['$scope', '$http',
    function($scope, $http, Company) {
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