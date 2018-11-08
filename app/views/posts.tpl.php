<?php
foreach ($posts as $post) :
    ?>
    <article>
        <h2><a href="/post/<?= $post->getId() ?>"><?= htmlentities($post->getTitle()) ?></a></h2>
        <p>
            <time datetime="<?= htmlentities($post->getDatecreated()) ?>"><?= htmlentities($post->getDatecreated()) ?></time>
            <span>by <?= htmlentities($post->getEmail()) ?></span>
        </p>
        <?= htmlentities($post->getMessage()) ?>
    </article>
    <?php
endforeach;
?>