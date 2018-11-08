<article>
    <div class="row">
        <div class="col-md-6 push-md-3">
            <h1><?= $post->getTitle() ?></h1>
            <p>
                <time datetime="<?= htmlentities($post->getDatecreated()) ?>"><?= htmlentities($post->getDatecreated()) ?></time>
                <span>by <?= htmlentities($post->getEmail()) ?></span>
            </p>
            <div><?= $post->getMessage() ?></div>
            <form class="form-inline" action="/post/<?= $post->getId() ?>/edit" method="GET">
                <input type="submit" class="btn btn-primary" value="EDIT">
            </form>
            <form class="form-inline" action="/post/<?= $post->getId() ?>/delete" method="POST">
                <input type="submit" class="btn btn-danger" value="DELETE">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="push-md-3 col-md-6 text-md-center">
            <hr>
            <h2>COMMENTI</h2>

            <form action="/post/<?= $post->getId() ?>/comment" method="POST">

                <div class="form-group">

                    <label for="email">Email</label>
                    <input class="form-control" name="email" type="email"  name="email" i="email" required>

                </div>

                <div class="form-group">

                    <label for="comment">Message</label>
                    <textarea required name="comment" class="form-control" name="comment" i="message"></textarea>

                </div>
                <div class="form-group text-md-center">
                    <button class="btn  btn-success">Save</button>
                </div>
            </form>
            <?php
            if (!empty($comments)) {
                foreach ($comments as $comment) {
                    ?>

                    <p><?= $comment->getComment() ?></p>
                    <p>
                        <time datetime="<?= $comment->getDatecreated() ?>"><?= $comment->getDatecreated() ?></time>

                        by <span><a  href="mailto:<?= $comment->getEmail() ?>"> <?= $comment->getEmail() ?></a> </span>
                    </p>

                    <?php
                }
            }
            ?>
        </div>
    </div>

</article>

