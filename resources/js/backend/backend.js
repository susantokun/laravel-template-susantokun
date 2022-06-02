import $ from 'jquery';
window.$ = window.jQuery = $;

import "./bootstrap";
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// backend
import "./feather";
import "./dropdown";
import "./sidebar";
import "./topbar";

// components
import "./components/Example";
import "./components/configuration/General";
import "./components/User";
import "./components/UserBasic";
