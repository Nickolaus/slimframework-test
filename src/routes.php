<?php
// Routes

$app->get('/', 'HomeController:indexAction')->setName('entries');

$app->group('/entry', function() {
    $this->map(['GET', 'POST'], '/new', 'HomeController:formAction')->setName('entry_new')->add($this->getContainer()->get('csrf'));
    $this->map(['GET', 'POST'], '/{id}/update', 'HomeController:formAction')->setName('entry_update')->add($this->getContainer()->get('csrf'));
});
