angular.module('MetronicApp').controller('UserAddController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();

        /*bs select*/
        $(".bs-select").selectpicker({
          iconBase:"fa",tickIcon:"fa-check"
        });

        /*select2-multiple*/
        $(".select2, .select2-multiple").select2({
          placeholder: '选择角色',
          tags: true
        });


        $scope.selectAll = function(){
            $('.parentcheckbox').prop('checked', false).iCheck('check');

            return false;
        };

        $scope.notSelectAll = function(){
            $('.parentcheckbox').each(function(){
                $this = $(this);
                var checkedNumber = $this.parents('.icheck-list').find('.soncheckbox:checked').length;
                $this.parents('.icheck-list').find('.soncheckbox').iCheck('toggle');
            });
            return false;
        };

        $('.parentcheckbox').on('ifChecked ifUnchecked', function(event){
            var $this = $(this);
            var $sonCheckbox = $this.parents('.icheck-list').find('.soncheckbox');
            if(event.type == 'ifChecked'){
                $sonCheckbox.iCheck('check');
            }else if(event.type == 'ifUnchecked'){
                $sonCheckbox.iCheck('uncheck');
            }
        });

        $('.soncheckbox').on('ifChecked ifUnchecked', function(event){
            var $this = $(this);
            var $parentCheckbox = $this.parents('.icheck-list').find('.parentcheckbox');
            if(event.type == 'ifChecked'){
                $parentCheckbox.prop('checked', true).iCheck('update');
            }else if(event.type == 'ifUnchecked'){
                var checkedNumber = $this.parents('.icheck-list').find('.soncheckbox:checked').length;
                if(checkedNumber == 0){
                    $parentCheckbox.prop('checked', false).iCheck('update');
                }
            }
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

    });

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});