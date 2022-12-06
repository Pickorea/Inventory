<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('index'));
});

// Home > Island
Breadcrumbs::for('island', function ($trail, $island) {
    $trail->parent('island');
    $trail->push($island->name, route('island.index'));
});

// Home > Donor
Breadcrumbs::for('donor', function ($trail, $donor) {
    $trail->parent('home');
    $trail->push($donor->name, route('donor.index'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});