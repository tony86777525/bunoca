<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class UpdateArrival extends AbstractTool
{

	public function getToken()
	{
		return csrf_token();
	}

	public function script()
	{
		return <<<EOT
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': '{$this->getToken()}'
	}
});
$(document).on('click', '.update_od_arrival', function() {
	swal.fire({
		title : '',
		text : '確定要配貨嗎?',
		type : 'warning',
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "確定!",
		cancelButtonText: "取消!"
	}).then((result) => {
		if(result.value){
			$.ajax({
				type : 'post',
				url: 'update_od_arrival',
				data : $('#od-' + $(this).attr("data-id")).serialize(),
				dataType: "json",
                beforeSend : function(){
                    $.blockUI({ message: '<h1><img src="/css/ajax_loading.gif" /> Loading... </h1>' });
                },
				success : function (res) {
				    $.unblockUI();
	                if(res.check){
	                    $.pjax.reload('#pjax-container');
	                    toastr.success(res.message);
	                }
				}
			});
		}
	});
});
EOT;
	}

	public function render()
	{
		Admin::script($this->script());
        return <<<EOT
<script src="/js/common/jquery.blockUI.js"></script>
EOT;
	}
}
