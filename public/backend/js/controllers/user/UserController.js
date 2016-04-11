angular.module('MetronicApp').controller('UserController', function($rootScope, $scope, $http, $timeout, SweetAlert) {
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

        $(document).on('click', '.userdelete', function(){
          SweetAlert.swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this imaginary file!",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: true }, 
            function(isConfirm){ 
              if (isConfirm) {
                SweetAlert.swal("Deleted!", "Your imaginary file has been deleted.", "success");
              }
          });
        });
    });

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});