angular.module('MetronicApp').controller('UserAddController', ['$rootScope', '$scope', '$http', '$timeout', function($rootScope, $scope, $http, $timeout) {
    
    $scope.$on('$viewContentLoaded', function() {   
        $scope.name = '';
        $scope.email = '';
        $scope.password = '';
        $scope.status = 1;
        $scope.roles = [];
        $scope.permissions = [];

        // initialize core components
        App.initAjax();

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
                $scope.permissions.push(this.value);
                $parentCheck.prop('checked', true).iCheck('update');
            }else if(event.type == 'ifUnchecked'){
                $scope.permissions.splice($scope.permissions.indexOf(this.value),1);
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
            $http({
              method: 'POST',
              url: storeUrl,
              data : {
                name : this.name,
                email : this.email,
                password : this.password,
                status : this.status,
                roles : this.roles,
                permissions : this.permissions,
              },
            }).then(function(response) {
                // this callback will be called asynchronously
                // when the response is available
                var data = response.data;
                if(data.result){
                    $.bootstrapGrowl(data.message, {
                      ele: 'body', // which element to append to
                      type: 'danger', // (null, 'info', 'danger', 'success')
                      offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                      align: 'center', // ('left', 'right', or 'center')
                      width: 450, // (integer, or 'auto')
                      delay: 5000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                      allow_dismiss: true, // If true then will display a cross to close the popup.
                      stackup_spacing: 10 // spacing between consecutively stacked growls.
                    });
                }

            }, function(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                if(response.status == 422){
                    var data = response.data;
                    for(var i in data){
                        $.bootstrapGrowl(data[i], {
                          ele: 'body', // which element to append to
                          type: 'danger', // (null, 'info', 'danger', 'success')
                          offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                          align: 'center', // ('left', 'right', or 'center')
                          width: 450, // (integer, or 'auto')
                          delay: 5000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                          allow_dismiss: true, // If true then will display a cross to close the popup.
                          stackup_spacing: 10 // spacing between consecutively stacked growls.
                        });
                    }
                }
            });
            return false;
        }
    });

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
}]);