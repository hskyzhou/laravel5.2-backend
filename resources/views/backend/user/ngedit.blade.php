<div ng-controller="UserUpdateController">
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
          <form action="{{route('admin.user.update', [$userInfo->encrypt_id])}}" class="form-horizontal" method="post">
            {{csrf_field()}}
            {!! method_field('put') !!}
            <div class="form-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group form-md-line-input has-success">
                    <label class="col-md-2 control-label" for="form_control_1">{{trans('database.user.name')}}</label>
                    <div class="col-md-8">
                      <div class="input-group has-success">
                          <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                          </span>
                          <input type="text" class="form-control" placeholder="{{trans('database.user.name')}}" name="name" value="{{$userInfo['name']}}">
                          <div class="form-control-focus"> </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group form-md-line-input has-success">
                    <label class="col-md-2 control-label" for="form_control_1">{{trans('database.user.email')}}</label>
                    <div class="col-md-8">
                      <div class="input-group has-success">
                          <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                          </span>
                          <input type="text" class="form-control" placeholder="{{trans('database.user.email')}}" name="email" value="{{$userInfo['email']}}">
                          <div class="form-control-focus"> </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group form-md-line-input has-success">
                    <label class="col-md-2 control-label" for="form_control_1">{{trans('database.user.status')}}</label>
                    <div class="col-md-8">
                      <select class="bs-select form-control form-filter" data-show-subtext="true" name="status">
                        <option value="{{config('backend.project.status.open')}}" data-content="{{trans('label.status.open')}} <span class='label lable-sm label-success'>OPEN </span>" @if($userInfo['status'] == config('backend.project.status.open')) selected @endif>{{trans('label.status.open')}}</option>
                        <option value="{{config('backend.project.status.close')}}" data-content="{{trans('label.status.close')}} <span class='label lable-sm label-danger'>CLOSE </span>" @if($userInfo['status'] == config('backend.project.status.close')) selected @endif>{{trans('label.status.close')}}</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group form-md-line-input has-success">
                    <label class="col-md-2 control-label" for="form_control_1">{{trans('database.user.role')}}</label>
                    <div class="col-md-8">
                      <select id="select2-multiple-input-lg" class="form-control input-lg select2-multiple" name="roles[]" multiple>
                        @forelse($roles as $role)
                          <option value="{{$role->slug}}" @if(in_array($role->slug, $userRoleSlugs)) selected @endif>{{$role->name}}</option>
                        @empty
                        @endforelse
                      </select>
                    </div>
                  </div>

                  <div class="form-group form-md-line-input has-success">
                    <div class="col-md-4 col-md-offset-2">
                      <button class="btn btn-success">提交</button>
                    </div>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="row margin-bottom-20">
                    <a class="btn btn-success" ng-click="selectAll()">全选</a>
                    <a class="btn btn-success" ng-click="selectInverse()">反选</a>
                  </div>
                  @if($permissions)
                    @foreach($permissions as $key => $permission)
                    <div class="col-md-4">
                      <div class="input-group">
                        <div class="icheck-list">
                          <label ng-click="parentCheckboxClick()">
                            <input type="checkbox" class="icheck parentcheckbox" data-checkbox="icheckbox_square-grey">{{trans('label.' . $key)}}
                          </label>
                          @if(is_array($permission))
                            @foreach($permission as $sonPermission)
                              <label style="margin-left:30px;">
                                <input type="checkbox" class="icheck soncheckbox" data-checkbox="icheckbox_square-grey" value="{{$sonPermission['value']}}" name="permissions[]" @if(in_array($sonPermission['value'], $userPermissionSlugs)) checked @endif>{{$sonPermission['name']}}
                              </label>
                            @endforeach
                          @endif   
                        </div>
                      </div>
                    </div>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>