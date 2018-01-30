<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Conference
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Conference</li>
    </ol>
  </section>
  <section class="content">
  
    <div class="row">
      <div class="col-md-6">
        <?php if(isset($_SESSION['message'])):?>
          <?php if($_SESSION['type'] == 'remove'):?>
            <div class="box box-solid bg-red-gradient">
          <?php else:?>
            <div class="box box-solid bg-green-gradient">
          <?php endif;?>
            <div class="box-header">
              <div class="row">
                <div class="col-md-10">
                  <h3 class="box-title"><?php echo $_SESSION['message'];?></h3>
                </div>
                <div class="col-md-2 text-right">
                  <button class="btn btn-link btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
            </div><!-- /.box-header -->
          </div>
        <?php endif;?>
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Conference List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="datatable table table-bordered table-striped">
              <thead>
                <tr>
                  <th><i class="fa fa-cog"></i></th>
                  <th>Name</th>
                  <th>Conference ID</th>
                  <th>Start Time</th>
                  <th>Conference Created By</th>
                  <th>Conference Members</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($conferences as $conference):?>
                    <tr>
                    <td>
                      <a href="<?php echo base_url('admin/conference/'.$conference->conference_id.'/'.$admin->name);?>" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-connectdevelop" aria-hidden="true"></i></a>
                      </td>
                      <td><?php echo $conference->name;?></td>
                      <td><?php echo $conference->conference_id;?></td>
                      <td><?php echo date('d/m/Y h:s a', strtotime($conference->start_time));?></td>
                      <td>
                        <?php if($admin->id == $conference->conference_created_by):?>
                        Me
                        <?php else: ?>
                        <?php $user_info = $this->db->get_where('admins', ['id'=> $conference->conference_created_by])->row();?>
                        <?php echo $user_info->name;?>
                        <?php endif;?>
                      </td>
                      <td>
                        <?php
                          $this->db->select('admins.*');
                          $this->db->from('conference_attend_users');
                          $this->db->join('admins', 'admins.id = conference_attend_users.user_id');
                          $this->db->where('conference_attend_users.conference_id', $conference->id);
                          $usrs = $this->db->get()->result();
                        ?>
                        <?php foreach($usrs as $usr):?>
                          <?php if($usr->id != $admin->id):?>
                            <span><?php echo $usr->name;?>, </span>
                          <?php endif;?>
                        <?php endforeach;?>
                      </td>
                      
                    </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>

      <div class="col-md-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Create Conference</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form id="add-user" role="form" action="<?php echo base_url('admin/create/conference');?>" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="conference_id">Conference ID</label>
                    <input type="text" class="form-control" id="conference_id" name="conference_id" value="<?php echo time();?>" readonly required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter conference name" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d');?>" min="<?php echo date('Y-m-d');?>" required>
                </div>
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label>Start Time</label>
                        <div class="input-group">
                            <input type="text" class="form-control timepicker" name="start_time">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->
                </div>
                <div class="form-group">
                    <label>Select Users</label>
                    <select class="form-control select2" multiple="multiple" data-placeholder="Select users" style="width: 100%;" name="users[]" required>
                    <?php foreach($users as $user):?>
                        <?php if($user->id != $admin->id):?>
                            <option value="<?php echo $user->id;?>"><?php echo $user->name;?></option>
                        <?php endif;?>
                    <?php endforeach;?>
                    </select>
                  </div><!-- /.form-group -->
            </div><!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div><!-- /.box -->
      </div>


    </div>

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->