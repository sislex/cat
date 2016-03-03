var UITree = function () {
    var self = this;
    this.buttonObj = $("#saveFilter");
    this.token = this.buttonObj.attr('token');
    this.treeObj = $("#tree_3");
    this.tree = null;
    this.data = [{
        "text": "Parent Node",
        "children": [ {
            "text": "Sub Nodes",
            "children": [
                {"text": "Item 1"}
            ]
        }]
    }
    ];
    this.model = null;
    this.contextualMenuSample = function() {
        self.tree = self.treeObj.jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                "check_callback" : true,
                'data': data
            },
            "plugins" : [ "contextmenu", "dnd", "state", "types" ]
        });
        //var v = $("#tree_3").jstree(true).get_json('#tree_3', { 'flat': true });
        var v = self.tree.jstree();
        self.model = v._model;
        //console.log(self.model)
    };
    this.events = function(){
        self.buttonObj.bind('click', function(){
            var json = JSON.stringify(self.modelToJson(self.model.data));

            $.post(window.location.href, {'_token':self.token, 'json': json}, function (data) {
                //console.log(JSON.stringify(json));
                //console.log(data);
            });
        });
    };
    this.modelToJson = function(arr){
        var newArr = {};
        $.each(arr, function (key, value) {
            var parent = value.parents[0];
            if(parent){
                var text = value.text;
                if(!newArr[parent]){newArr[parent] = [];}
                newArr[parent].push({'text':text, 'key':key});
            }
        });

        return self.rezJson(newArr, '#');
    };
    this.rezJson = function(arr, k){
        var rezArr = [];
        $.each(arr, function (key, value) {
            if(key == k){
                $.each(value, function (key1, val) {
                    var obj = {}, children = [];
                    obj.text = val.text;
                    children = self.rezJson(arr, val.key);
                    if(children.length){obj.children = children;}
                    rezArr.push(obj);
                });
            }
        });

        return rezArr;
    };

    return {
        //main function to initiate the module
        init: function (data) {
            if(!data || !data.length || data == ''){data = [{text:'Авто транспорт'}];}
            self.data = data;

            self.contextualMenuSample();
            self.events();
        }
    };
}();