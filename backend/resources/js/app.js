require('jquery-ui/ui/widgets/draggable');
require('jquery-ui/ui/widgets/droppable');
require('./bootstrap');
require('flowbite/dist/flowbite');
import { HomeEvent } from './home.js';
import { TaskEvent } from './tasks.js';
import { TagEvent } from './tags.js';
import { DeleteConfirmEvent } from './deleteConfirm.js';

window.onload = () => {
  let path = location.pathname;
  if (path === "/tasks") {
    TaskEvent();
  } else if (path === "/home" || path === "/") {
    HomeEvent();
  } else if (path === "/mypage") {
    TagEvent();
  } else if (path === "/mypage/edit") {
    DeleteConfirmEvent();
  }
};

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


