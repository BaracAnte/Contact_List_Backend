<?php $this->load->view('templates/header'); ?>

<div class="col-md-12 py-3">
    <div class="input-group">
        <span class="input-group-prepend">
            <div class="input-group-text bg-transparent border-0"><i class="fa fa-search"></i></div>
        </span>
        <input class="form-control py-2 border-0" type="search" placeholder="Search.." id="keyupSearch" data-favorite="<?= $favorite ?>">
    </div>
</div>

<table id="contactTable" class="table table-striped">
    <thead>
        <tr>
            <td colspan="5">Name</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contacts as $contact) : ?>
            <tr>
                <td class="small_td"><img src="/assets/images/<?php echo $contact['image']; ?>" style="width: 40px;height: 40px;border-radius: 30px;"></td>
                <td onclick="location.href = '/contacts/details/<?= $contact['id'] ?>';" role='button'>
                    <?= $contact['fullname'] ?>
                    <br>
                    <?= $contact['email'] ?>
                </td>
                <td>
                    <?php if ($contact['favorite']) : ?>
                        <img src="/assets/images/Favorite.png" class="img">
                    <?php else : ?>
                        <img src="/assets/images/NotFavorite.png" class="img">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/contacts/add_edit/<?= $contact['id'] ?>">
                        Edit
                    </a>
                </td>
                <td>
                    <a onclick="return confirm('Are you sure to delete?')" href="/contacts/delete/<?= $contact['id'] ?>">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $this->load->view('templates/footer'); ?>