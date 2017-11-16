@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="col-md-10">
      <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">Add Establishment</h3>
          </div>
          <form role="form" id="add-establishment" action="/save_establishment" method="post">
              {{ csrf_field() }}
              <div class="box-body">
                  <div class="row">

                      <div class="col-md-6 form-group">
                          <label for="name">Establishment Name</label>
                          <input id="name" name="name" class="form-control" placeholder="Establishment Name">
                      </div>
                      <div class="col-md-6 form-group">
                          <label for="address">Address</label>
                          <input id="address" name="address" type="text" class="form-control" placeholder="Establishment Address">
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6 form-group">
                      <label for="geo_tag">Establishment GeoTag</label>
                      <input id="geo_tag" name="geo_tag" type="text" class="form-control" placeholder="Establishment Geo Tag">
                  </div>
                  <div class="col-md-6 form-group">
                      <label for="liqour_license">Liqour License</label>
                      <input id="liqour_license" name="liqour_license" type="text" class="form-control" placeholder="Liqour License">
                  </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6 form-group">
                      <label for="address">HS License</label>
                      <input id="hs_license" name="hs_license" class="form-control" type="text" placeholder="HS License">
                  </div>
                  <div class="col-md-6 form-group">
                      <label for="contact_person">Contact Person</label>
                      <input id="contact_person" name="contact_person" class="form-control" type="text" placeholder="Contact Person">
                  </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6 form-group">
                      <label for="contact_number">Contact Number</label>
                      <input id="contact_number" name="contact_number" type="tel" class="form-control" placeholder="Contact Number">
                  </div>

                      <div class="col-md-6 form-group">
                      <label for="last_inspection_date">Last Inspection Date</label>
                      <input id="last_inspection_date" name="last_inspection_date" type="date" class="form-control" >
                  </div>
                  </div>
                <div class="row">
                      <div class="col-md-6 form-group">
                      <label for="establishment_url">Establishment URL</label>
                      <input id="establishment_url" name="establishment_url" class="form-control" type="text" placeholder="Establishment URL">
                  </div>
                  <div class="col-md-6 form-group">
                      <label for="status">Status</label>
                      <input id="status" name="status" class="form-control" type="text" placeholder="Establishment Status">
                  </div>
                  </div>
                  <div class="box-footer">
                      <center>
                      <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Save</button>
                      </center>
                  </div>
              </div>
          </form>
      </div>
        </div>
    </div>
@endsection


