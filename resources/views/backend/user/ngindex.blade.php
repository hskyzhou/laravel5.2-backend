<div class="row">
  <div class="col-md-12">
      <!-- Begin: life time stats -->
      <div class="portlet light portlet-fit portlet-datatable bordered">
          <div class="portlet-title">
              <div class="caption">
                  <i class="icon-settings font-dark"></i>
                  <span class="caption-subject font-dark sbold uppercase">Ajax Datatable</span>
              </div>
              <div class="actions">
                  <div class="btn-group">
                      
                  </div>
              </div>
          </div>
          <div class="portlet-body">
              <div class="table-container">
                  <div class="table-actions-wrapper">
                      <span> </span>
                      <select class="table-group-action-input form-control input-inline input-small input-sm">
                          <option value="">Select...</option>
                          <option value="Cancel">Cancel</option>
                          <option value="Cancel">Hold</option>
                          <option value="Cancel">On Hold</option>
                          <option value="Close">Close</option>
                      </select>
                      <button class="btn btn-sm green table-group-action-submit">
                          <i class="fa fa-check"></i> Submit</button>
                  </div>
                  <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                      <thead>
                          <tr role="row" class="heading">
                              <th width="2%">
                                  <input type="checkbox" class="group-checkable"> </th>
                              <th>{{trans('database.user.name')}}</th>
                              <th>{{trans('database.user.email')}}</th>
                              <th>{{trans('database.user.status')}}</th>
                              <th>{{trans('database.user.created_at')}}</th>
                              <th>{{trans('database.user.updated_at')}}</th>
                              <th>{{trans('label.action')}}</th>
                          </tr>
                          <tr role="row" class="filter">
                              <td></td>
                              <td>
                                <div class="form-group form-md-line-input">
                                  <div class="col-md-12">
                                    <div class="input-group has-success">
                                      <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                      </span>
                                      <input type="text" class="form-control" placeholder="{{trans('database.user.name')}}" name="name">
                                      <div class="form-control-focus"> </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="form-group form-md-line-input">
                                  <div class="col-md-12">
                                    <div class="input-group has-success">
                                      <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                      </span>
                                      <input type="text" class="form-control" placeholder="{{trans('database.user.email')}}" name="email">
                                      <div class="form-control-focus"> </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="form-group form-md-line-input">
                                  <div class="col-md-12">
                                    <select class="bs-select form-control" data-show-subtext="true" name="status">
                                      <option value="1" data-content="开启 <span class='label lable-sm label-success'>OPEN </span>">开启</option>
                                      <option value="2" data-content="关闭 <span class='label lable-sm label-danger'>CLOSE </span>">关闭</option>
                                    </select>
                                  </div>
                                </div>                                
                              </td>
                              <td>
                                <div class="col-md-12">
                                  <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" readonly placeholder="From" name="created_at_from">
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
                                    <input type="text" class="form-control" readonly placeholder="To"  name="created_at_to">
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
                                <div class="col-md-12">
                                  <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" readonly placeholder="From"  name="updated_at_from">
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
                                    <input type="text" class="form-control" readonly placeholder="To"  name="updated_at_to">
                                    <span class="input-group-btn">
                                      <button class="btn default" type="button">
                                        <i class="fa fa-calendar"></i>
                                      </button>
                                    </span>
                                  </div>
                                  <span class="help-block"></span>
                                </div>
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
                      <tbody> </tbody>
                  </table>
              </div>
          </div>
      </div>
      <!-- End: life time stats -->
  </div>
</div>