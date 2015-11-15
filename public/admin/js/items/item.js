/**
 * Created by ������ on 15.11.2015.
 */

var myApp = angular.module('myApp', []);

myApp.controller('myCtrl', ['$scope', '$http',
    function($scope, $http, Company) {
        $scope.filter = {};
        $scope.func = (function(){
            $http.post('/filter/ajax', {name:'type_auto'}).
                success(function(data, status, headers, config) {
                    $scope.filter.type_auto = data;
                    if($scope.obj.objJson!=''){$scope.obj.obj = angular.fromJson($scope.obj.objJson);}
                    $scope.obj.helpers.objToModel('type_auto', $scope.obj.obj.type_auto, $scope.filter.type_auto);
//                                console.log($scope.obj.obj);
                }).
                error(function(data, status, headers, config) {
                    console.log('������ ��� �������� �������');
                });
        })();

        $scope.obj = {
            filter : {type_auto : []},
            help : {type_auto:[]},
            objJson : '',
            obj : {
//                        type_auto : [{"text":"���� ���������","children":[{"text":"Bmw","children":[{"text":"1","children":[]}]}]}],
//                        img : [{"text":"���� ���������","children":[{"text":"Bmw","children":[{"text":"1","children":[]}]}]}]
            },
            helpers : {
                jsonToObj : function(){

                },
                objToModel : function(key, arr, filter, i){//������ ������� �� ����
                    if(!i){i = 0;}
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
                        $scope.obj.objJson = angular.toJson($scope.obj.obj); // ������������ ������, ��� ����� � ���� ������
                    }
                },

                makeObj : function(parentKey){
                    $scope.obj.obj[parentKey] = [];
                    var children = $scope.obj.obj[parentKey]; //� ���� ������ ����� ��������� ������

                    angular.forEach($scope.obj.help[parentKey], function(val, key){//������������� ������ ��� ���� ���� ������� ������
                        var obj = $scope.obj.helpers.pushChildren(val);//��������� ������
                        if(obj){
                            children.push(obj); //��������� ������ � ������
                            children = obj.children; //������ ������ �� ������ ���� ����� ��������� ������ ��� ��������� �������
                        }
                    });

                    $scope.obj.objJson = angular.toJson($scope.obj.obj); // ������������ ������, ��� ����� � ���� ������
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