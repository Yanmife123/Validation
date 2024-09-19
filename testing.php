<?php
$hash = '$2y$10$Uujhadf1LhoK8V8ayRV41uIPRC1uwytMSdNKyw1g6oKpgc6X.kprW';
echo password_verify('Blaze12@', $hash) ? 'correct' : 'not correct';
