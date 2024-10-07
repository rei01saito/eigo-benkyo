<?php

/* Usage
  for()の第一引数はリスト名のようなもの。
  push()の第一引数は表示される名前。第二引数はrouteでしていたnameの値。
*/

// Home
Breadcrumbs::for('home', function($trail) {
    $trail->push('Home', route('home'));
});

// Mypage
Breadcrumbs::for('mypage', function($trail) {
  $trail->parent('home');
  $trail->push('マイページ', route('mypage'));
});

// Status
Breadcrumbs::for('status', function($trail) {
  $trail->parent('home');
  $trail->push('進捗状況', route('status'));
});

// Tasks
Breadcrumbs::for('tasks', function($trail) {
  $trail->parent('home');
  $trail->push('Tasks', route('tasks'));
});