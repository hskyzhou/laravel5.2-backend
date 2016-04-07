<div class="row">
  <div class="col-md-12">
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet light portlet-fit portlet-form bordered">
      <div class="portlet-title">
        <div class="caption">
          <i class=" icon-layers font-green"></i>
          <span class="caption-subject font-green sbold uppercase">Validation States</span>
        </div>
        <div class="actions">
          <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
            <i class="icon-cloud-upload"></i>
          </a>
          <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
            <i class="icon-wrench"></i>
          </a>
          <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
            <i class="icon-trash"></i>
          </a>
        </div>
      </div>

      <div class="portlet-body">
        <form action="#" class="form-horizontal">
          <div class="form-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group form-md-line-input has-success">
                  <label class="col-md-2 control-label" for="form_control_1">{{trans('database.user.name')}}</label>
                  <div class="col-md-4">
                    <div class="input-group has-success">
                        <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="{{trans('database.user.name')}}">
                        <div class="form-control-focus"> </div>
                    </div>
                  </div>
                </div>

                <div class="form-group form-md-line-input has-success">
                  <label class="col-md-2 control-label" for="form_control_1">{{trans('database.user.password')}}</label>
                  <div class="col-md-4">
                    <div class="input-group has-success">
                        <span class="input-group-addon">
                          <i class="fa fa-lock"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="{{trans('database.user.password')}}">
                        <div class="form-control-focus"> </div>
                    </div>
                  </div>
                </div>

                <div class="form-group form-md-line-input has-success">
                  <label class="col-md-2 control-label" for="form_control_1">{{trans('database.user.email')}}</label>
                  <div class="col-md-4">
                    <div class="input-group has-success">
                        <span class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="{{trans('database.user.email')}}">
                        <div class="form-control-focus"> </div>
                    </div>
                  </div>
                </div>

                <div class="form-group form-md-line-input has-success">
                  <label class="col-md-2 control-label" for="form_control_1">{{trans('database.user.status')}}</label>
                  <div class="col-md-2">
                    <select class="bs-select form-control form-filter" data-show-subtext="true" name="status">
                      <option value="{{config('backend.project.status.open')}}" data-content="{{trans('label.status.open')}} <span class='label lable-sm label-success'>OPEN </span>">{{trans('label.status.open')}}</option>
                      <option value="{{config('backend.project.status.close')}}" data-content="{{trans('label.status.close')}} <span class='label lable-sm label-danger'>CLOSE </span>">{{trans('label.status.close')}}</option>
                    </select>
                  </div>
                </div>

                <div class="form-group form-md-line-input has-success">
                  <label class="col-md-2 control-label" for="form_control_1">{{trans('database.user.role')}}</label>
                  <div class="col-md-4">
                    <select id="select2-multiple-input-lg" class="form-control input-lg select2-multiple" multiple>
                      @forelse($roles as $role)
                        <option value="{{$role->slug}}">{{$role->name}}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                  <div class="input-group">
                    @if($permissions)
                      @foreach($permissions as $key => $permission)
                        <div class="icheck-list">
                          <label>
                            <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-grey">{{trans('label.' . $key)}}
                          </label>
                          @if(is_array($permission))
                            @foreach($permission as $sonPermission)
                              <label style="margin-left:30px;">
                                <input type="checkbox" class="icheck" data-checkbox="icheckbox_square-grey" value="{{$sonPermission['value']}}">{{$sonPermission['name']}}
                              </label>
                            @endforeach
                          @endif   
                        </div>
                      @endforeach
                    @endif
                  </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>