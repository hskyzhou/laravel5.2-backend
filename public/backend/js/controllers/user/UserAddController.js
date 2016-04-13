angular.module('MetronicApp').controller('UserAddController', ['$rootScope', '$scope', '$http', '$timeout', function($rootScope, $scope, $http, $timeout) {
    
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();

        $scope.name = '';

        /*bs select*/
        $(".bs-select").selectpicker({
          iconBase:"fa",tickIcon:"fa-check"
        });

        /*select2-multiple*/
        $(".select2, .select2-multiple").select2({
          placeholder: '选择角色',
        });

        /*icheck选择*/
        $(".parentcheckbox").on('ifChecked ifUnchecked', function(event){
          var $this = $(this);
          if(event.type == 'ifChecked'){
            $this.parents('.icheck-list').find('.soncheckbox').iCheck('check');
          }else if(event.type = 'ifUnchecked'){
            $this.parents('.icheck-list').find('.soncheckbox').iCheck('uncheck');
          }
        });

        $(".soncheckbox").on('ifChecked ifUnchecked', function(event){
            var $this = $(this);
            var $parentCheck = $this.parents('.icheck-list').find('.parentcheckbox');
            if(event.type == 'ifChecked'){
                $parentCheck.prop('checked', true).iCheck('update');
            }else if(event.type == 'ifUnchecked'){
                var length = $this.parents('.icheck-list').find('.soncheckbox:checked').length;
                if(length == 0){
                    $parentCheck.prop('checked', false).iCheck('update');
                }
            }
        });

        /*全选 , 反选*/
        $scope.selectAll = function(){
            $(".parentcheckbox").prop('checked', false).iCheck('check');
        };

        $scope.selectInverse = function(){
            $('.soncheckbox').iCheck('toggle');
        };

        $scope.create = function(){
            console.log($scope.name);
            return false;
            // $http({
            //   method: 'POST',
            //   url: '/'
            // }).then(function(response) {
            //     // this callback will be called asynchronously
            //     // when the response is available

            // }, function(response) {
            //     // called asynchronously if an error occurs
            //     // or server returns response with an error status.
            // });
        }
    });

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
}]);