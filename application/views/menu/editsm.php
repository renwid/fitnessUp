<div class="container">

    <div class="row mt-3">
        <div class="col-md-7">

            <div class="card" style="margin-bottom:25.4em; margin-right:0">
                <div class="card-header">
                    Edit Sub Menu
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $subMenu['id']; ?>">
                          <div class="form-group">
                              <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title" value="<?= $subMenu['title']; ?>">
                          </div>
                          <div class="form-group">


                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">Select Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>


                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url" value="<?= $subMenu['url']; ?>">
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" value="<?= $subMenu['icon']; ?>">
                          </div>
                          <div class="form-group">
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked value="<?= $subMenu['is_active']; ?>">
                                  <label class="form-check-label" for="is_active">
                                      Active?
                                  </label>
                              </div>
                          </div>
                      <div class="modal-footer">
                          <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                      </div>
                  </form>
                </div>
            </div>


        </div>
    </div>

</div>
