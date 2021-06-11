<h1>Contact</h1>

<form action="/contact" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <?php if (\app\core\Application::isGuest()) : ?>
            <input type="text" class="form-control" name="name" id="name">
        <?php else : ?>
            <input type="hidden" name="name" value="<?= \app\core\Application::$app->user->name ?>">
            <input type="text" class="form-control" id="name" value="<?= \app\core\Application::$app->user->name ?>" disabled>
        <?php endif ?>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <input type="input" class="form-control" name="message" id="message">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>