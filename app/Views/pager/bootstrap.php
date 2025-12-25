<?php $pager->setSurroundCount(2); ?>

<nav arial-label="Page navigation">
    <ul class="pagination justify-content-end">
        <?php if($pager->hasPreviousPage()) : ?>
            <li class="page-item">
                <a href="<?= $pager->getFirst() ?>" class="page-link" aria-label="First">
                    &laquo;
                </a>
            </li>

            <li class="page-item">
                <a href="<?= $pager->getPreviousPage() ?>" class="page-link" aria-label="Previous">
                    &lsaquo;
                </a>
            </li>
            
        <?php endif ?>

        <?php foreach($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a href="<?= $link['uri'] ?>" class="page-link">
                    <?= $link['title']; ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if($pager->hasNextPage()) : ?>
            <li class="page-item">
                <a href="<?= $pager->getNextPage() ?>" class="page-link" aria-label="Next">
                    &rsaquo;
                </a>
            </li>

            <li class="page-item">
                <a href="<?= $pager->getLast() ?>" class="page-link" aria-label="Last">
                    &raquo;
                </a>
            </li>
            
        <?php endif ?>
    </ul>
</nav>