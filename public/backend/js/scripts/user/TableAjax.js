var TableAjax = function(){
	/*初始化表格*/
	var initTable = function(){
		var dt = $('#datatable_ajax');
		var ajax_datatable = $("#datatable_ajax").DataTable({
			searching : false,	
      processing: true,
      serverSide: true,
      order : [],
      orderCellsTop: true,
      autoWidth: false,
      ajax: {
      	url : "/admin/user/ajuserlist",
      	type: "GET",
      	data: function ( d ) {
      	  d.name = $('.filter input[name="name"]').val();
      	  d.email = $('.filter input[name="email"]').val();
      	  d.status = $('.filter select[name="status"] option:selected').val();
      	  d.created_at_from = $('.filter input[name="created_at_from"]').val();
      	  d.created_at_to = $('.filter input[name="created_at_to"]').val();
      	  d.updated_at_from = $('.filter input[name="updated_at_from"]').val();
      	  d.updated_at_to = $('.filter input[name="updated_at_to"]').val();
      	},
      },
      columns: [
        {
        	data: "encrypt_id",
        	name : "encrypt_id",
          orderable : false,
          type : 'html',
          render : function(data, type, full, meta){
            console.log(full);
            return '<input type="checkbox" data-id="'+data+'" class="icheck soncheckbox" data-checkbox="icheckbox_square-grey">';
          },
        },
        {
          data: "name",
          name : "name",
          className : 'text-center',
          orderable : false,
        },
        {
          data: "email",
          name: "email",
          className : 'text-center',
          orderable : false,
        },
        { 
          data: "status",
          name: "status",
          className : 'text-center',
          orderable : true,
        },
        { 
          data: "created_at",
          name: "created_at",
          className : 'text-center',
          orderable : true,
        },
        { 
          data: "roles",
          name: "roles",
          className : 'text-center',
          orderable : false,
        },
        { 
          data: "permissions",
          name: "permissions",
          className : 'text-center',
          type : "html",
          orderable : false,
        },
        { 
        	data: "button",
          name: "button",
          className : 'text-center',
          type : 'html',
        	orderable : false,
        },
    	],
      drawCallback: function( settings ) {
        ajax_datatable.$('.popovers').popover( {
          html : true
        });
        
        ajax_datatable.$('.tooltips').tooltip( {
          html : true
        }); 
        
        $('.soncheckbox').iCheck({
          checkboxClass: 'icheckbox_square-grey',
        });

      },
    });

    dt.on('click', '.filter-submit', function(){
      ajax_datatable.ajax.reload();
    });

    dt.on('click', '.filter-cancel', function(){
      $('textarea.form-filter, select.form-filter, input.form-filter', dt).each(function() {
          $(this).val("");
      });

      $('select.form-filter').selectpicker('refresh');

      $('input.form-filter[type="checkbox"]', dt).each(function() {
          $(this).attr("checked", false);
      });
      ajax_datatable.ajax.reload();
    });

    /*删除用户*/
    $(document).on('click', '.userdelete', function(){
      var $this = $(this);
      swal({
        title: title,
        text: text,
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
        closeOnConfirm: false,
        closeOnCancel: true },
        function(isConfirm){ 
          if (isConfirm) {
            /*发起删除请求*/
            $.ajax({
              url: $this.data('url'),
              type: 'DELETE',
              dataType: 'json',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
            })
            .done(function(data) {
              if(data.result){
                ajax_datatable.ajax.reload();
                swal(data.title, data.message, "success");
              }else{
                swal(data.title, data.message, "error");
              }
            })
            .fail(function(response) {
              if(response.status == '405'){
                swal('删除失败', '请求出错', "error"); 
              }

              var data = response.data;
              if(response.status == '422'){
                swal(data.title, data.message, "error");
              }
            });
          }
      });
    });

    /*icheck*/
    $(".parentcheckbox").on('ifChecked ifUnchecked', function(event){
      var $this = $(this);
      if(event.type == 'ifChecked'){
        $('.soncheckbox').iCheck('check');
      }else if(event.type = 'ifUnchecked'){
        $('.soncheckbox').iCheck('uncheck');
      }
    });

    /*删除多个用户*/
    $(document).on('click', '.moreuserdelete', function(){
      var $this = $(this);
      swal({
        title: title,
        text: text,
        type: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
        closeOnConfirm: false,
        closeOnCancel: true },
        function(isConfirm){ 
          if (isConfirm) {
            /*发起删除请求*/
            var ids = [];
            $(".soncheckbox:checked").each(function(index){
              $checkbox = $(this);
              id = $checkbox.data('id');
              ids.push(id);
            });

            $.ajax({
              url: $this.data('url'),
              data:{
                ids: ids,
              },
              type: 'DELETE',
              dataType: 'json',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
            })
            .done(function(data) {
              if(data.result){
                ajax_datatable.ajax.reload();
                swal(data.title, data.message, "success");
              }else{
                swal(data.title, data.message, "error");
              }
            })
            .fail(function(response) {
              if(response.status == '405'){
                swal('删除失败', '请求出错', "error"); 
              }

              var data = response.data;
              if(response.status == '422'){
                swal(data.title, data.message, "error");
              }
            });
          }
      });
    });

	}

	return {
		init : function(){
			initTable();
		}
	}
}();