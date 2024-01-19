<?php
/** @var array $data */
/** @var string $invalidSegment */
?>
<?php if ($data && ($data['errors'] ?? null)) : ?>
    <span class="invalid">
        <i>
            <small>
                <?= $data['errors'][$invalidSegment] ?? null?>
            </small>
        </i>
    </span>
<?php endif ?><?php
