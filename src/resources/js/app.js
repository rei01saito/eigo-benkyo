require('jquery-ui/ui/widgets/draggable');
require('jquery-ui/ui/widgets/droppable');
require('./bootstrap');
import { HomeEvent } from './home.js';
import { TaskEvent } from './tasks.js';
import { TagEvent } from './tags.js';

window.onload = () => {
  let path = location.pathname;
  if (path === "/tasks") {
    TaskEvent();
  } else if (path === "/") {
    HomeEvent();
  } else if (path === "/mypage") {
    TagEvent();
  }
};

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


