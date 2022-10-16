<?php $this->load->view('templates/header'); ?>

<?php echo validation_errors(); ?>
<div class="border col-md-8">
    <?php echo form_open_multipart('contacts/' . $function); ?>
    <div class="form-group col-md-6 d-inline-block">
        <?php if ($function == 'edit') : ?>
            <img class="rounded-circle mt-4 mb-3" src="/assets/images/<?php echo $contact->image; ?>" style="width: 130px;height: 130px;border-radius: 30px;">
        <?php endif; ?>
        <br>
        <label for="contact_image">Image</label>
        <div class="custom-file">
            <input type="file" id="contact_image" name="userfile" lang="en">
        </div>
    </div>
    <div class="form-group col-md-6 p-3 d-inline">
        <?php if ($function == 'edit') : ?>
            <button type="submit" class="border btn btn-light float-right form-group mt-3 ml-4">Delete</button>
        <?php endif; ?>
        <button type="submit" class="border btn btn-light float-right form-group mt-3 ml-4">Cancel</button>
        <button type="submit" class="border btn btn-light float-right form-group mt-3 ml-4">Save</button>
    </div>
    <div class="col-md-6">
        <input class="form-check-input ml-1" name="favorite" type="checkbox" <?php echo ($contact->favorite == '1') ? 'checked' : ''; ?> id="name">
        <label class="form-check-label ml-4" for="name">
            Favorite
        </label>
    </div>
    <div class="form-group col-md-6">
        <label>Full name</label>
        <input type="text" class="form-control" name="fullname" value="<?= $contact->fullname ?>">
    </div>
    <div class="form-group col-md-6">
        <label>Email</label>
        <input type="text" class="form-control" name="email" value="<?= $contact->email ?>">
    </div>
    <h4 class="px-3">Numbers</h4>
    <div id="phoneNumber_list">
        <?php
        $phone_number_count = count($contact->phone_numbers);
        ?>
        <?php foreach ($contact->phone_numbers as $key => $phone_numbers) : ?>
            <div class="panel form-group border p-2 col-md-12">
                <input type="text" class="form-control col-5 d-inline" name="phone_label[<?= $key ?>][phone]" value="<?= $phone_numbers->phone ?>" placeholder="phone number">
                <input type="text" class="form-control col-5 d-inline" name="phone_label[<?= $key ?>][label]" value="<?= $phone_numbers->label ?>" placeholder="details">
                <a href="#" class="btn text-success remove_btn d-inline">Delete</a>
                <input type="hidden" name="phone_label[<?= $key ?>][id]" value=<?= $phone_numbers->id ?>><br>
                <input type="hidden" value=<?= $contact->id ?>><br>
            </div>
        <?php endforeach; ?>
        <div class="panel form-group border p-2 col-md-12">
            <input type="text" class="form-control col-5 d-inline" name="phone_label[<?= $phone_number_count ?>][phone]" placeholder="phone number">
            <input type="text" class="form-control col-5 d-inline" name="phone_label[<?= $phone_number_count ?>][label]" placeholder="details">
            <a href="#" class="btn text-success remove_btn d-inline">Delete</a>
        </div>
    </div>
    <a href="#" class="btn text-success add_btn" id="add_new">Add number</a>
    <input type="hidden" name="id" value=<?= $contact->id ?>><br>
    <input type="hidden" id="index_number" value=<?= $phone_number_count ?>><br>
    </form>
</div>

<?php $this->load->view('templates/footer'); ?>