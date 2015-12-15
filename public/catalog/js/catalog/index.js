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