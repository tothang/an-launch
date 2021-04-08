<?php

Breadcrumbs::register('speakers', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Speakers', route('speakers.index'));
});

Breadcrumbs::register('specific-speaker', function($breadcrumbs, $speaker) {
    $breadcrumbs->parent('speakers');
    $breadcrumbs->push($speaker->name, route('speakers.show', $speaker));
});