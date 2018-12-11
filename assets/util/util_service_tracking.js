/* AJAX basic function */

function ajaxSubmit(varUrl, varData, element) {
	$.ajax({
		type : 'POST',
		url : varUrl,
		data : varData,
		success : function(data) {
			$('#' + element).html(data);
		}
	});
}

function ajaxLoad(toLoad, element) {

	$
			.ajax( {
				url : toLoad,
				success : function(data) {
					$('#' + element).fadeIn("slow").html(data);
				
				},
				error : function() {
					$('#' + element)
							.html(
								'<div align="center">error loading data, please try to refresh page</div>');
				}
			});
}


function ajaxFileUpload(varUrl, varId, additional)
{	
	$.ajaxFileUpload({
        url: varUrl,
        secureuri: false,
        fileElementId: varId,
        dataType: 'json',
        additional: additional,
        success: function (data, status)
        {	        		        	
			if(typeof(data.error) != 'undefined')
			{
				if(data.error != ''){
					alert(data.error);
					return false;
				}
				else{
					close_form();
					do_filter();
				}
				
		}
        },
        error: function (data, status, e)
        {
       	console.log(e);
            return  false;
        }
    });
	
	return false;
}

function loading_bar() {
	$(document)
			.ajaxStart(
					function() {
						$("#loading_bar")
								.fadeIn("slow")
								.html(
										"<img src='"
												+ base_url
												+ "/asset/images/loading_bar.gif' width='75'> execute your order . . . ");
					}).ajaxStop(function() {
				$("#loading_bar").html("");
			});
}

function loading_none() {
	$(document).ajaxStart(function() {
		$("#loading_bar").html("");
	}).ajaxStop(function() {
		$("#loading_bar").html("");
	});
}

function doSubmit(id) {
	if(id == 'add')
		show_form('executor', form);	
	else
		show_form('executor', form + id);
	
	$('html, body').animate({
		scrollTop : 0
	}, "5000");
}

function position_selector(id) {
	ajaxSubmit(controller + '/position_selector', 'id=' + id, 'form');
}

function find_open(id) {
	var left = (screen.width / 2) - (800 / 2);
	var top = (screen.height / 2) - (500 / 2);

	window
			.open(
					base_url + 'index.php/filter/' + id,
					'',
					'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=800, height=500, top='
							+ top + ', left=' + left);
}

function set_find(id, value, to_fill) {
	window.opener.do_select(id, value, to_fill);
	window.close();
}

function doTransaction(b, id) {
	var dataString = $("#frm_form").serialize() + "&id=" + id;
	ajaxSubmit(controller + b, dataString, 'form');
}

function delete_image() {
	a = confirm('Delete existing image ? ');

	if (a) {
		$('#up_image')
				.html(
						"<div style='width : 150px; height : 150px;text-align : center;border : 1px solid #aaa; background : #eee'>No Images</div>");
		$('#delete_status').val('delete');
	}
}

function delete_pdf() {
	a = confirm('Delete existing brochure ? ');

	if (a) {
		$('#up_pdf').html("<div>No Brochure</div>");
		$('#delete_status_pdf').val('delete');
	}
}

function cek_detail() {
	var serial_no = document.getElementById('serial_no');
	var condition = document.getElementById('condition');

	if (serial_no.value == '') {
		alert('SERIAL No. MUST BE FILLED !');
		return false;
	}
	if (condition.value == '') {
		alert('CONDITION MUST BE FILLED !');
		return false;
	}

	return true;
}

function push_session() {
	loading_bar();
	var dataString = $("#frm_table").serialize();

	a = cek_detail();
	if (a == true){
		ajaxSubmit(controller + 'add_list/', dataString, 'table');
		return true; 
	}
	
	return false;
}

function add_customer(){
	window.open(base_url + 'index.php/service_tracking/customer/form/special_add','','width=800 height=500')
}

function link(to_link) {
	location.href = base_url + 'index.php/' + to_link;
}

function setClr() {
	var aInputs = $('#frm_form').find(
			'input[type=text],input[type=password],textarea,select');
	for ( var i in aInputs) {
		if (i % 1 == 0) {
			var a = $(aInputs[i]).attr('id');
			$("#" + a).val('');
		}
	}
}

function do_chk_all() {
	var chk = $("#general_chk").is(':checked');

	if (chk == true)
		$(".dg_check").attr('checked', true);
	else
		$(".dg_check").attr('checked', false);
}

function do_check(id, bg) {

	var st = $('#dg_' + id).is(':checked');

	if (st == true) {
		$('#dg_' + id).attr('checked', false);
		$('#tr_' + id).attr('style', 'background : ' + bg + ';height : 30px');
	} else {
		$('#dg_' + id).attr('checked', true);
		$('#tr_' + id).attr('style', 'background : #f8f99f; height : 30px');
	}
}

function dg_mouse_in(id) {
	$('#tr_' + id).attr('style', 'background : #aaaaaa; height : 30px');
}

function dg_mouse_out(id, bg) {

	var st = $('#dg_' + id).is(':checked');

	if (st == true)
		$('#tr_' + id).attr('style', 'background : #f8f99f; height : 20px');
	else
		$('#tr_' + id).attr('style', 'background : ' + bg + '; height : 20px');
}

function chk_coll() {
	var base = $('.dataGrid').find(':checkbox');
	var chk_arr = '';

	var x = 0;
	for ( var i in base) {
		if (i % 1 == 0) {
			var cls = $(base[i]).attr('class');
			var sta = $(base[i]).attr('checked');

			if (cls == 'dg_check' && sta == true) {
				var ttl = $(base[i]).attr('title');
				chk_arr += '&id[' + x + ']=' + ttl;
				x++;
			}
		}
	}

	return chk_arr;
}

function do_delete() {
	var chk = chk_coll();

	if (chk != "") {
		a = confirm('delete data ?');
		
		if (a == true) {
			if (chk !== "")
				ajaxSubmit(controller + 'delete', chk, 'dummy');
		}
	} else
		alert("You're not select any data yet !");
}

function doSorting(page, sort, dir, limit, setting, is_report){
	var loader = 'table';
	var dataString = "page=" + page + "&sort=" + sort + "&dir=" + dir + "&limit=" + limit + setting;
	
	if(is_report != undefined){
		dataString += "&is_report=" + is_report;
		loader = 'executor';
	}
	
	loading_bar();
	ajaxSubmit(table, dataString, loader);
}

function show_form(id,address)
{

	if(address != undefined)
		var link_to = base_url + 'index.php/' + address;
	else
		var link_to = controller + id;
	
	ajaxLoad(link_to,id);
	
	$("#block_layer").css({"display" : "block", opacity : 0.7, "width" : $(document).width(),"height" : $(document).height()});	
}

function close_form()
{
	$(".std_form").fadeOut("slow");	
	$('#block_layer').fadeOut();
}

function show_popUp(address) {
	
	var left = (document.width / 2) - (800 / 2);
	var top = (document.height / 2) - (500 / 2);

	window.open(address,'','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=800, height=500' + ',top='+ top + ', left=' + left);
}

function do_filter(is_report){
	var tbl_dir = document.getElementById("dir").value;
	var tbl_srt = document.getElementById("sort").value;

	var setting = get_fltr();

	loading_bar();

	if(is_report == undefined)
		doSorting('1', tbl_srt, tbl_dir, setting, setting);
	else
		doSorting('1', tbl_srt, tbl_dir, setting, setting, is_report);		
}

function show_quotation(id){
	var left = (screen.width / 2) - (800 / 2);
	var top = (screen.height / 2) - (500 / 2);

	window.open(base_url + 'index.php/service_tracking/trans_service/quotation/' + id,'','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=800, height=500' + ',top='+ top + ', left=' + left);
}

function create_form(id){
	window.open(base_url + 'index.php/report/quotation/index/' + id, '_blank');
}

function open_ticket(id){
	window.open(base_url + 'index.php/report/ticket/index/' + id, '_blank');
}
