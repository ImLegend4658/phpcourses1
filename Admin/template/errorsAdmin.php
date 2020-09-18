<?php

if(count($errors)): ?>
<div class="alert alert-danger">
    <?php foreach($errors as $error): ?>
    <p><?php print_r($error)?></p>
    <?php endforeach; ?>
</div>

<?php

    endif;