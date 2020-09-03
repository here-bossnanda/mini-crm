<div class="modal fade" id="modal-company" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="form form-horizontal" data-toggle="validator"  method="post" enctype="multipart/form-data">
          {{csrf_field()}} {{method_field('POST')}}
          <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"> &times;</span> </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id" name="id" >
            <div class="form-group text-center">
              <div class="profile-image"> <img src="{{asset('storage/assets/images/users/default.png')}}" id="previewfoto" class="rounded-circle header-profile-user-detail" alt=""> </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-md-5 control-label" >Name</label>
              <div class="col-md-12">
                <input type="text" id="name" class="form-control" placeholder="Name" name="name" autofocus required>
                <span class="help-block with-errors"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-md-5 control-label" >Email</label>
              <div class="col-md-12">
                <input type="email" id="email" class="form-control" placeholder="Email" name="email" autofocus>
                <span class="help-block with-errors"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="website" class="col-md-5 control-label" >website</label>
              <div class="col-md-12">
                <input type="text" id="website" class="form-control" placeholder="website" name="website" autofocus>
                <span class="help-block with-errors"></span>
              </div>
            </div>
            <div class="form-group isGone">
              <label for="logo" class="col-md-5 control-label" >Logo</label>
              <div class="col-md-12">
                <input type="file" class="uploads form-control" id="logo" name="logo">
                <span class="help-block with-errors"></span>
              </div>
            </div>
          </div>
          <div class="modal-footer isGone">
            <button type="submit" class="btn btn-primary">
              <span class='glyphicon glyphicon-check'></span> Simpan</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">
                <span class='glyphicon glyphicon-remove'></span> Batal
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  