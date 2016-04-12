var TableAjax = function(){
	/*初始化表格*/
	var initTable = function(){
		var dt = $('#datatable_ajax');
		var ajax_datatable = $("#datatable_ajax").DataTable({
			"searching" : false,	
      "processing": true,
      "serverSide": true,
      "order" : [],
      "orderCellsTop": true,
      "autoWidth": false,
      "ajax": {
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
      "columns": [
        {
        	data: "id",
        	name : "id",
        	orderable : false,
      	},
        {
        	"data": "name",
        	"name" : "name",
        	"orderable" : false,
        },
        {
        	"data": "email",
        	"name": "email",
        	"orderable" : false,
        },
        { 
        	"data": "status",
        	"name": "status",
        	"orderable" : true,
        },
        { 
        	"data": "created_at",
        	"name": "created_at",
        	"orderable" : true,
        },
        { 
        	"data": "updated_at",
        	"name": "updated_at",
        	"orderable" : true,
        },
        { 
        	"data": "button",
        	"name": "button",
        	"orderable" : false,
        },
    	],
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