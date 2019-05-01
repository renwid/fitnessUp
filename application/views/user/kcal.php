<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
          <?= form_error('user', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
          <?= $this->session->flashdata('message'); ?>
          <a href="" class="btn btn-dark mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Food</a>
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">FoodGI</th>
                        <th scope="col">FoodGL</th>
                        <th scope="col">Protein</th>
                        <th scope="col">Carbs</th>
                        <th scope="col">Fats</th>
                        <th scope="col">Calorie</th>
                    </tr>
                </thead>
                <tbody>
                  <?php  $i = 1; ?>
                  <?php foreach($food as $f) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $f['foodName']; ?></td>
                        <td><?= $f['foodGI']; ?></td>
                        <td><?= $f['foodGL']; ?></td>
                        <td><?= $f['foodProtein']; ?></td>
                        <td><?= $f['foodCarbs']; ?></td>
                        <td><?= $f['foodFat']; ?></td>
                        <td><?= $f['foodCalorie']; ?></td>
                        <!-- <td><?= $f['foodName']; ?></td> -->
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach ?>
                </tbody>
            </table>

        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->


<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModal">New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu'); ?>" method="post">
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
     </form>
    </div>
  </div>
</div>

<!-- Delete Menu -->
<!-- <div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteMenuModal">Delete Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/deleteMenu'); ?>" method="post">
        <div class="modal-body">
          <p style="color:red">Are you sure you want to delete:</p>
          <div class="form-group">
            <input type="text" class="form-control" id="email" name="menu" value="<?= $m['menu'] ?>" readonly>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Delete</button>
      </div>
     </form>
    </div>
  </div>
</div> -->

<!-- Edit Menu -->
<!-- <div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMenuModal">Edit Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url(); ?>menu/edit/<?= $m['id']; ?>" method="post">
        <input type="hidden" name="id" value="<?= $m['id']; ?>">

        <div class="modal-body">
          <p style="color:green">Enter new name</p>
          <input type="text" class="form-control mt-3" id="id" name="menu" value="<?= $m['id'] ?>" readonly>
          <div class="form-group">
            <input type="text" class="form-control" id="email" name="menu" value="<?= $m['menu'] ?>">
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
     </form>
    </div>
  </div>
</div> -->
