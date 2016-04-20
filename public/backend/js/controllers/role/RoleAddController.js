angular.module('MetronicApp').controller('RoleAddController', ['$rootScope', '$scope', '$http', '$timeout', 'SweetAlert', '$location', function($rootScope, $scope, $http, $timeout, SweetAlert, $location) {

  $scope.$on('$viewContentLoaded', function() {   
    $scope.userData = {};
    
    resetValue();
    // initialize core components
    App.initAjax();

    /*bs select*/
    $(".bs-select").selectpicker({
      iconBase:"fa",
      tickIcon:"fa-check"
    });

    $('#statusselect').selectpicker('val', $scope.userData.status);

    /*select2-multiple*/
    $(".select2, .select2-multiple").select2({
      placeholder: '选择角色',
      allowClear: true,
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
            $scope.userData.permissions.push(this.value);
            $parentCheck.prop('checked', true).iCheck('update');
        }else if(event.type == 'ifUnchecked'){
            $scope.userData.permissions.splice($scope.userData.permissions.indexOf(this.value),1);
            var length = $this.parents('.icheck-list').find('.soncheckbox:checked').length;
            if(length == 0){
                $parentCheck.prop('checked', false).iCheck('update');
            }
        }
    });

    /*bs-select 修改*/
    $("#statusselect").on('changed.bs.select', function(event){
        $this = $(this);
        $scope.userData.status = $this.val();
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
          url: this.jsVars.storeUrl,
          data : {
            name : $scope.userData.name,
            slug : $scope.userData.slug,
            description : $scope.userData.description,
            status : $scope.userData.status,
            level : $scope.userData.level,
            permissions : $scope.userData.permissions,
          },
        }).then(function(response) {
            // this callback will be called asynchronously
            // when the response is available
            var data = response.data;
            if(data.result){
                /*弹出用户是否需要继续添加，或者返回列表页*/
                SweetAlert.swal({
                   title: data.title,
                   text: data.text,
                   type: "success",
                   showCancelButton: true,
                   confirmButtonColor: "#DD6B55",confirmButtonText: data.confirm,
                   cancelButtonText: data.cancel,
                   closeOnConfirm: true,
                   closeOnCancel: true}, 
                    function(isConfirm){ 
                       if (isConfirm) {
                            resetValue();
                            $(".soncheckbox").iCheck('uncheck');//清空权限选择
                            $(".select2, .select2-multiple").val('').trigger('change.select2');//清空角色选择
                            $('#statusselect').selectpicker('val', $scope.userData.status);//重置为开启
                       } else {
                            $location.path(data.indexUrlPath);
                       }
                    }
                );
            }
        }, function(response) {
            // called asynchronously if an error occursee
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

  function resetValue(){
    $scope.userData.name = '';
    $scope.userData.slug = '';
    $scope.userData.description = '';
    $scope.userData.status = 1;
    $scope.userData.level = 100;
    $scope.userData.permissions = [];
  }
}]);