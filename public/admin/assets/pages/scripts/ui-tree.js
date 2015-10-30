var UITree = function () {
    var contextualMenuSample = function() {
        var data = $("#tree_3").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                // so that create works
                "check_callback" : true,
                'data': [{
                    "text": "Parent Node",
                    "children": [ {
                        "text": "Sub Nodes",
                        "children": [
                            {"text": "Item 1"}
                        ]
                    }]
                }
                ]
            },
            "plugins" : [ "contextmenu", "dnd", "state", "types" ]
        });
        var v = $("#tree_3").jstree(true).get_json();

        console.log(v)
    }

    return {
        //main function to initiate the module
        init: function () {
            contextualMenuSample();
        }
    };
}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        UITree.init();
    });
}