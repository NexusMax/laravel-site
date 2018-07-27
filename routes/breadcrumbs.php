<?php



// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Онлайн портал SportCasta', route('home'));
});

// Confirm
Breadcrumbs::register('confirm', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Подтверждение регистрации', route('confirm'));
});

// 404
Breadcrumbs::register('404', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Ошибка (404)', route('home'));
});

// Questions
Breadcrumbs::register('questions', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Вопрос/ответ', route('questions'));
});

Breadcrumbs::register('password.request', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Восстановление пароля', route('password.request'));
});
Breadcrumbs::register('password.email', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Восстановление пароля', route('password.request'));
});
Breadcrumbs::register('password.reset', function ($breadcrumbs, $token) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Смена пароля', route('password.reset', $token));
});

// Home > privacy policy
Breadcrumbs::register('privacy', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Privacy policy', route('privacy'));
});

// Home > About
Breadcrumbs::register('about', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('О нас', route('about'));
});

// Home > Trainer
Breadcrumbs::register('training', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Тренерская', route('training'));
});




// Home > Trainer > category
Breadcrumbs::register('training/category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('training');
    $breadcrumbs->push($category->name , route('training/category', ['alias' => $category->alias]));
});

// Home > Trainer > category > article
Breadcrumbs::register('training/search', function ($breadcrumbs) {
    $breadcrumbs->parent('training');
    $breadcrumbs->push('Статьи', route('training/search'));
});

// Home > Trainer > category > article
Breadcrumbs::register('training/article', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('training/category', $category);
    if($category['id'] === 5){
        $text = 'Учебники';
    }else{
        $text = 'Статьи';
    }
    $breadcrumbs->push($text, route('training/article', $category));
});

// Home > Trainer > category > briefcases
Breadcrumbs::register('training/briefcases', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('training/category', $category);
    if($category['id'] === 5){
        $text = 'Статьи';
    }else{
        $text = 'Кейсы';
    }
    $breadcrumbs->push($text, route('training/briefcases', $category));
});

// Home > Trainer > category > video
Breadcrumbs::register('training/video', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('training/category', $category);

    if($category['id'] === 5){
        $text = 'Пособия';
    }else{
        $text = 'Видео';
    }

    $breadcrumbs->push($text, route('training/video', $category));
});

//// Home > Trainer > category > book
//Breadcrumbs::register('training/book', function ($breadcrumbs, $category) {
//    $breadcrumbs->parent('training/category', $category);
//    $breadcrumbs->push('Книги', route('training/book', $category));
//});

// Home > Trainer > category > tutorials
Breadcrumbs::register('training/tutorials', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('training/category', $category);
    $breadcrumbs->push('Учебники', route('training/tutorials', $category));
});

// Home > Trainer > category > paper
Breadcrumbs::register('training/paper', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('training/category', $category);
    $breadcrumbs->push('Статьи', route('training/paper', $category));
});

// Home > Trainer > category > benefits
Breadcrumbs::register('training/benefits', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('training/category', $category);
    $breadcrumbs->push('Пособия', route('training/benefits', $category));
});

// Home > Trainer > category > view
Breadcrumbs::register('training/view', function ($breadcrumbs, $item) {
    $breadcrumbs->parent('training/category', $item->category);
    $type = 'Статьи';
    if( isset($item['is_type']) && $item['is_type'] === 'case'){
        $type = 'Кейсы';
    }elseif(isset($item['is_type']) && $item['is_type'] === 'article' ){
        $type = 'Статьи';
    }elseif(isset($item['video']) && !empty($item['video'])){
        $type = 'Видео';
    }
    $breadcrumbs->push( $type , route('training/article', ''));
});

// Home > Video
Breadcrumbs::register('video', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Видео', route('video'));
});

// Home > Video > Category
Breadcrumbs::register('video/category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('video');
    $breadcrumbs->push(empty($category['name']) ? 'Категория' : $category['name'], route('video', ''));
});

// Home > Events
Breadcrumbs::register('events', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('События', route('events'));
});

// Home > Events > Current
Breadcrumbs::register('events/current', function ($breadcrumbs) {
    $breadcrumbs->parent('events');
    $breadcrumbs->push('Текущие', route('events/current'));
});

// Home > Events > future
Breadcrumbs::register('events/future', function ($breadcrumbs) {
    $breadcrumbs->parent('events');
    $breadcrumbs->push('Ближайшие', route('events/future'));
});

// Home > Events > past
Breadcrumbs::register('events/past', function ($breadcrumbs) {
    $breadcrumbs->parent('events');
    $breadcrumbs->push('Прошедшие', route('events/past'));
});

// Home > Events > view
Breadcrumbs::register('events/view', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('events');
//    $breadcrumbs->parent('home');
    $breadcrumbs->push($event['name'], route('events/view', ['alias' => $event['alias']]));
});

// Home > Myaccount
Breadcrumbs::register('myaccount', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Личный кабинет', route('myaccount'));
});

// Home > Myaccount > Bonus
Breadcrumbs::register('myaccount/bonus', function ($breadcrumbs) {
    $breadcrumbs->parent('myaccount');
    $breadcrumbs->push('История бонусов', route('myaccount/bonus'));
});

// Home > Myaccount > Bonuses
Breadcrumbs::register('myaccount/bonuses', function ($breadcrumbs) {
    $breadcrumbs->parent('myaccount');
    $breadcrumbs->push('Бонусная программа', route('myaccount/bonuses'));
});

// Home > Myaccount > Payment
Breadcrumbs::register('payment', function ($breadcrumbs) {
    $breadcrumbs->parent('myaccount');
    $breadcrumbs->push('Оплата', route('payment'));
});

// Home > Myaccount > Payment-event
Breadcrumbs::register('payment/event', function ($breadcrumbs) {
    $breadcrumbs->parent('myaccount');
    $breadcrumbs->push('Оплата', route('payment/event'));
});

// Home > Myaccount > Payment > Success
Breadcrumbs::register('payment/success', function ($breadcrumbs) {
    $breadcrumbs->parent('payment');
    $breadcrumbs->push('Подтверждение', route('payment/success'));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::register('post', function ($breadcrumbs, $post) {
    $breadcrumbs->parent('category', $post->category);
    $breadcrumbs->push($post->title, route('post', $post));
});