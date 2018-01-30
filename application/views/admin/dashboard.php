<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Users
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Users</li>
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
            <h3 class="box-title">User List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="datatable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <?php if($admin->role == 1):?>
                  <th><i class="fa fa-cog"></i></th>
                  <?php endif;?>
                </tr>
              </thead>
              <tbody>
                <?php foreach($users as $user):?>
                  <?php if($user->id != $admin->id):?>
                    <tr>
                      <td><?php echo $user->name;?></td>
                      <td><?php echo $user->email;?></td>
                     
                      <td>
                      <?php if($admin->role == 1):?>
                        <a href="<?php echo base_url('admin/delete/user/'.$user->id);?>" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash-o"></i>
                        </a>
                      <?php endif;?>
                        <a href="<?php echo base_url('private/call/'.$admin->id.'/'.$user->id);?>" class="btn btn-xs btn-success" target="_blank">
                        <i class="fa fa-phone"></i>
                        </a>
                      </td>
                      
                    </tr>
                  <?php endif;?>
                <?php endforeach;?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      <?php if($admin->role == 1):?>
      <div class="col-md-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Create User</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form id="add-user" role="form" action="<?php echo base_url('admin/create/user');?>" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
              </div>
              <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
              </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div><!-- /.box -->
      </div>
      <?php endif;?>

    </div>

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
      
