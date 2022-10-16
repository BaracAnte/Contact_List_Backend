<?php $this->load->view('templates/header'); ?>

<i class="fa fa-arrow-left fa-lg pb-4" role="button" aria-hidden="true" onclick="location.href = '/contacts/index';"></i>

<div class="border col-md-8">
    <div class="form-group col-md-3 d-inline-block">
        <img class="rounded-circle mt-4 mb-3" src="/assets/images/<?php echo $contact->image; ?>" style="width: 130px;height: 130px;border-radius: 30px;">
    </div>

    <div class="form-group col-md-3 d-inline-block">
        <h3 class="font-weight-bold mb-0 mt-1"><?= $contact->fullname ?></h3>
        <?php if ($contact->favorite) : ?>
            <img src="/assets/images/Favorite.png" class="img">
        <?php else : ?>
            <img src="/assets/images/NotFavorite.png" class="img">
        <?php endif; ?>
    </div>
    <div class="form-group col-md-6 p-3 d-inline">
        <button type="submit" onclick="location.href = '/contacts/add_edit/<?= $contact->id ?>';" class="border btn btn-light float-right form-group mt-3 ml-4">Edit</button>
    </div>
    <div class="form-group col-md-6">
        <label class="font-weight-light">Email adress</label>
        <br>
        <label><?= $contact->email ?></label>
    </div>
    <h5 class="px-3">Numbers</h5>
    <div id="phoneNumber_list" class="col-md-12">
        <?php foreach ($contact->phone_numbers as $key => $phone_numbers) : ?>
            <div class="panel border p-2 col-md-12">
                <label><?= $phone_numbers->phone ?></label>
                <label class="float-right green_text"><?= $phone_numbers->label ?></label>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>