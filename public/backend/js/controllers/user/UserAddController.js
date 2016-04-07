angular.module('MetronicApp').controller('UserAddController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();

        $(".bs-select").selectpicker({
          iconBase:"fa",tickIcon:"fa-check"
        });

        $(".select2, .select2-multiple").select2({
          placeholder: '选择角色',
          width: null
        });

    });

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});