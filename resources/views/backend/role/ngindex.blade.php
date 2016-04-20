<div ng-controller="RoleController">
  <div ng-init="jsVars = {{$jsVars}}"></div>
  <input type="text" ng-model="jsVars.title">
  <div class="row">
    <div class="col-md-12">
      <!-- Begin: life time stats -->
      <div class="portlet light portlet-fit portlet-datatable bordered">
        <div class="portlet-title">
          <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">{{trans('label.role.list')}}</span>
          </div>
          <div class="actions">
            <div class="btn-group">
              {{-- 添加按钮 --}}
              {!! $createButton !!}
            </div>
          </div>
        </div>
        <div class="portlet-body">
          <div class="table-container">
            <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
              <thead>
                <tr role="row" class="heading">
                  <th>
                    <input type="checkbox" class="icheck parentcheckbox" data-checkbox="icheckbox_square-grey">
                  </th>
                  <th>{{trans('database.role.name')}}</th>
                  <th width="10%">{{trans('database.role.status')}}</th>
                  <th>{{trans('database.role.created_at')}}</th>
                  <th>{{trans('label.action')}}</th>
                </tr>
                <tr role="row" class="filter">
                  <td></td>
                  <td>
                    <div class="form-group form-md-line-input">
                      <div class="col-md-12">
                        <div class="input-group has-success">
                          <span class="input-group-addon">
                            <i class="fa fa-role"></i>
                          </span>
                          <input type="text" class="form-control form-filter" placeholder="{{trans('database.role.name')}}" name="name">
                          <div class="form-control-focus"> </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="form-group form-md-line-input">
                      <select class="bs-select form-control form-filter" data-show-subtext="true" name="status">
                        <option value="{{config('backend.project.status.select')}}" data-content="{{trans('label.status.select')}} <span class='label lable-sm label-default'>select </span>">{{trans('label.status.select')}}</option>
                        <option value="{{config('backend.project.status.open')}}" data-content="{{trans('label.status.open')}} <span class='label lable-sm label-success'>OPEN </span>">{{trans('label.status.open')}}</option>
                        <option value="{{config('backend.project.status.close')}}" data-content="{{trans('label.status.close')}} <span class='label lable-sm label-danger'>CLOSE </span>">{{trans('label.status.close')}}</option>
                      </select>
                    </div>                                
                  </td>
                  <td>
                    <div class="col-md-12">
                      <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                        <input type="text" class="form-control form-filter" readonly placeholder="From" name="created_at_from">
                        <span class="input-group-btn">
                          <button class="btn default" type="button">
                            <i class="fa fa-calendar"></i>
                          </button>
                        </span>
                      </div>
                      <span class="help-block"></span>
                    </div>

                    <div class="col-md-12">
                      <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                        <input type="text" class="form-control form-filter" readonly placeholder="To"  name="created_at_to">
                        <span class="input-group-btn">
                          <button class="btn default" type="button">
                            <i class="fa fa-calendar"></i>
                          </button>
                        </span>
                      </div>
                      <span class="help-block"></span>
                    </div>
                  </td>
                  <td>
                    <div class="margin-bottom-5">
                      <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                        <i class="fa fa-search"></i> Search
                      </button>
                    </div>
                    <button class="btn btn-sm red btn-outline filter-cancel">
                      <i class="fa fa-times"></i> Reset
                    </button>
                  </td>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div class="actions">
              <div class="btn-group">
                <a data-url="{{route('admin.role.deletes')}}" data-container='body' data-trigger='hover' data-placement='top' data-original-title="{{trans('button.role.delete')}}" class="btn btn-sm red tooltips moredelete">
                  <i class="fa fa-trash-o"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>