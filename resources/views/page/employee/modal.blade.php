<div class="modal fade" id="modal-employee" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="form form-horizontal" data-toggle="validator"  method="post" enctype="multipart/form-data">
          {{csrf_field()}} {{method_field('POST')}}
          <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"> &times;</span> </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
              <label for="first_name" class="col-md-5 control-label" >First Name</label>
              <div class="col-md-12">
                <input type="text" id="first_name" class="form-control" placeholder="First Name" name="first_name" autofocus required>
                <span class="help-block with-errors"></span>
              </div>
            </div>
            <div class="form-group">
              <label for="last_name" class="col-md-5 control-label" >Last Name</label>
              <div class="col-md-12">
                <input type="text" id="last_name" class="form-control" placeholder="Last Name" name="last_name" autofocus required>
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
              <label for="phone" class="col-md-5 control-label" >Phone</label>
              <div class="col-md-12">
                <input type="text" id="phone" class="form-control" placeholder="Phone" name="phone" autofocus>
                <span class="help-block with-errors"></span>
              </div>
            </div>
            <div class="form-group">
                <label for="company_id" class="col-md-5 control-label">Company</label>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-lg-12">
                      <select class="form-control"  name="company_id" id="company_id" style="width:100%;"></select>
                      <span class="help-block with-errors"></span>
                    </div>
                  </div>
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
  