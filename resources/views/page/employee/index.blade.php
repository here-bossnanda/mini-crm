@extends('layouts.app')
@push('style')
<style media="screen">
.modal-body{
  max-height: calc(100vh - 200px);
  overflow-y: auto;
}
</style>
@endpush
@section('content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<!-- Page-Title -->
<div class="page-title-box">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h4 class="page-title mb-1">@lang('dashboard.employee-master')</h4>
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">@lang('dashboard.employee-master')</li>
        </ol>
      </div>
    </div>

  </div>
</div>
<!-- end page title end breadcrumb -->
<div class="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header">
            <div class="float-left">
              <button onclick="addForm()" type="button" class="btn btn-primary btn-block"><i class="fa fa-plus-square"> @lang('dashboard.employee-modal-add-title')</i> </button>
            </div>
            <div class="float-left ml-2">
                <button onclick="refreshForm()" type="button" class="btn btn-info btn-flat "><i class="fas fa-recycle"> Refresh</i> </button>
              </div>
            
          </div>
          <div class="card-body">
            <h4 class="header-title">@lang('dashboard.employee-master')</h4>
            <table class="table table-bordered dt-responsive table-striped nowrap table-employee" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                <tr>
                  <th>No</th>
                  <th>@lang('dashboard.employee-first-name')</th>
                  <th>@lang('dashboard.employee-last-name')</th>
                  <th>Email</th>
                  <th>@lang('dashboard.employee-phone')</th>
                  <th>@lang('dashboard.employee-company')</th>
                  <th>@lang('dashboard.employee-action')</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- end row -->

  </div>
  <!-- end container-fluid -->
</div>
@include('page.employee.modal')
@endsection
@push('scripts')
<script type="text/javascript">
  var table, save_method;
  $(function(){
    table = $('.table-employee').DataTable({
        "language": {
        "processing": '<div class="spinner-border text-info m-2" role="status"><span class="sr-only"></span></div></br><div>@lang('dashboard.employee-table-await')</div>',
        "paginate": {
          "previous": "<i class='uil uil-angle-left'>",
            "next": "<i class='uil uil-angle-right'>"
            }
          },
          "buttons":[ 'colvis' ],
          "drawCallback": function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
          },
      "processing" :true,
      "serverSide" : true,
      "ajax":{
        "url" : "{{route('employee.data')}}",
        "type" : "GET"
      }
    });
    $('#modal-employee form').validator().on('submit', function(e){
      if(!e.isDefaultPrevented()){
        var id = $('#id').val();
        if (save_method == "add")
        url = "{!! route('employee.store') !!}";
        else url = "employee/"+id;
        $.ajax({
          url : url,
          type : "POST",
          data : new FormData($(".form")[0]),
          dataType : 'JSON',
          async: false,
          processData: false,
          contentType:false,
          success : function(data){
              if (save_method == "add"){
                toastr.success('@lang('dashboard.message-success')', 'Success Alert', {timeOut: 4000});
              }else{
                toastr.success('@lang('dashboard.message-update')', 'Success Alert', {timeOut: 4000});
              }
            $('#modal-employee').modal('hide');
            table.ajax.reload( null, false );
          },
          error : errorRequestHandling
        });
        return false;
      }
    });

    $("#company_id").select2({
      allowClear: true,
      width: 'resolve', // need to override the changed default
      dropdownParent: $("#modal-employee"),
      placeholder: 'Pilih Company',
      width: 'resolve',
      ajax: {
        url: '{{route('employee.select2company')}}',
        dataType: 'json',
        data: function (params) {
          return {
            q: $.trim(params.term),
            page: params.page || 1
          };
        },
        processResults: function (data) {
          data.page = data.page || 1;
          return {
            results: data.items.map(function (item) {
              return {
                id: item.id,
                text:item.name
              };
            }),
            pagination: {
              more: data.pagination
            }
          }
        },
        cache: true
      }
    });
  });

  function errorRequestHandling(data){
  if(!data.responseJSON){
    toastr.error('@lang('dashboard.message-error')', 'Error Alert', {timeOut: 4000});
    return;
  }
  
  let response = data.responseJSON.errors;
  $.each(response, (idx, errors) => {
    $.each(errors, (idx, error) => {
      toastr.warning(error, 'Warning Alert', {timeOut: 4000});
    });
  });
}

  function readURL() {
    var input = this;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#previewfoto').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $(".uploads").change(function() {
    readURL(this);
  });

  function refreshForm(){
  table.ajax.reload( null, false );
  }


  function addForm(){
    save_method = "add";
    $('input[name = _method]').val('POST');
    $('#modal-employee').modal('show');
    $('#modal-employee form')[0].reset();
    $('.modal-title').text('@lang('dashboard.employee-modal-add-title')');
    $('#first_name').prop('readonly',false);
    $('#last_name').prop('readonly',false);
    $('#email').prop('readonly',false);
    $('#phone').prop('readonly',false);
    $('.isGone').show();
    $('#company_id').empty();

  }

  function viewForm(id){
    $('input[name = _method]').val('GET');
    $('#modal-employee form')[0].reset();
    $('.isGone').hide();
    $.ajax({
      url: 'employee/'+id,
      type: "GET",
      dataType: "JSON",
      success : function(data){
        $('#modal-employee').modal('show');
        $('.modal-title').text('@lang('dashboard.employee-modal-show-title')');
        $('#first_name').prop('readonly',true);
        $('#last_name').prop('readonly',true);
        $('#email').prop('readonly',true);
        $('#phone').prop('readonly',true);
        $('#id').val(data.employee.id);
        $('#first_name').val(data.employee.first_name);
        $('#last_name').val(data.employee.last_name);
        $('#email').val(data.employee.email);
        $('#phone').val(data.employee.phone);
        $('select#company_id').select2('trigger','select',{'data':{'id':data.employee.company_id,'text':data.employee.company.name}}); 
      },
      error : function(){
        toastr.warning('Tidak dapat menampilkan data!', 'Error Alert', {timeOut: 3000});
      }
    });
  }

  function editForm(id){
    save_method = "edit";
    $('input[name = _method]').val('PATCH');
    $('#modal-employee form')[0].reset();
    $('.isGone').show();
    $.ajax({
      url: 'employee/'+id+'/edit',
      type: "GET",
      dataType: "JSON",
      success : function(data){
        $('#modal-employee').modal('show');
        $('.modal-title').text('@lang('dashboard.employee-modal-edit-title')');
        $('#first_name').prop('readonly',false);
        $('#last_name').prop('readonly',false);
        $('#email').prop('readonly',false);
        $('#phone').prop('readonly',false);
        $('#id').val(data.employee.id);
        $('#first_name').val(data.employee.first_name);
        $('#last_name').val(data.employee.last_name);
        $('#email').val(data.employee.email);
        $('#phone').val(data.employee.phone);
        $('select#company_id').select2('trigger','select',{'data':{'id':data.employee.company_id,'text':data.employee.company.name}}); 
      },
      error : function(){
        toastr.warning('Tidak dapat menampilkan data!', 'Error Alert', {timeOut: 3000});
      }
    });
  }
  function deleteData(id){
    swal({
      title: "@lang('dashboard.modal-delete-title')",
      text: "@lang('dashboard.modal-delete-info')",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: 'employee/' + id,
          type: 'DELETE',
          data: {
            '_token': $('input[name=_token]').val(),
          },
          success: function(data){
              swal("Done!", "@lang('dashboard.message-success-deleted')", "success");
              toastr.success('@lang('dashboard.message-success-deleted')', 'Success Alert', {timeOut: 4000});
              table.ajax.reload();
          },
          error : function(data){
            swal("Error deleting!", "Please try again", "error");
            toastr.warning('Tidak dapat menghapus data!', 'Error Alert', {timeOut: 3000});
          }
        });
      }
    })
  }
</script>
@endpush
