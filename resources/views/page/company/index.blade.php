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
        <h4 class="page-title mb-1">@lang('dashboard.company-master')</h4>
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">@lang('dashboard.company-master')</li>
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
              <button onclick="addForm()" type="button" class="btn btn-primary btn-block"><i class="fa fa-plus-square"> @lang('dashboard.company-add')</i> </button>
            </div>
            <div class="float-left ml-2">
              <button onclick="refreshForm()" type="button" class="btn btn-info btn-flat "><i class="fas fa-recycle"> Refresh</i> </button>
            </div>

          </div>
          <div class="card-body">
            <h4 class="header-title">@lang('dashboard.company-master')</h4>
            <table class="table table-bordered dt-responsive table-striped nowrap table-company" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Website</th>
                  <th>@lang('dashboard.company-action')</th>
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
@include('page.company.modal')
@endsection
@push('scripts')
<script type="text/javascript">
  var table, save_method;
  $(function(){
    table = $('.table-company').DataTable({
      "language": {
        "processing": '<div class="spinner-border text-info m-2" role="status"><span class="sr-only"></span></div></br><div>@lang('dashboard.company-table-await')</div>',
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
            "url" : "{{route('company.data')}}",
            "type" : "GET"
          }
        });
        $('#modal-company form').validator().on('submit', function(e){
          if(!e.isDefaultPrevented()){
              var id = $('#id').val();
              if (save_method == "add"){
              sendMailAnimation()
              url = "{!! route('company.store') !!}";
              }else{
              url = "company/"+id;
              }
              $.ajax({
                url : url,
                type : "POST",
                data : new FormData($(".form")[0]),
                dataType : 'JSON',
                async: true,
                processData: false,
                contentType:false,
                success : function(data){
                  if (save_method == "add"){
                    toastr.success('@lang('dashboard.message-success')', 'Success Alert', {timeOut: 4000});
                  }else{
                    toastr.success('@lang('dashboard.message-update')', 'Success Alert', {timeOut: 4000});
                  }
                  swal("Done!", "Email telah terkirim!", "success");
                  $('#modal-company').modal('hide');
                  table.ajax.reload( null, false );
                },
                error : errorRequestHandling
              });
              return false;
            }
          });
        });

        function errorRequestHandling(data){
          if(!data.responseJSON){
            toastr.error('@lang('dashboard.message-error')', 'Error Alert', {timeOut: 4000});
            return;
          }
          
          swal("Gagal!", "Email gagal terkirim!", "error");
          let response = data.responseJSON.errors;
          $.each(response, (idx, errors) => {
            $.each(errors, (idx, error) => {
              toastr.warning(error, 'Warning Alert', {timeOut: 4000});
            });
          });
        }

        function sendMailAnimation(){
          swal({
                title: "@lang('dashboard.mail-sending')",
                text: "@lang('dashboard.mail-description')",
                imageUrl: "{{asset('storage/assets/images/send-mail.gif')}}",
                showConfirmButton: false,
                allowOutsideClick: false,
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
          $('#modal-company').modal('show');
          $('#modal-company form')[0].reset();
          $('.modal-title').text('@lang('dashboard.company-modal-add-title')');
          $('#previewfoto').attr('src', '{{asset('storage/assets/images/users/default.png')}}');
          $('#name').prop('readonly',false);
          $('#email').prop('readonly',false);
          $('#website').prop('readonly',false);
          $('.isGone').show();
        }

        function viewForm(id){
          $('input[name = _method]').val('GET');
          $('#modal-company form')[0].reset();
          $('.isGone').hide();
          $.ajax({
            url: 'company/'+id,
            type: "GET",
            dataType: "JSON",
            success : function(data){
              $('#modal-company').modal('show');
              $('.modal-title').text('@lang('dashboard.company-modal-show-title')');
              $('#name').prop('readonly',true);
              $('#email').prop('readonly',true);
              $('#website').prop('readonly',true);
              $('#id').val(data.company.id);
              $('#name').val(data.company.name);
              $('#email').val(data.company.email);
              $('#website').val(data.company.website);
              if ($.trim(data.company.logo)) {
                $("#previewfoto").attr('src','{{asset('storage/assets/images/perusahaan')}}/'+data.company.logo);
              }else{
                $('#previewfoto').attr('src', '{{asset('storage/assets/images/users/default.png')}}');
              }
            },
            error : function(){
              toastr.warning('@lang('dashboard.message-error')', 'Error Alert', {timeOut: 3000});
            }
          });
        }

        function editForm(id){
          save_method = "edit";
          $('input[name = _method]').val('PATCH');
          $('#modal-company form')[0].reset();
          $('#name').prop('readonly',false);
          $('#email').prop('readonly',false);
          $('#website').prop('readonly',false);
          $('.isGone').show();
          $.ajax({
            url: 'company/'+id+'/edit',
            type: "GET",
            dataType: "JSON",
            success : function(data){
              $('#modal-company').modal('show');
              $('.modal-title').text('@lang('dashboard.company-modal-edit-title')');
              $('#id').val(data.company.id);
              $('#name').val(data.company.name);
              $('#email').val(data.company.email);
              $('#website').val(data.company.website);
              if ($.trim(data.company.logo)) {
                $("#previewfoto").attr('src','{{asset('storage/assets/images/perusahaan')}}/'+data.company.logo);
              }else{
                $('#previewfoto').attr('src', '{{asset('storage/assets/images/users/default.png')}}');
              }
            },
            error : function(){
              toastr.warning('@lang('dashboard.message-error')', 'Error Alert', {timeOut: 3000});
            }
          });
        }
        function deleteData(id){
          swal({
            title: '@lang('dashboard.modal-delete-title')',
            text: '@lang('dashboard.modal-delete-info')',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: 'company/' + id,
                type: 'DELETE',
                data: {
                  '_token': $('input[name=_token]').val(),
                },
                success: function(data){
                  swal("Done!", "@lang('dashboard.message-success-deleted')!", "success");
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
