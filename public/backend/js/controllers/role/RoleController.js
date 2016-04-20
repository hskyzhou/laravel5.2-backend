angular.module('MetronicApp').controller('RoleController', function($rootScope, $scope, $http, $timeout, $compile) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        /*初始化表格*/
        $scope.jsVars.title = 'asfasfsf';
        // console.log(this.jsVars);
        TableAjax.init($scope.js.vars);

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