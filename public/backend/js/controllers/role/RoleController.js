angular.module('MetronicApp').controller('RoleController', function($rootScope, $scope, $http, $timeout, $compile) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        /*初始化表格*/
        TableAjax.init();

        $(".bs-select").selectpicker({
        	iconBase:"fa",tickIcon:"fa-check"
       	});

       	$(".date-picker").datepicker({
       		format:"yyyy/mm/dd",
       		autoclose:true,
       		todayBtn:true,
       	});
    });

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});