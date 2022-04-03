require('./bootstrap');
import './home.js';
import './tasks.js';

require('jquery-ui/ui/widgets/draggable');
require('jquery-ui/ui/widgets/droppable');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



